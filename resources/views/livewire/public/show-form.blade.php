<div>
    <h2 class="mb-1">{{ $form->name }}</h2>
    @if($form->description)
        <p class="text-muted mb-4">{{ $form->description }}</p>
    @endif

    <!-- Steps Accordion -->
    <div class="accordion mb-4" id="formAccordion">
        @forelse($form->steps as $si => $step)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button {{ $si === 0 ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#step-{{ $step->id }}">
                    Step {{ $si + 1 }}: {{ $step->title }}
                </button>
            </h2>
            <div id="step-{{ $step->id }}" class="accordion-collapse collapse {{ $si === 0 ? 'show' : '' }}" data-bs-parent="#formAccordion">
                <div class="accordion-body">
                    @forelse($step->elements as $element)
                    <div class="mb-4">
                        @if($element->type === 'object')
                            <!-- Object Element: Table -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">
                                    {{ $element->label }}
                                    @if($element->required) <span class="badge bg-danger ms-1 small">*</span> @endif
                                </h6>
                                <button type="button" class="btn btn-sm btn-success" wire:click="openModal({{ $element->id }})">
                                    <i class="fa fa-plus me-1"></i> Aggiungi
                                </button>
                            </div>

                            @php $fields = $element->configuration['fields'] ?? []; @endphp

                            @if($element->objectRecords->isEmpty())
                                <p class="text-muted small">Nessun record.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                @foreach($fields as $field)
                                                    <th>{{ $field['label'] }}</th>
                                                @endforeach
                                                <th class="text-end">Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($element->objectRecords as $record)
                                            <tr>
                                                @foreach($fields as $field)
                                                    <td>{{ $record->data[$field['name']] ?? '–' }}</td>
                                                @endforeach
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-xs btn-sm btn-outline-primary" wire:click="openModal({{ $element->id }}, {{ $record->id }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-sm btn-outline-danger" wire:click="deleteRecord({{ $record->id }})"
                                                            onclick="return confirm('Eliminare questo record?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        @else
                            <!-- Regular Element: Static display -->
                            <label class="form-label fw-semibold">
                                {{ $element->label }}
                                @if($element->required) <span class="text-danger">*</span> @endif
                            </label>

                            @if($element->type === 'text' || $element->type === 'date' || $element->type === 'file')
                                <input type="{{ $element->type }}" class="form-control" placeholder="{{ $element->placeholder }}">
                            @elseif($element->type === 'textarea')
                                <textarea class="form-control" placeholder="{{ $element->placeholder }}" rows="3"></textarea>
                            @elseif($element->type === 'select')
                                <select class="form-select">
                                    <option value="">{{ $element->placeholder ?: 'Seleziona...' }}</option>
                                    @foreach($element->configuration['options'] ?? [] as $opt)
                                        <option>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            @endif
                        @endif
                    </div>
                    @empty
                        <p class="text-muted">Nessun elemento in questo step.</p>
                    @endforelse
                </div>
            </div>
        </div>
        @empty
            <div class="alert alert-info">Questo form non ha step.</div>
        @endforelse
    </div>

    <!-- Object Record Modal -->
    @if($showModal)
    @php
        $el = $form->steps->flatMap(fn($s) => $s->elements)->firstWhere('id', $editingElementId);
        $fields = $el ? ($el->configuration['fields'] ?? []) : [];
    @endphp
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editingRecordId ? 'Modifica Record' : 'Nuovo Record' }} – {{ $el?->label }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    @foreach($fields as $field)
                    <div class="mb-3">
                        <label class="form-label">
                            {{ $field['label'] }}
                            @if($field['required'] ?? false) <span class="text-danger">*</span> @endif
                        </label>
                        @if(($field['type'] ?? 'text') === 'textarea')
                            <textarea class="form-control" wire:model="modalData.{{ $field['name'] }}" rows="3"></textarea>
                        @elseif(($field['type'] ?? 'text') === 'select')
                            <select class="form-select" wire:model="modalData.{{ $field['name'] }}">
                                <option value="">Seleziona...</option>
                                @foreach($field['options'] ?? [] as $opt)
                                    <option>{{ $opt }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="{{ $field['type'] ?? 'text' }}" class="form-control" wire:model="modalData.{{ $field['name'] }}">
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Annulla</button>
                    <button type="button" class="btn btn-primary" wire:click="saveRecord">
                        <i class="fa fa-save me-1"></i> Salva
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
