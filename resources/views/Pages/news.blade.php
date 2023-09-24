@extends('layouts.bradecrum')
@section('title', 'News')
@section('desc', 'Leatest Products and News')
@section('contant2')

    <!-- latest news -->
    <div class="latest-news mt-150 mb-150">
        <div class="container">
            <div class="row">
                @foreach ($news as $oneNews)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="single-news.html">
                                {{-- <div class="latest-news-bg news-bg-1"></div> --}}
                                <img src="{{ asset('images/News/' . $oneNews->image) }}" alt="">
                            </a>
                            <div class="news-text-box">
                                <h3><a href="single-news.html">{{ $oneNews->title }}.</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> Admin:
                                        {{ $oneNews->admin->name }}</span>
                                    <span class="date"><i class="fas fa-calendar"></i> {{ $oneNews->created_at }}</span>
                                </p>
                                <p class="excerpt">{{ $oneNews->desc }}.</p>
                                <a href="single-news.html" class="read-more-btn">read more <i
                                        class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="pagination-wrap">
                                <ul>
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a class="active" href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end latest news -->
@endsection
