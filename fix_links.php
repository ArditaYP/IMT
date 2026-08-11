<?php
$files = [
    'resources/views/landing.blade.php',
    'resources/views/dashboard.blade.php',
    'resources/views/test.blade.php',
    'resources/views/report.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace links
    $content = str_replace('test.html', '/tes', $content);
    $content = str_replace('index.html', '/', $content);
    $content = str_replace('dashboard.html', '/dashboard', $content);
    
    // For report.html, we just replace it with /hasil for now, 
    // or leave it because the dashboard JS might need to be rewritten to support dynamic IDs.
    // For now, let's point report.html to /dashboard if clicked from sidebar, since dashboard shows the list.
    $content = str_replace('href="report.html"', 'href="/dashboard"', $content);
    
    file_put_contents($file, $content);
}
echo "Links updated.";
