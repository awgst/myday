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
            $user = User::where('uuid', $uuid)->first();
            $user->update($request->all());
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
    }
}
