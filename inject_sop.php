<?php
$filename = 'public/imt-warm-reporting .docx';
$zip = new ZipArchive;
$sopText = '';
if ($zip->open($filename) === true) {
    $xml = $zip->getFromName('word/document.xml');
    $zip->close();
    $xml = str_replace('</w:p>', "\n", $xml);
    $sopText = strip_tags($xml);
}

$file = 'app/Services/PsychologicalAIService.php';
$content = file_get_contents($file);

// check if already injected
if (strpos($content, '$sopText = ') === false) {
    $sopDefinition = "\n        \$sopText = <<<'SOP'\n" . $sopText . "\nSOP;\n";
    $content = str_replace('$knowledgeContext = "";', $sopDefinition . "\n        \$knowledgeContext = \"\";", $content);
    
    $injection = "=== SOP PENULISAN (VOICE & STYLE GUIDELINES) ===\n{\$sopText}\n\nINSTRUKSI KHUSUS";
    $content = str_replace("INSTRUKSI KHUSUS", $injection, $content);
    
    file_put_contents($file, $content);
    echo "SOP injected successfully!";
} else {
    echo "SOP already injected.";
}
