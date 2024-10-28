<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * @OA\Get(
     *     path="/getAllVideos",
     *     summary="Lấy all video",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name_video", type="string", example="Lập trình 1"),
     *                 @OA\Property(property="url_video", type="string", example="https://www.youtube.com/watch?v=pWpiuX38yHE"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-14 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-14 12:34:56")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function getAllVideos() {
        $result = $this->videoService->getAllVideo();
        return response()->json($result);
    }
}
