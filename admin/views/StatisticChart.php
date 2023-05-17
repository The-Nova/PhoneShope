<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<div class="col-md-12"><h4>
    <?php 
        $opStatistic=isset($_POST["opStatistic"])?$_POST["opStatistic"]:'';
			switch ($opStatistic) {
				case "newCustomersSL":
					$opStatistic_name="số khách hàng mới";
                    $opStatistic_isPrice=0;
                    $opStatistic_status="";
					break;
				case "newOrdersSL":
					$opStatistic_name="số hóa đơn mới";
                    $opStatistic_isPrice=0;
                    $opStatistic_status="";
					break;
				case "ordersSuccessSL":
					$opStatistic_name="số hóa đơn giao hàng thành công";
                    $opStatistic_status=1;
                    $opStatistic_isPrice=0;
					break;
				case "ordersWaitingSL":
					$opStatistic_name="số hóa đơn đang chờ";
                    $opStatistic_status=0;
                    $opStatistic_isPrice=0;
					break;
				case "ordersCancelSL":
					$opStatistic_name="số hóa đơn bị hủy";
                    $opStatistic_status=2;
                    $opStatistic_isPrice=0;
					break;
				case "newProductsSL":
					$opStatistic_name="số sản phẩm mới";
                    $opStatistic_isPrice=0;
                    $opStatistic_status="";
					break;
				case "newOrdersVND":
					$opStatistic_name="số tiền của hóa đơn mới";
                    $opStatistic_isPrice=1;
                    $opStatistic_status="";
					break;
				case "ordersSuccessVND":
					$opStatistic_name="số tiền của hoá đơn đã giao hàng";
                    $opStatistic_status=1;
                    $opStatistic_isPrice=1;
					break;
				case "ordersWaitingVND":
					$opStatistic_name="số tiền của hóa đơn đang đợi";
                    $opStatistic_status=0;
                    $opStatistic_isPrice=1;
					break;
				case "ordersCancelVND":
					$opStatistic_name="số tiền của hóa đơn bị hủy";
                    $opStatistic_status=2;
                    $opStatistic_isPrice=1;
					break;
				case "newProductsVND":
					$opStatistic_name="số tiền của các sản phẩm mới";
                    $opStatistic_isPrice=1;
                    $opStatistic_status="";
					break;
				default:
					$opStatistic_name="";
                    $opStatistic_status="";
                    $opStatistic_isPrice="";
			}
            $opTimeType=isset($_POST["opStatistic"])?$_POST['opTimeType']:'';
			switch ($opTimeType) {
				case "byDate":
                    $dateBegin = date_format(date_create($_POST['dateBegin']),'d/m/20y');
                    $dateEnd=date_format(date_create($_POST['dateEnd']),'d/m/20y');
					$condition_name=" từ ngày $dateBegin tới ngày $dateEnd ";
                    $xName="Ngày";
					break;
				case "byMonth":
                    $month=$_POST['opMonth'];
                    $year=$_POST['opYear'];
					$condition_name=" trong tháng $month năm $year ";
                    $xName="Ngày";
					break;
				case "byQuarter":
                    $quarter=$_POST['opQuarter'];
                    if($quarter==1){
                        $quarter="I";
                    }elseif($quarter==2){
                        $quarter="II";
                    }elseif($quarter==3){
                        $quarter="III";
                    }else{
                        $quarter="IV";
                    }
                    $year=$_POST['opYear'];
					$condition_name=" trong quý $quarter năm $year ";
                    $xName="Tháng";
					break;
				case "byYear":
                    $year=$_POST['opYear'];
                    if($year=='allyear') {
                        $condition_name=" từ trước tới nay ";
                        $xName="Năm";
                    }else{
                        $condition_name=" trong năm $year ";
                        $xName="Tháng";
                    }
					
					break;
				default:
					$condition_name="";
                    $xName="";
			}
            if(!empty($this->optionTableStatistic())&&!empty($this->optionTimeType())){
                $total=$this->modelAll()->dataset;          
            }
            if(empty($total)){
                $total=0;
            }  
        echo 'Biểu đồ '.$opStatistic_name .' '. $condition_name." (Tổng: ".number_format($total).")";
    ?>
</h4></div>

<div class="col-md-12">
    <div>
        <canvas id="myChart2" class="mt-2" style="width:100%;max-width:1100px;max-height:500px;"></canvas>
    </div>
</div>
<script>
    const xValues = [
        <?php
            echo "'".$xName."',";
            if($_POST['opTimeType']=='byDate'){
                $date = $_POST['dateBegin'];
                $date=date('Y-m-d', strtotime($date. ' - 1  days'));
                while ($date < $_POST['dateEnd']) {
                    $date=date('Y-m-d', strtotime($date. ' + 1 days'));
                    echo "'".date_format(date_create($date),'d-m-20y')."',";
                }
            }
            
            if($_POST['opTimeType']=='byMonth'){
                $mounth=$_POST['opMonth'];
                $year=$_POST['opYear'];
                $numDays= $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
                for($i=1;$i<=$numDays;$i++){
                    $newdate= date("20y-m-d", mktime(0,0,0,$month,$i,$year));
                    echo "'".date_format(date_create($newdate),'d')."',";
                }
            }  

            if($_POST['opTimeType']=='byQuarter'){
                $quarter=$_POST['opQuarter'];
                $year=$_POST['opYear'];
                if($quarter==1){
                    $numMonth=3;
                }elseif($quarter==2){
                    $numMonth=6;
                }elseif($quarter==3){
                    $numMonth=9;
                }else{
                    $numMonth=9;
                }
                for($i=$numMonth-2;$i<=$numMonth;$i++){
                    echo "'".$i."',";
                }
            }
            
            if($_POST['opTimeType']=='byYear'){
                $year=$_POST['opYear'];
                if($year=='allyear') {
                    foreach($dataYears as $rows){
                         echo $rows->years.",";
                    }    
                }else{
                    for($i=1;$i<=12;$i++){
                        echo "'".$i."',";
                    }
                }
            }
            
        ?>
    ];

    new Chart("myChart2", {
    type: "line",
    yMin: 0,
    data: {
        labels: xValues,
        datasets: [{ 
        data: [0,
            <?php
                if($_POST['opTimeType']=='byDate'){
                    $date = $_POST['dateBegin'];
                    $date=date('Y-m-d', strtotime($date. ' - 1  days'));
                    while ($date <= $_POST['dateEnd']) {
                        $date=date('Y-m-d', strtotime($date. ' + 1 days'));
                        $dataset=$this->modelByDate($date)->dataset;
                        if(empty($dataset)) $dataset=0;
                        echo $dataset.",";
                    }
                }
            
                if($_POST['opTimeType']=='byMonth'){
                    $mounth=$_POST['opMonth'];
                    $year=$_POST['opYear'];
                    $numDays= $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
                    for($i=1;$i<=$numDays;$i++){
                        $newdate= date("y-m-d", mktime(0,0,0,$month,$i,$year));
                        $dataset=$this->modelByDate($newdate)->dataset;
                        if(empty($dataset)) $dataset=0;
                        echo $dataset.",";
                    }
                }
            
                if($_POST['opTimeType']=='byQuarter'){
                    $quarter=$_POST['opQuarter'];
                    $year=$_POST['opYear'];
                    if($quarter==1){
                        $numMonth=3;
                    }elseif($quarter==2){
                        $numMonth=6;
                    }elseif($quarter==3){
                        $numMonth=9;
                    }else{
                        $numMonth=12;
                    }
                    for($i=$numMonth-2;$i<=$numMonth;$i++){
                        $dataset=$this->modelByMonth($i)->dataset;
                        if(empty($dataset)) $dataset=0;
                        echo $dataset.",";
                    }
                }

                if($_POST['opTimeType']=='byYear'){
                    $year=$_POST['opYear'];
                    if($year=='allyear') {
                        foreach($dataYears as $rows){
                            $dataset=$this->modelByYear($rows->years)->dataset;
                            if(empty($dataset)) $dataset=0;
                            echo $dataset.",";                         
                        }    
                    }else{
                        for($i=1;$i<=12;$i++){
                            $dataset=$this->modelByMonth($i)->dataset;
                            if(empty($dataset)) $dataset=0;
                            echo $dataset.",";
                        }
                    }
                    
                }
            ?>
        ],
        borderColor: "#F45050",
        fill: false
        }],
    },
    options: {
        legend: {display: false}
    }
    });
</script>