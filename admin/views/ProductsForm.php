<?php 
    //load file layout.php
    $this->layoutPath = "Layout.php";
 ?>                    
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=products')" type="button" value="Back" class="btn btn-danger">
    </div>  
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit products</div>
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
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->name)?$record->name:""; ?>" name="name" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Price</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->price)?$record->price:""; ?>" name="price" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->  
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">% Discount</div>
                <div class="col-md-10">
                    <input type="number" min="0" max="100" value="<?php echo isset($record->discount)?$record->discount:""; ?>" name="discount" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Category</div>
                <div class="col-md-10">
                <select class="form-control" style="width: 250px;" name="category_id">
                    <?php $categories = $this->modelListCategories(); ?>
                    <?php foreach($categories as $rows): ?>
                        <option <?php if(isset($record->category_id)&&$record->category_id==$rows->id): ?> selected <?php endif; ?> value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                        <?php $categoriesSub = $this->modelListCategoriesSub($rows->id); ?>
                        <?php foreach($categoriesSub as $rowsSub): ?>
                            <option <?php if(isset($record->category_id)&&$record->category_id==$rowsSub->id): ?> selected <?php endif; ?> value="<?php echo $rowsSub->id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowsSub->name; ?></option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>
            <!-- end rows -->          
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Descripition</div>
                <div class="col-md-10">
                    <textarea name="description" id="description">
                        <?php echo isset($record->description)?$record->description:""; ?>
                    </textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace("description");
                    </script>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Content</div>
                <div class="col-md-10">
                    <textarea name="content" id="content">
                        <?php echo isset($record->content)?$record->content:""; ?>
                    </textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace("content");
                    </script>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="checkbox" <?php if(isset($record->hot)&&$record->hot==1): ?> checked <?php endif; ?> name="hot" id="hot"> <label for="hot">Hot</label>
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