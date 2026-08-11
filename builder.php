<?php

$html = file_get_contents('public/IMT_Discovery_Report_Ardita_Yasa.html');
$blade = file_get_contents('resources/views/laporan.blade.php');

// Extract the PHP logic block from blade
preg_match('/@php.*?@endphp/s', $blade, $phpBlockMatch);
$phpBlock = $phpBlockMatch[0] ?? '';

// Inject PHP block after <body>
$html = str_replace('<body>', "<body>\n  " . $phpBlock, $html);

// 1. Profile replacements
$html = str_replace('<title>IMT Discovery™ — Laporan Personal Ardita Yasa</title>', '<title>IMT Discovery™ — Laporan Personal {{ $assessment->participant_name ?? $assessment->name ?? \'Peserta\' }}</title>', $html);
$html = str_replace('<div class="avatar">AY</div>', '<div class="avatar">{{ $initials }}</div>', $html);
$html = str_replace('<div class="name">ARDITA<br>YASA</div>', '<div class="name">{{ strtoupper($firstName) }}<br>{{ strtoupper($lastName) }}</div>', $html);

// Dates & IDs
$html = str_replace('17 Jul 2026', '{{ $assessment->created_at ? $assessment->created_at->format(\'d M Y\') : date(\'d M Y\') }}', $html);
$html = str_replace('IMT-D-260717-069', 'IMT-D-{{ $assessment->created_at ? $assessment->created_at->format(\'ymd\') : date(\'ymd\') }}-{{ str_pad($assessment->id, 3, \'0\', STR_PAD_LEFT) }}', $html);

// Archetype
$html = preg_replace('/<h2>THE STRATEGIC<br>EXPLORER™<\/h2>/', '<h2>{!! nl2br(e(strtoupper($arch[\'name\'] ?? $assessment->archetype_name))) !!}</h2>', $html);
$html = preg_replace('/<p>\s*Anda menyukai perkembangan dan perubahan.*?<\/p>/s', '<p>{!! nl2br(e($ai_narasi[\'archetype_box_desc\'] ?? ($arch[\'description\'] ?? \'\'))) !!}</p>', $html);

// Radar Chart
$html = preg_replace('/<polygon points="[^"]+" fill="rgba\(47,111,237,0\.18\)"/', '<polygon points="{{ $polygonPoints }}" fill="rgba(47,111,237,0.18)"', $html);
$html = preg_replace('/<circle cx="300.0" cy="125.1" r="5" fill="#2f6fed" \/>/', '<circle cx="{{ $pSecX }}" cy="{{ $pSecY }}" r="5" fill="#2f6fed" />', $html);
$html = preg_replace('/<circle cx="472.6" cy="203.9" r="5" fill="#e8862e" \/>/', '<circle cx="{{ $pSigX }}" cy="{{ $pSigY }}" r="5" fill="#e8862e" />', $html);
$html = preg_replace('/<circle cx="385.9" cy="378.3" r="5" fill="#3aa65a" \/>/', '<circle cx="{{ $pConX }}" cy="{{ $pConY }}" r="5" fill="#3aa65a" />', $html);
$html = preg_replace('/<circle cx="194.5" cy="404.4" r="5" fill="#7a5cc7" \/>/', '<circle cx="{{ $pGroX }}" cy="{{ $pGroY }}" r="5" fill="#7a5cc7" />', $html);
$html = preg_replace('/<circle cx="123.1" cy="202.5" r="5" fill="#1f8a6e" \/>/', '<circle cx="{{ $pCtrX }}" cy="{{ $pCtrY }}" r="5" fill="#1f8a6e" />', $html);

$html = preg_replace('/<text x="300" y="52"[^>]*>71<\/text>/', '<text x="300" y="52" text-anchor="middle" font-size="18" font-weight="800" fill="#2f6fed">{{ round($scoreSec) }}</text>', $html);
$html = preg_replace('/<text x="530" y="203"[^>]*>96<\/text>/', '<text x="530" y="203" text-anchor="middle" font-size="18" font-weight="800" fill="#e8862e">{{ round($scoreSig) }}</text>', $html);
$html = preg_replace('/<text x="445" y="468"[^>]*>77<\/text>/', '<text x="445" y="468" text-anchor="middle" font-size="18" font-weight="800" fill="#3aa65a">{{ round($scoreCon) }}</text>', $html);
$html = preg_replace('/<text x="160" y="468"[^>]*>94<\/text>/', '<text x="160" y="468" text-anchor="middle" font-size="18" font-weight="800" fill="#7a5cc7">{{ round($scoreGro) }}</text>', $html);
$html = preg_replace('/<text x="70" y="203"[^>]*>98<\/text>/', '<text x="70" y="203" text-anchor="middle" font-size="18" font-weight="800" fill="#1f8a6e">{{ round($scoreCtr) }}</text>', $html);

// Apa Artinya
$html = preg_replace('/<p>\s*Contribution adalah kompas makna Anda.*?<\/p>/s', '<p>{{ $ai_narasi[\'apa_artinya\'] ?? \'Memuat narasi analisis psikologi...\' }}</p>', $html);

file_put_contents('resources/views/laporan.blade.php', $html);
echo "Done!";
