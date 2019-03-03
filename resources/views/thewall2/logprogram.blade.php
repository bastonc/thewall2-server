@extends('thewall2.generalay')

@section ('title')
    Завантаженя ADIF звіта
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <center>
                <h1>Log</h1>
                <p>Програма {{$NameProgramm}}</p>

                @if($resolvForm=="open")
                    <h3>Завантажити Adif звіт</h3>
                     <p> {!!  Form::open(array('url' => action('uploadadifController@upload'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                      @include('thewall2/form')

                    <div class="form-group">


                        {!!Form::submit('Загрузить файл')!!}
                    </div>
                    @elseif($resolvForm=="close")
                    <p>Програма <br>{{$NameProgramm}} <br> завершена</p>
                @endif
                </div>

                {!! Form::close() !!}
                </center></p>




        </div>
    </div>
    @if(isset($arrayRecord))
    <p><center>Завантажені QSO</center></p>
    <center>
        <table><tr bgcolor="#5f9ea0"><td>CALL</td><td>DATE</td><td>TIME</td><td>BAND</td><td>FREQ</td><td>TO STATION</td><td>RS(t)</td></tr>
            @foreach ($arrayRecord as $res)

                <tr><td> {{ $res->call}}</td><td>{{$res->qso_date}}</td><td>{{ $res->time_on}}</td>
                    <td>{{$res->band}}</td><td>{{$res->freq}}</td><td> {{$res->operator}}</td><td>{{ $res->rst_sent}}</td></tr>

            @endforeach

        </table>
        {{$arrayRecord->appends(array('t' => $tokenprogramm))->links()}}
    </center>
    @endif
@stop
