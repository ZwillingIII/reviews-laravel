<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\BaseController;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends BaseController
{

    public function getReviewsByUser($id)
    {
        return Reviews::where('user_id', $id)->get();
    }

    public static function getReviewsByPost($id)
    {
        return Reviews::where('post_id', $id)->get();
    }

    public function addReview(Request $request, $id)
    {
        return Reviews::create([
            'user_id' => $id,
            'post_id' => $request->input('post_id'),
            'text' => $request->input('text'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
