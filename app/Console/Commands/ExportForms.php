<?php

namespace App\Console\Commands;

use App\Models\Form;
use Illuminate\Console\Command;

class ExportForms extends Command
{
    protected $signature = 'forms:export';
    protected $description = 'Export all forms as JSON for seeder reconstruction';

    public function handle(): void
    {
        $forms = Form::with(['steps' => function ($q) {
            $q->orderBy('order')->with(['groups' => function ($q2) {
                $q2->orderBy('order')->with(['elements' => function ($q3) {
                    $q3->orderBy('order');
                }]);
            }]);
        }])->get();

        $this->line(json_encode($forms->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
