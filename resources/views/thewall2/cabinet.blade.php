@extends('thewall2.generalay')

@section ('title')
    Кабинет - дипломні програми :: The Wall
@stop
@section ('links')
    <script src="{{url('/')}}/js/cabinet.js"></script>
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
    <p align="right"><a href="/cabinet/?sortby=FWD">Перші - старі програми</a> | <a href="/cabinet/">Перші - нові
            програми</a></p>

    <tr border="0">
        <td>
    @foreach($getList as $list)
        @if($list->start_at==NULL)
            <?php $start = "--" ?>
        @else
            <?php $start = $list->start_at ?>
        @endif
        @if($list->finish_at==NULL)
            <?php $finish = " -- " ?>
        @else
            <?php $finish = $list->finish_at ?>
        @endif




        @if($list->status == "close")
            <tr>
                <td id="bg{{$list->token}}">
                    <table style="background-color: #CAC9AD" id="backgr{{$list->token}}">
                        <tr>
                            <td colspan="4" bgcolor="#aa9999" height="10"><input type="hidden" id="tokenHide"
                                                                                 value="{{$list->token}}"></td>
                        </tr>
                        <tr>
                            <td rowspan="6"><img src="{{$list->image}}" width="300"></td>
                            <td width="450" align="center"><strong><font color="#7f7f8f">{{$list->name}}</font></strong>
                            </td>
                            <td>&nbsp;&nbsp;</td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="450" align="center" rowspan="5">{{$list->description}}</td>
                            <td colspan="2" height="10"><font size="2" color="#233D39"><b>Створена:</b>
                                    {{$list->created_at}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="10"><font size="2" color="#34512E"><b>Стартувала:</b>
                                    {{$start}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="10"><font size="2" color="#5E3639"><b>Фінішувала:</b>
                                    {{$finish}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10" id="edit{{$list->token}}">
                                Редагувати
                            </td>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10"><a
                                        href="/log?t={{$list->token}}">Log</a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center"><a href="/admin/report?t={{$list->token}}">Звіт виконаних</a></td>
                            <td width="150" align="center" bgcolor="#90ee90" height="10" id="closeBt{{$list->token}}">
                                <div onclick="openMe ('{{$list->token}}')" id="closeProgram">Відновити</div>
                            </td>
                            <td width="150" align="center" bgcolor="#f08080" height="10"><a
                                        href="/admin/del?t={{$list->token}}">Видалити</a></td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#32cd32" height="1"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        @elseif($list->status == "open")
            <tr>
                <td>
                    <table style="background-color: #aee770" id="backgr{{$list->token}}">
                        <tr>
                            <td colspan="4" bgcolor="#aa9999" height="10"></td>
                        </tr>
                        <tr>
                            <td rowspan="6" valign="top"><img src="{{$list->image}}" width="300"></td>
                            <td width="450" align="center" height="10"><input type="hidden" id="tokenHide"
                                                                              value="{{$list->token}}"><strong>{{$list->name}}</strong>
                            </td>
                            <td> &nbsp;&nbsp;</td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="750" align="center" rowspan="5" valign="top">{{$list->description}}</td>
                            <td colspan="2" height="10"><font size="2" color="#1B5A5A"><b>Створена:</b>
                                    {{$list->created_at}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="10"><font size="2" color="#24913C"><b>Стартувала:</b>
                                    {{$start}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="10"><font size="2" color="#96302E"><b>Фінішувала:</b>
                                    {{$finish}}</font></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10" id="edit{{$list->token}}"><a
                                        href="/edit?t={{$list->token}}">Редагувати</a></td>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10"><a
                                        href="/log?t={{$list->token}}">Log/Додати ADIF</a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center"><a href="/admin/report?t={{$list->token}}">Звіт виконаних</a></td>
                            <td width="150" align="center" bgcolor="#f0e68c" height="10" id="closeBt{{$list->token}}">
                                <div onclick="closeMe ('{{$list->token}}')" id="closeProgram">Завершити
                                </div><!--a href="/close?t={{$list->token}}">Завершити</a-->
                                <span style="color:red; font-size:10px;" id="nameError"></span></td>
                            <td width="150" align="center" bgcolor="#f08080" height="10"><a
                                        href="/admin/del?t={{$list->token}}">Видалити</a></td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#32cd32" height="1"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        @elseif($list->status == "new")
            <tr>
                <td>
                    <table id="backgr{{$list->token}}">
                        <tr>
                            <td colspan="4" bgcolor="#aa9999" height="10"></td>
                        </tr>
                        <tr>
                            <td rowspan="5"><img src="{{$list->image}}" width="300" heihgt="100"></td>
                            <td width="450" align="center" height="10"><input type="hidden" id="tokenHide"
                                                                              value="{{$list->token}}">{{$list->name}}
                            </td>
                            <td colspan="2" height="10"><font size="2"
                                                              color="#1B5A5A"><b>Заснована:</b> {{$list->created_at}}
                                </font></td>
                        </tr>
                        <tr>
                            <td width="450" align="center" rowspan="4">{{$list->description}}</td>
                            <td colspan="2" height="10"><font size="2"
                                                              color="#24913C"><b>Стартувала: {{$start}}</b></font></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="10">Фінішувала: {{$finish}} </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10"><a
                                        href="/edit?t={{$list->token}}">Редагувати</a></td>
                            <td width="150" align="center" bgcolor="#f5f5dc" height="10">Log/Додати ADIF</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td width="150" align="center" bgcolor=#66CCCC id="closeBt{{$list->token}}">
                                <div onclick="openMe ('{{$list->token}}')" id="closeProgram"> Запустити</div></td>
                            <td width="150" align="center" bgcolor="#b22222"><a href="/admin/del?t={{$list->token}}">Видалити</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#32cd32" height="1"></td>
                        </tr>
                    </table>
                  </td>
            </tr>
            @endif
            @endforeach

            </td></tr>
            </table>
            {{$getList->links()}}
            </center>


@stop

@section ('script')
    <script>
        function reciveJson(data) {
            //alert(data);

            if (data.flag == 'close') {
                console.log('close');
                console.log(data.returndata);

                podstanov = data.returndata;
                bt = document.getElementById('closeBt' + podstanov).style.background = '#90ee90';
                bt = document.getElementById('closeBt' + podstanov).innerHTML = `<div onclick="openMe ('` + data.returndata + `')" id="closeProgram">Відновити</div>`;
                bg = document.getElementById('backgr' + podstanov).style.background = '#CAC9AD';
                document.getElementById('edit' + podstanov).innerHTML = "Редагувати";
            }
            if (data.flag == 'open') {
                console.log('open');
                console.log(data.returndata);
                podstanov = data.returndata;
                bt = document.getElementById('closeBt' + podstanov).style.background = '#f0e68c';
                bt = document.getElementById('closeBt' + podstanov).innerHTML = `<div onclick="closeMe ('` + data.returndata + `')" id="closeProgram">Завершити</div>`;
                bg = document.getElementById('backgr' + podstanov).style.background = '#aee770';
                document.getElementById('edit' + podstanov).innerHTML = "<a href='/edit?t=" + data.returndata + "' >Редагувати</a>";


            }

        }

        function errorJson(data) {
            console.log(data);
            //alert(data);
            if (data.status == "422") {
                if (data.responseJSON.errors.nameAnimal != "")
                    document.getElementById("nameError").innerHTML = "Не удалось остановить";
                //console.log(data.responseJSON.errors.nameAnimal);
            }
        }

        function ajaxPost(url, params) {
            //alert('url:'+url+' Params: '+params);
            $.ajax({
                type: 'POST',
                url: url,
                data: params,
                success: function (data) {
                    reciveJson(data);
                },
                error: function (data) {
                    errorJson(data);
                }
            });
        }

        function closeMe(token) {
            params = "_token=<?php echo csrf_token() ?>&t=" + token;
            ajaxPost('close', params);
        }

        function openMe(token) {
            params = "_token=<?php echo csrf_token() ?>&t=" + token;
            ajaxPost('open', params);
        }

    </script>
@stop

