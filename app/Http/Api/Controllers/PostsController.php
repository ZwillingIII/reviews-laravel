<?php

namespace App\Http\Api\Controllers;

use App\Events\PostCreateEvent;
use App\Exceptions\ApiException;
use App\Helpers\Helpers;
use App\Helpers\PostHelper;
use App\Http\Api\Requests\PostCreateRequest;
use App\Http\Api\Requests\PostsGetRequest;
use App\Http\Api\Resources\PostDetailResource;
use App\Http\Api\Resources\PostResource;
use App\Models\Posts;
use Illuminate\Http\JsonResponse;
use Illuminate\Pipeline\Pipeline;
use PhpParser\Builder;

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

    // TODO: пробую Pipelines
    public function pipline(PostsGetRequest $query)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through(app(PostHelper::class))
            ->thenReturn();
    }

    /**
     * @throws ApiException
     */
    public function create(PostCreateRequest $request) : JsonResponse
    {
        try {
            $file = $request->file('file');

            if ($request->hasFile('image')) {
                $file = Helpers::uploadFileFromRequest($request->file('image'), 'public', 'posts');
            }

            $post = Posts::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'files_id' => $file?->id,
            ]);

            PostCreateEvent::dispatch($post);

            return $this->success([
                'post' => new PostDetailResource($post),
            ]);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), 500, 500);
        }
    }

    public function getPost($id) : PostDetailResource
    {
        $post = Posts::find($id);

        if (is_null($post)) {
            return throw new ApiException('Не найден пост', 404, 404);
        }

        return new PostDetailResource($post);
    }

    // TODO: организовать поиск через Eloquent
    public function search(string $text)
    {

    }
}
