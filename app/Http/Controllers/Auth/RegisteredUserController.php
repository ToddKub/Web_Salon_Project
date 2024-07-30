<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'numeric','regex:/^0[6-9]\d{8}$/', function ($attribute, $value, $fail) {
                if (!preg_match('/^0[6-9]\d{8}$/', $value)) {
                    $fail('กรุณาใส่หมายเลขโทรศัพท์ใหม่');
                }
            }],
            'password' => ['required','min:8', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required_with:password|same:password'
        ],
        [
            'name.required'=>'กรุณากรอกชื่อและนามสกุล',
            'name.string'=>'เป็นตัวอักษรเท่านั้น',
            'name.max'=>'ตัวอักษรไม่ควรเกิน 255',
            'email.required'=>'กรุณาใส่อีเมล',
            'email.max'=>'อีเมลไม่ควรเกิน 255 ตัวอักษร',
            'email.unique'=>'อีเมลนี้ได้สมัครไปแล้ว',
            'phone.required'=>'กรุณาใส่เบอร์โทร',
            'phone.numeric'=>'ใส่เป็นตัวเลขเท่านั้น',
            'phone.regex'=>'เบอร์โทรศัพท์ไม่ถูกต้อง',
            'password.required'=>'กรุณากรอกรหัสผ่าน',
            'password.confirmed'=>'กรุณากรอกยืนยันรหัสผ่านด้วย',
            'password.min'=>'รหัสผ่านต้องไม่น้อยกว่า 8 ตัว',
            'password_confirmation.required_with'=>'กรุณากรอกยืนยันรหัสผ่านก่อน',
            'password_confirmation.same'=>'ยืนยันรหัสผ่านต้องเหมือนกับรหัสผ่าน',

        ]
    );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
