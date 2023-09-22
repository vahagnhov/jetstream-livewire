<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--{{ __('Dashboard') }}--}}PKJ22////
        </h2>
    </x-slot>
    <div class="md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row space-y-4 md:space-x-4 md:space-y-0">
                <div class="w-full md:w-1/3 lg:w-1/4 space-y-2">
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.index') ? 'bg-gray-200' : '' }} flex space-x-2 text-gray-500 hover:bg-gray-200 p-3 rounded-lg"
                    >
                        <svg
                            class="w-6 h-6"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M12 8L15 13.2L18 10.5L17.3 14H6.7L6 10.5L9 13.2L12 8M12 4L8.5 10L3 5L5 16H19L21 5L15.5 10L12 4M19 18H5V19C5 19.6 5.4 20 6 20H18C18.6 20 19 19.6 19 19V18Z"
                            />
                        </svg>
                        <div
                            class="font-semibold {{ request()->routeIs('billing-portal.subscription.index') ? 'text-gray-700' : '' }}"
                        >
                            {{ __('Subscriptions') }}
                        </div>
                    </a>
                    <a
                        href="{{--{{ route('billing-portal.payment-method.index') }}--}}"
                        class="{{ request()->routeIs('billing-portal.payment-method.index') ? 'bg-gray-200' : '' }} flex space-x-2 text-gray-500 hover:bg-gray-200 p-3 rounded-lg"
                    >
                        <svg
                            class="w-6 h-6"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"
                            />
                        </svg>
                        <div
                            class="font-semibold"
                            class="{{ request()->routeIs('billing-portal.payment-method.index') ? 'text-gray-700' : '' }} font-semibold"
                        >
                            Payment Methods
                        </div>
                    </a>
                    <a
                        href="{{--{{ route('billing-portal.invoice.index') }}--}}"
                        class="{{ request()->routeIs('billing-portal.invoice.index') ? 'bg-gray-200' : '' }} flex space-x-2 text-gray-500 hover:bg-gray-200 p-3 rounded-lg"
                    >
                        <svg
                            class="w-6 h-6"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M3,22L4.5,20.5L6,22L7.5,20.5L9,22L10.5,20.5L12,22L13.5,20.5L15,22L16.5,20.5L18,22L19.5,20.5L21,22V2L19.5,3.5L18,2L16.5,3.5L15,2L13.5,3.5L12,2L10.5,3.5L9,2L7.5,3.5L6,2L4.5,3.5L3,2M18,9H6V7H18M18,13H6V11H18M18,17H6V15H18V17Z"
                            />
                        </svg>
                        <div
                            class="{{ request()->routeIs('billing-portal.invoice.index') ? 'text-gray-700' : '' }} font-semibold">
                            Invoices
                        </div>
                    </a>
                    <div
                        class="flex space-x-2 text-gray-500 hover:bg-gray-200 p-3 rounded-lg"
                    >
                        <a
                            href="{{--{{ route('billing-portal.portal') }}--}}"
                            method="post"
                            as="button"
                        >
                            <div class="font-semibold text-gray-700">
                                Stripe Billing Portal
                                <svg
                                    viewBox="0 0 24 24"
                                    class="w-4 h-4 ml-1 inline"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z"
                                    />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    {{--  @yield('content')--}}
                    <div class="space-y-6">
                        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($products as $product)
                                <div class="w-full flex">
                                    <div
                                        class="{{ 'border-indigo-500' }} flex flex-col w-full justify-between border-2 rounded-lg p-4 space-y-9">
                                        <div class="space-y-3">
                                            <div class="font-bold text-lg">
                                                {{$product->name}}
                                            </div>

                                            <div class="font-bold">
                                                 <span class="text-4xl font-extrabold">
                                                      ${{ $product->price }}/
                                                      <span class="font-normal text-base">
                                                             {{ $product->billing_period }}
                                                      </span>
                                                 </span>
                                            </div>

                                            {{--@if($plan->getDescription())--}}
                                            <div class="text-gray-500">
                                                {{$product->description}}
                                            </div>
                                            {{-- @endif--}}

                                            {{-- <div class="flex flex-col space-y-3">
                                                 @foreach($plan->getFeatures() as $feature)
                                                     <p class="flex items-baseline {{ $currentPlan && $plan->getId('id') === $currentPlan->getId('id') ? 'text-indigo-500' : 'text-gray-600' }}">
                                     <span
                                         class="{{ $currentPlan && $plan->getId('id') === $currentPlan->getId('id') ? 'bg-indigo-500' : 'bg-gray-600' }} w-4 h-4 mr-2 inline-flex items-center justify-center text-white rounded-full flex-shrink-0">
                                         <svg
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             stroke-width="2.5"
                                             class="w-3 h-3"
                                             viewBox="0 0 24 24"
                                         >
                                             <path d="M20 6L9 17l-5-5"/>
                                         </svg>
                                     </span>
                                                         @if(method_exists($feature, 'getMeteredId'))
                                                             <span v-if="feature.metered_id">
                                                     {{ $feature->getName() }}
                                                     <div class="text-gray-400 text-sm">
                                                         {{ $plan->getCurrency() }}{{ $feature->getMeteredId() }}
                                                         /{{ $feature->getMeteredUnitName() }} after
                                                     </div>
                                                     </span>
                                                     @else
                                                         <span>
                                             {{ $feature->getName() }}
                                         </span>
                                                         @endif
                                                         </p>
                                                         @endforeach
                                             </div>--}}
                                        </div>
                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="{{ request()->routeIs('billing-portal.subscription.index') ? 'bg-gray-200' : '' }}
                                               flex space-x-2 text-gray-500 hover:bg-gray-200 p-3 rounded-lg bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                        >@lang('product/texts.choose')</a>

                                       {{-- <x-nav-link href="{{ route('products.show', $product->slug) }}" :active="request()->routeIs('products.index')">
                                            PRRRR
                                        </x-nav-link>--}}

                                        {{--  <x-secondary-button
                                              wire:click="swapPlan('{{ route('products.show', $product->slug) }}')"
                                              wire:loading.attr="disabled"
                                              class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                          >
                                              <span class="mx-auto">@lang('product/texts.choose')</span>
                                          </x-secondary-button>--}}
                                        {{--@if(!$currentPlan)
                                            <x-button
                                                wire:click="subscribeToPlan('{{ $plan->getId() }}')"
                                                wire:loading.attr="disabled"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                            >
                                                <span class="mx-auto">Subscribe</span>
                                            </x-button>
                                        @elseif($currentPlan->getId('id') !== $plan->getId('id'))
                                            <x-secondary-button
                                                wire:click="swapPlan('{{ $plan->getId() }}')"
                                                wire:loading.attr="disabled"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                            >
                                                <span class="mx-auto">Subscribe</span>
                                            </x-secondary-button>
                                        @endif

                                        @if($currentPlan && $currentPlan->getId('id') === $plan->getId('id') && $recurring)
                                            <x-secondary-button
                                                wire:click="cancelSubscription"
                                                wire:loading.attr="disabled"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                            >
                                                <span class="mx-auto">Cancel subscription</span>
                                            </x-secondary-button>
                                        @endif

                                        @if($currentPlan && $currentPlan->getId('id') === $plan->getId('id') && $cancelled && $onGracePeriod)
                                            <x-button
                                                wire:click="resumeSubscription"
                                                wire:loading.attr="disable"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 font-bold border-none shadow-none text-center"
                                            >
                                                <span class="mx-auto">Resume subscription</span>
                                            </x-button>
                                        @endif--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> @lang('product/texts.select_product')</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            ${{ $product->price }}/ @lang('product/texts.monthly')
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <a href="{{ route('products.show', $product->slug) }}"
                                               class="btn btn-primary pull-right">@lang('product/texts.choose')</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

</x-app-layout>

