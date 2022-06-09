
<div class="container col-12" style="margin-top:30px">
    <table class="table table-hover  small table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='20%'><b>หน่วยรับผิดชอบ</b></th>
          <th width='10%'><b>จำนวนพัสดุ</b></th>
          <th width='10%'><b>รับ</b></th>
          <th width='10%'><b>จ่าย</b></th>
          <th width='10%'><b>คงเหลือ</b></th>
          <th width='10%'><b>หมายเหตุ</b></th>

        </tr>

    <?php
/*
$result = $this->db->query($sql);
foreach ($result->result() as $row) {
*/
  $num=0;  
  $sql = "SELECT * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
  $result = $this->db->query($sql);
  foreach ($result->result() as $row) {
  $categoryID = $row->categoryID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
  $categoryName = $row->categoryName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
  $planID = $row->planID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td>
      <a href="<?php echo site_url('report/Categoryreporedetail/'.$categoryID.'/65')?>"><?php echo $categoryName;?></a>
      </td>
      <td>
      <?php
      $sql9 = "SELECT * from tb_plan where planid='$planID' ;"; // ดึงข้อมูลจากตาราง product
     
      foreach ($this->db->query($sql9)->result() as $row9) {
        $planname = $row9->planname;
        $planid = $row9->planid;
        $deparmentID = $row9->deparmentID;

      }
      if($planID==0){
        echo '';
      }else{
        echo $planname;
      }
      ?>
      </td>
      <td>
      
      <?php 

          $sql4 = "SELECT * from tb_department where departmentID=$deparmentID and statusDepa='3' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          
          foreach ($this->db->query($sql4)->result() as $row4) {
            $departmentName = $row4->departmentName;
            $rootDepaID = $row4->rootDepaID;

            $sql5 = "SELECT * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          
            foreach ($this->db->query($sql5)->result() as $row5) {

              $rootDepaName = $row5->departmentName;
              $subDepaID = $row5->rootDepaID;

              $sql6 = "SELECT * from tb_department where departmentID='$subDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
              
              foreach ($this->db->query($sql6)->result() as $row6) {

                $subDepaName = $row6->departmentName;
              }
              if($planID==0){
                echo '';
              }else{
                echo  $departmentName . " [ ฝ่าย" . $rootDepaName . " - " . $subDepaName . " ]";
              }
            }
          }
          ?>
      
      </td>
          <td>
          <?php 
          $sql7 = "SELECT * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname ;"; 
          $result7 = $this->db->query($sql7);
          $Num_Rows = $result7->num_rows();
          echo $Num_Rows." รายการ" ;
          ?>
       </td>
          <td >
          <?php 
          $sql8 = "SELECT SUM(a.amount*b.price)as'sumin' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder<>'ou' and a.categoryID=$categoryID and a.statusfile=0
          and a.createdate BETWEEN '2021-10-01' AND '2022-09-30'";


          foreach ($this->db->query($sql8)->result() as $row8) 

          echo $sumin=number_format($row8->sumin);

          ?>          
          </td>
          <td >
          <?php 
          $sql9 = "SELECT SUM(a.amount*b.price)as'sumout' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder='ou' and a.categoryID=$categoryID and a.statusfile=0
          and a.createdate BETWEEN '2021-10-01' AND '2022-09-30'";
 
          foreach ($this->db->query($sql9)->result() as $row9) 

          echo  $sumout = number_format(abs($row9->sumout));
          ?>          
          </td>
          <td >
          <?php 
          echo   number_format($row8->sumin-abs($row9->sumout));
          ?>          
          </td>
          <td>
              <a class="btn btn-danger btn-sm " href="<?php echo base_url('report/hiddenRow/').$categoryID;?>" onClick="javascript:return confirm('คุณต้องการซ่อนข้อมูลใช่หรือไม่');">ซ่อน</a>
          </td>
      
    </tr>

<?php
    } 
    ?>
        </table>
    </div>
  </div>
</div>
