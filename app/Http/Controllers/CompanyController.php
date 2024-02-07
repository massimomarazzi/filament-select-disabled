<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        //$this->authorize('viewAny', Person::class);

        return view('livewire.index', [
            'component_name' => 'company-table',
            'title' => __('company'),
        ]);
    }

    public function create(): View
    {
        //$this->authorize('create', Person::class);

        return view('livewire.edit-create', [
            'model' => new Company(),
            'action' => __FUNCTION__,
            'component_name' => 'company-form',
            'title' => __('Add new company'),
        ]);
    }

    public function edit(Company $company): View
    {
        //$this->authorize('edit', Person::class);

        return view('livewire.edit-create', [
            'model' => $company,
            'component_name' => 'company-form',
            'action' => __FUNCTION__,
            'title' => __('Edit company'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
