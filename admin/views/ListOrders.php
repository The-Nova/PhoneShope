<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php"; ?>

<div class="panel panel-primary">
    <div class="panel-heading">List Orders</div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="width:100px;">Mã hóa đơn</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th style="width:120px;">Ngày thanh toán</th>
                <th style="width:100px;">Ngày mua</th>
                <th>Tổng giá trị</th>
                <th style="width:150px; text-align: center;">Trạng thái</th>
                <th style="width:150px;text-align: center;">Delivery</th>
            </tr>
            <?php foreach($listRecord as $rows): ?>
            <?php   
                //lay ban ghi customer
                $customer = $this->modelGetCustomers($rows->customer_id);
                ?>
                <tr>
                    <td><?php echo $rows->id; ?></td>
                    <td><?php echo $customer->name; ?></td>
                    <td><?php echo $customer->phone; ?></td>
                    <td>
                    <?php 
                    if($rows->datepay=="0000-00-00")
                        echo "Chưa thanh toán";
                    else { 
                        $date = Date_create($rows->datepay);
                        echo Date_format($date, "d/m/Y");
                    }
                    ?>                            
                </td>
                <td>
                    <?php 
                        $date = Date_create($rows->createdate);
                        echo Date_format($date, "d/m/Y");
                    ?>                            
                </td>
                <td><?php echo number_format($rows->price); ?> ₫</td>
                    <td style="text-align: center;">
                        <?php if($rows->status == 1): ?>
                        <span class="label label-primary">Đã giao hàng</span>
                        <?php elseif ($rows->status == 0) : ?>
                        <span class="label label-danger">Chưa giao hàng</span>
                    <?php else: ?>
                        <span class="label label-warning">Đơn bị hủy</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="index.php?controller=orders&action=detail&id=<?php echo $rows->id; ?>" class="label label-success">Chi tiết</a>
                        <?php if($rows->status == 0): ?>
                            <a href="index.php?controller=orders&action=delivery&id=<?php echo $rows->id; ?>" class="label label-info">Giao hàng</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <style type="text/css">
            .pagination{padding:0px; margin:0px;}
        </style>
        <ul class="pagination">
            <li class="page-item disabled"><a href="#" class="page-link">Trang</a></li>
            <?php for($i = 1; $i <= $numPage; $i++): ?>
            <li class="page-item">
                <a href="index.php?controller=orders<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                    if (!empty($_REQUEST['search'])) { echo "&search="; echo $_REQUEST['search']; };
                    if (!empty($_REQUEST['filter'])) { echo "&filter="; echo $_REQUEST['filter']; };
                    if (!empty($_REQUEST['status'])) { echo "&status="; echo $_REQUEST['status']; };?>&page=<?php echo $i; ?>" class="page-link">
                    <?php echo $i; ?>
                </a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>