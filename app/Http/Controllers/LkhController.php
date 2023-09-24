<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LkhController extends Controller
{
    public function index_view(Request $request)
    {
        $params = $request->all() ?: null;

        $lkh = api_desa_post('lkh', $params);
        $lkh = $lkh ? $lkh->data : null;

        $skpd = api_desa_post('skpd', null);
        $skpd = $skpd ? $skpd->data : null;

        return view('pages.lkh.data', [
            'lkh' => $lkh,
            'skpd' => $skpd
        ]);
    }
}
