<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
 <div class="panel panel-primary">
        <div class="panel-heading">List Customers</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngày tạo Tài Khoản</th>
                    <th style="width:150px;text-align:center;">Chức năng</th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name; ?></td>
                    <td><?php echo $rows->email; ?></td>
                    <td><?php echo $rows->phone; ?></td>
                    <td><?php echo Date_format(Date_create($rows->createdate), "d/m/Y"); ?></td>
                    <td style="text-align:center;">
                        <a href="index.php?controller=Customers&action=viewdetail&id=<?php echo $rows->id; ?>">Xem chi tiết</a>&nbsp;||
                        <a href="index.php?controller=Customers&action=delete&id=<?php echo $rows->id; ?>" class="<?php if($_SESSION["email"]== $rows->email){
                            echo "hidden";}?>" onclick="return window.confirm('Are you sure?');">Xóa</a>
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
                <a href="index.php?controller=customers<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                    if (!empty($_REQUEST['search'])) { echo "&search="; echo $_REQUEST['search']; };
                    if (!empty($_REQUEST['filter'])) { echo "&filter="; echo $_REQUEST['filter']; };?>&page=<?php echo $i; ?>" class="page-link">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
        </div>
    </div>