<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index_view(Request $request)
    {

        $params = $request->all() ?: null;

        $mahasiswa = api_desa_post('list', $params);
        $mahasiswa = $mahasiswa ? $mahasiswa->data : null;

        $skpd = api_desa_post('skpd', null);
        $skpd = $skpd ? $skpd->data : null;

        $state = api_desa_post('list_state', null);
        $state = $state ? $state->data : null;

        return view('pages.mahasiswa.data', [
            'mahasiswa' => $mahasiswa,
            'skpd' => $skpd,
            'states' => $state
        ]);
    }

    public function detail($id = null)
    {
        if ($id) {

            $detail = api_desa_post('detail', ['id' => $id]);
            $detail = $detail ? $detail->data : null;

            return [
                'msg' => 'Data ditemukan',
                'data' => $detail
            ];
        }else{
            return [
                'msg' => 'Tidak ada data',
                'data' => null
            ];
        }
    }
}
