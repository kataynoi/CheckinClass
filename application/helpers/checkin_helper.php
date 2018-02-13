<?php
if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
        echo $json;
    }

}
/**
* Get current date
*
* @return   string  
**/
if ( ! function_exists('get_current_thai_date'))
{
    function get_current_thai_date()
    {
        $d = explode('/', date('d/m/Y'));
        $day = $d[0];
        $month = $d[1];
        $year = (int) $d[2] + 543;

        $current_thai_date = $day . '/' . $month . '/' . $year;

        return $current_thai_date;

    }

}

if ( ! function_exists('version'))
{
    function version()
    {
        $version=' ระบบเช็คชื่อเข้าเรียน beta';

        return $version;

    }

}

if(!function_exists('to_thai_date'))
{
    function to_thai_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('to_thai_month'))
{
    function to_thai_month($eng_date)
    {
        if(strlen($eng_date) != 7)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];

            $thai_date =  $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_date_time'))
{
    function to_thai_date_time($eng_date_time)
    {
        if(strlen($eng_date_time) == 0)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date_time);
            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = substr($new_date[2],0,2);
            $new_time=substr($new_date[2],3,5);
            $thai_date = $new_d . '/' . $new_m . '/' . $new_y.' '.$new_time;

            return $thai_date;
        }
    }
}
if(!function_exists('to_mysql_date'))
{
    function to_mysql_date($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . '-' . $new_m . '-' . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('to_mysql_date_without'))
{
    function to_mysql_date_without($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . $new_m . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('to_mysql_date_dash'))
{
    function to_mysql_date_dash($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y ."-". $new_m ."-". $new_d;

            return $mysql_date;
        }
    }
}


if(!function_exists('to_string_date'))
{
    function to_string_date($date)
    {
        if(empty($date))
        {
            return null;
        }
        else
        {
            $d = explode('/', $date);
            // $d[0] = d, $d[1] = m, $d[2] = y
            $new_date = (int)$d[2] - 543 . $d[1] . $d[0];
            return $new_date;
        }
    }
}

if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('get_checkin_status'))
{
    function get_checkin_status($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ขาดเรียน';
            else if($id == '2') return 'มาเรียน';
            else if($id == '3') return 'มาสาย';
            else if($id == '4') return 'ลา';
            else return 'ไม่ชัดเจน';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('DateTimeDiff'))
{

    function DateTimeDiff($strDateTime1, $strDateTime2) {
        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
        }
        return $second;
    }
}

if(!function_exists('DateFormatDiff'))
{

    function DateFormatDiff($second) {
/*        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
            echo "เหลือเวลา : ";
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
            echo "ผ่านมาแล้ว : ";
        }*/
        $re=array();
        	/*if($second>60){
        		$re[]=($second%60)." วินาที ";}*/
        if ($second >= 60) {
            $re [] = (floor ( $second / 60 ) % 60) . " นาที ";
        }
        if ($second >= 3600) {
            $re [] = (floor ( $second / 3600 ) % 24) . " ชั่วโมง ";
        }
        if ($second >= 86400) {
            $re [] = (floor ( $second / 86400 ) % 30.5) . " วัน ";
        }
        if ($second >= 2592000) {
            $re [] = (floor ( $second / 2592000 ) % 12) . " เดือน ";
        }
        if ($second >= 31536000) {
            $re [] = floor ( $second / 31536000 ) . " ปี ";
        }
        $text='';
        for($i = sizeof ( $re ); $i > 0; $i --) {
            $text.= $re [$i - 1];
        }
        return $text;
    }
}

/* End of file epidem_helper.php */
/* Location: ./application/helpers/epidem_helper.php */