<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


if(!function_exists('humanFilesize')){
    function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
    
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        
        return round($size, $precision).$units[$i];
    }
}

if(!function_exists('formatTimeStamp')){
    function formatTimeStamp($timestamp, $format) {
      return date($format,$timestamp);
    }
}

if(!function_exists('ageFrom')){
    function ageFrom($timestamp) {
      $init = new DateTime(date('Y-m-d H:i:s',$timestamp));
        return $init->diff(new DateTime());
    }
}

if(!function_exists('formatNum')){
    function formatNum($num) {
        if($num > 1000){
            $abbr = round($num/1000,2).'k';
        }
        return "<span data-toggle='tooltip' title='&#8358; ".number_format($num)."'>&#8358; ".(isset($abbr) ? $abbr : $num)."</span>";
    }
}