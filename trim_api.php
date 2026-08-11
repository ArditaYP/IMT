<?php
$files = [
    'app/Http/Controllers/ChatController.php',
    'app/Services/PsychologicalAIService.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $oldStr = "env('GEMINI_API_KEY', config('services.gemini.api_key'))";
        $newStr = "trim(env('GEMINI_API_KEY', config('services.gemini.api_key')))";
        
        if (strpos($content, $oldStr) !== false && strpos($content, $newStr) === false) {
            $content = str_replace($oldStr, $newStr, $content);
            file_put_contents($file, $content);
            echo "Patched $file\n";
        }
    }
}
