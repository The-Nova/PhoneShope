<?php 
    //load file layout.php
    $this->layoutPath = "Layout.php";
 ?>                    
<div class="col-md-12">  
    <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=news')" type="button" value="Back" class="btn btn-danger">
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit news</div>
        <div class="panel-body">
        <!-- chu y: muon upload duoc file thi phai co thuoc tinh enctype="multipart/form-data" vao trong the form -->
        <form method="post" enctype="multipart/form-data" action="<?php echo $action; ?>">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Tiêu đề</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->name)?$record->name:""; ?>" name="name" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->            
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Tóm tắt</div>
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
                <div class="col-md-2">Nội dung</div>
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
                <div class="col-md-2">Ảnh</div>
                <div class="col-md-10">
                    <input type="file" name="photo">
                </div>
            </div>
            <!-- end rows -->
            <?php if(isset($record->photo)&&file_exists("../assets/upload/news/".$record->photo)): ?>
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <img src="../assets/upload/news/<?php echo $record->photo ?>" style="width: 100px;">
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
        </div>
    </div>
</div>