@extends('thewall2.programmlay')

@section ('title')

    Вход для СПС :: The Wall | Diplom


@stop

@section('content')
    <div id="band" class="container text-center">
        <div id="band" class="container text-center">
            <h2>Вход для азагрузки отчета СПС</h2>
        </div>


        {{ Form::open(array('url' => action('ProgramsDiplom@loginsps'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            Введіть Ваш позивний СПС:
            {{ Form::text('spscall') }}
            {{ Form::password('spspass') }}

            <button type="submit" class="btn btn-primary submit-button">Увійти</button>

            {{ Form::close() }}
        </div>
        @stop