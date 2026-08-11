<?php
$zip = new ZipArchive();
$filename = "IMT_Deploy.zip";

if ($zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("Gagal membuat file zip.\n");
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator(__DIR__, RecursiveDirectoryIterator::SKIP_DOTS),
        function ($file, $key, $iterator) {
            // Exclude folders
            $filename = $file->getFilename();
            if ($file->isDir() && in_array($filename, ['.git', 'node_modules', 'tests'])) {
                return false;
            }
            return true;
        }
    )
);

foreach ($iterator as $file) {
    if (!$file->isDir()) {
        $realPath = $file->getRealPath();
        $relativePath = substr($realPath, strlen(__DIR__) + 1);
        $relativePath = str_replace('\\', '/', $relativePath);
        
        if ($relativePath === 'IMT_Deploy.zip' || $relativePath === 'zip_project.php') {
            continue;
        }
        $zip->addFile($realPath, $relativePath);
    }
}
$zip->close();
echo "Zip berhasil dibuat: IMT_Deploy.zip";
