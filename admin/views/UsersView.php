<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=users&action=create" class="btn btn-primary">Add user</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List Users</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Chức vụ</th>
                    <th>Ngày tạo</th>
                    <th style="width:120px;text-align:center;">Chức năng</th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name ?></td>
                    <td><?php echo $rows->email ?></td>
                    <td><?php if($rows->role== 1){
                            echo "Admin";
                        } elseif ($rows->role== 2) {
                            echo "Chăm sóc khách hàng";
                        } else {
                            echo "Quản lý khác";
                        } ?></td>
                    <td><?php echo Date_format(Date_create($rows->createdate), "d/m/Y"); ?></td>
                    <td style="text-align:center;">
                        <a href="index.php?controller=users&action=update&id=<?php echo $rows->id; ?>">Cập nhật</a>&nbsp;
                        <?php if($rows->id!= 1):?>|| 
                        <a href="index.php?controller=users&action=delete&id=<?php echo $rows->id; ?>" 
                            onclick="return window.confirm('Are you sure?');"> Xóa </a>
                        <?php endif;?>
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
            	<li class="page-item"><a href="index.php?controller=users&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
            	<?php endfor; ?>
            </ul>
        </div>
    </div>
</div>