@extends('layouts.admin',['headerText' => $lng->CreateBlog])
@section('title', "$lng->CreateBlog")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddBlog }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('blog.store') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('blog.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="form-group">
                        <label for="">{{ $lng->Title }} *</label>
                        <input value="{{ old('title') }}" name="title" required type="text" class="form-control"
                            placeholder="{{ $lng->EnterBlogTitle }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ $lng->Slug }} *</label>
                        <input value="{{ old('slug') }}" name="slug"  type="text" class="form-control"
                            placeholder="{{ $lng->Slug }}">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="">{{ $lng->Tag }} </label>
                        <select  name="tag[]" class="select2 form-control" multiple="multiple" data-placeholder="{{ $lng->Tag }}">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ $lng->Thumbnail }} *</label>
                        <div id="imageUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="image" id="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="form-group">
                        <label for="">{{ $lng->Description }} *</label>
                        <textarea name="details" class="form-control" id="description" rows="4"></textarea>
                        @error('details')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label for="">{{ $lng->MetaTitle }} </label>
                        <input  name="meta_title"  type="text" class="form-control"
                            placeholder="{{ $lng->MetaTitle }}">
                    </div>
                     <div class="form-group">
                        <label for="">{{ $lng->MetaDescription }} </label>
                        <textarea name="meta_description" class="form-control" placeholder="{{ $lng->MetaDescription }}" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/admin/js/page/blog.js')}}"></script>
    <script>
        var fileUploadUrl="{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}";
        var removeUrl="{{ route('dropzone.remove', ['path' => 'blog']) }}";
        var dropzoneUrl="{{ route('dropzone.store', ['path' => 'blog']) }}";
    </script>
@endsection
