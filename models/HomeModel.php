<?php
    trait HomeModel{
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
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where parent_id>0 and displayhomepage=1");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
		}
        
        //lay san pham
		public function modelReadProducts(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products order by createdate desc limit 10");
			//lay tat ca ket qua tra ve
            $result = $query->fetchAll();
            return $result;
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

        //ham lay tin tuc
        public function modelReadNews(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select news.id,news.name,news.photo,news.createdate,users.name as createdby 
            FROM news,users WHERE news.createdby=users.id order by createdate desc limit 3");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }

		//ham lay tin tuc
        public function modelHotNews(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select * FROM news order by createdate desc limit 1");
            //lay ket qua tra ve
            $result = $query->fetch();
            return $result;
        }

        
    }
?>