<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ $form ? 'Modifica Form' : 'Nuovo Form' }}</h4>
        <a href="{{ route('admin.forms.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-1"></i> Indietro
        </a>
    </div>

    <!-- Form Info -->
    <div class="card mb-3">
        <div class="card-header"><strong>Informazioni Form</strong></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nome *</label>
                    <input type="text" class="form-control" wire:model.live="name" placeholder="Nome del form">
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug *</label>
                    <input type="text" class="form-control" wire:model="slug" placeholder="slug-del-form">
                    @error('slug') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Descrizione</label>
                    <input type="text" class="form-control" wire:model="description" placeholder="Descrizione opzionale">
                </div>
            </div>
        </div>
    </div>

    <!-- Steps -->
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Step</strong>
        </div>
        <div class="card-body">

            @forelse($steps as $si => $step)
            <div class="card mb-2 border">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <button type="button" class="btn btn-link p-0 text-start fw-bold text-decoration-none"
                            wire:click="toggleStep({{ $si }})">
                        <i class="fa {{ $openSteps[$si] ?? false ? 'fa-chevron-down' : 'fa-chevron-right' }} me-2"></i>
                        Step {{ $si + 1 }}: {{ $step['title'] }}
                        <span class="badge bg-secondary ms-2">{{ count($step['elements']) }} elem.</span>
                    </button>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-secondary" wire:click="moveStepUp({{ $si }})" {{ $si === 0 ? 'disabled' : '' }}>
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" wire:click="moveStepDown({{ $si }})" {{ $si === count($steps) - 1 ? 'disabled' : '' }}>
                            <i class="fa fa-arrow-down"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger" wire:click="removeStep({{ $si }})"
                                onclick="return confirm('Rimuovere questo step?')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>

                @if($openSteps[$si] ?? false)
                <div class="card-body">

                    <!-- Element list -->
                    @forelse($step['elements'] as $ei => $element)
                    <div class="d-flex align-items-start justify-content-between border rounded p-2 mb-2 bg-light">
                        <div>
                            <span class="badge bg-primary me-2">{{ $element['type'] }}</span>
                            <strong>{{ $element['label'] }}</strong>
                            <code class="ms-2 small">{{ $element['name'] }}</code>
                            @if($element['required'])
                                <span class="badge bg-danger ms-1">required</span>
                            @endif
                            @if($element['type'] === 'select' && !empty($element['configuration']['options']))
                                <div class="small text-muted mt-1">
                                    Opzioni: {{ implode(', ', $element['configuration']['options']) }}
                                </div>
                            @endif
                            @if($element['type'] === 'object' && !empty($element['configuration']['fields']))
                                <div class="small text-muted mt-1">
                                    Campi: {{ collect($element['configuration']['fields'])->pluck('label')->implode(', ') }}
                                </div>
                            @endif
                        </div>
                        <div class="btn-group btn-group-sm ms-2 flex-shrink-0">
                            <button type="button" class="btn btn-outline-secondary" wire:click="moveElementUp({{ $si }}, {{ $ei }})" {{ $ei === 0 ? 'disabled' : '' }}>
                                <i class="fa fa-arrow-up"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="moveElementDown({{ $si }}, {{ $ei }})" {{ $ei === count($step['elements']) - 1 ? 'disabled' : '' }}>
                                <i class="fa fa-arrow-down"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" wire:click="removeElement({{ $si }}, {{ $ei }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                        <p class="text-muted small mb-2">Nessun elemento. Aggiungi uno sotto.</p>
                    @endforelse

                    <!-- Add Element Form -->
                    <div class="border rounded p-3 mt-3 bg-white">
                        <h6 class="mb-3">Aggiungi Elemento</h6>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label class="form-label small">Tipo</label>
                                <select class="form-select form-select-sm" wire:model.live="newElement.{{ $si }}.type">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="select">Select</option>
                                    <option value="file">File</option>
                                    <option value="date">Date</option>
                                    <option value="object">Object (sotto-form)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Nome (campo DB)</label>
                                <input type="text" class="form-control form-control-sm" wire:model="newElement.{{ $si }}.name" placeholder="nome_campo">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Label</label>
                                <input type="text" class="form-control form-control-sm" wire:model="newElement.{{ $si }}.label" placeholder="Etichetta">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Placeholder</label>
                                <input type="text" class="form-control form-control-sm" wire:model="newElement.{{ $si }}.placeholder" placeholder="Placeholder">
                            </div>
                        </div>
                        <div class="row g-2 mt-1">
                            <div class="col-auto">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" wire:model="newElement.{{ $si }}.required" id="req-{{ $si }}">
                                    <label class="form-check-label" for="req-{{ $si }}">Obbligatorio</label>
                                </div>
                            </div>
                        </div>

                        @if(($newElement[$si]['type'] ?? 'text') === 'select')
                        <div class="mt-2">
                            <label class="form-label small">Opzioni (una per riga)</label>
                            <textarea class="form-control form-control-sm" rows="3" wire:model="newElement.{{ $si }}.options_raw" placeholder="Opzione 1&#10;Opzione 2&#10;Opzione 3"></textarea>
                        </div>
                        @endif

                        @if(($newElement[$si]['type'] ?? 'text') === 'object')
                        <div class="mt-3 border rounded p-2 bg-light">
                            <h6 class="small mb-2">Campi del sotto-form</h6>
                            @foreach($step['elements'] as $oei => $oel)
                                @if($oel['type'] === 'object' && !empty($oel['configuration']['fields']))
                                    {{-- Mostra i campi degli object element già aggiunti --}}
                                @endif
                            @endforeach
                            <p class="text-muted small">I campi si aggiungeranno dopo aver creato l'elemento di tipo object.</p>
                        </div>
                        @endif

                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-success" wire:click="addElement({{ $si }})">
                                <i class="fa fa-plus me-1"></i> Aggiungi Elemento
                            </button>
                        </div>
                    </div>

                    <!-- Object field editor (for existing object elements) -->
                    @foreach($step['elements'] as $ei => $element)
                        @if($element['type'] === 'object')
                        <div class="border rounded p-3 mt-3 bg-light">
                            <h6 class="mb-2">Campi di "{{ $element['label'] }}" (object)</h6>
                            @foreach($element['configuration']['fields'] ?? [] as $fi => $field)
                            <div class="d-flex align-items-center justify-content-between mb-1 small">
                                <span>
                                    <span class="badge bg-secondary me-1">{{ $field['type'] }}</span>
                                    <strong>{{ $field['label'] }}</strong>
                                    <code class="ms-1">{{ $field['name'] }}</code>
                                    @if($field['required'] ?? false) <span class="badge bg-danger ms-1">req</span> @endif
                                </span>
                                <button type="button" class="btn btn-xs btn-outline-danger btn-sm" wire:click="removeObjectField({{ $si }}, {{ $ei }}, {{ $fi }})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            @endforeach

                            <div class="row g-2 mt-2">
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" wire:model="newElement.{{ $si }}.obj_field.name" placeholder="nome_campo">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" wire:model="newElement.{{ $si }}.obj_field.label" placeholder="Label">
                                </div>
                                <div class="col">
                                    <select class="form-select form-select-sm" wire:model="newElement.{{ $si }}.obj_field.type">
                                        <option value="text">text</option>
                                        <option value="textarea">textarea</option>
                                        <option value="select">select</option>
                                        <option value="date">date</option>
                                        <option value="number">number</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input" wire:model="newElement.{{ $si }}.obj_field.required">
                                        <label class="form-check-label small">Req.</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-success" wire:click="addObjectField({{ $si }}, {{ $ei }})">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach

                </div>
                @endif
            </div>
            @empty
                <p class="text-muted text-center py-3">Nessuno step ancora.</p>
            @endforelse

            <!-- Add Step -->
            <div class="d-flex gap-2 mt-3">
                <input type="text" class="form-control" wire:model="newStepTitle" placeholder="Titolo nuovo step" wire:keydown.enter="addStep">
                <button type="button" class="btn btn-outline-primary flex-shrink-0" wire:click="addStep">
                    <i class="fa fa-plus me-1"></i> Aggiungi Step
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" wire:click="save">
            <i class="fa fa-save me-1"></i> Salva Form
        </button>
        <a href="{{ route('admin.forms.index') }}" class="btn btn-outline-secondary">Annulla</a>
    </div>
</div>
