<x-mail::message>
# Halo, {{ $name }}!

Terima kasih telah menyelesaikan tes **IMT Discovery**.

Kami sangat senang menginformasikan bahwa laporan analisis profil Anda telah selesai diproses. Anda bisa mengakses laporan lengkap Anda kapan saja melalui tautan rahasia di bawah ini:

<x-mail::button :url="$link" color="primary">
Lihat Laporan Saya
</x-mail::button>

Sebagai alternatif, Anda juga bisa menyimpan QR Code di bawah ini. Cukup pindai (scan) menggunakan kamera HP Anda untuk membuka laporan:

<div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
    <img src="{{ $qrCode }}" alt="QR Code Laporan" style="border: 2px solid #e7e9f2; border-radius: 8px; padding: 4px; background: white;">
</div>

Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi admin grup Anda.

Terima kasih,<br>
Tim {{ config('app.name') }}
</x-mail::message>
