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

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Ингридиент</th>
                <th scope="col">Количество</th>
            </tr>
            </thead>
            <tbody class="input-fields-wrap">
            @foreach($ingredients as $ingredient)
                <tr>
                    <td>
                        <input type="text"
                               class="typeahead form-control"
                               name="ingredient[{{$ingredient['id'] ?: $ingredient['id']}}]"
                               value="{{$ingredient['title'] ?: $ingredient['title']}}" >
                    </td>
                    <td>
                        <input type="text"
                               class="form-control"
                               name="quantity[{{$ingredient['id'] ?: $ingredient['pivot']['id']}}]"
                               value="{{$ingredient['pivot']['quantity'] ?: $ingredient['pivot']['quantity']}}" >
                    </td>
                    <td><a href="#" class="remove-field">Remove</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="form-group row">
            <div class="col-sm-5">
                <button type="button" class="btn btn-primary add-field-button">Добавить поле</button>
            </div>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">{{$recipe['id'] ? 'Обновить рецепт' : 'Сохранить рецепт'}}</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script type='text/javascript' src='{{ asset("js/additional-fields.js") }}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script>
        var path = '<?php echo route('autocomplete') ?>';
    </script>
    <script type='text/javascript' src='{{ asset("js/autocomplite.js") }}'></script>
@stop
