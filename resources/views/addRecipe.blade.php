@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Добавить рецепт</h1>
@stop

@section('content')
    <form method="post" action="{{$recipe['id'] ? route('update-recipe', ['id' => $recipe['id']]) : route('add-recipe')}}" >
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text"
                       class="form-control"
                       id="inputTitle"
                       name="title"
                       placeholder="Название"
                       value="{{$recipe['title'] ?: '' }}" >
            </div>
        </div>

        <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <textarea class="form-control"
                          id="exampleFormControlTextarea1"
                          name="description"
                          rows="3">{{$recipe['description'] ?: '' }}</textarea>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">{{$recipe ? 'Обновить рецепт' : 'Сохранить рецепт'}}</button>
            </div>
        </div>
    </form>
@stop