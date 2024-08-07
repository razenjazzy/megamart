@extends('backend.layouts.app')

@section('content')

    <div class="">
        <div class="row ">
            <div class="col-md-6">
                <div class="nav border-bottom aiz-nav-tabs">
                    <a class="p-3 fs-16 text-reset show active" data-toggle="tab" href="#installed">{{ translate('Installed Addon')}}</a>
                    <a class="p-3 fs-16 text-reset" data-toggle="tab" href="#available">{{ translate('Available Addon')}}</a>
                </div>
            </div>
			{{-- <div class="col mt-3 mt-md-0 text-center text-md-right">
                <a href="#" class="btn btn-primary" target="_blank">
					{{ translate('Activate Addon Link') }}
				</a>
            </div> --}}
            <div class="col mt-3 mt-md-0 text-center text-md-right">
                <a href="#" class="btn btn-primary mb-3 mb-sm-0 mx-3 mx-md-0 mr-lg-3" target="_blank">
					{{ translate('Activate Addon Link') }}
				</a>
                <a href="{{ route('addons.create')}}" class="btn btn-primary mx-3 mx-md-0">{{ translate('Install/Update Addon')}}</a>
            </div>
        </div>
    </div>
    <br>
    <div class="tab-content">
        <div class="tab-pane fade in active show" id="installed">
            <div class="row">
                <div class="col-xl-10 col-xxl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse($addons as $key => $addon)
                                    <li class="list-group-item">
                                        <div class="align-items-center d-flex flex-column flex-md-row">
                                            <img class="h-60px mb-3 mb-md-0" src="{{ static_asset($addon->image) }}" alt="Image">
                                            <div class="mr-md-3 ml-md-5">
                                                <h4 class="fs-16 fw-600">{{ ucfirst($addon->name) }}</h4>
                                            </div>
                                            <div class="mr-md-3 ml-0">
                                                <p><small>{{ translate('Version')}}: </small>{{ $addon->version }}</p>
                                            </div>
                                            @if (env('DEMO_MODE') != 'On')
                                                <div class="mr-md-3 ml-0 w-100 w-md-auto">
                                                    <p><small>{{ translate('Purchase code')}}: </small>{{ $addon->purchase_code }}</p>
                                                </div>
                                            @endif
                                            <div class="ml-auto mr-0">
                                                <label class="aiz-switch mb-0">
                                                    <input type="checkbox" onchange="updateStatus(this, {{ $addon->id }})" <?php if($addon->activated) echo "checked";?>>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item">
                                        <div class="text-center">
                                            <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                                            <h5 class="mb-0 h5 mt-3">{{ translate('No Addon Installed')}}</h5>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="available">
            <div class="row" id="available-addons-content">

            </div>
        </div>
    </div>




@endsection
