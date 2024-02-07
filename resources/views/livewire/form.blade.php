<div class="form-container">

    <div class="w-full p-6 mb-2 border rounded-lg border-globalsummit-100">
        <h1 class="font-bold text-globalsummit-900 text-2xl">
            {{empty($this->model->title) ?  class_basename($this->model::class) : $this->model->title}}
        </h1>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-xs border">
        <form wire:submit="{{ $this->action }}" class="grid grid-cols-7 gap-0">
            <div class="col-span-6">
                {{ $this->form }}
            </div>

            <div class="col-span-1 p-6">

                <div class="mb-6 text-sm">
                    <p>{{ __('Created') }}:</p>
                    <p class="font-bold">
                        {{ __($this->model->created_at?->format(\App\Constants\DateFormat::EuFormatDateText->value) ?? '') }}
                        <span class="text-xs">
                            {{ $this->model->created_at?->format(\App\Constants\DateFormat::EuFormatTime->value) }}
                        </span>
                    </p>
                </div>

                <div class="mb-6 text-sm">
                    <p>{{ __('Last update') }}:</p>
                    <p class="font-bold">
                        {{ __($this->model->updated_at?->format(\App\Constants\DateFormat::EuFormatDateText->value) ?? '') }}
                        <span class="text-xs">
                            {{ $this->model->updated_at?->format(\App\Constants\DateFormat::EuFormatTime->value) ?? '' }}
                        </span>
                    </p>
                </div>

                <div class="mb-6 flex">
                    <button class="flex-initial grow bg-emerald-600 items-center justify-self-center justify-center
                        font-medium rounded-lg border transition-colors focus:outline-none
                        h-9 px-4 shadow border-emerald-600 hover:bg-emerald-700 text-white">
                        {{ $this->labels['submit'] }}
                    </button>
                    <br/>
                    <a href="{{ url()->previous() }}"
                       class="flex-initial bg-gray-300 grow inline-flex items-center justify-self-center justify-center
                       font-medium rounded-lg border
                       transition-colors focus:outline-none h-9 px-4 text-gray-800 border-gray-600 hover:bg-gray-400
                       focus:ring-globalsummit-600">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>
        <x-filament-actions::modals/>
    </div>
</div><!--form-container-->
