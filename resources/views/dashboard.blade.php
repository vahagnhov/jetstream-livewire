<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('stripe.portal') }}" method="POST">
                    @csrf
                    <script
                        src="https://checkout.stripe.com/checkout.js"
                        class="stripe-button"
                        data-key="{{ config('services.stripe.key') }}"
                        data-amount="0.01"
                        data-name="Example"
                        data-description="Example Charge"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="usd">
                    </script>
                </form>
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
