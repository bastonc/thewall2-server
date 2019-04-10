<?php
namespace Ukrainediploms\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Regex;

class DBwork
{
    public function RecordQSOtoBase($arrayData, $tokenprogramm,$keysps)
    { //dd($arrayData);

        $errors = [];
        $tokenuser = $keysps;
        $repeatArray = DB::select('select `repeat` from PROGRAMM where token = ? ', [$tokenprogramm]);
        $repeat = $repeatArray[0];

        for ($index = 0; $index < count($arrayData); $index++) {   //echo count($arrayRecord);
            $record = $arrayData[$index];
            $status = "N";

            if ($repeat->repeat == "1") {
                $qsoArray = DB::select('select `id` from QSO where  `call` = ? AND `band` = ? AND `tokenprogramm`=? AND `operator`=? AND `mode`=?',
                    [$record['call'], $record['band'], $tokenprogramm, $record['operator'], $record['mode']]);

                if ($qsoArray == NULL) {
                    //$validate=$record['call'];
                    //$convertedText = mb_convert_encoding($record, 'utf-8', mb_detect_encoding($record));
                    $validator = Validator::make($record, ['call' => 'regex:"[a-zA-Z0-9\//]{3,}"']);
                    //alpha_num| 'call'=>'alpha_num'    regex:"\/[а-я0-9]"
                    if ($validator->fails()) {

                        $errors[] = $record['call'] . "<br>";

                        //dd($validator);
                        continue;
                    }
                    $call_in_utf8 = mb_convert_encoding($record['call'], 'utf-8', mb_detect_encoding($record['call']));
                    //dd($record['mode']);
                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                        [$status, $call_in_utf8, $record['operator'], $record['qso_date'],
                            $record['time_on'], $record['band'], $record['freq'],
                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);


                }
            }
            if ($repeat->repeat == "0") {

                $qsoArray = DB::select('select `id` from QSO where  `call` = ? AND `tokenprogramm`=? AND `operator`=?', [
                    $record['call'], $tokenprogramm, $record['operator']]);


                if ($qsoArray == NULL) {
                    $validator = Validator::make($record, ['call' => 'regex:"[a-zA-Z0-9\//]{3,}"']);
                    if ($validator->fails()) {
                        //dd($validator);
                        $errors[] = $record['call'] . "<br>";
                        //dd($errors);
                        continue;
                    }
                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                            $record['time_on'], $record['band'], $record['freq'],
                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);
                }


            }
            if ($repeat->repeat == "2") {
                //       $qsoArray = DB::select('select `id` from QSO where  `call` = ? AND `band` = ? AND `tokenprogramm`=?', [$record['call'], $record['band'], $tokenprogramm]);
                // if ($qsoArray == NULL) {
                $validator = Validator::make($record, ['call' => 'regex:"[a-zA-Z0-9\//]{3,}"']);
                if ($validator->fails()) {
                    //dd($record['call']);
                    $errors[] = $record['call'] . "<br>";
                    //dd($errors);
                    continue;
                }
                $qsoArray = DB::select('select `id` from QSO where `call`=? AND `operator`=? AND `tokenprogramm`=? AND `qso_date`=? AND `time_on`=?', [$record['call'], $record['operator'], $tokenprogramm, $record['qso_date'], $record['time_on']]);

                if ($qsoArray == NULL) {
                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                            $record['time_on'], $record['band'], $record['freq'],
                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);
                }
            }
            if ($repeat->repeat == "3") { // різні діапазони та ризні моди
                //       $qsoArray = DB::select('select `id` from QSO where  `call` = ? AND `band` = ? AND `tokenprogramm`=?', [$record['call'], $record['band'], $tokenprogramm]);
                // if ($qsoArray == NULL) {
                $validator = Validator::make($record, ['call' => 'regex:"[a-zA-Z0-9\//]{3,}"']);
                if ($validator->fails()) {
                    //dd($record['call']);
                    $errors[] = $record['call'] . "<br>";
                    //dd($errors);
                    continue;
                }
                /* наступне правило повинно бути задано в инверсійному значенні | тут задаеться перевирка якщо є зв'язок  на тому ж діапазоні та тією ж
                        модою - QSO відметаємо*/
                $chekMode = DB::select('select * from QSO where `call`=? AND `operator`=?  AND `tokenprogramm`=?',
                    [$record['call'], $record['operator'], $tokenprogramm]);
                if ($chekMode != NULL) {
                    //dd($chekMode[0]->band);
                  foreach($chekMode as $qso){
                      if($qso->band!=$record['band']){
                          if($qso->mode!=$record['mode']){
                              DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                                  [$status, $record['call'], $record['operator'], $record['qso_date'],
                                      $record['time_on'], $record['band'], $record['freq'],
                                      $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);

                          }
                      }
                  }

                }
                if ($chekMode == NULL) {
                   // dd($chekMode);

                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                            $record['time_on'], $record['band'], $record['freq'],
                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);
                }
            }

            if ($repeat->repeat == "4") { // різні діапазони. ризні моди та різні дати
                //       $qsoArray = DB::select('select `id` from QSO where  `call` = ? AND `band` = ? AND `tokenprogramm`=?', [$record['call'], $record['band'], $tokenprogramm]);
                // if ($qsoArray == NULL) {
                $validator = Validator::make($record, ['call' => 'regex:"[a-zA-Z0-9\//]{3,}"']);
                if ($validator->fails()) {
                    //dd($record['call']);
                    $errors[] = $record['call'] . "<br>";
                    //dd($errors);
                    continue;
                }
                /* наступне правило повинно бути задано в инверсійному значенні | тут задаеться перевирка якщо є зв'язок  на тому ж діапазоні та тією ж
                        модою - QSO відметаємо*/
                $chekMode = DB::select('select * from QSO where `call`=? AND `operator`=? AND `qso_date`=? AND `tokenprogramm`=?',
                    [$record['call'], $record['operator'], $record['qso_date'], $tokenprogramm]);

                if ($chekMode != NULL) {
                   // dd($chekMode);
                    foreach($chekMode as $qso){
                        //dd($qso->band);
                            if($qso->band!=$record['band']) {
                                if ($qso->mode != $record['mode']) {
                                    if ($qso->qso_date!= $record['qso_date']){
                                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                                            $record['time_on'], $record['band'], $record['freq'],
                                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);

                                     }
                                }
                            }
                    }





                } elseif ($chekMode==NULL){
                    $chekOperator = DB::select('select * from QSO where `call`=? AND `operator`=? AND  `tokenprogramm`=?',
                        [$record['call'], $record['operator'], $tokenprogramm]);
                    foreach($chekOperator as $qso){
                        dd($qso->band);
                        if($qso->band!=$record['band']) {
                            if ($qso->mode != $record['mode']) {
                                if ($qso->qso_date!= $record['qso_date']){
                                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                                            $record['time_on'], $record['band'], $record['freq'],
                                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);

                                }
                            }
                        }
                    }

                }

                /*if ($chekMode == NULL) {
                    // dd($chekMode);

                    DB::insert('insert into QSO (`status`,`call`,`operator`,`qso_date`,`time_on`,`band`,`freq`,`rst_sent`,`mode`,`tokenprogramm`, 
                                                         `tokentuser`,`programname`) values (?,?,?,?,?,?,?,?,?,?,?,?)',
                        [$status, $record['call'], $record['operator'], $record['qso_date'],
                            $record['time_on'], $record['band'], $record['freq'],
                            $record['rst_sent'], $record['mode'], $tokenprogramm, $tokenuser, 'N']);
                }*/
            }
    }
       //$flag = 'ОК';

        //dd($errors);

        return $errors;
    }

    public function getProgrammFrontEnd($paginate, $sortBy, $reverse) //$paginate - how page in paginate,
                                                                    //$SortBy - column name for sortBy
                                                                    //  $reverse - REV|FWD - rev - reverse sort; fwd - forward sort

    {
        if ($reverse=="REV") {
            $programms = DB::table('PROGRAMM')->orderBy($sortBy, 'desc')->where('status', '=', 'open')->paginate($paginate);
        }
        elseif($reverse=="FWD") {
            $programms = DB::table('PROGRAMM')->orderBy($sortBy)->where('status', '=', 'open')->paginate($paginate);
        }
        //dd($programms);
        return $programms;
    }

    public function getProgrammInfo($tokenprogramm)
    {
        $programmInfo=DB::select('select * from PROGRAMM where  `token`=?', [$tokenprogramm]);
        return $programmInfo;
    }

    public function searchCall($call, $tokenprogramm)
    {
        $calls=DB::select('select * from QSO where `call`=? AND `tokenprogramm`=?',[$call,$tokenprogramm]);
        return $calls;
    }

    public function getSpsForProgram($tokenprogramm)
    {
        $spsInfo=DB::select('select `call`,`score`,`mode` from SPS where  `tokenparrentprogram`=?', [$tokenprogramm]);
        return $spsInfo;
    }

    public function authSPS($spscall, $spspass)
    {

        $result=DB::select('SELECT DISTINCT `tokenparrentprogram`,`tokenparentuser` FROM SPS WHERE `call` = ? AND `password` = ?',
            [$spscall, $spspass]);

        return $result;
    }

    public function UserSearch($searchString, $tableName, $colSearch, $keyCol, $StrongReq)
    {
        $SearchString= trim($searchString);
        //dd($searchString);
        if($StrongReq=="NoStrong")
        {
            $request="%".$SearchString."%";
            $SearchQeuest = "SELECT ". $keyCol." FROM ".$tableName." WHERE `".$colSearch."` LIKE '".$request."'";
            $SearchArray=DB::select($SearchQeuest);
        }
        if($StrongReq=="Strong")
        {
            $request=$SearchString;
           $SearchQeuest = "SELECT ".$keyCol." FROM ".$tableName." WHERE `".$colSearch."`= '".$request."'";

            $SearchArray=DB::select($SearchQeuest);
        }
        if($StrongReq!="NoStrong" and $StrongReq!="Strong")
        {
            echo "Error! value 'StrongReq'. Use only Strong|NoStrong";
        }


        return $SearchArray;
        //dd($SearchArray);

     // SELECT name FROM PROGRAMM WHERE name=?


    }
    public function getArchiveProgramm($paginate, $sortBy, $reverse)

    {
        if ($reverse=="REV") {
            $arrayData = DB::table('PROGRAMM')->orderBy($sortBy, 'desc')->where('status', '=', 'close')->paginate($paginate);
        } elseif($reverse=="FWD") {
            $arrayData = DB::table('PROGRAMM')->orderBy($sortBy,'asc')->where('status', '=', 'close')->paginate($paginate);
        }
        //dd( $arrayData);
        return $arrayData;
    }
    public function getComplitedCall($token)
    {
        $complitedCallsArray=DB::select('SELECT DISTINCT `call` FROM QSO WHERE `status` = "completed" AND `tokenprogramm` = ?',
            [$token]);
        return $complitedCallsArray;
    }

}
//echo $res['call']." | Date:".$res['qso_date']." | Time: ". $res['time_on']." | Freq: ".$res['band']." | сработал с ". $res['operator']." | RST ". $res['rst_sent']."<br>";
