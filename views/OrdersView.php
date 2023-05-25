<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php";
$_SESSION['url']=$_SERVER["REQUEST_URI"];
?>
<div class="col"  style="margin-top:100px;"> 
<?php if(isset($_SESSION['customer_id'])):?>
    <div class="row " style="margin-bottom:5px;">
        <div class="tab_title reviews_title">
            <h4>Lịch sử giao dịch</h4>
        </div>
        <script>
            var sum_price=0;
        </script>
        <table class="table table-bordered">
            <tr>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th style="width: 50px;">Số lượng</th>
                <th>Giá bán(VNĐ)</th>
            </tr>
            <?php  foreach($data as $rows): if($rows->status!=2):?>
            <tr class="table-danger">   
                <h5>
                    <td>Mã hóa đơn: <?php echo $rows->id;?> </td>
                    <td>
                        <div class="float-left">
                            Trạng thái:
                            <?php 
                                if($rows->status==0){
                                    echo 'Chưa giao hàng.';
                                    if($rows->datepay=="0000-00-00") echo '<br/> Chưa thanh toán ';
                                }elseif($rows->status==1){
                                    echo 'Đã giao hàng.';
                                    $date = Date_create($rows->datepay);
                                    echo '<br/> Ngày thanh toán: '.Date_format($date, "d/m/Y");
                                }elseif($rows->status==2){
                                    echo 'Đơn bị hủy.';
                                }
                            ?>
                        </div>
                        <?php if($rows->status==0):?>
                            <div class="float-right">
                                    <a href="index.php?controller=orders&action=cancel&id=<?php echo $rows->id;?>"><input class="btn btn-warning" type="button" value="Hủy hóa đơn"></a>
                            </div>
                        <?php endif;?>
                    </td>
                    <td colspan="2">
                            Thành tiền: <?php echo number_format($rows->price-$rows->saleprice).' ₫<br/>';?>
                            Ngày mua: <?php 
                                $date = Date_create($rows->createdate);
                                echo Date_format($date, "d/m/Y");
                            ?> 
                    </td>
                </h5>
            </tr>
            <?php $i=0; foreach($dataDetail as $detail): ?>
            <?php if($rows->id==$detail->order_id):?>
            <tr>
                <td style="text-align: center;">
                    <?php if(file_exists("assets/upload/products/".$detail->photo)): ?>
                    <img src="assets/upload/products/<?php echo $detail->photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?controller=products&action=productDetail&id=<?php echo $detail->product_id ?>">
                    <h5><?php echo $detail->name; ?></h5></a><br/>
                    Màu sắc: <?php echo $detail->color; ?>
                </td>
                <td>
                    <?php echo $detail->quantity; ?>
                </td>
                <td style="text-align: center;">
                <?php
                    if($detail->discount>0){
                        $price=$detail->price*(100-$detail->discount)/100;
                    }else{
                        $price=$detail->price;
                    }
                    echo number_format($price*$detail->quantity); 
                
                ?> ₫ </td>
            </tr>
            <?php endif; endforeach;endif;endforeach; ?>
        </table>
        <div class="col-12">
            <div class="col-12 col-lg-6 float-right p-2">
                <table class=" table justify-content-center ml-3">
                    <tbody>
                        <tr class="p-5 ">
                            <td class="p-2">
                                <h5>Tổng:</h5>
                            </td>
                            <td class="p-2">
                                <h5>
                                    <?php 
                                        $sumprice=0;
                                        foreach($dataDetail as $detail){ $sumprice+=($detail->price*$detail->quantity); }
                                        echo number_format($sumprice).' ₫'; 
                                    ?> 
                                </h5>
                            </td>
                        </tr>
                        <tr class="p-3">
                            <td class="p-2">
                            <h5>Giảm giá:</h5> 
                            </td>
                            <td class="p-2">
                                <h5>
                                    <?php 
                                        $saleprice=0;
                                        foreach($dataDetail as $detail){ $saleprice+=($detail->price*$detail->discount/100); }
                                        echo '- '.number_format($saleprice).' ₫'; 
                                    ?> 
                                </h5>
                            </td>
                        </tr>
                        <tr class="p-3"> 
                            <td class="p-2">
                                <h5>Thành tiền: </h5>
                            </td>
                            <td class="p-2">
                                <h5>
                                    <?php 
                                        echo number_format($sumprice-$saleprice).' ₫'; 
                                    ?> 
                                </h5>
                            </td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    <?php else:?>
        <div class="col vh-100 cart-empty" style="margin-top:100px;"> 
            <div class="m-auto ">
                <h4 class="font-italic mt-2 h-100">Không có sản phẩm nào đã mua!
                    <a href="index.php">Về trang chủ</a>
                </h4>
            </div>
        </div>
        <script>
            let box = document.documentElement;
            let width = box.clientWidth;
            let height = box.clientHeight-308;
            const note = document.querySelector('.cart-empty');
            note.style.cssText += 'height:'+height+'px;';
        </script>
    <?php endif;?>
</div>