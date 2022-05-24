<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Student;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthAPIController
 * @package App\Http\Controllers\API
 */

class AuthAPIController extends AppBaseController
{
    /** @var  userRepository */

    public function __construct()
    {
    }
    public function generateFor($user_id)
    {
        try {
            $userToken = md5($user_id);
            // this->model->create(['user_id' => $userId, 'access_token' => $uuid4]);
        } catch (QueryException $e) {
            $this->generateFor($user_id);
        }

        return $userToken;
    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'phone'        => 'required|numeric|exists:students',
            'pin'    => 'required',
        ]);
        if ($v->fails()) {
            return response()->json([
                'errors' => $v->errors(),
            ], 422);
        }

        $user = Student::where('phone', $request->phone)->where('pin', $request->pin)->first();

        if (!$user) {
            return response()->json([
                'errors' => 'Invalid login credentials',
            ], 422);
        }


        $token = $user->access_token;
        if ($token ==null) {
            $token = $this->generateFor($user->id);
        }
        $user->access_token = $token;
        $user->save();
        return response()->json([
            'access_token' => $token,
            'user'         => $user,
            'errors'       => false,
            'msg'          => 'login in successfully',
        ]);

        // if (\Auth::attempt($request->toArray())) {
        //     return $this->sendResponse(\Auth::user()->toArray(), 'Customer successfully logged in');
        // }

        return $this->sendError('Invalid credentials', 403);
    }

    /**
     * Store a newly created Product in storage.
     * POST /products
     *
     * @param CreateProductAPIRequest $request
     *
     * @return Response
     */

}
