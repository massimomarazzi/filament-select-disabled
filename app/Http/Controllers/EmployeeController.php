<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //$this->authorize('viewAny', Person::class);

        return view('livewire.index', [
            'component_name' => 'employee-table',
            'title' => __('Employee'),
        ]);
    }

    public function create(): View
    {
        //$this->authorize('create', Person::class);

        return view('livewire.edit-create', [
            'model' => new Employee(),
            'action' => __FUNCTION__,
            'component_name' => 'employee-form',
            'title' => __('Add new employee'),
        ]);
    }

    public function edit(Employee $employee): View
    {
        //$this->authorize('edit', Person::class);

        return view('livewire.edit-create', [
            'model' => $employee,
            'component_name' => 'employee-form',
            'action' => __FUNCTION__,
            'title' => __('Edit employee'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
