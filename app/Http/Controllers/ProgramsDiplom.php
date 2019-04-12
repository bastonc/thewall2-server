<?php
namespace Ukrainediploms\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Carbon;

class ProgramsDiplom
{
    public function getsps($request)
    {
        $tokenParrentUser=md5(auth()->user()->email);
        $dataArraySps=DB::select('select `call`, `score`,`mode`
                              from SPS
                              where tokenparrentprogram = ? AND tokenparentuser=?', [$request->t, $tokenParrentUser]);
        return $dataArraySps;
    }
    public function GetAllPrograms($paginate, $reverse, $sortBy)
        //$paginate - how page in paginate,
        //$SortBy - column name for sortBy
        //$reverse - REV|FWD - rev - reverse sort; fwd - forward sort

    {
        $token=md5(auth()->user()->email);
        //echo $token;
        if($reverse=="FWD")
        {
            $userProgramm=DB::table('PROGRAMM')->orderBy($sortBy)->where('tokenparrentuser', '=', $token)->paginate($paginate);
            //$rev="FWD";
        } else {
            $userProgramm = DB::table('PROGRAMM')->orderBy($sortBy, "desc")->where('tokenparrentuser', '=', $token)->paginate($paginate);
        }
       // $userProgramm=DB::select('select * from PROGRAMM where tokenparrentuser = ?', [$token]);
        //dd($userProgramm);
        return $userProgramm;
    }
    public function getProrgam($request)
    {
        $tokenParrentUser=md5(auth()->user()->email);
        $token = $request->t;
        //echo  $tokenParrentUser." ".$token;
        $dataArray=DB::select('select *
                              from PROGRAMM
                              where token = ? AND tokenparrentuser=?', [$token, $tokenParrentUser]);
        //dd($dataArray);

        return $dataArray;
    }
    public function saveProgram($request)
    {

        $resultInfo = array();
        $tokenParrentUser=md5(auth()->user()->email);
      $tokenprogramm=request()->Token;
       // dd(request()->all());
        $start_for_page = date("Y-m-d H:i:s", strtotime(request()->startProgramm));
        $finish_for_page = date("Y-m-d H:i:s", strtotime(request()->finishProgramm));
        if($request->hasFile('Image')) {
            $file = $request->file('Image');
            $file->move(public_path() . '/image', $file->getClientOriginalName());
            $filename = '\image\\' . $file->getClientOriginalName();
           // $flag[]="repalceImage";

            $dataArray=DB::update('UPDATE `PROGRAMM` SET `name`= ? ,`repeat`= ?,`scoreDefault`= ?,`scoreFinal`=?,
                                `image`= ?,`description`= ?, `email_manager`= ?, `start_for_page`=?,`finish_for_page`=?,`method_recieve`=?  
                                WHERE token = ? AND tokenparrentuser = ?', [$request->Name,$request->Repeat,
                $request->ScoreDefault, $request->ScoreFinal, $filename, $request->Description, $request->emailManager,
                $start_for_page, $finish_for_page, $request->methodReciev, $request->Token, $tokenParrentUser]);
            for($i=1; $i<=request()->edit_sps_count;$i++) {
                $spscall = "sps_call_" . $i;
                $spsscore = "sps_score_" . $i;
                $mode= "new_sps_mode_".$i;

                if (request()->$spsscore != NULL) {
                    DB::select('UPDATE `SPS` SET `score`=? WHERE `call`=? AND `tokenparentuser`=? AND `mode`=?',
                        [request()->$spsscore, request()->$spscall, $tokenParrentUser,request()->$mode]);

                }else {$resultInfo[]=request()->$spscall."немае значення балів";}
            }
            if (isset(request()->new_idex_sps))
            {
                for($i=1; $i<=request()->new_index_sps;$i++)
                {
                    $newspsscore = "new_sps_score_" . $i;
                    $prenewspspassword="new_password_".$i;
                    $newspscall = "new_sps_call_" . $i;
                    $mode= "sps_mode_".$i;
                   if(equest()->$newspscall!=NULL){
                        if(request()-> $newspsscore!=NULL) {
                            if (request()->$prenewspspassword != NULL) {
                                /*перевірка чи є такий СПС вже у програмі*/

                                $chek=DB::select('select id from SPS where `tokenparrentuser` = ? AND `tokenparrentprogram`=? AND `mode`=?', [$tokenParrentUser,request()->Token,request()->$mode]);
                                if($chek==NULL) {
                                    $newspspassword = md5(request()->$prenewspspassword);
                                    $description = "Додан при редагувані";
                                    $pretokensps = request()->Token . $tokenParrentUser . $newspscall;
                                    $tokensps = md5($pretokensps);
                                    $call = Str::upper(request()->$newspscall);
                                    DB::insert('insert into SPS (`call`,`token`,`tokenparentuser`,`tokenparrentprogram`,`score`,`password`,`description`,`mode`)
                                   values (?,?,?,?,?,?,?,?)', [$call, $tokensps, $tokenParrentUser, request()->Token, request()->$newspsscore, $newspspassword, $description,$mode]);
                                } else { $resultInfo[] = request()->$newspscall . " вже включено до цієї программи"; }
                                } else { $resultInfo[] = request()->$newspscall . " немає паролю";}
                        } else {$resultInfo[] = request()->$newspscall . " немає кількості балів";}
                    }
                }
            }
        }
        else {

            $rowsDB=DB::update('UPDATE PROGRAMM SET `name`=?, `repeat`= ?,`scoreDefault`= ?,`scoreFinal`=?,
                                `description` = ?, `email_manager`= ?, `start_for_page`=?,`finish_for_page`=?,`method_recieve`=?  
                                WHERE `token` = ? AND `tokenparrentuser` = ?', [$request->Name,$request->Repeat,
                $request->ScoreDefault, $request->ScoreFinal, $request->Description, $request->emailManager,$start_for_page,$finish_for_page,
                $request->methodReciev,$request->Token,$tokenParrentUser]);
            //dd($rowsDB);

            for ($i = 1; $i <= request()->edit_sps_count; $i++) {
                $spsscore = "sps_score_" . $i;

                $spscall = "sps_call_" . $i;
                $mode= "sps_mode_".$i;

                /*dump(request()->$spsscore);
                dump(request()->$spscall);
                dump($tokenParrentUser);
                dump($request->$mode);*/
                if (request()->$spsscore != NULL) {
                // echo $spscall . " " . $spsscore;
                DB::select('UPDATE `SPS` SET `score`=? WHERE `call`=? AND `tokenparentuser`=? AND `mode`=? ', [request()->$spsscore, request()->$spscall, $tokenParrentUser,$request->$mode]);
                }else {$resultInfo[]=request()->$spscall." немае значення балів";}
            }
            if (isset(request()->new_index_sps)) {
                for ($i = 1; $i <= request()->new_index_sps; $i++) {
                    $newspscall = "new_sps_call_" . $i;
                    $newspsscore = "new_sps_score_" . $i;
                    $prenewspspassword = "new_password_" . $i;
                    $mode= "sps_mode_".$i;
                    $newMode="new_sps_mode_".$i;
                    if(request()->$newspscall!=NULL) {
                        if (request()->$newspsscore != NULL) {

                            if (request()->$prenewspspassword != NULL) {
                              //  dd(request()->$mode);
                                //$chekcall
                                $chek=DB::select('select id from SPS where `tokenparentuser` = ? AND `tokenparrentprogram`=? AND `call`=? AND `mode`=?', [$tokenParrentUser,request()->Token,request()->$newspscall,request()->$newMode]);

                                if($chek==NULL) {
                                    //dd($chek);
                                    $newspspassword = md5(request()->$prenewspspassword);
                                    $description = "Додан при редагувані";
                                    $pretokensps = request()->Token . $tokenParrentUser . $newspscall;
                                    $tokensps = md5($pretokensps);
                                    $call = strtoupper(request()->$newspscall);

                                    DB::insert('insert into SPS (`call`,`token`,`tokenparentuser`,`tokenparrentprogram`,`score`,`password`,`description`,`mode`)
                                   values (?,?,?,?,?,?,?,?)', [$call, $tokensps, $tokenParrentUser, request()->Token, request()->$newspsscore, $newspspassword, $description,request()->$newMode]);
                                } else { $resultInfo[] = request()->$newspscall . " вже включено до цієї программи"; }
                            } else { $resultInfo[] = request()->$newspscall . " відсутній пароль";}
                        } else { $resultInfo[] = request()->$newspscall . " відсутня кількість балів";}
                    }
                }

            }
        }
        $flag[]=$tokenprogramm;
        $filenameArray=DB::select('SELECT `image` FROM PROGRAMM WHERE token = ? AND tokenparrentuser = ?',[request()->Token,$tokenParrentUser]);
        $filename=$filenameArray[0]->image;
        $flag[]=$filename;
        //dd($dataArray);
        return $flag;
    }
    public function getLog($request)
    {
        if(isset($request->parrentuser)) {
            $tokenParrentUser=$request->parrentuser;
        }   else {
        $tokenParrentUser=md5(auth()->user()->email);}
        $token = $request->t;
       //dd($tokenParrentUser);
        // echo  $tokenParrentUser." ".$token;
        $dataArray=DB::table('QSO')->where('tokenprogramm', '=', $token)
            ->where('tokentuser','=', $tokenParrentUser)->paginate(100);
        //dd($dataArray);
            //DB::select('select * from QSO where tokenprogramm = ? AND tokentuser=?', [$token, $tokenParrentUser]);

       // dd($dataArray);
        return $dataArray;
    }
    public function closeProgramm($request)
    {
        $tokenprogram=$request->t;
        $tokenUser=md5(auth()->user()->email);
        $mytime = Carbon\Carbon::now();
        $date=$mytime->toDateTimeString();
        $closeProgram=DB::select('UPDATE `PROGRAMM` SET `status`= ?, `finish_at`=? WHERE `token` = ? AND `tokenparrentuser` = ?',
            ['close',$date, $tokenprogram, $tokenUser]);

        return $closeProgram;
    }
    public function openProgramm($request)
    {
        $tokenprogram=$request->t;
        $mytime = Carbon\Carbon::now();
        $date=$mytime->toDateTimeString();
        //dd($date);
        $tokenUser=md5(auth()->user()->email);
        $openProgram=DB::select('UPDATE `PROGRAMM` SET `status`= ?, `start_at`=?,`finish_at`=? WHERE `token` = ? AND `tokenparrentuser` = ?',
            ['open',$date, NULL, $tokenprogram, $tokenUser]);
        return  $openProgram;

    }
    public function deleteProgramm($request)
    {
        $tokenprogram=$request->t;
        $tokenUser=md5(auth()->user()->email);
        $imagePath = DB::select('SELECT `image` FROM PROGRAMM WHERE`token`=? AND `tokenparrentuser`=?',[$tokenprogram,$tokenUser]);

        $imagePathDelete="";
        for($i=0; $i<strlen($imagePath[0]->image);$i++)
        {
            if ($imagePath[0]->image[$i]=="\\"){
                $imagePath[0]->image[$i]="/";
            }
            if($i!=0)
             $imagePathDelete=$imagePathDelete.$imagePath[0]->image[$i];
        }
        //dd($imagePathDelete);
        if($imagePathDelete!="ONE")
        unlink(public_path($imagePathDelete));

        $deleteProgram=DB::delete('delete from PROGRAMM where `token`=? AND `tokenparrentuser`=?',[$tokenprogram,$tokenUser]);
        DB::delete('delete from SPS where `tokenparrentprogram`=? AND `tokenparentuser`=?',[$tokenprogram,$tokenUser]);
        DB::delete('delete from QSO where `tokenprogramm`=? AND `tokentuser`=?',[$tokenprogram,$tokenUser]);


        return  $deleteProgram;

    }
    public function getStatusProgramm($request)
    {
        $tokenprogram=$request->t;
        $tokenParrentUser=md5(auth()->user()->email);
        $arrayProgramm=DB::select('select `status` from PROGRAMM where token = ? AND tokenparrentuser=?', [$tokenprogram, $tokenParrentUser]);
        foreach($arrayProgramm as $statusRecord)
        {
            $statusProgramm=$statusRecord->status;
        }
        return  $statusProgramm;

    }
    public function getNameProgramm($request)
    {
        $tokenprogram=$request->t;
        $tokenParrentUser=md5(auth()->user()->email);
        $arrayProgramm=DB::select('select `name` from PROGRAMM where token = ? AND tokenparrentuser=?', [$tokenprogram, $tokenParrentUser]);
        foreach($arrayProgramm as $name)
        {
            $nameProgramm=$name->name;
        }
        return  $nameProgramm;

    }
    public function createNewProgramm(Request $request)
    {

        // получаем и сохраняем картинку диплома
       /* if ($request->request->has('form[dynamic_field]')) {
            $builder->add('dynamic_field', TextType::class, []);
            //dd($builder);
        }
*/
       //dd($request->hasFile('Image'));
        if($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $new_name=md5($name=request()->Name).$file->getClientOriginalName();
            $file->move(public_path() . '/image',$new_name);
            $filename= '\image\\'.$new_name;
        } else $filename='NONE';

        //request()->Image;
        $tokenParrentUser=md5(auth()->user()->email);
        $emailManager=request()->emailManager;
        $name=request()->Name;
        $pretoken=auth()->user()->email.$name;
        $tokenprogramm=md5($pretoken);
        $repeat=request()->Repeat;
        $scoreDefault=request()->ScoreDefault;
        $scoreFinal=request()->ScoreFinal;
        $description=request()->Description;
        $status='new';
        $method=request()->methodReciev;

        $counter=request()->index_sps;
        $programmVerify=DB::select('select `id` from PROGRAMM where `name` = ? AND tokenparrentuser=?', [$name, $tokenParrentUser]);

        if($programmVerify==NULL)
        {
            $start_for_page = date("Y-m-d H:i:s", strtotime(request()->startProgramm));
            $finish_for_page = date("Y-m-d H:i:s", strtotime(request()->finishProgramm));
            //$str_finish=strtotime(request()->finishProgramm);
           // dump($start_for_page);
            //dd($finish_for_page);
        DB::insert('insert into PROGRAMM (`email_manager`,`name`,`token`,`tokenparrentuser`,`repeat`,`scoreDefault`,`scoreFinal`,`description`,`status`,`image`,`start_for_page`,`finish_for_page`,`method_recieve`)
                                    values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$emailManager,$name,$tokenprogramm,$tokenParrentUser,$repeat,$scoreDefault,$scoreFinal,$description, $status,  $filename,$start_for_page,$finish_for_page,$method]);

        $index_sps=request()->index_sps;
        for($i=1; $i<=$index_sps; $i++)
        {
            $call = "sps_call_".$i;
          //  dd(request()->$call);
            $pretokensps=$tokenprogramm.$tokenParrentUser.$call;
            $tokensps=md5($pretokensps);
            $score= "sps_score_".$i;
            $preprepasswordsps="password_".$i;
            $prepasswordsps=request()->$preprepasswordsps;
            $password_sps=md5($prepasswordsps);
            $description="description";
            $premode="new_sps_mode_".$i;
            $mode=request()->$premode;
            //dd($mode);
            DB::insert('insert into SPS (`call`,`token`,`tokenparentuser`,`tokenparrentprogram`,`score`,`password`,`description`, `mode`)
                                   values (?,?,?,?,?,?,?,?)', [request()->$call,$tokensps,$tokenParrentUser,$tokenprogramm,request()->$score,$password_sps,$description,$mode]);
        }

        $flag[]=$tokenprogramm;
        $flag[]=$filename;

        } else
        {
            echo "Программа с таким именем уже есть";
            $flag="NO";

        }
        return  $flag;

    }
    public function scoreDefinition($operator, $mode, $tokenprogramm)
    {
        $spscall=DB::select('select `score` from SPS where `call`=? AND `tokenparrentprogram`=? AND `mode`=?',[$operator, $tokenprogramm,$mode]);
        if ($spscall!=NULL)
        {

            foreach($spscall as $scores) {
                $score = $scores->score;

            }
        }
        else {
            $scoredefault=DB::select('select `scoreDefault` from PROGRAMM where `token`=?',[$tokenprogramm]);



            foreach ($scoredefault as $defaultScore)
            $score=$defaultScore->scoreDefault;



        }
        return $score;
    }
    public function getProgrammInfo ($tokenprogramm)
    {
        $totalinfo=DB::select('select * from PROGRAMM where `token`=?',[$tokenprogramm]);

        return $totalinfo;
    }
    public function setComplitedForCall($token, $call)
    {
        DB::select('UPDATE `QSO` SET `status`= ? WHERE `call` = ? AND `tokenprogramm` = ?',
            ['Completed', $call, $token]);


    }
    public function loginsps(Request $request)
    {
        if(isset($request->spscall))
        {
            if(isset($request->spspass)) {
                $authSps = new DBwork;

                $pass = md5($request->spspass);
                $getArrayRecords = $authSps->authSPS($request->spscall, $pass);
                //dd($getArrayRecords);
                if ($getArrayRecords != NULL) {
                    //$pass = md5($request->spspass);
                    Cookie::queue('spskey', $pass, 10);
                   // Cookie::queue('spsparrent',$getArrayRecords[0]->tokenparentuser,10);
                    Cookie::queue('spscall', $request->spscall, 10);
                    //dd($getArrayRecords);
                    if (count($getArrayRecords) > 1) {

                        $programmName = Array();
                        foreach ($getArrayRecords as $programms) {
                            $programmName[] = DB::select('SELECT `name`,`token` FROM PROGRAMM WHERE token=?', [$programms->tokenparrentprogram]);
                        }

                        return view('thewall2.selectprogramm', ['programmNameArray' => $programmName]);

                    } else  // если всего одна программа у СПС
                        {
                            $tokenProgramm=$getArrayRecords[0]->tokenparrentprogram;
                            //dd($tokenProgramm);
                            $parrentUserArray = DB::select('SELECT `tokenparrentuser` FROM PROGRAMM WHERE `token`=?',[$tokenProgramm]);
                            $parrentUser=$parrentUserArray[0]->tokenparrentuser;
                            //dd($parrentUser);
                            Cookie::queue('spsparrent',$parrentUser,10);


                        $resolvForm=DB::select('select `status`,`name` from PROGRAMM where token = ?', [$getArrayRecords[0]->tokenparrentprogram]);
                        return view("thewall2/logforsps",["Token"=>$getArrayRecords[0]->tokenparrentprogram, "resolvForm"=>$resolvForm[0]->status, "NameProgramm"=>$resolvForm[0]->name]); }
                } else {
                    $message = "<b>Помилка!</b><br>Не вдалося аутентифікувати.<br>Спробуйте ще :)";
                    $data[] = ["message" => $message];
                    return view('thewall2/alert', ["status" => "warn", "data" => $data]);
                }
            } else {
                $message = "<b>Помилка!</b><br>Ви не ввели пароль СПС.<br>Спробуйте ще :)";
                $data[] = ["message" => $message];
                return view('thewall2/alert', ["status" => "warn", "data" => $data]);}
        } else {
            $message = "<b>Помилка!</b><br>Ви не ввели позивний СПС.<br>Спробуйте ще :)";
            $data[] = ["message" => $message];
            return view('thewall2/alert', ["status" => "warn", "data" => $data]);
        }
        //echo "HEllo";
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

    public function loadadiff(Request $request)
    {
        //dd($request);
        $login= new uploadadifController;
        $getspsInfo=$login->chekLoginSps();
        //dd($getspsInfo);
        if($getspsInfo!=NULL)
        {
           $tokenProgramm=$request->programm;
            $parrentUserArray = DB::select('SELECT `tokenparrentuser` FROM PROGRAMM WHERE `token`=?',[$tokenProgramm]);
            $parrentUser=$parrentUserArray[0]->tokenparrentuser;
            //dd($parrentUser);
            Cookie::queue('spsparrent',$parrentUser,10);
            //dd($parrentUser);
            //$recordArray=$record->getLog($request);
            $resolvForm=DB::select('select `status`,`name` from PROGRAMM where token = ?', [$tokenProgramm]);

            //dd($resolvForm[0]->name);
            return view("thewall2/logforsps",["Token"=>$tokenProgramm, "resolvForm"=>$resolvForm[0]->status, "NameProgramm"=>$resolvForm[0]->name]);
        //echo $request->programm;
        }
    }
    public function getArchiveProgramm(Request $request)
    {
        if (isset($request->sortby)AND $request->sortby=="FWD") {
            $reverse = "FWD";
        }
        else $reverse="REV";

        $archiveProgrammArray= new DBwork;
        $archiveProgramms = $archiveProgrammArray->getArchiveProgramm('5', 'id', $reverse);
        foreach ($archiveProgramms as $token) {
            $spsForProgram = $archiveProgrammArray->getSpsForProgram($token->token);

            $token->sps = $spsForProgram;
        }
        return view('thewall2/achiveProgramm',["Programms"=>$archiveProgramms]);

    }
    public function savecordinate($XCall,$YCall,$XName,$YName,$XNum,$YNum,$color,$tokenprogramm)
    {
        $tokenUser=md5(auth()->user()->email);
        $result=DB::select('UPDATE `PROGRAMM` SET `cordinatex`= ?, `cordinatey`=?,`XName`=?, `YName`=?,`XNum`=?,`YNum`=?,`color`=? 
                                  WHERE `token` = ? AND `tokenparrentuser` = ?',
            [$XCall,$YCall,$XName,$YName,$XNum,$YNum,$color,$tokenprogramm, $tokenUser]);
        return $result;

    }

}
