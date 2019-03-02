@extends('thewall2.programmlay')

@section ('title')
    Завантаження ADIF звіту :: The Wall | Diplom
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
           <center> <h2>Звіт ADIF завантажений</h2>
            <p>Дякуємо за повагу до колег</p>
               @if (Auth::guest())
                    <p><a href="{{url('/')}}">Повернутись на головну</a></p>
               @else
                    <p><a href="{{url('/cabinet')}}">Повернутись до кабінету</a></p>

               @endif

           </center>


        </div>
    </div>
    <center>

        @if($errors!= NULL)
            <p>Записи які мають помилки позивного та не були додані до логу</p>
            @for($i=0;$i<count($errors);$i++)
                {!! $errors[$i]!!}
            @endfor
        @endif
        <br /><br /><p>Всі записи котрі поступили на обробку</p>
    <table><tr bgcolor="#5f9ea0"><td align="center">CALL</td><td>MODE</td><td align="center">DATE</td><td align="center">TIME</td><td align="center">BAND</td><td align="center">FREQ</td><td align="center">TO STATION</td><td align="center">RS(t)</td></tr>


        @for ($index=0; $index<count($arrayRecord); $index++)
            <?php $res=$arrayRecord[$index]; ?>

            <tr><td>&nbsp;&nbsp; {{ $res['call']}}</td><td>{{ $res['mode']}}</td><td>&nbsp;&nbsp;{{$res['qso_date']}}</td><td>&nbsp;&nbsp;{{ $res['time_on']}}</td>
                      <td>&nbsp;&nbsp;{{$res['band']}}</td><td>&nbsp;&nbsp;{{$res['freq']}}</td><td>&nbsp;&nbsp; {{$res['operator']}}</td><td>&nbsp;&nbsp;{{ $res['rst_sent']}}</td></tr>

    @endfor
    </table>
    </center>
@stop