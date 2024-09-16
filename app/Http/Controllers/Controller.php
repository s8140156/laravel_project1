<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

// 預設的Controller.php通常會包含以上內容

// AuthorizesRequests: 用於處理與授權相關的功能。
// DispatchesJobs: 用於執行任務佇列。
// ValidatesRequests: 用於處理 HTTP 請求的資料驗證。
// 這樣ArticleController 就可以繼承到 Laravel 預設的一些功能，像是驗證資料時可以使用 validate() 方法。
