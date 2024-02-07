<x-app-layout>
    @php($create = $create ?? true)
    <div>
        <div class="max-w-8xl mx-auto py-10 sm:px-6 lg:px-8">
            @if($create)
            <div class="py-4">
                <a class="px-4 py-2 bg-globalsummit-600 rounded-md font-semibold text-xs text-white uppercase
                hover:bg-primary-500 focus:outline-none focus:border-gray-900 focus:ring"
                   href="{{ route(\Route::getCurrentRoute()->uri() . '.create') }}">
                    {{ __('Add new') }}
                </a>
            </div>
            @endif
            @livewire($component_name)
        </div>
    </div>
</x-app-layout>
