<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::connection('mysql_wp')
            ->table('wp_posts')
            ->join('wp_term_relationships', 'wp_posts.ID', '=', 'wp_term_relationships.object_id')
            ->join('wp_term_taxonomy', 'wp_term_relationships.term_taxonomy_id', '=', 'wp_term_taxonomy.term_taxonomy_id')
            ->join('wp_terms', 'wp_term_taxonomy.term_id', '=', 'wp_terms.term_id')
            ->where('post_type', 'news')
            ->where('post_status', 'publish')
            ->whereIn('wp_terms.name', config('system.news.target_terms'))
            ->orderBy('wp_posts.post_date', 'DESC')
            ->select(['post_title', 'post_date', 'post_name', 'wp_terms.name'])
            ->limit(config('system.news.num_of_top'))
            ->paginate(config('system.news.num_of_news'));
        return $this->languageView('news', [
            'news' => $news,
        ]);
    }

}
