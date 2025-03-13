<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Article;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArticleController extends Controller
{
    public function index(Request $request, $categorySlug)
    {

        $category = Category::where('slug', $categorySlug)->firstOrFail();

        $articlesQuery = Article::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
            ->where('status','published')
            ->with('details', 'categories')
            ->orderBy('created_at', 'desc');

        $allArticles = $articlesQuery->get();
        $leadArticle = $allArticles->first();

        $truncatedLeadArticleBody = ''; // Initialize to an empty string
        if ($leadArticle) {  // Check if a lead article exists
            $leadArticleBody = optional($leadArticle->details)->body; // Use optional() to prevent errors if details is null
            $truncatedLeadArticleBody = Str::limit($leadArticleBody, 500);
        }

        $topArticles = $allArticles->skip(1)->take(4);
        $bottomArticles = $allArticles->skip(5)->take(4);
        $otherArticles = $allArticles->skip(9)->take(5);

        $divisions = Division::select('id','bn_name')->get();
        return response()->json([
            'category' => $category,
            'leadArticle' => $leadArticle,
            'truncatedLeadArticleBody' => $truncatedLeadArticleBody,  // Include truncated body in the response
            'topArticles' => $topArticles,
            'bottomArticles' => $bottomArticles,
            'otherArticles' => $otherArticles,
            'divisions' => $divisions,
        ]);
    }
public function loadMoreArticles(Request $request, $categorySlug)
    {
        $request->validate([
            'offset' => 'required|integer|min:0',
            'limit' => 'required|integer|min:1',
        ]);

        $offset = $request->input('offset');
        $limit = $request->input('limit');


        $category = Category::where('slug', $categorySlug)->firstOrFail();


        $articles = Article::whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category->id);
            })
            ->with('details', 'categories')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();


        $formattedArticles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'headline' => $article->headline,
                'body_excerpt' => mb_substr(strip_tags($article->details->body ?? ''), 0, 120, 'UTF-8'),
                'thumbnail' => $article->thumbnail,
                'formatted_date' => $article->created_at->formatBangla('jS F Y, H:i'),
            ];
        });


        return response()->json([
            'articles' => $formattedArticles,
        ]);
    }
}
