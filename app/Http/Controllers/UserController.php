<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Đăng ký",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=400, description="Bad Request")
     * )
     */
    public function register(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $email = $request->input('email');

        $result = $this->userService->register($name, $email, $password);

        if ($result) {
            return response()->json(['message' => 'User created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create user'], 400);
        }
    }
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Đăng nhập",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function login(Request $request)
    {
        $username = $request->input('email');
        $password = $request->input('password');

        $result = $this->userService->login($username, $password);
        return $result;
    }

    /**
     * @OA\Delete(
     *     path="/deleteUser",
     *     summary="delete user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="string"),
     *
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $result = $this->userService->getUser($id);
        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/getPoint",
     *     summary="Lấy điểm của người dùng",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="id", type="string")
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function getPoint(request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->input('id');
        $result = $this->userService->getPoint($id);
        return response()->json($result);
    }

    /**
     * @OA\Post(
     *     path="/updateUser",
     *     summary="update user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=400, description="Bad Request")
     * )
     */

    public function updateUser(UpdateUserRequest $request)
    {
        $id = $request->input('id');
        $users = $this->userService->updateUser($request, $id);

        if (!$users) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $users,
        ], 200);

    }

    /**
     * @OA\Get(
     *     path="/ranking",
     *     summary="Lấy rank 5 user có point cao nhất",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="point", type="string", example="100"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */

    public function ranking()
    {
        $ranking = $this->userService->ranking();
        return response()->json($ranking);
    }

    /**
     * @OA\Get(
     *     path="/getAllUsers",
     *     summary="Lấy tất cả người dùng",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function getAllUser()
    {
        // select * from users
        return User::all();

    }

}
