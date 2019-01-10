<div class="row">
    <div class="col-md-12 pt-2">
        <form action="/searchimages" method="post" id="search_form">
            {{ csrf_field() }}
            <div class="form-group label-floating">
                <label class="control-label">Search by Image Caption (Type and Hit Enter)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" name="s" class="form-control" value="{{ old('s') }}">
                </div>
                
            </div>
        </form>
    </div>
</div>
<div class="row" id="image_browse" style="max-height: 500px; overflow: scroll;">
    @foreach($userpics as $pic)
    @php
	$picpath = '/storage/images/' . auth()->user()->id . '/thumb_240' . '/' . $pic->pic_path;
	$this_caption = "";
    $this_caption = ($pic->products()->count() ? $pic->products[0]->pivot->caption : '');
    @endphp
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <div class="fixedbox">
                <img src="{{ $picpath }}" class="sitepics" style="width: 100%" id="pic-{{ $pic->id }}" data-sizes="{{ $pic->lg }}-{{ $pic->md }}-{{ $pic->sm }}-{{ $pic->xs }}"
                    data-caption="{{ $this_caption }}" />
            </div>
            <div class="caption">
                {{ $this_caption }} &nbsp;
            </div>
        </div>
    </div>
    @endforeach
</div>
