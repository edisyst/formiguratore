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
        // ── Form 1: Fornitore di beni e servizi ───────────────────────────
        $formF = Form::create([
            'name'        => 'Fornitore di beni e servizi',
            'slug'        => 'fornitore-beni-servizi',
            'description' => 'Modulo di iscrizione per fornitori di beni e servizi.',
        ]);

        // ── Step 1: Legale Rappresentante Procuratore ─────────────────────
        $stepF1 = Step::create(['form_id' => $formF->id, 'title' => 'Legale Rappresentante Procuratore', 'order' => 0]);

        $grpF1a = Group::create(['step_id' => $stepF1->id, 'title' => 'Anagrafica Rappresentante Legale / Procuratore', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpF1a->id, 'name' => 'nome',           'type' => 'text', 'label' => 'Nome',           'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF1a->id, 'name' => 'cognome',        'type' => 'text', 'label' => 'Cognome',        'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF1a->id, 'name' => 'codice_fiscale', 'type' => 'text', 'label' => 'Codice fiscale', 'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);

        $grpF1b = Group::create(['step_id' => $stepF1->id, 'title' => 'Luogo e Data di Nascita', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpF1b->id, 'name' => 'data_di_nascita', 'type' => 'date', 'label' => 'Data di nascita', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF1b->id, 'name' => 'nazione',         'type' => 'text', 'label' => 'Nazione',         'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF1b->id, 'name' => 'provincia',       'type' => 'text', 'label' => 'Provincia',       'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF1b->id, 'name' => 'citta',           'type' => 'text', 'label' => 'Città',           'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);

        $grpF1c = Group::create(['step_id' => $stepF1->id, 'title' => 'Residenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grpF1c->id, 'name' => 'nazione_di_residenza',   'type' => 'text', 'label' => 'Nazione di residenza',   'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF1c->id, 'name' => 'indirizzo_di_residenza', 'type' => 'text', 'label' => 'Indirizzo di residenza', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF1c->id, 'name' => 'provincia_residenza',    'type' => 'text', 'label' => 'Provincia',              'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF1c->id, 'name' => 'citta_residenza',        'type' => 'text', 'label' => 'Città',                  'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grpF1c->id, 'name' => 'cap',                    'type' => 'text', 'label' => 'CAP',                    'placeholder' => null, 'required' => true, 'order' => 4, 'configuration' => null]);

        $grpF1d = Group::create(['step_id' => $stepF1->id, 'title' => 'Documentazione', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create([
            'group_id'      => $grpF1d->id,
            'name'          => 'documento_di_riconoscimento',
            'type'          => 'object',
            'label'         => 'Documento di riconoscimento',
            'placeholder'   => null,
            'required'      => true,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'file',     'label' => 'File',     'type' => 'file', 'required' => true],
                    ['name' => 'scadenza', 'label' => 'Scadenza', 'type' => 'date', 'required' => false],
                ],
            ],
        ]);
        Element::create(['group_id' => $grpF1d->id, 'name' => 'curriculum_vitae', 'type' => 'file', 'label' => 'Curriculum Vitae', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF1e = Group::create(['step_id' => $stepF1->id, 'title' => 'Dichiarazione Art. 1, Comma 9, Lettera E - Legge 190/2012', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create(['group_id' => $grpF1e->id, 'name' => 'parentela_affinita',           'type' => 'boolean_select', 'label' => 'Per quanto a propria conoscenza, sussistono relazioni di parentela o affinità, tra i titolari, gli amministratori, i soci e i dipendenti dell\'impresa e i dirigenti e i dipendenti dell\'Amministrazione Aggiudicatrice?', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF1e->id, 'name' => 'relazioni_parentela_affinita', 'type' => 'textarea',       'label' => 'Se sì, indicare di seguito le relazioni di parentela o affinità',                                                                                                                                                         'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        // ── Step 2: Requisiti di ordine generale ──────────────────────────
        $stepF2 = Step::create(['form_id' => $formF->id, 'title' => 'Requisiti di ordine generale', 'order' => 1]);

        $grpF2a = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 1 D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpF2a->id, 'name' => 'dichiarazione_art94_c1',       'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non è stata pronunciata sentenza definitiva di condanna, o emesso decreto penale di condanna divenuto irrevocabile, o sentenza di applicazione della pena su richiesta, per uno dei reati di cui al presente comma', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF2a->id, 'name' => 'dichiarazione_art94_c1_note',  'type' => 'textarea',       'label' => 'Se no, indicare le sentenze di condanna subite',                                                                                                                                                                                                                    'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF2b = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 5 D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpF2b->id, 'name' => 'dichiarazione_art94_c5',       'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non ricorre alcuna delle cause di esclusione di cui all\'Art. 94, Comma 5, D.Lgs. 36/2023 (procedure concorsuali, liquidazione, concordato preventivo)', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF2b->id, 'name' => 'dichiarazione_art94_c5_note',  'type' => 'textarea',       'label' => 'Se sì',                                                                                                                                                                                                         'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF2c = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 1 D.Lgs. 36/2023 - Lettera A', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grpF2c->id, 'name' => 'dichiarazione_art94_c1_lA',    'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussiste la causa di esclusione di cui all\'Art. 94, Comma 1, Lettera A, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF2c->id, 'name' => 'dichiarazione_art94_c1_lA_note','type' => 'textarea',      'label' => 'Se sì',                                                                                                                                                                                                          'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF2d = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 3 Lettere A, B D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grpF2d->id, 'name' => 'dichiarazione_art94_c3_lAB',   'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 3, Lettere A e B, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2e = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 3 Lettere C, D D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create(['group_id' => $grpF2e->id, 'name' => 'dichiarazione_art94_c3_lCD',   'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 3, Lettere C e D, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2f = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 4 D.Lgs. 36/2023 Lettera A', 'header' => null, 'footer' => null, 'order' => 5]);
        Element::create(['group_id' => $grpF2f->id, 'name' => 'dichiarazione_art94_c4_lA',    'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussiste la causa di esclusione di cui all\'Art. 94, Comma 4, Lettera A, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2g = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 3 Lettere A, B, C, D D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 6]);
        Element::create(['group_id' => $grpF2g->id, 'name' => 'dichiarazione_art94_c3_lABCD', 'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 3, Lettere A, B, C e D, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2h = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 3 Lettere E, F D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 7]);
        Element::create(['group_id' => $grpF2h->id, 'name' => 'dichiarazione_art94_c3_lEF',   'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 3, Lettere E e F, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2i = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 2 Lettere E, F D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 8]);
        Element::create(['group_id' => $grpF2i->id, 'name' => 'dichiarazione_art94_c2_lEF',   'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 2, Lettere E e F, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        $grpF2l = Group::create(['step_id' => $stepF2->id, 'title' => 'Dichiarazione Art. 94 Comma 2 Lettere G, H D.Lgs. 36/2023', 'header' => null, 'footer' => null, 'order' => 9]);
        Element::create(['group_id' => $grpF2l->id, 'name' => 'dichiarazione_art94_c2_lGH',   'type' => 'boolean_select', 'label' => 'Il sottoscritto dichiara che nei propri confronti non sussistono le cause di esclusione di cui all\'Art. 94, Comma 2, Lettere G e H, D.Lgs. 36/2023', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);

        // ── Step 3: Dati attività ─────────────────────────────────────────
        $stepF3 = Step::create(['form_id' => $formF->id, 'title' => 'Dati attività', 'order' => 2]);

        $grpF3a = Group::create(['step_id' => $stepF3->id, 'title' => 'Dati attività', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpF3a->id, 'name' => 'denominazione',     'type' => 'text',   'label' => 'Denominazione',     'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF3a->id, 'name' => 'forma_giuridica',   'type' => 'select', 'label' => 'Forma giuridica',   'placeholder' => null, 'required' => true,  'order' => 1, 'configuration' => ['options' => ['Ditta individuale', 'Società a responsabilità limitata (SRL)', 'Società per azioni (SpA)', 'Società in nome collettivo (SNC)', 'Società in accomandita semplice (SAS)', 'Società cooperativa', 'Libero professionista', 'Altro']]]);
        Element::create(['group_id' => $grpF3a->id, 'name' => 'numero_dipendenti', 'type' => 'text',   'label' => 'Numero dipendenti', 'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF3a->id, 'name' => 'dimensione_azienda','type' => 'select', 'label' => 'Dimensione azienda','placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => ['options' => ['Micro impresa (fino a 10 persone e fatturato annuale non superiore a 2.000.000,00 euro)', 'Piccola impresa (da 10 a 50 persone e fatturato annuale non superiore a 10.000.000,00 euro)', 'Media impresa (da 50 a 250 persone e fatturato annuale non superiore a 50.000.000,00 euro)', 'Grande impresa (oltre 250 persone o fatturato annuale superiore a 50.000.000,00 euro)']]]);

        $grpF3b = Group::create(['step_id' => $stepF3->id, 'title' => 'Contatti principali', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create([
            'group_id'      => $grpF3b->id,
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

        $grpF3c = Group::create(['step_id' => $stepF3->id, 'title' => 'Dati inerenti tutela della salute e della sicurezza nei luoghi di lavoro, D.Lgs. 81/2008', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'ha_dipendenti',           'type' => 'boolean_select', 'label' => 'La ditta ha personale alle proprie dipendenze?',                                                                             'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'nominativo_rspp',         'type' => 'text',           'label' => 'Nominativo del RSPP',                                                                                                       'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'nominativo_rls',          'type' => 'text',           'label' => 'Nominativo del RLS',                                                                                                        'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'nominativo_medico',       'type' => 'text',           'label' => 'Nominativo del Medico Competente',                                                                                          'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'nominativo_legale_rappr', 'type' => 'text',           'label' => 'Nominativo del Legale Rappresentante/Direttore di Lavoro',                                                                  'placeholder' => null, 'required' => false, 'order' => 4, 'configuration' => null]);
        Element::create(['group_id' => $grpF3c->id, 'name' => 'nominativo_delegato',     'type' => 'text',           'label' => 'Nominativo del Delegato - Procuratore con poteri di firma del DURC afferente alla mansione di coordinamento',               'placeholder' => null, 'required' => false, 'order' => 5, 'configuration' => null]);

        $grpF3d = Group::create(['step_id' => $stepF3->id, 'title' => 'Documento di valutazione dei rischi', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grpF3d->id, 'name' => 'tenuto_dvr', 'type' => 'boolean_select', 'label' => 'Questo soggetto ha alle proprie dipendenze almeno un lavoratore, pertanto è tenuto al DVR', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF3d->id, 'name' => 'dvr_file',   'type' => 'file',           'label' => 'Allega il documento',                                                                        'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF3e = Group::create(['step_id' => $stepF3->id, 'title' => 'Sedi', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create([
            'group_id'      => $grpF3e->id,
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
                    ['name' => 'nazione',        'label' => 'Nazione',        'type' => 'text',   'required' => false],
                    ['name' => 'regione',        'label' => 'Regione',        'type' => 'text',   'required' => false],
                    ['name' => 'provincia',      'label' => 'Provincia',      'type' => 'text',   'required' => false],
                    ['name' => 'comune',         'label' => 'Comune',         'type' => 'text',   'required' => false],
                    ['name' => 'indirizzo',      'label' => 'Indirizzo',      'type' => 'text',   'required' => false],
                    ['name' => 'cap',            'label' => 'CAP',            'type' => 'text',   'required' => false],
                    ['name' => 'cf_iva',         'label' => 'CF/IVA',         'type' => 'text',   'required' => false],
                    ['name' => 'telefono',       'label' => 'Telefono',       'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        $grpF3f = Group::create(['step_id' => $stepF3->id, 'title' => 'Polizze professionali', 'header' => null, 'footer' => null, 'order' => 5]);
        Element::create([
            'group_id'      => $grpF3f->id,
            'name'          => 'polizze_professionali',
            'type'          => 'object',
            'label'         => 'Polizze professionali',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'compagnia',      'label' => 'Compagnia',      'type' => 'text', 'required' => false],
                    ['name' => 'numero_polizza', 'label' => 'Numero polizza', 'type' => 'text', 'required' => false],
                    ['name' => 'massimale',      'label' => 'Massimale (€)',  'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',       'label' => 'Scadenza',       'type' => 'date', 'required' => false],
                ],
            ],
        ]);

        $grpF3g = Group::create(['step_id' => $stepF3->id, 'title' => 'Referenze bancarie', 'header' => null, 'footer' => null, 'order' => 6]);
        Element::create(['group_id' => $grpF3g->id, 'name' => 'referenze_bancarie', 'type' => 'file', 'label' => 'Referenze bancarie', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grpF3h = Group::create(['step_id' => $stepF3->id, 'title' => 'Capacità economico finanziarie', 'header' => null, 'footer' => null, 'order' => 7]);
        Element::create([
            'group_id'      => $grpF3h->id,
            'name'          => 'capacita_economico_finanziaria',
            'type'          => 'object',
            'label'         => 'Capacità economico finanziaria',
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

        $grpF3i = Group::create(['step_id' => $stepF3->id, 'title' => 'Iscrizione alla "White List" per le imprese che operano nei settori a rischio di infiltrazioni mafiose', 'header' => 'La legge n. 190 del 6 novembre 2012 e d.P.C.M. del 18 aprile 2013, pubblicato in G.U. del 15 luglio 2013 n. 163, ha introdotto, presso le Prefetture, particolari liste denominate "White List", nelle quali possono chiedere l\'iscrizione le imprese che operano nei settori esposti a rischio di infiltrazione mafiosa. L\'iscrizione nelle White List costituisce requisito obbligatorio per la partecipazione ad appalti nei settori a rischio. La partecipazione è preclusa alle imprese che non abbiano la possibilità concreta di assumere il collegamento con la Prefettura di competenza.', 'footer' => null, 'order' => 8]);
        Element::create(['group_id' => $grpF3i->id, 'name' => 'iscritta_white_list',        'type' => 'boolean_select', 'label' => 'L\'azienda è iscritta ad una o più White List della Prefettura di competenza?', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF3i->id, 'name' => 'data_iscrizione_white_list', 'type' => 'date',           'label' => 'Data di ultima iscrizione alla White List',                                       'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF3i->id, 'name' => 'allegato_white_list',        'type' => 'file',           'label' => 'Allega documento',                                                               'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);

        // ── Step 4: Elenco componenti ──────────────────────────────────────
        $stepF4 = Step::create(['form_id' => $formF->id, 'title' => 'Elenco componenti', 'order' => 3]);

        $grpF4a = Group::create(['step_id' => $stepF4->id, 'title' => 'Persone fisiche', 'header' => 'Si richiede di inserire i nominativi dei soggetti di cui al comma 3 dell\'Art. 94, D.Lgs. 36/2023:', 'footer' => null, 'order' => 0]);
        Element::create([
            'group_id'      => $grpF4a->id,
            'name'          => 'persone_fisiche',
            'type'          => 'object',
            'label'         => 'Persone fisiche',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'ruolo',                        'label' => 'Ruolo',                                         'type' => 'select', 'required' => true,  'options' => ['Titolare', 'Socio', 'Amministratore', 'Direttore tecnico', 'Procuratore', 'Altro']],
                    ['name' => 'tipologia_documento',          'label' => 'Tipologia Documento',                           'type' => 'select', 'required' => false, 'options' => ['Carta d\'identità', 'Passaporto', 'Patente di guida', 'Altro']],
                    ['name' => 'numero_documento',             'label' => 'Numero documento',                              'type' => 'text',   'required' => false],
                    ['name' => 'quota_partecipazione',         'label' => 'Quota di partecipazione (%)',                   'type' => 'text',   'required' => false],
                    ['name' => 'dichiarazione_assenza_deficit', 'label' => 'Dichiarazione di assenza di deficit di cui al', 'type' => 'text',   'required' => false],
                    ['name' => 'estremi',                      'label' => 'Estremi',                                       'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        $grpF4b = Group::create(['step_id' => $stepF4->id, 'title' => 'Persone giuridiche', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create([
            'group_id'      => $grpF4b->id,
            'name'          => 'persone_giuridiche',
            'type'          => 'object',
            'label'         => 'Persone giuridiche',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'ragione_sociale',              'label' => 'Ragione sociale',                               'type' => 'text', 'required' => true],
                    ['name' => 'tipologia_documento',          'label' => 'Tipologia Documento',                           'type' => 'text', 'required' => false],
                    ['name' => 'numero_documento',             'label' => 'Numero documento',                              'type' => 'text', 'required' => false],
                    ['name' => 'quota_partecipazione',         'label' => 'Quota di partecipazione (%)',                   'type' => 'text', 'required' => false],
                    ['name' => 'dichiarazione_assenza_deficit', 'label' => 'Dichiarazione di assenza di deficit di cui al', 'type' => 'text', 'required' => false],
                    ['name' => 'estremi',                      'label' => 'Estremi',                                       'type' => 'text', 'required' => false],
                ],
            ],
        ]);

        // ── Step 5: CCIAA/Inps/Inail ──────────────────────────────────────
        $stepF5 = Step::create(['form_id' => $formF->id, 'title' => 'CCIAA/Inps/Inail', 'order' => 4]);

        $grpF5a = Group::create(['step_id' => $stepF5->id, 'title' => 'Registro delle imprese', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'non_soggetto_registro_imprese', 'type' => 'boolean_select', 'label' => 'Non soggetto all\'iscrizione al Registro delle Imprese',                 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'visura_camerale',               'type' => 'file',           'label' => 'Visura camerale',                                                         'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'provincia_iscrizione',          'type' => 'text',           'label' => 'Provincia di iscrizione',                                                 'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'data_iscrizione',               'type' => 'date',           'label' => 'Data iscrizione',                                                         'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'piva',                          'type' => 'text',           'label' => 'P.IVA',                                                                   'placeholder' => null, 'required' => false, 'order' => 4, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'codice_ateco_principale',       'type' => 'text',           'label' => 'Codice ateco principale',                                                 'placeholder' => null, 'required' => false, 'order' => 5, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'oggetto_attivita',              'type' => 'textarea',       'label' => 'Oggetto attività',                                                        'placeholder' => null, 'required' => false, 'order' => 6, 'configuration' => null]);
        Element::create(['group_id' => $grpF5a->id, 'name' => 'elementi_registro_imprese',     'type' => 'textarea',       'label' => 'Elementi da menzionare ai fini di iscrizione al Registro delle Imprese', 'placeholder' => null, 'required' => false, 'order' => 7, 'configuration' => null]);

        $grpF5b = Group::create(['step_id' => $stepF5->id, 'title' => 'Soggetto a posizione previdenziale', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpF5b->id, 'name' => 'non_soggetto_posizione_previdenziale', 'type' => 'boolean_select', 'label' => 'Non soggetto a posizione previdenziale',                     'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5b->id, 'name' => 'motivazione_posizione_previdenziale',  'type' => 'textarea',       'label' => 'Motivazione per cui non è soggetto a posizione previdenziale', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF5c = Group::create(['step_id' => $stepF5->id, 'title' => 'Posizioni previdenziali', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create([
            'group_id'      => $grpF5c->id,
            'name'          => 'posizioni_previdenziali',
            'type'          => 'object',
            'label'         => 'Posizioni previdenziali',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tipo',     'label' => 'Tipo',     'type' => 'select', 'required' => true,  'options' => ['INPS']],
                    ['name' => 'matricola','label' => 'Matricola','type' => 'text',   'required' => true],
                    ['name' => 'sede',     'label' => 'Sede',     'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        $grpF5d = Group::create(['step_id' => $stepF5->id, 'title' => 'Posizione INAIL', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grpF5d->id, 'name' => 'non_soggetto_inail',           'type' => 'boolean_select', 'label' => 'Soggetto non tenuto a posizione INAIL',    'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5d->id, 'name' => 'codice_inail',                 'type' => 'text',           'label' => 'Codice INAIL',                             'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF5d->id, 'name' => 'provincia_associazione_inail', 'type' => 'text',           'label' => 'Provincia associazione territoriale',       'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF5d->id, 'name' => 'note_inail',                   'type' => 'textarea',       'label' => 'Note INAIL',                               'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);

        $grpF5e = Group::create(['step_id' => $stepF5->id, 'title' => 'Informazioni attività', 'header' => null, 'footer' => null, 'order' => 4]);
        Element::create(['group_id' => $grpF5e->id, 'name' => 'autocertificazione_ccnl',    'type' => 'file', 'label' => 'Autocertificazione CCNL',             'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5e->id, 'name' => 'agenzia_entrate_competenza', 'type' => 'text', 'label' => 'Agenzia delle Entrate di competenza', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        $grpF5f = Group::create(['step_id' => $stepF5->id, 'title' => 'CCNL applicati', 'header' => null, 'footer' => null, 'order' => 5]);
        Element::create([
            'group_id'      => $grpF5f->id,
            'name'          => 'ccnl_applicati',
            'type'          => 'object',
            'label'         => 'CCNL applicati',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'contratto_collettivo', 'label' => 'Contratto collettivo nazionale', 'type' => 'text', 'required' => true],
                ],
            ],
        ]);

        $grpF5g = Group::create(['step_id' => $stepF5->id, 'title' => 'CNEL', 'header' => null, 'footer' => 'N.B: nel caso in cui non sia possibile il contratto utilizzato, selezionare la voce "ALTRO" e caricare il documento nello step "Ulteriore documentazione".', 'order' => 6]);
        Element::create([
            'group_id'      => $grpF5g->id,
            'name'          => 'cnel',
            'type'          => 'object',
            'label'         => 'CNEL',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'contratto_cnel', 'label' => 'Contratto CNEL', 'type' => 'text', 'required' => false],
                ],
            ],
        ]);

        $grpF5h = Group::create(['step_id' => $stepF5->id, 'title' => 'Tribunale di competenza', 'header' => null, 'footer' => null, 'order' => 7]);
        Element::create(['group_id' => $grpF5h->id, 'name' => 'tribunale_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5h->id, 'name' => 'tribunale_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF5h->id, 'name' => 'tribunale_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF5h->id, 'name' => 'tribunale_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);

        $grpF5i = Group::create(['step_id' => $stepF5->id, 'title' => 'Ispettorato territoriale del lavoro di competenza', 'header' => null, 'footer' => null, 'order' => 8]);
        Element::create(['group_id' => $grpF5i->id, 'name' => 'ispettorato_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpF5i->id, 'name' => 'ispettorato_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpF5i->id, 'name' => 'ispettorato_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpF5i->id, 'name' => 'ispettorato_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => false, 'order' => 3, 'configuration' => null]);

        // ── Step 6: Certificazioni e abilitazioni ──────────────────────────
        $stepF6 = Step::create(['form_id' => $formF->id, 'title' => 'Certificazioni e abilitazioni', 'order' => 5]);

        $grpF6a = Group::create(['step_id' => $stepF6->id, 'title' => 'Certificazioni', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create([
            'group_id'      => $grpF6a->id,
            'name'          => 'certificazioni',
            'type'          => 'object',
            'label'         => 'Certificazioni',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'tipologia',        'label' => 'Tipologia',          'type' => 'text',   'required' => true],
                    ['name' => 'standard',         'label' => 'Standard',           'type' => 'text',   'required' => false],
                    ['name' => 'data',             'label' => 'Data',               'type' => 'date',   'required' => false],
                    ['name' => 'scadenza',         'label' => 'Scadenza',           'type' => 'date',   'required' => false],
                    ['name' => 'settore',          'label' => 'Settore',            'type' => 'text',   'required' => false],
                    ['name' => 'in_corso_rinnovo', 'label' => 'In corso di rinnovo','type' => 'select', 'required' => false, 'options' => ['Sì', 'No']],
                    ['name' => 'verifica',         'label' => 'Verifica',           'type' => 'file',   'required' => false],
                ],
            ],
        ]);

        $grpF6b = Group::create(['step_id' => $stepF6->id, 'title' => 'Possesso abilitazione per realizzazione impianti di cui all\'Art. 1, D.M. 37/2008', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create([
            'group_id'      => $grpF6b->id,
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

        $grpF6c = Group::create(['step_id' => $stepF6->id, 'title' => 'Patente a crediti', 'header' => 'Se non si possiede la patente a crediti, compilare comunque il campo selezionando la voce "non tenuto". La patente con punteggio inferiore a 15 crediti non consente alle imprese e ai lavoratori autonomi di operare nei cantieri temporanei o mobili. Ricorda di tenere aggiornato il campo in caso di variazioni.', 'footer' => null, 'order' => 2]);
        Element::create([
            'group_id'      => $grpF6c->id,
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

        // ── Step 7: Ulteriore documentazione ──────────────────────────────
        $stepF7 = Step::create(['form_id' => $formF->id, 'title' => 'Ulteriore documentazione', 'order' => 6]);

        $grpF7a = Group::create(['step_id' => $stepF7->id, 'title' => 'Capacità economiche e tecnico professionali', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpF7a->id, 'name' => 'elenco_attivita_triennio', 'type' => 'file', 'label' => 'Elenco attività svolte nell\'ultimo triennio', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grpF7b = Group::create(['step_id' => $stepF7->id, 'title' => 'Documentazione integrativa', 'header' => 'Di seguito è possibile allegare eventuali documenti integrativi alla richiesta di iscrizione.', 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpF7b->id, 'name' => 'documentazione_integrativa', 'type' => 'file', 'label' => 'Documentazione integrativa', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grpF7c = Group::create(['step_id' => $stepF7->id, 'title' => 'Privacy e termini', 'header' => 'Dichiaro di aver preso visione e di accettare integralmente l\'informativa privacy consultabile al seguente link Privacy e Termini', 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grpF7c->id, 'name' => 'accetto_privacy', 'type' => 'checkbox', 'label' => 'Accetto l\'informativa sulla privacy', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);


        // ══════════════════════════════════════════════════════════════════════
        // ██  FORM 2 — TECNICI PROGETTISTI E ASSIMILATI (PT)
        // ══════════════════════════════════════════════════════════════════════
        $form5 = Form::create([
            'name'        => 'Tecnici progettisti e assimilati',
            'slug'        => 'tecnici-progettisti-assimilati',
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
        Element::create(['group_id' => $grp5b1->id, 'name' => 'ragione_sociale',             'type' => 'text', 'label' => 'Ragione sociale/Nome e Cognome',       'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b1->id, 'name' => 'agenzia_stazione_competenza', 'type' => 'text', 'label' => 'Agenzia della Stazione di competenza', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b1->id, 'name' => 'sito_web',                   'type' => 'text', 'label' => 'Sito Web',                             'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);

        $grp5b2 = Group::create(['step_id' => $step5b->id, 'title' => 'Tribunale di competenza', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5b2->id, 'name' => 'tribunale_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);

        $grp5b3 = Group::create(['step_id' => $step5b->id, 'title' => 'Ispettorato territoriale del lavoro di competenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_nazione',   'type' => 'text', 'label' => 'Nazione',   'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_provincia', 'type' => 'text', 'label' => 'Provincia', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_comune',    'type' => 'text', 'label' => 'Comune',    'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grp5b3->id, 'name' => 'ispettorato_indirizzo', 'type' => 'text', 'label' => 'Indirizzo', 'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);

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
                    ['name' => 'compagnia',     'label' => 'Compagnia',      'type' => 'text', 'required' => false],
                    ['name' => 'numero_polizza','label' => 'Numero polizza',  'type' => 'text', 'required' => false],
                    ['name' => 'massimale',     'label' => 'Massimale (€)',   'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',      'label' => 'Scadenza',        'type' => 'date', 'required' => false],
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

        // ══════════════════════════════════════════════════════════════════════
        // ██  FORM 3 — PROFESSIONISTI NON TECNICI (PNT)
        // ══════════════════════════════════════════════════════════════════════
        $formPnt = Form::create([
            'name'        => 'Professionisti non tecnici',
            'slug'        => 'professionisti-non-tecnici',
            'description' => 'Modulo di dichiarazione per professionisti non tecnici ai fini della partecipazione a procedure di affidamento.',
        ]);

        // ── Step 1: Dichiarante ────────────────────────────────────────────
        $stepPnt1 = Step::create(['form_id' => $formPnt->id, 'title' => 'Dichiarante', 'order' => 0]);

        $grpPnt1a = Group::create(['step_id' => $stepPnt1->id, 'title' => 'Dichiarante', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpPnt1a->id, 'name' => 'nome',           'type' => 'text', 'label' => 'Nome',           'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1a->id, 'name' => 'cognome',        'type' => 'text', 'label' => 'Cognome',        'placeholder' => null, 'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1a->id, 'name' => 'codice_fiscale', 'type' => 'text', 'label' => 'Codice fiscale', 'placeholder' => null, 'required' => true,  'order' => 2, 'configuration' => null]);

        $grpPnt1b = Group::create(['step_id' => $stepPnt1->id, 'title' => 'Luogo e data di nascita', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpPnt1b->id, 'name' => 'data_di_nascita', 'type' => 'date', 'label' => 'Data di nascita', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1b->id, 'name' => 'nazione',         'type' => 'text', 'label' => 'Nazione',         'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1b->id, 'name' => 'provincia',       'type' => 'text', 'label' => 'Provincia',       'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1b->id, 'name' => 'citta',           'type' => 'text', 'label' => 'Città',           'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);

        $grpPnt1c = Group::create(['step_id' => $stepPnt1->id, 'title' => 'Residenza', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create(['group_id' => $grpPnt1c->id, 'name' => 'nazione_di_residenza',   'type' => 'text', 'label' => 'Nazione di residenza',   'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1c->id, 'name' => 'indirizzo_di_residenza', 'type' => 'text', 'label' => 'Indirizzo di residenza', 'placeholder' => null, 'required' => true, 'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1c->id, 'name' => 'provincia_residenza',    'type' => 'text', 'label' => 'Provincia',              'placeholder' => null, 'required' => true, 'order' => 2, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1c->id, 'name' => 'citta_residenza',        'type' => 'text', 'label' => 'Città',                  'placeholder' => null, 'required' => true, 'order' => 3, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1c->id, 'name' => 'cap',                    'type' => 'text', 'label' => 'CAP',                    'placeholder' => null, 'required' => true, 'order' => 4, 'configuration' => null]);

        $grpPnt1d = Group::create(['step_id' => $stepPnt1->id, 'title' => 'Dichiarazione Art. 1, Comma 9, Lettera E - Legge 190/2012', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create(['group_id' => $grpPnt1d->id, 'name' => 'parentela_affinita',           'type' => 'boolean_select', 'label' => 'Per quanto a propria conoscenza, sussistono relazioni di parentela o affinità, tra i titolari, gli amministratori, i soci e i dipendenti dell\'impresa e i dirigenti e i dipendenti dell\'Amministrazione Aggiudicatrice?', 'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt1d->id, 'name' => 'relazioni_parentela_affinita', 'type' => 'textarea',       'label' => 'Se sì, indicare di seguito le relazioni di parentela o affinità',                                                                                                                                                         'placeholder' => null, 'required' => false, 'order' => 1, 'configuration' => null]);

        // ── Step 2: Dati attività ──────────────────────────────────────────
        $stepPnt2 = Step::create(['form_id' => $formPnt->id, 'title' => 'Dati attività', 'order' => 1]);

        $grpPnt2a = Group::create(['step_id' => $stepPnt2->id, 'title' => 'Dati attività', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpPnt2a->id, 'name' => 'ragione_sociale',             'type' => 'text', 'label' => 'Ragione sociale/Nome e Cognome',       'placeholder' => null, 'required' => true,  'order' => 0, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt2a->id, 'name' => 'agenzia_stazione_competenza', 'type' => 'text', 'label' => 'Agenzia della Stazione di competenza', 'placeholder' => null, 'required' => true,  'order' => 1, 'configuration' => null]);
        Element::create(['group_id' => $grpPnt2a->id, 'name' => 'sito_web',                   'type' => 'text', 'label' => 'Sito Web',                             'placeholder' => null, 'required' => false, 'order' => 2, 'configuration' => null]);

        $grpPnt2b = Group::create(['step_id' => $stepPnt2->id, 'title' => 'Contatti principali', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create([
            'group_id'      => $grpPnt2b->id,
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

        $grpPnt2c = Group::create(['step_id' => $stepPnt2->id, 'title' => 'Sedi', 'header' => null, 'footer' => null, 'order' => 2]);
        Element::create([
            'group_id'      => $grpPnt2c->id,
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
                    ['name' => 'cap',            'label' => 'CAP',            'type' => 'text',   'required' => false],
                    ['name' => 'telefono',       'label' => 'Telefono',       'type' => 'text',   'required' => false],
                ],
            ],
        ]);

        $grpPnt2d = Group::create(['step_id' => $stepPnt2->id, 'title' => 'Polizze professionali', 'header' => null, 'footer' => null, 'order' => 3]);
        Element::create([
            'group_id'      => $grpPnt2d->id,
            'name'          => 'polizze_professionali',
            'type'          => 'object',
            'label'         => 'Polizze professionali',
            'placeholder'   => null,
            'required'      => false,
            'order'         => 0,
            'configuration' => [
                'fields' => [
                    ['name' => 'compagnia',     'label' => 'Compagnia',      'type' => 'text', 'required' => false],
                    ['name' => 'numero_polizza','label' => 'Numero polizza',  'type' => 'text', 'required' => false],
                    ['name' => 'massimale',     'label' => 'Massimale (€)',   'type' => 'text', 'required' => false],
                    ['name' => 'scadenza',      'label' => 'Scadenza',        'type' => 'date', 'required' => false],
                ],
            ],
        ]);

        // ── Step 3: Certificazioni e abilitazioni ──────────────────────────
        $stepPnt3 = Step::create(['form_id' => $formPnt->id, 'title' => 'Certificazioni e abilitazioni', 'order' => 2]);

        $grpPnt3a = Group::create(['step_id' => $stepPnt3->id, 'title' => 'Certificazioni', 'header' => null, 'footer' => null, 'order' => 0]);
        Element::create([
            'group_id'      => $grpPnt3a->id,
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

        // ── Step 4: Ulteriore documentazione ──────────────────────────────
        $stepPnt4 = Step::create(['form_id' => $formPnt->id, 'title' => 'Ulteriore documentazione', 'order' => 3]);

        $grpPnt4a = Group::create(['step_id' => $stepPnt4->id, 'title' => 'Documentazione integrativa', 'header' => 'Di seguito è possibile allegare eventuali documenti integrativi alla scheda di iscrizione.', 'footer' => null, 'order' => 0]);
        Element::create(['group_id' => $grpPnt4a->id, 'name' => 'documentazione_integrativa', 'type' => 'file', 'label' => 'Documentazione integrativa', 'placeholder' => null, 'required' => false, 'order' => 0, 'configuration' => null]);

        $grpPnt4b = Group::create(['step_id' => $stepPnt4->id, 'title' => 'Privacy e termini', 'header' => null, 'footer' => null, 'order' => 1]);
        Element::create(['group_id' => $grpPnt4b->id, 'name' => 'accettazione_privacy', 'type' => 'checkbox', 'label' => 'Prendete visione di quanto riportato e accettate integralmente l\'informativa privacy consultabile al seguente link Privacy e Termini', 'placeholder' => null, 'required' => true, 'order' => 0, 'configuration' => null]);
    }
}
