<?php

namespace App\Admin\Controllers;

use App\Jobs\SendMessage;
use App\Notice;
use App\Topic;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return view('/admin/notice/index', compact('notices'));
    }

    public function create()
    {
        return view('/admin/notice/create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $notice = Notice::create(['title' => request('title'), 'content' => request('content')]);

        dispatch(new \App\Jobs\SendMessage($notice));
        return redirect('/admin/notices');
    }
}