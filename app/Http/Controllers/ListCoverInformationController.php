<?php

namespace App\Http\Controllers;

use App\Models\ListCoverInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListCoverInformationController extends Controller
{
    public function create(Request $request)
    {

        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $create = ListCoverInformation::create([
            'name' => $request->name,
            'description' => $request->description,
            "cover_information_id" => $auth->accounts->cover_information->id
        ]);
        $create->save();
        return response()->json(['message' => "List cover informasi telah dibuat", 'results' => $create], 201);
    }

    public function destroy(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $check = ListCoverInformation::find($id);
        if (!$check) {
            return response()->json(['message' => "List cover informasi tidak dapat ditemukan"], 404);
        }
        $check->delete();
        return response()->json(['message' => "List cover informasi telah dihapus"], 200);
    }

    public function update(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $check = ListCoverInformation::find($id);
        if (!$check) {
            return response()->json(['message' => "List cover informasi tidak dapat ditemukan"], 404);
        }
        $check->name = $request->name;
        $check->description = $request->description;
        $check->save();
        return response()->json(['message' => "List cover informasi telah diperbarui", 'results' => $check], 200);
    }
}
