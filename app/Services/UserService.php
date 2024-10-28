<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register($name, $email, $password)
    {
        // Mã hóa mật khẩu
        $hashedPassword = Hash::make($password);

        // Lưu người dùng mới với mật khẩu đã mã hóa
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        return $user ? true : false;
    }

    public function login($username, $password)
    {
        $user = User::where('email', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            // Đăng nhập thành công, truyền đối tượng User vào
            return $this->generateToken($user);
        }
        return false;
    }

    private function generateToken($user)
    {
        //dd(111);
        // Tạo token JWT cho người dùng
        $token = JWTAuth::fromUser($user);

        // Trả về token dưới dạng JSON
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function getUser($id){
        $user = User::query()->where('id',$id)->delete();
        return $user;
    }

    public function getPoint($id){
        return User::query()->where('id', $id)->value('point');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return true;

    }

    public function updateUser($request, $id)
    {
        $user = User::find($id);
        // Mã hóa mật khẩu
        $hashedPassword = Hash::make($request->only('password'));
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->update([
            'name' => $request->only('name'),
            'email' => $request->only('email'),
            'password' => $hashedPassword,
        ]);
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);

    }

    public function ranking()
    {
       // $ranking = User::query()->raw("select * from users order by points desc limit 5");
        $ranking = User::orderBy('point', 'desc')->take(5)->get();
        return $ranking;

    }


}

