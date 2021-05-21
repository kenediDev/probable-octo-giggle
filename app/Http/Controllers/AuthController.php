<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        if (!$token = JWTAuth::attempt($request->all())) {
            return response()->json(['message' => 'Nama Pengguna atau kata sandi salah.'], 400);
        }
        return $this->responseWithToken($token);
    }

    public function reset(Request $request)
    {
        $val = Validator::make($request->all(), [
            'token' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $check = User::where('email', '=', $request->token)->first();
        if (!$check) {
            return response()->json(['message' => 'Akun tidak dapat ditemukan'], 404);
        }
        Mail::send("welcome", ["user" => $check], function ($m) use ($check) {
            $m->from(env("MAIL_USERNAME"), "Laravel");
            $m->to($check->email, $check->name)->subject("Hello Worlds");
        });
        return response()->json(['message' => 'Akun telah direset, silahkan periksa inbox email anda untuk mendapatkan kata sandi baru'], 200);
    }

    protected function responseWithToken($token)
    {
        return [
            'token' => $token,
            'types' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }

    public function update(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'description' => 'required',
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $auth->accounts->first_name = $request->first_name;
        $auth->accounts->last_name = $request->last_name;
        $auth->accounts->description = $request->description;
        $files = null;
        if ($request->hasFile("logo")) {
            $files = Storage::disk("upload_public")->put("images/logo", $request->file("logo"));
        } else {
            $files = $request->logo;
        }
        if ($files) {
            $auth->accounts->logo = $files;
        }
        $auth->accounts->save();
        return response()->json([
            'message' => "Profil telah diperbarui",
            "accounts" => new UserResource($auth)
        ], 200);
    }

    public function me(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        return response()->json(new UserResource($auth), 200);
    }
}
