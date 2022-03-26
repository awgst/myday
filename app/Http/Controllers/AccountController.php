<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('layouts.account', compact('user'));
    }

    public function update(UpdateRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $user = User::where('uuid', $uuid)->first();
            if (array_key_exists('email', $data)) {
                unset($data['email']);
            }
            $user->update($data);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
    }
}
