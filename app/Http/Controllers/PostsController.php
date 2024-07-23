<?php

namespace App\Http\Controllers;

use App\Http\Api\Controllers\BaseController;
use App\Http\Api\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostsController extends BaseController
{
    private $count = 10;
    private const TABLE = 'posts';
    private $orderBy = 'created_at';

    public function getPosts()
    {
        return DB::table(self::TABLE)->orderBy($this->orderBy)->paginate($this->count);
    }

    public function addPost(Request $request) : JsonResponse
    {
        try {
            $res = DB::table(self::TABLE)->insert([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return $this->success([
                'status' => 200,
                'message' => 'Post created successfully',
                'data' => $res
            ]);
        } catch (\Exception $e) {
            return $this->fail('Post creation failed: ' . $e->getMessage());
        }
    }

    public function getPost($id)
    {
        return DB::table(self::TABLE)->where('id', $id)->first();
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function setOrder($order)
    {
        $this->orderBy = $order;
    }

    public function getPostWithReviews($id)
    {
        $post = $this->getPost($id);
        $reviews = (new ReviewsController)->getReviewsByPost($post->id);

        return $this->success([
            'post' => $post,
            'reviews' => $reviews
        ]);
    }
}
