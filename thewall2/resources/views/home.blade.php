@extends('thewall2.programmlay')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Повернення з 404-ї</div>

                <div class="panel-body">
                    Ви вже в системі, перейдіть <br /> <a href="{{url('/cabinet')}}"> до кабінету</a>
                    або <a href="{{url('/')}}"> на головну </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
