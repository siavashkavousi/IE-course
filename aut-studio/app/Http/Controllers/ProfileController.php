<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function changeUserPassword(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $user = Auth::user();
        if (array_key_exists('username', $content)) {
            validator($content, [
                'username' => 'required|max:255',
            ])->validate();
            $user->name = $content['username'];
            $user->save();
        }
        if (array_key_exists('password', $content)) {
            validator($content, [
                'password' => 'required|min:6|case_diff|numbers|letters',
            ])->validate();
            $user->password = bcrypt($content['password']);
            $user->save();
        }
    }

    public function categories()
    {
        $categories = Category::all();
        $user_categories = auth()->user()->categories;
        if (!$user_categories->isEmpty()) {
            foreach ($categories as $index => $category) {
                foreach ($user_categories as $item) {
                    if ($category['name'] == $item['name'])
                        $categories[$index]['selected'] = true;
                }
            }
            return $categories;
        } else {
            return Category::all();
        }
    }

    public function updateFavoriteCategories(Request $request)
    {
        $content = explode(',', $request->getContent());
        if ($content) {
            $content_list = [];
            foreach ($content as $item)
                array_push($content_list, Category::where('name', e($item))->first()['id']);
            auth()->user()->categories()->sync($content_list);
        } else {
            abort(404, 'Not Found');
        }
    }
}
