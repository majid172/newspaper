<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleShowController extends Controller
{
    public function show(Request $request, int $id)
    {
        $article = Article::with(['author', 'categories', 'details'])
            ->findOrFail($id);

        $sessionKey = 'article_viewed_' . $article->id;

        if (!Session::has($sessionKey)) {

            $article->increment('total_hit');
            Session::put($sessionKey, true);
        }

        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where(function ($query) use ($article) {
                $tags = explode(',', $article->tags);
                foreach ($tags as $tag) {
                    $query->orWhere('tags', 'LIKE', '%' . trim($tag) . '%');
                }
            })
            ->limit(6)
            ->get();

        $latestArticles = Article::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $popularArticles = Article::orderBy('total_hit', 'desc')->limit(5)->get();

        return response()->json([
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'latestArticles' => $latestArticles,
            'popularArticles'=>$popularArticles
        ]);
    }
}
