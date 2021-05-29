@extends('layouts.front')
@section('title', $blog->title)
@section('meta')
    <meta name="title" content="{{ $blog->meta_title }}">
    <meta name="details" content="{{ $blog->meta_description }}">
    <meta property="og:title" content="{{ $blog->meta_title }}">
@endsection
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/single-blog.css">
@endsection
@section('content')
    <div class="single__blog__page white-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="row pt-20">
                        <div class="col-lg-9 ">
                            <h2 class="blog-heading">
                                {{ $blog->title }}
                            </h2>
                            <div class="date-comment">
                                <span class="blog-date">{{ $blog->created_at->format('d M Y') }}</span>
                                <span class="total-comments">{{ $blog->comments->count() }} Comments</span>
                            </div>
                            <div class="blog-desc">
                                {!! $blog->details !!}
                            </div>
                            <div class="post-comment">
                                <div class="section-title">
                                    <span>{{ $lng->PostAComment }}</span>
                                </div>
                                @auth
                                    <form method="post" action="{{ route('blog.comment', $blog->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <textarea required name="text" cols="100" class="form-control" rows="3"
                                                placeholder="Your Comment ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="default-btn submit-btn" type="submit">Post</button>
                                        </div>
                                    </form>
                                @else
                                    <a class="default-btn login-button login-modal"> Login</a>
                                    <span class="login-comment">{{ $lng->PleaseLoginToComment }}</span>
                                @endauth
                            </div>
                            <div class="comments-section">
                                <div class="comments-header">
                                    <div class="section-title"><span>{{ $lng->Comments }}({{ $blog->comments->count() }})</span>
                                    </div>
                                    <div class="share-section">
                                        <span class="text">{{ $lng->Share }}</span>
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_pinterest"></a>
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($blog->comments as $comment)
                                    <div class="comment-wrapper">
                                        <div class="thumb">
                                            <img onerror="this.onerror=null;this.src='{{ asset('images/avatar.png') }}'"
                                                src="{{ $comment->user->getImageUrl() }}" alt="" />
                                        </div>
                                        <div class="comment-details">
                                            <span class="name">{{ $comment->user->name }}</span>
                                            <p class="comment">{{ $comment->text }}</p>
                                            <div class="reply-date">
                                                @auth
                                                    <span onclick="showReplyContainer({{ $comment->id }},this)"
                                                        class="reply-button">{{ $lng->Reply }}</span>
                                                @else
                                                    <span class="reply-button login-modal">{{ $lng->Reply }}</span>
                                                @endauth
                                                <span class="date-time">&mid; {{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="reply-container">
                                                @auth
                                                    <div class="reply-form hide" id="reply-container{{ $comment->id }}">
                                                        <form class="mb-3 " method="post"
                                                            action="{{ route('blog.comment.reply', $comment->id) }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <textarea required name="text" cols="100" class="form-control" rows="3"
                                                                    placeholder="Your Reply ..."></textarea>
                                                            </div>
                                                            <button class="default-btn submit-btn">Reply</button>
                                                        </form>
                                                    </div>
                                                @endauth
                                                @foreach ($comment->replies as $reply)
                                                    <div class="reply-wrapper">
                                                        <div class="thumb">
                                                            <img onerror="this.onerror=null;this.src='{{ asset('images/avatar.png') }}'"
                                                                src="{{ $reply->user->getImageUrl() }}" alt="" />
                                                        </div>
                                                        <div class="reply-details">
                                                            <span class="name">{{ $reply->user->name }}</span>
                                                            <p class="comment">{{ $reply->text }}</p>
                                                            <span class="date-time">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-3 post-section">
                            <div class="latest-post">
                                <h4 class="section-title">{{ $lng->LatestPosts }}</h4>
                                @foreach ($latestBlogs as $bl)
                                    <a href="{{ route('front-blog.show', $bl->slug) }}" class="post-card">
                                        <div class="post-thumb">
                                            <img src="{{ asset('images/blog/' . $bl->image) }}" alt="" />
                                        </div>
                                        <div class="post-details">
                                            <p class="headlines">{{ Str::limit($bl->title, 40, '.') }}</p>
                                            <span class="post-date">{{ $bl->created_at->format('d M y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="popular-post">
                                <h4 class="section-title">{{ $lng->PopularPosts }}</h4>
                                @foreach ($popularBlogs as $bl)
                                    <a href="{{ route('front-blog.show', $bl->slug) }}" class="post-card">
                                        <div class="post-thumb">
                                            <img src="{{ asset('images/blog/' . $bl->image) }}" alt="" />
                                        </div>
                                        <div class="post-details">
                                            <p class="headlines">
                                                {{ Str::limit($bl->title, 40, '.') }}
                                            </p>
                                            <span class="post-date">{{ $bl->created_at->format('d M y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="blog-tags">
                                <h4 class="section-title">{{ $lng->Tags }}</h4>
                                @foreach ($tags as $tag)
                                    <a href="{{ route('blog') }}?tag={{ $tag->name }}" class="tag">
                                        {{ $tag->name }}({{ $tag->blogs->count() }})
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pageScripts')
    <script>
        function showReplyContainer(id, el) {
            $("#reply-container" + id).removeClass("hide");
        }
    </script>
    <script src="{{ asset('front/js/vendor/addtoany.js') }}"></script>
@endsection
