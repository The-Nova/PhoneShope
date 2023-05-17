<?php 
	trait CartsModel{
		//ham liet ke danh sach cac ban ghi, co phan trang
		public function modelRead(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//thuc hien truy van
			$conn = Connection::getInstance();
			$query = $conn->query("select  t.id as type_id,c.id as id,p.id as product_id,p.photo as photo,p.name as name,c.quantity as quantity,p.discount as discount,
			p.price as price,t.color as color,t.quantity as type_quantity from carts c,types t,products p where c.customer_id=$customer_id and t.id=c.type_id 
			and p.id=t.product_id order by id desc");
			//tra ve tat ca cac ban truy van duoc
			$result = $query->fetchAll();
			return $result;
		}

		//lay dia chi khach hang
		public function modelGetAddress(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select address from customers where id=$customer_id");
			//lay ban ghi
			return $query->fetch();
		}

		//ham tinh tong so ban ghi
		public function modelTotal(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select id from carts where customer_id=$customer_id");
			//lay tong so ban ghi
			return $query->rowCount();
			//---
		}
		
		//lay mot ban ghi trong bang gio hang
		public function modelGetCarts($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from carts where id = $id");
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
			$query = $conn->query("select products.photo as photo,products.name as name
			 from types,products where products.id=types.product_id and types.id='$id'");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}

		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetTypes($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from types where product_id=$id and quantity>0");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}

		//ham them san pham vao gio hang
		public function modelCreateCart(){
			$customer_id = isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			$type_id = $_GET["type_id"];
			$quantity = number_format($_GET["quantity"]);
			$createdate=date("Y-m-d");
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!$this->checkCart($type_id)){
				$query = $conn->prepare("insert into carts set customer_id=:_customer_id,type_id=:_type_id,quantity=:_quantity,createdate=:_createdate");
				$query->execute([":_customer_id"=>$customer_id,":_type_id"=>$type_id,":_quantity"=>$quantity,":_createdate"=>$createdate]);	
			}else{
				$query = $conn->prepare("update carts set quantity=quantity+:_quantity where type_id=:_type_id and customer_id=:_customer_id");
				$query->execute([":_customer_id"=>$customer_id,":_type_id"=>$type_id,":_quantity"=>$quantity]);	
			}		
		}

		//nut cong so luong san pham
		public function modelPlus($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update carts set quantity=quantity+1 where type_id=:_id ");
			$query->execute([":_id"=>$id]);	
		}

		//nut tru so luong san pham
		public function modelMinus($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update carts set quantity=quantity-1 where type_id=:_id ");
			$query->execute([":_id"=>$id]);	
		}
		
		//kiem tra san pham đã có
		public function checkCart($id){
			$customer_id = isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from carts where id=$id and customer_id=$customer_id");
			if($query->rowCount()>0) return true; 
			else return false;
			
		}

		//xoa ban ghi
		public function modelDelete($id){
			$customer_id = isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("delete from carts where id=$id and customer_id=$customer_id");
		}

	}
 ?>