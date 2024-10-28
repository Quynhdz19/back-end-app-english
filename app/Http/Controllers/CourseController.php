<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    protected $courseService;

    public function __construct(CourseService $courseService) {
        $this->courseService = $courseService;
    }


    /**
     * @OA\Get(
     *     path="/getCourses",
     *     summary="Lấy all courses",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name_course", type="string", example="Lập trình 1"),
     *                 @OA\Property(property="url_bground", type="string", example="https://bkstar.vn/wp-content/uploads/2024/03/logo.svg"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function getAllCourses()
    {
        $result = $this->courseService->getAllCourse();
        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/getCourse",
     *     summary="get course detail",
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
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="name_course", type="string", example="Lập trình 1"),
     *                  @OA\Property(property="url_bground", type="string", example="https://bkstar.vn/wp-content/uploads/2024/03/logo.svg"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *              )
     *          )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function getCourseDetail(Request $request){
        $id =$request->input('id');
        $result=$this->courseService->getCourse($id);
        return response()->json($result);
    }

    public function deleteCourse(Request $request){
        $id = $request->input('id');
        $result = $this->courseService->deleteCourse($id);
        if ($result) {
            return response()->json($result);
        }
    }

    public function fillCourse(Request $request) {

        $user_id = $request->input('user_id');
        $name_course = $request->input('name_course');
        $url_background =$request->input('url_background');
        return $this->courseService->fillCourse($user_id,$name_course,$url_background);
    }
}

