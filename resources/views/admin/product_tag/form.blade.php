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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="parent">Parent :</label>
                <select class="form-control select2" name="parent[]" multiple aria-label="multiple select example">
                    @foreach ($parent as $item)
                        <option value="{{$item['id']}}" {{$product_tag->tag_mapping_id && in_array($item['id'],$product_tag->tag_mapping_id) ? 'selected' : ''}}>{{$item['name']}}</option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <div class="text-danger">{{ $errors->first('parent') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Open this select menu',
        });
    });
</script>
@endpush
