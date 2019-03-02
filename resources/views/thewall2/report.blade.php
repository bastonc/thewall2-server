@extends('thewall2.generalay')

@section ('title')
    Кабінет - звіт виданих дипломів :: The Wall
@stop


@section('content')

    <div class="jumbotron">
        <div class="container">
            <center>
                <p style="font-size:15px;"><a href="/cabinet">Повернутися до кабінету</a></p>
                <form>
                    <input type="button" value="Друкувати" onclick="window.print();">
                </form>

                <p>Звіт виданих дипломів для програми {{$programmArray[0]->name}}</p>


                <table border="0" width="50%">
                    <tr bgcolor="#eeeeee" align="center">
                        <td><b>CALL</b></td><td><b>SCORE</b></td>
                    </tr>
                    <?php $index=0; ?>
                    @foreach($callArray as $call)
                        <tr> <?php $index++;
                            if ($index%2 ==0) {$color="#dddddd";}else {$color="#ffffff";}
                            ?>
                            <td bgcolor="{{$color}}"><a href="/admin/reportoper?t={{$programmArray[0]->token}}&call={{$call->call}}">{{$call->call}}</a></td></td><td bgcolor="{{$color}}" align="right">{{$call->score}}</td>
                        </tr>
                    @endforeach
                </table>

            </center>

        </div>
        </div>


    </div>





@stop