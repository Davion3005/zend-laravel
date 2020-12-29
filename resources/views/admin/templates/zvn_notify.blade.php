@if (session('status'))
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-success alert-dismissible  fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                <strong>{{ session('status') }}</strong>
            </div>
        </div>
    </div>
@endif
