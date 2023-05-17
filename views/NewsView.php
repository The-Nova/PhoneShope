<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
    $_SESSION['url']=$_SERVER["REQUEST_URI"];
 ?>
 <div class="row">
    <div class="col-md-9" >
        <!-- Blogs -->
        <div class="blogs">
            <div class="container ">
                <div class="row">
                    <div class="col">
                    <div class="sidebar_title_cate_page">
                        <h4>Tin tức mới</h4>
                    </div>
                    </div>
                </div>
                <div class="row ">
                    <?php foreach($dataNews as $news):?>
                    <div class="col-lg-6 mt-2 p-1">
                        <div class="sidebar_section sidebar_section_shadow">
                            <div class="product_image">
                                <?php if(file_exists("assets/upload/news/".$news->photo)): ?>
                                    <img src="assets/upload/news/<?php echo $news->photo; ?>">
                                <?php endif; ?>
                            </div>
                            <div class=" sidebar_news_page text-center">
                                <a href="index.php?controller=news&action=newsdetail&id=<?php echo $news->id;?>"><h5><?php echo $news->name;?></h5></a>
                               <span> Ngày <?php echo Date_format(Date_create($news->createdate), "d/m/Y");?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
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