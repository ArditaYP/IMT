<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo \App\Models\UserAssessment::count() . " assessments\n";
echo \App\Models\AssessmentAnswer::count() . " answers\n";
$answers = \App\Models\AssessmentAnswer::where('user_assessment_id', 1)->pluck('score', 'question_id')->toArray();
echo json_encode($answers);
