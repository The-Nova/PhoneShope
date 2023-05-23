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
                             if($rows->status==2) echo "Đơn bị hủy";
                        ?>
                    </td>
                    <td><?php echo $rows->size_status; ?></td>
                    <td><?php echo number_format($rows->pricecount );?> ₫</td>
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
                                    if($rows->status==2) echo "Đơn bị hủy (VND)";
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
                            <td><?php echo number_format($valuebilldate); ?> ₫</td>
                            <td><?php echo number_format($valuebillmonth); ?> ₫</td>
                            <td><?php echo number_format($valuebillmonthn); ?> ₫</td>
                            <td><?php echo number_format($valuebillyear); ?> ₫</td>
                            <td><?php echo number_format($valuebilltotal); ?> ₫</td>
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
        <div class="panel panel-primary">
            <div class="panel-heading">Danh sách sản phẩm bán chạy</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                <tr>
                <th>STT</th>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th >Giá gốc (VND)</th>
                <th style="width: 80px;">Giảm giá(%)</th>
                <th style="width: 80px;">Số lượng đã bán</th>
                <th style="width: 50px;">Hot</th>
                <th>Ngày thêm</th>
            </tr>
            <?php $i=1; foreach($dataBestSale as $products): ?>
            <tr>
                <td><?php echo $i;$i=$i+1;?></td>
                <td style="text-align: center;">
                    <?php if(file_exists("../assets/upload/products/".$products->photo)): ?>
                    <img src="../assets/upload/products/<?php echo $products->photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td><?php echo $products->name ?>
                </td>
                <td style="text-align: center;"><?php echo number_format($products->price); ?> ₫</td>
                <td style="text-align: center;"><?php echo $products->discount; ?></td>
                <td style="text-align: center;"><?php echo $products->sumcount; ?></td>
                <td style="text-align: center;"><?php if($products->hot==1): ?><span class="fa fa-check"></span><?php endif; ?></td>
                <td style="text-align: center;">
                    <?php 
                        $date = Date_create($products->createdate);
                        echo Date_format($date, "d/m/Y");
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
                </table>
                <style type="text/css">
                    .pagination{padding:0px; margin:0px;}
                </style>
            </div>
        </div>
    </div>
 </div>
