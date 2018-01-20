<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    //详情页面
    public function show(Post $post)
    {
        return view("post/show", compact('post'));
    }

    //创建页面
    public function create()
    {
        return view("post/create");
    }

    //创建逻辑
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $post = Post::create(request(['title', 'content']));
        return redirect("/posts");
    }

    //编辑页面
    public function edit(Post $post)
    {
        return view("post/edit", compact('post'));

    }

    //编辑逻辑
    public function update(Post $post, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }

    //删除逻辑
    public function delete(Post $post)
    {
        // TODO:用户权限的验证

        $post->delete();

        return redirect("/posts");
    }

    //上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);

    }
}






















