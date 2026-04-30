<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanMasyarakatController extends Controller
{
    public function print(Request $request)
    {
        $search = $request->query('q');
        $jenisKelamin = $request->query('jk');

        $query = Masyarakat::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->when($jenisKelamin, function ($query) use ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })
            ->orderBy('created_at', 'desc');

        $masyarakats = $query->get();

        $signer = 'Petugas Pelayanan';
        $user = auth()->user();
        if ($user && $user->role->value === 'kepala_desa') {
            $signer = 'Kepala Desa Watalara';
        }

        $pdf = Pdf::loadView('pdf.laporan-masyarakat', [
            'masyarakats' => $masyarakats,
            'search' => $search,
            'jenisKelamin' => $jenisKelamin,
            'signer' => $signer,
        ]);

        return $pdf->stream('laporan-masyarakat-' . date('Y-m-d-H-i-s') . '.pdf');
    }
}
