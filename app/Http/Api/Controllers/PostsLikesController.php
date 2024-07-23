<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsLikesController extends BaseController
{
    private const TABLE = 'posts_likes';

    public function setLike(Request $request)
    {
        $res = [
            'success' => false,
            'message' => 'Not found',
        ];

        try {
            $like = DB::table('posts_likes')->where([
                'post_id' => $request->get('post_id'),
                'user_id' => $request->get('user_id'),
            ])->first();

            if (!$like) {
                $res = DB::table(self::TABLE)->insert([
                    'post_id' => $request->get('post_id'),
                    'user_id' => $request->get('user_id'),
                    'is_liked' => boolval($request->get('like'))
                ]);
            } else {
                $res = DB::table(self::TABLE)->where('id', $like->id)->update([
                    'post_id' => $request->get('post_id'),
                    'user_id' => $request->get('user_id'),
                    'is_liked' => boolval($request->get('like'))
                ]);
            }

            return $this->success([
                $res,
                $like->id
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
