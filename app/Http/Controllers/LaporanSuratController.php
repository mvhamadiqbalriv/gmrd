<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanSuratController extends Controller
{
    public function index_view(Request $request)
    {
        $params = $request->all() ?: null;

        $laporan_surat = api_desa_get('laporan_surat', $params);
        $laporan_surat = $laporan_surat ? $laporan_surat->data : null;

        $skpd = api_desa_post('skpd', null);
        $skpd = $skpd ? $skpd->data : null;

        return view('pages.laporan_surat.data', [
            'laporan_surat' => $laporan_surat,
            'skpd' => $skpd
        ]);
    }

    public function statistik_detail($id)
    {
        $statistik_laporan_surat = api_desa_post('statistik_laporan_surat', ['id_skpd' => $id]);
        $statistik_laporan_surat = $statistik_laporan_surat ? $statistik_laporan_surat->data : null;

        return $statistik_laporan_surat;
    }
}
