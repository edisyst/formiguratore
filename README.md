# Formiguratore

Dynamic multi-step form builder built with Laravel 13, Livewire 3, and Alpine.js.

---

## Stack

- **Laravel 13** — backend, routing, Eloquent ORM
- **Livewire 3** — reactive server-side components (no SPA)
- **Alpine.js** — lightweight client-side behavior (CKEditor bridge, scroll preservation, accordions)
- **Bootstrap 5** — UI
- **CKEditor 5** — rich text editor for group header/footer
- **Tom Select** — enhanced select inputs in object record modals

---

## Modelli e gerarchia dati

La struttura è strettamente gerarchica. Ogni livello appartiene al livello superiore tramite foreign key con `cascadeOnDelete`.

```
Form
 └── Step          (ordinati per `order`)
      └── Group    (ordinati per `order`, header/footer HTML opzionali)
           └── Element  (ordinati per `order`)
                └── ObjectRecord   (solo per elementi di tipo `object`)
```

### Form

Rappresenta un modulo completo (es. "Tecnici progettisti e assimilati").

| Colonna | Tipo | Note |
|---------|------|------|
| `name` | string | Nome visualizzato |
| `slug` | string | Identificatore URL |
| `description` | text | Descrizione opzionale |
| `deleted_at` | timestamp | SoftDeletes attivo |

### Step

Una schermata/tab del form. Visualizzata come accordion nella vista pubblica.

| Colonna | Tipo | Note |
|---------|------|------|
| `form_id` | FK | Cascata su delete |
| `title` | string | Titolo del tab |
| `order` | int | 0-indexed |

### Group

Blocco visivo all'interno di uno step. Può avere intestazione e piè di pagina in HTML (editabile via CKEditor nell'admin).

| Colonna | Tipo | Note |
|---------|------|------|
| `step_id` | FK | Cascata su delete |
| `title` | string | Titolo del blocco |
| `header` | text\|null | HTML renderizzato sopra gli elementi |
| `footer` | text\|null | HTML renderizzato sotto gli elementi |
| `order` | int | 0-indexed |

### Element

Campo singolo all'interno di un group. Il tipo determina il comportamento nella vista pubblica.

| Colonna | Tipo | Note |
|---------|------|------|
| `group_id` | FK | Cascata su delete |
| `uuid` | string | Generato automaticamente al primo salvataggio |
| `name` | string | Identificatore campo (snake_case) |
| `type` | string | Vedi tabella tipi sotto |
| `label` | string | Etichetta visualizzata |
| `placeholder` | string\|null | |
| `required` | boolean | Cast automatico |
| `order` | int | 0-indexed |
| `configuration` | array\|null | Cast JSON — usato per opzioni select e campi object |

**Tipi di elemento supportati:**

| Tipo | Descrizione | `configuration` |
|------|-------------|-----------------|
| `text` | Input testo | — |
| `textarea` | Area testo | — |
| `date` | Input data | — |
| `file` | Upload file | — |
| `checkbox` | Checkbox singolo | — |
| `boolean_select` | Select fisso –/Sì/No | — |
| `select` | Dropdown da lista | `{ "options": ["A", "B", ...] }` |
| `object` | Sotto-form ripetibile | `{ "fields": [ {name, label, type, required, options?}, ... ] }` |

### ObjectRecord

Ogni riga di un elemento `object` è un `ObjectRecord`. I dati dei campi sono serializzati in una colonna JSON.

| Colonna | Tipo | Note |
|---------|------|------|
| `element_id` | FK | Cascata su delete |
| `data` | array | Cast JSON — es. `{"tipo": "Email", "valore": "a@b.it"}` |

Un elemento `object` può avere N record. L'utente aggiunge/modifica/elimina record tramite modal nella vista pubblica.

---

## Flusso di salvataggio a DB

### Admin — costruttore form (`FormBuilder`)

`app/Livewire/Admin/FormBuilder.php`

1. Tutta la struttura (steps → groups → elements → campi object) viene caricata in proprietà pubbliche Livewire al mount.
2. L'utente modifica la struttura nell'UI (aggiunge step, group, element, campi object).
3. Ogni modifica aggiorna le proprietà del componente server-side via `wire:model`.
4. Al click su **Salva**, il metodo `save()`:
   - Valida nome e slug del form
   - Crea/aggiorna il record `Form`
   - Per ogni step → crea/aggiorna `Step`
   - Per ogni group → crea/aggiorna `Group`
   - Per ogni element → crea/aggiorna `Element` (genera UUID se assente)
   - Elimina step/group/element rimossi (cascata automatica sui figli)

### Vista pubblica — record object (`ShowForm`)

`app/Livewire/Public/ShowForm.php`

1. L'utente clicca **Aggiungi** su un elemento `object` → si apre modal.
2. I campi del modal si legano via `wire:model="modalData.<nome_campo>"`.
3. Al click su **Salva** nel modal, `saveRecord()`:
   - Se `editingRecordId` è valorizzato → aggiorna `ObjectRecord` esistente
   - Altrimenti → crea nuovo `ObjectRecord` con `element_id` e `data = modalData`
4. Relazioni ricaricate, modal chiuso.

Per eliminare un record: `deleteRecord($recordId)` esegue `ObjectRecord::destroy()`.

---

## Dati temporanei sul browser

**Non vengono usati `localStorage` né `sessionStorage`.** Lo stato temporaneo vive interamente nelle proprietà pubbliche dei componenti Livewire (server-side), sincronizzate con il browser ad ogni request AJAX.

### Cosa è temporaneo (perso al refresh)

| Dato | Dove vive | Meccanismo |
|------|-----------|------------|
| Struttura form non ancora salvata | `$steps` in `FormBuilder` | Proprietà Livewire server-side |
| Dati modal object record | `$modalData` in `ShowForm` | Proprietà Livewire server-side |
| Step accordion aperto | `$openStepId` in `ShowForm` | Proprietà Livewire server-side |
| Stato panel "Aggiungi Elemento" | `open` Alpine.js | Variabile Alpine locale nel DOM |
| Posizione scroll | variabile JS locale | Salvata su `livewire:request`, ripristinata su `livewire:commit` |

### Alpine.js — ruolo client-side

Alpine gestisce esclusivamente comportamenti UI che non richiedono persistenza:

- **CKEditor 5** (header/footer dei group): l'editor viene inizializzato in un blocco `wire:ignore`. Al cambio del contenuto, Alpine chiama `$wire.set('steps.<i>.groups.<j>.header', value)` per sincronizzare con Livewire.
- **Toggle sorgente HTML**: switch WYSIWYG ↔ HTML raw nel builder admin.
- **Scroll preservation** (vista pubblica): ascolta `livewire:request` → salva `window.scrollY`; ascolta `livewire:commit` → ripristina la posizione dopo l'aggiornamento DOM.
- **Tom Select** (modal vista pubblica): inizializzato sui `<select>` del modal object. Al cambio valore chiama `component.set('modalData.<field>', value)` per aggiornare Livewire.

### Nessuna persistenza parziale

Non esiste un meccanismo di auto-save o draft. Se l'utente abbandona il builder senza salvare, le modifiche sono perse. Lo stesso vale per i dati del modal object se si chiude senza cliccare Salva.

---

## Rotte principali

| Metodo | URI | Componente | Accesso |
|--------|-----|------------|---------|
| GET | `/` | redirect → admin | — |
| GET | `/forms/{form:slug}` | `ShowForm` | pubblico |
| GET | `/admin/forms` | `ListForms` | auth |
| GET | `/admin/forms/create` | `FormBuilder` | auth |
| GET | `/admin/forms/{form}/edit` | `FormBuilder` | auth |
| GET | `/admin/forms/{form}/delete` | soft delete | auth |

---

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

Credenziali admin predefinite (da `DatabaseSeeder`):
- Email: `admin@admin.admin`
- Password: `admin`

---

## Seeder form

`database/seeders/FormSeeder.php` crea tre form di esempio pronti all'uso:

1. **Fornitore di beni e servizi** — 7 step (rappresentante legale, requisiti generali, dati attività, componenti, CCIAA/INPS/INAIL, certificazioni, documentazione)
2. **Tecnici progettisti e assimilati** — 9 step (dichiarante, requisiti generali Art.94/95/98, dati attività, dati previdenziali, tracciabilità, titoli di studio, ordini professionali, certificazioni, documentazione)
3. **Professionisti non tecnici** — 9 step (struttura analoga a Tecnici progettisti, con aggiunta del gruppo "Capacità economico finanziarie" nello step Dati attività)
