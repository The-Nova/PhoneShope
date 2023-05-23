<?php 
	trait OrdersModel{
		//ham liet ke danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){
			//lay so trang hien tai truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//thuc hien truy van
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders order by id,status desc limit $from, $recordPerPage");
			//tra ve tat ca cac ban truy van duoc
			$result = $query->fetchAll();
			return $result;
		}
		//ham liet ke danh sach cac ban ghi, co phan trang tim kiem
		public function modelReadSearch($recordPerPage){
			//lay so trang hien tai truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select orders.id,orders.customer_id,orders.datepay,orders.createdate,orders.price,orders.status,orders.note
				from orders,customers where customers.id =orders.customer_id 
				and (customers.phone = '$keyword' or customers.name LIKE '%$keyword%') order by id,status desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		//ham liet ke danh sach cac ban ghi, co phan trang loc theo ngay
		public function modelReadFillter($recordPerPage){
			//lay so trang hien tai truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where createdate = '$datefil' order by id,status desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		//ham liet ke danh sach cac ban ghi, co phan trang loc theo trang thai
		public function modelReadStatus($recordPerPage){
			//lay so trang hien tai truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['status'])){
				$status = $_REQUEST['status'];
			}else{
				$status="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where status = '$status' order by id desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select id from orders");
			//lay tong so ban ghi
			return $query->rowCount();
			//---
		}
		//ham tinh tong so ban ghi hoa don dang tim theo ten hoac so dien thoai
		public function modelTotalSearch(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['search'])){
			$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			$query = $conn->query("select orders.id,orders.customer_id,orders.datepay,orders.createdate,orders.price,orders.status,orders.note
				from orders,customers where customers.id =orders.customer_id 
				and (customers.phone = '$keyword' or customers.name LIKE '%$keyword%')");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//ham tinh tong so ban ghi hoa don dang loc
		public function modelTotalFilterDate(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			$query = $conn->query("select id from orders where createdate='$datefil'");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//ham tinh tong so ban ghi hoa don theo trang thai
		public function modelTotalStatus(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['status'])){
				$status = $_REQUEST['status'];
			}else{
				$status="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where status ='$status' ");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//lay mot ban ghi table orders
		public function modelGetOrders($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where id = $id");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}
		//lay mot ban ghi trong table customers		
		public function modelGetCustomers($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from customers where id = $id");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}
		//lay mot ban ghi trong table products		
		public function modelGetProducts($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select products.photo as photo,products.name as name,types.color as color,
			products.price as price from types,products where products.id=types.product_id and types.id='$id'");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}

		//xac nhan da giao hang
		public function modelDelivery($id){
			$date=date("20y-m-d");
			//---
			$conn = Connection::getInstance();
			$conn->query("update orders set status = 1,datepay='$date' where id = $id");
		}
		
		//lay danh sach cac san pham trong bang orderdetails
		public function modelListOrderDetails($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orderdetails where order_id = $id");
			//tra ve mot ban ghi
			return $query->fetchAll();
			//---
		}

		//huy hoa don
		public function modelCancel($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("update orders set status=2 where id=$id ");
		}
	}
 ?>