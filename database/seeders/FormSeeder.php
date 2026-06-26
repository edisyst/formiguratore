<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\Form;
use App\Models\ObjectRecord;
use App\Models\Step;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        // ── Form 1: Richiesta di Assunzione ────────────────────────────────
        $form1 = Form::create([
            'name'        => 'Richiesta di Assunzione',
            'slug'        => 'richiesta-assunzione',
            'description' => 'Modulo per la raccolta dei dati del candidato e della posizione richiesta.',
        ]);

        $step1a = Step::create(['form_id' => $form1->id, 'title' => 'Dati Personali', 'order' => 0]);
        Element::create(['step_id' => $step1a->id, 'name' => 'nome',             'type' => 'text',     'label' => 'Nome',              'placeholder' => 'Mario',       'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step1a->id, 'name' => 'cognome',          'type' => 'text',     'label' => 'Cognome',           'placeholder' => 'Rossi',       'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['step_id' => $step1a->id, 'name' => 'data_nascita',     'type' => 'date',     'label' => 'Data di Nascita',   'placeholder' => null,          'required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['step_id' => $step1a->id, 'name' => 'email',            'type' => 'text',     'label' => 'Email',             'placeholder' => 'mario@email.it', 'required' => true, 'order' => 3, 'configuration' => null]);

        $step1b = Step::create(['form_id' => $form1->id, 'title' => 'Posizione Richiesta', 'order' => 1]);
        Element::create(['step_id' => $step1b->id, 'name' => 'reparto',          'type' => 'select',   'label' => 'Reparto',           'placeholder' => 'Seleziona...', 'required' => true, 'order' => 0, 'configuration' => ['options' => ['Amministrazione', 'Produzione', 'Logistica', 'IT', 'Commerciale']]]);
        Element::create(['step_id' => $step1b->id, 'name' => 'contratto',        'type' => 'select',   'label' => 'Tipo Contratto',    'placeholder' => 'Seleziona...', 'required' => true, 'order' => 1, 'configuration' => ['options' => ['Tempo indeterminato', 'Tempo determinato', 'Apprendistato', 'Stage']]]);
        Element::create(['step_id' => $step1b->id, 'name' => 'data_inizio',      'type' => 'date',     'label' => 'Data Inizio Prevista', 'placeholder' => null,        'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['step_id' => $step1b->id, 'name' => 'note',             'type' => 'textarea', 'label' => 'Note Aggiuntive',   'placeholder' => 'Eventuali note...', 'required' => false, 'order' => 3, 'configuration' => null]);

        $step1c = Step::create(['form_id' => $form1->id, 'title' => 'Documenti', 'order' => 2]);
        Element::create(['step_id' => $step1c->id, 'name' => 'cv',               'type' => 'file',     'label' => 'Curriculum Vitae',  'placeholder' => null,          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step1c->id, 'name' => 'documento_id',     'type' => 'file',     'label' => 'Documento d\'Identità', 'placeholder' => null,      'required' => true,  'order' => 1, 'configuration' => null]);

        // Step con object: Esperienze Lavorative
        $step1d = Step::create(['form_id' => $form1->id, 'title' => 'Esperienze Lavorative', 'order' => 3]);
        $elExp = Element::create([
            'step_id'       => $step1d->id,
            'name'          => 'esperienze',
            'type'          => 'object',
            'label'         => 'Esperienze',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'azienda',   'label' => 'Azienda',        'type' => 'text',   'required' => true],
                    ['name' => 'ruolo',     'label' => 'Ruolo',          'type' => 'text',   'required' => true],
                    ['name' => 'dal',       'label' => 'Dal',            'type' => 'date',   'required' => true],
                    ['name' => 'al',        'label' => 'Al',             'type' => 'date',   'required' => false],
                    ['name' => 'descrizione', 'label' => 'Descrizione',  'type' => 'textarea', 'required' => false],
                ],
            ],
        ]);

        // Qualche record di esempio
        ObjectRecord::create(['element_id' => $elExp->id, 'data' => ['azienda' => 'Acme SRL', 'ruolo' => 'Sviluppatore PHP', 'dal' => '2020-01-01', 'al' => '2023-06-30', 'descrizione' => 'Sviluppo applicazioni web Laravel.']]);
        ObjectRecord::create(['element_id' => $elExp->id, 'data' => ['azienda' => 'Beta SpA',  'ruolo' => 'Junior Developer',  'dal' => '2018-09-01', 'al' => '2019-12-31', 'descrizione' => 'Supporto team backend.']]);


        // ── Form 2: Scheda Prodotto ─────────────────────────────────────────
        $form2 = Form::create([
            'name'        => 'Scheda Prodotto',
            'slug'        => 'scheda-prodotto',
            'description' => 'Inserimento e catalogazione prodotti a magazzino.',
        ]);

        $step2a = Step::create(['form_id' => $form2->id, 'title' => 'Informazioni Generali', 'order' => 0]);
        Element::create(['step_id' => $step2a->id, 'name' => 'codice_prodotto',  'type' => 'text',     'label' => 'Codice Prodotto',   'placeholder' => 'ES-0001',     'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step2a->id, 'name' => 'nome_prodotto',    'type' => 'text',     'label' => 'Nome Prodotto',     'placeholder' => 'Nome...',     'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['step_id' => $step2a->id, 'name' => 'categoria',        'type' => 'select',   'label' => 'Categoria',         'placeholder' => 'Seleziona...', 'required' => true, 'order' => 2, 'configuration' => ['options' => ['Elettronica', 'Abbigliamento', 'Alimentari', 'Utensili', 'Altro']]]);
        Element::create(['step_id' => $step2a->id, 'name' => 'descrizione',      'type' => 'textarea', 'label' => 'Descrizione',       'placeholder' => 'Descrivi il prodotto...', 'required' => false, 'order' => 3, 'configuration' => null]);

        $step2b = Step::create(['form_id' => $form2->id, 'title' => 'Prezzi e Stock', 'order' => 1]);
        Element::create(['step_id' => $step2b->id, 'name' => 'prezzo',           'type' => 'text',     'label' => 'Prezzo (€)',        'placeholder' => '0.00',        'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step2b->id, 'name' => 'scorte',           'type' => 'text',     'label' => 'Scorte Disponibili','placeholder' => '0',           'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['step_id' => $step2b->id, 'name' => 'data_scadenza',    'type' => 'date',     'label' => 'Data Scadenza',     'placeholder' => null,          'required' => false, 'order' => 2, 'configuration' => null]);

        $step2c = Step::create(['form_id' => $form2->id, 'title' => 'Fornitori', 'order' => 2]);
        $elForn = Element::create([
            'step_id'       => $step2c->id,
            'name'          => 'fornitori',
            'type'          => 'object',
            'label'         => 'Fornitori',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'ragione_sociale', 'label' => 'Ragione Sociale', 'type' => 'text',   'required' => true],
                    ['name' => 'codice_fornitore','label' => 'Codice Fornitore','type' => 'text',   'required' => false],
                    ['name' => 'prezzo_acquisto', 'label' => 'Prezzo Acquisto', 'type' => 'text',   'required' => true],
                    ['name' => 'lead_time',       'label' => 'Lead Time (gg)',  'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        ObjectRecord::create(['element_id' => $elForn->id, 'data' => ['ragione_sociale' => 'Forniture Nord SRL', 'codice_fornitore' => 'FN-001', 'prezzo_acquisto' => '12.50', 'lead_time' => '5']]);
        ObjectRecord::create(['element_id' => $elForn->id, 'data' => ['ragione_sociale' => 'Sud Import SpA',     'codice_fornitore' => 'SI-004', 'prezzo_acquisto' => '11.00', 'lead_time' => '10']]);


        // ── Form 3: Segnalazione Guasto ────────────────────────────────────
        $form3 = Form::create([
            'name'        => 'Segnalazione Guasto',
            'slug'        => 'segnalazione-guasto',
            'description' => 'Segnalazione e tracciamento guasti impianti e macchinari.',
        ]);

        $step3a = Step::create(['form_id' => $form3->id, 'title' => 'Dati Segnalante', 'order' => 0]);
        Element::create(['step_id' => $step3a->id, 'name' => 'nome_segnalante',  'type' => 'text',     'label' => 'Nome e Cognome',    'placeholder' => 'Chi segnala...','required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step3a->id, 'name' => 'reparto',          'type' => 'select',   'label' => 'Reparto',           'placeholder' => 'Seleziona...', 'required' => true, 'order' => 1, 'configuration' => ['options' => ['Produzione', 'Magazzino', 'Uffici', 'Esterno']]]);
        Element::create(['step_id' => $step3a->id, 'name' => 'data_segnalazione','type' => 'date',     'label' => 'Data Segnalazione', 'placeholder' => null,           'required' => true, 'order' => 2, 'configuration' => null]);

        $step3b = Step::create(['form_id' => $form3->id, 'title' => 'Descrizione Guasto', 'order' => 1]);
        Element::create(['step_id' => $step3b->id, 'name' => 'macchinario',      'type' => 'text',     'label' => 'Macchinario / Impianto', 'placeholder' => 'Es. Pressa 3', 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step3b->id, 'name' => 'priorita',         'type' => 'select',   'label' => 'Priorità',          'placeholder' => 'Seleziona...', 'required' => true, 'order' => 1, 'configuration' => ['options' => ['Bassa', 'Media', 'Alta', 'Bloccante']]]);
        Element::create(['step_id' => $step3b->id, 'name' => 'descrizione',      'type' => 'textarea', 'label' => 'Descrizione Guasto','placeholder' => 'Descrivi il problema...', 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['step_id' => $step3b->id, 'name' => 'foto',             'type' => 'file',     'label' => 'Foto (opzionale)',  'placeholder' => null,           'required' => false, 'order' => 3, 'configuration' => null]);

        $step3c = Step::create(['form_id' => $form3->id, 'title' => 'Interventi Eseguiti', 'order' => 2]);
        $elInt = Element::create([
            'step_id'       => $step3c->id,
            'name'          => 'interventi',
            'type'          => 'object',
            'label'         => 'Storico Interventi',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tecnico',      'label' => 'Tecnico',         'type' => 'text',     'required' => true],
                    ['name' => 'data',         'label' => 'Data Intervento', 'type' => 'date',     'required' => true],
                    ['name' => 'durata_ore',   'label' => 'Durata (ore)',    'type' => 'text',     'required' => false],
                    ['name' => 'esito',        'label' => 'Esito',           'type' => 'select',   'required' => true],
                    ['name' => 'note',         'label' => 'Note',            'type' => 'textarea', 'required' => false],
                ],
            ],
        ]);

        ObjectRecord::create(['element_id' => $elInt->id, 'data' => ['tecnico' => 'Luca Bianchi', 'data' => '2026-06-20', 'durata_ore' => '2', 'esito' => 'Risolto', 'note' => 'Sostituita cinghia di trasmissione.']]);
        ObjectRecord::create(['element_id' => $elInt->id, 'data' => ['tecnico' => 'Marco Verdi',  'data' => '2026-06-22', 'durata_ore' => '1', 'esito' => 'Parziale', 'note' => 'In attesa ricambio valvola.']]);


        // ── Form 4: Registrazione Evento ───────────────────────────────────
        $form4 = Form::create([
            'name'        => 'Registrazione Evento',
            'slug'        => 'registrazione-evento',
            'description' => 'Iscrizione partecipanti a eventi aziendali e corsi di formazione.',
        ]);

        $step4a = Step::create(['form_id' => $form4->id, 'title' => 'Dati Partecipante', 'order' => 0]);
        Element::create(['step_id' => $step4a->id, 'name' => 'nome',            'type' => 'text',     'label' => 'Nome',              'placeholder' => 'Mario',          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step4a->id, 'name' => 'cognome',         'type' => 'text',     'label' => 'Cognome',           'placeholder' => 'Rossi',          'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['step_id' => $step4a->id, 'name' => 'email',           'type' => 'text',     'label' => 'Email',             'placeholder' => 'mario@email.it', 'required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['step_id' => $step4a->id, 'name' => 'telefono',        'type' => 'text',     'label' => 'Telefono',          'placeholder' => '+39 000 0000000','required' => false, 'order' => 3, 'configuration' => null]);
        Element::create(['step_id' => $step4a->id, 'name' => 'azienda',         'type' => 'text',     'label' => 'Azienda / Ente',    'placeholder' => 'Nome azienda',   'required' => false, 'order' => 4, 'configuration' => null]);

        $step4b = Step::create(['form_id' => $form4->id, 'title' => 'Preferenze Evento', 'order' => 1]);
        Element::create(['step_id' => $step4b->id, 'name' => 'edizione',        'type' => 'select',   'label' => 'Edizione',          'placeholder' => 'Seleziona...',   'required' => true,  'order' => 0, 'configuration' => ['options' => ['Edizione Gennaio 2027', 'Edizione Marzo 2027', 'Edizione Giugno 2027']]]);
        Element::create(['step_id' => $step4b->id, 'name' => 'modalita',        'type' => 'select',   'label' => 'Modalità',          'placeholder' => 'Seleziona...',   'required' => true,  'order' => 1, 'configuration' => ['options' => ['In presenza', 'Online', 'Ibrida']]]);
        Element::create(['step_id' => $step4b->id, 'name' => 'esigenze_dieta',  'type' => 'select',   'label' => 'Esigenze Alimentari','placeholder' => 'Seleziona...', 'required' => false, 'order' => 2, 'configuration' => ['options' => ['Nessuna', 'Vegetariano', 'Vegano', 'Celiaco', 'Altro']]]);
        Element::create(['step_id' => $step4b->id, 'name' => 'note',            'type' => 'textarea', 'label' => 'Note o Richieste',  'placeholder' => 'Eventuali richieste speciali...', 'required' => false, 'order' => 3, 'configuration' => null]);

        $step4c = Step::create(['form_id' => $form4->id, 'title' => 'Documenti e Pagamento', 'order' => 2]);
        Element::create(['step_id' => $step4c->id, 'name' => 'documento_id',    'type' => 'file',     'label' => 'Documento d\'Identità', 'placeholder' => null,          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['step_id' => $step4c->id, 'name' => 'ricevuta',        'type' => 'file',     'label' => 'Ricevuta di Pagamento', 'placeholder' => null,          'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['step_id' => $step4c->id, 'name' => 'data_pagamento',  'type' => 'date',     'label' => 'Data Pagamento',    'placeholder' => null,             'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['step_id' => $step4c->id, 'name' => 'metodo_pagamento','type' => 'select',   'label' => 'Metodo di Pagamento','placeholder' => 'Seleziona...',  'required' => false, 'order' => 3, 'configuration' => ['options' => ['Bonifico', 'Carta di credito', 'PayPal', 'Contanti']]]);

        $step4d = Step::create(['form_id' => $form4->id, 'title' => 'Accompagnatori', 'order' => 3]);
        $elAcc = Element::create([
            'step_id'       => $step4d->id,
            'name'          => 'accompagnatori',
            'type'          => 'object',
            'label'         => 'Accompagnatori',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'nome',      'label' => 'Nome',     'type' => 'text', 'required' => true],
                    ['name' => 'cognome',   'label' => 'Cognome',  'type' => 'text', 'required' => true],
                    ['name' => 'email',     'label' => 'Email',    'type' => 'text', 'required' => false],
                    ['name' => 'dieta',     'label' => 'Dieta',    'type' => 'select', 'required' => false],
                ],
            ],
        ]);

        ObjectRecord::create(['element_id' => $elAcc->id, 'data' => ['nome' => 'Anna', 'cognome' => 'Verdi', 'email' => 'anna@email.it', 'dieta' => 'Vegetariano']]);
    }
}
