<?php 
	$this->layoutPath = "Layout.php";
 ?>
 <div class="col-md-12">  
    <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=categories')" type="button" value="Back" class="btn btn-danger">
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit category</div>
        <div class="panel-body">
        <form method="post" action="<?php echo $action; ?>">
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
                <div class="col-md-2">Parent</div>
                <div class="col-md-10">
                    <?php 
                        $categories = $this->modelListCategories(isset($record->id)?$record->id:0);
                     ?>
                     <select name="parent_id" class="form-control" style="width:250px;">
                        <option value="0"></option>
                     <?php foreach($categories as $rows): ?>
                        <option <?php if(isset($record->parent_id)&&$record->parent_id==$rows->id): ?> selected <?php endif; ?> value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                     <?php endforeach; ?>
                     </select>
                </div>
            </div>
            <!-- end rows -->    
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="checkbox" <?php if(isset($record->displayhomepage)&&$record->displayhomepage==1): ?> checked <?php endif; ?> name="displayhomepage" id="displayhomepage"><label for="displayhomepage">&nbsp;&nbsp;Hiển thị danh mục này ở trang chủ</label>
                </div>
            </div>
            <!-- end rows -->        
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>