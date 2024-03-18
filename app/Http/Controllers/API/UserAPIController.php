<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserAPIController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $webRole = Role::whereName('Web User')->where('guard_name', 'web')->first();
        $apiRole = Role::whereName('Mobile User')->where('guard_name', 'api')->first();
        $user->assignRole($apiRole,$webRole);
        \Auth::login($user);
        $data = new UserResource($user);
        return $this->apiResponse($data);
    }
    public function login(Request $request)
    {
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($login_credentials)) {

            $data = new UserResource(auth()->user());

            $data = $data->toArray(request());

            $data['token'] = auth()->user()->createToken('Berneshti@gmail.io')->accessToken;
            return $this->apiResponse($data, true, null, 200);

        } else {
            return $this->unAuthoriseResponse();
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->apiResponse("logged Successfully", true, false, 200);
    }

}
