<?php
class Moon2_DateTime_Time{

public static function addInput($name, $mode, $default){
    $hour = "";
    $min = "";
    $meridian = "";
    $hourName = $name."_hour";
    $minName = $name."_min";
    $merName = $name."_mer";

    if (!empty($default)){
        $time = explode(":", $default);
        $hour = $time[0];
        $min = $time[1];
    }

    switch ($mode){
        case "12":
            $start = 1;
            $end = 12;
            $checkedAM = "";
            $checkedPM = "";
            if ($hour>=0 && $hour < 12){
                    $checkedAM = " checked='checked'";
					$hour = self::fillZero($hour,2);
					if ($hour == 0) $hour = "12";
            }else{
				$checkedPM = " checked='checked'";				
				if ($hour != 12) $hour = $hour - 12;
            }
            $meridian = "&nbsp;<input type=\"radio\" name=\"".$merName."\" id=\"".$merName."\" value=\"AM\"{$checkedAM} />AM";
            $meridian.= "&nbsp;&nbsp;<input type=\"radio\" name=\"".$merName."\" id=\"".$merName."\" value=\"PM\"{$checkedPM} />PM\n";
        break;
        default:
            $start = 0;
            $end = 23;
        break;
    }
	$hour = self::fillZero($hour,2);
    $arr = self::get_numbers($start, $end, 1);
    $xhtml = self::buildInput($hourName, $arr, $hour);
    $xhtml.= "&nbsp;";
    $min = self::fillZero($min,2);
    $arr = self::get_numbers(0, 59, 15);
    $xhtml.= self::buildInput($minName, $arr, $min);
    $xhtml.= $meridian;
    return $xhtml;
}

public static function unformat($hour, $min, $mer){
	$str_hour = "";
	if ($mer=="AM" && $hour == "12") $hour = "00";
	if ($mer=="PM"){
		$hour = $hour + 12;
	}
	$str_hour = $hour.":".$min.":00";
	return $str_hour;
}

public static function format($data, $mode){
    $time = explode(":", $data);
    $hour = intval($time[0]);
    $min = intval($time[1]);
    switch ($mode){
        case "12":
            $meridian = "PM";
            if ($hour>=0 && $hour < 12){
				$meridian = "AM";
				if ($hour == 0) $hour = 12;
            }else{
                if ($hour != 12) $hour = $hour - 12;
            }
            $hour = self::fillZero($hour,2);
            $min = self::fillZero($min,2);
            $formatting = $hour.":".$min." ".$meridian;
        break;
        default:
            $hour = self::fillZero($hour,2);
            $min = self::fillZero($min,2);
            $formatting = $hour.":".$min;
        break;
    }
    return $formatting;
}

private static function buildInput($name, $arrData, $selected){
    $xhtml = "<select name=\"".$name."\" id=\"".$name."\">\n";
    foreach ($arrData as $key => $value){
        $sel = "";
        if ($selected == $value){
                $sel = " selected='selected'";
        }
		$key = self::fillZero($key,2);
        $xhtml.= "<option value=\"".$key."\"{$sel}>".$value."</option>\n";
    }
    $xhtml.= "</select>";
return $xhtml;
}

private static function fillZero($value, $limit){
  $filled = "";
  $size = strlen($value);
  $sizeFilled = $limit - $size;

  for ($i=0; $i<$sizeFilled; $i++){
    $filled = $filled."0";
  }
  $value = $filled.$value;
  return $value;
}

private static function get_numbers($begin, $end, $step){
    $arr = array();
    for ($i=$begin; $i<=$end; $i=$i+$step){
            $arr[$i] = self::fillZero($i,2);
    }
    return $arr;
}

}//End class
?>