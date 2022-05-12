@extends('layouts.app_containerless')
@section('title', $blog->metaInformation->meta_title ?? '')
@section('description', $blog->metaInformation->meta_description ?? '')
@section('image', Storage::disk('s3')->url('public/images/'.$blog->metaInformation->meta_image) ?? '')
@section('keywords', 'Industry Blogs')
@section('robots', 'index, nofollow')

@section('content')
<section class="ic-press-room blog_container">
        <div class="container">

        <div itemscope itemtype="http://schema.org/BlogPosting" class="page_content_wrap blog_detail_info_wrap">

            <div class="ic-press-left ">
                <div class="feature_img center-align">
                    <img src="{{Storage::disk('s3')->url('public/images/'.$blog->feature_image)}}" class="img-responsive" alt="Missing" itemprop="image" />
                </div>
                
                <div class="ic-press-caption">
                    <h2 itemprop="name">{{ $blog->title }}</h2>
                    <meta itemprop="description" content="{!! $blog->metaInformation->meta_description ?? '' !!}">
                    <div class="blog_details_textbox">{!! $blog->details !!}</div>

                    @if(count($blog->sourcedata) > 0)
                    <div>
                        <h4 style="margin-bottom:10px">Source:</h4>
                        <ul style="padding-left:40px;list-style:initial;">
                            @foreach($blog->sourcedata as $item)
                            <li style="margin-bottom:5px;">
                                @if($item['link'] != "")
                                    <a href="{{ $item['link'] }}" target="_blank" style="text-decoration:underline"><i>{{ $item['name'] }}</i></a>
                                @else
                                    <i>{{ $item['name'] ?? '' }}</i>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    @if(!empty($blog->photo_credit))
                        <p style="margin:10px 0"><b>Photo Courtesy:</b> <i>{{ $blog->photo_credit }}</i></p>
                    @endif
                </div>
            </div>

            @if(!empty($blog->author_name))
            <div class="col-sm-12 col-md-6" style="margin-bottom:30px">
                <div class="mymedia">
                    <img class="mymedia-thum" src="@if(!empty($blog->author_img)){{Storage::disk('s3')->url('public/images/'.$blog->author_img)}} @else {{ 'https://via.placeholder.com/100' }} @endif" class="mr-3" alt="{{ $blog->author_name }}">
                    <div class="mymedia-body">
                        <h5 class="mt-0" itemprop="author">by <strong>{{ $blog->author_name }}</strong></h5>
                        <p>{!! $blog->author_note !!}</p>
                    </div>
                </div>
            </div>
            @endif


            <div class=" blog_details_social_wrap {{ !empty($blog->author_name) ? 'col-md-6' : '' }}">
                <div class="ic-pagination" style="color:black;">
                    
                </div>
                <div id="social-links" >
                    <ul>
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ env('APP_URL') }}" class="social-button " id=""><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ env('APP_URL') }}" class="social-button " id=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/share?url={{ env('APP_URL') }}" class="social-button " id=""><i class="fab fa-google-plus"></i></a></li>
                        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ env('APP_URL') }}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://wa.me/?text={{ env('APP_URL') }}" class="social-button " id=""><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>

            <!--<div id="social-links">-->
            <!--    <ul>-->
            <!--        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://merchantbay.com" class="social-button " id=""><i class="fab fa-facebook"></i></a></li>-->
            <!--        <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://merchantbay.com" class="social-button " id=""><i class="fab fa-twitter"></i></a></li>-->
            <!--        <li><a href="https://plus.google.com/share?url=http://merchantbay.com" class="social-button " id=""><i class="fab fa-google-plus"></i></a></li>-->
            <!--        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://merchantbay.com&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><i class="fab fa-linkedin"></i></a></li>-->
            <!--        <li><a href="https://wa.me/?text=http://merchantbay.com" class="social-button " id=""><i class="fab fa-whatsapp"></i></a></li>-->
            <!--    </ul>-->
            <!--</div>-->

            <div class="col-sm-12">
                <div class="ic-pagination">
                    {{-- {{ $blog_posts->links('pagination.blog') }} --}}
                </div>
            </div>

            </div>
            
        </div>
    </section>
@endsection
