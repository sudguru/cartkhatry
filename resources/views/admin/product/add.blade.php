@extends('layouts.admin')
@section('pagetitle')
Add New Product
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection

@section('content')


@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="container">

    <h2>Add New Product</h2>
    <form action="{{ route('product.store') }}" method="POST" autocomplete="off" novalidate class="mb-1">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                        name="name" value="{{ old('name') }}" autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" id="model"
                        name="model" value="{{ old('model') }}" autofocus>

                    @if ($errors->has('model'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('model') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">Category</label>

                    <select class="custom-select" name="category_id" id="category_id">
                        @foreach($categories as $parent)
                        <option value="{{$parent->id}}">{{$parent->category}}</option>
                        @if($parent->children)
                        @foreach($parent->children as $child)
                        <option value="{{$child->id}}"> -- {{$child->category}}</option>
                        @if($child->children)
                        @foreach($child->children as $grandchild)
                        <option value="{{$grandchild->id}}"> ---- {{$grandchild->category}}</option>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brand}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_available">Delivery Available ? <span class="required">*</span></label>
                    <select name="delivery_available" id="delivery_available" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_day_from">Delivery Day From <span class="required">*</span></label>
                    <input type="number" class="form-control"
                        id="delivery_day_from" name="delivery_day_from" value="{{ old('delivery_day_from') ?? 2 }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_day_to">Delivery Day To <span class="required">*</span></label>
                    <input type="number" class="form-control"
                        id="delivery_day_to" name="delivery_day_to" value="{{ old('delivery_day_to') ?? 5 }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_local">Delivery Charge Local <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_local" name="delivery_charge_local" value="{{ old('delivery_charge_local') ?? $setting->delivery_charge_local }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_intercity">Delivery Charge Intercity <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_intercity" name="delivery_charge_intercity" value="{{ old('delivery_charge_intercity') ?? $setting->delivery_charge_intercity }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_intl">Delivery Charge Intl <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_intl" name="delivery_charge_intl" value="{{ old('delivery_charge_intl') ?? $setting->delivery_charge_intl }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Short Description</label>
            <textarea class="form-control editor" name="description" id="description" style="height: calc(100% - 46px)">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="specification">Detailed Specification</label>
            <textarea class="form-control editor" name="specification" id="specification">
                {{ old('specification') }}
            </textarea>
        </div>

        <div class="form-footer" style="margin-top: 0; padding-top:0">
            <button type="submit" class="btn btn-primary btn-md">Save Product</button>
            <a href="{{ route('product.index') }}" class="btn btn-light btn-md">Cancel</a>
        </div><!-- End .form-footer -->
        @csrf
    </form>


    <div class="mb-2"></div><!-- margin -->


</div><!-- End .container -->


<div class="mb-5"></div><!-- margin -->



@endsection

@section('extrajs')
<script src="{{asset('/assets/js/summernote.min.js')}}"></script>
<script>
    $(document).ready(function () {


        function disable_enable(val) {
            val = val == 0 ? true : false;
            $('#delivery_day_from').prop('disabled', val);
            $('#delivery_day_to').prop('disabled', val);
            $('#delivery_charge_local').prop('disabled', val);
            $('#delivery_charge_intercity').prop('disabled', val);
            $('#delivery_charge_intl').prop('disabled', val);
        }
        
        disable_enable($('#delivery_available').val());

        $('#delivery_available').on('change', function() {
            disable_enable($(this).val());
        });

        $('#description').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']]
            ]
        });

        $('#specification').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                ['height', ['height']],
                ['fullscreen']
            ]
        });
    });

</script>


@endsection
