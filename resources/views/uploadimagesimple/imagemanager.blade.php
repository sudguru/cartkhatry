<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tabs" id="myTabs">
                    <ul class="nav nav-tabs nav-justified flex-column flex-md-row">
                        <li class="nav-item active">
                            <a href="#new" class="nav-link active show" data-toggle="tab">Upload New Image</a>
                        </li>
                        <li class="nav-item">
                            <a href="#browse" class="nav-link" data-toggle="tab">Browse Existing Images</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="new" class="tab-pane active show">
                            @include('uploadimagesimple.imageupload')
                        </div>
                        <div id="browse" class="tab-pane">
                            @include('uploadimagesimple.imagebrowse')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>