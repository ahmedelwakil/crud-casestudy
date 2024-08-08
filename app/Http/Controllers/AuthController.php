<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Services\AuthService;
use App\Utils\HttpStatusCodeUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $response = $this->authService->login($request->email, $request->password);
            return $this->response($response, HttpStatusCodeUtil::OK, 'Login Successful!');
        } catch (InvalidCredentialsException $e) {
            return $this->response([], HttpStatusCodeUtil::UNAUTHORIZED, $e->getMessage());
        } catch (\Exception $e) {
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        $this->authService->logout();
        return $this->response([], HttpStatusCodeUtil::OK, 'Logout Successful!');
    }

    /**
     * @return JsonResponse
     */
    public function refresh()
    {
        $response = $this->authService->refreshAccessToken();
        return $this->response($response, HttpStatusCodeUtil::OK, 'Refresh Successful!');
    }

    /**
     * @return JsonResponse
     */
    public function me()
    {
        $response = $this->authService->getAuthUser();
        return $this->response($response, HttpStatusCodeUtil::OK, 'Refresh Successful!');
    }
}
