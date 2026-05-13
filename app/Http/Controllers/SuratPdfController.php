<?php

namespace App\Http\Controllers;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratPdfController extends Controller
{
    public function cetak(int $id)
    {
        $pengajuan = PengajuanSurat::with(['masyarakat', 'jenisSurat', 'user'])->findOrFail($id);

        // Hanya surat yang disetujui yang bisa dicetak
        if ($pengajuan->status !== StatusPengajuanSurat::DISETUJUI) {
            abort(403, 'Surat belum disetujui.');
        }

        $namaSurat = $pengajuan->jenisSurat->nama_surat;
        $nomorSurat = $this->generateNomorSurat($pengajuan);

        // Jika ada template Word yang diunggah
        if ($pengajuan->jenisSurat->file_template && Storage::disk('local')->exists($pengajuan->jenisSurat->file_template)) {
            $templatePath = storage_path('app/private/' . $pengajuan->jenisSurat->file_template);
            
            // Note: In newer Laravel versions, local disk is in storage/app/private. 
            // If it's in storage/app/, adjust accordingly.
            if(!file_exists($templatePath)) {
                $templatePath = storage_path('app/' . $pengajuan->jenisSurat->file_template);
            }

            $templateProcessor = new TemplateProcessor($templatePath);

            // Replace variables
            $templateProcessor->setValue('nomor_surat', $nomorSurat);
            $templateProcessor->setValue('nama_pemohon', $pengajuan->masyarakat->nama ?? '-');
            $templateProcessor->setValue('nik_pemohon', $pengajuan->masyarakat->nik ?? '-');
            $templateProcessor->setValue('alamat_pemohon', $pengajuan->masyarakat->alamat ?? '-');
            $templateProcessor->setValue('telepon_pemohon', $pengajuan->masyarakat->phone ?? '-');
            $templateProcessor->setValue('tanggal', $pengajuan->tanggal_pengajuan->translatedFormat('d F Y'));
            $templateProcessor->setValue('keterangan', $pengajuan->keterangan ?? '-');
            
            // Set Nilai Dinamis (Looping dari kolom JSON data_tambahan)
            if (!empty($pengajuan->data_tambahan) && is_array($pengajuan->data_tambahan)) {
                foreach ($pengajuan->data_tambahan as $key => $value) {
                    $templateProcessor->setValue($key, $value);
                }
            }
            
            $filename = 'surat-' . str_replace(' ', '-', strtolower($namaSurat)) . '-' . $pengajuan->masyarakat->nik . '.docx';
            $tempFile = tempnam(sys_get_temp_dir(), 'surat');
            $templateProcessor->saveAs($tempFile);

            return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
        }

        // Fallback jika tidak ada template Word, gunakan PDF lama
        $isiSurat = $this->generateIsiSurat($pengajuan);

        // Generate QR Code berisi URL verifikasi
        $verificationUrl = route('verifikasi.surat', $pengajuan->verification_token);

        $qrCode = base64_encode(
            QrCode::format('svg')->size(150)->errorCorrection('H')->generate($verificationUrl)
        );

        $pdf = Pdf::loadView('pdf.surat-keterangan', [
            'pengajuan' => $pengajuan,
            'nomorSurat' => $nomorSurat,
            'namaSurat' => $namaSurat,
            'isiSurat' => $isiSurat,
            'qrCode' => $qrCode,
        ]);

        $pdf->setPaper('a4', 'portrait');

        $filename = 'surat-' . str_replace(' ', '-', strtolower($namaSurat)) . '-' . $pengajuan->masyarakat->nik . '.pdf';

        return $pdf->stream($filename);
    }

    /**
     * Generate nomor surat otomatis
     */
    private function generateNomorSurat(PengajuanSurat $pengajuan): string
    {
        $nomor = str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT);
        $bulan = $this->toRomanNumeral($pengajuan->tanggal_pengajuan->month);
        $tahun = $pengajuan->tanggal_pengajuan->year;

        return "{$nomor}/SKD/{$bulan}/{$tahun}";
    }

    /**
     * Konversi bulan ke angka romawi
     */
    private function toRomanNumeral(int $number): string
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        return $map[$number] ?? (string) $number;
    }

    /**
     * Generate isi surat berdasarkan jenis surat
     */
    private function generateIsiSurat(PengajuanSurat $pengajuan): string
    {
        $masyarakat = $pengajuan->masyarakat;
        $namaSurat = strtolower($pengajuan->jenisSurat->nama_surat);

        // Isi surat sesuai jenis
        if (str_contains($namaSurat, 'tidak mampu')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara yang tergolong keluarga kurang mampu/tidak mampu. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'berkelakuan baik')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara yang berkelakuan baik dan tidak pernah terlibat dalam tindak kriminal atau kejahatan apapun. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'belum menikah')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara yang sampai saat dikeluarkannya surat keterangan ini belum pernah menikah/belum terikat perkawinan dengan siapapun. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'domisili')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar berdomisili/bertempat tinggal di alamat tersebut dan merupakan warga Desa Watalara. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'usaha')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara yang memiliki usaha di wilayah Desa Watalara. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'kematian')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas telah meninggal dunia. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'pindah')) {
            return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara yang akan pindah tempat tinggal. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        if (str_contains($namaSurat, 'kelahiran')) {
            return "Dengan ini menerangkan bahwa telah lahir seorang anak dari warga Desa Watalara tersebut di atas. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
        }

        // Default untuk jenis surat lainnya
        return "Dengan ini menerangkan bahwa yang bersangkutan di atas adalah benar warga Desa Watalara. Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.";
    }
}
