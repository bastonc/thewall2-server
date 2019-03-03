@extends('thewall2.programmlay')

@section ('title')

    Вход для СПС :: The Wall | Diplom


@stop

@section('content')
    <center id="band" class="container text-center">

        {!!  Form::open(array('url' => action('ProgramsDiplom@loadadiff'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) !!}

        <center>
            <h2>Оберіть программу до якої здійснюєте завантаження:</h2>
        <table>
            @for($i=0;$i<count($programmNameArray);$i++)

                <tr><td align="right">  {{$programmNameArray[$i][0]->name}}&nbsp;&nbsp;&nbsp; </td> <td align="center"> {!! Form::radio('programm', $programmNameArray[$i][0]->token) !!}</td></tr>

            @endfor
        </table>
                <br>
            <button type="submit" class="btn btn-primary submit-button">Обрав</button>

            {!!  Form::close() !!}
        </center>
    </div>
@stop
