<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$sess_memberid=$this->session->userdata('userid');
$fullname=$this->session->userdata('fullname');
$getordernum=$this->cache->get('ordernum');
echo $getordernum;
?>

  </div>
  </div>
 </div>
   </div>
  </div>
 </div>