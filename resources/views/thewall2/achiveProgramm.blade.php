@extends('thewall2.generalay')

@section ('title')
    Дипломні програми що знаходятся в архіві :: The Wall | Diplom
@stop

@section('content')







    <div id="band" class="container text-center">

        <h2>Завершені дипломні програми</h2>
    </div>
    <!--div id="tour" class="bg-1 text-center"-->
    <div class="container text-center">
        <p align="right" style="font-size: 13px;"><a href="/archive?sortby=FWD">Перші - старі програми</a> | <a href="/archive">Перші - нові програми</a>
            <ul class="list-group ">
                @foreach($Programms as $programm)
                    <li class="list-group-item">

                        <div class="row">
                            <div class="col-md-4 center-block ">
                                <a href="/programm/?p={{$programm->token}}"><img src="{{$programm->image}}" width="100%"></a>
                            </div>

                            <div class="col ">
        <p class="text-center"><a href="/programm/?p={{$programm->token}}">{{$programm->name}}</a></p>
        <div class="body-layout">
            <div class="wrap">
                <div id="short_text" class="text-description-content box-hide">
                    <div class="row-md-8">
                        <p align="left"><i>Необхідно набрати балів: {{$programm->scoreFinal}} </i><br></p>
                        <p align="left"><i><b>СПС:</b>
                                @foreach($programm->sps as $call)
                                    &nbsp;{{$call->call}}
                                @endforeach

                            </i></p>
                        {{ $programm->description}}

                    </div>

                </div>
                <!--a href="#" id="short_text_show_link" class="novisited arrow-link text-description-more-link">
                    <span class="xhr arrow-link-inner">Читать полностью</span>&nbsp;→
                </a-->
            </div>
        </div>



    </div>
    </div>




    </li>

    @endforeach

    </ul>

    {{$Programms->links()}}
    </div>



@stop
