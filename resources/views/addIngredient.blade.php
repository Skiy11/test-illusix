@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Добавить рецепт</h1>
@stop

@section('content')
    <form method="post" action="{{$ingredient['id'] ? route('update-ingredient', ['id' => $ingredient['id']]) : route('add-ingredient')}}" >
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text"
                       class="typeahead form-control"
                       id="inputTitle"
                       name="title"
                       placeholder="Название"
                       value="{{$ingredient['title'] ?: '' }}" >
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">{{$ingredient['id'] ? 'Обновить' : 'Сохранить'}}</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        var path = "{{ route('autocomplete') }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type='text/javascript' src='{{ asset("js/autocomplite.js") }}'></script>
@stop
