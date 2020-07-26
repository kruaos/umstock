<?php
class login_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

 	public function loginchk()
  {
      $user_login=$this->input->post('user_login');
      $pass_login=$this->input->post('pass_login');


      $sql="select tb_member.* , tb_customer.fullname from tb_member,tb_customer where tb_member.name=tb_customer.cusid and username='$user_login'";
      $loginchk=$this->db->query($sql);
      if($loginchk->num_rows()==0)
      {
        echo "ERROR001 : ชื่อผู้ใช้ไม่ถูกต้อง <br>";
        header( 'refresh: 3; url='.site_url('') );
      }else{
        foreach ($loginchk->result() as $rs) {
          $password=$rs->password;
          if ( $pass_login==$password){

            $log_customer_id=$rs->name;
            $log_use_menu=$this->uri->segment(1)."/".$this->uri->segment(2);
            $log_timestamp=date("Y-m-d H:i:s");
            $login_sql="INSERT INTO log_member value ('','$log_customer_id','$log_use_menu','$log_timestamp')";
            $this->db->query($login_sql);

            $_SESSION['userid']=$rs->name;
            $_SESSION['authority']=$rs->authority;
            $_SESSION['fullname']=$rs->fullname;
            return;
          }else{
            echo "ERROR002 : รหัสผ่านไม่ถูก <br>";
            header( 'refresh: 3; url='.site_url('') );
          }
        }
      }

      exit;
  }

 public function log_customer_use()
  {
      $log_customer_id=$this->session->userdata('userid');
      $log_use_menu=$this->uri->segment(1)."/".$this->uri->segment(2);
      $log_timestamp=date("Y-m-d H:i:s");
      $login_sql="INSERT INTO log_member value ('','$log_customer_id','$log_use_menu','$log_timestamp')";
      $this->db->query($login_sql);
  }


  public function logout()
  {
      session_destroy();
      redirect(site_url(''));
  }

         // echo"<pre>";print_r($query->result());echo"1</pre>"; exit;
}
?>