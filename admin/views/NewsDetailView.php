<?php 
  //load Layout.php
  $this->layoutPath = "Layout.php";
 ?>
<div class="top">
  <div class="row">
  <form method="post" action="<?php echo $action; ?>">
    <div class="col-md-12 news-detail">
    	<h3><?php echo isset($record->name)?$record->name:""; ?></h3>
      <p>Ngày viết:&emsp;<?php echo isset($record->createdate)?$record->createdate:""; ?>&emsp;&emsp;&emsp;&emsp;
      Người tạo:&emsp;<?php echo isset($created->name)?$created->name:""; ?></p>
      <p><img src="../assets/upload/news/<?php echo isset($record->photo)?$record->photo:""; ?>"></p>
    	<p><?php echo isset($record->description)?$record->description:""; ?></p>
    	<p><?php echo isset($record->content)?$record->content:""; ?></p>      
      
    </div>
  </div>
</form>
</div>
<style type="text/css">
	.news-detail img{max-width: 100%;}
</style>