<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile');
    }

    public function avatar(Request $request)
    {
        $path = $request->path();

        if (!Storage::disk('public')->exists($path)) abort(404);
        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->store('images/user-avatars', 'public');
            $user = Auth::user();
            $user->avatar = $path;
            $user->save();
        }
    }
}
