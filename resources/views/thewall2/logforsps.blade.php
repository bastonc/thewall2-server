@extends('thewall2.programmlay')

@section ('title')
    Завантаження ADIF звіту :: The Wall | Diplom
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <center>
                <h1>Log</h1>

                @if($resolvForm=="open")
                    <h3>Завантажити новий Adif звіт</h3>
                    <p> {!!  Form::open(array('url' => action('uploadadifController@uploadsps'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                    @include('thewall2/form')

                    <div class="form-group">


                        {!!Form::submit('Загрузить файл')!!}
                    </div>
                @elseif($resolvForm=="close")
                    <p>Программа <br>{{$NameProgramm}} <br> завершена</p>
            @endif
        </div>

        {!!  Form::close() !!}
        </center></p>




    </div>
    </div>

@stop
