<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //線上教學有引用
// use App\Http\Controllers\Controller; // 因為引用上面auth後 目前無引用controller無造成畫面上任何問題
use App\Models\Article; // 因為沒有引用會造成找不到model:Article 



class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','show');
        // 使用middleware('auth')表示全部頁面都會進行認證;加上except()是除外狀況;也可以使用only()(只用在什麼地方)
        // 這次練習是發現預設的Controller.php裡面是沒有任何東西及功能
        // Laravel 預設的 Controller 檔案通常會繼承一些基本功能（例如 ValidatesRequests trait）以供子類別（如 ArticleController）使用
    }


    public function index(){ //列表
        // $articles=Article::all(); //當新增完成的文章顯示在index, 所以要取得文章
        // $articles=Article::orderBy('id','desc')->get(); //要使文章排序by id遞減;取得使用get()方法 
        $articles=Article::with('user')->orderBy('id','desc')->paginate(2); // 做分頁 laravel內建方法 是指每頁取幾筆
        // 使用with('user')方法去避免重複撈取N+1問題 從laravel debugbar可以看到是在sql加上in(特殊指定)用法
        // 我想就是限制例如查詢id不要重複 就查那一次
        // 分頁連結顯示及圖示記得要在view(index)去寫
        return view('articles.index',['articles'=>$articles]);
        // return view('articles/index'); // 使用斜線也可以
        // 可以從指令php artisan route:list | grep article 去看相關的action及命名
    }

    public function show($id){ //檢視單筆資料
        $article=Article::find($id);
        return view('articles.show',['article'=>$article]);

    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        // store()通常是處理資料後再導向其他地方 不會有view render
        // 接收Request參數
        $content=$request->validate([
            // 使用laravel內建validate方法 驗證送出來的資料
            'title'=>'required', // 'required'是指內容是需要填的(不能留空)
            'content'=>'required|min:10' //|min:10至少超過10字
        ]);

        auth()->user()->articles()->create($content);
        //由於文章的發佈是透過每個使用者登入後新增文章才會有 所以要先取得使用者auth()方法
        //要在Models裡將Article & User的關聯連結起來
        // 透過使用者的角度來建立文章
        // 假設使用者沒有登入頁面 目前填入表單後新增 畫面會呈現Call to a member function articles() on null
        // 最主要就是因為一連串的驗證連結使用者(未登入)->文章連結造成
        // 提升至articlecontroller在一開始就執行的function 不在這邊做小功能
        return redirect()->route('root')->with('notice','文章新增成功！');
        //導向首頁 並使用with()方法 加上訊息提示(記在session裡)
        // 這類通知共用性高 可寫在母模板layout底下article.blade.php裡
    }

    public function edit($id){
        // $article=Article::find($id); // by id抓取文章 若依使用者角度 可能別的id並不是他發的卻可編輯 造成資安漏洞
        $article=auth()->user()->articles->find($id); //透過取得使用者auth()方法 再依使用者角度去取他自己所發的id文章
        return view('articles.edit',['article'=>$article]);
    }

    public function update(Request $request, $id){
        $article=auth()->user()->articles->find($id); // 先抓取id

        $content=$request->validate([ //對內容做驗證
            'title'=>'required',
            'content'=>'required|min:10'
        ]);

        $article->update($content); //更新內容
        return redirect()->route('root')->with('notice','文章更新成功！');
    }
    public function destroy($id){
        $article=auth()->user()->articles->find($id); // 先抓取id
        $article->delete();
        return redirect()->route('root')->with('notice','文章已刪除！');


    }
}
