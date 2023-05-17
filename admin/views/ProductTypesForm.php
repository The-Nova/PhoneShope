<?php 
    //load file layout.php
    $this->layoutPath = "Layout.php";
 ?>                    
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=products&action=listTypes&id=<?php if(isset($record->product_id)) echo $record->product_id; else echo $_GET['product_id']; ?>')" 
        type="button" value="Back" class="btn btn-danger">
    </div> 
     
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit product types</div>
        <div class="panel-body">
        <!-- chu y: muon upload duoc file thi phai co thuoc tinh enctype="multipart/form-data" vao trong the form -->
        <form method="post" enctype="multipart/form-data" action="<?php echo $action; ?>">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10 text-danger"><?php if(!empty($_SESSION["error"])) echo $_SESSION["error"];?></div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Color</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->color)?$record->color:""; ?>" name="color" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Quantity</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->quantity)?$record->quantity:""; ?>" name="quantity" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->  
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Upload image</div>
                <div class="col-md-10">
                    <input type="file" name="photo">
                </div>
            </div>
            <!-- end rows -->
            <?php if(isset($record->photo)&&file_exists("../assets/upload/products/".$record->photo)): ?>
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <img src="../assets/upload/products/<?php echo $record->photo ?>" style="width: 100px;">
                </div>
            </div>
            <!-- end rows -->
            <?php endif; ?>
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        <?php 
            //huy error
			unset($_SESSION["error"]);
        ?>
        </div>
    </div>
</div>