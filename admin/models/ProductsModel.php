<?php 
	trait ProductsModel{
		//lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products order by id desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//lay danh sach cac ban ghi, co phan trang
		public function modelReadTypes($id){			
			//lay id
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from types where product_id='$id' order by id ");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		
		//lay danh sach cac ban ghi, co phan trang tim kiem
		public function modelReadSearch($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where name like '%$keyword%' or description like '%$keyword%' order by createdate desc limit $from,$recordPerPage ");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//lay danh sach cac ban ghi, co phan trang loc theo ngay
		public function modelReadFillter($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where createdate = '$datefil' order by id desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//lay danh sach cac ban ghi, co phan trang san pham hot
		public function modelReadStatus($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where hot = 1 order by id desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from products");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

		//ham tinh tong so ban ghi san pham dang hot
		public function modelTotalHot(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from products where hot=1");
			//ham rowCount: dem so ket qua tra ve
			
			return $query->rowCount();
		}
		//ham tinh tong so ban ghi san pham dang tim
		public function modelTotalSearch(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['search'])){
			$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			$query = $conn->query("select id from products where name like '%$keyword%' or description like '%$keyword%'");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

		//ham tinh tong so ban ghi san pham dang loc theo ngay
		public function modelTotalFilterDate(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			$query = $conn->query("select id from products where createdate='$datefil'");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}

		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetTypes($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from types where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}

		//lay mot ban ghi category tuong ung voi id truyen vao
		public function getCategory($category_id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select name from categories where id=$category_id");
			$record = $query->fetch();
			return $query->rowCount() > 0 ? $record->name : "";
		}

		//ham cap nhat san pham
		public function modelUpdate($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$name = $_POST["name"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"])?1:0;
			$price = $_POST["price"];
			$discount = $_POST["discount"];
			$category_id = $_POST["category_id"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update products set name=:_name,description=:_description,content=:_content,hot=:_hot,price=:_price,discount=:_discount,category_id=:_category_id where id=:_id");
			$query->execute([":_name"=>$name,":_description"=>$description,":_content"=>$content,":_hot"=>$hot,":_price"=>$price,":_discount"=>$discount,":_category_id"=>$category_id,":_id"=>$id]);
			//---
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){
				//---
				//lay anh cu de xoa
				$oldQuery = $conn->query("select photo from products where id=$id");
				if($oldQuery->rowCount() > 0)
					$oldPhoto = $oldQuery->fetch();
					if(file_exists("../assets/upload/products/".$oldPhoto->photo))
						unlink("../assets/upload/products/".$oldPhoto->photo);
				//---
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/products/$photo");
				//update csdl
				$query = $conn->prepare("update products set photo = :_photo where id=:_id");
				$query->execute([":_photo"=>$photo,":_id"=>$id]);
				//---
			}
			//---
		}

		//ham cap nhat dac diem san pham
		public function modelUpdateTypes($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$color = $_POST["color"];
			$quantity = $_POST["quantity"];
			$capacity = $_POST["capacity"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update types set color=:_color,quantity=:_quantity where id=:_id");
			$query->execute([":_color"=>$color,":_quantity"=>$quantity,":_id"=>$id]);
			//---
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){
				//---
				//lay anh cu de xoa
				$oldQuery = $conn->query("select photo from types where id=$id");
				if($oldQuery->rowCount() > 0)
					$oldPhoto = $oldQuery->fetch();
					if(file_exists("../assets/upload/products/".$oldPhoto->photo))
						unlink("../assets/upload/products/".$oldPhoto->photo);
				//---
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/products/$photo");
				//update csdl
				$query = $conn->prepare("update types set photo = :_photo where id=:_id");
				$query->execute([":_photo"=>$photo,":_id"=>$id]);
				//---
			}
			//---
		}

		//ham tao san pham moi
		public function modelCreate(){
			$name = $_POST["name"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"])?1:0;
			$photo = "";
			$price = $_POST["price"];
			$discount = $_POST["discount"];
			$category_id = $_POST["category_id"];
			$createdate=date("Y-m-d");
			//---
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){				
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/products/$photo");
			}
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into products set name=:_name,description=:_description,content=:_content,hot=:_hot,photo=:_photo,price=:_price,discount=:_discount,category_id=:_category_id,createdate=:_createdate");
			$query->execute([":_name"=>$name,":_description"=>$description,":_content"=>$content,":_hot"=>$hot,":_photo"=>$photo,":_price"=>$price,":_discount"=>$discount,":_category_id"=>$category_id,":_createdate"=>$createdate]);			
		}

		//ham tao dac diem san pham
		public function modelCreateTypes(){
			$product_id = $_POST["product_id"];
			$color = $_POST["color"];
			$quantity = $_POST["quantity"];
			$photo = "";
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){				
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/products/$photo");
			}
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into types set product_id=:_product_id,color=:_color,quantity=:_quantity,photo=:_photo");
			$query->execute([":_product_id"=>$product_id,":_color"=>$color,":_quantity"=>$quantity,":_photo"=>$photo]);			
		}

		//xoa ban ghi
		public function modelDelete($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			//---
			//lay anh cu de xoa
			$oldQuery = $conn->query("select photo from products where id=$id");
			if($oldQuery->rowCount() > 0)
				$oldPhoto = $oldQuery->fetch();
				if(file_exists("../assets/upload/products/".$oldPhoto->photo))
					unlink("../assets/upload/products/".$oldPhoto->photo);
			//---
			$conn->query("delete from products where id=$id");
		}

		//xoa ban ghi
		public function modelDeleteTypes($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			//---
			//lay anh cu de xoa
			$oldQuery = $conn->query("select photo from types where id=$id");
			if($oldQuery->rowCount() > 0)
				$oldPhoto = $oldQuery->fetch();
				if(file_exists("../assets/upload/products/".$oldPhoto->photo))
					unlink("../assets/upload/products/".$oldPhoto->photo);
			//---
			$conn->query("delete from types where id=$id");
		}

		//ham lay danh sach the loai
		public function modelListCategories(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id,name from categories where parent_id = 0 order by id desc");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}

		//ham lay danh sach the loai con
		public function modelListCategoriesSub($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id,name from categories where parent_id = $id order by id desc");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}

		//tinh rating cua 1 sp tuong ung voi id truyen vao
		public function modelGetRating($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select ROUND(AVG(star), 1) as avg_star FROM rating WHERE product_id=$id");
			//tra ve mot ban ghi
			$result =$query->fetch();
            return $result;
		}

		//ham kiem tra san pham da ton tai hay chua
		public function modelCheckName(){
			$name = $_POST["name"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where name='$name' ");
			if($query->rowCount() == 0){
				return true;
			}else {
				return false;
			}		
		}

		//ham kiem tra san pham da ton tai hay chua
		public function modelCheckType(){
			$product_id= $_SESSION['product_id'];
			$color = $_POST["color"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from types where product_id='$product_id' and color='$color'");
			if($query->rowCount() == 0){
				return true;
			}else {
				return false;
			}		
		}
	}
 ?>