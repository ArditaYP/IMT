<?php
$file = 'routes/web.php';
$content = file_get_contents($file);

if (strpos($content, 'ChatController') === false) {
    $routes = <<<PHP

use App\Http\Controllers\ChatController;

Route::get('/chat', [ChatController::class, 'index']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);
PHP;

    file_put_contents($file, $content . $routes);
    echo 'Routes added.';
} else {
    echo 'Routes already exist.';
}
