<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanKegiatanController extends Controller
{
    public function print(Request $request)
    {
        $search = $request->query('q');
        $status = $request->query('status');

        $query = Kegiatan::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kegiatan', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->when($status !== '', function ($query) use ($status) {
                if ($status === 'selesai') {
                    $query->where('progres', '>=', 100);
                } elseif ($status === 'berjalan') {
                    $query->where('progres', '>', 0)->where('progres', '<', 100);
                } elseif ($status === 'belum_mulai') {
                    $query->where('progres', 0);
                }
            })
            ->orderBy('tanggal_mulai', 'desc');

        $kegiatans = $query->get();

        $pdf = Pdf::loadView('pdf.laporan-kegiatan', [
            'kegiatans' => $kegiatans,
            'search' => $search,
            'status' => $status,
            'signer' => 'Kepala Desa Watalara',
        ]);

        return $pdf->stream('laporan-kegiatan-' . date('Y-m-d-H-i-s') . '.pdf');
    }
}
