@extends('layouts.article')

@section('main')
<h1 class="font-thin text-4xl">文章 > 編輯文章</h1>
{{-- {{$article->title}} --}}
{{-- 從controller傳出來的資料 可以測試一下 注意變數是單數 因為是取該id文章 --}}
@if($errors->any())
<div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('articles.update',$article)}}" method="post">
    {{-- 如果沒加上參數 會出現沒有帶入參數missing parameter錯誤訊息 --}}
    @method('patch') {{-- laravel route update方法是使用put or patch 寫這樣是帶一個hidden value="patch"過去(實際上是by post過去) --}}
    @csrf
    <div class="field my-3">
        <label for="">標題</label>
        <input type="text" value="{{$article->title}}" name="title" class="border border-gray-200 p-2">
        {{-- 這邊帶入後端資料寫法是{{$article->title}}是跟在index寫法一樣 --}}
    </div>
    <div class="field my-3">
        <label for="">內文</label>
        <textarea name="content" id="" cols="30" rows="10" class="border border-gray-200 p-2">{{$article->content}}</textarea>
    </div>
    <div class="actions">
        <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">更新文章</button>
    </div>

</form>



@endsection  