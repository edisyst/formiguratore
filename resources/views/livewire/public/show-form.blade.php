<div>
<style>
.group-card {
    border: 1px solid #dee2e6;
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
}
.group-card-title {
    padding: 0.75rem 1.25rem 0;
    text-align: center;
    font-size: 1.15rem;
    text-transform: uppercase;
    letter-spacing: .04em;
}
.group-title-rule {
    border: 0;
    border-top: 2px solid #1a56a0;
    margin: 0.4rem 0 0;
    opacity: 1;
}
.group-card-header {
    color: #6c757d;
    font-size: .875rem;
    padding: 0.5rem 1.25rem 0;
    margin: 0;
}
.group-card-body {
    padding: 0.75rem 1.25rem 0.75rem;
}
.group-card-footer {
    color: #6c757d;
    font-size: .875rem;
    padding: 0 1.25rem 0.75rem;
    margin: 0;
}

/* Blue table headers */
.table-blue thead tr th {
    background-color: #1a56a0;
    color: #fff;
    border-color: #1a56a0;
    font-weight: 600;
}
.table-blue {
    border: 1px solid #dee2e6;
    margin-bottom: 0;
}

/* Object/file action links */
.action-link-danger { color: #dc3545; text-decoration: none; font-size: .875rem; }
.action-link-danger:hover { text-decoration: underline; }
.action-link-primary { color: #1a56a0; text-decoration: none; font-size: .875rem; }
.action-link-primary:hover { text-decoration: underline; }

/* Modal */
.modal-header-blue {
    background-color: #1a56a0;
    color: #fff;
    padding: 0.6rem 1rem;
    border-radius: 0;
}
.modal-header-blue .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}
.modal-body.modal-compact {
    padding: 1rem 1.25rem 0.5rem;
}
.modal-footer.modal-compact {
    padding: 0.5rem 1.25rem 0.75rem;
    border-top: none;
    justify-content: flex-start;
}
.modal-body.modal-compact .form-control,
.modal-body.modal-compact .form-select,
.modal-body.modal-compact .ts-wrapper .ts-control {
    border-radius: 2px;
}
.modal-field-label {
    font-size: .85rem;
    margin-bottom: 0.2rem;
}
</style>

    <h2 class="mb-1">{{ $form->name }}</h2>
    @if($form->description)
        <p class="text-muted mb-4">{{ $form->description }}</p>
    @endif

    <!-- Steps Accordion -->
    <div class="accordion mb-4" id="formAccordion">
        @forelse($form->steps as $si => $step)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button {{ $step->id === $openStepId ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#step-{{ $step->id }}">
                    Step {{ $si + 1 }}: {{ $step->title }}
                </button>
            </h2>
            <div id="step-{{ $step->id }}" class="accordion-collapse collapse {{ $step->id === $openStepId ? 'show' : '' }}" data-bs-parent="#formAccordion">
                <div class="accordion-body">

                    @forelse($step->groups as $gi => $group)
                    <div class="group-card mb-4">

                        {{-- Group title --}}
                        <div class="group-card-title">
                            <strong>{{ $group->title }}</strong>
                            <hr class="group-title-rule">
                        </div>

                        @if($group->header)
                            <div class="group-card-header">{!! $group->header !!}</div>
                        @endif

                        <div class="group-card-body">
                            @forelse($group->elements as $element)
                            <div class="mb-4">

                                @if($element->type === 'object')
                                    {{-- Object Element --}}
                                    <div class="mb-2" style="font-size:.85rem;">
                                        @if($element->required) <span class="text-danger me-1">*</span> @endif
                                        {{ $element->label }}
                                    </div>

                                    @php $fields = $element->configuration['fields'] ?? []; @endphp

                                    <div class="table-responsive mb-2">
                                        <table class="table table-sm table-bordered table-blue">
                                            <thead>
                                                <tr>
                                                    @foreach($fields as $field)
                                                        <th>{{ $field['label'] }}</th>
                                                    @endforeach
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($element->objectRecords as $record)
                                                <tr>
                                                    @foreach($fields as $field)
                                                        <td>{{ $record->data[$field['name']] ?? '–' }}</td>
                                                    @endforeach
                                                    <td class="text-nowrap">
                                                        <button type="button" class="action-link-danger btn btn-link p-0 me-2"
                                                                wire:click="deleteRecord({{ $record->id }})"
                                                                wire:confirm="Eliminare questo record?">
                                                            <i class="fa fa-times me-1"></i>Elimina
                                                        </button>
                                                        <button type="button" class="action-link-primary btn btn-link p-0" wire:click="openModal({{ $element->id }}, {{ $record->id }})">
                                                            <i class="fa fa-pencil me-1"></i>Modifica
                                                        </button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="{{ count($fields) + 1 }}" class="text-muted text-center small">Nessun record.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" wire:click="openModal({{ $element->id }})">
                                            <i class="fa fa-plus me-1"></i> Aggiungi
                                        </button>
                                    </div>

                                @elseif($element->type === 'file')
                                    {{-- File Element --}}
                                    <div class="mb-2" style="font-size:.85rem;">
                                        @if($element->required) <span class="text-danger me-1">*</span> @endif
                                        {{ $element->label }}
                                    </div>
                                    <div class="table-responsive mb-2">
                                        <table class="table table-sm table-bordered table-blue">
                                            <thead>
                                                <tr>
                                                    <th>File caricato</th>
                                                    <th style="width:120px;">Scadenza</th>
                                                    <th style="width:100px;">Elimina</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="text-muted text-center small">Nessun file caricato.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <label class="btn btn-primary btn-sm mb-0" style="cursor:pointer;">
                                            <i class="fa fa-plus me-1"></i> Allega documento
                                            <input type="file" class="d-none">
                                        </label>
                                    </div>

                                @elseif($element->type === 'checkbox')
                                    {{-- Checkbox Element --}}
                                    <div class="mb-1" style="font-size:.85rem;">
                                        @if($element->required) <span class="text-danger me-1">*</span> @endif
                                        {{ $element->label }}
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input">
                                    </div>

                                @else
                                    {{-- Regular Element --}}
                                    <label class="form-label mb-1" style="font-size:.85rem;">
                                        @if($element->required) <span class="text-danger me-1">*</span> @endif
                                        {{ $element->label }}
                                    </label>

                                    @if($element->type === 'text' || $element->type === 'date')
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
                                    @elseif($element->type === 'boolean_select')
                                        <select class="form-select">
                                            <option value="">{{ $element->placeholder ?: 'Seleziona...' }}</option>
                                            <option value="-">–</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    @endif
                                @endif

                            </div>
                            @empty
                                <p class="text-muted small">Nessun elemento in questo gruppo.</p>
                            @endforelse
                        </div>

                        @if($group->footer)
                            <div class="group-card-footer">{!! $group->footer !!}</div>
                        @endif

                    </div>
                    @empty
                        <p class="text-muted">Nessun gruppo in questo step.</p>
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
        $modalEl = $form->steps
            ->flatMap(fn($s) => $s->groups)
            ->flatMap(fn($g) => $g->elements)
            ->firstWhere('id', $editingElementId);
        $modalFields = $modalEl ? ($modalEl->configuration['fields'] ?? []) : [];
    @endphp
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,.5); z-index:1055;">
        <div class="modal-dialog" style="max-width:500px;">
            <div class="modal-content" style="border-radius:2px;">
                <div class="modal-header-blue d-flex justify-content-between align-items-center">
                    <span style="font-size:1rem; font-weight:600;">{{ $modalEl?->label }}</span>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body modal-compact">
                    @foreach($modalFields as $field)
                    <div class="mb-3">
                        <div class="modal-field-label">
                            @if($field['required'] ?? false) <span class="text-danger me-1">*</span> @endif
                            {{ $field['label'] }}
                        </div>
                        @if(($field['type'] ?? 'text') === 'textarea')
                            <textarea class="form-control form-control-sm"
                                      wire:model="modalData.{{ $field['name'] }}" rows="3"></textarea>
                        @elseif(($field['type'] ?? 'text') === 'select')
                            <div wire:ignore>
                                <select class="form-select form-select-sm modal-ts-select"
                                        id="ts-{{ $field['name'] }}"
                                        data-livewire-field="{{ $field['name'] }}"
                                        data-livewire-value="{{ $modalData[$field['name']] ?? '' }}">
                                    <option value="">Seleziona...</option>
                                    @foreach($field['options'] ?? [] as $opt)
                                        <option value="{{ $opt }}" {{ ($modalData[$field['name']] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif(($field['type'] ?? 'text') === 'file')
                            <input type="file"
                                   class="form-control form-control-sm"
                                   onchange="@this.set('modalData.{{ $field['name'] }}', this.files[0]?.name ?? '')">
                            @if(!empty($modalData[$field['name']]))
                                <div class="small text-muted mt-1">{{ $modalData[$field['name']] }}</div>
                            @endif
                        @else
                            <input type="{{ $field['type'] ?? 'text' }}"
                                   class="form-control form-control-sm"
                                   wire:model="modalData.{{ $field['name'] }}">
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer modal-compact">
                    <button type="button" class="btn btn-primary btn-sm" wire:click="saveRecord">
                        Invia
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

<script>
(function () {
    /* ── Tom Select ─────────────────────────────────────────────────── */
    function initModalSelects() {
        document.querySelectorAll('.modal-ts-select').forEach(function (el) {
            if (el.tomselect) {
                el.tomselect.destroy();
            }
            var fieldName = el.dataset.livewireField;
            var initialValue = el.dataset.livewireValue;
            var ts = new TomSelect(el, {
                plugins: ['clear_button'],
                placeholder: 'Seleziona...',
                onChange: function (value) {
                    var component = Livewire.find(el.closest('[wire\\:id]').getAttribute('wire:id'));
                    if (component) {
                        component.set('modalData.' + fieldName, value);
                    }
                },
            });
            if (initialValue) {
                ts.setValue(initialValue, true);
            }
        });
    }

    /* ── Save/restore scroll across Livewire updates ────────────────── */
    var savedScrollY = 0;
    document.addEventListener('livewire:request', function () {
        savedScrollY = window.scrollY;
    });
    document.addEventListener('livewire:commit', function () {
        window.scrollTo({ top: savedScrollY, behavior: 'instant' });
    });

    /* ── Sync accordion open state to Livewire ──────────────────────── */
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('modal-ready', function () {
            setTimeout(initModalSelects, 30);
        });

        document.getElementById('formAccordion')?.addEventListener('shown.bs.collapse', function (e) {
            var stepId = parseInt(e.target.id.replace('step-', ''));
            if (!isNaN(stepId)) {
                var component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                if (component) component.set('openStepId', stepId);
            }
        });
    });
})();
</script>
