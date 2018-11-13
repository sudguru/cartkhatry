<div class="row">
	<div class="col-md-12 pt-2">
		<form action="/searchimages" method="post"  id="search_form">
			{{ csrf_field() }}
			<div class="form-group label-floating">
				<label class="control-label">Search by Image Caption (Type and Hit Enter)</label>
				<input type="text" name="s" class="form-control" value="{{ old('s') }}">
			</div>
		</form>
	</div>
</div>
<div class="row" id="image_browse" style="max-height: 500px; overflow: scroll;">
	@foreach($userpics as $pic)
		@php
		$picpath = '/storage/images/' . auth()->user()->id . '/thumb_240' . '/' . $pic->pic_path;
		$this_caption = $pic->caption;
		@endphp
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<div class="fixedbox">
				<img src="{{ $picpath }}" class="sitepics" style="width: 100%" id="pic-{{ $pic->id }}" data-sizes="{{ $pic->lg }}-{{ $pic->md }}-{{ $pic->sm }}-{{ $pic->xs }}" data-caption="{{ $this_caption }}" />
				</div>
				<div class="caption">
					{{ $this_caption }} &nbsp;
				</div>
			</div>
		</div>
	@endforeach
</div>
