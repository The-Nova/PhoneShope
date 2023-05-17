
<?php 
  //load Layout.php
  $this->layoutPath = "Layout.php";
  $_SESSION['url']=$_SERVER["REQUEST_URI"];
 ?>
<div class="container single_product_container">
	<div class="row">
		<div class="col">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="index.php?controller=products"><i class="fa fa-angle-right" aria-hidden="true"></i>Product</a></li>
					<li class="active"><a href="<?php echo $_SERVER['REQUEST_URI'];?>"><i class="fa fa-angle-right" aria-hidden="true"></i>
						<?php echo $dataProducts->name;?></a></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="row pb-5">
		<div class="col-lg-7">
			<?php if(file_exists("assets/upload/products/".$dataProducts->photo)): ?>
				<img class="ml-5 border p-2 w-75" src="assets/upload/products/<?php echo $dataProducts->photo; ?>">
			<?php endif; ?>
			<div class="image_types" style="width:100%;height:50px;">
				<ul>
					<?php foreach($dataTypes as $types):?>
						<li class="">
							<?php if(file_exists("assets/upload/products/".$types->photo)): ?>
								<img style="width: 50px;height:50px;" src="assets/upload/products/<?php echo $types->photo; ?>">
							<?php endif; ?>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="product_details">
				<div class="product_details_title">
					<h4><?php echo $dataProducts->name;?></h4>
					<p><?php echo $dataProducts->description;?></p>
				</div>
				<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
				<i class="fa fa-truck mr-2" aria-hidden="true"></i><span>Giao hàng miễn phí</span>
				</div>
				<?php if($dataProducts->discount>0){
					$price=number_format(round($dataProducts->price*(100-$dataProducts->discount)/100,-3));
					echo '<div class="original_price">Giá gốc: '.$dataProducts->price.' ₫</div>';
					echo 'Giá: <div id="price" class="product_price">'.$price.' ₫</div>';
				}else{
					echo 'Giá: <div id="price" class="product_price">'.number_format($dataProducts->price).' ₫</div>';
				}
				?>
				<ul class="star_rating">
					<li>Đánh giá: <?php echo $star->avg_star; ?><i class="fa fa-star" aria-hidden="true"></i>/5</li>
				</ul>
				<div class="product_color">
					<span>Màu sắc:</span>
					<ul id="ul_color">
						<?php $i=0; foreach($dataTypes as $types):?>
							<li id="<?php echo $types->id;?>"  data-myValue="<?php echo $types->quantity;?>">
								<?php if(file_exists("assets/upload/products/".$types->photo)): ?>
									<img style="width: 50px;height:50px;" src="assets/upload/products/<?php echo $types->photo; ?>"><br/>
								<?php endif; ?>
								<div class="text-center"><?php echo $types->color;?></div>
							</li>
						<?php endforeach;?>
					</ul>
					<div id="err-quantity" class="text-danger"></div>
				<div class="quantity d-flex  flex-sm-row align-items-sm-center">
					<span>Số lượng:</span>
					<div class="quantity_selector mr-3" >
						<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
						<span id="quantity_value">1</span>
						<span class="plus"><i class="fa fa-plus" aria-hidden="true" disabled></i></span>
					</div>
					<div class="red_button pl-2 pr-3" ><a id="add_to_cart"  class="text-white">Thêm vào giỏ</a></div>
					<div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Tabs -->

<div class="tabs_section_container">

<div class="container">
	<div class="row">
		<div class="col">
			<div class="tabs_container">
				<ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
					<li class="tab active" data-active-tab="tab_1"><span>Đánh giá (<?php if(isset($countRating)) echo $countRating; else echo '0';?>)</span></li>
					<li class="tab" data-active-tab="tab_2"><span>Cấu hình</span></li>
					<li class="tab" data-active-tab="tab_3"><span>Thông tin</span></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div id="tab_1" class="tab_container active">
				<div class="row">

					<!-- User Reviews -->

					<div class="col-lg-6 reviews_col">
						<div class="tab_title reviews_title">
							<h4>Đánh giá (<?php if(isset($countRating)) echo $countRating; else echo '0';?>)</h4>
						</div>
						<div class="rating_filter bg-light p-2">
							<ul>Lọc theo:
								<?php for($i=6;$i>=1;$i--):?>
									<?php if($i>5){
										echo '<li><a href="'. $action.'&star=0">Tất cả</a></li>';
									}else{
										echo '<li><a href="'.$action.'&star='.$i.'">'.$i.' sao</a></li>';
									}?>
								<?php endfor;?>
							</ul>
						</div>
						<!-- User Review -->
						<?php if(!empty($dataRating)):?>
							<?php foreach($dataRating as $rating):?>
								<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic"></div>
										<div class="user_rating">
											<ul class="star_rating">
												<?php for($i=1;$i<=5;$i++):?>
													<?php if($rating->star<$i):?>
													<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
													<?php else:?>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<?php endif;?>
												<?php endfor;?>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date"><?php echo date_format(date_create($rating->createdate),"d/m/y");?></div>
										<div class="user_name"><?php echo $rating->name;?></div>
										<p><?php echo $rating->comment;?></p>
									</div>
								</div>
							<?php endforeach;?>
						<?php else:?>
							<p>Chưa có đánh giá nào!</p>
						<?php endif;?>
					</div>
					<div class="col-lg-6 add_review_col reviews_title">
						<?php if(empty($_SESSION['customer_id'])):?>
							<h5 class="font-italic mt-2">Bạn cần đăng nhập để có thể đánh giá sản phẩm!
								<a href="index.php?controller=login&action=login">Đăng nhập</a>
							</h5>
						<?php else:?>
							<form id="review_form" method="post" class="mt-3"
							action="index.php?controller=products&action=createRatingPost&id=<?php echo $dataProducts->id;?>"> 
								<div>
									<h5>Đánh giá của bạn:</h5>
									<select class="form-control col-2" name="star">
										<option value="5">5 &#x2605;</option>
										<option value="4">4 &#x2605;</option>
										<option value="3">3 &#x2605;</option>
										<option value="2">2 &#x2605;</option>
										<option value="1">1 &#x2605;</option>
									</select>
									<textarea id="review_message" class="input_review" name="comment"  placeholder="Bình luận" rows="3" required data-error="Please, leave us a review."></textarea>
								</div>
								<div class="text-left text-sm-right">
									<button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">Gửi</button>
								</div>
							</form>
						<?php endif;?>
					</div>
				</div>
			</div>
			<!-- Tab Description -->

			<div id="tab_2" class="tab_container">
				<div class="row">
					<div class="col-lg-5 desc_col">
						<div class="tab_title">
							<h4>Cấu hình</h4>
						</div>
						<div id="product_content" ><p style="color:black;"><?php echo $dataProducts->config;?></p></div>
					</div>
				</div>
			</div>
			<!-- Tab Additional Info -->

			<div id="tab_3" class="tab_container">
				<div class="row">
					<div class="col additional_info_col">
						<div class="tab_title additional_info_title">
							<h4>Thông tin</h4>
						</div>
						<p><?php echo $dataProducts->content;?></p>
					</div>
				</div>
			</div>
			<div class="bg-info" id="test_data"></div>
			<!-- Tab Reviews -->
		</div>
	</div>
<script>
</script>
</div>
