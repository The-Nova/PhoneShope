<?php 
	trait OrdersModel{
        //ham liet ke danh sach cac ban ghi, co phan trang
		public function modelReadCarts(){
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
		
		//ham liet ke danh sach cac ban ghi, co phan trang
		public function modelReadDetail(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//thuc hien truy van
			$conn = Connection::getInstance();
			$query = $conn->query("select  od.id as id,t.id as type_id,od.order_id,p.id as product_id,p.photo as photo,p.name as name,od.quantity as quantity,p.discount as discount, p.price as price,t.color as color,od.createdate as createdate
            from orderdetails od,types t,products p,orders o where od.order_id=o.id and t.id=od.type_id 
            and p.id=t.product_id and o.customer_id=$customer_id order by order_id desc;");
			//tra ve tat ca cac ban truy van duoc
			$result = $query->fetchAll();
			return $result;
		}
		
		//ham tinh tong so ban ghi
		public function modelReadOrders(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where customer_id=$customer_id order by id desc");
			//lay tong so ban ghi
			return $query->fetchAll();
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
		public function modelCreateOrder(){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
            $dataProduct=$this->modelReadCarts();
            $sumprice=0;
            $saleprice=0;
            $checkbox=isset($_POST['checkbox'])?$_POST['checkbox']:0;
            $optSale=$_POST["optradio"];
            $optAddress=$_POST["opt"];
            $address=$_POST["address"];
            foreach($dataProduct as $rows){
                $sumprice+=($rows->price*$rows->quantity);
                $saleprice+=($rows->price*$rows->discount/100);
            }
            if($checkbox==1){
                $saleprice+=200000;
            }
            if($optSale==2){
                $saleprice+=$sumprice*5/100;
            }
			$createdate=date("Y-m-d");
			//lay bien ket noi
			$conn = Connection::getInstance();
            //them hoa don moi
            $query = $conn->prepare("insert into orders set customer_id=:_customer_id,price=:_price,saleprice=:_saleprice,createdate=:_createdate");
            $query->execute([":_customer_id"=>$customer_id,":_price"=>$sumprice,":_saleprice"=>$saleprice,":_createdate"=>$createdate]);
            $order_id=$conn->lastInsertId();
            foreach($dataProduct as $rows){
                $type_id=$rows->type_id;
                $quantity=$rows->quantity;
                $price=$rows->price;
                $sale=$rows->discount;
                //anh xa gio hang sang chi tiet hoa don
                $query = $conn->prepare("insert into orderdetails set order_id=:_order_id,type_id=:_type_id,quantity=:_quantity,price=:_price,sale=:_sale");
                $query->execute([":_order_id"=>$order_id,":_type_id"=>$type_id,":_quantity"=>$quantity,":_price"=>$price,":_sale"=>$sale]);
                //cap nhat so luong trong kho
                $query = $conn->prepare("update types set quantity=quantity-:_quantity where id=:_id");
                $query->execute([":_quantity"=>$quantity,":_id"=>$type_id]);
                //xoa gio hang
                $this->modelDelete($rows->id);
                $_SESSION["success"]="Mua hàng thành công! Nhân viên sẽ liên lạc trong vòng 10 phút";
            }
            if($optAddress==2){
                $query = $conn->prepare("update customers set address=:_address where id=:_id");
                $query->execute([":_address"=>$address,":_id"=>$customer_id]);
            }
				
		}
		//xoa ban ghi
		public function modelDelete($id){
			$customer_id=isset($_SESSION["customer_id"])?$_SESSION["customer_id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("delete from carts where id=$id and customer_id=$customer_id");
            $_SESSION["countcart"]-=1;
		}

	}
 ?>