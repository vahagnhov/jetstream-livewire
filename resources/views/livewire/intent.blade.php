<div wire:init="loadIntentClientSecret" class="mt-6">
    {{ Form::button('Purchase', [
            'type' => 'submit', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full',
            'id' => 'card-button', 'data-secret' => $intentClientSecret]) }}
</div>

