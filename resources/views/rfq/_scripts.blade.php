@push('js')
<script>

    $('.createRfqForm').on('submit',function(e){
        e.preventDefault();
        var url = 'http://192.168.68.148:8888/api/quotation';
        // var formData = new FormData($('.createRfqForm')[0]);
        // console.log(formData);

        var formData = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        var files = [];
        for (let i = 0; i < $('input[type="file"]').length; i++) {
            formData.append("files", $('input[type="file"]')[i].files[0]);
        }
        formData.append("rfq_from", 'service');
        
        
        var other_data = $('.createRfqForm').serializeArray();
        $.each(other_data,function(key,input){
            formData.append(input.name,input.value);
        });
        formData.append('_token', "{{ csrf_token() }}");
        $.ajax({
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            enctype: 'multipart/form-data',
            url: url,
            headers: { 'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNjUxNTU2NzMxLCJqdGkiOiI4NzgyMTgyOTE3Yjc0YmVkYWM3ZTYwMzRjOTJlY2MyZiIsInVzZXJfaWQiOjEsImNvbXBhbnlfaWQiOjEsImlzX2FkbWluIjp0cnVlLCJ1c2VyX25hbWUiOiJUeWxlciBEZWxhY3J1eiIsInVzZXJfdHlwZSI6Im1lcmNoYW5kaXNlciIsImlkIjoxLCJuYW1lIjoiVHlsZXIgRGVsYWNydXoiLCJlbWFpbCI6ImthZGVyQGdtYWlsLmNvbSIsInBob25lIjoiKzEgKDM1NSkgOTk5LTQyMjUifQ.GfN-71tTqx9rlrD77P-C5zbLBubVaTCNjkb6newyiLOiSunPWjMOC-qQs3e_iTqFXpMD8d7XEetG1qmjjCpU3USMJkCfmDsLNe-HIbDFZyU_tsoJHNL0iLdfoP5J7lmuHOLoF6w-d7VcAblC5H5iwmJQH9Z2sYSSg2iZP8TNTCbgQGRNMWFTaumxS4UaPKsKUdiBgig2Ld3e4uH_-shVy5VperH9pqCbl40gKaSGd5UEsmvIdZLH5d_9FbE0G6-Fr40mmcI688JgIIlFqJNP25Xq23nNjpSavHCZljG3DyhpVwOF0gXhOD16tES6UlhSn4mjd_5DfQurmFoBoE39YccyaPXNMKnAOR76eSK9Ad7Tyhl30bfM6k-5ake8zb0fyryVM6VHXSyhV65njulqm4zXhleNq1zB6ZImTdLjNrYSg-s9adt_9lhp7K3a1sMvQ1T_I0efAQdQ6-dXBiQqgcIhkAehI5ipTtYPPw-JLlOAlszIYtQ4wPnbce6vGP9re6q8viK9rTK1B_AUh-TIomYNcN3dlUJWZxZ4myh3TqWGsuDBxVYod4-ERLDVyIIJ9nxL9wk9FiwI5GTTGzlAg4OeG8_VkE58rjudX3lZHBFvVzmwsEDUG9-5H58Es8XxbRPagmUkUakzLjm4Bx7C4zFDsyxQtFk-6r6gscWZavM' },
            beforeSend: function() {
            $('.loading-message').html("Please Wait.");
            $('#loadingProgressContainer').show();
            },

        success:function(response){
            $('.loading-message').html("");
            $('#loadingProgressContainer').hide();
            
        },
        error: function(xhr, status, error)
                {
                    // $('#association-membership-upload-errors').empty();
                    // $("#association-membership-upload-errors").append("<div class=''>"+error+"</div>");
                    // $.each(xhr.responseJSON.error, function (key, item)
                    // {
                    //     $("#association-membership-upload-errors").append("<div class='danger'>"+item+"</div>");
                    // });
                }
        });
        });

        //create bid rfq
        function openBidRfqModal(id){
            var rfq_id=id;
            var url = '{{ route("rfq.bid.create", ":slug") }}';
            url = url.replace(':slug', rfq_id);
            $.ajax({
                    method: 'get',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url,
                    beforeSend: function() {
                    $('.loading-message').html("Please Wait.");
                    $('#loadingProgressContainer').show();
                    },
                    success:function(data)
                        {
                            //console.log(data);
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();

                            $('#rfq-bid-modal').modal('open');
                            $('#rfq-bid-form')[0].reset();
                            $('#rfq-bid-modal .rfq-replay-submit').prop("disabled", false);
                            $('#rfq-bid-modal input[name=rfq_id]').val(data.data.id);
                            $('#rfq_bid_store_errors').empty();
                            $('#rfq-bid-modal .rfq-replay-submit').show();

                            $('#my_business_list').html('');
                            $.each(data.my_business, function (i, item) {
                                    $('#my_business_list').append($('<option>', {
                                        value: item.id,
                                        text : item.business_name
                                    }));
                            });
                            if(data.hasOwnProperty('bid')){
                                $('#my_business_list').val(data.bid.business_profile_id);
                                $('#my_business_list').trigger('change');
                                tinymce.get("product-bidding-desc").setContent(data.bid.description);
                                $('#rfq-bid-modal input[name=unit_price]').val(data.bid.unit_price);
                                // $('#rfq-bid-modal .rfq-replay-submit').prop("disabled", true);
                                  $('#rfq-bid-modal .rfq-replay-submit').hide();

                            }

                        },

                    error: function(xhr, status, error)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();

                            // $('#errors').empty();
                            // $("#errors").append("<li class='alert alert-danger'>"+error+"</li>")
                            $.each(xhr.responseJSON.error, function (key, item)
                            {
                                swal("Done!",item,"error");
                                // $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                            });

                        }
                });

        }

        //store bid rfq

        function validateWordsLength() {
            var max = 1;
            var theEditor = tinymce.activeEditor;
            var wordCount = theEditor.plugins.wordcount.getCount();
            if(wordCount == 0){
                $('#rfq-bid-form .validation-error-description').text('Short description required');
                return false;
            }else{
                $('#rfq-bid-form .validation-error-description').text(' ');
            }
            if (wordCount > max) {
                alert("Short description Maximum " + max + " words allowed.your given words length is "+wordCount + "")
                return false;
            }
            return;
        }

        function validateUnitPrice(){
            var unit_value= $('#rfq-bid-modal input[name=unit_price]').val().length;
            if(unit_value == 0){
                $('#rfq-bid-form .validation-error-unit-price').text('Unit price required');
                return false;
            }else{
                $('#rfq-bid-form .validation-error-unit-price').text('');
            }
            return;
        }
        $('#rfq-bid-form').on('submit',function(e){
            e.preventDefault();
            var unit_value= $('#rfq-bid-modal input[name=unit_price]').val().length;
            if(unit_value == 0){
                $('#rfq-bid-form .validation-error-unit-price').text('Unit price required');
                return false;
            }else{
                $('#rfq-bid-form .validation-error-unit-price').text('');
            }

            var max = 50;
            var theEditor = tinymce.activeEditor;
            var wordCount = theEditor.plugins.wordcount.getCount();
            if(wordCount == 0){
                $('#rfq-bid-form .validation-error-description').text('Short description required');
                return false;
            }else{
                $('#rfq-bid-form .validation-error-description').text(' ');
            }
            if (wordCount > max) {
                alert("Short description Maximum " + max + " words allowed.your given words length is "+wordCount + "")
                return false;
            }

            tinyMCE.triggerSave();
            var formData = new FormData(this);
            var url = '{{ route("rfq.bid.store") }}';
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
                        $('#rfq_bid_store_errors').empty();
                        $('#rfq-bid-modal').modal('close');
                        var rfq_id=$('#rfq-bid-modal input[name=rfq_id]').val();
                        var res_count=$(".res_count_"+rfq_id+"_").text();
                            res_count=parseInt(res_count);
                        $(".res_count_"+rfq_id+"_").text(res_count+1);
                        $(".res_count_"+rfq_id+"_").closest('.responses_wrap').find('.bid_rfq').text('Replied');
                        swal("Done!", data.msg,"success");

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#rfq_bid_store_errors').empty();
                        $("#rfq_bid_store_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            $("#rfq_bid_store_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        });

        $(document).ready(function(){
            $(".btn_view_detail").click(function(e){
                $(this).toggleClass("rfq_view_detail_info_open");
                $(this).next(".rfq_view_detail_info").slideToggle('slow');

                if($(this).text() == 'Show More')
                {
                    $(this).text('Show Less');
                }
                else
                {
                    $(this).text('Show More');
                }

            });
        });

        $(document).ready(function(){
            $(".btn_responses_trigger").click(function(){
                $(this).next(".respones_detail_wrap").toggle();
            });
        });

        $('.btn_view_detail').on('click',function(event){
            event.preventDefault();
            console.log('hi');
            let rfqId = $(this).attr("data-rfqId");

            let obj=$(this).closest('span');


            $.ajax({
                type:'GET',
                url: "{{route('notification-mark-as-read')}}",
                data:{ rfqId: rfqId},
                success: function (data) {
                    $('.noticication_counter').text(data['noOfnotification']);
                    obj.remove();
                }
            });
        });

        //open share model
        function openShareModel(id){
            var rfq_id=id;
            var url = '{{ route("rfq.share", ":slug") }}';
            url = url.replace(':slug', rfq_id);
            $.ajax({
                    method: 'get',
                    url: url,
                    beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                    },
                    success:function(data)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            $('#share-modal').modal('open');
                            $('#share-modal input[name=share_text]').val();
                            $('#share-modal input[name=share_text]').val(data.link);
                        },

                    error: function(xhr, status, error)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            swal("Done!",xhr.responseJSON.error,"error");
                        }
            });
        }
</script>
@endpush
