@extends('layouts.admin')

@section('pagetitle')
Add New Banner - admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner Links - Edit</h2>

</div>
{{$errors}}
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('banner.update', $banner->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}

            @php
            if(old('bannertype_id')):
                $selectedBannerTypeId = old('bannertype_id');
            else:
                $selectedBannerTypeId = $banner->bannertype_id;
            endif
            @endphp
            <div class="form-group">
                <label for="bannertype_id">Banner Type <span class="required">*</span></label>
                <select id="bannertype_id" name="bannertype_id" class="form-control{{ $errors->has('bannertype_id') ? ' is-invalid' : '' }}">
                    <option value="0" data-nt="1" data-nst="1">Select Banner Position</option>
                    @foreach ($bannertypes as $bannertype)
                    <option value="{{ $bannertype->id }}" data-nt="{{ $bannertype->needsTitle }}" data-nst="{{ $bannertype->needsSubtitle }}"
                        {{ $bannertype->id == $selectedBannerTypeId  ? 'selected' : '' }}
                        >
                        {{ $bannertype->bannertype }}
                    </option>
                    @endforeach

                </select>
                @if ($errors->has('position'))
                
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                    value="{{ old('title') ?? $banner->title }}" autofocus>

                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>




            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Banner</button>
                <a class="btn btn-light btn-md" href="{{ route('banner.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
