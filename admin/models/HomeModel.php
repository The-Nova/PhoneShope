<?php
    require '../assets/phpexcel/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
        //ham lay data theo nam
        public function modeldatayear($year,$table){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select * FROM $table where year(createdate)='$year'");
            //ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
        }
        //ham lay san pham ban chay
        public function modelBestseller(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select p.id as id,p.hot as hot,p.name as name,p.photo as photo,p.price as price,p.discount as discount,
            sum(orderdetails.quantity) as sumcount,p.createdate as createdate FROM products p,types,orderdetails WHERE orderdetails.type_id=types.id 
            AND p.id=types.product_id GROUP BY types.product_id ORDER by sumcount DESC LIMIT 20");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }
        
        //ham ghi file excel
        public function handle()
        {
            $date= date("y-m-d");
            $tablecustomers='customers';
            $tableorders='orders';
            $tablenews='news';
            $tableproducts='products';
            $year=date("20y");
            $month=date("m");
            // Bước 1: 
            // Lấy dữ liệu từ database
            $data = array(
                array(
                    'Khách hàng mới', $this->modelTotal($tablecustomers),0
                ),
                array(
                    'Hóa đơn mới', $this->modelTotal($tableorders),0
                ),
                array(
                    'Hóa đơn chưa giao',0, $this->modelTotalPrice(0)->pricecount
                ),
                array(
                    'Hóa đơn đã giao',0, $this->modelTotalPrice(1)->pricecount
                ),
                array(
                    'Hóa đơn bị hủy',0, $this->modelTotalPrice(2)->pricecount
                ),
                array(
                    'Sản phẩm mới', $this->modelTotal($tableproducts),0
                ),
                array(
                    'Tin tức mới', $this->modelTotal($tablenews),0
                )

            );
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
                // Tạo tiêu đề
                $sheet
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Mục')
                    ->setCellValue('C1', 'Số lượng')
                    ->setCellValue('D1', 'Giá trị (VND)');
                
                // Ghi dữ liệu
                $rowNumber = 2;
                foreach ($data as $index => $item) 
                {
                    // A1, A2, A3, ...
                    $sheet->setCellValue('A' . $rowNumber, ($index + 1));
                    
                    // B1, B2, B3, ...
                    $sheet->setCellValue('B' . $rowNumber, $item[0]);
                
                    // C1, C2, C3, ...
                    $sheet->setCellValue('C' . $rowNumber, $item[1]);

                    // D1, D2, D3, ...
                    $sheet->setCellValue('D' . $rowNumber, $item[2]);
                    
                    // Tăng row lên để khỏi bị lưu đè
                    $rowNumber++;
                }
                // Xuất file
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->setOffice2003Compatibility(true);
                $filename='Báo cáo ngày '.date("d-m-Y").time().".xlsx";
                $writer->save($filename);
                header("location:".$filename);
        }     
    }
?>