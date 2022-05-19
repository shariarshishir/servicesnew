@push('js')

    <script type="text/javascript">
        // var path = "{{ route('get.supplier.location.data') }}";
        // $('input.typeahead').typeahead({
        //     source:  function (query, process) {
        //     return $.get(path, { query: query }, function (data) {
        //             return process(data);
        //         });
        //     }
        // });

    // $(document).ready(function(){
    //     $.ajax({
    //         type:'get',
    //         url:'{{route("get.supplier.location.data")}}',
    //         success:function(response){
    //             var custArray=response;
    //             var dataCust={};
    //             var dataCust2= {};
    //             for(var i= 0; i< custArray.length; i++){
    //                console.log(custArray[i]);
    //             }
    //             $('input#search-location').autocomplete({
    //                 data:response,
    //             });
    //         }
    //     })
    // });

    $(document).ready(function(){
        $(".view_more_factory_type_trigger").click(function(){
            $(this).hide();
            $(this).closest(".factory_type_checkbox").children(".view_less_factory_type_trigger").show('slow');
            $(this).closest(".factory_type_checkbox").children('p:nth-child(n+6)').show('slow');
        });
        $(".view_less_factory_type_trigger").click(function(){
            $(this).hide();
            $(this).closest(".factory_type_checkbox").children(".view_more_factory_type_trigger").show('slow');
            $(this).closest(".factory_type_checkbox").children('p:nth-child(n+6)').hide('slow');
        });
    })

    </script>
@endpush
