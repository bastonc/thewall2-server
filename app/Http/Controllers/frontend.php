<?php
namespace Ukrainediploms\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;

class frontend
{
    public function getProgramm(Request $request)
    {

        if (isset($request->sortby)AND $request->sortby=="FWD") {
            $sortBy = "FWD";
                }
                else $sortBy="REV";

        $programms = new DBwork;
        $ProgrammArray = $programms->getProgrammFrontEnd(3, "id", $sortBy);
        foreach ($ProgrammArray as $token) {
                $spsForProgram = $programms->getSpsForProgram($token->token);

                $token->sps = $spsForProgram;
                }

       // dd($ProgrammArray);
        //$getProgramm=array_reverse($ProgrammArray);
        return view('thewall2/indexProgramm',["Programms"=>$ProgrammArray]);

    }
    public function programmInside (Request $request)
    {
        $token=$request->p;
        $programmInside = new DBwork;
        $programmInfo=$programmInside->getProgrammInfo($token);
        $spsMember=$programmInside->getSpsForProgram($token);
        $complitedCall=$programmInside->getComplitedCall($token);

        //echo "I have token: ",$token, "<br>", $programmInfo[0]->name;
        if($programmInfo!=NULL)
        {
        $programmName=$programmInfo[0]->name;
        return view('thewall2/programmInfo',["programmInfo"=>$programmInfo, "programmName"=>$programmName, "spsMember"=>$spsMember, "complitedCallArray"=>$complitedCall]);
        }
        else
            echo "Error! I don't know this programm (Programm inside)";
        //

    }
    public function searchCall(Request $request)
    {

        $call=$request->searchcall;
        $tokenprogramm=$request->Token;
        $totalscore=0;
        $result = $this->resultForCall($call, $tokenprogramm); //get 0 if completed program or 1 if not completed this program for call




    /*
        //echo $call,"<br>";
        //echo $tokenprogramm,"<br>";


*/
        $scoreDefinition = new ProgramsDiplom;
        $searchinProgramm = new DBwork;
        $searchCallInProgramm = $searchinProgramm->searchCall($call,$tokenprogramm); //all QSO for call of this programm
        $programmInfos=$scoreDefinition->getProgrammInfo($tokenprogramm); // get all info for programm (tokenprogramm)

        foreach ($programmInfos as $programmInfo)
        {
            $finalScoreProgramm=$programmInfo->scoreFinal;
            $programmName=$programmInfo->name;
            $spsForProgram = $searchinProgramm->getSpsForProgram($programmInfo->token);
            $programmInfo->sps = $spsForProgram; // set array sps call for this program
            $method_recieve=$programmInfo->method_recieve; // get method reciev diplom ( only Email or get image )
            $recieveArray[]=$method_recieve;
            if($method_recieve==1) {
                $recieveArray[] = $programmInfo->cordinatex;
                $recieveArray[] = $programmInfo->cordinatey;
                $recieveArray[] = $programmInfo->XName;
                $recieveArray[] = $programmInfo->YName;
                $recieveArray[] = $programmInfo->XNum;
                $recieveArray[] = $programmInfo->YNum;
                $recieveArray[] = $programmInfo->color;
            }
        }
        //dd($recieveArray);
        foreach($searchCallInProgramm as $info  ){
            $score = $scoreDefinition->scoreDefinition($info->operator,$info->mode,$tokenprogramm);
            $info->score=$score;
            $totalscore=$totalscore+$info->score;
            // echo $info->call, " -> ", $info->operator," => ",$info->score,"<br>";

        }

        if($result==0)
        {


           // echo "Congratulation!<br> Diplom \"", $programmName,"\" completed!<br> Final score: ", $finalScoreProgramm, "<br>";


            return view("thewall2/resultcallcompleted",["searchCallInProgramm"=>$searchCallInProgramm,
                "programmName"=>$programmName,"totalScore"=>$totalscore,
                "finalScoreProgramm"=>$finalScoreProgramm, "call"=>$call, "tokenProgramm"=>$tokenprogramm,
                "programmInfo"=>$programmInfos, "methodArray"=>$recieveArray]);
            /* Тут возрвщаем Вьюху выполенного диплома
             *  во вьюху с формой ввода E-mail (выполенный диплом) передаем:
             * 1. массив $searchCallInProgramm в котором информация по каждому QSO с очками
             * 2. название программы - $programmName,
             * 3. кол-во набранных очков - $totalscore
             * 4. необходимое кол-во очков которое необходимо набрать для выполнения программы - $finalScoreProgramm
             * 5. массив для передачиданных для нанесения надписей на шаблон диплома
             */

        }

        else {
           // echo " Diplom \"", $programmName,"\" in action!<br> Final score: ", $finalScoreProgramm, "<br>";

            return view("thewall2/resultcall",["searchCallInProgramm"=>$searchCallInProgramm, "programmName"=>$programmName,
                                "totalScore"=>$totalscore, "finalScoreProgramm"=>$finalScoreProgramm, "call"=>$call, "tokenProgramm"=>$tokenprogramm, "programmInfo"=>$programmInfos]);
            /* Тут возрвщаем Вьюху невыполенного диплома
            *  во вьюху передаем:
            * 1. массив $searchCallInProgramm в котором информация по каждому QSO с очками
            * 2. название программы,
            * 3. кол-во набранных очков
            * 4. необходимое кол-во очков которое необходимо набрать для выполнения программы - $finalScoreProgramm
            */

        }
        //echo "Total: ",$totalscore;

        //dd ($searchCallInProgramm);




    }
    public function sendemail(Request $request)
    {

        if($request->key == 0) {
            if ($request->email == NULL || $request->token == NULL || $request->call == NULL) {
                echo "ERROR! I don't have E-mail or token";
            } elseif ($request->email != NULL && $request->token != NULL && $request->call != NULL) {


                /*
                 *  дейсвительно ли позівной $call выполнил условия диплома $token
                 * Если условия выполенны - получить название дипломной программы и поодготовить текст для передачи в шаблон
                 *
                 *
                 */


                $call = $request->call;

                $chekFlagForCall = $this->resultForCall($call, $request->token);
                if ($chekFlagForCall == 0) {
                    $diplomInfo = new ProgramsDiplom;
                    $emails = $diplomInfo->getProgrammInfo($request->token);
                    //$emails[0]->email_manager;
                    $nameProgramm = $emails[0]->name;
                    $to = $emails[0]->email_manager;
                    $subject = "New diplom for " . $call;
                    $from = "eo90l@gmail.com";
                    $text = $request->email;
                    //$data = "hello=>Sergey";
                    //dd($request->token);
                    $this->sendMail($to, $subject, $from, $call, $text, $nameProgramm, $request->key);
                    $message = "Ваша адреса електронноi пошти направлена до дипломного менеджера.
                            
                              Очiкуйте диплом на пошту.
                            
                              Дякуємо за участь
                              ";

                    $data[] = ["email" => $call, "call" => $call, "token" => $request->token, "message" => $message];
                    //dd($data);
                    $setCall = new ProgramsDiplom;
                    $setCall->setComplitedForCall($request->token, $call);
                    return view('thewall2/alert', ["status" => "congratulations", "data" => $data]);
                } else {
                    $message = "Помилка! " . $call . " не виконав умови дипломної програми";
                    $data[] = ["email" => $to, "call" => $call, "token" => $request->token, "message" => $message];
                    return view('thewall2/alert', ["status" => "warn", "data" => $data]);
                }
            }
        }
        if($request->key == 1){
            if ($request->name == NULL || $request->token == NULL || $request->call == NULL || $request->XCall == NULL || $request->YCall == NULL || $request->color == NULL) {
                echo "ERROR! I don't have full information";
            }
            elseif ($request->name != NULL && $request->token != NULL && $request->call != NULL && $request->XCall != NULL && $request->YCall != NULL && $request->color != NULL)
            {
                $call = $request->call;

                $chekFlagForCall = $this->resultForCall($call, $request->token);
                if ($chekFlagForCall == 0) {
                    $diplomInfo = new ProgramsDiplom;
                    $emails = $diplomInfo->getProgrammInfo($request->token);

                    //$emails[0]->email_manager;
                    $nameProgramm = $emails[0]->name;
                    $to = $emails[0]->email_manager;
                    $subject = "New diplom for " . $call;
                    $from = "eo90l@gmail.com";
                    $text = $request->email;
                    //$data = "hello=>Sergey";
                    //dd($request->token);
                    $this->sendMail($to, $subject, $from, $call, $text, $nameProgramm, $request->key);
                    $setCall = new ProgramsDiplom;
                    $setCall->setComplitedForCall($request->token, $call);
                    $imagePath=$emails[0]->image;
                    $XCall=$request->XCall;
                    $YCall=$request->YCall;
                    $XName=$request->XName;
                    $YName=$request->YName;
                    $XNum=$request->XNum;
                    $YNum=$request->YNum;
                    //dd($YNum);
                    $numberDiplom = new DBwork;
                    // Get Serial Number of diploma for call (first search - increase 1 for S/N in Programm )
                    $num=$numberDiplom->getNumberDiplom($request->token, $call);
                    // send all data to function output on image
                    //dd($call);
                    $getimage = $this->getImage($imagePath, $call, $request->name, $XCall, $YCall, $XName, $YName, $XNum, $YNum, $request->color,$nameProgramm, $num);

                } else {
                    $message = "Помилка! " . $call . " не виконав умови дипломної програми";
                    $data[] = ["email" => $to, "call" => $call, "token" => $request->token, "message" => $message];
                    return view('thewall2/alert', ["status" => "warn", "data" => $data]);
                }
            }
            }


            //echo "hello!<br> This is fronend controller and sendmail method<br> I have<br> email: ", $request->email,"<br> Token: ", $request->token,"<br>";}

            else
        {echo "Unknown error";}
    }
    public function getImage ($imagePath, $call, $name, $XCall, $YCall, $XName, $YName, $XNum, $YNum, $color, $nameProgramm, $num)
    {
        $imagePathCorrect="";
        for($i=0; $i<strlen($imagePath); $i++)
        {
            if($i>0){
                if($imagePath[$i]=="\\"){
                    $imagePath[$i]="/";
                }
                $imagePathCorrect=$imagePathCorrect.$imagePath[$i];
            }


        }
        //dump($imagePath);
        //dd($imagePathCorrect);
        //dd($imagePathCorrect);
        $call=strtoupper($call);
        $image= imagecreatefromjpeg($imagePathCorrect);
        if($color=="black")
            $textcolor = imagecolorallocate($image, 20, 20, 20);
        if ($color=="white")
            $textcolor = imagecolorallocate($image, 255, 255, 255);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = 'a_Futurica_ExtraBold';
        $imageOption=getimagesize($imagePathCorrect);
        if($imageOption[0]<600 or $imageOption[1]<600)
        {
            $sizeCall=16;
            $sizeName=16;
            $y_dop=20;
        }
        if(($imageOption[0]>600 && $imageOption[0]<1400)or($imageOption[1]>600 && $imageOption[1]<1400))
        {
            $sizeCall=17;
            $sizeName=17;
            $y_dop=20;
        }
        if($imageOption[0]>1400 or $imageOption[1]>1400)
        {
            $sizeCall=40;
            $sizeName=23;
            $y_dop=40;
        }

        $x_call=$XCall;
        $y_call=$YCall;
        $x_name=$XName;
        $y_name=$YName;
        $x_num=$XNum;
        $y_num=$YNum;

        //$countNum=count($num);
        if($num < 10)
            $numstring='00'.$num;
        if($num >= 10 AND $num < 100)
            $numstring='0'.$num;
        if($num >= 100)
            $numstring=$num;
        //$string=$call." ".$name;
       // dd($x_call,$x_num);
        imagefttext($image, $sizeCall, 0, $x_call, $y_call, $textcolor, $font, $call);
        imagefttext($image, $sizeName, 0, $x_name, $y_name, $textcolor, $font, $name);
        imagefttext($image, $sizeName, 0, $x_num, $y_num, $textcolor, $font, $numstring);
        $filename=$call."-".$nameProgramm.".jpg";
        //imagestring ( $image , 4, 1250 , 750 , "Test" , $textcolor );

        //header('Content-Type: image/jpeg');
        //header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        imagejpeg($image);

        return redirect(url('/'));
       /* $headers = [
            'Content-Type' => 'application/jpg',
        ];
        return

        //imagejpeg($image);
        //echo "Сохраніть картинку як Ваш диплом, та поверніться на головну";*/
    }
    public function sendMail ($to, $subject, $from, $call, $text, $nameProgramm, $method)
    {
        if($method==1) {
            $pathToEmailTemplate="thewall2.mail.image";
        }
        elseif($method==0) {
            $pathToEmailTemplate="thewall2.mail.email";
        }else {
            $message = "Помилка! Не намагайтесь обдурити систему. Вона умна";
            $data[] = [ "message" => $message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);
        }

        $stat=Mail::send($pathToEmailTemplate,['data'=> $text, 'call'=>$call, 'nameProgramm'=>$nameProgramm], function ($message) use ($to,$subject,$from) {

            $message->from($from,$subject);
            $message->to($to);


        });
       // dd($stat);
        return $stat;

    }
    public function resultForCall( $call, $tokenprogramm)
    {


        $totalscore=0;


        $searchinProgramm = new DBwork;
        $scoreDefinition = new ProgramsDiplom;

        $searchCallInProgramm = $searchinProgramm->searchCall($call,$tokenprogramm); //get all QSOs for this call

        foreach($searchCallInProgramm as $info  ){
            $score = $scoreDefinition->scoreDefinition($info->operator,$info->mode,$tokenprogramm); // get QSO score for call in programm
            $info->score=$score; //set into stdobject score for QSO
            $totalscore=$totalscore+$info->score; // summary score for all QSOs


        }
        $programmInfos=$scoreDefinition->getProgrammInfo($tokenprogramm); // get information about programm
        foreach ($programmInfos as $programmInfo)
        {
            $finalScoreProgramm=$programmInfo->scoreFinal; // get score for complited for this programm

        }

        if($totalscore >= $finalScoreProgramm) // check complete or not this program for call
        {
            $win=0;
        }
        else {


            $win=1;


        }
        return $win; // return 0 if call completed programm, and 1 if not completed






    }
    public function search(Request $request)
    {
        if($request->textsearch!=NULL)
        {   $searchClass = new DBwork;
            $searchArray = $searchClass->UserSearch($request->textsearch, "PROGRAMM","name", "*", "NoStrong");
            //dd($searchArray);
            return view("thewall2/searchresult",["searchArray"=>$searchArray, "searchString"=>$request->textsearch]);


        } else
        {
            $message = "<b>Пошук пустий!<br /> Поверніться та спробуйте ще</b>";
            $data[] = ["message" => $message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);
        }
    }
    public function getReport(Request $request)
    {

        $scoreDefinition = new ProgramsDiplom;
        $searchinProgramm = new DBwork;
        $totalscore=0;
        $call=$request->call;
        $tokenprogramm=$request->t;
        $searchCallInProgramm = $searchinProgramm->searchCall($call,$tokenprogramm);
        foreach($searchCallInProgramm as $info  ){
            $score = $scoreDefinition->scoreDefinition($info->operator,$info->mode,$tokenprogramm);
            $info->score=$score;
            $totalscore=$totalscore+$info->score;
            // echo $info->call, " -> ", $info->operator," => ",$info->score,"<br>";

        }
        //  dd($searchCallInProgramm);
        $programminfo=$searchinProgramm->getProgrammInfo($tokenprogramm);
        return view("thewall2.reportqso", ["callArray"=>$searchCallInProgramm,"programmArray"=>$programminfo]);

    }
    public function anounce(Request $request)
    {
        $programmsForAnouncedb = new DBwork;
        $today=date('Y-m-d');
        //dd($today);
        $programmArray=$programmsForAnouncedb->getProgrammForAnounce($today, 'open');
        $tomorrow=date('Y-m-d', strtotime($today. ' + 1 days')); //устанавливаем дату "завтра"
        $dayAfterTomorow=date('Y-m-d', strtotime($today. ' + 2 days')); //устанавливаем дату послезавтра
        //dump($tomorrow);
        //dd($programmArray);
        $tomorowArray= Array();
        $dayAftertomorowArray= Array();
        $remainingWeekArray= Array();
        foreach ($programmArray as $programm)
        {
            $date=date_create($programm->start_for_page)->Format('Y-m-d');
            //dump($date);

            if($date==$tomorrow)
            {
                $programm->start_for_page=date_create($programm->start_for_page)->Format('Y-m-d');
                $tomorowArray[]=$programm;
                //dump($tomorowArray);
            }
            elseif($date==$dayAfterTomorow)
            {
                $programm->start_for_page=date_create($programm->start_for_page)->Format('Y-m-d');
                $dayAftertomorowArray[]=$programm;
                //dump($dayAftertomorowArray);
            }
            else{
                $programm->start_for_page=date_create($programm->start_for_page)->Format('Y-m-d');
                $remainingWeekArray[]=$programm;

               // dump($remainingWeekArray);
                }
        }

          /*  usort($remainingWeekArray, function( $a, $b ) {
                return strtotime($a["date"]) - strtotime($b["date"]);
            });
           */
            $anounceCommonArray= array('tomorow'=>$tomorowArray,
                                 'dayAftertomorow' => $dayAftertomorowArray,
                                 'remainingWeek'=>$remainingWeekArray,);
        //dump($anounceCommonArray['remainingWeek'][1]->start_for_page);

        dd($anounceCommonArray);
    }




}
