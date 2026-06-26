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


        // ── Form 5: Dichiarazione Impresa ──────────────────────────────────
        $form5 = Form::create([
            'name'        => 'Dichiarazione Impresa',
            'slug'        => 'dichiarazione-impresa',
            'description' => 'Modulo di dichiarazione per imprese ai fini della partecipazione a procedure di affidamento.',
        ]);

        // ── Step 1: Dichiarante ────────────────────────────────────────────
        $step5a = Step::create(['form_id' => $form5->id, 'title' => 'Dichiarante', 'order' => 0]);

        $grp5a1 = Group::create(['step_id' => $step5a->id, 'title' => 'Dichiarante', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp5a1->id, 'name' => 'nome',           'type' => 'text', 'label' => 'Nome',           'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5a1->id, 'name' => 'cognome',        'type' => 'text', 'label' => 'Cognome',        'placeholder' => null, 'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5a1->id, 'name' => 'codice_fiscale', 'type' => 'text', 'label' => 'Codice fiscale', 'placeholder' => null, 'required' => true,  'order' => 2, 'configuration' => null]);

        $grp5a2 = Group::create(['step_id' => $step5a->id, 'title' => 'Luogo e data di nascita', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp5a2->id, 'name' => 'data_di_nascita', 'type' => 'date', 'label' => 'Data di nascita', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5a2->id, 'name' => 'nazione',         'type' => 'text', 'label' => 'Nazione',         'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5a2->id, 'name' => 'provincia',       'type' => 'text', 'label' => 'Provincia',       'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5a2->id, 'name' => 'citta',           'type' => 'text', 'label' => 'Città',           'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);

        $grp5a3 = Group::create(['step_id' => $step5a->id, 'title' => 'Residenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp5a3->id, 'name' => 'nazione_di_residenza',   'type' => 'text', 'label' => 'Nazione di residenza',   'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5a3->id, 'name' => 'indirizzo_di_residenza', 'type' => 'text', 'label' => 'Indirizzo di residenza', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5a3->id, 'name' => 'provincia_residenza',    'type' => 'text', 'label' => 'Provincia',              'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5a3->id, 'name' => 'citta_residenza',        'type' => 'text', 'label' => 'Città',                  'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grp5a3->id, 'name' => 'cap',                    'type' => 'text', 'label' => 'CAP',                    'placeholder' => null, 'required' => true, 'order' => 4, 'configuration' => null]);

        $grp5a4 = Group::create(['step_id' => $step5a->id, 'title' => 'Dichiarazione Art. 1, Comma 9, Lettera E - Legge 190/2012', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grp5a4->id, 'name' => 'parentela_affinita',           'type' => 'boolean_select', 'label' => 'Per quanto a propria conoscenza, sussistono relazioni di parentela o affinità, tra i titolari, gli amministratori, i soci e i dipendenti dell\'impresa e i dirigenti e i dipendenti dell\'Amministrazione Aggiudicatrice?', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5a4->id, 'name' => 'relazioni_parentela_affinita', 'type' => 'textarea',       'label' => 'Se sì, indicare di seguito le relazioni di parentela o affinità',                                                                                                                                                         'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        // ── Step 2: Dati attività ──────────────────────────────────────────
        $step5b = Step::create(['form_id' => $form5->id, 'title' => 'Dati attività', 'order' => 1]);

        $grp5b1 = Group::create(['step_id' => $step5b->id, 'title' => 'Dati attività', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp5b1->id, 'name' => 'ragione_sociale',             'type' => 'text', 'label' => 'Ragione sociale/Nome e Cognome', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b1->id, 'name' => 'agenzia_stazione_competenza', 'type' => 'text', 'label' => 'Agenzia della Stazione di competenza', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b1->id, 'name' => 'sito_web',                   'type' => 'text', 'label' => 'Sito Web',                        'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);

        $grp5b2 = Group::create(['step_id' => $step5b->id, 'title' => 'Tribunale di competenza', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);

        $grp5b3 = Group::create(['step_id' => $step5b->id, 'title' => 'Ispettorato territoriale del lavoro di competenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);

        $grp5b4 = Group::create(['step_id' => $step5b->id, 'title' => 'Contatti principali', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create([
            'group_id'      => $grp5b4->id,
            'name'          => 'contatti',
            'type'          => 'object',
            'label'         => 'Contatti principali',
            'placeholder'   => null,
            'required'      => true,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tipo',        'label' => 'Tipo',        'type' => 'select', 'required' => true,  'options' => ['Telefono Fisso', 'Telefono Cellulare', 'Email', 'Pec']],
                    ['name' => 'valore',      'label' => 'Valore',      'type' => 'text',   'required' => true],
                    ['name' => 'descrizione', 'label' => 'Descrizione', 'type' => 'text',   'required' => false],
                    ['name' => 'principale',  'label' => 'Principale',  'type' => 'select', 'required' => false, 'options' => ['Sì', 'No']],
                ],
            ],
        ]);

        $grp5b5 = Group::create(['step_id' => $step5b->id, 'title' => 'Sedi', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create([
            'group_id'      => $grp5b5->id,
            'name'          => 'sedi',
            'type'          => 'object',
            'label'         => 'Sedi',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'sede_legale',    'label' => 'Sede Legale',    'type' => 'select', 'required' => false, 'options' => ['Sì', 'No']],
                    ['name' => 'sede_operativa', 'label' => 'Sede Operativa', 'type' => 'select', 'required' => false, 'options' => ['Sì', 'No']],
                    ['name' => 'regione',        'label' => 'Regione',        'type' => 'text',   'required' => false],
                    ['name' => 'provincia',      'label' => 'Provincia',      'type' => 'text',   'required' => false],
                    ['name' => 'comune',         'label' => 'Comune',         'type' => 'text',   'required' => false],
                    ['name' => 'cf_iva',         'label' => 'CF/IVA',         'type' => 'text',   'required' => false],
                    ['name' => 'indirizzo',      'label' => 'Indirizzo',      'type' => 'text',   'required' => false],
                    ['name' => 'stato',          'label' => 'Stato',          'type' => 'text',   'required' => false],
                    ['name' => 'cap',            'label' => 'CAP',            'type' => 'text',   'required' => false],
                    ['name' => 'telefono',       'label' => 'Telefono',       'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        $grp5b6 = Group::create(['step_id' => $step5b->id, 'title' => 'Disponibilità allo svolgimento di prestazioni in condizioni d\'urgenza', 'header' => null, 'footer' => null, 'order' => 5]);
        Element::create(['group_id' => $grp5b6->id, 'name' => 'disponibilita_urgenza', 'type' => 'boolean_select', 'label' => 'Si rende disponibile dei contingenti di prestazione d\'urgenza', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5b7 = Group::create(['step_id' => $step5b->id, 'title' => 'Polizze professionali', 'header' => null, 'footer' => null, 'order' => 6]);
        Element::create([
            'group_id'      => $grp5b7->id,
            'name'          => 'polizze_professionali',
            'type'          => 'object',
            'label'         => 'Polizze professionali',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'compagnia',       'label' => 'Compagnia',       'type' => 'text', 'required' => false],
                    ['name' => 'numero_polizza',   'label' => 'Numero polizza',  'type' => 'text', 'required' => false],
                    ['name' => 'massimale',        'label' => 'Massimale (€)',   'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',         'label' => 'Scadenza',        'type' => 'date', 'required' => false],
                ],
            ],
        ]);

        // ── Step 3: Certificazioni e abilitazioni ──────────────────────────
        $step5c = Step::create(['form_id' => $form5->id, 'title' => 'Certificazioni e abilitazioni', 'order' => 2]);

        $grp5c1 = Group::create(['step_id' => $step5c->id, 'title' => 'Certificazioni', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create([
            'group_id'      => $grp5c1->id,
            'name'          => 'certificazioni',
            'type'          => 'object',
            'label'         => 'Certificazioni',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tipo_certificazione', 'label' => 'Tipo certificazione', 'type' => 'text', 'required' => true],
                    ['name' => 'ente_certificatore',  'label' => 'Ente certificatore',  'type' => 'text', 'required' => false],
                    ['name' => 'numero',              'label' => 'Numero',              'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',            'label' => 'Scadenza',            'type' => 'date', 'required' => false],
                    ['name' => 'allegato',            'label' => 'Allegato',            'type' => 'file', 'required' => false],
                ],
            ],
        ]);

        $grp5c2 = Group::create(['step_id' => $step5c->id, 'title' => 'Possesso abilitazione per realizzazione impianti di cui all\'Art. 1, D.M. 37/2008', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create([
            'group_id'      => $grp5c2->id,
            'name'          => 'abilitazioni_dm37',
            'type'          => 'object',
            'label'         => 'Abilitazioni D.M. 37/2008',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'categoria', 'label' => 'Categoria', 'type' => 'text', 'required' => true],
                    ['name' => 'lettera',   'label' => 'Lettera',   'type' => 'text', 'required' => false],
                ],
            ],
        ]);

        $grp5c3 = Group::create(['step_id' => $step5c->id, 'title' => 'Patente a crediti', 'header' => 'Se non si possiede la patente a crediti, compilare comunque il campo selezionando la voce "non tenuto". La patente con punteggio inferiore a 15 crediti non consente alle imprese e ai lavoratori autonomi di operare nei cantieri temporanei o mobili. Ricorda di tenere aggiornato il campo in caso di variazioni.', 'footer' => null, 'order' => 2]);
        Element::create([
            'group_id'      => $grp5c3->id,
            'name'          => 'patente_crediti',
            'type'          => 'object',
            'label'         => 'Patente a crediti',
            'placeholder'   => null,
            'required'      => true,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'numero',    'label' => 'Numero',    'type' => 'text', 'required' => true],
                    ['name' => 'punteggio', 'label' => 'Punteggio', 'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',  'label' => 'Scadenza',  'type' => 'date', 'required' => false],
                    ['name' => 'allegato',  'label' => 'Allegato',  'type' => 'file', 'required' => false],
                ],
            ],
        ]);

        // ── Step 4: Ulteriore documentazione ──────────────────────────────
        $step5d = Step::create(['form_id' => $form5->id, 'title' => 'Ulteriore documentazione', 'order' => 3]);

        $grp5d1 = Group::create(['step_id' => $step5d->id, 'title' => 'Verifica della progettazione', 'header' => 'Possesso dei requisiti di cui all\'Art. 46 del D.Lgs 36/2023 ovvero il rispetto della NORMA EUROPEA UNI EN ISO 9001 / 17100 ovvero di essere in possesso di SISTEMI INTERNI DI CONTROLLO DI QUALITÀ ai sensi della progettazione.', 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grp5d1->id, 'name' => 'verifica_progettazione', 'type' => 'boolean_select', 'label' => 'Verifica della progettazione', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5d2 = Group::create(['step_id' => $step5d->id, 'title' => 'Coordinamento della sicurezza', 'header' => 'Possesso dei requisiti di cui all\'Art. 46 del D.Lgs 36/2023 ovvero il rispetto della NORMA EUROPEA UNI EN ISO 9001 / 17100 ovvero di essere in possesso di SISTEMI INTERNI DI CONTROLLO DI QUALITÀ con ADEGUATO AGGIORNAMENTO A CADENZA QUINQUENNALE di almeno 40 ore.', 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp5d2->id, 'name' => 'coordinamento_sicurezza', 'type' => 'boolean_select', 'label' => 'Coordinamento della sicurezza', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5d3 = Group::create(['step_id' => $step5d->id, 'title' => 'Collaudo statico', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp5d3->id, 'name' => 'collaudo_statico', 'type' => 'boolean_select', 'label' => 'Apportare alla professionale impegnato e architettura le tecniche di essere specifiche professionali impegnato e architettura di almeno 10 anni', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5d4 = Group::create(['step_id' => $step5d->id, 'title' => 'Collaudo tecnico-amministrativo', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grp5d4->id, 'name' => 'collaudo_tecnico_amministrativo', 'type' => 'boolean_select', 'label' => 'Apportare alla professionale impegnato e architettura le tecniche di essere specifiche professionali impegnato e architettura di almeno cinque anni', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5d5 = Group::create(['step_id' => $step5d->id, 'title' => 'Ulteriore documentazione', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create([
            'group_id'      => $grp5d5->id,
            'name'          => 'ulteriore_documentazione',
            'type'          => 'object',
            'label'         => 'Ulteriore documentazione',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'file',     'label' => 'File',     'type' => 'file', 'required' => false],
                    ['name' => 'scadenza', 'label' => 'Scadenza', 'type' => 'date', 'required' => false],
                ],
            ],
        ]);

        $grp5d6 = Group::create(['step_id' => $step5d->id, 'title' => 'Documentazione integrativa', 'header' => 'Di seguito è possibile allegare eventuali documenti integrativi alla scheda di iscrizione.', 'footer' => null, 'order' => 5]);
        Element::create(['group_id' => $grp5d6->id, 'name' => 'documentazione_integrativa', 'type' => 'file', 'label' => 'Documentazione integrativa', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grp5d7 = Group::create(['step_id' => $step5d->id, 'title' => 'Privacy e termini', 'header' => null, 'footer' => null, 'order' => 6]);
        Element::create(['group_id' => $grp5d7->id, 'name' => 'accettazione_privacy', 'type' => 'checkbox', 'label' => 'Prendete visione di quanto riportato e accettate integralmente l\'informativa privacy consultabile al seguente link Privacy e Termini', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
    }
}
