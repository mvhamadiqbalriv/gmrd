<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index_view(Request $request)
    {
        $params = $request->all() ?: null;

        $absensi = api_desa_post('absensi', $params);
        $absensi = $absensi ? $absensi->data : null;

        $state = api_desa_post('list_state', null);
        $state = $state ? $state->data : null;

        return view('pages.absensi.data', [
            'absensi' => $absensi,
            'states' => $state
        ]);
    }
}
