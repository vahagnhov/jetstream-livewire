<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                            <p><strong>@lang('dashboard/texts.purchase_details')</strong></p>
                            <p>{{ $purchaseDetails }}</p>
                        @endif

                        @if ($canCancelPurchase)
                            {!! Form::open(['route' => 'cancel-purchase', 'method' => 'POST']) !!}
                            @csrf
                            {!! Form::button(__('dashboard/texts.cancel_purchase'), ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
