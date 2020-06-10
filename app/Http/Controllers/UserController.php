<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('user.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        $data = $request->all();

        User::find(auth()->id())->update([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);

        return redirect()->route('user.edit', $user)->with('success', 'Успешно променени данни за потребител');

    }

    public function changePassword(PasswordChangeRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('new_password'))]);

        return redirect()->route('user.edit', auth()->id())->with('success', 'Успешно променена парола');
    }
}
