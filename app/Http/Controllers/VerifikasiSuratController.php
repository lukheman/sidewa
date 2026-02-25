<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;

class VerifikasiSuratController extends Controller
{
    public function verify(string $token)
    {
        $pengajuan = PengajuanSurat::with(['masyarakat', 'jenisSurat', 'user'])
            ->where('verification_token', $token)
            ->first();

        return view('verifikasi-surat', [
            'pengajuan' => $pengajuan,
            'valid' => $pengajuan !== null,
        ]);
    }
}
