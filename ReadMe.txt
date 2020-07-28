
ReadMe บันทึกการทำงาน 
อาทิตย์ 26 กค 63
	x. 1 แก้ไขส่วนที่ผิดพลาด
	http://localhost/umstock/order/approval
		- 405	นางสาวอมรรัตน์ พรหมจักร์	53 ใช้ รหัส 46	orderID 416
		- 422	นางสาวรัชนี ศรีธิหล้า		22		oderID 433
		- 447	นางสาวรัชนี ศรีธิหล้า		22
	แก้ไขที่ฐานข้อมูล 
		- tb_order.orderID 416 / 433 / 452
	x. 2 แก้ไข การคำรวนไม่ตรง 
		- http://www.umongcity.go.th/umstock/report/ReportDetail/186/63 ผลรวมถูกต้อง
		- http://www.umongcity.go.th/umstock/report/Categoryreporedetail/6/63	หน้านี้รวมไม่ตรง ติดลบ 
	. 3 แก้ไข กรณี ยอดเงินเป็นทศนิยม แต่มันเป็ํนปัดเศษ 
	. 4 รายการ ที่ 37 เครื่องดับเพลิง ติดลบ ลองเข้าไปดูในระบบ 
		- http://localhost/umstock/report/CategoryReport63	
