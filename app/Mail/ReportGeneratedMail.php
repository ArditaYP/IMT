<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\UserAssessment;

class ReportGeneratedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $assessment;

    /**
     * Create a new message instance.
     */
    public function __construct(UserAssessment $assessment)
    {
        $this->assessment = $assessment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan IMT Discovery Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $link = route('assessment.laporan', $this->assessment->uuid);
        
        // Generate QR Code PNG format using chillerlan (ext-gd)
        $options = new \chillerlan\QRCode\QROptions([
            'outputType' => \chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'   => \chillerlan\QRCode\QRCode::ECC_L,
            'scale'      => 8, // ~250px depending on payload
            'imageBase64' => false, // Kita butuh raw binary image, BUKAN base64
            'imageTransparent' => false,
        ]);
        $qrCodeRaw = (new \chillerlan\QRCode\QRCode($options))->render($link);

        // Simpan file ke storage/app/public/qrcodes/
        $fileName = 'qrcodes/' . $this->assessment->uuid . '.png';
        \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $qrCodeRaw);

        // Ambil URL publik dari file tersebut (contoh: http://localhost:8000/storage/qrcodes/...)
        $qrCodeUrl = asset('storage/' . $fileName);

        return new Content(
            markdown: 'emails.report',
            with: [
                'name' => $this->assessment->name,
                'link' => $link,
                'qrCode' => $qrCodeUrl
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
