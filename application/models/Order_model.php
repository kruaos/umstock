<?php
class order_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

 	public function showcatgory()
  {
    $this->db->where('c.catestatus',0);
    $this->db->from('tb_category as c');
    $this->db->join('tb_plan as p','p.planid = c.planid');
    $this->db->order_by('categoryID', 'DESC');
    $this->db->order_by('c.planID', 'DESC');
    $query=$this->db->get();
    return $query->result(); 
  }

  public function setcatgory($categoryID)
  {
    $this->db->where('categoryID',$categoryID);
    $this->db->from('tb_category');
    $query=$this->db->get();
    return $query->result(); 
  }

  public function showorderfile($categoryID)
  {
    $this->db->where('categoryID',$categoryID);
    $this->db->from('tb_category');
    $query=$this->db->get();
    return $query->result(); 
  }

  public function user_book_order()
  {
    $memberID=$this->session->userdata('userid');
    $amount_by_product=$this->input->post('amount_by_product');    
    $productID=$this->input->post('product_id');

    $sql1 = "select count(basketID) as 'countid' from tb_basket where productID=$productID and memberID=$memberID";
    $query=$this->db->query($sql1);
      if($query->row()->countid==0){ 
         $sql = "insert into tb_basket (memberID,productID,quantity) values($memberID,$productID,$amount_by_product)";
      }else{ 
         $sql = "update tb_basket set quantity=quantity+$amount_by_product where  productID=$productID and memberID=$memberID";
      }
    $this->db->query($sql);
  }

  public function user_unbook_order()
  {
    $memberID=$this->session->userdata('userid');
    $productID=$this->uri->segment(4); 

    $sql1 = "select quantity from tb_basket where productID=$productID and memberID='$memberID'";
    $query=$this->db->query($sql1);
      if($query->row()->quantity==1){ // ถ้าไม่มีสินค้าในตะกร้าเลยให้เรียก sql insert เพื่อเก็บรายการสินค้าลงตาราง basket
        $sql = "DELETE FROM tb_basket where  productID=$productID and memberID='$memberID'";
      }else{ 
        $sql = "update tb_basket set quantity=quantity-1 where productID=$productID and memberID='$memberID'";
      }
    $this->db->query($sql);
  }

   public function user_clear_book()
  {
    $memberID=$this->session->userdata('userid');
    $sql3 = "select * from tb_basket where memberID=$memberID"; // ดึงข้อมูลจากตาราง product
    $rs3=$this->db->query($sql3);
    foreach ($rs3->result() as $rs) {
      $basketID = $rs->basketID;

      $sql="DELETE FROM tb_basket where  basketID=$basketID";
      $this->db->query($sql);
    }
  }

  public function user_add_order()
  {

    $categoryID=$this->input->post('categoryID');
    $memberID=$this->session->userdata('userid');
    $dayneed=$this->input->post('dayneed');
    $dateOrder=$this->input->post('dateOrder');
    $explain=$this->input->post('explain');

    $sql1 = "select * from tb_order where memberID=$memberID"; // ดึงข้อมูลจากตาราง product
    $rs1=$this->db->query($sql1);
    $numrows=$rs1->num_rows()+1;

    $needdaydate=(substr($dayneed,6,4)-543)."-".substr($dayneed,3,2)."-".substr($dayneed,0,2);
    $createdate=(substr($dateOrder,6,4)-543)."-".substr($dateOrder,3,2)."-".substr($dateOrder,0,2).date(" H:m:s");

    $orderNum=$memberID.$numrows;
    $status='1';

    $sql2="INSERT INTO tb_order VALUES('','$orderNum','$memberID', '$explain','$needdaydate','0', '0', '0', ' $createdate', '$status','0','') ";
    $rs2=$this->db->query($sql2);

    $statusOrder='ou';

    $sql3 = "select * from tb_basket where memberID=$memberID"; // ดึงข้อมูลจากตาราง product
    $rs3=$this->db->query($sql3);
    // print_r($rs3->result());exit;

    foreach ($rs3->result() as $rs) {
      $basketID = $rs->basketID;
      $productID = $rs->productID;
      $amount = -($rs->quantity);
      $cusid=$memberID;
      // echo $basketID.'|'.$productID.'|'.$amount ;

      $sql4="INSERT INTO tb_orderdetail VALUES ('', '$createdate', '$productID', '$categoryID', '$orderNum','$statusOrder', '$amount', '', '$explain', '', '$cusid', '$needdaydate')";
        $rs4=$this->db->query($sql4);
      $sql6="DELETE FROM tb_basket where  basketID=$basketID";
        $rs6=$this->db->query($sql6);
      }
  }

  public function del_order_from_tb_orderfile($orderFileID,$categoryID)
  {
    $sql_del_order_from_tb_orderfile="update tb_orderfile set statusfile='1' where orderFileID=$orderFileID";
    $this->db->query($sql_del_order_from_tb_orderfile);
    redirect(site_url('order/stafforder/'.$categoryID));
 
  }


  public function del_order_from_tb_order($order_id)
  {
    $sql_delorder_from_tb_order="update tb_order set status='0' where orderid=$order_id";

    $this->db->query($sql_delorder_from_tb_order);
    redirect(site_url('report/printorder/'.$id_order));
 
  }

  public function staff_add_order()
  {
    $amount=$this->input->post('amount');
    date_default_timezone_set("Asia/Bangkok");
      $texttime=$this->input->post('dateOrder');

      $createdate=(substr($texttime,6,4)-543)."-".substr($texttime,3,2)."-".substr($texttime,0,2).date(" H:m:s");


      $productID=$this->input->post('productID');
      $categoryID=$this->input->post('categoryID');
      $orderID=1; // กรณีที่กรอก โดย เจ้าหน้าที่ 
      $planid=$this->input->post('planid');
      $cusid=$this->input->post('cusid');
      $status=$this->input->post('status');
      $sellerID=$this->input->post('sellerID');
      $NumProductID=$this->input->post('NumProductID');

      if ($status=="ou"){
        $text6=-$amount;
        $sellerID='';
      }else{
        $text6=$amount;
        $cusid='';
      }
      $detail="";
      $productPrice=$this->input->post('productPrice');

      $sql="insert into tb_orderfile values
          ('','$createdate','$productID','$categoryID','$orderID','$status','$text6','$productPrice','$detail','0',
          '$cusid','$sellerID','$NumProductID')";
          // echo $sql;exit;
      $result=$this->db->query($sql);
      if ($result) {
          redirect( site_url('order/stafforder/'.$categoryID));
      } else {
        echo $sql;
        echo "ล้มเหลว";
        exit;
      }
  }

  public function appoval_is_ok($orderid)
  {
    date_default_timezone_set("Asia/Bangkok");

    $memberID=$this->session->userdata('userid');

    $sql1='SELECT max(orderIdReport) as maxorder FROM tb_order';

    $result1 = $this->db->query($sql1);
    foreach ($result1->result() as $row1) {
     $maxorder = ($row1->maxorder)+1; 
    }
//  [] ถ้าอนุมัติควรเพิ่มข้อมูลลงใน tb_orderfile
    $sql4 = "update tb_order set staff1='$memberID' , orderIdReport='$maxorder' where  orderid='$orderid'";
    $result = $this->db->query($sql4);


    $sql_show_orderdetail="select * from tb_orderdetail , tb_order where tb_order.ordernum=tb_orderdetail.orderid and tb_order.orderID=$orderid";
    foreach ($this->db->query($sql_show_orderdetail)->result() as $rsorder) {
          $orderFileID="";
          $createdate=$rsorder->createdate;
          $productID=$rsorder->productID;
          $categoryID=$rsorder->categoryID;
          $orderID=$rsorder->orderID;
          $statusOrder=$rsorder->statusOrder;
          $amount=$rsorder->amount;
          $price=$rsorder->price;
          $detail=$rsorder->detail;
          $explain=$rsorder->explain;
          $statusfile=$rsorder->statusfile;
          $cusid=$rsorder->cusid;
          $sellerID="";
          $NumProductID="";
    $insert_tb_orderfile="INSERT INTO tb_orderfile VALUES('$orderFileID', '$createdate', '$productID', '$categoryID', '$orderID','$statusOrder', '$amount', '$price', '$detail', '$statusfile', '$cusid', '$sellerID', '$NumProductID');";
    $this->db->query($insert_tb_orderfile);
    }
    
    if ($result) {
      redirect(site_url('order/approval/'),'refresh');
    } else {
      echo "<h3>บันทึกล้มเหลว</h3>";
      exit;
    }
  }

  public function appoval_is_cancel($orderNum)
  {
    $ordernum=$orderNum;

//  [] ถ้ายกเลิกควรลบข้อมูลลงใน tb_orderdetail

    $sql4 = "update tb_order set staff1='0', orderIdReport='0' where  orderid='$ordernum'";
    $result = $this->db->query($sql4);

    if ($result) {
      redirect(site_url('order/approval/'),'refresh');
    } else {
      echo "<h3>บันทึกล้มเหลว</h3>";
      exit;
    }
  }

    // echo"<pre>";print_r($query->result());echo"1</pre>"; exit;
}
?>