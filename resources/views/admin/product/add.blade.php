@extends('layouts.admin')
@section('pagetitle')
Add New Product
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
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
                <label for="paymentmanagedby">Payment Managed By</label>
                <select name="paymentmanagedby" id="paymentmanagedby" class="form-control">
                    <option value="KhatryOnline.com" selected>KhatryOnline.com</option>
                    <option value="Self">Self</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-4">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brand}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="manufactured_in">Manufactured In</label>
                <select name="manufactured_in" id="manufactured_in" class="form-control">
                    @foreach($countries as $country)
                    <option value="{{$country->name}}" {{ trim($country->name) == 'China' ? 'selected' : ''}}>{{$country->name}}</option>
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

        <div class="row">
                <div class="col-md-4">
                    <strong><span style="color: #999">Primary Currency</span></strong>
                    <select name="primarycurrency" class="form-control">
                        <option value="AUD">AUD - Australian Dollar</option>
                        <option value="CAD">CAD - Canadian Dollar</option>
                        <option value="CNY">CNY - Chinese Yuan</option>
                        <option value="DKK">DKK - Danish Kroner</option>
                        <option value="EUR">EUR - European Euro</option>
                        <option value="HKD">HKD - Hongkong Dollar</option>
                        <option value="IND">IND - Indian Rupee</option>
                        <option value="JPY">JPY - Japanese Yen</option>
                        <option value="NPR" selected>NPR - Nepalese Rupee</option>
                        <option value="SGD">SGD - Singapore Dollar</option>
                        <option value="KRW">KRW - South Korean Won</option>
                        <option value="SEK">SEK - Swedish Kroner</option>
                        <option value="CHF">CHF - Swiss Franc</option>
                        <option value="USD">USD - US Dollar</option>
                        <option value="GBP">GBP - UK Pound Sterling</option>
                    </select>
                </div>
            </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <strong><span style="color: #999">Product Price</span></strong>
                <table>
                    <tr>
                        <th style="width: 10%">Size</th>
                        <th style="text-align: right">Regular</th>
                        <th style="text-align: right">Discounted</th>
                        <th style="text-align: right">Valid Until</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="size_id" class="form-control selectsizeclass">
                                @foreach($sizes as $size)
                                <option value="{{$size->id}}" data-size="{{$size->size}}">{{$size->size}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="sizename" value="{{$sizes[0]->size}}" />
                        </td>
                        <td>
                            <input  id="regular" type="number" name="regular" required class="form-control">
                        </td>
                        <td>
                            <input  id="discounted" type="number" name="discounted" required class="form-control">
                        </td>
                        <td>
                            <input id="discount_valid_until" type="text" name="discount_valid_until" data-toggle="datepicker"
                                class="form-control" autocomplete="off">
                        </td>
                    </tr>
                </table>
                <small>If your product has more than one sizes/prices you will be able to add/edit in next step.</small>
            </div>
        </div>
        <div class="form-footer" style="margin-top: 0; padding-top:0">
            <button type="submit" class="btn btn-primary btn-md">Save & Continue</button>
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
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
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

        $('[data-toggle="datepicker"]').datepicker({
            date: new Date(),
            startDate: new Date(),
            autoHide: true,
            format: 'yyyy-mm-dd',
            zIndex: 2000
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
