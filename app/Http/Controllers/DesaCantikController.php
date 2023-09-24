<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesaCantikController extends Controller
{
    public function index_view(Request $request)
    {
        $params = $request->all() ?: null;

        $desa_cantik = api_desa_get('desa_cantik', $params);
        $desa_cantik = $desa_cantik ? $desa_cantik->data : null;

        $skpd = api_desa_post('skpd', null);
        $skpd = $skpd ? $skpd->data : null;

        return view('pages.desa_cantik.data', [
            'desa_cantik' => $desa_cantik,
            'skpd' => $skpd
        ]);
    }

    public function statistik_detail($id)
    {
        if ($id) {
            $statistik_desa_cantik = api_desa_post('statistik_desa_cantik', ['id_skpd' => $id]);
            $statistik_desa_cantik = $statistik_desa_cantik ? $statistik_desa_cantik->data : null;
    
            return $statistik_desa_cantik;
        }else {
            return null;
        }
    }
}
