@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Мои рецепты</h1>
@stop

@section('content')
    <a href="{{route('add-recipe')}}">Добавить рецепт</a>
    <form action="{{route('shop-list')}}" method="post">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Рецепт</th>
                <th scope="col">Описание</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>
                            <label><input name="recipes[]" type="checkbox" value="{{$recipe->id}}"> {{$recipe->title}}</label>
                        </td>
                        <td>{{$recipe->description}}</td>
                        <td>
                            <a href="{{route('show-recipe', ['id' => $recipe->id])}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('update-recipe', ['id' => $recipe->id])}}">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="{{route('remove-recipe', ['id' => $recipe->id])}}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Создать список покупок</button>

    </form>
@stop