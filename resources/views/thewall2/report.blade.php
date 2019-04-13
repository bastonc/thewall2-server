@extends('thewall2.generalay')

@section ('title')
    Кабінет - звіт виданих дипломів :: The Wall
@stop


@section('content')

    <div class="jumbotron">
        <div class="container">
            <center>
                <p style="font-size:15px;"><a href="/cabinet">Повернутися до кабінету</a></p>

                <input type="button" value="Друкувати" onclick="javascript:CallPrint('print-content');">


                <div id="print-content">
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
                </div>
                <?php
                $tokenArgumet='?t='.$programmArray[0]->token;
                echo $callArray->setPath($tokenArgumet)->links(); ?>
            </center>

        </div>
        </div>


    </div>

    <script language="javascript">
        function CallPrint(strid) {
            var prtContent = document.getElementById(strid);
            //var prtCSS = '<link rel="stylesheet" href="/templates/css/template.css" type="text/css" />';
            var WinPrint = window.open('','','left=100,top=100,width=800,height=640,toolbar=0,scrollbars=1,status=0');
            WinPrint.document.write('<div id="print" class="contentpane">');
            //WinPrint.document.write(prtCSS);
            WinPrint.document.write('<p align="right" style="background-color: #eeeeee;"> Дипломна система The Wall | Diploms</p><br /><center>');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.write('</center> <br />');
            WinPrint.document.write('</div>');
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
            prtContent.innerHTML=strOldOne;
        }
    </script>




@stop
