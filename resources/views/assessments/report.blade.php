<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Laporan Asesmen IMT Discovery - {{ $assessment->user_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #0a0f1d;
            --card-bg: rgba(22, 30, 49, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --primary-accent: #6366f1;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --secondary-gradient: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-growth: #10b981;
            --accent-significance: #f59e0b;
            --accent-connection: #ec4899;
            --accent-security: #3b82f6;
            --accent-contribution: #8b5cf6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(at 15% 15%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 85% 80%, rgba(168, 85, 247, 0.12) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .header-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(99, 102, 241, 0.15);
            color: #818cf8;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .archetype-banner {
            background: var(--primary-gradient);
            padding: 24px 30px;
            border-radius: 18px;
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 12px 30px -8px rgba(99, 102, 241, 0.4);
        }

        .archetype-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.9;
        }

        .archetype-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: #ffffff;
        }

        .archetype-drivers {
            background: rgba(0, 0, 0, 0.25);
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 28px;
        }

        @media (max-width: 768px) {
            .grid-layout {
                grid-template-columns: 1fr;
            }
            .archetype-banner {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 28px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .driver-row {
            margin-bottom: 16px;
        }

        .driver-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .progress-bar-bg {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 9999px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 9999px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .ai-section {
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.8) 100%);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 28px;
            position: relative;
        }

        .ai-badge {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: #0f172a;
            font-weight: 800;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 6px;
            letter-spacing: 0.05em;
        }

        .insight-box {
            background: rgba(255, 255, 255, 0.03);
            border-left: 4px solid var(--primary-accent);
            border-radius: 0 14px 14px 0;
            padding: 20px;
            margin-top: 18px;
        }

        .insight-box h4 {
            color: #e2e8f0;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .insight-box p {
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .insight-box.accent-gold {
            border-left-color: #f59e0b;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-print:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header Profil -->
    <div class="header-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span class="badge-tag">Psikologi Human Drivers (IMT Discovery)</span>
                <h1 class="title">{{ $assessment->user_name }}</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">
                    Tanggal Asesmen: {{ \Carbon\Carbon::parse($assessment->test_date)->translatedFormat('d F Y, H:i') }} WIB
                </p>
            </div>
            <button class="btn-print" onclick="window.print()">
                🖨️ Cetak / PDF
            </button>
        </div>

        <div class="archetype-banner">
            <div>
                <div class="archetype-title">Archetype Kepribadian Anda</div>
                <div class="archetype-name">{{ $archetypeName }}</div>
            </div>
            <div class="archetype-drivers">
                🔥 {{ $primaryDriver }} + {{ $secondaryDriver }}
            </div>
        </div>
    </div>

    <!-- Skor 5 Driver & AI Analysis -->
    <div class="grid-layout">
        
        <!-- Kolom Kiri: Breakdown Skor 5 Driver -->
        <div class="card">
            <h3 class="card-title">
                📊 Skor 5 Human Drivers
            </h3>
            
            @php
                $driverColors = [
                    'Growth'       => '#10b981',
                    'Significance' => '#f59e0b',
                    'Connection'   => '#ec4899',
                    'Security'     => '#3b82f6',
                    'Contribution' => '#8b5cf6',
                ];
            @endphp

            @foreach($scores as $driverName => $score)
                @php
                    $color = $driverColors[$driverName] ?? '#6366f1';
                @endphp
                <div class="driver-row">
                    <div class="driver-info">
                        <span>{{ $driverName }}</span>
                        <span style="color: {{ $color }};">{{ number_format($score, 1) }} / 100</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: {{ $score }}%; background-color: {{ $color }};"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Kolom Kanan: Ringkasan Dominan -->
        <div class="card">
            <h3 class="card-title">
                🎯 Profil Kombinasi Driver
            </h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 16px;">
                Dua dorongan emosional yang paling mendominasi cara Anda mengambil keputusan dan berinteraksi adalah:
            </p>
            
            <div style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                <strong style="color: #a5b4fc;">1. Driver Utama: {{ $primaryDriver }} ({{ number_format($scores[$primaryDriver], 1) }}%)</strong>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 4px;">Kompas utama dalam memotivasi tindakan sehari-hari.</p>
            </div>

            <div style="background: rgba(168, 85, 247, 0.1); border: 1px solid rgba(168, 85, 247, 0.25); border-radius: 12px; padding: 14px;">
                <strong style="color: #d8b4fe;">2. Driver Sekunder: {{ $secondaryDriver }} ({{ number_format($scores[$secondaryDriver], 1) }}%)</strong>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 4px;">Pendorong pendukung yang melengkapi gaya kepemimpinan & relasi Anda.</p>
            </div>
        </div>

    </div>

    <!-- Analisis Mendalam dari Gemini AI -->
    <div class="ai-section">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h3 style="font-size: 1.3rem; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                ✨ Analisis Naratif Psikologi AI
            </h3>
            <span class="ai-badge">GEMINI AI POWERED</span>
        </div>

        <div class="insight-box">
            <h4>💡 Apa Artinya Profil Ini?</h4>
            <p>{{ $aiAnalysis['apa_artinya'] }}</p>
        </div>

        <div class="insight-box accent-gold">
            <h4>🚀 Wawasan Strategis & Pengembangan Diri</h4>
            <p>{{ $aiAnalysis['wawasan_utama'] }}</p>
        </div>
    </div>

</div>

</body>
</html>
