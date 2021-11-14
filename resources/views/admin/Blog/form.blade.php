<div class="card-body">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="title">Post Title* :</label>
                <input type="text" name="title" class="form-control" id="title" value="{{old('name', $blog->title)}}" placeholder="Post Title">
                @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="details" class="col-form-label text-md-right">{{ __('details') }}</label>
                <textarea id="details" class="editor" name="details">{{old('details',$blog->details)}}</textarea>
                @if($errors->has('details'))
                    <div class="text-danger">{{ $errors->first('details') }}</div>
                @endif
            </div>
        </div>
        <div class="col-4">
            <div>
                @if($blog->feature_image)
                <img id="preview-image-for-blog" src="{{ asset('storage/'.$blog->feature_image) }}"
                    alt="preview image" style="max-height: 250px;">
                @else
                <img id="preview-image-for-blog" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                    alt="preview image" style="max-height: 250px;">
                @endif
            </div>
            <div class="form-group">
                <label for="feature_image">Feature Image :</label>
                <input id="feature_image" type="file" name="feature_image" class="form-control">
                @if($errors->has('feature_image'))
                <div class="text-danger">{{ $errors->first('feature_image') }}</div>
                @endif
            </div>
        </div>
    </div>

   
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="parent_id">Author :</label>
                <div>
                    @if($blog->author_img)
                    <img id="preview-image-for-author" src="{{ asset('storage/'.$blog->author_img) }}"
                        alt="preview image" style="max-height: 250px;">
                    @else
                    <img id="preview-image-for-author" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 250px;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="author_img">Image :</label>
                    <input id="author_img" type="file" name="author_img" class="form-control" >
                    @if($errors->has('author_img'))
                    <div class="text-danger">{{ $errors->first('author_img') }}</div>
                    @endif
                </div>
               
            </div>
        </div>

        <div class="col-8">
            <div class="form-group">
                <label for="author_name">Author Name* :</label>
                <input type="text" name="author_name" class="form-control" id="author_name" value="{{old('name', $blog->author_name)}}" placeholder="Author">
                @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="author_note" class="col-form-label text-md-right">{{ __('Author note') }}</label>
                <textarea id="author_note" class="editor" name="author_note">{{old('author_note',$blog->author_note)}}</textarea>
                @if($errors->has('author_note'))
                <div class="text-danger">{{ $errors->first('author_note') }}</div>
                @endif
            </div>
           
        </div>
    </div>

    <div class="row">
        <label>Source</label>
        <div class="sourceList">
           
                @if(isset($blog->source))
                    @foreach($blog->source as $key=>$source)
                    <div class="form-group">
                        <div class="sourceItem">
                            <div class="input-group">
                                <input type="text" class="form-control" name="source[0][name]" value="{{$blog->source[$key]['name']}}" placeholder="Name" style="max-width:300px"/>
                                <input type="url" class="form-control" name="source[0][link]" value="{{$blog->source[$key]['link']}}"  placeholder="URL" />
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info js__adder">&plus;</button>
                                <button type="button" class="btn btn-danger js__remover">&times;</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                <div class="form-group">
                    <div class="sourceItem">
                            <div class="input-group">
                                <input type="text" class="form-control" name="source[0][name]"  placeholder="Name" style="max-width:300px"/>
                                <input type="url" class="form-control" name="source[0][link]"   placeholder="URL" />
                            </div>
                        
                            <div class="btn-group">
                                <button type="button" class="btn btn-info js__adder">&plus;</button>
                                <button type="button" class="btn btn-danger js__remover">&times;</button>
                            </div>
                    </div>
                </div>
               
           
        </div>
    </div>

    <div class="row">
       <div class="col-4">
            <div class="form-group">
                <label>Photo Courtesy</label> 
                <input type="text" name="photo_credit" value="{{old('photo_credit',$blog->photo_credit)}}" class="form-control">
                @if($errors->has('photo_credit'))
                <div class="text-danger">{{ $errors->first('photo_credit') }}</div>
                @endif
            </div>
        </div>
    </div>

    

</div>

