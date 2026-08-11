<?php
$files = [
    'resources/views/landing.blade.php',
    'resources/views/dashboard.blade.php',
    'resources/views/test.blade.php',
    'resources/views/report.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace assets paths
    $content = str_replace('href="assets/', 'href="{{ asset(\'assets/', $content);
    $content = str_replace('.css"', '.css\') }}"', $content);
    $content = str_replace('.png"', '.png\') }}"', $content);
    $content = str_replace('.jpg"', '.jpg\') }}"', $content);
    
    $content = str_replace('src="assets/', 'src="{{ asset(\'assets/', $content);
    // Be careful, data.js in report was already changed to /assets/data.js
    $content = str_replace('src="/assets/', 'src="{{ asset(\'assets/', $content);
    $content = str_replace('.js"', '.js\') }}"', $content);
    
    file_put_contents($file, $content);
}
echo "Assets linked to Laravel asset() helper.";
