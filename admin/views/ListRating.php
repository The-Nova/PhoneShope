<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
<div class="panel panel-primary" style="margin-top: 10px;">
    <div class="panel-heading">List Rating Products</div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="width: 100px;">Ảnh</th>
                <th >Tên sản phẩm</th>
                <th >Thể loại</th>
                <th >Đánh giá</th>
                <th style="width:120px;text-align:center;">Chức năng</th>
            </tr>
            <?php foreach($data as $rows): ?>
            <tr>
                <td style="text-align: center;">
                    <?php if(file_exists("../assets/upload/products/".$rows->product_photo)): ?>
                    <img src="../assets/upload/products/<?php echo $rows->product_photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td><?php echo $rows->product_name ?>
                </td>
                <td><?php echo $this->getCategory($rows->category_id); ?></td>
                <td style="text-align: center;"><?php echo $this->modelGetRating($rows->id)->avg_star; ?> 
                    <i class="fa fa-star" aria-hidden="true"></i>/5</td>
                <td style="text-align:center;">
                    <a href="index.php?controller=rating&action=detail&product_id=<?php echo $rows->id; ?>">Xem chi tiết</a>
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
                <a href="index.php?controller=rating<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                    ?>&page=<?php echo $i; ?>" class="page-link">
                    <?php echo $i; ?>
                </a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
