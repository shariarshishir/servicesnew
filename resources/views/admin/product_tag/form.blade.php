<div class="card-body admin_product_Category">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="productTag">Name :</label>
                <input type="text" name="name" class="form-control" id="productTag" value="{{old('name', $product_tag->name)}}" placeholder="Enter name">
                @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

