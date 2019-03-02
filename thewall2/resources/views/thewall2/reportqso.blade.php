@extends('thewall2.generalay')

@section ('title')
    Кабінет - звіт виданих дипломів :: The Wall
@stop


@section('content')

    <div class="jumbotron">
        <div class="container">
            <center>
                <p style="font-size:15px;"><a onClick='history.back()'>Назад до QSO</a></p>
                <form>
                    <input type="button" value="Друкувати" onclick="window.print();">
                </form>

                <p>Звіт виданих дипломів для програми {{$programmArray[0]->name}}</p>



                <table border="0" width="   90%">
                    <tr bgcolor="#eeeeee" align="center">
                        <td align="center"><b>DATE</b></td><td align="center"><b>CALL</b></td><td align="center"><b>OPERATOR</b></td><td align="center"><b>BAND</b></td>
                        <td align="center"><b>FREQ</b></td><td align="center"><b>MODE</b></td><td align="center"><b>RST</b></td><td align="center"><b>SCORE</b></td>
                    </tr>
                    <?php $index=0; ?>
                    @foreach($callArray as $call)
                        <tr> <?php $index++;
                            if ($index%2 ==0) {$color="#dddddd";}else {$color="#ffffff";}
                            ?>
                            <td bgcolor="{{$color}}" align="center">&nbsp;{{$call->qso_date}}&nbsp;</td><td bgcolor="{{$color}}" align="center">&nbsp;{{$call->call}}&nbsp;</td>
                            <td bgcolor="{{$color}}" align="center">&nbsp;{{$call->operator}}&nbsp;</td><td bgcolor="{{$color}}" align="center">&nbsp;{{$call->band}}&nbsp;</td>
                            <td bgcolor="{{$color}}" align="center">&nbsp;{{$call->freq}}&nbsp;</td><td bgcolor="{{$color}}" align="center">&nbsp;{{$call->mode}}&nbsp;</td>
                            <td bgcolor="{{$color}}" align="center">&nbsp;{{$call->rst_sent}}&nbsp;</td><td bgcolor="{{$color}}" align="right">&nbsp;{{$call->score}}&nbsp;</td>
                        </tr>
                    @endforeach
                </table>

            </center>

        </div>
    </div>


    </div>





@stop