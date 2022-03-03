@push('js')


<script>

    //logo
     $('.business-profile-logo-upload-trigger').click(function(){
        $(this).next().children(".business-profile-upload-trigger-alias").click();
    })

    var previousImageSrc = "@php echo $business_profile->business_profile_logo ?? 'images/frontendimages/no-image.png'; @endphp";

   $('#business-profile-logo-upload-form').submit(function(e) {
       e.preventDefault();
      // console.log(previousImageSrc);
       let formData = new FormData(this);
       //console.log(formData);
       $('#business-profile-logo-upload-error').text('');

       swal({
            title: "Want to update business profile logo ?",
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
                    url: "{{route('business.profile.logo.create.update')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response) {
                        swal(response.message);
                        $('.business-profile-logo-upload-button').hide();
                        this.reset();
                        var image="{{asset('storage/')}}"+'/'+response.business_profile.business_profile_logo;
                        $(".business_profile_logo img").attr('src', image);

                        }
                    },
                    error: function(response){
                        swal(response.responseJSON.message);
                        //$('#business-profile-logo-upload-error').text(response.responseJSON.message);
                    }
                });
            }
            else {
                var image="{{asset('storage/')}}"+'/'+previousImageSrc;
                $(".business_profile_logo img").attr('src', image);
                $('.business-profile-logo-upload-button').toggle();
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    });

    $(document).ready(function (e) {
       $('#business-profile-logo-input').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('.business_profile_logo img').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $('.business-profile-logo-upload-button').toggle();
       });

    });


    //banner
    $('.business-profile-banner-upload-trigger').click(function(){
        $(this).next().children(".business-profile-banner-upload-trigger-alias").click();
    })

    var previousBannerSrc = "@php echo $business_profile->business_profile_banner ?? 'images/frontendimages/new_layout_images/profile-banner-update.png'; @endphp";

   $('#business-profile-banner-upload-form').submit(function(e) {
       e.preventDefault();
      // console.log(previousImageSrc);
       let formData = new FormData(this);
       //console.log(formData);
       $('#business-profile-banner-upload-error').text('');

       swal({
            title: "Want to update business profile banner ?",
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
                    url: "{{route('business.profile.banner.create.update')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response) {
                        swal(response.message);
                        $('.business-profile-banner-upload-button').hide();
                        this.reset();
                        var image="{{asset('storage/')}}"+'/'+response.business_profile.business_profile_logo;
                        $(".banner_overlay").css('background', image);

                        }
                    },
                    error: function(response){
                        swal(response.responseJSON.message);
                        //$('#business-profile-logo-upload-error').text(response.responseJSON.message);
                    }
                });
            }
            else {
                var image="{{asset('storage/')}}"+'/'+previousBannerSrc;
                $(".banner_overlay").css({"background" : "url(" + image + ")", "background-size": "cover"});
                $('.business-profile-banner-upload-button').toggle();
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    });

    $(document).ready(function (e) {
       $('#business-profile-banner-input').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          //$('.business_profile_banner img').attr('src', e.target.result);
          $(".banner_overlay").css({"background" : "url(" + e.target.result + ")", "background-size": "cover"});
        }
        reader.readAsDataURL(this.files[0]);
        $('.business-profile-banner-upload-button').toggle();
       });

    });

</script>

@endpush
