@extends('thewall2.generalay')

@section ('title')
    Створення нової дипломної програми :: The Wall | Diplom
@stop
@section ('head')
    <link href="/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="/js/datepicker.min.js"></script>
@stop
@section ('style')




        .tooltips {
            position: fixed;
            padding: 10px 20px;
            /* красивости... */

            border: 1px solid #b3c9ce;
            border-radius: 4px;
            text-align: center;
            font: italic 14px/1.3 sans-serif;
            color: #333;
            background: #fff;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, .3);
        }

@stop

@section('content')




            <script>
                var n=1;


                document.getElementById('divhidden').innerHTML='<input type=hidden id=\"id'+n+'\" name=\"index_sps\" value=\"0\" >';
                function plus(){
                    document.getElementById('divf'+n).innerHTML+='<br>'+n+' СПС: <input data-tooltip=\"Вкажіть позивний СПС\" type=text id=\"id'+n+'\" name=\"sps_call_'+n+'\" size=\"10\"> мода: <select size=1 name=\"new_sps_mode_'+n+'\"> <option>SSB</option><option>CW</option><option>FT8</option><option>RTTY</option><option>BPSK</option><option>SSTV</option></select> балів: <input data-tooltip=\"Вкажіть яку кількість балів дає ця СПС\" type=text id=\"id'+n+'\" name=\"sps_score_'+n+'\" size=\"3\"> Пароль: <input data-tooltip=\"Цей пароль треба передати СПС для самостійного завантаження логу. <br> Для завантаження ологу СПС має увийти в розділ Додати Log СПС \" type=text id=\"id'+n+'\" name=\"password_'+n+'\" size=\"3\"><input type=\"button\" id=\"id'+n+'\" onclick=del(id'+n+'); value=\"-\"> <div id=divf'+(n+1)+'></div>';
                    document.getElementById('divhidden').innerHTML='<input type=hidden id=\"id'+n+'\" name=\"index_sps\" value=\"'+n+'\">';
                    n++;

                }

                function del(id){
                    document.getElementById(id).remove();


                }
            </script>

            <div id="band" class="container text-center">

        {!!   Form::open(array('url' => 'newprogramm', 'files'=>true)) !!}
        <table border="0">



               <tr><td align="right"> Назва програми:&nbsp;&nbsp; </td> <td> <input  type="text"  name="Name" size="70"></td></tr>
                <tr><td align="right"> Опис:&nbsp;&nbsp; </td> <td> {!! Form::textarea('Description', 'Опис програми буде відображатись на головній сторінці',array('size' => '69x10')  )!!}</td></tr>
                <tr><td align="right"> Повтори:&nbsp;&nbsp;<br></td> <td align="left"> {!!Form::select('Repeat', array('0' => 'Заборонені', '1' => 'На різних діапазонах', '2'=>'Дозволені будь де',
                    '3'=>'На різних діапазонах, різними модами', '4'=>'На різних діапазонах, різними модами, в різну добу'), '1')!!}</td></tr>
                <tr><td align="right"> Необхідно набрати балів:&nbsp;&nbsp; </td> <td align="left">{!! Form::text('ScoreFinal', '',array('size' => '4','data-tooltip'=>'Вкажіть яку кількість балів необхідно набрати здобувач') )!!}</td></tr>
                <tr><td align="right"> Бали за умовчуванням:&nbsp;&nbsp; </td> <td align="left"> {!!Form::text('ScoreDefault', '',array('size' => '4','data-tooltip'=>'Вкажіть яку кількість балів треба зараховувати, якщо QSO здобувача відбулося не з СПС, але з іншою станцією, яка бере участь у дипломній програмі<br /> Якщо станцій за умовчуванням не має - вкажіть - 0') )!!}</td></tr>
                <tr><td align="right"> E-mail дипломного менеджера:&nbsp;&nbsp; </td> <td align="left"> {!!Form::text('emailManager', '', array('data-tooltip'=>'На цей E-mail будуть надходити заявки на отримання диплому') )!!}</td></tr>
                <tr><td align="right"> Введіть дату початку програми:&nbsp;</td> <td align="left"> {!!Form::text('startProgramm', '', array('data-tooltip'=>'Дата початку дипломної програми буде виводитись на головній сторінці', 'class'=>'calendar','autocomplete'=>'off') )!!}</td></tr>
                <tr><td align="right"> Введіть дату завершення програми:&nbsp;</td> <td align="left"> {!!Form::text('finishProgramm', '', array('data-tooltip'=>'Дата завершення дипломної програми буде виводитись на головній сторінці','class'=>'calendar','autocomplete'=>'off') )!!}</td></tr>
                <tr><td align="right"> Зображення диплому:&nbsp;&nbsp; </td> <td> {!!Form::file('Image')!!} </td></tr>
            <tr><td align="right" > <br /><br />Здобувач отримуе диплом через E-mail</td><td align="left"><br /><br />
                    <input data-tooltip='Дипломний менеджер отримує листа з E-mail здобувача,<br />
                     Дипломний менеджер сам висилає диплом здобувачу' name="methodReciev" type="radio" value="0"></td></tr>
            <tr><td align="right"><br /><br />Здобувач отримуе диплом з сайту (Вам потрібно завантажити повнорозмірний ескіз диплому в форматі .JPG, та обрати де буде виводитись позивний та ім'я)</td><td align="left"><br /><br />
                    <input name="methodReciev" data-tooltip='Здобувач автоматично отримує диплом,<br />
                    Дипломний менеджер отримує листа з позивним здобувача' type="radio" value="1" checked > </td></tr>

    <tr><td colspan="2"> <font size="2"><em>УВАГА! Додавайте СПС та призначайте для кожного пароль. <br>Надалі цей пароль необхідно надати особі яка буде загружати логи СПС станції<br>
                    За допомогою цього пароля СПС будуть додавати свої логи до загального логу дипломної програми</em></font></td></tr>

        <tr><td colspan="2"><div id=divf1>

                     </div>
                        <div id=divhidden>

                </div>
                <input type=button onClick=plus(); value='+ СПС'><br><br></td></tr>
                    <tr><td colspan="2">
                          {!!  Form::submit('Створити дипломну програму!') !!}


                        </td></tr>



    </table>
        {!!Form::close() !!}
        </div>
            <script>





                $('.calendar').datepicker({

                    language: {
                        days: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'Пятница', 'Субота'],
                        daysShort: ['Нед','Пон','Вівт','Сер','Чет','Пят','Суб'],
                        daysMin: ['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],
                        months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                        monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                        today: 'Сьогодні',
                        clear: 'Очистити',
                        dateFormat: 'dd-mm-yyyy',
                        timeFormat: 'hh:ii:00',
                        firstDay: 1

                    },

                     timepicker:true


                })
                /*$('.my-datepicker').datepicker({

                })*/
            </script>
            <script>
                var showingTooltip;

                document.onmouseover = function(e) {
                    var target = e.target;

                    var tooltip = target.getAttribute('data-tooltip');
                    if (!tooltip) return;

                    var tooltipElem = document.createElement('div');
                    tooltipElem.className = 'tooltips';
                    tooltipElem.innerHTML = tooltip;
                    document.body.appendChild(tooltipElem);

                    var coords = target.getBoundingClientRect();

                    var left = coords.left + (target.offsetWidth - tooltipElem.offsetWidth) / 2;
                    if (left < 0) left = 0; // не вылезать за левую границу окна

                    var top = coords.top - tooltipElem.offsetHeight - 5;
                    if (top < 0) { // не вылезать за верхнюю границу окна
                        top = coords.top + target.offsetHeight + 5;
                    }

                    tooltipElem.style.left = left + 'px';
                    tooltipElem.style.top = top + 'px';

                    showingTooltip = tooltipElem;
                };

                document.onmouseout = function(e) {

                    if (showingTooltip) {
                        document.body.removeChild(showingTooltip);
                        showingTooltip = null;
                    }

                };
            </script>


@stop
