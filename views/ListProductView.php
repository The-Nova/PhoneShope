<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
    $_SESSION['url']=$_SERVER["REQUEST_URI"];   
 ?> 
<div class="container product_section_container">
    <div class="row">
        <div class="col product_section clearfix">
            <!-- Breadcrumbs -->
            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active">
                        <a href="<?php echo $action; ?>">
                            <?php 
                                if(empty($_GET["category_name"])) {
                                    echo '<i class="fa fa-angle-right" aria-hidden="true"></i> Products';
                                }else{
                                    echo '<i class="fa fa-angle-right" aria-hidden="true"></i>' .$_GET["category_name"];
                                }
                            ?>
                        </a></li>
                </ul>
            </div>

            <!-- Sidebar -->

            <div class="sidebar col-3">
                <div class="sidebar_section">
                    <div class="sidebar_title_cate_page">
                        <h5>Hãng sản xuất</h5>
                    </div>
                    <ul class="sidebar_categories_cate_page">
                        <li class="<?php if(empty($_GET["category_name"])) echo "active"; ?>">
                            <a href="index.php?controller=products">
                                <?php if(empty($_GET["category_name"])) echo " >> ";
                                    echo "Tất cả";
                                ?>
                            </a>
                        </li>
                        <?php foreach($dataCategories as $categories):?>
                            <li class="<?php if(isset($_GET["category_name"])&&$_GET["category_name"]==$categories->name) echo "active"; ?>">
                                <a href="index.php?controller=products&action=listbycategory&category_name=<?php echo $categories->name ?>">
                                    <?php if(isset($_GET["category_name"])&&$_GET["category_name"]==$categories->name) echo " >> ";
                                        echo $categories->name;
                                    ?>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>

                <!-- Price -->
                <div class="sidebar_section">
                    <div class="sidebar_title_cate_page">
                        <h5>Lọc theo giá</h5>
                    </div>
                    <ul class="checkboxes ">
                        <a href="<?php echo $action;?>">
                            <?php if(empty($_GET["price"])):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>Tất cả</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>Tất cả</span>
                                </li>
                            <?php endif;?>
                        </a>
                        
                        <a href="<?php echo $action;?>&price=duoi-2-trieu">
                            <?php if(isset($_GET["price"])&&$_GET["price"]=="duoi-2-trieu"):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>Dưới 2 triệu</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>Dưới 2 triệu</span>
                                </li>
                            <?php endif;?>
                        </a>
                        <a href="<?php echo $action;?>&price=tu-2-4-trieu">
                            <?php if(isset($_GET["price"])&&$_GET["price"]=="tu-2-4-trieu"):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>từ 2 - 4 triệu</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>từ 2 - 4 triệu</span>
                                </li>
                            <?php endif;?>
                        </a>
                        <a href="<?php echo $action;?>&price=tu-4-7-trieu">
                            <?php if(isset($_GET["price"])&&$_GET["price"]=="tu-4-7-trieu"):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>từ 4 - 7 triệu</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>từ 4 - 7 triệu</span>
                                </li>
                            <?php endif;?>
                        </a>
                        <a href="<?php echo $action;?>&price=tu-7-15-trieu">
                            <?php if(isset($_GET["price"])&&$_GET["price"]=="tu-7-15-trieu"):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>từ 7 - 15 triệu</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>từ 7 - 15 triệu</span>
                                </li>
                            <?php endif;?>
                        </a>
                        <a href="<?php echo $action;?>&price=tren-15-trieu">
                            <?php if(isset($_GET["price"])&&$_GET["price"]=="tren-15-trieu"):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span>Trên 15 triệu</span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span>Trên 15 triệu</span>
                                </li>
                            <?php endif;?>
                        </a>

                    </ul>
                </div>

                <!-- Color -->
                <div class="sidebar_section">
                    <div class="sidebar_title_cate_page">
                        <h5>Màu sắc</h5>
                    </div>
                    <ul class="checkboxes ">
                        <?php foreach($dataColor as $rows):?>
                            <a href="<?php echo $action.'&color='.$rows->color;?>">
                            <?php if(isset($_GET["color"])&&$_GET["color"]==$rows->color):?>
                                <li class="active">
                                    <i class="fa fa-square" aria-hidden="true"></i><span><?php echo $rows->color?></span>
                                </li>
                            <?php else:?>
                                <li class="">
                                    <i class="fa fa-square-o" aria-hidden="true"></i><span><?php echo $rows->color?></span>
                                </li>
                            <?php endif;?>
                        </a>
                        <?php endforeach;?>
                    </ul>
                </div>

            </div>
            <!-- Products -->

            <div class="row mr-0">
                <div class="col">
                    <?php if(isset($dataSubCategories)):?>
                        <div class="row ml-1 mb-3  p-2 bg-light">
                            <h4 class="mt-2">Từ khóa gợi ý:  </h4>&nbsp;&nbsp;
                                <?php foreach($dataSubCategories as $sub):?>
                                    <div class=" p-2 d-inline">
                                        <div class="align-items-center" >
                                            <div class="banner_category">
                                                <a class="btn btn-outline-info" href="index.php?controller=products&action=listbycategory&category_name=<?php echo $sub->name ?>">
                                                    <?php echo $sub->name ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                        </div>
                    <?php endif;?>
                    <!-- Product Sorting -->

                    <div class="product_sorting_container product_sorting_container_top ">
                        Sắp xếp: <ul class="product_sorting ml-2">
                            <li>
                                <span class="type_sorting_text">Mới nhất</span>
                                <i class="fa fa-angle-down"></i>
                                <ul class="sorting_type">
                                    <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Mới nhất</span></li>
                                    <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price","sortAscending": true  }'><span>Giá thấp</span></li>
                                    <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price","sortAscending": false }'><span>Giá cao</span></li>
                                    <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name","sortAscending": true  }'><span>Tên a-z</span></li>
                                    <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name","sortAscending": false  }'><span>Tên z-a</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Product Grid -->

                    <div class="product-grid bg-light">
                        <?php if(!empty($dataProducts)):?>
                        <!-- Product  -->
                        <?php foreach($dataProducts as $products):?>
                            <div class="product-item bg-light w-25">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <?php if(file_exists("assets/upload/products/".$products->photo)): ?>
                                            <img src="assets/upload/products/<?php echo $products->photo; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    <?php if(!$products->discount==0):?>
                                        <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                            <span>-<?php echo $products->discount?>%</span>
                                        </div>
                                    <?php endif;?>
                                    <div class="product_info">
                                        <h6 class="product_name">
                                            <a href="index.php?controller=products&action=productDetail&id=<?php echo $products->id ?>">
                                                <?php echo $products->name;?>
                                            </a>
                                        </h6>
                                        <div class="product_price">
                                            <?php if($products->discount==0):?>
                                                <?php echo number_format($products->price);?> ₫
                                            <?php else:?>
                                                <?php 
                                                    $discountPrice=($products->price)*(100-$products->discount)/100;
                                                    echo number_format(round($discountPrice,-3));
                                                ?>₫
                                                <span><?php echo number_format($products->price);?>₫</span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="index.php?controller=products&action=productDetail&id=<?php echo $products->id ?>">Thêm giỏ hàng</a></div>
                            </div>
                        <?php endforeach; ?>
                        <?php else:?>
                            <div class="col font-italic" style="margin-left: 10px;"><h4>Không có sản phẩm nào</h4></div>
                        <?php endif;?>
                    </div>
                    <?php if(!empty($dataProducts)):?>
                        <div class="product_sorting_container product_sorting_container_bottom clearfix d-flex justify-content-center">
                            <div class="product_sorting ">
                                <div class="sorting_num">
                                    <input id="num_sorting_btn" type="button" class="num_sorting_btn btn btn-lg btn-primary" value="Xem thêm sản phẩm">
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
    </div>
</div>