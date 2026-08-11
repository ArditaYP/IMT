<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$drivers = \App\Models\Driver::with('subDrivers')->get();
$questions = \App\Models\Question::with(['driver', 'subDriver'])->get();

$out = "# Laporan Database IMT Discovery\n\n";

$out .= "## 📊 Ringkasan\n";
$out .= "- Total Drivers: " . $drivers->count() . "\n";
$out .= "- Total Sub-Drivers: " . \App\Models\SubDriver::count() . "\n";
$out .= "- Total Pertanyaan: " . $questions->count() . "\n\n";

$out .= "## 🚀 Drivers & Sub-Drivers\n";
foreach($drivers as $driver) {
    $out .= "### " . $driver->name . "\n";
    foreach($driver->subDrivers as $sub) {
        $out .= "- `" . $sub->name . "`\n";
    }
    $out .= "\n";
}

$out .= "## 📝 Daftar Pertanyaan (5 Sampel)\n";
foreach($questions->take(5) as $q) {
    $driverName = $q->driver ? $q->driver->name : 'N/A';
    $subName = $q->subDriver ? $q->subDriver->name : 'N/A';
    $out .= "- **Q" . $q->order . "** [" . $driverName . " > " . $subName . "] (" . $q->type . ") : " . $q->question_text . "\n";
}

file_put_contents('C:/Users/CSO KUTA 2/.gemini/antigravity-cli/brain/41e206b7-5477-42ab-83e8-c35107986439/database_overview.md', $out);
echo "Berhasil!";
