@extends('layouts.front')
@section('title', "$lng->Blog")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/blog.css">
@endsection
@section('content')
    <div class="blog__page white-bg">
        <div class="container">
            <div class="header-wrapper">
                @if ($tag)
                    <div class="tag-wrapper">{{ $lng->showingResultFor }} <span class="tag-name">"{{ $tag->name }}"</span>
                    </div>
                @else
                    <h2 class="header-title">{{ $lng->OurBlog }}</h2>
                @endif
            </div>
        </div>
        <div class="blog-section">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-md-3 col-sm-6 col-12 mb-4">
                            <div class="card blog-inner">
                                <a href="{{ route('front-blog.show', $blog->slug) }}" class="blog-img">
                                    <img class="card-img-top" src="{{ asset('images/blog/' . $blog->image) }}"
                                        alt="{{ $blog->title }}" />
                                </a>
                                <div class="card-body">
                                    <a class="card-title" href="{{ route('front-blog.show', $blog->slug) }}">
                                        {{ Str::limit($blog->title, 40, '.') }}
                                    </a>
                                    <div class="blog-meta">
                                        <a href="{{ route('front-blog.show', $blog->slug) }}">{{ $blog->commentsCount() }}
                                            {{ $lng->Comments }}</a>
                                        <span class="blog-date">{{ $blog->created_at->format('d M Y') }}</span>
                                    </div>
                                    <p class="card-text">
                                        {{ html_entity_decode(Str::limit(trim(strip_tags($blog->details)), 90, '...')) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
