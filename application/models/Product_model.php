<?php
class product_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

 // ฟังชั่นแบบใหม่ ---------------------------------------

  public function product_show_all_by_categoryID($categoryID) {
    $this->db->where('categoryID', $categoryID);
    $this->db->where('statusproduct', 0);
    $query = $this->db->get("tb_product");
    return $query->result();
   }




// ฟังชั่นแบบเก่า ---------------------------------------------------
  public function record_count($categoryID){
    $this->db->where('categoryID', $categoryID);
    $this->db->where('statusproduct', 0);
    $query = $this->db->get("tb_product");

      return $query->num_rows();
    // print_r($query->num_rows());exit;
  }

  public function fetch_product($limit, $start,$categoryID) {
    $this->db->where('categoryID', $categoryID);
    $this->db->where('statusproduct', 0);
    $this->db->limit($limit, $start);
    $query = $this->db->get("tb_product");
// print_r($query->result());exit; 
    return $query->result();
   }


 	public function showcatgory()
  {
    $this->db->where('c.catestatus',0);
    $this->db->from('tb_category as c');
    $this->db->join('tb_plan as p','p.planid = c.planid');
    $query=$this->db->get();
    return $query->result(); 
  }

  public function ShowProAndBas($categoryID)
  {
    $this->db->where('p.categoryID', $categoryID);
    $this->db->where('b.memberID', $this->session->userdata('userid'));
    $this->db->from('tb_basket as b'); 
    $this->db->join('tb_product as p','p.id=b.productID'); 
    $query=$this->db->get();;
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


  public function show_product_by_catgory($categoryID)
  {
    $sql="select * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname";
    $query=$this->db->query($sql);
    return $query->result(); 
  }

    public function show_product_show_all()
  {
    $sql="select * from tb_product where statusproduct='0' order by productname";
    $query=$this->db->query($sql);
    return $query->result(); 
  }


  public function show_detail_product_from_orderfile($productid)
  {
    $sql="select * from tb_orderfile as o , tb_product as p where p.id=o.productID and o.statusfile='0' and o.productid='$productid' order by createdate ASC";
    $query=$this->db->query($sql);
    return $query->result(); 
  }

    public function show_detail_tb_product($productid)
  {
    $sql="select * from tb_product where id='$productid'";
    $query=$this->db->query($sql);
    return $query->result(); 
  }



  public function add_product_from_staff()
  {
    $product=$this->input->post('add_product');
    $price=$this->input->post('add_price');
    $pic='1234';
    $categoryID=$this->input->post('categoryID');
    $statuspro='0';
  
    if (($product=="" or $price=="")or(!is_numeric($price))) {
      echo "กรอกข้อมูลไม่ครบ หรือ ตัวเลขไม่ถูกต้อง  <a href='../order/product/$categoryID'>ย้อนกลับ</a>";
      exit;
    }
    $sql="insert into tb_product values('','$product','$price','$pic','$statuspro','$categoryID')";
    // echo $sql;exit;
    $result=$this->db->query($sql);
    if ($result) {
      redirect(site_url('order/product/'.$categoryID));
    } else {
      echo "save fail";
    }
  }

  public function Update_Product_from_staff()
  {
    $productName=$this->input->post('productName');
    $price=$this->input->post('add_price');
    $productID=$this->input->post('productID');
    $categoryID=$this->input->post('categoryID');


  
    if (($productName=="" or $price=="")or(!is_numeric($price))) {
      echo "กรอกข้อมูลไม่ครบ หรือ ตัวเลขไม่ถูกต้อง  <a href='../product/edit/$productID'>ย้อนกลับ</a>";
      exit;
    }

    $sql="update tb_product set productName='$productName' , price='$price' where id=$productID ";
    // echo $sql;exit;
    $result=$this->db->query($sql);
    if ($result) {
      redirect(site_url('order/product/'.$categoryID));
    } else {
      echo "save fail";
    }
  }

    public function del_Product_from_staff()
  {
    $productID=$this->uri->segment(3);

    $sql="select categoryID from tb_product where id=$productID";
    $result=$this->db->query($sql);
    foreach ($result->result() as $rs) {

      $categoryID=$rs->categoryID;
    }
    
    $sql="update tb_product set statusproduct='1' where id=$productID ";
    // echo $sql;exit;
    $result=$this->db->query($sql);
    if ($result) {
      redirect(site_url('order/product/'.$categoryID));
    } else {
      echo "save fail";
    }
  }









}
    // echo"<pre>";print_r($query->result());echo"1</pre>"; exit;
?>