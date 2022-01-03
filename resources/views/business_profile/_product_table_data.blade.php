<div class="product_data_table_wrap">
    <div class="no_more_tables">
        <table class="table table-striped striped bordered responsive-table box_shadow_radius ">
            <thead class="cf">
                <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th style="text-align:center;">Code</th>
                    <th style="text-align:center;">Price</th>
                    <th style="text-align:center;">MOQ</th>
                    <th style="text-align:center;">Lead Time</th>
                    <th style="text-align:center;"></th>
                </tr>
            </thead>
            <tbody id="tbbdy">
                @foreach($products as $mk => $product)
                    <tr style="cursor: pointer;" onclick="selecttr(this);">
                        <td data-title="Category">
                            {{ $product->category->name }}
                        </td>
                        <td data-title="Product Name" style="cursor:pointer;" onClick="openviewdetails({{ $mk }}, {{ count($products) }})">
                            <span class="product_title" style="font-weight:bold; color:#55A860;">{{ $product->title }}</span>
                            <div class="clear5"></div>
                            <div class="col-md-12">
                                <div class="prd-lt-con-list">
                                    <div class="col-md-12 plr0"><h6> Colors</h6></div>
                                    <div class="col-md-12 plr0">
                                        @if(isset($product->colors))
                                            @if(in_array('Red',$product->colors))
                                                <i class="fa fa-square fa-lg red" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Blue',$product->colors))
                                                <i class="fa fa-square fa-lg blue" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Green',$product->colors))
                                                <i class="fa fa-square fa-lg green" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Black',$product->colors))
                                                <i class="fa fa-square fa-lg black" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Brown',$product->colors))
                                                <i class="fa fa-square fa-lg brown" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Pink',$product->colors))
                                                <i class="fa fa-square fa-lg pink" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Yellow',$product->colors))
                                                <i class="fa fa-square fa-lg yellow" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Orange',$product->colors))
                                                <i class="fa fa-square fa-lg orange" aria-hidden="true"></i>
                                            @endif
                                            @if(in_array('Lightblue',$product->colors))
                                                <i class="fa fa-square fa-lg lightblue" aria-hidden="true"></i>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clear5"></div>
                            <div class="col-md-12">
                                <div class="prd-lt-con-list bbn product_size">
                                    <div class="col-md-12 plr0"><h6>Sizes</h6></div>
                                    <div class="col-md-12 plr0">
                                        @if(isset($product->sizes))
                                            @foreach($product->sizes as $size)
                                                <span>{{ $size }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td data-title="Code" style="text-align:center;cursor: pointer;" onClick="openviewdetails({{ $mk }}, {{ count($products) }})">MB-{{$product->id}}</td>
                        <td data-title="Price" style="text-align:center;cursor: pointer;" onClick="openviewdetails({{ $mk }}, {{ count($products) }})">{{ $product->price_unit }} {{ $product->price_per_unit }}</td>
                        <td data-title="MOQ" style="text-align:center;cursor: pointer;" onClick="openviewdetails({{ $mk }}, {{ count($products) }})">{{ $product->moq }} {{ $product->qty_unit }}</td>
                        <td data-title="Lead Time" style="text-align:center;cursor: pointer;" onClick="openviewdetails({{ $mk }}, {{ count($products) }})">{{ $product->lead_time }}</td>
                        <td data-title="" style="text-align:center;cursor: pointer;">
                            <a class="btn_product_edit" href="javascript:void(0);" onclick="editproduct('{{ $product->id }}')">Edit</a> | <a href="javascript:void(0);" onclick="deleteProduct('{{ $product->id }}', '{{$product->business_profile_id}}')" style="color:#ff0000;">Delete</a>
                        </td>
                    </tr>
                @endforeach



            </tbody>
        </table>
    </div>
</div>

