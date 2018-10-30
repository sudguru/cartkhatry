@extends('layouts.admin')

@section('pagetitle')
Edit Content Type - admin
@endsection

@section('extracss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Content Type - Edit</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('content.update', $content->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="contenttype_id">Content Type</label>
                <select id="contenttype_id" name="contenttype_id" class="form-control">
                @foreach ($contenttypes as $contenttype)
                    <option value="{{ $contenttype->id }}" {{ $contenttype->id == $content->contenttype_id  ? 'selected' : '' }}>
                        {{ $contenttype->contenttype }}
                    </option>
                @endforeach
                    
                </select>
            </div>
            
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                    value="{{ old('title') ?? $content->title }}" autofocus>

                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">
                {{ old('content') ?? $content->content }}
                </textarea>

                @if ($errors->has('content'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                    
            </div>



            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Update Content</button>
                <a class="btn btn-light btn-md" href="{{ route('content.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection

@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 150,
            toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link','picture', 'video', 'table', 'hr']],
            ['height', ['height']]
        ]
        });
    });
  </script>
@endsection