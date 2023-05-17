<?php
    trait RatingModel{

        //lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT products.id,products.photo as product_photo,products.name as product_name,
                products.category_id as category_id  from products,rating WHERE rating.product_id=products.id 
                order by id desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

        //ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT products.id from products,rating WHERE rating.product_id=products.id");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

         //lay danh sach cac ban ghi, co phan trang
		public function modelReadStar($star,$recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT products.id,products.photo as product_photo,products.name as product_name,
                products.category_id as category_id  from products,rating WHERE rating.product_id=products.id and rating.star=$star
                order by id desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

        //ham tinh tong so ban ghi
		public function modelTotalStar($star){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT products.id from products,rating WHERE rating.product_id=products.id and rating.star=$star");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

        //lay danh sach cac ban ghi, co phan trang xem chi tiet
		public function modelReadDetail($id,$recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select rating.id,products.name as product_name,rating.star,rating.comment,
            rating.createdate,customers.name as customer_name from rating,products,customers  
            WHERE rating.product_id=products.id AND product_id=$id and rating.customer_id=customers.id 
            order by star desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

        //ham tinh tong so ban ghi trang xem chi tiet
		public function modelTotalDetail($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select rating.id,products.name as product_name,rating.star,rating.comment,
            rating.createdate,customers.name as customer_name from rating,products,customers  
            WHERE rating.product_id=products.id AND product_id=$id and rating.customer_id=customers.id");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

        //lay mot ban ghi category tuong ung voi id truyen vao
		public function getCategory($category_id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select name from categories where id=$category_id");
			$record = $query->fetch();
			return $query->rowCount() > 0 ? $record->name : "";
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

        //xoa ban ghi
		public function modelDelete($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("delete from rating where id=$id");
		}
    }
?>