<!-- status=congratulations|warn ; $data[0]['message'] - text message ; $data[0]['token'] - token programm ;
     $time - time delay for redirect; -->

@if ($status=='congratulations')
    <?php $color="#55aa55";
    $backlink="<a href='/'>Повернутись на головну</a>"?>

@endif
@if ($status=='warn')
    <?php

     $color="#cc4444";
     $backlink="<div style='color: #d3e0e9; size: 15px; background: #003b4d' onClick='history.back()'><br />Натисніть сюди щоб повернутись<br /><br /></div>"
     ?>
@endif
<head>
     <?php
    if(isset($data[0]['token'])){
    $token = $data[0]['token'];
    $urlprogramm="/programm/?p=".$token;
    }

     ?>
@if(isset($urlprogramm))
         <meta http-equiv="refresh" content="7;{{$urlprogramm}}">
@endif

         @if(isset($time))
             <meta http-equiv="refresh" content="{{$time}};{{$urlprogramm}}">
         @endif


</head>>




<body text="#f0ffff">
<center>
    <table width="100%" height="100%" border="0">
        <tr>
            <td align="center">
<table width="30%" height="30%">
    <tr>
        <td align="center" bgcolor={{$color}} valign="middle">

            <p>{!! $data[0]['message']!!}</p>
                {!! $backlink !!}



        </td>
    </tr>

</table>
        </td>
        </tr>
    </table>
</center>
</body>