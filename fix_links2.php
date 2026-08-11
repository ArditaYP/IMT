<?php
$files = [
    'resources/views/landing.blade.php',
    'resources/views/dashboard.blade.php',
    'resources/views/test.blade.php',
    'resources/views/report.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace hardcoded slash routes with url() or route()
    $content = str_replace('href="/tes"', 'href="{{ route(\'assessment.test\') }}"', $content);
    $content = str_replace('href="/"', 'href="{{ route(\'home\') }}"', $content);
    $content = str_replace('href="/dashboard"', 'href="{{ route(\'dashboard\') }}"', $content);
    
    // Also fix any missed .html
    $content = str_replace('test.html', '{{ route(\'assessment.test\') }}', $content);
    $content = str_replace('index.html', '{{ route(\'home\') }}', $content);
    $content = str_replace('dashboard.html', '{{ route(\'dashboard\') }}', $content);
    $content = str_replace('report.html', '{{ route(\'dashboard\') }}', $content); // fallback
    
    file_put_contents($file, $content);
}
echo "Links updated to Laravel routes.";
