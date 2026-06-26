<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\Form;
use App\Models\Group;
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
        $grp1a1 = Group::create(['step_id' => $step1a->id, 'title' => 'Dati Anagrafici', 'header' => 'Inserisci i tuoi dati personali.', 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp1a1->id, 'name' => 'nome',         'type' => 'text',   'label' => 'Nome',            'placeholder' => 'Mario',          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1a1->id, 'name' => 'cognome',      'type' => 'text',   'label' => 'Cognome',         'placeholder' => 'Rossi',          'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1a1->id, 'name' => 'data_nascita', 'type' => 'date',   'label' => 'Data di Nascita', 'placeholder' => null,             'required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp1a1->id, 'name' => 'sesso',        'type' => 'select', 'label' => 'Sesso',           'placeholder' => 'Seleziona...',   'required' => true,  'order' => 3, 'configuration' => ['options' => ['Maschio', 'Femmina', 'Preferisco non specificare']]]);
        Element::create(['group_id' => $grp1a1->id, 'name' => 'codice_fiscale','type' => 'text',  'label' => 'Codice Fiscale',  'placeholder' => 'RSSMRA80A01H501Z','required' => true,  'order' => 4, 'configuration' => null]);
        $grp1a2 = Group::create(['step_id' => $step1a->id, 'title' => 'Recapiti', 'header' => 'Come possiamo contattarti?', 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp1a2->id, 'name' => 'email',    'type' => 'text', 'label' => 'Email',    'placeholder' => 'mario@email.it',  'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1a2->id, 'name' => 'telefono', 'type' => 'text', 'label' => 'Telefono', 'placeholder' => '+39 333 0000000',  'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1a2->id, 'name' => 'pec',      'type' => 'text', 'label' => 'PEC',      'placeholder' => 'mario@pec.it',     'required' => false, 'order' => 2, 'configuration' => null]);
        $grp1a3 = Group::create(['step_id' => $step1a->id, 'title' => 'Residenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp1a3->id, 'name' => 'indirizzo', 'type' => 'text', 'label' => 'Indirizzo',  'placeholder' => 'Via Roma, 1',  'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1a3->id, 'name' => 'citta',    'type' => 'text', 'label' => 'Città',      'placeholder' => 'Milano',        'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1a3->id, 'name' => 'cap',      'type' => 'text', 'label' => 'CAP',        'placeholder' => '20100',         'required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp1a3->id, 'name' => 'provincia', 'type' => 'text','label' => 'Provincia',  'placeholder' => 'MI',            'required' => true,  'order' => 3, 'configuration' => null]);

        $step1b = Step::create(['form_id' => $form1->id, 'title' => 'Posizione Richiesta', 'order' => 1]);
        $grp1b1 = Group::create(['step_id' => $step1b->id, 'title' => 'Dettagli Posizione', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp1b1->id, 'name' => 'reparto',   'type' => 'select', 'label' => 'Reparto',        'placeholder' => 'Seleziona...', 'required' => true,  'order' => 0, 'configuration' => ['options' => ['Amministrazione', 'Produzione', 'Logistica', 'IT', 'Commerciale']]]);
        Element::create(['group_id' => $grp1b1->id, 'name' => 'ruolo',     'type' => 'text',   'label' => 'Ruolo Richiesto','placeholder' => 'Es. Analista', 'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1b1->id, 'name' => 'sede',      'type' => 'select', 'label' => 'Sede di Lavoro', 'placeholder' => 'Seleziona...', 'required' => true,  'order' => 2, 'configuration' => ['options' => ['Milano', 'Roma', 'Torino', 'Napoli', 'Remoto']]]);
        $grp1b2 = Group::create(['step_id' => $step1b->id, 'title' => 'Condizioni Contrattuali', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp1b2->id, 'name' => 'contratto',   'type' => 'select',   'label' => 'Tipo Contratto',       'placeholder' => 'Seleziona...', 'required' => true,  'order' => 0, 'configuration' => ['options' => ['Tempo indeterminato', 'Tempo determinato', 'Apprendistato', 'Stage']]]);
        Element::create(['group_id' => $grp1b2->id, 'name' => 'data_inizio', 'type' => 'date',     'label' => 'Data Inizio Prevista', 'placeholder' => null,           'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1b2->id, 'name' => 'ral',         'type' => 'text',     'label' => 'RAL Attesa (€)',       'placeholder' => 'Es. 30000',    'required' => false, 'order' => 2, 'configuration' => null]);
        $grp1b3 = Group::create(['step_id' => $step1b->id, 'title' => 'Disponibilità', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp1b3->id, 'name' => 'orario',      'type' => 'select',   'label' => 'Orario Preferito',   'placeholder' => 'Seleziona...', 'required' => true,  'order' => 0, 'configuration' => ['options' => ['Full time', 'Part time mattina', 'Part time pomeriggio', 'Flessibile']]]);
        Element::create(['group_id' => $grp1b3->id, 'name' => 'trasferte',   'type' => 'select',   'label' => 'Disponibile a Trasferte', 'placeholder' => 'Seleziona...', 'required' => true, 'order' => 1, 'configuration' => ['options' => ['Sì, Italia', 'Sì, Estero', 'No']]]);
        Element::create(['group_id' => $grp1b3->id, 'name' => 'note',        'type' => 'textarea', 'label' => 'Note Aggiuntive',    'placeholder' => 'Eventuali note...', 'required' => false, 'order' => 2, 'configuration' => null]);

        $step1c = Step::create(['form_id' => $form1->id, 'title' => 'Documenti', 'order' => 2]);
        $grp1c1 = Group::create(['step_id' => $step1c->id, 'title' => 'Allegati Obbligatori', 'header' => 'Carica i documenti richiesti in formato PDF o immagine.', 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp1c1->id, 'name' => 'cv',           'type' => 'file', 'label' => 'Curriculum Vitae',      'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1c1->id, 'name' => 'documento_id', 'type' => 'file', 'label' => 'Documento d\'Identità', 'placeholder' => null, 'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1c1->id, 'name' => 'codice_fiscale_doc', 'type' => 'file', 'label' => 'Tessera Sanitaria / CF', 'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        $grp1c2 = Group::create(['step_id' => $step1c->id, 'title' => 'Certificazioni e Titoli', 'header' => 'Allega eventuali certificazioni o titoli di studio aggiuntivi.', 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp1c2->id, 'name' => 'diploma',        'type' => 'file',   'label' => 'Diploma / Laurea',           'placeholder' => null,           'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1c2->id, 'name' => 'certificazioni', 'type' => 'file',   'label' => 'Certificazioni (ZIP/PDF)',    'placeholder' => null,           'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1c2->id, 'name' => 'lingua',         'type' => 'select', 'label' => 'Livello Lingua Inglese',     'placeholder' => 'Seleziona...', 'required' => false, 'order' => 2, 'configuration' => ['options' => ['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'Madrelingua']]]);
        $grp1c3 = Group::create(['step_id' => $step1c->id, 'title' => 'Privacy e Consensi', 'header' => null, 'footer' => 'I dati saranno trattati ai sensi del GDPR 679/2016.', 'order' => 2]);
        Element::create(['group_id' => $grp1c3->id, 'name' => 'consenso_privacy',    'type' => 'select', 'label' => 'Consenso al trattamento dati personali', 'placeholder' => 'Seleziona...', 'required' => true,  'order' => 0, 'configuration' => ['options' => ['Accetto', 'Non accetto']]]);
        Element::create(['group_id' => $grp1c3->id, 'name' => 'consenso_marketing', 'type' => 'select', 'label' => 'Consenso a comunicazioni aziendali',      'placeholder' => 'Seleziona...', 'required' => false, 'order' => 1, 'configuration' => ['options' => ['Sì', 'No']]]);

        $step1d = Step::create(['form_id' => $form1->id, 'title' => 'Esperienze Lavorative', 'order' => 3]);
        $grp1d1 = Group::create(['step_id' => $step1d->id, 'title' => 'Titolo di Studio', 'header' => 'Indica il tuo percorso formativo.', 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp1d1->id, 'name' => 'titolo_studio',  'type' => 'select', 'label' => 'Titolo di Studio',    'placeholder' => 'Seleziona...', 'required' => true,  'order' => 0, 'configuration' => ['options' => ['Licenza media', 'Diploma', 'Laurea triennale', 'Laurea magistrale', 'Master', 'Dottorato']]]);
        Element::create(['group_id' => $grp1d1->id, 'name' => 'istituto',       'type' => 'text',   'label' => 'Istituto / Università','placeholder' => 'Es. Politecnico di Milano', 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1d1->id, 'name' => 'anno_diploma',   'type' => 'text',   'label' => 'Anno di Conseguimento','placeholder' => 'Es. 2018',     'required' => false, 'order' => 2, 'configuration' => null]);
        $grp1d2 = Group::create(['step_id' => $step1d->id, 'title' => 'Storico Esperienze', 'header' => 'Inserisci le tue esperienze lavorative precedenti.', 'footer' => 'Puoi aggiungere più esperienze.', 'order' => 1]);
        $elExp = Element::create([
            'group_id'      => $grp1d2->id,
            'name'          => 'esperienze',
            'type'          => 'object',
            'label'         => 'Esperienze',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'azienda',     'label' => 'Azienda',      'type' => 'text',     'required' => true],
                    ['name' => 'ruolo',       'label' => 'Ruolo',        'type' => 'text',     'required' => true],
                    ['name' => 'dal',         'label' => 'Dal',          'type' => 'date',     'required' => true],
                    ['name' => 'al',          'label' => 'Al',           'type' => 'date',     'required' => false],
                    ['name' => 'descrizione', 'label' => 'Descrizione',  'type' => 'textarea', 'required' => false],
                ],
            ],
        ]);
        ObjectRecord::create(['element_id' => $elExp->id, 'data' => ['azienda' => 'Acme SRL',  'ruolo' => 'Sviluppatore PHP',  'dal' => '2020-01-01', 'al' => '2023-06-30', 'descrizione' => 'Sviluppo applicazioni web Laravel.']]);
        ObjectRecord::create(['element_id' => $elExp->id, 'data' => ['azienda' => 'Beta SpA',  'ruolo' => 'Junior Developer',  'dal' => '2018-09-01', 'al' => '2019-12-31', 'descrizione' => 'Supporto team backend.']]);
        $grp1d3 = Group::create(['step_id' => $step1d->id, 'title' => 'Competenze', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp1d3->id, 'name' => 'competenze_tecniche', 'type' => 'textarea', 'label' => 'Competenze Tecniche',    'placeholder' => 'Es. PHP, Laravel, MySQL...', 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp1d3->id, 'name' => 'competenze_soft',     'type' => 'textarea', 'label' => 'Competenze Trasversali', 'placeholder' => 'Es. team working, problem solving...', 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp1d3->id, 'name' => 'anni_esperienza',     'type' => 'select',   'label' => 'Anni di Esperienza',     'placeholder' => 'Seleziona...', 'required' => true, 'order' => 2, 'configuration' => ['options' => ['Nessuna', 'Meno di 1 anno', '1-3 anni', '3-5 anni', '5-10 anni', 'Oltre 10 anni']]]);


        // ── Form 2: Scheda Prodotto ─────────────────────────────────────────
        $form2 = Form::create([
            'name'        => 'Scheda Prodotto',
            'slug'        => 'scheda-prodotto',
            'description' => 'Inserimento e catalogazione prodotti a magazzino.',
        ]);

        $step2a = Step::create(['form_id' => $form2->id, 'title' => 'Informazioni Generali', 'order' => 0]);
        $grp2a1 = Group::create(['step_id' => $step2a->id, 'title' => 'Identificazione Prodotto', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp2a1->id, 'name' => 'codice_prodotto', 'type' => 'text',     'label' => 'Codice Prodotto', 'placeholder' => 'ES-0001',    'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp2a1->id, 'name' => 'nome_prodotto',   'type' => 'text',     'label' => 'Nome Prodotto',   'placeholder' => 'Nome...',    'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp2a1->id, 'name' => 'categoria',       'type' => 'select',   'label' => 'Categoria',       'placeholder' => 'Seleziona...','required' => true, 'order' => 2, 'configuration' => ['options' => ['Elettronica', 'Abbigliamento', 'Alimentari', 'Utensili', 'Altro']]]);
        Element::create(['group_id' => $grp2a1->id, 'name' => 'descrizione',     'type' => 'textarea', 'label' => 'Descrizione',     'placeholder' => 'Descrivi il prodotto...', 'required' => false, 'order' => 3, 'configuration' => null]);

        $step2b = Step::create(['form_id' => $form2->id, 'title' => 'Prezzi e Stock', 'order' => 1]);
        $grp2b1 = Group::create(['step_id' => $step2b->id, 'title' => 'Dati Commerciali', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp2b1->id, 'name' => 'prezzo',        'type' => 'text', 'label' => 'Prezzo (€)',         'placeholder' => '0.00', 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp2b1->id, 'name' => 'scorte',        'type' => 'text', 'label' => 'Scorte Disponibili', 'placeholder' => '0',    'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp2b1->id, 'name' => 'data_scadenza', 'type' => 'date', 'label' => 'Data Scadenza',      'placeholder' => null,   'required' => false, 'order' => 2, 'configuration' => null]);

        $step2c = Step::create(['form_id' => $form2->id, 'title' => 'Fornitori', 'order' => 2]);
        $grp2c1 = Group::create(['step_id' => $step2c->id, 'title' => 'Lista Fornitori', 'header' => 'Registra i fornitori per questo prodotto.', 'footer' => null, 'order' => 0]);
        $elForn = Element::create([
            'group_id'      => $grp2c1->id,
            'name'          => 'fornitori',
            'type'          => 'object',
            'label'         => 'Fornitori',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'ragione_sociale', 'label' => 'Ragione Sociale', 'type' => 'text', 'required' => true],
                    ['name' => 'codice_fornitore','label' => 'Codice Fornitore','type' => 'text', 'required' => false],
                    ['name' => 'prezzo_acquisto', 'label' => 'Prezzo Acquisto', 'type' => 'text', 'required' => true],
                    ['name' => 'lead_time',       'label' => 'Lead Time (gg)',  'type' => 'text', 'required' => false],
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
        $grp3a1 = Group::create(['step_id' => $step3a->id, 'title' => 'Chi Segnala', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp3a1->id, 'name' => 'nome_segnalante',  'type' => 'text',   'label' => 'Nome e Cognome',    'placeholder' => 'Chi segnala...', 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp3a1->id, 'name' => 'reparto',          'type' => 'select', 'label' => 'Reparto',           'placeholder' => 'Seleziona...',   'required' => true, 'order' => 1, 'configuration' => ['options' => ['Produzione', 'Magazzino', 'Uffici', 'Esterno']]]);
        Element::create(['group_id' => $grp3a1->id, 'name' => 'data_segnalazione','type' => 'date',   'label' => 'Data Segnalazione', 'placeholder' => null,             'required' => true, 'order' => 2, 'configuration' => null]);

        $step3b = Step::create(['form_id' => $form3->id, 'title' => 'Descrizione Guasto', 'order' => 1]);
        $grp3b1 = Group::create(['step_id' => $step3b->id, 'title' => 'Dettagli Guasto', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp3b1->id, 'name' => 'macchinario', 'type' => 'text',     'label' => 'Macchinario / Impianto', 'placeholder' => 'Es. Pressa 3',          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp3b1->id, 'name' => 'priorita',   'type' => 'select',   'label' => 'Priorità',               'placeholder' => 'Seleziona...',          'required' => true,  'order' => 1, 'configuration' => ['options' => ['Bassa', 'Media', 'Alta', 'Bloccante']]]);
        Element::create(['group_id' => $grp3b1->id, 'name' => 'descrizione','type' => 'textarea', 'label' => 'Descrizione Guasto',     'placeholder' => 'Descrivi il problema...','required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp3b1->id, 'name' => 'foto',       'type' => 'file',     'label' => 'Foto (opzionale)',        'placeholder' => null,                    'required' => false, 'order' => 3, 'configuration' => null]);

        $step3c = Step::create(['form_id' => $form3->id, 'title' => 'Interventi Eseguiti', 'order' => 2]);
        $grp3c1 = Group::create(['step_id' => $step3c->id, 'title' => 'Storico Interventi', 'header' => 'Registra gli interventi tecnici effettuati.', 'footer' => null, 'order' => 0]);
        $elInt = Element::create([
            'group_id'      => $grp3c1->id,
            'name'          => 'interventi',
            'type'          => 'object',
            'label'         => 'Storico Interventi',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tecnico',    'label' => 'Tecnico',         'type' => 'text',     'required' => true],
                    ['name' => 'data',       'label' => 'Data Intervento', 'type' => 'date',     'required' => true],
                    ['name' => 'durata_ore', 'label' => 'Durata (ore)',    'type' => 'text',     'required' => false],
                    ['name' => 'esito',      'label' => 'Esito',           'type' => 'select',   'required' => true],
                    ['name' => 'note',       'label' => 'Note',            'type' => 'textarea', 'required' => false],
                ],
            ],
        ]);
        ObjectRecord::create(['element_id' => $elInt->id, 'data' => ['tecnico' => 'Luca Bianchi', 'data' => '2026-06-20', 'durata_ore' => '2', 'esito' => 'Risolto',  'note' => 'Sostituita cinghia di trasmissione.']]);
        ObjectRecord::create(['element_id' => $elInt->id, 'data' => ['tecnico' => 'Marco Verdi',  'data' => '2026-06-22', 'durata_ore' => '1', 'esito' => 'Parziale', 'note' => 'In attesa ricambio valvola.']]);


        // ── Form 4: Registrazione Evento ───────────────────────────────────
        $form4 = Form::create([
            'name'        => 'Registrazione Evento',
            'slug'        => 'registrazione-evento',
            'description' => 'Iscrizione partecipanti a eventi aziendali e corsi di formazione.',
        ]);

        $step4a = Step::create(['form_id' => $form4->id, 'title' => 'Dati Partecipante', 'order' => 0]);
        $grp4a1 = Group::create(['step_id' => $step4a->id, 'title' => 'Dati Personali', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp4a1->id, 'name' => 'nome',     'type' => 'text', 'label' => 'Nome',          'placeholder' => 'Mario',          'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp4a1->id, 'name' => 'cognome',  'type' => 'text', 'label' => 'Cognome',       'placeholder' => 'Rossi',          'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp4a1->id, 'name' => 'email',    'type' => 'text', 'label' => 'Email',         'placeholder' => 'mario@email.it', 'required' => true,  'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp4a1->id, 'name' => 'telefono', 'type' => 'text', 'label' => 'Telefono',      'placeholder' => '+39 000 0000000','required' => false, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grp4a1->id, 'name' => 'azienda',  'type' => 'text', 'label' => 'Azienda / Ente','placeholder' => 'Nome azienda',   'required' => false, 'order' => 4, 'configuration' => null]);

        $step4b = Step::create(['form_id' => $form4->id, 'title' => 'Preferenze Evento', 'order' => 1]);
        $grp4b1 = Group::create(['step_id' => $step4b->id, 'title' => 'Dettagli Iscrizione', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp4b1->id, 'name' => 'edizione',       'type' => 'select',   'label' => 'Edizione',           'placeholder' => 'Seleziona...',                    'required' => true,  'order' => 0, 'configuration' => ['options' => ['Edizione Gennaio 2027', 'Edizione Marzo 2027', 'Edizione Giugno 2027']]]);
        Element::create(['group_id' => $grp4b1->id, 'name' => 'modalita',       'type' => 'select',   'label' => 'Modalità',           'placeholder' => 'Seleziona...',                    'required' => true,  'order' => 1, 'configuration' => ['options' => ['In presenza', 'Online', 'Ibrida']]]);
        Element::create(['group_id' => $grp4b1->id, 'name' => 'esigenze_dieta', 'type' => 'select',   'label' => 'Esigenze Alimentari','placeholder' => 'Seleziona...',                    'required' => false, 'order' => 2, 'configuration' => ['options' => ['Nessuna', 'Vegetariano', 'Vegano', 'Celiaco', 'Altro']]]);
        Element::create(['group_id' => $grp4b1->id, 'name' => 'note',           'type' => 'textarea', 'label' => 'Note o Richieste',   'placeholder' => 'Eventuali richieste speciali...', 'required' => false, 'order' => 3, 'configuration' => null]);

        $step4c = Step::create(['form_id' => $form4->id, 'title' => 'Documenti e Pagamento', 'order' => 2]);
        $grp4c1 = Group::create(['step_id' => $step4c->id, 'title' => 'Documenti', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp4c1->id, 'name' => 'documento_id', 'type' => 'file', 'label' => 'Documento d\'Identità', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        $grp4c2 = Group::create(['step_id' => $step4c->id, 'title' => 'Pagamento', 'header' => 'Allega la ricevuta di pagamento e indica i dettagli.', 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp4c2->id, 'name' => 'ricevuta',        'type' => 'file',   'label' => 'Ricevuta di Pagamento', 'placeholder' => null,           'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp4c2->id, 'name' => 'data_pagamento',  'type' => 'date',   'label' => 'Data Pagamento',        'placeholder' => null,           'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp4c2->id, 'name' => 'metodo_pagamento','type' => 'select', 'label' => 'Metodo di Pagamento',   'placeholder' => 'Seleziona...',  'required' => false, 'order' => 2, 'configuration' => ['options' => ['Bonifico', 'Carta di credito', 'PayPal', 'Contanti']]]);

        $step4d = Step::create(['form_id' => $form4->id, 'title' => 'Accompagnatori', 'order' => 3]);
        $grp4d1 = Group::create(['step_id' => $step4d->id, 'title' => 'Lista Accompagnatori', 'header' => 'Aggiungi eventuali accompagnatori.', 'footer' => null, 'order' => 0]);
        $elAcc = Element::create([
            'group_id'      => $grp4d1->id,
            'name'          => 'accompagnatori',
            'type'          => 'object',
            'label'         => 'Accompagnatori',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'nome',    'label' => 'Nome',    'type' => 'text',   'required' => true],
                    ['name' => 'cognome', 'label' => 'Cognome', 'type' => 'text',   'required' => true],
                    ['name' => 'email',   'label' => 'Email',   'type' => 'text',   'required' => false],
                    ['name' => 'dieta',   'label' => 'Dieta',   'type' => 'select', 'required' => false],
                ],
            ],
        ]);
        ObjectRecord::create(['element_id' => $elAcc->id, 'data' => ['nome' => 'Anna', 'cognome' => 'Verdi', 'email' => 'anna@email.it', 'dieta' => 'Vegetariano']]);
    }
}
