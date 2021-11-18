$(document).ready(function() {
    $('.dropdown-trigger').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: false, // Activate on hover
        gutter: 0, // Spacing from edge
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    $('.shop-categories-wrap li, .products-category-block li').hover(
        function() {
            $(this).addClass("current");
        }, function() {
            $(this).removeClass("current");
        }
    );

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $(".tooltipped").tooltip();

    $('.slider').slider({
        'indicators':false
    });

    $(".mobile-search-btn").click(function(){
        $(".mobile-module-search").slideToggle();
    });

    $(".modal").modal();
    // this will hide the color-size modal from order details modal
    $(".hide-color-size-modal-trigger").click(function(){
        $(this).closest("#colorSizeModal").modal("close");
    });

    $(".product-more-details").click(function(){
        $(window).resize();
    });
    //$("#modal3").modal("open");
    //$("#modal3").modal("close");

    $('.tabs').tabs();

    // var slider = document.getElementById('price-slider');
    // noUiSlider.create(slider, {
    //     start: [0, 100],
    //     connect: true,
    //     step: 1,
    //     orientation: 'horizontal', // 'horizontal' or 'vertical'
    //     range: {
    //         'min': 0,
    //         'max': 100
    //     },
    //     behaviour: 'tap-drag',
    //     tooltips: true,
    //     format: wNumb({
    //         decimals: 0
    //     })
    // });

    // Product grid and list toggle start
    $(".grid-list-filter .btn").click(function(){
        if($(this).hasClass("active")) {
            $(this).addClass("active");
            //alert("I am here 1");
        } else {
            $(this).parent().children().removeClass("active");
            $(this).addClass("active");

            if($(this).closest(".show-product-results-wrapper").next().children('.row').hasClass("active_grid")) {
                $(this).closest(".show-product-results-wrapper").next().children('.row').removeClass("active_grid");
                $(this).closest(".show-product-results-wrapper").next().children('.row').addClass("active_list");
                $(this).closest(".show-product-results-wrapper").next().children('.row').children().each(function(){
                    //console.log($(this).length);
                    replaceClass($(this), "col s12 m4 l4", "col s12 m12 l12");
                })
            } else {
                $(this).closest(".show-product-results-wrapper").next().children('.row').removeClass("active_list");
                $(this).closest(".show-product-results-wrapper").next().children('.row').addClass("active_grid");
                $(this).closest(".show-product-results-wrapper").next().children('.row').children().each(function(){
                    //console.log($(this).length);
                    replaceClass($(this), "col s12 m12 l12", "col s12 m4 l4");
                })
            }
        }
    });
    function replaceClass(attrClassName, oldClass, newClass) {
        var elem = attrClassName;
        if (elem.hasClass(oldClass)) {
            elem.removeClass(oldClass);
        }
        elem.addClass(newClass);
    }

    $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#seller_edit_images').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#edit_preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on("click", ".btn-upload-product" , function() {
        $(this).closest('#products').children('.product-list-block').hide();
        $(this).closest('#products').children('.product-add-block').show();
    });

    $(document).on("click", ".btn-back-to-product-list" , function() {
        $(this).closest('#products').children('.product-list-block').show();
        $(this).closest('#products').children('.product-add-block').hide();
        $(this).closest('#products').children('.product-edit-block').hide();
    });

    $(document).on("click", ".addImage" , function() {
        var div = $(".clone").html();
        $(".increment").after(div);
    });
    $(document).on("click",".removeImage",function(){
        $(this).parents(".remove-div").remove();
    });

    $('#images').change(function(){
        $('.image-preview').show();
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on("click", ".add_to_cart" , function() {
        var sku = $("input[name='sku']").val();
        console.log(sku);
        $.ajax({
            type:'GET',
            url: "/add-to-cart",
            dataType:'json',
            data:{ sku :sku },
            success: function(data){
                console.log('hi');
                alert("added to cart");

            }
        });

    });

    $(".cart-btn").click(function(event){
        event.stopPropagation;
        $("#cart-dropdown").fadeToggle("fast");
    });
    $("#cart-dropdown").on("click", function(event){
        event.stopPropagation;
    });

    $(".notification-btn").click(function(event){
        event.stopPropagation;
        $(".notification-list").fadeToggle("fast");
    });
    $(".notification-list").on("click", function(event){
        event.stopPropagation;
    });

    $(".card-alert .close").click(function(){$(this).closest(".card-alert").fadeOut("slow")});

    $(".custommaize_order_trigger").click(function(){
        $(this).closest(".ready_stock_config_block").children("#color-size-block").toggle("slow");
    });
    $(".mixedcontent_order_trigger").click(function(){
        $(this).closest(".ready_stock_config_block").children("#color-size-block").hide("slow");
    })

    $(".edit_store_block_trigger").click(function(){
        $(".location-details-block").find(".form-control").removeAttr('disabled');
        $(".location-details-block").find(".select2").removeAttr('disabled');
    });
    $(".cancel_store_information_trigger").click(function(){
        $(".location-details-block").find(".form-control").attr('disabled', true);
        $(".location-details-block").find(".select2").attr('disabled', true);
    });



    $(".upload-photo-btn-trigger").click(function(){
        $(this).next("#images").click();
    });
    $(".edit-upload-photo-btn-trigger").click(function(){
        $(this).next("#seller_edit_images").click();
    });

    $(".show_attr_trigger").click(function(){
        $('#attr-block').toggle("slow");
    });
    // $('.product-datatable').DataTable({
    //     pageLength: 10
    // });

    $(".view-more-color-trigger").click(function(){
        $(this).hide();
        $(this).closest(".module-color-filter").children(".view-less-color-trigger").show('slow');
        $(this).closest(".module-color-filter").children('.color-item:nth-child(n+6)').show('slow');
    });
    $(".view-less-color-trigger").click(function(){
        $(this).hide();
        $(this).closest(".module-color-filter").children(".view-more-color-trigger").show('slow');
        $(this).closest(".module-color-filter").children('.color-item:nth-child(n+6)').hide('slow');
    });

    $(".view-more-size-trigger").click(function(){
        $(this).hide();
        $(this).closest(".module-size-filter").children(".view-less-size-trigger").show('slow');
        $(this).closest(".module-size-filter").children('.size-item:nth-child(n+6)').show('slow');
    });
    $(".view-less-size-trigger").click(function(){
        $(this).hide();
        $(this).closest(".module-size-filter").children(".view-more-size-trigger").show('slow');
        $(this).closest(".module-size-filter").children('.size-item:nth-child(n+6)').hide('slow');
    });
    jQuery('#overall-star-rating').raty({
		number      : 5,
		scoreName   : 'overall_rating',
		halfShow    : false,
		half        : false,
		hints       : [1,2,3,4,5],
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });
    jQuery('#communication-star-rating').raty({
		number      : 5,
		scoreName   : 'communication_rating',
		halfShow    : false,
		half        : false,
		hints       : [1,2,3,4,5],
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });
    jQuery('#ontimedelivery-star-rating').raty({
		number      : 5,
		scoreName   : 'ontime_delivery_rating',
		halfShow    : false,
		half        : false,
		hints       : [1,2,3,4,5],
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });
    jQuery('#samplesupport-star-rating').raty({
		number      : 5,
		scoreName   : 'sample_support_rating',
		halfShow    : false,
		half        : false,
		hints       : [1,2,3,4,5],
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });
    jQuery('#productquality-star-rating').raty({
		number      : 5,
		scoreName   : 'product_quality_rating',
		halfShow    : false,
		half        : false,
		hints       : [1,2,3,4,5],
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });

    jQuery('.star-rating').raty({
        readOnly    :  true,
        half        :  true,
		starOff     : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-off.png',
		starHalf    : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-half.png',
		starOn      : 'https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/images/star-on.png'
    });

});


function addToCart($sku)
{
    var sku=$sku;
    var unit_price=  $('input[name=unit_price]').val();
    var quantity =  $('input[name=quantity]').val();
    var total_price=  $('input[name=total_price]').val();
    var full_stock= $('input[name=full_stock]').val();
    var product_type =$('input[name=product_type]').val();
    var color_attr= [];
    //var check_value=$('input[name="color"]').val();
    if(product_type== 1 || product_type == 2)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'xxs' : Number($('input[name="xxs"]').eq(idx).val()) || 0,
                            'xs' : Number($('input[name="xs"]').eq(idx).val()) || 0,
                            'small' :Number($('input[name="small"]').eq(idx).val())  || 0,
                            'medium' : Number($('input[name="medium"]').eq(idx).val()) || 0,
                            'large' : Number($('input[name="large"]').eq(idx).val()) ||0,
                            'extra_large' : Number($('input[name="extra_large"]').eq(idx).val()) || 0,
                            'xxl' : Number($('input[name="xxl"]').eq(idx).val()) || 0,
                            'xxxl' : Number($('input[name="xxxl"]').eq(idx).val()) || 0,
                            'four_xxl' : Number($('input[name="four_xxl"]').eq(idx).val()) || 0,
                            'one_size' : Number($('input[name="one_size"]').eq(idx).val()) || 0,
                            });
            });
    }
    if(product_type == 3)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'quantity' : Number($('input[name="non_clothing_quantity"]').eq(idx).val()) || 0,
                            });
            });
    }


    var url = "/add-to-cart";
    swal({
        title: "Want to add this product into cart?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, add it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {

                // if(check_value){
                //     $('.tr').each(function(idx,ele){
                //     color_attr.push({'color' : $('input[name="color"]').eq(idx).val(),
                //                     'small' : $('input[name="small"]').eq(idx).val(),
                //                     'medium' : $('input[name="medium"]').eq(idx).val(),
                //                     'large' : $('input[name="large"]').eq(idx).val(),
                //                     'extra_large' : $('input[name="extra_large"]').eq(idx).val(),
                //                     });
                //     });
                // }

                $.ajax({
                    type:'GET',
                    url: url,
                    dataType:'json',
                    data:{ sku :sku ,unit_price:unit_price,total_price:total_price,quantity:quantity,color_attr:color_attr,full_stock: full_stock},
                    success: function(data){
                        //console.log(data.cartItems);
                        swal(data.message, data.success,data.type);
                        $('#cartItems').html('');
                        $("#cartItems").html(data.cartItems);
                        $('#product-details-modal').hide();
                    }
                });
            }
            // else {
            //     e.dismiss;
            // }
    }, function (dismiss) {
        return false;
    })
}

//askforprice
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function askForPrice($sku)
{
    var sku=$sku;
    var business_profile_id=  $('input[name=business_profile_id]').val();
    var product_id=  $('input[name=product_id]').val();
    var product_type =$('input[name=product_type]').val();
    var type = 1;
    var color_attr= [];

    if(product_type == 1 || product_type == 2)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'xxs' : Number($('input[name="xxs"]').eq(idx).val()) || 0,
                            'xs' : Number($('input[name="xs"]').eq(idx).val()) || 0,
                            'small' :Number($('input[name="small"]').eq(idx).val())  || 0,
                            'medium' : Number($('input[name="medium"]').eq(idx).val()) || 0,
                            'large' : Number($('input[name="large"]').eq(idx).val()) ||0,
                            'extra_large' : Number($('input[name="extra_large"]').eq(idx).val()) || 0,
                            'xxl' : Number($('input[name="xxl"]').eq(idx).val()) || 0,
                            'xxxl' : Number($('input[name="xxxl"]').eq(idx).val()) || 0,
                            'four_xxl' : Number($('input[name="four_xxl"]').eq(idx).val()) || 0,
                            'one_size' : Number($('input[name="one_size"]').eq(idx).val()) || 0,
                            });
        });
    }
    if(product_type == 3)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'quantity' : Number($('input[name="non_clothing_quantity"]').eq(idx).val()) || 0,
                            });
        });
    }


    var url = "/order/queries/store";
    swal({
        title: "Want to query about this product?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, add it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {

                $.ajax({
                    type:'POST',
                    url: url,
                    dataType:'json',
                    data:{ sku :sku ,business_profile_id:business_profile_id,product_id:product_id,color_attr:color_attr,type:type},
                    success: function(data){
                        console.log(data.cartItems);
                        swal("Done!", data.msg,"success");
                        $('#product-details-modal').hide();
                    }
                });
        }

    }, function (dismiss) {
        return false;
    })
}
// $(window).on('load', function() {
//     var selectedSearchOption = $("#searchOption").children("option:selected").val();
//     $("#system_search .search_type").val(selectedSearchOption);
// })

//on change input field set
$("#searchOption").change(function(){
    var nohtml = "";
    $('#search-results').html(nohtml).hide();
    var selectedSearchOption = $("#searchOption").children("option:selected").val();
    $("#system_search .search_type").val(selectedSearchOption);

    if($(this).val() == "product"){
        $(".search_input").attr("placeholder", "Type products name");
    }
    else if($(this).val() == "vendor"){
        $(".search_input").attr("placeholder", "Type vendors name");
    }

    var searchInput = $("#system_search .search_input").val();
    console.log(searchInput);

    $.ajax({
        type:'GET',
        url: '/liveSearch',
        dataType:'json',
        data:{ searchInput:searchInput,selectedSearchOption:selectedSearchOption},
        success: function(response)
        {
            var html="";
            var nohtml = "";
            if(response.resultCount > 0)
            {
                if(response.searchType=='product' && response.data.length > 0)
                {
                    $('.product-item').html(nohtml);
                    for(var i=0; i<response.data.length; i++)
                    {
                        html+='<div class="product-item">';
                        $.each(response.data[i].images,function(key,item){
                            if(key==0){
                                var url  = window.location.origin;
                                var image=url+'/storage/'+item.image;
                                html+='<div class="product-img"><img src="'+image+'"></div>';
                            }
                        })
                        html+= '<div class="product-short-intro">';
                        html+= '<h4>'+response.data[i].name+'</h4>';
                        html+= '<div class="details"><p><i class="material-icons pink-text"> star </i>' +response.averageRatings[i]+'</p></div>';
                        html+='<h5>Tk (';

                        var last1=JSON.parse(response.data[i].attribute).length;
                        $.each(JSON.parse(response.data[i].attribute),function(key,item){

                                            if(key == (last1 -1)){
                                                html+= item[2];
                                            }
                                        })

                        html+='<span>/ lot '+response.data[i].moq+' pieces / lot)</span></h5>';

                        var url  = window.location.origin;
                        html+= '<a href="'+url+'/product/'+response.data[i].sku+'/details">See details</a>';
                        html+= '</div><br>';
                        html+= '</div>';
                    }
                    $('#search-results').append(html);
                    $('#search-results').show();
                }
                else if(response.searchType=='vendor' && response.data.length > 0)
                {
                    $('.vendor-info').html(nohtml);
                    for(var i=0;i<response.data.length;i++){
                        html+='<div class="vendor-info">';
                        console.log('hi');
                        html+= '<h4>'+response.data[i].vendor_name+'</h4>';
                        html+= '<div class="details"><p>'+response.data[i].vendor_address+'</p></div>';
                        html+= '<a href="#">'+response.data[i].vendor_name+'</a>';
                        html+= '</div>';
                        }
                    $('#search-results').append(html);
                    $('#search-results').show();
                }
            }
            else
            {
                $('#search-results').html(nohtml).hide();
            }
        }

    });
});



//fresh order color metrics
function addFreshOrderColorSize()
{
    var html = '<tr class="tr">';
    html += '<td><input class="combat" type="text" value="" name="color"/></td>';
    html += '<td><input class="combat" type="text" value="0" name="xxs" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="xs" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="small" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="medium" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="large" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="extra_large" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="xxl" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="xxxl" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="four_xxl" /></td>';
    html += '<td><input class="combat" type="text" value="0" name="one_size" /></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeFreshOrderColorSize(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('#fresh_order_customize_block tbody').append(html);
}
function removeFreshOrderColorSize(el)
{
$(el).parent().parent().remove();
}


$(document).on("click", "#notification_identifier" , function() {
    var notificationId =$(this).attr("data-notification-id") ;
    var obj=$(this).closest('tr').find('.newOrder');
    $.ajax({
        type:'GET',
        url: '/notification-mark-as-read',
        dataType:'json',
        data:{ notificationId :notificationId},
        success: function(data){
            $(obj).remove();
                $('.orderApprovedCount').html(data.newOrderApprovedNotificationCount);
                $('#noOfNotifications').html(data.noOfnotification);
        }
    });

});



$(document).on("click", ".order-modification-request" , function() {
    var notificationId =$(this).attr("data-order-modification-request-notification-id") ;
    var obj=$(this).closest('tr').find('.newOrder');
    $.ajax({
        type:'GET',
        url: '/notification-mark-as-read',
        dataType:'json',
        data:{ notificationId :notificationId},
        success: function(data){
            obj.remove();
            $('.orderModificationCount').html(data.newModificationRequestNotificationCount);
            $('#noOfNotifications').html(data.noOfnotification);
        }
    });

});

//order query notification
$(document).on("click", ".order-query-notification" , function() {
    var notificationId =$(this).attr("data-notification-id") ;
    var obj=$(this).closest('tr').find('.newOrder');
    $.ajax({
        type:'GET',
        url: '/notification-mark-as-read',
        dataType:'json',
        data:{ notificationId :notificationId},
        success: function(data){
            obj.remove();
            $('.orderQueryProcessedCount').html(data.newOrderQueryProcessedCount);
            $('#noOfNotifications').html(data.noOfnotification);
        }
    });

});

$("#resend-email-validtion").click(function(){
    $("#resend-email-verification-form").toggle('slow');
  });
