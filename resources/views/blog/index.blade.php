@extends('layouts.app_containerless')

@section('content')
    
    <section class="ic-press-room">
        <div class="container">
            <div class="row">

                <div class="col-md-8">

                    <div class="row">.

                        <div class="col-sm-12">
                            @foreach($blogs as $blog)
                                <div class="ic-press-left">
                                    <a href="" style="display:block"><img src="{{ asset('storage/'.$blog->feature_image) }}" class="img-responsive" alt=""></a>
                                    <div class="ic-press-caption">
                                        <h2 style="margin-bottom:10px"><a href="">{{ $blog->title }}</a></h2>
                                        <div style="margin-bottom:10px">{!! \Illuminate\Support\Str::limit(strip_tags($blog->details), 250, '(...)')  !!}</div>
                                        <a href="{{route('blogs.details',$blog->slug)}}" class="ic-btn">Read more</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm-12">
                            <div class="pagination">
                                {{ $blogs->links() }}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-md-4">
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
                </div>

            </div>
        </div>
    </section>


@endsection
