@if(Session::has('message'))
    <div class="alert alert-secondary" role="alert">
        <h4 class="alert-heading">{{ trans('messages.error') }}</h4>
        <div class="alert-body">
            {{ Session::get('message') }}
        </div>
    </div>
@endif

@if(Session::has('errors'))
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">{{ trans('messages.error') }}</h4>
        <div class="alert-body">
            <div class="">
                <ul>
                    @foreach(Session::get('errors')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-primary" role="alert">
        <h4 class="alert-heading">{{ trans('messages.success') }}</h4>
        <div class="alert-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">{{ trans('messages.info') }}</h4>
        <div class="alert-body">
            {{ Session::get('info') }}
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">{{ trans('messages.error') }}</h4>
        <div class="alert-body">
            {{ Session::get('error') }}
        </div>
    </div>
@endif
