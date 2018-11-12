<div class="row">
	<div class="col-md-6"><h3 id="imgTitle">Available Images</h3></div>
	<div class="col-md-6">
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
	@foreach($pics as $pic)
		@php
		$picpath = '/storage/' . auth()->user()->site->siteUrl . '/images/thumb_240' . '/' . $pic->picpath;
		$this_caption = "";
		$d = $pic->captions;
		$currentlanguage = session('currentLanguage');
		if($d) $this_caption = $d[0][$currentlanguage];
		@endphp
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<div class="fixedbox">
				<img src="{{ $picpath }}" class="img-responsive sitepics" id="pic-{{ $pic->id }}" data-sizes="{{ $pic->lg }}-{{ $pic->md }}-{{ $pic->sm }}-{{ $pic->xs }}" data-caption="{{ $this_caption }}" />
				</div>
				<div class="caption">
					{{ $this_caption }} &nbsp;
				</div>
			</div>
		</div>
	@endforeach
</div>
