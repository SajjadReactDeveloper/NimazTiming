<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class prayerController extends Controller
{
    //
    public function index(){
        $day = date("d");
        $month = date("m");
        $year = date("y");
        $hour = date("H", time());
        $minute = date("i", time());
        $second = date("s", time());
        $time = date("H:i:s", time());
        $prayers = DB::table('prayer')->where('date', '=', $day )->where('month', '=', $month)->first();

        // Current Time
        $current = Carbon::now();

        // Fajr
        $fajr = $prayers->fajr;
        $fajrArray = explode(":", $fajr);
        $fajrHour = $fajrArray[0];
        $fajrMinute = $fajrArray[1];

        // Duhr
        $duhr = $prayers->dhuhr;
        $duhrArray = explode(":", $duhr);
        $duhrHour = $duhrArray[0];
        $duhrMinute = $duhrArray[1];

        // Asr
        $asr = $prayers->asr;
        $asrArray = explode(":", $asr);
        $asrHour = $asrArray[0];
        $asrMinute = $asrArray[1];

        // Maghrib
        $maghrib = $prayers->maghrib;
        $maghribArray = explode(":", $maghrib);
        $maghribHour = $maghribArray[0];
        $maghribMinute = $maghribArray[1];

        // Isha
        $isha = $prayers->isha;
        $ishaArray = explode(":", $isha);
        $ishaHour = $ishaArray[0] + 12;
        $ishaMinute = $ishaArray[1];

        // Boolean Variables
        $fajrBool = false;
        $duhrBool = false;
        $asrBool = false;
        $maghribBool = false;
        $ishaBool = false;

        if($current->hour < $fajrHour){
            $fajrBool = true;
            $duhrBool = false;
            $asrBool = false;
            $maghribBool = false;
            $ishaBool = false;
        }

        else if ($current->hour < $duhrHour && $current->hour > $fajrHour) {
            $duhrBool = true;
            $fajrBool = false;
            $asrBool = false;
            $maghribBool = false;
            $ishaBool = false;
        }

        else if ($current->hour < $asrHour && $current->hour > $duhrHour) {
            $asrBool = true;
            $fajrBool = false;
            $duhrBool = false;
            $maghribBool = false;
            $ishaBool = false;
        }

        else if ($current->hour < $maghribHour && $current->hour > $asrHour) {
            $maghribBool = true;
            $fajrBool = false;
            $duhrBool = false;
            $asrBool = false;
            $ishaBool = false;
        }

        else if ($current->hour < $ishaHour && $current->hour > $maghribHour) {
            $ishaBool = true;
            $fajrBool = false;
            $duhrBool = false;
            $asrBool = false;
            $maghribBool = false;
        }

        else {
            $ishaBool = true;
            $fajrBool = false;
            $duhrBool = false;
            $asrBool = false;
            $maghribBool = false;
        }

        // Check Boolean
        if($fajrBool == true && $duhrBool == false && $asrBool == false && $maghribBool == false && $ishaBool == false ) {
            $target = $current->setTime($fajrHour, $fajrMinute, 0);
        }

        else if ($duhrBool == true && $fajrBool == false && $asrBool == false && $maghribBool == false && $ishaBool == false) {
            $target = $current->setTime($duhrBool, $duhrMinute, 0);
        }

        else if ($asrBool == true && $fajrBool == false && $duhrBool == false && $maghribBool == false && $ishaBool == false ) {
            $target = $current->setTime($asrHour, $asrMinute, 0);
        }

        else if ($maghribBool == true && $fajrBool == false && $duhrBool == false && $asrBool == false && $ishaBool == false ) {
            $target = $current->setTime($maghribHour, $maghribMinute, 0);
        }

        else if ($ishaBool == true && $fajrBool == false && $duhrBool == false && $asrBool == false && $maghribBool == false ) {
            $target = $current->setTime($ishaHour, $ishaMinute, 0);
        }

        $split = explode(" ", $target);
        $target = $split[1];
        $targetSplit = explode(":", $target);
        $targetHour = $targetSplit[0];
        $targetMinute = $targetSplit[1];
        $targetSecond = $targetSplit[2];



        $time1 = Carbon::createFromFormat('H:i:s', $time);
        $time2 = Carbon::createFromFormat('H:i:s', $target);

        $diffInSeconds = $time1->diffInSeconds($time2);
        $diffInMinutes = $time1->diffInMinutes($time2);
        $diffInHours = $time1->diffInHours($time2);

        return view('Home', ['prayers' => $prayers, 'hour' => $targetHour, 'min' => $targetMinute, 'sec' => $targetSecond, 'day' => $day, 'fajr' => $fajrBool, 'duhr' => $duhrBool, 'asr' => $asrBool, 'maghrib' => $maghribBool, 'isha' => $ishaBool]);
    }
}
