<?php
    trait StatisticModel{
        //ham lay cac nam
        public function modelGetYears($table){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select DISTINCT year(createdate) as years from $table");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }

        //ham lay bang data theo option da chon
        public function optionTableStatistic(){
            $opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			switch ($opStatistic) {
				case "newCustomersSL":
					$table="customers";
					break;
				case "newOrdersSL":
					$table="orders";
					break;
				case "ordersSuccessSL":
					$table="orders";
					break;
				case "ordersWaitingSL":
					$table="orders";
					break;
				case "ordersCancelSL":
					$table="orders";
					break;
				case "newProductsSL":
					$table="products";
					break;
				case "newOrdersVND":
					$table="orders";
					break;
				case "ordersSuccessVND":
					$table="orders";
					break;
				case "ordersWaitingVND":
					$table="orders";
					break;
				case "ordersCancelVND":
					$table="orders";
					break;
				case "newProductsVND":
					$table="products";
					break;
				default:
					$table="customers";
			}
            return $table;
        }
        //ham dieu kien loc theo thoi gian
        public function optionTimeType(){
            $opTimeType=isset($_POST["opStatistic"])?$_POST['opTimeType']:'';
			switch ($opTimeType) {
				case "byDate":
					$dateBegin=$_POST['dateBegin'];
					$dateEnd=$_POST['dateEnd'];
					$condition="  createdate between '$dateBegin' and '$dateEnd' ";
					break;
				case "byMonth":
					$opMonth=$_POST['opMonth'];
					$opYear=$_POST['opYear'];
					$condition="  month(createdate)='$opMonth' and year(createdate)='$opYear'";
					break;
				case "byQuarter":
					$opQuarter=$_POST['opQuarter'];
					$opYear=$_POST['opYear'];
					$condition="  quarter(createdate)=$opQuarter and year(createdate)='$opYear'";
					break;
				case "byYear":
					$opYear=$_POST['opYear'];
					if($opYear=='allyear'){
						$condition=' id>=0';
					}else{
						$condition=" year(createdate)='$opYear'";
					}
					break;
				default:
					$condition="";
			}
            return $condition;
        }

		//ham lay bang cau lenh query theo option da chon
        public function optionsStatistic(){
            $opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			switch ($opStatistic) {
				case "newCustomersSL":
					$query="select count(id) as dataset from customers where ";
					break;
				case "newOrdersSL":
					$query="select count(id) as dataset from orders where ";
					break;
				case "ordersSuccessSL":
					$query="select count(id) as dataset from orders where status=1 ";
					break;
				case "ordersWaitingSL":
					$query="select count(id) as dataset from orders where status=0 ";
					break;
				case "ordersCancelSL":
					$query="select count(id) as dataset from orders where status=2 ";
					break;
				case "newProductsSL":
					$query="select count(id) as dataset from products where ";
					break;
				case "newOrdersVND":
					$query="select sum(price) as dataset from orders where ";
					break;
				case "ordersSuccessVND":
					$query="select sum(price) as dataset from orders where status=1 ";
					break;
				case "ordersWaitingVND":
					$query="select sum(price) as dataset from orders where status=0 ";
					break;
				case "ordersCancelVND":
					$query="select sum(price) as dataset from orders where status=2 ";
					break;
				case "newProductsVND":
					$query="select sum(price) as dataset from products where ";
					break;
				default:
				$query="";
			}
            return $query;
        }
        
		//ham lay tat ca ban ghi
		public function modelAll(){
			$condition=$this->optionTimeType();
			$table=$this->optionsStatistic();
			$opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			if($opStatistic=="newCustomersSL"||$opStatistic=="newOrdersSL"||$opStatistic=="newProductsSL"||$opStatistic=="newOrdersVND"||$opStatistic=="newProductsVND"){
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table  $condition");
			}else{
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table and $condition");
			}
			//lay ket qua tra ve
			$result = $query->fetch();
            return $result;
		}

		//ham lay ban ghi theo ngay
		public function modelByDate($createdate){
			$table=$this->optionsStatistic();
			$opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			if($opStatistic=="newCustomersSL"||$opStatistic=="newOrdersSL"||$opStatistic=="newProductsSL"||$opStatistic=="newOrdersVND"||$opStatistic=="newProductsVND"){
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table createdate='$createdate'");
			}else{
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table  and createdate='$createdate'");
			}
			//lay ket qua tra ve
			$result = $query->fetch();
            return $result;
		}

		//ham lay ban ghi theo thang
		public function modelByMonth($opMonth){
			$table=$this->optionsStatistic();
			$opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			$opYear=$_POST['opYear'];
			if($opStatistic=="newCustomersSL"||$opStatistic=="newOrdersSL"||$opStatistic=="newProductsSL"||$opStatistic=="newOrdersVND"||$opStatistic=="newProductsVND"){
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table  month(createdate)='$opMonth' and year(createdate)='$opYear'");
			}else{
				//lay bien ket noi
				$conn = Connection::getInstance();
				$query = $conn->query(" $table and month(createdate)='$opMonth' and year(createdate)='$opYear'");
			}
			//lay ket qua tra ve
			$result = $query->fetch();
            return $result;
		}

		//ham lay ban ghi theo thang
		public function modelByYear($opYear){
			$table=$this->optionsStatistic();
			$opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			if($opYear=="allyear"){
				if($opStatistic=="newCustomersSL"||$opStatistic=="newOrdersSL"||$opStatistic=="newProductsSL"||$opStatistic=="newOrdersVND"||$opStatistic=="newProductsVND"){
					//lay bien ket noi
					$conn = Connection::getInstance();
					$query = $conn->query(" $table id>=0 ");
				}else{
					//lay bien ket noi
					$conn = Connection::getInstance();
					$query = $conn->query(" $table ");
				}
			}else{
				if($opStatistic=="newCustomersSL"||$opStatistic=="newOrdersSL"||$opStatistic=="newProductsSL"||$opStatistic=="newOrdersVND"||$opStatistic=="newProductsVND"){
					//lay bien ket noi
					$conn = Connection::getInstance();
					$query = $conn->query(" $table year(createdate)='$opYear'");
				}else{
					//lay bien ket noi
					$conn = Connection::getInstance();
					$query = $conn->query(" $table and  year(createdate)='$opYear'");
				}
					
			}
			//lay ket qua tra ve
			$result = $query->fetch();
            return $result;
		}
    }
?>