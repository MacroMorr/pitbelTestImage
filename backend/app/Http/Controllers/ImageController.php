<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Like;
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
        $user = auth()->user();
        $images = DB::table('image')->paginate($count, ['id', 'name'], 'page', $page)->items();
        if ($user) {
            $imageIds = array_column($images, 'id');
            $imageIds = implode(',', $imageIds);
            $sql = "
                SELECT image_id, user_id
                FROM `like`
                WHERE image_id IN ({$imageIds});
            ";
            $likes = DB::select($sql);
            $likes = array_map(static function ($like) use ($user) {
                return [
                    'image_id' => $like->image_id,
                    'isLiked' => $user && $like->user_id === $user->id,
                ];
            }, $likes);

            $images = array_map(static function ($image) use ($likes) {
                $image->likes = [
                    'count' => 0,
                    'isLiked' => false,
                ];
                foreach ($likes as $like) {
                    if ($image->id === $like['image_id']) {
                        $image->likes['count']++;
                        $image->likes['isLiked'] = (bool)$like['isLiked'];
                    }
                }
                return $image;
            }, $images);
        }

        $length = Image::count();
        return response()->json(compact('images', 'length'));
    }

    public function get(int $imageId): JsonResponse
    {
        $result = Image::find($imageId);
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
            $fileName = bin2hex(random_bytes(18)) . ".{$file->getClientOriginalExtension()}";
            $image = new Image(['name' => $fileName, 'user_id' => $userId]);
            $image->save();
            $file->move('img', $fileName);
        }
        return response()->json();
    }

    public function like(Request $request)
    {
        $userId = auth()->user()->id;
        ['action' => $action, 'imageId' => $imageId] = $request->get('params');
        $image = Image::find($imageId);
        if (!$image) {
            throw new RuntimeException("Image with id {$imageId} not found!");
        }

        switch ($action) {
            case 'add':
                Like::updateOrCreate(['image_id' => $imageId, 'user_id' => $userId]);
                break;
            case 'remove':
                Like::where(['image_id' => $imageId, 'user_id' => $userId])->delete();
                break;
            default:
                throw new RuntimeException('Action is not valid!');
        }

        return response()->json(['status' => 'success']);
    }
}
