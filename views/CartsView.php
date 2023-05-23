<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php";
$_SESSION['url']=$_SERVER["REQUEST_URI"];
?>
<?php if(isset($_SESSION['customer_id'])&&$_SESSION['countcart']>0):?>
<div class="col"  style="margin-top:100px;"> 
    <div class="row " style="margin-bottom:5px;">
        <div class="tab_title reviews_title">
            <h4>Giỏ hàng</h4>
        </div>
        <table class="table table-bordered">
            <tr>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th >Giá gốc(VNĐ)</th>
                <th style="width: 150px;">Số lượng</th>
                <th>Giá bán(VNĐ)</th>
                <th style="width:50px;text-align:center;"></th>
            </tr>
            <script>
                var sum_price=0;
            </script>
            <?php $i=0; foreach($data as $rows): ?>
            <tr>
                <td style="text-align: center;">
                    <?php if(file_exists("assets/upload/products/".$rows->photo)): ?>
                    <img src="assets/upload/products/<?php echo $rows->photo; ?>" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?controller=products&action=productDetail&id=<?php echo $rows->product_id ?>">
                    <h5><?php echo $rows->name; ?></h5></a><br/>
                    Màu sắc: <?php echo $rows->color; ?>
                </td>
                <td style="text-align: center;"><div id="price_<?php echo $i;?>">
                <?php echo number_format($rows->price); ?> ₫</div> </td>
                <td>
                    <?php if($rows->type_quantity<$rows->quantity):?>
                        <div class="row mb-2">
                            <div class="col text-danger text-left">
                                *Số lượng trong kho không đủ(<?php echo $rows->quantity; ?>)
                            </div>
                        </div>
                    <?php else:?>
                    <div class="input-group-prepend ">
                        <?php if($rows->quantity==1):?>
                            <button  id="minus_<?php echo $i=$i+1;?>" disabled class="btn btn-outline-secondary font-weight-bold" type="button">-</button>
                        <?php else:?>
                        <a href="index.php?controller=carts&action=minus&id=<?php echo $rows->type_id;?>">
                            <button  id="minus_<?php echo $i=$i+1;?>" class="btn btn-outline-secondary font-weight-bold" type="button">-</button>
                        </a>
                        <?php endif;?>
                        <input  id="quantity_value_cart_<?php echo $i;?>" type="text" style="width:40px;" class="btn" disabled value="<?php echo $rows->quantity; ?>">
                        <?php if($rows->type_quantity==$rows->quantity):?>
                            <button  id="plus_<?php echo $i;?>" disabled class="btn btn-outline-info font-weight-bold" type="button">+</button>
                        <?php else:?>
                        <a href="index.php?controller=carts&action=plus&id=<?php echo $rows->type_id;?>">
                            <button  id="plus_<?php echo $i;?>" class="btn btn-outline-info font-weight-bold" type="button">+</button>
                        </a>
                        <?php endif;?>
                    </div>
                    <?php endif;?>
                </td>
                <td style="text-align: center;"><div id="price_<?php echo $i;?>">
                <?php
                    if($rows->discount>0){
                        $price=$rows->price*(100-$rows->discount)/100;
                    }else{
                        $price=$rows->price;
                    }
                    echo number_format($price*$rows->quantity); 
                
                ?> ₫</div> </td>
                <td style="text-align:center;" class="btn btn-outline-light ">
                <div>
                    <a class="text-danger" href="index.php?controller=carts&action=delete&id=<?php echo $rows->id; ?>" 
                    onclick="return window.confirm('Are you sure?');">Xóa</a></div>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </table>
        <div class="col-12">
            
            <form method="post" action="index.php?controller=orders&action=buyProducts">
                <div class="col-12 col-lg-8 float-left">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox" value="1">
                        <label class="form-check-label" for="checkbox">
                            Áp dụng mã giảm giá "PHONESHOPE0505" giảm 200,000 đồng.
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="1" checked>
                        <label class="form-check-label" for="radio1">
                            Khuyến mãi 1: Tặng phiếu mua hàng trị giá 1 triệu đồng cho hóa đơn trên 10 triệu.
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="2">
                        <label class="form-check-label" for="radio2">
                            Khuyến mãi 2: Giảm 5%.
                        </label>
                    </div>
                    <div class="form-check mt-3">
                        <input type="radio" class="form-check-input" id="radio3" name="opt" value="1">
                        <label class="form-check-label" for="radio3">
                            Nhận tại cửa hàng
                        </label>
                    </div>
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" id="radio4" name="opt" value="2" checked>
                        <label class="form-check-label" for="radio4">
                            Nhận tại nhà: 
                        </label>
                        <input type="text" class="form-control ml-3" name="address" 
                        value="<?php echo $address->address;?>" placeholder="Địa chỉ nhận hàng">
                    </div>
                    <div class="form-group p-0 mr-4 row">
                        <label for="exampleInputEmail1">Lưu ý:</label>
                        <input type="text" name="note" class="form-control" id="exampleInputEmail1" placeholder="VD: Giao giờ hành chính,...">
                    </div>
                </div>
                <div class="col-12 col-lg-4 float-right p-2">
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
                                            foreach($data as $rows){ $sumprice+=($rows->price*$rows->quantity); }
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
                                            foreach($data as $rows){ $saleprice+=($rows->price*$rows->discount/100); }
                                            echo '- '.number_format($saleprice).' ₫'; 
                                        ?> 
                                    </h5>
                                </td>
                            </tr>
                            <tr class="p-3"> 
                                <td class="p-2">
                                    <h5>Thành tiền:</h5>
                                </td>
                                <td class="p-2">
                                    <h5>
                                        <?php 
                                            echo number_format($sumprice-$saleprice).' ₫'; 
                                        ?> 
                                    </h5>
                                </td>
                            </tr>
                            <tr class="p-3" >
                                <td colspan="2">
                                    <?php foreach($data as $rows): if($rows->type_quantity>=$rows->quantity):?>
                                        <div class="d-flex justify-content-center mt-2">
                                            <input type="submit" value="Mua hàng" class="btn btn-outline-info btn-lg btn-block"/>
                                        </div>
                                    <?php endif; endforeach;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>        
                </div>
            </form>
            <script>
                function sumPrice(){
                    document.getElementById('sum_price').innerText=new Intl.NumberFormat("en-US",{style: "decimal",}).format(sum_price)+' ₫';
                }
            </script>
    </div>
</div>
<?php elseif(isset($_SESSION['countcart'])&&$_SESSION['countcart']==0):?>
    <div class="col vh-100 cart-empty" style="margin-top:100px;"> 
        <div class="m-auto ">
            <h4 class="font-italic mt-2 h-100">Không có sản phẩm nào trong giỏ hàng!
                <a href="index.php">Về trang chủ</a>
            </h4>
        </div>
    </div>
    <script>
        let box1 = document.documentElement;
        let width1 = box1.clientWidth;
        let height1 = box1.clientHeight-408;
        const note1 = document.querySelector('.cart-empty');
        note1.style.cssText += 'height:'+height1+'px;';
    </script>
<?php else:?>
    <div class="col vh-100 cart-empty" style="margin-top:100px;"> 
        <div class="m-auto ">
            <h4 class="font-italic mt-2 h-100">Bạn cần đăng nhập để có thể mua hàng!
                <a href="index.php?controller=login&action=login">Đăng nhập</a>
            </h4>
        </div>
    </div>
    <script>
        let box = document.documentElement;
        let width = box.clientWidth;
        let height = box.clientHeight-408;
        const note = document.querySelector('.cart-empty');
        note.style.cssText += 'height:'+height+'px;';
    </script>
<?php endif;?>