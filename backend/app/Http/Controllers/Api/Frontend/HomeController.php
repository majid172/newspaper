<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Division;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $divisions = Division::all();

        // Fetch all required articles in a single query
        $articles = Article::where('status', 'published')
            // ->select('id','placement_id','headline','hanger','url_title','video_code','thumbnail','thumbnail_caption','status','created_at')
            ->with(['details', 'categories'])
            ->get()
            ->sortByDesc('created_at'); // Sort once globally

        // Placement Articles
        $placementArticles = $articles->filter(fn($article) => in_array($article->placement_id, [1, 2, 3]));

        $homeLead = $placementArticles->where('placement_id', 1)->first() ?? $articles->first();
        $leadRight = $placementArticles->where('placement_id', 2);
        $leadBottom = $placementArticles->where('placement_id', 3);

        if ($leadRight->isEmpty()) {
            $leadRight = $articles->take(3);
        }
        if ($leadBottom->isEmpty()) {
            $leadBottom = $articles->take(3);
        }

        // Latest Articles
        $latestArticles = $articles->take(10);

        // Group by category
        $categorizedArticles = $articles->groupBy(fn($article) => optional($article->categories->first())->id);

        // Fetch categories
        $opinionArticles = $categorizedArticles[19] ?? collect();
        $nationalArticles = $categorizedArticles[3] ?? collect();
        $nationalLead = $nationalArticles->first();
        $nationalSide = $nationalArticles->slice(1, 3);

        $specialArticles = $categorizedArticles[20] ?? collect();
        $politicsArticles = collect($categorizedArticles)->only([4, 13]);

        // Politics & Capital
        $politicsLead = $politicsArticles[4]->first() ?? null;
        $politicsSide = $politicsArticles[4]->slice(1, 3) ?? collect();
        $capitalLead = $politicsArticles[13]->first() ?? null;
        $capitalSide = $politicsArticles[13]->slice(1, 3) ?? collect();

        // Country Articles
        $countryArticles = ($categorizedArticles[5] ?? collect())->whereNotIn('placement_id', [1, 2, 3]);
        $countryLead = $countryArticles->first();
        $countrySide = $countryArticles->slice(1, 3);
        $countryBottom = $countryArticles->slice(4, 3);

        // International
        $internationalArticles = ($categorizedArticles[6] ?? collect())->whereNotIn('placement_id', [1, 2, 3]);
        $internationalLead = $internationalArticles->first();
        $internationalSide = $internationalArticles->slice(1, 6);

        // Economy
        $economyArticles = ($categorizedArticles[9] ?? collect())->whereNotIn('placement_id', [1, 2, 3]);
        $economyLeft = $economyArticles->take(4);
        $economyRight = $economyArticles->slice(4, 3);

        // Entertainment
        $entertainmentArticles = ($categorizedArticles[8] ?? collect())->whereNotIn('placement_id', [1, 2, 3]);
        $entertainmentTop = $entertainmentArticles->take(2);
        $entertainmentBottom = $entertainmentArticles->slice(2, 4);

        // Other Sections
        $interviewArticles = ($categorizedArticles[14] ?? collect())->whereNotIn('placement_id', [1, 2, 3])->take(2);
        $sportsArticles = ($categorizedArticles[7] ?? collect())->whereNotIn('placement_id', [1, 2, 3])->take(8);
        $technologyArticles = ($categorizedArticles[15] ?? collect())->whereNotIn('placement_id', [1, 2, 3])->take(3);

        // Miscellaneous Sections
        $othersArticles = collect($categorizedArticles)->only([16, 10, 17, 18]);
        $factcheck = $othersArticles[16]->take(4) ?? collect();
        $emigration = $othersArticles[10]->take(4) ?? collect();
        $education = $othersArticles[17]->take(4) ?? collect();
        $crime = $othersArticles[18]->take(4) ?? collect();

        return response()->json([
            "divisions" => $divisions,
            "homeLead" => $homeLead,
            "leadRight" => $leadRight,
            "leadBottom" => $leadBottom,
            "latestArticles" => $latestArticles,
            "opinionArticles" => $opinionArticles,
            "specialArticles" => $specialArticles,
            "nationalArticles" => $nationalArticles,
            "nationalLead" => $nationalLead,
            "nationalSide" => $nationalSide,
            "politicsArticles" => $politicsArticles,
            "politicsLead" => $politicsLead,
            "capitalLead" => $capitalLead,
            "capitalSide" => $capitalSide,
            "countryLead" => $countryLead,
            "countrySide" => $countrySide,
            "countryBottom" => $countryBottom,
            "internationalLead" => $internationalLead,
            "internationalSide" => $internationalSide,
            "economyLeft" => $economyLeft,
            "economyRight" => $economyRight,
            "entertainmentTop" => $entertainmentTop,
            "entertainmentBottom" => $entertainmentBottom,
            "interviewArticles" => $interviewArticles,
            "sportsArticles" => $sportsArticles,
            "technologyArticles" => $technologyArticles,
            "factcheck" => $factcheck,
            "emigration" => $emigration,
            "education" => $education,
            "crime" => $crime
        ]);

    }

}
