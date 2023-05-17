<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
<div class="panel panel-primary">
    <div class="panel-heading">List Products</div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th style="width:120px;">Thể loại</th>
                <th style="width: 100px;">Giá gốc (VND)</th>
                <th style="width: 50px;">Giảm giá(%)</th>
                <th style="width: 30px;">Hot</th>
                <th style="width: 90px;">Ngày thêm</th>
                <th style="width:120px;text-align:center;">Chức năng</th>
            </tr>
            <?php foreach($data as $rows): ?>
            <tr>
                <td style="text-align: center;">
                    <?php if(file_exists("../assets/upload/products/".$rows->photo)): ?>
                    <img src="../assets/upload/products/<?php echo $rows->photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td><?php echo $rows->name ?>(<?php echo $this->modelGetRating($rows->id)->avg_star; ?> 
                    <i class="fa fa-star" aria-hidden="true"></i>/5)
                </td>
                <td><?php echo $this->getCategory($rows->category_id); ?></td>
                <td style="text-align: center;"><?php echo number_format($rows->price); ?> ₫</td>
                <td style="text-align: center;"><?php echo $rows->discount; ?></td>
                <td style="text-align: center;"><?php if($rows->hot==1): ?><span class="fa fa-check"></span><?php endif; ?></td>
                <td>
                    <?php 
                        $date = Date_create($rows->createdate);
                        echo Date_format($date, "d/m/Y");
                    ?>
                </td>
                <td style="text-align:center;">
                    <a href="index.php?controller=products&action=update&id=<?php echo $rows->id; ?>">Cập nhật</a> | | 
                    <a href="index.php?controller=products&action=delete&id=<?php echo $rows->id; ?>" 
                    onclick="return window.confirm('Are you sure?');">Xóa</a><br/><br/>
                    <a href="index.php?controller=products&action=listTypes&id=<?php echo $rows->id; ?>">Kiểu dáng</a>
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
                <a href="index.php?controller=products<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                    if (!empty($_REQUEST['search'])) { echo "&search="; echo $_REQUEST['search']; };
                    if (!empty($_REQUEST['filter'])) { echo "&filter="; echo $_REQUEST['filter']; };?>&page=<?php echo $i; ?>" class="page-link">
                    <?php echo $i; ?>
                </a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
