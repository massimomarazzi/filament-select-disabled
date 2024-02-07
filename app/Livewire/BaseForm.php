<?php

namespace App\Livewire;

use App\Models\Mode;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BaseForm extends Component implements HasForms
{
    use RedirectsActions,
        AuthorizesRequests,
        InteractsWithForms;

    public BaseModel|User $model;

    public ?string $action = '';

    public ?string $routePath = '';

    public ?string $modelName = '';

    public ?array $data = [];

    protected Authenticatable $user;

    public function mount(BaseModel|User $model, ?string $action): void
    {
        $this->modelName = class_basename($model::class);
        $this->routePath = Str::plural(strtolower($this->modelName));
        $this->action = $action;
        $this->user = auth()->user();
        $this->model = $model;
    }

    public function create()
    {
        $inputs = $this->form->getState();
        $this->model = (new $this->model)->fill($inputs);
        $this->model->save();
        $this->form->model($this->model)->saveRelationships();

        $this->onValidationSuccess($this->model->title);

        $this->redirectToEdit($this->model);
    }

    public function edit()
    {
        $inputs = $this->form->getState();
        $this->model->update($inputs);
        $this->form->model($this->model)->saveRelationships();
        $this->model->fresh();

        $this->onValidationSuccess($this->model->title);

        $this->redirectToEdit($this->model);
    }

    public function onValidationSuccess($itemTitle = '')
    {
        Notification::make()
            ->title(sprintf(__('%s %s %s successfully.'),
                $this->modelName ?? '',
                $itemTitle,
                $this->labels['success']
            ))
            ->success()
            ->send();
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title(sprintf(__('%s. Error message: %s'),
                $this->labels['error'],
                $exception->getMessage()
            ))
            ->danger()
            ->send();
    }

    protected function redirectToEdit($model)
    {
        return redirect()->route("{$this->routePath}.edit", [strtolower($this->modelName) => $model]);
    }

    public function render()
    {
        return view('livewire.form');
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }
}
