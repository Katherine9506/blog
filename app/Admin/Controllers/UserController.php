<?php

namespace App\Admin\Controllers;

use App\AdminUser;

class UserController extends Controller
{
    public function index()
    {
        $admins = AdminUser::paginate(10);
        return view('admin/user/index', compact('admins'));
    }

    public function create()
    {
        return view('admin/user/add');
    }

    //创建逻辑
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name', 'password'));

        return redirect('/admin/users');
    }
}