
@php
    $product_type_mapping_child_id = array_key_exists('product_type_mapping_child_id', app('request')->input())?app('request')->input('product_type_mapping_child_id'): [];
    $product_tag = array_key_exists('product_tag', app('request')->input())?app('request')->input('product_tag'): [];
    $view_min_lead_time= array_key_exists('min_lead', app('request')->input())?app('request')->input('min_lead'): null;
    $view_max_lead_time= array_key_exists('max_lead', app('request')->input())?app('request')->input('max_lead'): null;
    $view_max_moq = array_key_exists('max_moq', app('request')->input())?app('request')->input('max_moq'): null;
    $view_min_moq = array_key_exists('min_moq', app('request')->input())?app('request')->input('min_moq'): null;
@endphp
<form action="{{route('new.profile.products',$alias)}}">
    <div class="new_profile_account_filterbar">
        <h4>Filtered by</h4>
        <div class="new_profile_account_filterbox">
            <label>Product type mapping</label>
            <select class="select2 dropdownOptions filter-select"  name="product_type_mapping_child_id[]" multiple>
                @foreach ($product_type_mapping as $ptm)
                    <option value={{$ptm->id}} {{ (in_array($ptm->id, $product_type_mapping_child_id))?'selected':'' }}>{{$ptm->title}}</option>
                @endforeach
            </select>

            <label>Product tags</label>
            <select class="select2 dropdownOptions filter-select"  name="product_tag[]" multiple>
                @foreach ($product_tags as $pt)
                    <option value={{$pt->id}} {{ (in_array($pt->id, $product_tag))?'selected':'' }}>{{$pt->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="account_filter_progress_wrap">
            <h4>Lead Time</h4>
            <div class="filter_progress_box">
                <div id="myRange"></div>
                <input type="hidden" name="min_lead" id="min_lead" value="{{$view_min_lead_time}}">
                <input type="hidden" name="max_lead" id="max_lead" value="{{$view_max_lead_time}}">
            </div>

            <h4>MOQ</h4>
            <div class="filter_progress_box_moq">
                <div id="myRangeMoq"></div>
                <input type="hidden" name="min_moq" id="min_moq" value="{{$view_min_moq}}">
                <input type="hidden" name="max_moq" id="max_moq" value="{{$view_max_moq}}">
            </div>
        </div>
        <input type="hidden" name="view" value="{{$view}}">
        <input type="submit" class="btn_green btn_clear filter-reset" value="submit" style="display: none;">
        <a class="btn_green btn_clear filter-reset" href="{{route('new.profile.products',$alias)}}" style="display: none;"> Reset </a>
    </div>
</form>


@push('js')
    <script>
        $( document ).ready(function() {
            var view_min_lead_time='{{$view_min_lead_time??$controller_min_lead_time}}';
            var view_max_lead_time='{{$view_max_lead_time??$controller_max_lead_time}}';
            var controller_max_lead_time='{{$controller_max_lead_time}}';
            var controller_min_lead_time='{{$controller_min_lead_time}}';
            $("#myRange").ionRangeSlider({
                type: "double",
                grid: true,
                min: controller_min_lead_time,
                max: controller_max_lead_time,
                from: view_min_lead_time,
                to: view_max_lead_time,
                onFinish: function (data) {
                    // Called then action is done and mouse is released
                    $('#min_lead').val(data.from);
                    $('#max_lead').val(data.to);
                    $('.filter-reset').show();
                },
            });


            var view_min_moq='{{$view_min_moq??$controller_min_moq}}';
            var view_max_moq='{{$view_max_moq??$controller_max_moq}}';
            var controller_max_moq='{{$controller_max_moq}}';
            var controller_min_moq='{{$controller_min_moq}}';
            $("#myRangeMoq").ionRangeSlider({
                type: "double",
                grid: true,
                min: controller_min_moq,
                max: controller_max_moq,
                from: view_min_moq,
                to: view_max_moq,
                onFinish: function (data) {
                    // Called then action is done and mouse is released
                    $('#min_moq').val(data.from);
                    $('#max_moq').val(data.to);
                    $('.filter-reset').show();
                },
            });

        });

        $('.filter-select').on('change', function() {
            $('.filter-reset').show();
        });
        var check_selected_val =  $( ".filter-select option:selected" ).val();
        if(check_selected_val != undefined){
            $('.filter-reset').show();
        }

        var vmlt='{{$view_min_lead_time}}';
        var vmm = '{{$view_max_moq}}';
        if(vmlt!= '' || vmm!= ''){
            $('.filter-reset').show();
        }

    </script>
@endpush
