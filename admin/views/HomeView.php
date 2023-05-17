<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
    $_SESSION["keyword"]="";
 ?>
 <div class="col-md-12">
    <?php if($_SESSION["role"]== 1||$_SESSION["role"]== 2):?>
    <div class="panel panel-primary">
        <div class="panel-heading">Thống kê hóa đơn</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                    <th>Tổng giá trị(VND)</th>
                </tr>
                <?php foreach($databil as $rows): ?>
                <tr>
                    <td>
                        <?php
                             if($rows->status==1) echo "Đã giao hàng";
                             if($rows->status==0) echo "Chưa giao hàng";
                             if($rows->status==2) echo "Hủy đơn hàng";
                        ?>
                    </td>
                    <td><?php echo $rows->size_status ?></td>
                    <td><?php echo $rows->pricecount ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
        </div>
    </div>
    <?php endif;?>
     <div class="panel panel-primary">
        <div class="panel-heading">Thống kê</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <?php
                    $date= date("y-m-d");
                    $tablecustomers='customers';
                    $tableorders='orders';
                    $tablenews='news';
                    $tableproducts='products';
                    $year=date("20y");
                    $month=date("m");
                ?>
                <tr>
                    <th>Mục</th>
                    <th>Trong ngày (<?php echo date("d"); ?>)</th>
                    <th>Tháng trước (<?php echo $month-1; ?>)</th>
                    <th>Trong tháng (<?php echo $month; ?>)</th>
                    <th>Trong năm (<?php echo $year; ?>)</th>
                    <th>Tất cả (từ trước tới nay)</th>
                </tr>
                <?php if($_SESSION["role"]== 1||$_SESSION["role"]== 2):?>
                    <tr>
                        <td>Khách hàng mới</td>
                        <td><?php echo $this->modeldatadate($date,$tablecustomers); ?></td>
                        <td><?php echo $this->modeldatamonth($month-1,$year,$tablecustomers); ?></td>
                        <td><?php echo $this->modeldatamonth($month,$year,$tablecustomers); ?></td>
                        <td><?php echo $this->modeldatayear($year,$tablecustomers); ?></td>
                        <td><?php echo $this->modelTotal($tablecustomers); ?></td>
                    </tr>
                    <tr>
                        <td>Hóa đơn mới</td>
                        <td><?php echo $this->modeldatadate($date,$tableorders); ?></td>
                        <td><?php echo $this->modeldatamonth($month-1,$year,$tableorders); ?></td>
                        <td><?php echo $this->modeldatamonth($month,$year,$tableorders); ?></td>
                        <td><?php echo $this->modeldatayear($year,$tableorders); ?></td>
                        <td><?php echo $this->modelTotal($tableorders); ?></td>
                    </tr>
                    <?php 
                    foreach($databil as $rows): ?>
                        <tr>
                            <td>
                                <?php
                                    if($rows->status==1) echo "Đã giao hàng (VND)";
                                    if($rows->status==0) echo "Chưa giao hàng (VND)";
                                    if($rows->status==2) echo "Hủy đơn hàng (VND)";
                                ?>
                            </td>
                            <?php
                                    $valuebilldate=$this->modelvalueBilldate($date,$rows->status)->pricecount;
                                    $valuebillmonth=$this->modelvalueBillmonth($month-1,$year,$rows->status)->pricecount;
                                    $valuebillmonthn=$this->modelvalueBillmonth($month,$year,$rows->status)->pricecount;
                                    $valuebillyear=$this->modelvalueBillyear($year,$rows->status)->pricecount;
                                    $valuebilltotal=$this->modelTotalPrice($rows->status)->pricecount;
                                    if($valuebilldate=='') {$valuebilldate=0;};
                                    if($valuebillmonth=='') {$valuebillmonth=0;}
                                    if($valuebillmonthn=='') {$valuebillmonthn=0;}
                                    if($valuebillyear=='') {$valuebillyear=0;}
                                    if($valuebilltotal=='') {$valuebilltotal=0;}
                                ?>
                            <td><?php echo $valuebilldate; ?></td>
                            <td><?php echo $valuebillmonth; ?></td>
                            <td><?php echo $valuebillmonthn; ?></td>
                            <td><?php echo $valuebillyear; ?></td>
                            <td><?php echo $valuebilltotal; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
                <?php if($_SESSION["role"]== 1||$_SESSION["role"]== 3):?>
                <tr>
                    <td>Sản phẩm mới</td>
                    <td><?php echo $this->modeldatadate($date,$tableproducts); ?></td>
                    <td><?php echo $this->modeldatamonth($month-1,$year,$tableproducts); ?></td>
                    <td><?php echo $this->modeldatamonth($month,$year,$tableproducts); ?></td>
                    <td><?php echo $this->modeldatayear($year,$tableproducts); ?></td>
                    <td><?php echo $this->modelTotal($tableproducts); ?></td>
                </tr>
                <tr>
                    <td>Tin tức mới</td>
                    <td><?php echo $this->modeldatadate($date,$tablenews); ?></td>
                    <td><?php echo $this->modeldatamonth($month-1,$year,$tablenews); ?></td>
                    <td><?php echo $this->modeldatamonth($month,$year,$tablenews); ?></td>
                    <td><?php echo $this->modeldatayear($year,$tablenews); ?></td>
                    <td><?php echo $this->modelTotal($tablenews); ?></td>
                </tr>
                <?php endif;?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
        </div>
        </div>
    </div>
 </div>
