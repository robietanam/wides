<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ArticleController extends Controller
{
    public function showId($id)
    {
        $article = Article::where('id',$id )->firstOrFail();
        $latestArticles = Article::select('slug', 'thumbnail', 'updated_at','id')
        ->latest() // Get the latest by updated_at
        ->take(4)  // Limit the result to 4 articles
        ->get();
        return view('pages.article-show', ['article' => $article, 'latestArticles' => $latestArticles]);
    }

    public function index(Request $request)
    {
        
        $pageSize = $request->input('pageSize');
        $search = $request->query('search');

        $articles = Article::when($search, function ($query, $search) {
            return $query->where('slug', 'like', "%{$search}%")
                ->orWhere('short_descriptions', 'like', "%{$search}%")
                ->orWhere('detailed_description', 'like', "%{$search}%");
        })->paginate($pageSize ?? 6);
        
        return view('pages.article-index', ['articles' => $articles]);
    }

    public function downloadQrCode($id)
    {
        $url = url("/artikel/id/{$id}"); // Generate the URL
        $qrCode = QrCode::generate($url);

        return response()->make($qrCode, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="qr-code.svg"'
        ]);
    }
}
