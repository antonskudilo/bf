<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    /**
     * Display a listing of the news records.
     *
     * @param string|null $filter
     * @return AnonymousResourceCollection
     */
    public function index(string $filter = null)
    {
        $news = News::select('title', 'updated_at', 'status')
            ->byFilter($filter)
            ->orderBy('created_at', 'desc')
            ->get();

        return NewsResource::collection($news);
    }

    /**
     * Display the specified news record.
     *
     * @param News $news
     * @return NewsResource
     */
    public function show(News $news)
    {
        return new NewsResource($news->only('title', 'body', 'updated_at', 'status'));
    }

    /**
     * Store a newly created news record in storage.
     *
     * @param NewsRequest $request
     * @return JsonResponse|NewsResource
     */
    public function store(NewsRequest $request)
    {
        try {
            $news = News::create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return new NewsResource($news);
    }

    /**
     * Update the specified news record`s status in storage.
     *
     * @param Request $request
     * @param News $news
     * @return JsonResponse|NewsResource
     */
    public function changeStatus(NewsRequest $request, News $news)
    {
        try {
            $news->update([
                'status' => trim($request->status),
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return new NewsResource($news);
    }
}
