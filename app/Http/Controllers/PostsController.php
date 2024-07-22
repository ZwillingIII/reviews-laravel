<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    private $count = 10;
    private const TABLE = 'posts';
    private $orderBy = 'created_at';

    public function getPage()
    {
        return DB::table(self::TABLE)->orderBy($this->orderBy)->paginate($this->count);
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function setOrder($order)
    {
        $this->orderBy = $order;
    }
}
