@push('js')
    <script>

    $(document).on('change', '.select-business-type', function(){
        var value =$('.select-business-type option:selected').val();
        if(value == 1){
            $('.number_of_factories').show();
            $('.number_of_outlets').hide();
        }
        else if(value == 2){
            $('.number_of_factories').hide();
            $('.number_of_outlets').show();
        }
        else{
            $('.number_of_factories').hide();
            $('.number_of_outlets').hide();
        }
    });
   //store business form data
   $('#business_profile_form').on('submit',function(e){
            e.preventDefault();
            var url = '{{ route("business.profile.store") }}';
            var formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: url,
                beforeSend: function() {
                $('.loading-message').html("Please Wait.");
                $('#loadingProgressContainer').show();
                },
                success:function(data)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#edit_errors').empty();
                        // console.log(data);
                        swal("Done!", data.msg,"success");
                        window.location.href=data.redirect_url;

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#edit_errors').empty();
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                        $("#edit_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                            $("#edit_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        });

    </script>
@endpush
