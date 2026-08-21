<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\UserAssessment;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportGeneratedMail;

$userAssessment = UserAssessment::where('name', 'like', '%Ardita%')->orWhere('email', 'arditapinatih@gmail.com')->first();

if ($userAssessment) {
    // Update email just in case it's different
    $userAssessment->email = 'arditapinatih@gmail.com';
    $userAssessment->save();

    echo "Found assessment ID: " . $userAssessment->id . " - " . $userAssessment->name . "\n";
    Mail::to($userAssessment->email)->send(new ReportGeneratedMail($userAssessment));
    echo "Mail dispatched to queue (or sent) successfully for " . $userAssessment->email . "!\n";
} else {
    echo "Could not find any data for Ardita Yasa Pinatih in UserAssessment table.\n";
}
