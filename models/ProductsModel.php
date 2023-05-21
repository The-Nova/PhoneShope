<?php
    trait ProductsModel{
        //lay danh muc cha
		public function modelReadCategories(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where parent_id=0 and displayhomepage=1");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}

        //lay danh muc con
		public function modelReadSubCategories(){
			$category_name=isset($_GET["category_name"])?$_GET["category_name"]:'';
			$category_name=str_replace(" ","",$category_name);
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where name like '$category_name _%'");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}
		
		//lay danh sach san pham theo gia
		public function modelProductsByOption(){
            $category_name=isset($_GET["category_name"])?$_GET["category_name"]:'';
			$price=isset($_GET["price"])?$_GET["price"]:'';
			$color=isset($_GET["color"])?$_GET["color"]:'';
			switch($price){
				case "duoi-2-trieu":
					$queryPrice="  price<'2000000' ";
					break;
				case "tu-2-4-trieu":
					$queryPrice="  price>='2000000' and price<'4000000' ";
					break;
				case "tu-4-7-trieu":
					$queryPrice="  price>='4000000' and price<'7000000' ";
					break;
				case "tu-7-15-trieu":
					$queryPrice="  price>='7000000' and price<'15000000' ";
					break;
				case "tren-15-trieu":
					$queryPrice="  price>'15000000' ";
					break;
				default:
					$queryPrice="";break;
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(empty($color)){
				if($category_name==0&&empty($price)){
					$query = $conn->query("select * from products order by createdate desc ");
				}elseif($category_name==0&&!empty($price)){
					$query = $conn->query("select * from products where $queryPrice order by createdate desc");
				}elseif($category_name!=0&&empty($price)){
					$query = $conn->query("select * from products where name like '%$category_name%' order by createdate desc");
				}else{
					$query = $conn->query("select * from products where name like '%$category_name%' and $queryPrice order by createdate desc");
				}
			}else{
				
				if($category_name==0&&empty($price)){
					$query=$conn->query("select p.id,p.category_id,p.name,p.description,p.photo,p.price,p.discount,t.color,p.view
					FROM products p,types t WHERE p.id=t.product_id and t.color='$color' order by p.createdate desc ");
				}elseif($category_name==0&&!empty($price)){
					$query=$conn->query("select p.id,p.category_id,p.name,p.description,p.photo,p.price,p.discount,t.color,p.view
				FROM products p,types t WHERE $queryPrice and p.id=t.product_id and t.color='$color' order by p.createdate desc ");
				}elseif($category_name!=0&&empty($price)){
					$query=$conn->query("select p.id,p.category_id,p.name,p.description,p.photo,p.price,p.discount,t.color ,p.view
				FROM products p,types t WHERE name like '%$category_name%' and p.id=t.product_id and t.color='$color' order by p.createdate desc ");
				}else{
					$query=$conn->query("select p.id,p.category_id,p.name,p.description,p.photo,p.price,p.discount,t.color ,p.view
				FROM products p,types t WHERE name like '%$category_name%' and $queryPrice and p.id=t.product_id and t.color='$color' order by p.createdate desc ");
				}
			}
            
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}

		//lay 1 san pham
		public function modelProducts(){
            $products=isset($_GET["id"])?$_GET["id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where id=$products order by createdate desc");
			//lay tat ca ket qua tra ve
            $result = $query->fetch();
            return $result;
		}

		//ham cap nhat luot san pham
		public function modelUpdateView($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update products set view=view+1 where id=:_id");
			$query->execute([":_id"=>$id]);
		}

		//lay rating cua 1 sp tuong ung voi id truyen vao
		public function modelRating($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
			WHERE rating.customer_id=customers.id and product_id=$id");
			//tra ve mot ban ghi
			$result =$query->fetchAll();
            return $result;
		}

		//dem so rating cua 1 sp tuong ung voi id truyen vao
		public function modelCountRating($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
			WHERE rating.customer_id=customers.id and product_id=$id");
			//tra ve mot ban ghi
			$result =$query->rowCount();
            return $result;
		}

		//loc rating cua 1 sp tuong ung voi id truyen vao theo so sao
		public function modelFilterRating($id){
			$i=isset($_GET['star'])?$_GET['star']:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			if($i==0){
				$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
				WHERE rating.customer_id=customers.id and product_id=$id");
			}else{
				$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
				WHERE rating.customer_id=customers.id and product_id=$id and rating.star=$i");
			}
			//tra ve mot ban ghi
			$result =$query->fetchAll();
            return $result;
		}

		//dem so rating cua 1 sp tuong ung voi id truyen vao theo so sao
		public function modelTotalFilterRating($id){
			$i=isset($_GET['star'])?$_GET['star']:0;
			//lay bien ket noi
			$conn = Connection::getInstance();
			if($i==0){
				$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
				WHERE rating.customer_id=customers.id and product_id=$id");
			}else{
				$query = $conn->query("select rating.star,rating.comment,rating.createdate,customers.name FROM rating,customers 
				WHERE rating.customer_id=customers.id and product_id=$id and rating.star=$i");
			}
			//dem so ban ghi
			$result =$query->rowCount();
            return $result;
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

		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetTypes($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from types where product_id=$id");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}

        //ham lay san pham ban chay
        public function modelBestseller(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select products.id as id,products.name as name,products.photo as photo,products.price as price,
            products.discount as discount,sum(orderdetails.quantity) as sumcount FROM products,types,orderdetails 
            WHERE orderdetails.type_id=types.id AND products.id=types.product_id GROUP BY types.product_id ORDER by sumcount DESC LIMIT 10");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }

		//lay san pham dang ha gia
		public function modelProductsSale(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where discount>0 ORDER by createdate desc");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}

        //lay mau sac
		public function modelGetColor(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT color FROM types ");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}

        //ham tinh tong so ban ghi san pham dang tim
		public function modelTotalSearch(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_POST["search"])){
			$keyword = $_POST["search"];
			}else{
				$keyword="";
			}
			$query = $conn->query("select id from products where name like '%$keyword%' or description like '%$keyword%'");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

        //lay danh sach cac ban ghi, co phan trang tim kiem
		public function modelReadSearch($recordPerPage){			
			$name=isset($_GET["category_name"])?$_GET["category_name"]:'';
			if(!empty($_GET["search"])){
				$keyword = $_GET["search"];
			}else{
				$keyword=$name;
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where name like '%$keyword%' order by createdate desc");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//ham tao danh gia
		public function modelCreateRating(){
			$customer_id = $_SESSION["customer_id"];
			$star = $_POST["star"];
			$comment = $_POST["comment"];
			$product_id = $_GET["id"];
			$createdate=date("Y-m-d");
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into rating set customer_id=:_customer_id,star=:_star,comment=:_comment,product_id=:_product_id,createdate=:_createdate");
			$query->execute([":_customer_id"=>$customer_id,":_star"=>$star,":_comment"=>$comment,":_product_id"=>$product_id,":_createdate"=>$createdate]);			
		}

    }
?>