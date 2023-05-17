<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
    $_SESSION['product_id']=$_GET['id'];
 ?>
 <div style="margin-bottom:5px;">
    <input onclick="window.location=('index.php?controller=products')" type="button" value="Back" class="btn btn-danger">
    <a href="index.php?controller=products&action=createTypes&product_id=<?php echo $_SESSION['product_id'];?>" class="btn btn-primary">Add Types</a>
</div>  
<div class="panel panel-primary">
    <div class="panel-heading">List Product Types</div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th >Ảnh</th>
                <th >Màu sắc</th>
                <th >Số lượng</th>
                <th style="width:120px;text-align:center;">Chức năng</th>
            </tr>
            <?php foreach($data as $rows): ?>
            <tr>
                <td style="text-align: center;">
                    <?php if(file_exists("../assets/upload/products/".$rows->photo)): ?>
                    <img src="../assets/upload/products/<?php echo $rows->photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td><?php echo $rows->color ?></td>
                <td style="text-align: center;"><?php echo $rows->quantity; ?></td>
                <td style="text-align:center;">
                    <a href="index.php?controller=products&action=updateTypes&id=<?php echo $rows->id; ?>">Cập nhật</a><br/>
                    <a href="index.php?controller=products&action=deleteTypes&id=<?php echo $rows->id; ?>" 
                    onclick="return window.confirm('Are you sure?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
