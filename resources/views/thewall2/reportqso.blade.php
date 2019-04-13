@extends('thewall2.generalay')

@section ('title')
    Кабінет - звіт виданих дипломів :: The Wall
@stop


@section('content')

    <div class="jumbotron">
        <div class="container">
            <center>
                <p style="font-size:15px;"><a onClick='history.back()'>Назад до загального звіту</a></p>

                    <input type="button" value="Друкувати" onclick="javascript:CallPrint('print-content');">

                <div id="print-content">
                <p>Звіт проведенних QSO для  {{$callArray[0]->call}}</p>



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
                </div>
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
            WinPrint.document.write('<p align="right" style="background-color: #eeeeee;"> Дипломна система The Wall | Diploms</p><center>');
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
