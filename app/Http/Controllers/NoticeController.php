<?php

namespace App\Http\Controllers;

use App\Notice;
use App\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = \Auth::user()->notices()->orderBy('created_at', 'desc')->paginate(10);
        return view('notice/index', compact('notices'));
    }
}
