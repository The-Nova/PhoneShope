<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
<div class="panel panel-primary">
<div class="panel-heading">List News</div>
<div class="panel-body">
    <table class="table table-bordered table-hover">
        <tr>
            <th style="width: 100px;">Ảnh</th>
            <th>Tiêu đề</th>
            <th>Người viết</th>
            <th>Ngày viết</th>
            <th style="width:70px;">Hot</th>
            <th style="width:150px;text-align:center;">Chức năng</th>
        </tr>
        <?php foreach($data as $rows): ?>
        <tr>
            <td style="text-align: center;">
                <?php if(file_exists("../assets/upload/news/".$rows->photo)): ?>
                <img src="../assets/upload/news/<?php echo $rows->photo; ?>" style="width: 100px;">
                <?php endif; ?>
            </td>
            <td><?php echo $rows->name ?></td>
            <td><?php echo $this->modelGetcreatedby($rows->createdby)->name;?></td>
            <td><?php echo Date_format(Date_create($rows->createdate), "d/m/Y"); ?></td>
            <td style="text-align: center;"><?php if($rows->hot==1): ?><span class="fa fa-check"></span><?php endif; ?></td>
            <td style="text-align:center;" >
                <?php if($_SESSION["role"]<=$rows->roleaccept): ?>
                    <a href="index.php?controller=news&action=update&id=<?php echo $rows->id; ?>">Cập nhật</a>&nbsp;||
                    <a href="index.php?controller=news&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');">Xóa</a>
                <?php else :?>
                    <a href="index.php?controller=news&action=detailview&id=<?php echo $rows->id; ?>">Xem chi tiết</a>
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
            <li class="page-item">
                <a href="index.php?controller=news<?php if(isset($_GET['action'])) {echo "&action=";echo $_GET['action'];};
                    if (!empty($_REQUEST['search'])) { echo "&search="; echo $_REQUEST['search']; };
                    if (!empty($_REQUEST['filter'])) { echo "&filter="; echo $_REQUEST['filter']; };?>&page=<?php echo $i; ?>" class="page-link">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</div>