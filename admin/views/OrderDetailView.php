<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php"; ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
    <input onclick="window.location=('index.php?controller=orders')" type="button" value="Back" class="btn btn-danger">
    </div>    
    <div class="panel panel-primary">
        <div class="panel-heading">Orders detail</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th style="width: 100px;">Họ tên:</th>
                    <td><?php echo $customer->name; ?></td>
                </tr>
                <tr>
                    <th style="width: 100px;">Địa chỉ:</th>
                    <td><?php echo $customer->address; ?></td>
                </tr>
                <tr>
                    <th style="width: 100px;">Điện thoại:</th>
                    <td><?php echo $customer->phone; ?></td>
                </tr>
                <tr>
                    <th style="width: 100px;">Ngày mua:</th>
                    <td><?php echo Date_format(Date_create($order->createdate), "d/m/Y"); ?></td>
                </tr>
                <?php if($order->status == 2): ?>
                    <tr>
                        <th style="width: 100px;">Ngày hủy:</th>
                        <td><?php echo Date_format(Date_create($order->datecancel), "d/m/Y"); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th style="width: 100px;">Trạng thái</th>
                    <td>
                        <?php if($order->status == 0): ?>
                            <span class="label label-danger">Chưa giao hàng</span>
                        <?php elseif ($order->status == 1) : ?>
                            <span class="label label-primary">Đã giao hàng</span>
                        <?php else: ?>
                            <span class="label label-warning">Hủy hóa đơn</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if($order->status == 2): ?>
                    <tr>
                        <th style="width: 100px;">Lý do hủy</th>
                        <td><?php echo $order->note; ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <!-- /thong tin -->
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width: 100px;">Photo</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu sắc</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                </tr>
                <?php foreach($data as $rows): ?>
                    <?php 
                        //lay ban ghi product tuong ung voi product_id
                        $product = $this->modelGetProducts($rows->type_id);
                     ?>
                <tr>
                    <td style="text-align: center;">
                        <?php if(file_exists("../assets/upload/products/".$product->photo)&&isset($product->photo)): ?>
                            <img src="../assets/upload/products/<?php echo $product->photo; ?>" style="width:100px;"></td>
                        <?php endif;?>
                    <td><?php if(isset($product->name)) echo $product->name; ?></td>
                    <td><?php if(isset($product->color)) echo $product->color; ?></td>
                    <td style="text-align: center;"><?php if(isset($product->price)){ echo number_format($product->price); }else{echo "0";}  ?></td>
                    <td style="text-align: center;"><?php if(isset($rows->quantity)) echo $rows->quantity; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>     
            <?php if($order->status==0||$order->note==0):?>
                <form method="post" action="index.php?controller=orders&action=cancel&id=<?php echo $order->id;?>">
                    <table class="table border-0 table-hover">
                        <tr>
                            <td><div id="note" class="float-left"><input type="text" name="note" class="form-control" placeholder="Lý do hủy hóa đơn"></div></td>
                            <td>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-warning" value="Hủy hóa đơn" onclick="return window.confirm('Bạn chắc chắn hủy hóa đơn này?');">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php endif;?>        
        </div>
    </div>
</div>