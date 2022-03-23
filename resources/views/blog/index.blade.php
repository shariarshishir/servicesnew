@extends('layouts.app_containerless')

@section('content')
    
    <section class="ic-press-room blog_container">
        <div class="container">
            <div class="page_content_wrap">
                <h2 class="mainTitle">Blogs</h2>
                <div class="row blog_info_wrap ">
                    @foreach($blogs as $blog)
                        <div class="ic-press-left col s12 m6 l4">
                            <div class="blog_content_box">
                                <div class="blog_imgbox"><a href="{{route('blogs.details',$blog->slug)}}" style="display:block"><img src="{{ asset('storage/'.$blog->feature_image) }}" class="img-responsive" alt=""></a></div>
                                
                                <!-- <div class="ic-press-caption blog_inner_box"> -->
                                    <!-- <div class="rating_wrap">
                                        <span> <i class="material-icons">grade</i> Top Story </span>
                                        <span class="ratting_time">7 min read</span>
                                    </div> -->

                                    <!-- <h3><a href="{{route('blogs.details',$blog->slug)}}">{{ $blog->title }}</a></h3> -->
                                    <!-- <div class="blog_info_box_wrap" style="display: none" >
                                        <div class="blog_info_details" >{!! \Illuminate\Support\Str::limit(strip_tags($blog->details), 250, '(...)')  !!}</div>
                                        <a href="{{route('blogs.details',$blog->slug)}}" class="ic-btn">Read more</a>
                                    </div> -->

                                    <!-- <div class="blog_review_wrap">
                                        <span class="blog_views"> <i class="material-icons"> visibility </i> 177 views</span>
                                        <span class="blog_likes"> <i class="material-icons"> favorite </i> 95 likes</span>
                                        <span class="blog_comments"> <i class="material-icons"> comment </i> 33 comments</span>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <a href="{{route('blogs.details',$blog->slug)}}" class="ic-btn"><div class="overlay">&nbsp;</div></a> -->
                            </div>
                            <div class="blog_info_box_wrap">
                                <h3><a href="{{route('blogs.details',$blog->slug)}}">{{ $blog->title }}</a></h3>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="pagination blog_pagination">
                    {{ $blogs->links() }}
                </div>

                <!-- <div class="col-md-4">
                    <div class="ic-press-room-right-col">
                        <div class="top2 ic-inner-pr-rc" style="background-image:url('{{ asset('images/supplier-membership.jpeg') }}')">
                            <div class="ic-caption">
                            {{--  <h3>Best sell</h3>
                                <p>In this week</p> --}}
                            <a href="{{ url('/supplier-membership') }}" class="ic-btn">Join Now</a>
                            </div>
                        </div>
                        <div class="small ic-inner-pr-rc" style="background-image:url('{{ asset('images/rfq-submit.jpeg') }}')">
                            <div class="ic-caption">
                                {{-- <p>Trending</p>
                                <p>Fashion</p> --}}
                                <a href="{{ url('/create-rfq') }}" class="ic-btn">Submit RFQ</a>
                            </div>
                        </div>
                    </div>
                </div> -->


            </div>
        </div>
    </section>


@endsection
