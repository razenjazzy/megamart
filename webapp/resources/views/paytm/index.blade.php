@extends('backend.layouts.app')

@section('content')
    <div class="row">
        @foreach ($payment_methods as $payment_method)
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <img class="mr-3" src="{{ static_asset('assets/img/cards/'.$payment_method->name.'.png') }}" height="30">
                        <h5 class="mb-0 h6">{{ ucfirst(translate($payment_method->name)) }}</h5>
                    </div>
                    <label class="aiz-switch aiz-switch-success mb-0 float-right">
                        <input type="checkbox" onchange="updatePaymentSettings(this, {{ $payment_method->id }})" @if ($payment_method->active == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="card-body">
                    @include('paytm.payment_method.'.$payment_method->name)
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function updatePaymentSettings(el, id) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.post('{{ route('payment.activation') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                value: value
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Payment Settings updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
