@extends('layouts.article')

@section('main')
<h1 class="font-thin text-4xl my-3">文章列表</h1>
{{-- <a href="/articles/create">新增文章</a> --}}
<a href="{{route('articles.create')}}" style="font-weight:700;font-size:24px;color:darkgoldenrod">新增文章</a>
@foreach($articles as $article)
<div class="border-t border-gray-300 my-1 p-2">
    <h2 class="font-bold text-lg"><a href="{{route('articles.show',$article)}}">{{$article->title}}</a></h2>
    <p>{{ Str::limit(strip_tags($article->content), 10) }}...</p>
    {{-- 1. str_limit函數 取content裡前10字 顯示縮寫內容 --}}
    {{-- 2. 由於有使用WYSIWYG(所見即所得編輯器)所以存入資料表裡的資料可能有含html標籤 當打出來會顯示含有<p>,<h2>html標籤 --}}
    {{-- 使用strip_tags函數移除html標籤 只保留純文字 --}}
    <p>{{$article->created_at->diffForHumans()}} 由 {{$article->user->name}} 分享 </p>

    <div class="flex">
        <a class="mr-2" href="{{route('articles.edit',['article'=>$article->id])}}">編輯</a>
        {{-- <a href="{{route('articles.edit',['article'=>$article])}}">編輯</a> --}}
        {{-- <a href="{{route('articles.edit',$article)}}">編輯</a> --}}
        {{-- 有三種寫法可以抓出id的方式 $article是個物件 編輯$article物件 --}}
        <form action="{{route('articles.destroy',$article)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="px-2 rounded bg-red-500 text-red-100">刪除</button>
        </form>
    </div>


</div>
@endforeach
{{$articles->links()}}
{{-- 這是laravel內建做分頁連結方法 --}}

@endsection