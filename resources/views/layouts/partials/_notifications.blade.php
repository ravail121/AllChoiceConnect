@if($errors->any())
    <div class="container">
        <div class="row">
            <div class="alert alert-danger alert-dismissible text-center fonts-phones" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $errors->first() !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endif

@if(Session::has('notification'))
    <div class="container">
        <div class="row">
            <div class="alert alert-{{ Session::get('notification')['status'] == 'success' ? 'success' : 'danger'}} alert-dismissible text-center fonts-phones" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('notification')['message'] !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="container">
        <div class="row">
            <div class="alert alert-danger alert-dismissible text-center fonts-phones" role="alert">{{Session::get('error')}}</div>
        </div>
    </div>
@endif
