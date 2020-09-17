<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;

class LoginController extends Controller
{

    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        return $this->issueToken($request, 'password');

    }


    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request, 'refresh_token');


    }


    public function update(Request $request)
    {

        $accessToken = Auth::user()->token();

        DB::table('users')
            ->where('id', $accessToken->user_id)
            ->update(['premuim' => true]);

        return response()->json([], 204);

    }


    public function profile(Request $request)
    {

        return response()->json([], 204);

    }


    public function user (Request $request){
        return $request->user();
     }


    public function logout(Request $request)
    {

        $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([], 204);

    }
}
