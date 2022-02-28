
@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">

            <div class="products_filter_wrapper">
                <div class="row">
                    <div class="col s12 m3 left-column">
                        <div class="products_filter_list">
                            <h3>Filter by</h3>
                            <form action="" method="get" id="product_filter_form">

                                <a class='btn_green btn_clear' href=""> Reset </a>
                            </form>
                        </div>
                    </div>
                    <div class="col s12 m9 content-column">
                        <div class="show-product-results-wrapper products_filter_search_wrap">
                            <div class="filter_search">
                                <form action="" method="get">
                                    <div class="filter_search_inputbox">
                                        <i class="material-icons">search</i>
                                        <input class="filter_search_input " type="text" name="product_name" placeholder="Type product name" value="">
                                        <input class="btn_green btn_search" type="submit" value="search" onclick="">
                                    </div>
                                </form>
                            </div>
                            <div class="show-product-results-inside-wrapper">
                                <div class="show-total-results">
                                    Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}} of  {{$products->total()}} results
                                </div>
                            </div>
                        </div>
                        <div class="prodcuts-list">
                            <div class="product_wrapper">
                                <div class="product_boxwrap">
                                    <h3>Designs</h3>
                                    @include('product._products_list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection




