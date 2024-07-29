<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\BaseController;
use App\Models\PostsLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsLikesController extends BaseController
{
    public function setLike(Request $request)
    {
        $res = [
            'success' => false,
            'message' => 'Not found',
        ];

        try {
            $like = PostsLikes::where('post_id', $request->get('post_id'))
                ->where('user_id', $request->get('user_id'))->first();

            if (!$like) {
                $res = PostsLikes::create([
                    'post_id' => $request->get('post_id'),
                    'user_id' => $request->get('user_id'),
                    'is_liked' => boolval($request->get('like'))
                ]);
            } else {
                $res = PostsLikes::firstWhere('id', $like->id)->update([
                    'post_id' => $request->get('post_id'),
                    'user_id' => $request->get('user_id'),
                    'is_liked' => boolval($request->get('like'))
                ]);
            }

            return $this->success([
                $res
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
