<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCommentController extends Controller
{
    public function showComments()
    {
        $comments = DB::table('comments')->select('id','booking_id','user_id','name', 'email', 'service','time','date','beautician', 'comment')->get();

        return view('admin.index', ['comments' => $comments]);
    }
}

