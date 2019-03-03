@extends('thewall2.programmlay')

@section ('title')
    Результати пошуку в програмі {{$programmName}} для {{$call}} :: The Wall | Diplom
@stop

@section('content')





    <div id="band" class="container text-center">

        <div id="band" class="container text-center">
            <h2>{{$programmName}}</h2>
        </div>


            {!! Form::open(array('url' => action('frontend@searchCall'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) !!}

            <div class="form-group">
                Введіть Ваш позивний:
                &nbsp;{!! Form::text('searchcall',"") !!}
                {!!Form::hidden('Token', $tokenProgramm) !!}
                <button type="submit" class="btn btn-primary submit-button">Переглянути статистику</button>

                {!! Form::close() !!}
            </div>

            <ul class="list-group ">

                    <li class="list-group-item">
                        @foreach($programmInfo as $programm)
                        <div class="row" >
                            <div class="col-md-4 center-block " >
                                <img src="{{$programm->image}}" width="80%">
                            </div>
                            <div class="col ">
                                <p class="text-center"><a href="/programm/?p={{$programm->token}}">{{$programm->name}}</a></p>
                                <div class="body-layout">
                                    <div class="wrap">
                                        <div id="short_text" class="text-description-content box-hide">
                                <div class="row-md-8">
                                    <p align="left"><b>Потрібно набрати:</b> {{$programm->scoreFinal}}
                                    <?php $scoreFinal=$programm->scoreFinal;?>
                                        <br /><b>СПС:</b>
                                        @foreach($programm->sps as $spscall)
                                            &nbsp;&nbsp;&nbsp;{{$spscall->call}} - {{$spscall->score}}
                                        @endforeach

                                    </p>

                                    {{$programm->description}}

                                </div>
                                        </div>
                                        <!--a href="#" id="short_text_show_link" class="novisited arrow-link text-description-more-link">
                                            <span class="xhr arrow-link-inner">Читать полностью</span>&nbsp;→
                                        </a-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </li>
            </ul>

        <div class="container text-center" style="background-color:#215D07; color: #FAFAFA; width: 100%" >
        <h2>ВІТАЄМО!</h2>
    @if($methodArray[0]==0)
        <p>Ви виконали умови диплому "{{$programmName}}"<br>Будь ласка введіть E-mail куди вам відправити диплом</p>
        <p><em>Ваша адреса E-mail буде доправлена до дипломного менеджера програми </em></p>
                      {!! Form::open(array('url' => action('frontend@sendemail'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) !!}

             <div class="form-group" style="color: #2d2d30  ">

                      {!! Form::text('email', "Ваш E-mail", array("class" =>"searchinput")) !!}
                      {!!Form::hidden('key', "0") !!}
                      {!!Form::hidden('token', $tokenProgramm)!!}
                      {!!Form::hidden('call', $call)!!}
                      <button type="submit" class=" btn btn-primary submit-button">Я виконав!</button>

                      {!! Form::close() !!}
            </div>
    @endif
    @if($methodArray[0]==1)

                <p>Ви виконали умови диплому "{{$programmName}}"<br>Будь ласка введіть Ваше ім'я латиніцею</p>
                {!! Form::open(array('url' => action('frontend@sendemail'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) !!}

                <div class="form-group" style="color: #2d2d30  ">

                    {!!Form::text('name', "Ім'я",array("class" =>"pageinput")) !!}
                    {!!Form::hidden('key', "1") !!}
                    {!!Form::hidden('token', $tokenProgramm)!!}
                    {!!Form::hidden('call', $call)!!}
                    {!!Form::hidden('x', $methodArray[1])!!}
                    {!!Form::hidden('y', $methodArray[2])!!}
                    {!!Form::hidden('color', $methodArray[3])!!}
                    <button type="submit" class=" btn btn-primary submit-button">Я виконав!</button>

                    {!! Form::close() !!}
                </div>
    @endif


        </div>


        <ul class="list-group ">
            <li class="list-group-item">
                <div class="row text-center text-uppercase" style="background: #500A16; color: #cacaca">
                    <p>Всього балів: {{$totalScore}}</p>
                </div>
                <div class="row text-center text-uppercase" style="background: #500A16; color: #cacaca">
                    <p>З потрібних: {{$scoreFinal}}</p>
                </div>
                <div class="row" style="background:  #500A16; color: #cacaca">
                    <div class="col-md-2 center-block ">
                        OPERATOR
                    </div>
                    <div class="col-md-2 center-block ">
                        CALL
                    </div>
                    <div class="col-md-1 center-block ">
                        RS(T)
                    </div>
                    <div class="col-md-2 center-block ">
                        BAND
                    </div>
                    <div class="col-md-2 center-block ">
                        DATE
                    </div>
                    <div class="col-md-1 center-block ">
                        MODE
                    </div>
                    <div class="col-md-2 center-block ">
                        SCORE
                    </div>
                </div>
            @foreach($searchCallInProgramm as $qsoinfo)


                    <div class="row">
                        <div class="col-md-2 center-block ">
                            {{$qsoinfo->call}}
                        </div>
                        <div class="col-md-2 center-block ">
                            {{$qsoinfo->operator}}
                        </div>
                        <div class="col-md-1 center-block ">
                            {{$qsoinfo->rst_sent}}
                        </div>
                        <div class="col-md-2 center-block ">
                            {{$qsoinfo->band}}
                        </div>
                        <div class="col-md-2 center-block ">
                            {{$qsoinfo->qso_date}}
                        </div>
                        <div class="col-md-1 center-block ">
                            {{$qsoinfo->mode}}
                        </div>
                        <div class="col-md-2 center-block ">
                            {{$qsoinfo->score}}
                        </div>
                    </div>


            @endforeach

            </li>
            <li class="list-group-item">
            <div class="row text-center text-uppercase" style="background: #500A16; color: #cacaca">
                <p>Всього балів: {{$totalScore}}</p>
            </div>
            </li>

    </ul>
    </div>




@stop
