<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php"; ?>
<div class="col-md-12"> 
    <div class="row " style="margin-bottom:5px;">
        <div class=" col-md-3">
        <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" 
            action="index.php?controller=orders&action=btnFilterDate&filter=<?php if (!empty($_REQUEST['filter'])) {echo $_REQUEST['filter'];}else{echo date('20y/m/d'); }?>">
                <input class="form-control mr-sm-2" type="date" aria-label="filter" name="filter" 
                value="<?php if(!empty($_REQUEST['filter'])) { echo $_REQUEST['filter'];  } else{ echo date('20y/m/d'); }?>">
                <button class="btn btn-info my-2 my-sm-0" type="submit" name="smfilter">Filter date</button>
            </form>
        </div>
        <div class=" col-md-2">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" action="index.php?controller=orders&action=btnStatus&status=1">
                <button class="btn btn-primary my-2 my-sm-0 " type="submit" name="success">Đã giao hàng</button>
            </form>
        </div>
        <div class=" col-md-2">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" action="index.php?controller=orders&action=btnStatus&status=0">
            <button class="btn btn-danger my-2 my-sm-0 " type="submit" name="danger">Chưa giao hàng</button>
            </form>
        </div>
        <div class=" col-md-1">
            <form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data" action="index.php?controller=orders&action=btnStatus&status=2">
                <button class="btn btn-warning my-2 my-sm-0" type="submit" name="warning">Đơn bị hủy</button>
            </form>
        </div>    
        <div class=" col-md-4" style="float:right;">
        <form class="form-inline" style="float:right;" method="post" enctype="multipart/form-data" 
            action="index.php?controller=orders&action=btnSearch&search=<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="search" 
                value="<?php if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; }?>">
                <button class="btn btn-primary " type="submit" name="submit" >Search</button>
            </form>
        </div>
    </div>
    <?php include "views/ListOrders.php"?>
</div>