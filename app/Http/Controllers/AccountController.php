<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\UploadService;
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

    public function upload(Request $request)
    {
        try {
            $data = $request->file('file');
            $user = Auth::user();
            $uploadedFile = (new UploadService())->from($data)
                                ->to('uploads/user/')
                                ->setName(encrypt($user->id))
                                ->mimes('jpg,png,jpeg')
                                ->oldDelete($user->profile_picture ?? '')
                                ->save();
            $model = User::where('uuid', $user->uuid)->first();
            $model->update(['profile_picture' => $uploadedFile]);
            $userNew = User::find($user->id);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['profile_picture' => $userNew->profile_picture_url]);
    }
}
