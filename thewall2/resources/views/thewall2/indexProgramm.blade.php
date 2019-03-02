@extends('thewall2.generalay')

@section ('title')
    Дипломные программы радиолюбителей :: The Wall | Diplom
@stop

@section('content')







    <div id="band" class="container text-center">

        <h2>Активні дипломні програми</h2>
    </div>
    <!--div id="tour" class="bg-1 text-center"-->
        <div class="container text-center">
            <p align="right"><a href="/?sortby=FWD">Перші - старі програми</a> | <a href="/">Перші - нові програми</a>
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
                                <table width="90%"><tr><td align="left" style="font-size: 15px; color: #2F860F; ">Початок: <strong>{{$programm->start_for_page}}</strong></td><td align="right" style="font-size: 15px; color: #2F860F;">Необхідно набрати балів: <strong>{{$programm->scoreFinal}}</strong> </td></tr>
                                    <tr><td align="left" style="font-size: 15px; color: #9A1118	;">Завершення:<strong>{{$programm->finish_for_page}}</strong></td><td></td></tr></table>

                                <p align="left" style="font-size: 18px; color:#333333" ><b>СПС:</b>
                                    @foreach($programm->sps as $call)
                                    <strong>&nbsp;{{$call->call}}</strong>
                                    @endforeach

                                    </p>
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