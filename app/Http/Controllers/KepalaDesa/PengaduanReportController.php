<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PengaduanReportController extends Controller
{
    public function print(Request $request)
    {
        $startDate = $request->query('start');
        $endDate = $request->query('end');
        $status = $request->query('status');

        $query = Pengaduan::query()->with(['masyarakat', 'user']);

        if ($startDate) {
            $query->whereDate('tanggal_pengaduan', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_pengaduan', '<=', $endDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pengaduans = $query->orderBy('tanggal_pengaduan', 'desc')->get();

        $pdf = Pdf::loadView('pdf.pengaduan-report', [
            'pengaduans' => $pengaduans,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
        ]);

        return $pdf->stream('laporan-pengaduan-' . date('Y-m-d-H-i-s') . '.pdf');
    }
}
