<?php
$filename = 'public/imt-warm-reporting .docx';
$zip = new ZipArchive;
if ($zip->open($filename) === true) {
    $xml = $zip->getFromName('word/document.xml');
    $zip->close();
    $xml = str_replace('</w:p>', "\n", $xml);
    $text = strip_tags($xml);
    echo $text;
} else {
    echo 'Failed to open DOCX';
}
