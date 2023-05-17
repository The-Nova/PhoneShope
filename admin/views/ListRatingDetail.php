<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
    $_SESSION['product_id']=$_GET['product_id'];
 ?>
<div style="margin-bottom:5px;">
    <input onclick="window.location=('index.php?controller=rating')" type="button" value="Back" class="btn btn-danger">
</div>
<div class="panel panel-primary" style="margin-top: 10px;">
    <div class="panel-heading">List Rating Detail</div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="width: 150px;">Tên sản phẩm</th>
                <th style="width: 70px;">Đánh giá</th>
                <th style="width:150px;">Tên người đánh giá</th>
                <th>Nhận xét</th>
                <th style="width: 90px;">Ngày</th>
                <th style="width:120px;text-align:center;">Chức năng</th>
            </tr>
            <?php foreach($data as $rows): ?>
            <tr>
                <td><?php echo $rows->product_name ?>
                </td>
                <td style="text-align: center;"><?php echo $rows->star; ?> 
                    <i class="fa fa-star" aria-hidden="true"></i></td>
                <td style="text-align: center;"><?php echo $rows->customer_name; ?></td>
                <td><?php echo $rows->comment ?></td>
                <td>
                    <?php 
                        $date = Date_create($rows->createdate);
                        echo Date_format($date, "d/m/Y");
                    ?>
                </td>
                <td style="text-align:center;">
                    <a href="index.php?controller=rating&action=delete&id=<?php echo $rows->id; ?>"
                    onclick="return window.confirm('Are you sure?');">Xóa</a>
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
                <a href="index.php?controller=rating&action=detail&product_id=<?php  echo $_GET['product_id'];
                ?>&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
