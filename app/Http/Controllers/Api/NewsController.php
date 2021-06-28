<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
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
        $news = News::select('title', 'updated_at')
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
        return new NewsResource($news->only('title', 'body', 'updated_at'));
    }
}
