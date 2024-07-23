<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\BaseController;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends BaseController
{
    private const TABLE_NAME = 'reviews';

    public function getReviewsByUser($id)
    {
        return Reviews::where('user_id', $id)->get();
    }

    public function getReviewsByPost($id)
    {
        return Reviews::where('post_id', $id)->get();
    }

    public function addReview(Request $request, $id)
    {
        return DB::table(self::TABLE_NAME)->insert([
            'user_id' => $id,
            'post_id' => $request->input('post_id'),
            'text' => $request->input('text'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
