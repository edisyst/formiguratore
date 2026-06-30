<?php

namespace App\Livewire\Admin;

use App\Models\Element;
use App\Models\Form;
use App\Models\Group;
use App\Models\Step;
use Illuminate\Support\Str;
use Livewire\Component;

class FormBuilder extends Component
{
    public ?Form $form = null;

    public string $name = '';
    public string $slug = '';
    public string $description = '';

    // steps[si] = { id, title, order, groups[gi] = { id, title, header, footer, order, elements[ei] = {...} } }
    public array $steps = [];

    public string $newStepTitle = '';
    public array $newGroupTitle = []; // keyed by step index
    public array $newElement = [];    // keyed by step index, then group index

    public array $openSteps = [];
    public array $openGroups = []; // [si][gi]
    public array $openElements = []; // [si][gi][ei]

    public function mount(?Form $form = null): void
    {
        if ($form && $form->exists) {
            $this->form = $form;
            $this->name = $form->name;
            $this->slug = $form->slug;
            $this->description = $form->description ?? '';

            foreach ($form->steps as $si => $step) {
                $groups = [];
                foreach ($step->groups as $gi => $group) {
                    $groups[] = [
                        'id'       => $group->id,
                        'title'    => $group->title,
                        'header'   => $group->header ?? '',
                        'footer'   => $group->footer ?? '',
                        'order'    => $group->order,
                        'elements' => $group->elements->map(fn($e) => [
                            'id'            => $e->id,
                            'name'          => $e->name,
                            'type'          => $e->type,
                            'label'         => $e->label,
                            'placeholder'   => $e->placeholder ?? '',
                            'required'      => $e->required,
                            'order'         => $e->order,
                            'configuration' => $e->configuration ?? [],
                        ])->toArray(),
                    ];
                    $this->openGroups[$si][$gi] = false;
                }

                $this->steps[] = [
                    'id'     => $step->id,
                    'title'  => $step->title,
                    'order'  => $step->order,
                    'groups' => $groups,
                ];
                $this->openSteps[$si] = false;
            }
        }
    }

    public function updatedName(): void
    {
        if (!$this->form) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function updatedNewElement($value, ?string $key = null): void
    {
        if ($key === null) return;

        $parts = explode('.', $key);
        if (count($parts) === 3 && $parts[2] === 'label') {
            $si = (int) $parts[0];
            $gi = (int) $parts[1];
            if (empty($this->newElement[$si][$gi]['name'] ?? '')) {
                $this->newElement[$si][$gi]['name'] = Str::slug($value, '_');
            }
        }
    }

    // ── Step management ──────────────────────────────────────────────────────

    public function addStep(): void
    {
        $title = trim($this->newStepTitle);
        if (!$title) return;

        $this->steps[] = [
            'id'     => null,
            'title'  => $title,
            'order'  => count($this->steps),
            'groups' => [],
        ];
        $idx = count($this->steps) - 1;
        $this->openSteps[$idx] = true;
        $this->newStepTitle = '';
    }

    public function removeStep(int $si): void
    {
        array_splice($this->steps, $si, 1);
        $this->reorderSteps();
    }

    public function moveStepUp(int $si): void
    {
        if ($si === 0) return;
        [$this->steps[$si - 1], $this->steps[$si]] = [$this->steps[$si], $this->steps[$si - 1]];
        $this->reorderSteps();
    }

    public function moveStepDown(int $si): void
    {
        if ($si >= count($this->steps) - 1) return;
        [$this->steps[$si], $this->steps[$si + 1]] = [$this->steps[$si + 1], $this->steps[$si]];
        $this->reorderSteps();
    }

    private function reorderSteps(): void
    {
        foreach ($this->steps as $i => &$step) {
            $step['order'] = $i;
        }
    }

    public function toggleStep(int $si): void
    {
        $this->openSteps[$si] = !($this->openSteps[$si] ?? false);
    }

    // ── Group management ─────────────────────────────────────────────────────

    public function addGroup(int $si): void
    {
        $title = trim($this->newGroupTitle[$si] ?? '');
        if (!$title) return;

        $gi = count($this->steps[$si]['groups']);
        $this->steps[$si]['groups'][] = [
            'id'       => null,
            'title'    => $title,
            'header'   => '',
            'footer'   => '',
            'order'    => $gi,
            'elements' => [],
        ];
        $this->openGroups[$si][$gi] = true;
        $this->newGroupTitle[$si] = '';
    }

    public function removeGroup(int $si, int $gi): void
    {
        array_splice($this->steps[$si]['groups'], $gi, 1);
        $this->reorderGroups($si);
    }

    public function moveGroupUp(int $si, int $gi): void
    {
        if ($gi === 0) return;
        $g = &$this->steps[$si]['groups'];
        [$g[$gi - 1], $g[$gi]] = [$g[$gi], $g[$gi - 1]];
        $this->reorderGroups($si);
    }

    public function moveGroupDown(int $si, int $gi): void
    {
        $g = &$this->steps[$si]['groups'];
        if ($gi >= count($g) - 1) return;
        [$g[$gi], $g[$gi + 1]] = [$g[$gi + 1], $g[$gi]];
        $this->reorderGroups($si);
    }

    private function reorderGroups(int $si): void
    {
        foreach ($this->steps[$si]['groups'] as $i => &$group) {
            $group['order'] = $i;
        }
    }

    public function toggleGroup(int $si, int $gi): void
    {
        $this->openGroups[$si][$gi] = !($this->openGroups[$si][$gi] ?? false);
    }

    // ── Element management ───────────────────────────────────────────────────

    public function addElement(int $si, int $gi): void
    {
        $data  = $this->newElement[$si][$gi] ?? [];
        $name  = trim($data['name'] ?? '');
        $type  = $data['type'] ?? 'text';
        $label = trim($data['label'] ?? '');

        if (!$name || !$label) return;

        $config = [];
        if ($type === 'select') {
            $raw = $data['options_raw'] ?? '';
            $config['options'] = array_values(array_filter(array_map('trim', explode("\n", $raw))));
        } elseif ($type === 'boolean_select') {
            $config['options'] = ['-', 'SI', 'NO'];
        } elseif ($type === 'object') {
            $config['fields'] = $data['object_fields'] ?? [];
        } elseif ($type === 'file') {
            $config['con_scadenza'] = isset($data['file_con_scadenza']) && $data['file_con_scadenza'];
        }

        $this->steps[$si]['groups'][$gi]['elements'][] = [
            'id'            => null,
            'name'          => $name,
            'type'          => $type,
            'label'         => $label,
            'placeholder'   => $data['placeholder'] ?? '',
            'required'      => isset($data['required']) && $data['required'],
            'order'         => count($this->steps[$si]['groups'][$gi]['elements']),
            'configuration' => $config,
        ];

        $this->newElement[$si][$gi] = ['type' => 'text'];
    }

    public function removeElement(int $si, int $gi, int $ei): void
    {
        array_splice($this->steps[$si]['groups'][$gi]['elements'], $ei, 1);
        $this->reorderElements($si, $gi);
    }

    public function moveElementUp(int $si, int $gi, int $ei): void
    {
        if ($ei === 0) return;
        $els = &$this->steps[$si]['groups'][$gi]['elements'];
        [$els[$ei - 1], $els[$ei]] = [$els[$ei], $els[$ei - 1]];
        $this->reorderElements($si, $gi);
    }

    public function moveElementDown(int $si, int $gi, int $ei): void
    {
        $els = &$this->steps[$si]['groups'][$gi]['elements'];
        if ($ei >= count($els) - 1) return;
        [$els[$ei], $els[$ei + 1]] = [$els[$ei + 1], $els[$ei]];
        $this->reorderElements($si, $gi);
    }

    private function reorderElements(int $si, int $gi): void
    {
        foreach ($this->steps[$si]['groups'][$gi]['elements'] as $i => &$el) {
            $el['order'] = $i;
        }
    }

    public function addObjectField(int $si, int $gi, int $ei): void
    {
        $field      = $this->newElement[$si][$gi]['obj_field'] ?? [];
        $fieldName  = trim($field['name'] ?? '');
        $fieldLabel = trim($field['label'] ?? '');
        if (!$fieldName || !$fieldLabel) return;

        $this->steps[$si]['groups'][$gi]['elements'][$ei]['configuration']['fields'][] = [
            'name'     => $fieldName,
            'label'    => $fieldLabel,
            'type'     => $field['type'] ?? 'text',
            'required' => isset($field['required']) && $field['required'],
        ];

        $this->newElement[$si][$gi]['obj_field'] = [];
    }

    public function toggleElement(int $si, int $gi, int $ei): void
    {
        $this->openElements[$si][$gi][$ei] = !($this->openElements[$si][$gi][$ei] ?? false);
    }

    public function removeObjectField(int $si, int $gi, int $ei, int $fi): void
    {
        array_splice(
            $this->steps[$si]['groups'][$gi]['elements'][$ei]['configuration']['fields'],
            $fi,
            1
        );
    }

    // ── Persist ──────────────────────────────────────────────────────────────

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $formData = [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
        ];

        if ($this->form && $this->form->exists) {
            $this->form->update($formData);
            $form = $this->form;
        } else {
            $form = Form::create($formData);
        }

        $savedStepIds = [];

        foreach ($this->steps as $si => $stepData) {
            if ($stepData['id']) {
                $step = Step::find($stepData['id']);
                $step->update(['title' => $stepData['title'], 'order' => $si]);
            } else {
                $step = $form->steps()->create(['title' => $stepData['title'], 'order' => $si]);
            }
            $savedStepIds[] = $step->id;

            $savedGroupIds = [];

            foreach ($stepData['groups'] as $gi => $groupData) {
                $groupPayload = [
                    'title'  => $groupData['title'],
                    'header' => $groupData['header'] ?: null,
                    'footer' => $groupData['footer'] ?: null,
                    'order'  => $gi,
                ];

                if ($groupData['id']) {
                    $group = Group::find($groupData['id']);
                    $group->update($groupPayload);
                } else {
                    $group = $step->groups()->create($groupPayload);
                }
                $savedGroupIds[] = $group->id;

                $savedElIds = [];

                foreach ($groupData['elements'] as $ei => $elData) {
                    $payload = [
                        'name'          => $elData['name'],
                        'type'          => $elData['type'],
                        'label'         => $elData['label'],
                        'placeholder'   => $elData['placeholder'] ?? null,
                        'required'      => $elData['required'],
                        'order'         => $ei,
                        'configuration' => $elData['configuration'] ?: null,
                    ];

                    if ($elData['id']) {
                        $el = Element::find($elData['id']);
                        $el->update($payload);
                    } else {
                        $el = $group->elements()->create($payload);
                    }
                    $savedElIds[] = $el->id;
                }

                $group->elements()->whereNotIn('id', $savedElIds)->delete();
            }

            // Cascade in DB handles elements when group deleted
            $step->groups()->whereNotIn('id', $savedGroupIds)->delete();
        }

        // Cascade in DB handles groups → elements when step deleted
        $form->steps()->whereNotIn('id', $savedStepIds)->delete();

        session()->flash('success', 'Form salvato con successo.');
        $this->redirect(route('admin.forms.edit', $form));
    }

    public function render()
    {
        return view('livewire.admin.form-builder')->layout('layouts.app');
    }
}
