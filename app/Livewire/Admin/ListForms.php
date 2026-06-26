<?php

namespace App\Livewire\Admin;

use App\Models\Form;
use Livewire\Component;

class ListForms extends Component
{
    public function render()
    {
        return view('livewire.admin.list-forms', [
            'forms' => Form::orderBy('created_at', 'desc')->get(),
        ])->layout('layouts.app');
    }
}
