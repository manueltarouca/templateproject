@extends('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                @foreach($articles as $article)
                    <div id="content">
                        <div class="title">
                            <h2><a href="{{ $article->path() }}">{{$article->title}}</a></h2>
                        <p><img src="/images/banner.jpg" alt="" class="image image-full"/></p>
                        <p>{!! $article->excerpt !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
