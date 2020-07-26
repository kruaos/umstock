    <table class="table table-hover  " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='30%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
        </tr>
    	<?php 
    		$num=0;
    		foreach ($query as $rs){
			$num = $num + 1;
 		echo "<tr>";
	 		echo "<td>".$num."</td>";
	 		echo "<td><a href='".site_url('basket/').$rs->categoryID."'>".$rs->categoryName."</a></td>";
	 		echo "<td>".$rs->planname."</td>";
	 		echo "<td>";
				$this->db->where('departmentID',$rs->deparmentID);
				$this->db->from('tb_department');
				$query=$this->db->get();
				$rootDepaID=$query->row('rootDepaID');
				echo "[".$query->row('departmentName');

				$this->db->where('departmentID',$rootDepaID);
				$this->db->from('tb_department');
				$query=$this->db->get();
				$rootDepaID=$query->row('rootDepaID');
				echo "-".$query->row('departmentName');

				$this->db->where('departmentID',$rootDepaID);
				$this->db->from('tb_department');
				$query=$this->db->get();
				echo "] ".$query->row('departmentName');

			echo "</td>";
 		echo "</tr>";
   		} 
		?>
        <table>
    </div>
  </div>
</div>
