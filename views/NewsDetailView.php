<?php 
  //load Layout.php
  $this->layoutPath = "Layout.php";
  $_SESSION['url']=$_SERVER["REQUEST_URI"];
 ?>
  <div class="row">
		<div class="col">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="index.php?controller=news"><i class="fa fa-angle-right" aria-hidden="true"></i>News</a></li>
					<li class="active"><a href="<?php echo $_SERVER['REQUEST_URI'];?>"><i class="fa fa-angle-right" aria-hidden="true"></i>
						<?php echo $record->name;?></a></li>
				</ul>
			</div>

		</div>
	</div>
  
  <div class="row mt-5">
    <div class="col-md-9 news-detail">
    	<h3><strong><?php echo isset($record->name)?$record->name:""; ?></strong></h3>
      <p class="font-italic">Ngày viết:&emsp;<?php $date=Date_create(isset($record->createdate)?$record->createdate:""); echo date_format($date,'d/m/y')?>&emsp;&emsp;&emsp;&emsp;
      Tác giả:&emsp;<?php echo isset($created->name)?$created->name:""; ?></p>
    	<p><?php echo isset($record->description)?$record->description:""; ?></p>
    	<p><?php echo isset($record->content)?$record->content:""; ?></p>      
      
    </div>
    <div class="col-md-3" >
        <div class="sidebar_section">
            <div class="sidebar_title_cate_page">
                <h5>Tin nổi bật</h5>
            </div>
            <ul class="sidebar_news_page">
                <?php foreach($dataNews as $news):?>
                    <li  class=" border p-2">
                        <a href="index.php?controller=news&action=newsdetail&id=<?php echo $news->id ?>">
                            <?php echo $news->name; ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
  </div>
  
<style type="text/css">
	.news-detail img{max-width: 100%;}
</style>