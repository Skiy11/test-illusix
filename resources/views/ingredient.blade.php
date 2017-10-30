@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Ингридиенты</h1>
@stop

@section('content')
    <a href="{{route('add-ingredient')}}">Добавить ингридиент</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Ингридиент</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingredients as $ingredient)
            <tr>
                <td>
                    <a href="{{route('recipe-ingredient', ['id' => $ingredient->id])}}">
                        {{$ingredient->title}}
                    </a>
                </td>
                <td>
                    <a href="{{route('update-ingredient', ['id' => $ingredient->id])}}">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="{{route('remove-ingredient', ['id' => $ingredient->id])}}">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop