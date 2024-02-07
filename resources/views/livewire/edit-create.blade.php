<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-8xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire($component_name, [ 'action'=> $action, 'model' => $model, ])
        </div>
    </div>
</x-app-layout>
