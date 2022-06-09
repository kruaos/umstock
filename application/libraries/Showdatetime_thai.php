<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Showdatetime_thai {

    public function show_day($create_date)
    {
  	$showmont = array('0','ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
    return number_format(substr($create_date, 8, 2)) . " " .$showmont[number_format(substr($create_date,5, 2))]. " " .(substr($create_date, 2, 2) + 43);
    }

    public function show_fullday($create_date)
    {
    $showmont = array('0','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
    return number_format(substr($create_date, 8, 2)) . " " .$showmont[number_format(substr($create_date,5, 2))]. " " .(substr($create_date, 0, 4) + 543);
    }
}

?>