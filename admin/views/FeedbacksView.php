<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
 ?>
<div class="col-md-12 mt-2">
    <div class="row">
        <div class=" col-md-8" style="margin-bottom:5px;">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" 
            action="index.php?controller=feedbacks&action=btnFilterDate&filter=<?php if (!empty($_REQUEST['filter'])) {echo $_REQUEST['filter'];   }else{echo date('20y/m/d'); }?>">
                <input class="form-control mr-sm-2" type="date" aria-label="filter" name="filter" 
                value="<?php if(!empty($_REQUEST['filter'])) { echo $_REQUEST['filter'];  } else{ echo date('20y/m/d'); }?>">
                <button class="btn btn-info my-2 my-sm-0" type="submit" name="smfilter">Filter date</button>
            </form>
        </div>
        <div class=" col-md-4">
            <form class="form-inline" style="float:right;" method="post" enctype="multipart/form-data" 
            action="index.php?controller=feedbacks&action=btnSearch&search=<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="search" 
                value="<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <button class="btn btn-primary " type="submit" name="submit" >Search</button>
            </form>
        </div>
    </div>
    <div class="panel panel-primary" style="margin-top: 10px;">
        <div class="panel-heading">List Feedbacks</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Đã xem</th>
                    <th>Ngày gửi</th>
                    <th>Chức năng</th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name;?></td>
                    <td><?php echo $rows->email; ?></td>
                    <td><?php echo $rows->content; ?></td>
                    <td>
                        <?php if($rows->seen == 0): ?>
                            <a href="index.php?controller=feedbacks&action=watched&id=<?php echo $rows->id; ?>" class="label label-info">Chưa xem</a>
                        <?php else: ?>
                            <a href="#" class="label label-info">Đã xem</a>
                        <?php endif; ?>  
                    </td>
                    <td>
                        <?php 
                            $date = Date_create($rows->createdate);
                            echo Date_format($date, "d/m/Y");
                        ?>
                    </td>
                    <td style="text-align:center;">
                        <a href="index.php?controller=feedbacks&action=delete&id=<?php echo $rows->id; ?>">Xóa</a>
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
                    <a href="index.php?controller=feedbacks<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                        ?>&page=<?php echo $i; ?>" class="page-link">
                        <?php echo $i; ?>
                    </a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>