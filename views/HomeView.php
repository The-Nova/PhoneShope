<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
	unset($_SESSION["error"]);
 ?> 
	<!-- Banner -->
	<div class="banner">
		<div class="container">
			<div class="row">
			<div class="col-lg-12 mb-3">
				<div class="sidebar col-sm-12 col-lg-4">
					<div class="sidebar_section mr-4">
						<div class="sidebar_title row">
							<h5>Hãng sản xuất</h5>
						</div>
						<ul class="sidebar_categories row">
							<div class="col-6 col-lg-12">
								<a href="index.php?controller=products">
									Tất cả
								</a>
							</div>
							<?php foreach($dataCategories as $categories):?>
								<div class="col-3 col-lg-6">
									<a href="index.php?controller=products&action=listbycategory&category_name=<?php echo trim($categories->name); ?>">
										<?php echo $categories->name ?>
									</a>
								</div>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
				<!-- Slider -->
				<div class="main_slider col-lg-8 pl-2 float-right" style="background-image:url(assets/images/slider_1.webp)">
					<div class="container fill_height">
						<div class="row align-items-center">
							<div class="col">
								<div class="main_slider_content">
									<h5>Big Sale / <?php echo date("d-m");?></h5>
									<h4><?php echo $hotNews->name;?></h4>
									<div class="red_button shop_now_button">
										<a href="index.php?controller=products&action=listsale">Mua sắm ngay</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row p-2">
				<h4>Từ khóa gợi ý:  </h4>&nbsp;&nbsp;
				<?php foreach($dataSubCategories as $sub):?>
					<div class="mr-2 mb-2">
						<div class="align-items-center" >
							<div class="banner_category">
								<a class="btn btn-outline-info" href="index.php?controller=products&action=listbycategory&category_name=<?php echo $sub->name ?>">
									<?php echo $sub->name ?></a>
							</div>
						</div>
					</div>
				<?php endforeach;?>
			</div>
			</div>
		</div>
	</div>

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h3>Sản phẩm mới nhất</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

						<!-- Product newest -->
						<?php foreach($dataProducts as $products):?>
							<div class="product-item w-20 ">
								<div class="product discount product_filter">
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
												<?php echo number_format($products->price);?> &#8363;
											<?php else:?>
												<?php 
													$discountPrice=($products->price)*(100-$products->discount)/100;
													echo number_format($discountPrice);
												?>&#8363;
												<span><?php echo number_format($products->price);?>&#8363;</span>
											<?php endif;?>
										</div>
									</div>
								</div>
								<div class="red_button add_to_cart_button"><a href="index.php?controller=products&action=productDetail&id=<?php echo $products->id ?>">Thêm vào giỏ hàng</a></div>
							</div>
						<?php endforeach;?>
						<!--<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div> -->

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deal of the week -->

	<div class="deal_ofthe_week mt-2">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5">
					<div class="deal_ofthe_week_img">
						<img src="assets/images/14.jpg" alt="">
					</div>
				</div>
				<div class="col-lg-7 text-right deal_ofthe_week_col">
					<div class="deal_ofthe_week_content d-flex flex-column align-items-center">
						<div class="section_title">
							<h2>Giá tốt nhất trong tuần</h2>
						</div>
						<ul class="timer">
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="day" class="timer_num">03</div>
								<div class="timer_unit">Day</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="hour" class="timer_num">15</div>
								<div class="timer_unit">Hours</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="minute" class="timer_num">45</div>
								<div class="timer_unit">Mins</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="second" class="timer_num">23</div>
								<div class="timer_unit">Sec</div>
							</li>
						</ul>
						<div class="red_button deal_ofthe_week_button"><a href="index.php?controller=products&action=listsale">Mua ngay</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->

	<div class="best_sellers mt-3">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h3>Top bán chạy</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
							<?php foreach($dataBestSeller as $bestseller):?>

							<div class="owl-item product_slider_item border">
								<div class="product-item" style="width: 20%;">
									<div class="product discount">
										<div class="product_image">
											<?php if(file_exists("assets/upload/products/".$bestseller->photo)): ?>
												<img src="assets/upload/products/<?php echo $bestseller->photo; ?>">
											<?php endif; ?>
										</div>
										<div class="favorite favorite_left"></div>
										<?php if(!$bestseller->discount==0):?>
											<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
												<span>-<?php echo $bestseller->discount?>%</span>
											</div>
										<?php endif;?>
										<div class="product_info">
											<h6 class="product_name">
												<a href="index.php?controller=products&action=productDetail&id=<?php echo $products->id ?>">
                                            		<?php echo $bestseller->name;?>
												</a>
											</h6>
											<div class="product_price">
												<?php if($bestseller->discount==0):?>
													<?php echo number_format($bestseller->price);?> &#8363;
												<?php else:?>
													<?php 
														$discountPrice=($bestseller->price)*(100-$bestseller->discount)/100;
														echo number_format($discountPrice);
													?>&#8363;
													<span><?php echo number_format($bestseller->price);?>&#8363;</span>
												<?php endif;?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach;?>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->

	<div class="benefit mt-2">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content mr-1">
							<h6>Bảo hành 1 năm</h6>
							<p>Sản phẩm chính hãng với bảo hành tối thiểu 1 năm</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content mr-1">
							<h6>Thanh toán dễ dàng</h6>
							<p>Có nhiều cách thanh toán</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>30 ngày đổi trả hàng</h6>
							<p>Có thể đổi trả hàng bị lỗi trong 30 ngày</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>Cửa hàng mở cửa</h6>
							<p>8h sáng - 21h tối</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blogs -->

	<div class="blogs mt-4">
		<div class="container ">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h3>Tin tức</h3>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<?php foreach($dataNews as $news):?>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(assets/upload/news/<?php echo $news->photo; ?>)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h5 class="blog_title"><?php echo $news->name;?></h5>
							<span class="blog_meta">viết bởi: <?php echo $news->createdby?><br/>
							Ngày <?php echo Date_format(Date_create($news->createdate), "d/m/Y");?></span>
							<a class="blog_more" href="#">Xem chi tiết</a>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="col-md-2 float-right p-2 mr- font-italic text-right font-weight-bold"><a class="blog_more " href="index.php?controller=news">Xem thêm >>></a></div>
		</div>
	</div>
