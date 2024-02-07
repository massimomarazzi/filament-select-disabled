<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;


class CompanyForm extends BaseForm
{

    public function mount($model, $action): void
    {
        parent::mount($model, $action);

        $this->form->fill([
            'name' => $this->model->name ?? '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->minLength(3)
                    ->required(),
            ])
            ->model($this->model)
            ->statePath('data');
    }
}
