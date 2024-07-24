<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Api\Controllers\BaseController;
use App\Http\Api\Controllers\ReviewsController;
use App\Http\Api\Requests\PostCreateRequest;
use App\Http\Api\Resources\PostDetailResource;
use App\Http\Api\Resources\PostResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostsController extends BaseController
{
    private $count = 10;
    private $orderBy = 'created_at';

    // TODO: сделать почище, исправить ошибки, полвучение поста с отзывами сделать с помощью Relations

    public function getPosts()
    {
//        return Posts::orderBy($this->orderBy)
//            ->paginate($this->count);

        $posts = Posts::all();

        return $this->success(['posts' => PostResource::collection($posts)]);


    }

    /**
     * @throws ApiException
     */
    public function addPost(PostCreateRequest $request) : JsonResponse
    {
        try {
            $post = Posts::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            return $this->success([
                'post' => new PostDetailResource($post)
            ]);
        } catch (\Exception $e) {
            throw new ApiException('Не удалось создать пост', 500, 500);
        }
    }

    public function getPost($id)
    {

        $post = Posts::find($id);
        return $this->success(['post' => new PostDetailResource($post)]);
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
        $reviews = ReviewsController::getReviewsByPost($post->id);

        return $this->success([
            'post' => $post,
            'reviews' => $reviews
        ]);
    }
}
