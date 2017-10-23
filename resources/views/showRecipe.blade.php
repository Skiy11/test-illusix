@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Мои рецепты</h1>
@stop

@section('content')
    <h1>{{$recipe['title']}}</h1>
    <a href="{{route('update-recipe', ['id' => $recipe['id']])}}">
        <i class="fa fa-pencil-square-o"></i>
    </a>

    <div class="recipe-text">
        {{$recipe['description']}}
    </div>
@stop