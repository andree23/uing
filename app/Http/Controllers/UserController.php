<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    const MESSAGE = "successfully updated";


    // returns the authenticated user for admin panel

    public function data()
    {

    
        $user = Auth()->user();
        return response()
        ->json( $user, 200);

    
    }


    public function allusers()
    {
        return response()->json(User::all(), 200);
    }


    // return the logo checking the format
    public function showAvatar()

    {
        if (Storage::disk('public')->exists('users/users.jpg')) {
            $image = Storage::disk('public')->get('users/users.jpg');
            $mime = Storage::disk('public')->mimeType('/users/users.jpg');
            $type = 'jpg';
        } else {
            $image = Storage::disk('public')->get('users/users.png');
            $mime = Storage::disk('public')->mimeType('users/users.png');
            $type = 'png';
        }
        return (new Response($image, 200))
            ->header('Content-Type', $mime)->header('type', $type);
    }


    public function updateAvatar(AvatarRequest $request)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->deleteDirectory('users');
            $extension = $request->image->getClientOriginalExtension();
            $filename = Storage::disk('public')->putFileAs('users', $request->image, "users.$extension");
            $data = [
                'status' => 200,
                'image_path' => $request->root() . '/api/image/users?' . time(),
            ];
        } else {
            $data = [
                'status' => 400,
            ];
        }

        return response()->json($data, $data['status']);
    }

    // update user data in the database
    public function update(UserRequest $request)
    {
        $user = Auth()->user();
        $user->fill($request->all());
        $user->save();
        $data = [
            'status' => 200,
            self::MESSAGE,
            'body' => $user
        ];

        return response()->json($data, $data['status']);
    }


    public function updateUser(UserUpdateRequest $request, User $user)


    {

        if ($user != null) {

            $user->fill($request->user);
            $user->save();

            $data = [
                'status' => 200,
                self::MESSAGE,
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'Error',
            ];
        }

        return response()->json($data, $data['status']);
    }


    public function destroy(User $user)
    {
        if ($user != null) {
            $user->delete();

            $data = [
                'status' => 200,
                'message' => 'successfully removed',
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'could not be deleted',
            ];
        }

        return response()->json($data, $data['status']);
    }

    // update user password in the database
    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $user = Auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        $data = [
            'status' => 200,
            self::MESSAGE,
        ];

        return response()->json($data, $data['status']);
    }
}
