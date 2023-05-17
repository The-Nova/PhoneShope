<?php
    trait HomeModel{
        //ham tinh tong so ban ghi
		public function modelTotal($table){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from $table");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
        //ham tinh tong so gia tri hoa don
		public function modelTotalPrice($status){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select sum(price) AS pricecount from orders where status=$status ");
			//lay tat ca ket qua tra ve
            $result = $query->fetch();
            return $result;
		}
        //ham lay data trang thai hoa don
        public function modelstatusBill(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select status, COUNT(status) AS size_status,price,sum(price) AS pricecount FROM orders GROUP BY status");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }
        //ham lay data gia tri hoa don theo ngay
        public function modelvalueBilldate($date,$status){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select sum(price) AS pricecount FROM orders where createdate='$date' and status=$status");
            //lay ket qua tra ve
            $result = $query->fetch();
            return $result;
        }
        //ham lay data gia tri hoa don theo thang
        public function modelvalueBillmonth($month,$year,$status){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select sum(price) AS pricecount FROM orders where month(createdate)='$month' and year(createdate)='$year' and status=$status");
            //lay ket qua tra ve
            $result = $query->fetch();
            return $result;
        }
        //ham lay data gia tri hoa don theo nam
        public function modelvalueBillyear($year,$status){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select sum(price) AS pricecount FROM orders where year(createdate)='$year' and status=$status");
            //lay ket qua tra ve
            $result = $query->fetch();
            return $result;
        }
        //ham lay data theo ngay
        public function modeldatadate($date,$table){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select * FROM $table where createdate='$date' GROUP BY createdate");
            //ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
        }
        //ham lay data theo tháng
        public function modeldatamonth($month,$year,$table){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select * FROM $table where month(createdate)='$month' and year(createdate)='$year'");
            //ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
        }
        //ham lay datatheo nam
        public function modeldatayear($year,$table){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select * FROM $table where year(createdate)='$year'");
            //ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
        }
        
    }
?>