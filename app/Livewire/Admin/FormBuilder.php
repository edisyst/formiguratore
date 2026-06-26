<?php

namespace App\Livewire\Admin;

use App\Models\Element;
use App\Models\Form;
use App\Models\Step;
use Illuminate\Support\Str;
use Livewire\Component;

class FormBuilder extends Component
{
    public ?Form $form = null;

    // Form fields
    public string $name = '';
    public string $slug = '';
    public string $description = '';

    // Steps state (array of step data)
    public array $steps = [];

    // New step input
    public string $newStepTitle = '';

    // New element inputs per step (keyed by step index)
    public array $newElement = [];

    // Track which step accordion is open
    public array $openSteps = [];

    public function mount(?Form $form = null): void
    {
        if ($form && $form->exists) {
            $this->form = $form;
            $this->name = $form->name;
            $this->slug = $form->slug;
            $this->description = $form->description ?? '';

            foreach ($form->steps as $i => $step) {
                $this->steps[] = [
                    'id' => $step->id,
                    'title' => $step->title,
                    'order' => $step->order,
                    'elements' => $step->elements->map(fn($e) => [
                        'id' => $e->id,
                        'name' => $e->name,
                        'type' => $e->type,
                        'label' => $e->label,
                        'placeholder' => $e->placeholder ?? '',
                        'required' => $e->required,
                        'order' => $e->order,
                        'configuration' => $e->configuration ?? [],
                    ])->toArray(),
                ];
                $this->openSteps[$i] = true;
            }
        }
    }

    public function updatedName(): void
    {
        if (!$this->form) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function addStep(): void
    {
        $title = trim($this->newStepTitle);
        if (!$title) return;

        $this->steps[] = [
            'id' => null,
            'title' => $title,
            'order' => count($this->steps),
            'elements' => [],
        ];
        $idx = count($this->steps) - 1;
        $this->openSteps[$idx] = true;
        $this->newStepTitle = '';
    }

    public function removeStep(int $index): void
    {
        array_splice($this->steps, $index, 1);
        $this->reorderSteps();
    }

    public function moveStepUp(int $index): void
    {
        if ($index === 0) return;
        [$this->steps[$index - 1], $this->steps[$index]] = [$this->steps[$index], $this->steps[$index - 1]];
        $this->reorderSteps();
    }

    public function moveStepDown(int $index): void
    {
        if ($index >= count($this->steps) - 1) return;
        [$this->steps[$index], $this->steps[$index + 1]] = [$this->steps[$index + 1], $this->steps[$index]];
        $this->reorderSteps();
    }

    private function reorderSteps(): void
    {
        foreach ($this->steps as $i => &$step) {
            $step['order'] = $i;
        }
    }

    public function addElement(int $stepIndex): void
    {
        $data = $this->newElement[$stepIndex] ?? [];
        $name = trim($data['name'] ?? '');
        $type = $data['type'] ?? 'text';
        $label = trim($data['label'] ?? '');

        if (!$name || !$label) return;

        $config = [];
        if ($type === 'select') {
            $raw = $data['options_raw'] ?? '';
            $config['options'] = array_filter(array_map('trim', explode("\n", $raw)));
        } elseif ($type === 'object') {
            $config['fields'] = $data['object_fields'] ?? [];
        }

        $this->steps[$stepIndex]['elements'][] = [
            'id' => null,
            'name' => $name,
            'type' => $type,
            'label' => $label,
            'placeholder' => $data['placeholder'] ?? '',
            'required' => isset($data['required']) && $data['required'],
            'order' => count($this->steps[$stepIndex]['elements']),
            'configuration' => $config,
        ];

        $this->newElement[$stepIndex] = ['type' => 'text'];
    }

    public function removeElement(int $stepIndex, int $elementIndex): void
    {
        array_splice($this->steps[$stepIndex]['elements'], $elementIndex, 1);
        $this->reorderElements($stepIndex);
    }

    public function moveElementUp(int $stepIndex, int $elementIndex): void
    {
        if ($elementIndex === 0) return;
        $els = &$this->steps[$stepIndex]['elements'];
        [$els[$elementIndex - 1], $els[$elementIndex]] = [$els[$elementIndex], $els[$elementIndex - 1]];
        $this->reorderElements($stepIndex);
    }

    public function moveElementDown(int $stepIndex, int $elementIndex): void
    {
        $els = &$this->steps[$stepIndex]['elements'];
        if ($elementIndex >= count($els) - 1) return;
        [$els[$elementIndex], $els[$elementIndex + 1]] = [$els[$elementIndex + 1], $els[$elementIndex]];
        $this->reorderElements($stepIndex);
    }

    private function reorderElements(int $stepIndex): void
    {
        foreach ($this->steps[$stepIndex]['elements'] as $i => &$el) {
            $el['order'] = $i;
        }
    }

    public function addObjectField(int $stepIndex, int $elementIndex): void
    {
        $field = $this->newElement[$stepIndex]['obj_field'] ?? [];
        $fieldName = trim($field['name'] ?? '');
        $fieldLabel = trim($field['label'] ?? '');
        if (!$fieldName || !$fieldLabel) return;

        $this->steps[$stepIndex]['elements'][$elementIndex]['configuration']['fields'][] = [
            'name' => $fieldName,
            'label' => $fieldLabel,
            'type' => $field['type'] ?? 'text',
            'required' => isset($field['required']) && $field['required'],
        ];

        $this->newElement[$stepIndex]['obj_field'] = [];
    }

    public function removeObjectField(int $stepIndex, int $elementIndex, int $fieldIndex): void
    {
        array_splice(
            $this->steps[$stepIndex]['elements'][$elementIndex]['configuration']['fields'],
            $fieldIndex,
            1
        );
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $formData = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];

        if ($this->form && $this->form->exists) {
            $this->form->update($formData);
            $form = $this->form;
        } else {
            $form = Form::create($formData);
        }

        // Sync steps
        $existingStepIds = $form->steps()->pluck('id')->toArray();
        $savedStepIds = [];

        foreach ($this->steps as $i => $stepData) {
            if ($stepData['id']) {
                $step = Step::find($stepData['id']);
                $step->update(['title' => $stepData['title'], 'order' => $i]);
            } else {
                $step = $form->steps()->create(['title' => $stepData['title'], 'order' => $i]);
            }
            $savedStepIds[] = $step->id;

            // Sync elements
            $existingElIds = $step->elements()->pluck('id')->toArray();
            $savedElIds = [];

            foreach ($stepData['elements'] as $j => $elData) {
                $payload = [
                    'name' => $elData['name'],
                    'type' => $elData['type'],
                    'label' => $elData['label'],
                    'placeholder' => $elData['placeholder'] ?? null,
                    'required' => $elData['required'],
                    'order' => $j,
                    'configuration' => $elData['configuration'] ?: null,
                ];

                if ($elData['id']) {
                    $el = Element::find($elData['id']);
                    $el->update($payload);
                } else {
                    $el = $step->elements()->create($payload);
                }
                $savedElIds[] = $el->id;
            }

            // Delete removed elements
            $step->elements()->whereNotIn('id', $savedElIds)->delete();
        }

        // Delete removed steps
        $form->steps()->whereNotIn('id', $savedStepIds)->each(fn($s) => $s->elements()->delete() || $s->delete());

        session()->flash('success', 'Form salvato con successo.');
        $this->redirect(route('admin.forms.index'));
    }

    public function toggleStep(int $index): void
    {
        $this->openSteps[$index] = !($this->openSteps[$index] ?? false);
    }

    public function render()
    {
        return view('livewire.admin.form-builder')->layout('layouts.app');
    }
}
