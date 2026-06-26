<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Form</h4>
        <a href="{{ route('admin.forms.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus me-1"></i> Nuovo Form
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if($forms->isEmpty())
                <div class="p-4 text-muted text-center">Nessun form ancora. Creane uno!</div>
            @else
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>Step</th>
                            <th>Creato il</th>
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($forms as $form)
                        <tr>
                            <td>{{ $form->name }}</td>
                            <td><code>{{ $form->slug }}</code></td>
                            <td>{{ $form->steps->count() }}</td>
                            <td>{{ $form->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('forms.show', $form->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Visualizza pubblico">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.forms.edit', $form) }}" class="btn btn-sm btn-outline-primary" title="Modifica">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.forms.delete', $form) }}"
                                   class="btn btn-sm btn-outline-danger"
                                   title="Elimina"
                                   onclick="return confirm('Eliminare questo form?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
