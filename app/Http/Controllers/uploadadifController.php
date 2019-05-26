<?php

namespace Ukrainediploms\Http\Controllers;
//namespace Ukrainediploms;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Include_;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Cookie;
use stdClass;
class uploadadifController extends BaseController {

   /* public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function getForm ()
    {
        $token = new ProgramsDiplom;
        $tokenArray=$token->GetAllPrograms();
        foreach($tokenArray as $tokenkey)
        {
            $token=$tokenkey->token;
        }
        return View('thewall2/formadif', ["token"=>$token]);
    }
    public function upload (Request $request)
    {
      /*upload ADI file from cabinet diplom manager*/
        if($request->file()!=NULL) {
            $file = new recievAdif;
            $recordFile = new DBwork();
            $user = md5(auth()->user()->email); // get token user


            $tokenprogramm = $request->Token; // get token programm
            $pathFile = $file->getFile($request);
            if ($pathFile != "STOP" || NULL) {
                $arrayRecord = $file->parseAdif($pathFile);
                //dd($arrayRecord);
                if ($arrayRecord != NULL) {
                    $resulterrors = $recordFile->RecordQSOtoBase($arrayRecord, $tokenprogramm, $user);
                    //dd($user);
                    if (count($resulterrors) == 0) {
                        //dd($arrayRecord);
                        $url="/log?t=".$tokenprogramm;
                        return redirect($url);

                           /* view('thewall2/uploadResult', ['arrayRecord' => $arrayRecord]);*/
                    } else
                                    return redirect($url);
                       /* view('thewall2/uploadResult', ['arrayRecord' => $arrayRecord, "errors" => $resulterrors]);*/
                } else echo "<br>QSO not found<br>";

                unlink(public_path($pathFile));
            } else echo "<br>Incorrect file path<br>";

            //   echo $res['call']." | Date:".$res['qso_date']." | Time: ". $res['time_on']." | Freq: ".$res['band']." | сработал с ". $res['operator']." | RST ". $res['rst_sent']."<br>";
        } else {
            $message = "<b>Помилка!</b><br>Спершу оберіть файл ADIF-звіту.<br>";
            $data[] = ["message" => $message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);
        }
        return 0;

    }
    public  function test()

    {
        $index=1;
        if ($index==1) {
        return view('thewall2/test');
        } else return view('index');
    }
    public function uploadsps(Request $request)
    {
        $keysps=$this->chekLoginSps();

        if($keysps!=NULL) {
            if($request->file()!=NULL) {
                //dd($keysps);
                $file = new recievAdif;
                $recordFile = new DBwork();
                $spsparrent = Cookie::get('spsparrent');

                $tokenprogramm = $request->Token;
                $pathFile = $file->getFile($request);
                if ($pathFile != "STOP" || NULL) {
                    $arrayRecord = $file->parseAdif($pathFile);
                    //dd($arrayRecord);
                    if ($arrayRecord != NULL) {

                        $result = $recordFile->RecordQSOtoBase($arrayRecord, $tokenprogramm, $spsparrent);
                        unlink($pathFile);
                        Cookie::forget('spsparrent');
                        //dd($result);

                        if ($result == NULL) {
                            //dd($result);


                            return view('thewall2/uploadResult', ['arrayRecord' => $arrayRecord, "errors" => NULL]);
                        } else {

                           return view('thewall2/uploadResult', ['arrayRecord' => $arrayRecord, "errors" => $result]);

                        }

                    } else echo "<br>QSO not found<br>";

                } else echo "<br>Incorrect file path<br>";


            }else {

                       $message = "<b>Помилка!</b><br>Спершу оберіть файл ADIF-звіту<br>";
                       $data[] = ["message" => $message];
                       return view('thewall2/alert', ["status" => "warn", "data" => $data]);
                  }


        } else {
            //echo "Час перебування в системі вичерпано. Будь ласка пройдіть аутентификацію ще раз, для цього<a href='/addadif'> натисніть тут</a> ";
            $message = "<b>Помилка!</b><br>Час перебування в системі як СПС вичерпано.<br>
                        Будь ласка пройдіть аутентификацію ще раз, для цього <a href='/addadif'>натисніть тут</a>";
            $data[] = ["message" => $message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);
            }

    }
    public function chekLoginSps()
    {
        $spscall = Cookie::get('spscall');
        $spspass = Cookie::get('spskey');
        $spsparrent = Cookie::get('spsparrent');
        //dd($spsparrent);
        $authSps= new DBwork;
        $getspsInfo = $authSps->authSPS($spscall, $spspass);
        //dd($getspsInfo);
        if($getspsInfo!=NULL) {

            return $spspass;
        }
    }

}
