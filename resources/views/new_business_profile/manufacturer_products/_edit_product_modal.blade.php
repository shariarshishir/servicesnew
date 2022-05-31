<div id="product-edit-modal-block" class="modal ">
    <div class="modal-content">
        <section class="ic-buying-req">
            <div class="product_add_wrap_modal">
                <div class="row">
                    <div class="title">
                        <legend>Update</legend>
                        <span style="font-size: 12px; padding-bottom: 15px; display:block;" class="text-danger">* Indicates Mandatory field</span>
                    </div>
                </div>

                <form action="" method="post" enctype="multipart/form-data" id="manufacture-product-update-form">
                    @csrf
                    <input type="hidden" name="edit_product_id">
                        {{-- product type mapping --}}
                        <div class="input-field">
                            <div class="row">
                                <div class="col s12 m3 l3">
                                    <label for="gender">Product Type Mapping<span class="text-danger">*</span></label>
                                    <span class="text-danger error-text product_type_mapping_error rm-error"></span>
                                </div>
                                <div class="col s12 m9 l9">
                                    <div class="radio-block">
                                        <label class="radio_box">
                                            <input class="with-gap"  name="product_type_mapping" type="radio" value="1" />
                                            <span>Studio</span>
                                        </label>
                                        <label class="radio_box">
                                            <input class="with-gap" name="product_type_mapping" type="radio" value="2" />
                                            <span>Raw Materials</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row studio" style="display: none;">
                                <div class="col s12">
                                    <label>Select studio</label>
                                    <select class="select2 dropdownOptions studio-id" multiple name="studio_id[]">
                                        @php $studio_child= productTypeMapping(1); @endphp
                                        @foreach ($studio_child as $id => $title)
                                            <option value={{$id}}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text studio_id_error rm-error"></span>
                                </div>
                            </div>
                            <div class="row raw-materials" style="display: none;">
                                <div class="col s12">
                                    <label>Select raw materials</label>
                                    <select class="select2 dropdownOptions raw-materials-id" multiple name="raw_materials_id[]">
                                        @php $raw_materials_child= productTypeMapping(2); @endphp
                                        @foreach ($raw_materials_child as $id => $title)
                                            <option value={{$id}}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text raw_materials_id_error rm-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group input-field row">
                            <div class="col s12 m3 l3">
                                <label for="product_tag">Product Tags<span class="text-danger">*</span></label>
                            </div>
                            <div class="col s12 m9 l9">
                                <select name="product_tag[]" class="select2 browser-default" id="edit_product_tag" multiple>
                                    @foreach($product_tags as $product_tag)
                                        <option value="{{ $product_tag->name }}">{{$product_tag->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text product_tag_error rm-error"></span>
                            </div>
                        </div>
                    <div class="row">
                        <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="producut-title">Title <span class="text-danger">*</span></label>
                            </div>
                            <div class="col s12 m9 l9">
                                <input type="text" id="producut-title" name="title" class="form-control" placeholder="Product Title ..." >
                                <span class="text-danger error-text title_error rm-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="producut-quality">Price Range <span class="text-danger">*</span></label>
                                </div>
                                <input type="text" name="price_per_unit" id="producut-quality" class="form-control" placeholder="ex. 5.00 - 6.00" >
                                <span class="text-danger error-text price_per_unit_error rm-error"></span>
                            </div>
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="price_unit">Price Unit <span class="text-danger">*</span></label>
                                </div>
                                <select class="select2 browser-default price_unit" name="price_unit" >
                                    <option value="" selected="true" disabled>Choose your option</option>
                                    <option value="BDT">BDT</option>
                                    <option value="USD">USD</option>
                                </select>
                                <span class="text-danger error-text price_unit_error rm-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="product-moq">MOQ <span class="text-danger">*</span></label>
                                </div>
                                <input type="number" name="moq" id="product-moq" class="form-control" placeholder="Minimum Order Quantity" >
                                <span class="text-danger error-text moq_error rm-error"></span>
                            </div>
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="qty_unit">Qty Unit <span class="text-danger">*</span></label>
                                </div>
                                <select class="select2 browser-default qty_unit" name="qty_unit" >
                                    <option value="" selected="true" disabled>Choose your option</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lbs">Lbs</option>
                                    <option value="Gauge">Gauge</option>
                                    <option value="Yards">Yards</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Dozens">Dozens</option>
                                </select>
                                <span class="text-danger error-text qty_unit_error rm-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="product_colorSizw_wrap">
                        <div class="input-field row">
                            <div class="col s12 m3 l3 ">
                                <label for="product-colors">Colors <small>EXP: Red,Blue,...</small> </label>
                            </div>
                            <div class="col s12 m9 l9 product_color_box">
                                <select class="select2 browser-default product-colors" name="colors[]" id="edit_colors" multiple>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text colors_error rm-error"></span>
                            </div>
                        </div>
                        <div class="input-field row">
                            <div class="col s12 m3 l3 ">
                                <label for="product-sizes">Sizes <small>EXP: XL,XXL,...</small> </label>
                            </div>
                            <div class="col s12 m9 l9 product_size_box">
                                <select class="select2 browser-default product-sizes" name="sizes[]" id="edit_sizes"  multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text sizes_error rm-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3">
                            <label for="product-desc">Product Details <span class="text-danger">*</span></label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <textarea name="product_details" id="edit-description" class="form-control editor" cols="30" rows="10" placeholder="Product Details" ></textarea>
                            <span class="text-danger error-text product_details_error rm-error"></span>
                        </div>

                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3 ">
                            <label for="product-spec">Full specification <span class="text-danger">*</span></label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <textarea name="product_specification" id="edit_full_specification" class="form-control editor" cols="30" rows="10" placeholder="Full Specification" ></textarea>
                            <span class="text-danger error-text product_specification_error rm-error"></span>
                        </div>
                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3 ">
                            <label for="lead_time">Lead time (days) <span class="text-danger">*</span></label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <input type="text" name="lead_time" id="lead_time" class="form-control negitive-or-text-not-allowed" placeholder="days" >
                            <span class="text-danger error-text lead_time_error rm-error"></span>
                        </div>
                    </div>
                     {{-- gender --}}
                    <div class="row input-field ">
                        <div class="col s12 m3 l3">
                            <label for="gender">Gender<span class="text-danger">*</span></label>
                            <span class="text-danger error-text gender_error rm-error"></span>
                        </div>
                        <div class="col s12 m9 l9">
                            <div class="radio-block">
                                <label class="radio_box">
                                    <input class="with-gap" name="gender" type="radio" value="1" />
                                    <span>Male</span>
                                </label>
                                <label class="radio_box">
                                    <input class="with-gap" name="gender" type="radio" value="2" />
                                    <span>Female</span>
                                </label>
                                <label class="radio_box">
                                    <input class="with-gap" name="gender" type="radio" value="3" />
                                    <span>Unisex</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- sample availability --}}
                    <div class="row input-field ">
                        <div class="col s12 m3 l3">
                            <label for="sample_availability">Sample Availability <span class="text-danger">*</span></label>
                            <span class="text-danger error-text sample_availability_error rm-error"></span>
                        </div>
                        <div class="col s12 m9 l9">
                            <div class="radio-block">
                                <label class="radio_box">
                                    <input class="with-gap" name="sample_availability" type="radio" value="1" />
                                    <span>Yes</span>
                                </label>
                                <label class="radio_box">
                                    <input class="with-gap" name="sample_availability" type="radio" value="0" checked/>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="product_media_wrap">
                        <div class="input-field">
                            <div class="s12">
                                <label for="product-upload">Media <span class="text-danger">*</span></label>
                                <span class="text-danger error-text product_images_error rm-error"></span>
                            </div>
                            <div class="row center-align media-list" style="padding-top: 25px;">

                            </div>

                            <div class="input-field">
                                {{--<input type="file" id="files" name="product_images[]" multiple class="form-control"/>--}}
                            </div>
                        </div>

                    </div><br>
                    <div class="overlay-image-div">
                        <div class="row input-field product-upload-block">
                            <div class="col s12 m3 l3">
                                <label class="active">Overlay Image:</label>
                            </div>
                            <div class="col s12 m9 l9" id="lineitems">
                                <div class="overlay-image-preview-block">
                                    <img class="overlay-image-preview"  src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                    alt="preview image" style="max-height: 100px; margin-bottom: 10px">
                                </div>
                                <input class="uplodad_video_box overlay-image" type="file" name="overlay_image">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row input-field product-upload-block">
                        <div class="col s12 m3 l3">
                            <label class="active">Video:</label>
                        </div>
                        <div class="col s12 m9 l9" id="lineitems">
                            <input class="uplodad_video_box" type="file" name="video">
                        </div>
                    </div> --}}

                    <div class="row input-field edit-video-show-div" style="display: none;">
                        <div class="col s12 m3 l3">
                            <label class="active">Video: </label>
                        </div>
                        <div class="col s12 m9 l9">
                            <div class="edit-video-show-block">

                            </div>
                        </div>
                    </div>

                    <div class="row input-field edit-video-upload-block">
                        <div class="col s12 m3 l3">
                            <label class="active">Video:</label>
                        </div>
                        <div class="col s12 m9 l9" id="lineitems">
                            <input class="uplodad_video_box" type="file" name="video">
                        </div>
                    </div>
                    <input type="hidden" name="remove_video_id"  value="">

                    <div id="manufacture-update-errors" class="validaiton-errors" style="display: none;"></div>

                    <!-- <div class="submit_wrap right-align">
                        <button type="submit" class="btn_green btn waves-effect waves-light green seller_product_create">Save</button>
                        <button type="button" class="btn_green btn modal-close waves-effect waves-light green btn-back-to-product-list">Cancel</button>
                    </div> -->
                    <div class="submit_btn_wrap">
                        <div class="row">
                            <div class="col s12 m6 l4 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                            <div class="col s12 m6 l8 right-align">
                                <button type="submit" class="btn_green  seller_product_create">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <!-- <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div> -->

</div>

@push('js')
    <script>


    //add more video
    var  lineitemcontent= '<input type="file" name="videos[]"><p onclick="removeVideoEl(this);">Remove</p>';
    function addMoreVideo(obj)
        {
            $(obj).parent().append(lineitemcontent);
            // $('#lineitems').append(lineitemcontent);
        }

    function removeVideoEl(el)
    {
        $(el).prev('input').remove();
        $(el).remove();
    }


    $(document).ready(function () {

    // //Transforms the listbox visually into a Select2.
    // $("#lstColors").select2({
    //     placeholder: "Select a Color",
    //     width: "200px"
    // });

    //Initialize the validation object which will be called on form submit.
    var validobj = $("#manufacture-product-upload-form").validate({
        onkeyup: false,
        errorClass: "myErrorClass",

        //put error message behind each form element
        errorPlacement: function (error, element) {
            var elem = $(element);
            error.insertAfter(element);
        },

        //When there is an error normally you just add the class to the element.
        // But in the case of select2s you must add it to a UL to make it visible.
        // The select element, which would otherwise get the class, is hidden from
        // view.
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
        },

        //When removing make the same adjustments as when adding
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        }
    });

    //If the change event fires we want to see if the form validates.
    //But we don't want to check before the form has been submitted by the user
    //initially.
    $(document).on("change", ".select2-offscreen", function () {
        if (!$.isEmptyObject(validobj.submitted)) {
            validobj.form();
        }
    });

    //A select2 visually resembles a textbox and a dropdown.  A textbox when
    //unselected (or searching) and a dropdown when selecting. This code makes
    //the dropdown portion reflect an error if the textbox portion has the
    //error class. If no error then it cleans itself up.
    $(document).on("select2-opening", function (arg) {
        var elem = $(arg.target);
        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("myErrorClass")) {
            //jquery checks if the class exists before adding.
            $(".select2-drop ul").addClass("myErrorClass");
        } else {
            $(".select2-drop ul").removeClass("myErrorClass");
        }
    });
    });

    $(document).on('change','input[name=product_type_mapping]',function(){
        if ($(this).val() == 1) {
            $('.studio').show();
            $('.raw-materials').hide();

        }else if ($(this).val() == 2){
            $('.studio').hide();
            $('.raw-materials').show();
        }

    });

    </script>
@endpush
