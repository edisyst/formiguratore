<?php

namespace App\Livewire\Public;

use App\Models\Element;
use App\Models\Form;
use App\Models\ObjectRecord;
use Livewire\Component;

class ShowForm extends Component
{
    public Form $form;

    public bool $showModal = false;
    public ?int $editingElementId = null;
    public ?int $editingRecordId = null;
    public array $modalData = [];

    public ?int $openStepId = null;

    public function mount(Form $form): void
    {
        $this->form = $form->load('steps.groups.elements.objectRecords');
        $this->openStepId = $form->steps->first()?->id;
    }

    public function setOpenStep(int $stepId): void
    {
        $this->openStepId = $stepId;
    }

    public function openModal(int $elementId, ?int $recordId = null): void
    {
        $this->editingElementId = $elementId;
        $this->editingRecordId = $recordId;
        $this->modalData = [];

        if ($recordId) {
            $record = ObjectRecord::find($recordId);
            $this->modalData = $record ? $record->data : [];
        }

        $this->showModal = true;
        $this->dispatch('modal-ready');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->editingElementId = null;
        $this->editingRecordId = null;
        $this->modalData = [];
    }

    public function saveRecord(): void
    {
        $element = Element::find($this->editingElementId);
        if (!$element) return;

        if ($this->editingRecordId) {
            ObjectRecord::find($this->editingRecordId)?->update(['data' => $this->modalData]);
        } else {
            ObjectRecord::create([
                'element_id' => $this->editingElementId,
                'data'       => $this->modalData,
            ]);
        }

        $this->closeModal();
        $this->form = $this->form->fresh('steps.groups.elements.objectRecords');
    }

    public function deleteRecord(int $recordId): void
    {
        ObjectRecord::find($recordId)?->delete();
        $this->form = $this->form->fresh('steps.groups.elements.objectRecords');
    }

    public function render()
    {
        return view('livewire.public.show-form')->layout('layouts.app');
    }
}
