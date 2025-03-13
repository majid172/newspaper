<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Placement;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');
        $placement_id = $request->input('placement_id');

        $articles = Article::with(['placement', 'categories'])
            ->when($search, function ($query, $search) {
                return $query->where('headline', 'like', '%' . $search . '%');
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('categories.id', $category_id);
                });
            })
            ->when($placement_id, function ($query, $placement_id) {
                return $query->where('placement_id', $placement_id);
            })
            ->orderByRaw('CASE WHEN placement_id IS NOT NULL THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::pluck('category_name', 'id');
        $placement = Placement::pluck('name', 'id');
        return response()->json([
            'articles' => $articles,
            'categories' => $categories,
            'placement' => $placement

        ]);
    }

}
