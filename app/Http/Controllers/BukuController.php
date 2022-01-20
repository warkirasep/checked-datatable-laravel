<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;
use DataTables;

class BukuController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $buku = Buku::select();
            return DataTables::of($buku)
                    ->editColumn('id', function($buku){
                        return '<input type="checkbox" name="check_data" class="checkboks" value='.$buku->id.' id="select'.$buku->id.'">';
                    })
                    ->rawColumns(['id'])

                    ->make(true);
        }
        return view('buku.index');
    }

    public function insertData()
    {
        for($i = 0; $i < 100; $i++){
            $buku = new Buku();
            $buku->nama_buku = 'Cecheked Pada laravel'.$i;
            $buku->penulis = 'Asep '.$i;
            $buku->save();
        }
    }

    public function deleteSelected(Request $request)
    {
        if($request->ajax())
        {
            foreach($request->id as $row => $key){
                $buku = Buku::find($request->id[$row]);
                $buku->delete();
            }
        }
        return response()->json([
            'message' => 'Data telah di hapus !'
        ]);
    }
}
