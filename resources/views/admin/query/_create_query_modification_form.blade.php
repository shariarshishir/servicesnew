@if(auth()->guard('admin')->user()->unreadNotifications)
    @foreach (auth()->guard('admin')->user()->unreadNotifications as $notification)
        @if($notification->type == "App\Notifications\NewOrderModificationRequestNotification")
            @if($notification->data['notification_data'] == $collection->id)
               {{  $notification->markAsRead(); }}
            @endif
        @endif
    @endforeach
@endif
<form action="{{ route('query.request.store') }}" method="post" name="ordModCreateForm" id="ordModCreateForm" class="ordModCreateForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="color-and-size-block">
            <table class="color-size-table-block ord-mod-color-sizes">
                <thead>
                    <tr>
                        <th>Color</th>
                        <th>XXS</th>
                        <th>XS</th>
                        <th>Small</th>
                        <th>Medium</th>
                        <th>Large</th>
                        <th>Extra Large</th>
                        <th>XXL</th>
                        <th>XXXL</th>
                        <th>4XXL</th>
                        <th>One Size</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="ord-mod-color-tbody">
                        <tr>
                            <td><input type="text" value="" class="form-control" name="color_size[color][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[xxs][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[xs][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[small][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[medium][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[large][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[extra_large][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[xxl][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[xxxl][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[four_xxl][]" /></td>
                            <td><input type="text" value="" class="form-control count-color-size" name="color_size[one_size][]" /></td>
                        </tr>

                </tbody>
            </table>
            <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addColorSize()"><i class="fas fa-plus-circle"></i> Add More</a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group row amount-block">
        <div class="col-md-12">
            <label for="unit-price" class="col-form-label">Unit Price</label>
            <input id="unit-price" type="text" class="unit-price form-control @error('unit_price') is-invalid @enderror price-value" name="unit_price" value="{{ old('unit_price') }}"  autocomplete="unit_price" autofocus>
        </div>
        <div class="col-md-12">
            <label for="total-quantity" class="col-form-label ">Total Quantity</label>
            <input id="total-quantity" type="number" class="form-control @error('total-quantity') is-invalid @enderror" name="total_quantity" value=""  autocomplete="total-quantity" autofocus readonly>
        </div>
        <div class="col-md-12">
            <label for="discount_type" class="col-form-label ">Discount type</label>
            <select class="form-select form-control" aria-label="Default select example" name="discount_type" id="discount-type">
                <option value="">select</option>
                <option value="1">Amount</option>
                <option value="2">Persentence</option>
              </select>
        </div>
        <div class="col-md-12">
            <label for="discount" class="col-form-label ">Discount</label>
            <input id="discount" type="number" class="form-control @error('discount_amount') is-invalid @enderror" name="discount" value="{{ old('discount') }}"  autocomplete="discount_amount" autofocus>
        </div>
        <div class="col-md-12">
            <label for="discount-amount" class="col-form-label ">Discount Amount</label>
            <input id="discount-amount" type="number" class="form-control @error('discount_amount') is-invalid @enderror" name="discount_amount" value="{{ old('discount_amount') }}"  autocomplete="discount_amount" autofocus readonly>
        </div>
        <div class="col-md-12">
            <label for="total-price" class="col-form-label ">Total Price</label>
            <input id="total-price" type="number" class="form-control @error('total-price') is-invalid @enderror" name="total_price" value="{{ old('total-price') }}"  autocomplete="total-price" autofocus readonly>
        </div>
    </div>
    <div class="clearfix"></div>

   <input type="hidden" name="ord_mod_req_id" value="{{ $collection->id }}">
   <input type="hidden" name="product_sku" value="{{ $collection->product->sku }}">
   <input type="hidden" name="product_name" value="{{ $collection->product->name}}">
   <div>
       <input type="file" name="file">
   </div>
   <br>
   <button type="submit" class="btn btn-success" id="submitordModCreateForm">Submit</button>
</form>
