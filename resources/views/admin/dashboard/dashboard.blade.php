
@extends('layouts.admin')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="card">
				<legend>Dashboard</legend>
				<div class="alert alert-info alert-dismissible">
                  <h5><i class="fas fa-bullhorn"></i> MERCHANTBAY SHOP</h5>
                  Welcome to Merchatbay Shop.
                </div>

				<div id="dashborad-panel" class="clearfix">

					<div style="text-align:center;margin:0;">
						<div class="icon" title="Vendors">
							<a href="{{route('vendor.index')}}">
								<i class="fas fa-store"></i>
								<span>Stores</span>
							</a>
						</div>
					</div>
					<div style="text-align:center;margin:0;">
						<div class="icon" title="Categories">
							<a href="{{ Route('product-categories.index')}}">
								<i class="fas fa-network-wired"></i>
								<span>Categories</span>
							</a>
						</div>
					</div>

				</div>
				
				<div class="row" style="display: none;">
					<div class="col-md-12">
						<select name="stats_year" id="stats_year" class="statistics-list">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021" selected="selected">2021</option>
						</select>
						<select name="stats_month" id="stats_month" class="statistics-list">
							<option value="">All</option>
							<option value="01">Jan</option>
							<option value="02">Feb</option>
							<option value="03">Mar</option>
							<option value="04">Apr</option>
							<option value="05">May</option>
							<option value="06">Jun</option>
							<option value="07">Jul</option>
							<option value="08">Aug</option>
							<option value="09">Sep</option>
							<option value="10">Oct</option>
							<option value="11">Nov</option>
							<option value="12" selected="selected">Dec</option>
						</select>		
						<a href="javascript:void(0);" class="show-users-list-trigger">Show list</a>
						<div class="modal fade" id="user-list-modal">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="userListModalLabel">User List</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="selected-users-list-block"></div>
									</div>
								</div>
							</div>
						</div>						


						<div id="registered-userschartbar-container" style="margin: 0 auto;"></div>
					</div>
					<div class="col-md-12">
						<div id="active-userschartbar-container" style="margin: 0 auto;"></div>
					</div>
				</div>

			</div>
		</section>
		<!-- /.content -->
	</div>
  @endsection

@push('js')
<script>
var bar_chart, xhr;
$(document).ready(function () {

    bar_chart = Highcharts.chart('registered-userschartbar-container', {
		chart: {
			type: 'area',
			//width: $(window).width() - 100,
			height: 400
		},
		title: {
			text: 'Monthly registered user'
		},
		credits: {
			enabled: false
		},
		legend: {
			enabled: false
		},
		xAxis: {
			categories: [],
			crosshair: true
		},
		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: 'Number of Users'
			}
		},
		loading: {
			labelStyle: {
				color: '#333333'
			},
			style: {
				"position": "absolute", "backgroundColor": "#ffffff", "opacity": 0.9, "textAlign": "center"
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:12px"><b>{point.key}</b></span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">Users: </td>' +
			'<td style="padding:0"><b>{point.y}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Months',
			data: []
		}]
    });

    $.fn.getStatsData = function() {
		// if there is a previous ajax search, then we abort it and then set xhr to null
			if( xhr != null ) {
				xhr.abort();
				xhr = null;
			}
		
		var stats_month = $("#stats_month").val();
		if(stats_month==""){
			var all_month_val = 1;
		}
		else {
			var all_month_val = 0;
		}
		
		xhr = $.ajax({
			type: 'get',
			url: '{{ route("monthly.registered.users") }}',
			data: {
				stats_year: $("#stats_year").val(),
				all_month: all_month_val,
				stats_month: function(){
					var stats_month = $("#stats_month").val();
					if(stats_month=="")  // if month is ALL, send all month options
					{
						var all_months = new Array;
						$("#stats_month option").each(function()
						{
							if($(this).val()!=""){
								all_months.push($(this).val());
							}
						});
						
						return all_months;
					}
					else {
						return stats_month;
					}
				}
			},
			dataType: 'json',
			beforeSend: function(){
				bar_chart.showLoading();
			},
			complete: function(){
			},
			success: function(response){
				console.log(response);
				bar_chart.hideLoading();
				
				if(response.error==0){

					bar_chart.xAxis[0].setCategories(response.barCategories);
					bar_chart.series[0].setData(response.barData);
					
					if(all_month_val==1){
						bar_chart.xAxis[0].setTitle({text: 'Months'});
					}
					else {
						bar_chart.xAxis[0].setTitle({text: 'Days'});
					}

				}
			}
		})  
    }
    
    $.fn.getStatsData();
	$('#stats_year, #stats_month').change(function(){
		$.fn.getStatsData();
    });

	$(".show-users-list-trigger").click(function(){
		var selectedYear = $("#stats_year").val();
		var selectedMonth = $("#stats_month").val();
		var url = '{{ route("get.userslist.basedonselectedparams") }}';
		$.ajax({
			method: 'get',
			data: {selectedYear:selectedYear, selectedMonth:selectedMonth},
			url: url,
			beforeSend: function() {
				//$('.loading-message').html("Please Wait.");
				//$('#loadingProgressContainer').show();
			},
			success:function(data)
			{
				$('#user-list-modal').modal('show');
				$(".selected-users-list-block").html(data.message);
			}
		});
	})	
	/*
	Highcharts.chart('registered-userschartbar-container', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Registered Users'
		},
		subtitle: {
			text: 'Source: merchantbay.com'
		},
		xAxis: {
			categories: [
				'Jan',
				'Feb',
				'Mar',
				'Apr',
				'May',
				'Jun',
				'Jul',
				'Aug',
				'Sep',
				'Oct',
				'Nov',
				'Dec'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Rainfall (mm)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="padding:0; line-height: normal;">{point.y:.1f} users</td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true,
			style: {
				pointerEvents: 'auto'
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Monthly registered users',
			data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120]
		}]
	});
	*/
	/*
	Highcharts.chart('active-userschartbar-container', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Active Users'
		},
		subtitle: {
			text: 'Source: merchantbay.com'
		},
		xAxis: {
			categories: [
				'Jan',
				'Feb',
				'Mar',
				'Apr',
				'May',
				'Jun',
				'Jul',
				'Aug',
				'Sep',
				'Oct',
				'Nov',
				'Dec'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Rainfall (mm)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="padding:0; line-height: normal;">{point.y:.1f} users</td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true,
			style: {
				pointerEvents: 'auto'
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Last 2 weeks active users',
			data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120]
		}]
	});
	*/
});	
</script>
@endpush
