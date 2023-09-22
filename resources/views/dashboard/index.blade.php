@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                             <div class="alert alert-danger">
                                 {{ session('error') }}
                             </div>
                       @endif

                        {{ __('You are logged in!') }}

                        <div class="alert alert-info">
                            @if ($user->hasRole(\App\Constants\Roles::B2C_CUSTOMER) || $user->hasRole(\App\Constants\Roles::B2B_CUSTOMER))
                                <p><strong> @lang('dashboard/texts.purchase_details')</strong> </p>
                                <p> {{ $purchaseDetails }}</p>
                            @endif

                            @if ($canCancelPurchase)
                                <form action="{{ route('cancel-purchase') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        @lang('dashboard/texts.cancel_purchase')
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

