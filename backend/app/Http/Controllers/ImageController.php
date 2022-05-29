<?php

namespace App\Http\Controllers;

use App\Models\ImagePitbel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;


class ImageController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $count = (int)$request->get('count');
        $page = (int)$request->get('page', 1);
        $images = DB::table('image')->paginate($count, ['id', 'name'], 'page', $page)->items();
        $length = DB::table('image')->count();
        return response()->json(compact('images', 'length'));
    }

    public function get(int $imageId): JsonResponse
    {
        $result = ImagePitbel::find($imageId);
        return response()->json($result);
    }

    public function upload(Request $request)
    {
        $files = $request->file('images');
        if (!count($files)) {
            throw new RuntimeException('Files is not loaded!');
        }

        foreach ($files as $file) {
            $userId = auth()->user()->id;
            $fileName = bin2hex(random_bytes(18)). ".{$file->getClientOriginalExtension()}";
            $image = new ImagePitbel(['name' => $fileName, 'user_id' => $userId]);
            $image->save();
            $file->move('img', $fileName);
        }
        return response()->json();
    }
}
