<div class="card-body">
    <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Certification programs :</label>
                    <input type="text" name="certification_programs" class="form-control col-sm-4" id="name" value="{{old('certification_programs', $collection->certification_programs)}}" placeholder="Enter Certification programs name">
                    @if($errors->has('certification_programs'))
                        <div class="text-danger">{{ $errors->first('certification_programs') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Provider :</label>
                    <input type="text" name="provider" class="form-control col-sm-4" id="provider" value="{{old('provider', $collection->provider)}}" placeholder="Enter provider">
                    @if($errors->has('provider'))
                        <div class="text-danger">{{ $errors->first('provider') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Nation :</label>
                    <input type="text" name="nation" class="form-control col-sm-4" id="nation" value="{{old('nation', $collection->nation)}}" placeholder="Enter nation">
                    @if($errors->has('nation'))
                        <div class="text-danger">{{ $errors->first('nation') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">About :</label>
                    <input type="textarea" name="about" class="form-control col-sm-4" id="about" value="{{old('about', $collection->certification_programs)}}" placeholder="Enter about the certification">
                    @if($errors->has('about'))
                        <div class="text-danger">{{ $errors->first('about') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="description">logo :</label>
                        <input type="file" name="logo" class="form-control col-sm-4" id="logo" onchange="readURL(this,'logo_preview')">
                        @if($errors->has('logo'))
                            <div class="text-danger">{{ $errors->first('logo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="thumbnail_img">
                        @php $img_src= $collection->logo ? asset('storage/'.$collection->logo) : 'https://via.placeholder.com/380';@endphp
                        <img src="{{$img_src}}" class="img-thumbnail" id="logo_preview">
                    </div>
                </div>

            </div>
    </div>
</div>

@push('js')
    <script>
        function readURL(input,id)
            {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('#'+id).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
    </script>
@endpush


