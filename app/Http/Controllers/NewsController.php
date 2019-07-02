<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

// 追記
use App\News;

use App\Profile;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        // $cond_title が空白でない場合は、記事を検索して取得する
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            $posts = News::all()->sortByDesc('updated_at');
        }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }

    //profileアクション考えてみる。
    public function profile(Request $request)
    {
         $cond_name = $request->cond_title;
        // $cond_name が空白でない場合は、記事を検索して取得する
        if ($cond_name != '') {
            $posts = Profile::where('name', $cond_name).orderBy('updated_at', 'desc')->get();
        } else {
            $posts = Profile::all()->sortByDesc('updated_at');
        }

        /*if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        */
        // news/profile.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('news.profile', ['posts' => $posts, 'cond_name' => $cond_name]);
        
    }
}
