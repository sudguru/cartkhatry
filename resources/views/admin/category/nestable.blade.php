<div class="dd nestable" id="nestable">
<ol class="dd-list">
	@foreach ($categories as $parent)
	<li class="dd-item dd3-item" data-id="{{ $parent->id }}" data-name="{{ $parent->category }}" data-new="0" data-deleted="0">
		<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content">
				<a href="{{ route('category.edit', $parent->id) }}">{{ $parent->category }}</a>
				<span class="button-delete" data-owner-id="{{ $parent->id }}">
					<i class="fas fa-times-circle" aria-hidden="true"></i>
				</span>
			</div>
			@if ($parent->children->count())
				<ol class="dd-list">
					@foreach ($parent->children as $child)
						<li class="dd-item dd3-item" data-id="{{ $child->id }}" data-name="{{ $child->category }}" data-new="0" data-deleted="0">
							<div class="dd-handle dd3-handle"></div>
							<div class="dd3-content">
									<a href="{{ route('category.edit', $child->id) }}">{{ $child->category }}</a>
									<span class="button-delete" data-owner-id="{{ $child->id }}">
											<i class="fas fa-times-circle" aria-hidden="true"></i>
										</span>
							</div>
							
							@if ($child->children->count())
								<ol class="dd-list">
									@foreach ($child->children as $grandchild)
										<li class="dd-item dd3-item" data-id="{{ $grandchild->id }}" data-name="{{ $grandchild->category }}" data-new="0" data-deleted="0">
											<div class="dd-handle dd3-handle"></div>
											<div class=dd3-content>
												<a href="{{ route('category.edit', $grandchild->id) }}">{{ $grandchild->category }}</a>
												<span class="button-delete" data-owner-id="{{ $grandchild->id }}">
													<i class="fas fa-times-circle" aria-hidden="true"></i>
												</span>
											</div>
										</li>
									@endforeach
								</ol>
							@endif
						</li>
					@endforeach
				</ol>
			@endif
		</li>
		@endforeach
	</ol>
</div>
<div class="mydangeralert" id="changespending"></div>
<form action="{{ route('category.store') }}" method="POST">
	{{ csrf_field() }}
	<textarea name="jsondata" id="json-output" cols="30" rows="10" style="display: none"></textarea>
	<button class="btn btn-primary">Save Changes</button>
</form>


