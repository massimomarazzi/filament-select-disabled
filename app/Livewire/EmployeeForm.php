<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmployeeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public array $labels = [
        'submit' => 'Save'
    ];
    public $action;
    public $model;
    public function mount($model,$action): void
    {
        $this->model = $model;
        $this->action = $action;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->minLength(3)
                    ->required(),
                Toggle::make('enable_company_id')
                    ->label('Enable/Disable Company select')
                    ->dehydrated(false)
                    ->live(),
                Select::make('company_id')
                    ->label(__('Company'))
                    ->relationship('company', 'name')
                    ->getOptionLabelFromRecordUsing(fn(Company $record) => $record->name)
                    ->searchable()
                    ->preload()
                    ->default('Disabled by default')
                    ->optionsLimit(10)
                    ->nullable()
                    ->disabled(fn (Get $get): bool => !$get('enable_company_id'))
            ])
            ->statePath('data')
            ->model(Employee::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Employee::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.form');
    }
}
