<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    //
    public function index(){
        $data = Checklist::get();

        return response([
            'success'   => true,
            'data'      => $data
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        }

        $data = Checklist::create([
            'name' => $request->get('name'),
        ]);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Disimpan!',
            ], 200);
        }
    }

    public function destroy($id){
        $data = Checklist::findOrFail($id);
        $data->delete();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dihapus!',
            ], 400);
        }
    }
}
