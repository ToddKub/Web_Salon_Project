<?php

namespace App\Http\Controllers;

use App\Models\User;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::sortable(['id' => 'desc'])->paginate(5);
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $userType = $request->input('userType', ''); // ตรวจสอบว่ามีการส่ง user type มาหรือไม่
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'userType' => $userType, // กำหนดค่า user type ที่ตรวจสอบแล้ว
            'email_verified_at' => null, // กำหนดว่ายังไม่ได้ verify email
            'phone' => $request->input('phone'), // หากมีการระบุ phone
            'password' => $request->input('password'), // รับค่า password จาก input
            'created_at' => now(), // กำหนดวันที่สร้าง user
            'updated_at' => now(), // กำหนดวันที่อัพเดท user
        ]);

        return redirect('/users');
    }

    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $userType = $request->input('userType', ''); // ตรวจสอบว่ามีการส่ง user type มาหรือไม่

        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'userType' => $userType, // กำหนดค่า user type ที่ตรวจสอบแล้ว
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
            'updated_at' => now(),
        ]);

        return redirect('/users');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('/users');
    }
}

