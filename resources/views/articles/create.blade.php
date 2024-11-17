@extends('layouts.article')

@section('main')
<h1 class="font-thin text-4xl">文章 > 新增文章</h1>
@if($errors->any())
<div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('articles.store')}}" method="post">
    @csrf
    <div class="field my-3">
        <label for="">標題</label>
        <input type="text" value="{{old('title')}}" name="title" class="border border-gray-200 p-2">
        {{-- 使用old(裡面是寫欄位名稱)保留已填寫的資料(假設有些資料沒有填齊 已填的保留) --}}
    </div>
    <div class="field my-3">
        <label for="">內文</label>
        <textarea name="content" id="editor" cols="30" rows="10" class="border border-gray-200 p-2">{{old('content')}}</textarea>
    </div>
    <div class="actions">
        <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">新增文章</button>
    </div>

</form>
{{-- (在還沒建立store function時)按下submit頁面會顯示419 page expired而不是internel error --}}
{{-- 當表單透過post送出沒有附帶token會顯示上述 這是laravel保護機制(for csrf跨站請求偽造)--}}
{{-- 所以要在form底下加入@csrf, laravel會帶一個hidden input隨機產生token隨者表單送出 --}}
{{-- 加入@csrf保護後 如果還沒建立store function 就會顯示method error --}}


@endsection