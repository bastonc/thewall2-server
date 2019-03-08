@extends('thewall2.generalay')

@section ('title')
    Кабинет - дипломні програми :: The Wall
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <center>
            <h2>Ваші дипломні програми</h2>
                <a href="/newprogramm">Створити нову програму</a>
            </center>





        </div>


    </div>
    <p align="right"><a href="/cabinet/?sortby=FWD">Перші - старі програми</a> | <a href="/cabinet/">Перші - нові програми</a></p>
    <center>
        <table border="0">
            @foreach($getList as $list)
                @if($list->start_at==NULL)
                   <?php $start="--" ?>
                @else
                    <?php $start=$list->start_at ?>
                @endif
                    @if($list->finish_at==NULL)
                        <?php $finish=" -- " ?>
                    @else
                        <?php $finish=$list->finish_at ?>
                    @endif




                @if($list->status == "close")
                    <tr><td colspan="4" bgcolor="#aa9999" height="10"></td></tr>
                    <tr><td rowspan="6"><img src="{{$list->image}}" width="300"></td>
                        <td width="450" align="center" bgcolor="#CAC9AD"><strong><font color="#7f7f8f">{{$list->name}}</font></strong></td><td  bgcolor="#CAC9AD">&nbsp;&nbsp; </td><td  bgcolor="#CAC9AD">&nbsp;&nbsp; </td></tr>
                    <tr><td width="450" align="center"  bgcolor="#CAC9AD" rowspan="5">{{$list->description}}</td><td bgcolor="#CAC9AD" colspan="2" height="10"><font size="2" color="#233D39"><b>Створена:</b> {{$list->created_at}}</font></td></tr>
                    <tr><td bgcolor="#CAC9AD" colspan="2" height="10"><font size="2" color="#34512E"><b>Стартувала:</b> {{$start}}</font></td></tr>
                    <tr><td bgcolor="#CAC9AD" colspan="2" height="10"><font size="2" color="#5E3639"><b>Фінішувала:</b> {{$finish}}</font> </td></tr>
                    <tr><td bgcolor="#CAC9AD" colspan="2">&nbsp; </td></tr>

                <tr><td width="150" align="center" bgcolor="#f5f5dc" height="10">Редагувати</td><td width="150" align="center" bgcolor="#f5f5dc" height="10"><a href="/log?t={{$list->token}}">Log</a></td></tr>
                        <tr><td></td><td align="center"><a href="/admin/report?t={{$list->token}}">Звіт виконаних</a></td><td width="150" align="center" bgcolor="#90ee90" height="10"><a href="/open?t={{$list->token}}">Відновити</a></td><td width="150" align="center" bgcolor="#f08080" height="10"><a href="/admin/del?t={{$list->token}}">Видалити</a></td></tr>
                    <tr><td colspan="4" bgcolor="#32cd32" height="1"> </td></tr>
                @elseif($list->status == "open")
                    <tr><td colspan="4" bgcolor="#aa9999" height="10"></td></tr>
                    <tr><td rowspan="6" valign="top" ><img src="{{$list->image}}" width="300"></td>
                        <td width="450" align="center"  bgcolor="#AEE770" height="10"><strong>{{$list->name}}</strong></td><td bgcolor="#AEE770"> &nbsp;&nbsp;</td><td bgcolor="#AEE770">&nbsp;&nbsp; </td></tr>
                    <tr><td width="750" align="center"  bgcolor="#AEE770" rowspan="5" valign="top">{{$list->description}}</td><td bgcolor="#AEE770" colspan="2" height="10"><font size="2" color="#1B5A5A"><b>Створена:</b> {{$list->created_at}}</font> </td></tr>
                    <tr><td bgcolor="#AEE770" colspan="2" height="10"><font size="2" color="#24913C"><b>Стартувала:</b> {{$start}}</font> </td></tr>
                    <tr><td bgcolor="#AEE770" colspan="2" height="10"><font size="2" color="#96302E"><b>Фінішувала:</b> {{$finish}}</font> </td></tr>
                    <tr><td bgcolor="#AEE770" colspan="2">&nbsp; </td></tr>
                    <tr><td width="150" align="center"  bgcolor="#f5f5dc" height="10" ><a href="/edit?t={{$list->token}}" >Редагувати</a></td><td width="150" align="center"  bgcolor="#f5f5dc" height="10"><a href="/log?t={{$list->token}}">Log/Додати ADIF</a></td></tr>
                        <tr><td></td><td align="center"><a href="/admin/report?t={{$list->token}}">Звіт виконаних</a></td><td width="150" align="center" bgcolor="#f0e68c" height="10" ><a href="/close?t={{$list->token}}">Завершити</a></td><td width="150" align="center" bgcolor="#f08080" height="10"><a href="/admin/del?t={{$list->token}}">Видалити</a></td></tr>
                    <tr><td colspan="4" bgcolor="#32cd32" height="1"> </td></tr>
                @elseif($list->status == "new")
                    <tr><td colspan="4" bgcolor="#aa9999" height="10"></td></tr>
                    <tr><td rowspan="5"><img src="{{$list->image}}" width="300" heihgt="100"></td>
                        <td width="450" align="center" height="10">{{$list->name}}</td><td colspan="2" height="10"> <font size="2" color="#1B5A5A"><b>Заснована:</b> {{$list->created_at}}</font></td></tr>
                    <tr><td width="450" align="center" rowspan="4">{{$list->description}}</td><td colspan="2" height="10"><font size="2" color="#24913C"><b>Стартувала: {{$start}}</b></font> </td></tr>
                    <tr><td colspan="2" height="10">Фінішувала: {{$finish}} </td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td width="150" align="center"  bgcolor="#f5f5dc" height="10" ><a href="/edit?t={{$list->token}}" >Редагувати</a></td><td width="150" align="center"  bgcolor="#f5f5dc" height="10">Log/Додати ADIF</td></tr>
                    <tr><td></td><td></td><td width="150" align="center" bgcolor=#66CCCC ><a href="/open?t={{$list->token}}"  >Запустити</a></td><td width="150" align="center" bgcolor="#b22222"><a href="/admin/del?t={{$list->token}}">Видалити</a></td></tr>
                    <tr><td colspan="4" bgcolor="#32cd32" height="1"></td></tr>
                @endif
            @endforeach
            <tr>
        </table>
        {{$getList->links()}}
    </center>

@stop


