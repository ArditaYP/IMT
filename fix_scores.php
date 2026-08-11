<?php
$file = 'resources/views/laporan.blade.php';
$content = file_get_contents($file);
$content = str_replace('<span class="driver-score" style="color:#2f6fed;">71</span>', '<span class="driver-score" style="color:#2f6fed;">{{ round($scoreSec) }}</span>', $content);
$content = str_replace('<span class="driver-score" style="color:#e8862e;">96</span>', '<span class="driver-score" style="color:#e8862e;">{{ round($scoreSig) }}</span>', $content);
$content = str_replace('<span class="driver-score" style="color:#3aa65a;">77</span>', '<span class="driver-score" style="color:#3aa65a;">{{ round($scoreCon) }}</span>', $content);
$content = str_replace('<span class="driver-score" style="color:#7a5cc7;">94</span>', '<span class="driver-score" style="color:#7a5cc7;">{{ round($scoreGro) }}</span>', $content);
$content = str_replace('<span class="driver-score" style="color:#1f8a6e;">98</span>', '<span class="driver-score" style="color:#1f8a6e;">{{ round($scoreCtr) }}</span>', $content);
file_put_contents($file, $content);
echo 'Fixed scores!';
