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
                        <td><b>CALL</b></td><td><b>SCORE</b></td><td><b>DIPLOM No</b></td>
                    </tr>
                    <?php $index=0; ?>
                    @foreach($callArray as $call)
                        <tr> <?php $index++;
                            if ($index%2 ==0) {$color="#dddddd";}else {$color="#ffffff";}
                            if ($call->num < 10)
                                $num="000".$call->num;
                            if($call->num > 10 && $call->num < 100)
                                $num="00".$call->num;
                            if($call->num > 100 && $call->num < 1000)
                                $num="0".$call->num;
                            if($call->num > 1000)
                                $num=$call->num;
                            ?>
                            <td bgcolor="{{$color}}" align="center">
                                <a href="/admin/reportoper?t={{$programmArray[0]->token}}&call={{$call->call}}">{{$call->call}}</a>
                            </td>
                            </td>
                            <td bgcolor="{{$color}}" align="center">
                                {{$call->score}}
                            </td>
                            <td bgcolor="{{$color}}" align="center">
                                {{$num}}
                            </td>
                        </tr>
                    @endforeach

                </table>
                <?php
                $tokenArgumet='?t='.$programmArray[0]->token;
                echo $callArray->setPath($tokenArgumet)->links(); ?>
            </center>

        </div>
        </div>


    </div>





@stop
