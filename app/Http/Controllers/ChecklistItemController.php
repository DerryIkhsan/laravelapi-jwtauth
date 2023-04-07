<?php

namespace App\Http\Controllers;

use App\ChecklistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChecklistItemController extends Controller
{
    //
    public function index($id){
        $data = ChecklistItem::where('checklist_id', $id)->get();

        return response([
            'success'   => true,
            'data'      => $data
        ], 200);
    }

    public function store(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'itemName' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        }

        $data = ChecklistItem::create([
            'item_name' => $request->get('itemName'),
            'checklist_id' => $id,
        ]);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Disimpan!',
            ], 200);
        }
    }

    public function destroy($cid, $id){
        $data = ChecklistItem::where('checklist_id', $cid)->where('id', $id)->delete();

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
