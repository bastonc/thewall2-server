<?php
$formtext="Оберіть де буде відображатись позивний, та ім'я здобувча";

?>
<html lang="en">
<meta charset="utf-8">
<head>

    <style type="text/css">

        #el{
            position:relative;
           /* width: 100%;*/
            /* z-index: 2*/
            /*background:#555*/
        }


        .stamp{
           /* width:400px;*/
            height:35px;
            background:#ddd;
            position: absolute;
            opacity:0.9;
            font-size:25px;
            /*z-index: 2*/

        }
        .stamp2{
           /* width:400px;*/
            height:35px;
            background:#ddd;
            position: absolute;
            opacity:0.6;
            font-size:25px;
            /*z-index: 2*/

        }
        .description{
            width:100%;
            height: 100px;
            border:2px;
        }
    </style>

</head>
<body>
<div class="description">
        {!!  Form::open(array('action' => 'UserWallController@getcordinatexy')) !!}
            {{$formtext}}
    Чорний<input name="color" type="radio" value="black">
    Білий<input name="color" type="radio" value="white">
    <!--select name="color"><option>Чорний</option><option>Білий</option></select-->
            <input type='hidden' id="X" name="X">
            <input type='hidden' id="Y" name="Y">
            <input type="hidden" value="{{$tokenprogramm}}" name="tokenprogramm">
            <button type="submit"> Вказав </button>
        {!! Form::close() !!}
</div>
<img id="el" src='{{$image}}' {{$imageSize}}>
<script type="text/javascript">
    var el = document.getElementById('el');
    el.addEventListener('click', getClickXY, false);
    el.addEventListener('mousemove', moveClickXY, false);
    //mouseup

    function getClickXY(event)
    {
        var clickX = (event.layerX == undefined ? event.offsetX : event.layerX) + 1;
        var clickY = (event.layerY == undefined ? event.offsetY : event.layerY) + 1;
        document.getElementById('stmove').style.zindex=-1;
        document.getElementById('X').value = clickX+12;
        document.getElementById('Y').value = clickY;

        divkoordinateY=clickY+70;
        divkoordinateY2=clickY+120;
        document.getElementById('st').style.top = divkoordinateY+'px';
        document.getElementById('st').style.left = clickX+12+'px';
        document.getElementById('st2').style.top = divkoordinateY2+'px';
        document.getElementById('st2').style.left = clickX+12+'px';
        alert('Координати де буде розташован позивний та ім\'я визначено. Оберіть колір та натиснить \"Вказав\"' );

    }
    function moveClickXY(event)
    {
        //document.getElementById('st').style.top = divkoordinateY+'px';
        var clickX = (event.layerX == undefined ? event.offsetX : event.layerX) + 1;
        var clickY = (event.layerY == undefined ? event.offsetY : event.layerY) + 1;

        divkoordinateY=clickY+70;
        divkoordinateY2=clickY+120;
        document.getElementById('st').style.zindex =-1;
        document.getElementById('stmove').style.top = divkoordinateY+'px';
        document.getElementById('stmove').style.left = clickX+12+'px';
        document.getElementById('stmove2').style.top = divkoordinateY2+'px';
        document.getElementById('stmove2').style.left = clickX+12+'px';
    }

</script>

<div class="stamp" id="st"><center>AA1BB </center></div>
<div class="stamp" id="st2"><center> Name Sirname</center></div>
<div class="stamp2" id="stmove"><center>AA1BB </center></div>
<div class="stamp2" id="stmove2"><center>Name Sirname</center></div>

</body>
</html>