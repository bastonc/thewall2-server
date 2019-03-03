<?php

namespace Ukrainediploms\Http\Controllers;

use Illuminate\Http\Request;

class UserWallController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getListProgram(Request $request)

      {   $sortBy="id";
          if (isset($request->sortby)AND $request->sortby=="FWD") {
              $reverse = "FWD";
          }
          else $reverse="REV";

          $listProgram= new ProgramsDiplom;
          $getList=$listProgram->GetAllPrograms(10,$reverse, $sortBy);



          return view("thewall2/cabinet", ["getList"=>$getList]);

        /* foreach($getList as $list)
          {
              //dd($list);
              echo $list->name."<br>";
              echo $list->description."<br>";
              echo $list->scoreFinal."<br>";
              echo $list->scoreDefault."<br>";
          }*/

      }
    public function editProgram(Request $request)
    {
        $getdata= new ProgramsDiplom;
        $data=$getdata->getProrgam($request);
        $sps=$getdata->getsps($request);

        if($data==NULL)
        {
            $name=md5(auth()->user()->email);
            return view("thewall2/erroracces",["ErrorUser"=>$name]);
        }
        else
        {
          return view("thewall2/programform",["dataArray"=>$data,"arraysps"=>$sps]);
        }

    }
    public function saveProgram(Request $request)
    {
        $this->validate($request, [
            'Name' => 'required',
            'Description' => 'required',
            'ScoreFinal'=>'required',
            'ScoreDefault'=>'required',
            'emailManager'=>'required',
            'startProgramm'=>'required',
            'finishProgramm'=>'required'
        ]);

        $save = new ProgramsDiplom;
        $saveMessage=$save->saveProgram($request);

        if($request->methodReciev=='1') {
            if ($request->hasFile('Image')) {


                if ($saveMessage[0] != NULL) {
                    $sizeArray = $this->fullSizeImage($saveMessage[1]);
                    return view('thewall2.setcordinate', ["tokenprogramm" => $saveMessage[0], "image" => $saveMessage[1], "imageSize" => $sizeArray[3]]);
                }
            }
            return redirect()->route('cabinet');

        }
            elseif ($request->methodReciev == '0') {
                //dd($saveMessage);
                return redirect()->route('cabinet');
            }


            else {
            $message="";
            for ($i=0;$i<count($saveMessage);$i++) {
                $message = $message."<br>".$saveMessage[$i]."<br /><br />Поверніться та ОБОВ'ЯЗКОВО натисніть F5 щоб побачити які СПС були додані<br />";
            }
            $data[]=["message"=>$message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);

        }

    }
    public function logProgram(Request $request)
    {
        $record = new ProgramsDiplom;
        $recordArray=$record->getLog($request);
        $resolvForm=$record->getStatusProgramm($request);
        $name=$record->getNameProgramm($request);
       // dd($recordArray);
        return view("thewall2/logprogram",["arrayRecord"=>$recordArray, "Token"=>$request->t,
                          "resolvForm"=>$resolvForm, "NameProgramm"=>$name, "tokenprogramm"=>$request->t]);

    }
    public function delProgram(Request $request)
    {
        $delete=new ProgramsDiplom;
        $delete->deleteProgramm($request);
        return redirect()->route('cabinet');

    }
    public function closeProgram(Request $request)
    {
        $stop = new ProgramsDiplom;
        $stop->closeProgramm($request);
        return redirect()->route('cabinet');

    }
    public function openProgram(Request $request)
    {
        $stop = new ProgramsDiplom;
        $stop->openProgramm($request);
        return redirect()->route('cabinet');

    }
    public function createProgram(Request $request)
    {
        $this->validate($request, [
            'Name' => 'required',
            'Description' => 'required',
            'ScoreFinal'=>'required',
            'ScoreDefault'=>'required',
            'emailManager'=>'required',
            'startProgramm'=>'required',
            'finishProgramm'=>'required'
        ]);
        $createProgramm = new ProgramsDiplom;
        $arrayresult=$createProgramm->createNewProgramm($request);
       // dd($arrayresult[1]);
        if($request->methodReciev=='1') {
            if ($arrayresult != "NO") {
                if ($arrayresult[1] != NULL) {
                    $sizeArray = $this->fullSizeImage($arrayresult[1]);
                    //dd($sizeArray);
                    return view('thewall2.setcordinate', ["tokenprogramm" => $arrayresult[0], "image" => $arrayresult[1], "imageSize"=>$sizeArray[3]]);
                }
                else
                    return redirect()->route('cabinet');
            } else {
                $message = "<b>Помилка!</b><br>Можливо программа з таким ім'ям вже існує<br />Спробуйте ще :)";
                $data[] = ["message" => $message, "path_back" => "/cabinet"];
                return view('thewall2/alert', ["status" => "warn", "data" => $data]);
            }
        }else return redirect()->route('cabinet');

    }
    public function fullSizeImage($imagePath)
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

       // dd($imagePath);
     }
     return getimagesize ($imagePathCorrect);
 }
    //
    public function getcordinatexy (Request $request)
    {
        $this->validate($request, [
            'X' => 'required',
            'Y' => 'required',
            'color'=>'required',
            'tokenprogramm'=>'required']);

        $x=$request->X;
        $y=$request->Y;
        $color=$request->color;
        $tokenprogramm=$request->tokenprogramm;
        $cordinatxy= new ProgramsDiplom();
        $savecordinate = $cordinatxy->savecordinate($x,$y,$color,$tokenprogramm);
        return redirect()->route('cabinet');
       // echo $request->X,"<br>", $request->Y, "<br>", $request->tokenprogramm ;
    }
    public function reportComplited(Request $request){

        $tokenProgramm=$request->t;
        $programmInside = new DBwork;
        $complitedCall=$programmInside->getComplitedCall($tokenProgramm);
        foreach ($complitedCall as $call)
        {
            $totalscore=0;


            $searchinProgramm = new DBwork;
            $scoreDefinition = new ProgramsDiplom;

            $searchCallInProgramm = $searchinProgramm->searchCall($call->call,$tokenProgramm); //get all QSOs for this call

            foreach($searchCallInProgramm as $info  ){
                $score = $scoreDefinition->scoreDefinition($info->operator,$info->mode,$tokenProgramm); // get QSO score for call in programm
                //$info->score=$score; //set into stdobject score for QSO

                $totalscore=$totalscore+$score; // summary score for all QSOs


            }
            $call->score=$totalscore;
           // $call->score="100";
            //$call->QSOs[]=()
           // dd($call);
        }
       // dd($complitedCall);
        $programminfo=$programmInside->getProgrammInfo($tokenProgramm);
        return view("thewall2.report", ["callArray"=>$complitedCall,"programmArray"=>$programminfo]);

    }
    public function test()
    {
       // dd(gd_info ());
        $image= imagecreatefromjpeg('image/d06d268a5cb609dafc238ce9c384797dsuda.jpg');
        $textcolor = imagecolorallocate($image, 0, 100, 255);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = 'a_Futurica_ExtraBold';
        imagefttext($image, 20, 0, 1180, 750, $textcolor, $font, 'UR4LGA');
        imagefttext($image, 20, 0, 1140, 800, $textcolor, $font, 'Бастон Сергей');
        //imagestring ( $image , 4, 1250 , 750 , "Test" , $textcolor );
        header('Content-Type: image/jpeg');
        imagejpeg($image);
    }
}
