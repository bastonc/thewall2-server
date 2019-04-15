<?php
$formtext="Оберіть де буде відображатись позивний, ім'я здобувча, та номер диплому";

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
            height:25px;
            background:#ddd;
            position: absolute;
            opacity:0.9;
            font-size:25px;
            /*z-index: 2*/

        }
        .stamp2{
            /* width:400px;*/
            height:20px;
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

        .button-submit {
            color: #d3e0e9;
            background-color: #215D07;
            border: #215D07; width: 150px;
            height: 30px; font-size: 15px;
            font-family: Lato;font-weight: bold
        }
    </style>

</head>
<body>
<div class="description">
    {!!   Form::open(array('action' => 'UserWallController@getcordinatexy')) !!}
    <center>{{$formtext}}
        <br /><br />
        Оберіть колір надписів<br />
        Чорний<input name="color" type="radio" value="black" checked>
        Білий<input name="color" type="radio" value="white">
        <!--select name="color"><option>Чорний</option><option>Білий</option></select-->
        <input type='hidden' id="XCall" name="XCall">
        <input type='hidden' id="YCall" name="YCall">
        <input type='hidden' id="XName" name="XName">
        <input type='hidden' id="YName" name="YName">
        <input type='hidden' id="XNum" name="XNum">
        <input type='hidden' id="YNum" name="YNum">
        <input type="hidden" value="{{$tokenprogramm}}" name="tokenprogramm">
        <br />
        <button type="submit" class="button-submit"> Я Зробив! </button>
    </center>
    {!! Form::close() !!}
</div>
<img id="el" src='{{$image}}' {{$imageSize}}>
<script type="text/javascript">


    var el = document.getElementById('el');
    el.addEventListener('click', getClickXY, false);
    el.addEventListener('mousemove', moveClickXY, false);

    //mouseup
    //document.getElementById('call').innerText="call";

    function getClickXY(event)
    {
        var clickX = (event.layerX == undefined ? event.offsetX : event.layerX) + 1;
        var clickY = (event.layerY == undefined ? event.offsetY : event.layerY) + 1;

        if(document.getElementById('num')) {

            var name1="num";
            var name2="nummove";
            var valueX="XNum";
            var valueY="YNum";
            var divfixedname="numfixed";
            document.getElementById(name1).innerText="0123";
            document.getElementById(name2).style.zindex = "-1";
            document.getElementById(valueX).value = clickX;
            document.getElementById(valueY).value = clickY-15;

            divkoordinateY = clickY + 70;
            divkoordinateY2 = clickY + 120;



            setcoordinate=confirm('Координати де буде розташован номер диплому визначено.');
            if(setcoordinate){
                document.getElementById(divfixedname).style.top = divkoordinateY + 'px';
                document.getElementById(divfixedname).style.left = clickX + 12 + 'px';
                document.getElementById(divfixedname).innerText="0123";
                document.getElementById(name1).id = "Ready";
                document.getElementById(name2).id = "Readymove";
            }
        }

        if(document.getElementById('name')) {

            var name1="name";
            var name2="namemove";
            var valueX="XName";
            var valueY="YName";
            var divfixedname="namefixed";
            document.getElementById(name1).innerText="Name Sirname";
            document.getElementById(name2).style.zindex = -1;
            document.getElementById(valueX).value = clickX;
            document.getElementById(valueY).value = clickY-15;

            divkoordinateY = clickY + 70;
            divkoordinateY2 = clickY + 120;

            setcoordinate=confirm('Координати де буде розташоване ім\'я визначено.');
            if(setcoordinate){
                document.getElementById(divfixedname).style.top = divkoordinateY + 'px';
                document.getElementById(divfixedname).style.left = clickX + 12 + 'px';
                document.getElementById(divfixedname).innerText="Name Sirname";

                if (document.getElementById('XNum').value==""){
                    document.getElementById(name1).id = "num";
                    document.getElementById(name2).id = "nummove";
                } else if (document.getElementById('XNum').value!=""){
                    document.getElementById(name1).id = "Ready";
                    document.getElementById(name2).id = "Readymove";
                }


            }
        }

        if(document.getElementById('call')) {

            var name1="call";
            var name2="callmove";
            var valueX="XCall";
            var valueY="YCall";
            var divfixedname="callfixed";
            document.getElementById(name1).innerText="AA1BBC";
            document.getElementById(name2).style.zindex = -1;
            document.getElementById(valueX).value = clickX;
            document.getElementById(valueY).value = clickY-15;

            divkoordinateY = clickY + 70;
            divkoordinateY2 = clickY + 120;


            setcoordinate=confirm('Координати де буде розташован позивний визначено.');

            if(setcoordinate){
                //document.getElementById(name1).id = "name";
                // document.getElementById(name2).id = "namemove";
                document.getElementById(divfixedname).style.top = divkoordinateY +'px';
                document.getElementById(divfixedname).style.left = clickX+12+'px';
                document.getElementById(divfixedname).innerText="AA1BBC";

                if (document.getElementById('XName').value==""){
                    document.getElementById(name1).id = "name";
                    document.getElementById(name2).id = "namemove";
                } else if (document.getElementById('XName').value!=""){
                    document.getElementById(name1).id = "Ready";
                    document.getElementById(name2).id = "Readymove";
                }
            }
        }

    }
    function moveClickXY(event)
    {

        var clickX = (event.layerX == undefined ? event.offsetX : event.layerX) + 1;
        var clickY = (event.layerY == undefined ? event.offsetY : event.layerY) + 1;

        if(document.getElementById('num'))
        {
            var name1="num";
            var name2="nummove";
            divkoordinateY=clickY+70;
            divkoordinateY2=clickY+120;
            document.getElementById(name2).innerText="0123";
            document.getElementById(name1).style.zindex =-1;
            document.getElementById(name2).style.top = divkoordinateY+'px';
            document.getElementById(name2).style.left = clickX+12+'px';

        }
        if(document.getElementById('name'))
        {
            var name1="name";
            var name2="namemove";
            divkoordinateY=clickY+70;
            divkoordinateY2=clickY+120;
            document.getElementById(name2).innerText="Name Sirname";
            document.getElementById(name1).style.zindex =-1;
            document.getElementById(name2).style.top = divkoordinateY+'px';
            document.getElementById(name2).style.left = clickX+12+'px';

        }

        if(document.getElementById('call'))
        {

            var name1="call";
            var name2="callmove";
            divkoordinateY=clickY+70;
            divkoordinateY2=clickY+120;
            document.getElementById(name2).innerText="AA1BBC";
            document.getElementById(name1).style.zindex =-1;
            document.getElementById(name2).style.top = divkoordinateY+'px';
            document.getElementById(name2).style.left = clickX+12+'px';



        }


    }

    function changecoordinate(who){
        //alert(who);
        if (who=="callfixed"){
            var name1="call";
            var name2="callmove";
            document.getElementById('Ready').id = name1;
            document.getElementById('Readymove').id = name2;

        }
        if (who=="namefixed"){
            var name1="name";
            var name2="namemove"
            document.getElementById('Ready').id = name1;
            document.getElementById('Readymove').id = name2;

        }
        if (who=="numfixed"){
            var name1="num";
            var name2="nummove";
            document.getElementById('Ready').id = name1;
            document.getElementById('Readymove').id = name2;

        }



    }
</script>

<div class="stamp" id="call"><center> </center></div>
<div class="stamp" id="callfixed"  ><center> </center></div>
<div class="stamp" id="namefixed" ><center> </center></div>
<div class="stamp" id="numfixed" ><center> </center></div>
<div class="stamp2"id="callmove"><center></center></div>
<script>
    /*var callsign=document.getElementById('callfixed');
        callsign.addEventListener('click',changecoordinate, false);*/
    callfixed.onclick= function () {
        var name1="call";
        var name2="callmove";
        document.getElementById('Ready').id = name1;
        document.getElementById('Readymove').id = name2;
    };
    namefixed.onclick= function () { var name1="name";
        var name2="namemove";
        document.getElementById('Ready').id = name1;
        document.getElementById('Readymove').id = name2;
    };
    numfixed.onclick= function () {  var name1="num";
        var name2="nummove";
        document.getElementById('Ready').id = name1;
        document.getElementById('Readymove').id = name2;
    };
</script>


</body>
</html>
