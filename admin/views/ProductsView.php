<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
    unset($_SESSION['product_id']);
 ?>
<div class="col-md-12">
    <div class="row">
        <div class=" col-md-2" style="margin-bottom:5px;">
            <a href="index.php?controller=products&action=create" class="btn btn-primary">Add products</a>
        </div>
        <div class=" col-md-2">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" action="index.php?controller=products&action=btnHot">
                <button class="btn btn-primary my-2 my-sm-0 " type="submit" name="hot">Hot Product</button>
            </form>
        </div>
        <div class=" col-md-4">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" 
            action="index.php?controller=products&action=btnFilterDate&filter=<?php if (!empty($_REQUEST['filter'])) {echo $_REQUEST['filter'];}else{echo date('20y/m/d'); }?>">
                <input class="form-control mr-sm-2" type="date" aria-label="filter" name="filter" 
                value="<?php if(!empty($_REQUEST['filter'])) { echo $_REQUEST['filter'];  } else{ echo date('20y/m/d'); }?>">
                <button class="btn btn-info my-2 my-sm-0" type="submit" name="smfilter">Filter date</button>
            </form>
        </div>
        <div class=" col-md-4" style="float:right;">
            <form class="form-inline" style="float:right;" method="post" enctype="multipart/form-data" 
            action="index.php?controller=products&action=btnSearch&search=<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="search" 
                value="<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <button class="btn btn-primary " type="submit" name="submit" >Search</button>
            </form>
        </div>
    </div>
    <div>
        <?php include "views/ListProducts.php"; ?>
    </div>
</div>