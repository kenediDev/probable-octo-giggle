<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function create(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $files = null;
        if ($request->hasFile("photo")) {
            $files = Storage::disk("upload_public")->put("images/service", $request->file("photo"));
        } else {
            $files = $request->photo;
        }
        $create = Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $auth->id,
            'photo' => $files
        ]);
        $create->save();
        return response()->json(['message' => 'Service telah dibuat', 'results' => $create], 201);
    }

    public function destroy(Request $request, $id)
    {
        $find = Service::find($id);
        if (!$find) {
            return response()->json(['message' => 'Service tidak ditemukan'], 404);
        };
        $find->delete();
        return response()->json(['message' => 'Service telah dihapus'], 200);
    }

    public function update(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }

        $check = Service::find($id);
        if (!$check) {
            return response()->json(['message' => 'Service tidak ditemukan'], 404);
        }

        $files = null;
        if ($request->hasFile("photo")) {
            $files = Storage::disk("upload_public")->put("images/service", $request->file('photo'));
        } else {
            $files = $request->photo;
        }
        $check->photo = $files;
        $check->title = $request->title;
        $check->description = $request->description;
        $check->update();
        return response()->json(['message' => 'Service telah diperbarui', 'results' => $check], 200);
    }

    public function service_animation(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(false, 401);
        }
        $check = Service::find($id);
        if (!$check) {
            return response()->json(['message' => 'Service tidak dapat ditemukan'], 404);
        }
        $check->animation = $request->active;
        $check->save();
        return response()->json(['message' => 'Service telah dipindahkan ke mode animasi'], 200);
    }
}
