@extends('thewall2.generalay')

@section ('title')
    Результат за пошуком - {{$searchString}}  :: The Wall | Diplom
@stop

@section('content')







    <div id="band" class="container text-center">

        <h2>Результат запиту: {{$searchString}}</h2>
    </div>
    <!--div id="tour" class="bg-1 text-center"-->
    <div class="container text-center">
    @if($searchArray!=NULL)
        <ul class="list-group ">
            @foreach($searchArray as $programm)
                <li class="list-group-item">

                    <div class="row">
                        <div class="col-md-4 center-block ">
                            <img src="{{$programm->image}}" width="100%">
                        </div>

                        <div class="col ">
                            <p class="text-center"><a href="/programm/?p={{$programm->token}}">{{$programm->name}}</a></p>
                            <div class="body-layout">
                                <div class="wrap">
                                    <div id="short_text" class="text-description-content box-hide">
                                        <div class="row-md-8">

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




                </li>

            @endforeach

        </ul>
        @else
            <p>Нічого не знайдено<br>Спробуйте ще</p>
    @endif


    </div>



@stop