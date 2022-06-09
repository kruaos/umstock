<?
function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$y=substr($x,0,4);
	$m=substr($x,5,2)-1;
	$d=substr($x,8,2);
	$t=substr($x,10,18);

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y $t";
	return $displaydate;
} // end function displaydate

?>