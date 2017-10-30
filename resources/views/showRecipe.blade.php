@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Мои рецепты</h1>
@stop

@section('content')
    <h1>{{$recipe->title}}</h1>

    <a href="{{route('update-recipe', ['id' => $recipe->id])}}">
        <i class="fa fa-pencil-square-o"></i>
    </a>

    <div class="recipe-text">
        {{$recipe->description}}
    </div>

    <h3>Ингредиенты</h3>
    <table class="table table-striped">

        @foreach($ingredients as $ingredient)
            <tr>
                <td>
                    <a href="{{route('recipe-ingredient', ['id' => $ingredient->id])}}">
                    {{$ingredient->title}}
                    </a>
                </td>
                <td>{{$ingredient->pivot->quantity}}</td>
            </tr>
        @endforeach
    </table>
@stop
