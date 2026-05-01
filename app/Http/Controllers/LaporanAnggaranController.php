<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnggaranDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanAnggaranController extends Controller
{
    public function print(Request $request)
    {
        $tahun = $request->query('tahun', date('Y'));

        $pendapatan = AnggaranDesa::where('tahun_anggaran', $tahun)
            ->where('kategori', 'pendapatan')
            ->orderBy('uraian')
            ->get();

        $belanja = AnggaranDesa::where('tahun_anggaran', $tahun)
            ->where('kategori', 'belanja')
            ->orderBy('uraian')
            ->get();

        $totalPendapatan = $pendapatan->sum('jumlah');
        $totalBelanja = $belanja->sum('jumlah');
        $selisih = $totalPendapatan - $totalBelanja;

        $signer = 'Petugas Pelayanan';
        $user = auth()->user();
        if ($user && $user->role->value === 'kepala_desa') {
            $signer = 'Kepala Desa Watalara';
        }

        $pdf = Pdf::loadView('pdf.laporan-anggaran', [
            'tahun' => $tahun,
            'pendapatan' => $pendapatan,
            'belanja' => $belanja,
            'totalPendapatan' => $totalPendapatan,
            'totalBelanja' => $totalBelanja,
            'selisih' => $selisih,
            'signer' => $signer,
        ]);

        return $pdf->stream('laporan-anggaran-' . $tahun . '-' . date('YmdHis') . '.pdf');
    }
}
