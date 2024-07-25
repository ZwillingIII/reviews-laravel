<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Api\Controllers\BaseController;
use App\Http\Api\Controllers\ReviewsController;
use App\Http\Api\Requests\PostCreateRequest;
use App\Http\Api\Requests\PostsGetRequest;
use App\Http\Api\Resources\PostDetailResource;
use App\Http\Api\Resources\PostResource;
use App\Http\Api\Resources\ReviewsResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostsController extends BaseController
{
    public function getPage(PostsGetRequest $request) : JsonResponse
    {
        $posts = Posts::paginate($request->get('count'))
            ->sortBy($request->get('sort'));

        return $this->success([
            'posts' => PostResource::collection($posts)
        ]);
    }

    /**
     * @throws ApiException
     */
    public function create(PostCreateRequest $request) : JsonResponse
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
//        return $this->success(['post' => new PostDetailResource($post)]);
        return new PostDetailResource($post);
    }

    public function getPostWithReviews($id)
    {
        $post = $this->getPost($id);
//        $reviews = ReviewsController::getReviewsByPost($post->id);
        $reviews = $post->reviews;

        return $this->success([
            'post' => $post,
            'reviews' => $reviews
        ]);
    }
}
