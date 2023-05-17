<?php 
	$this->layoutPath = "Layout.php";
 ?>
 <div class="col-md-12">  
 <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=customers')" type="button" value="Back" class="btn btn-danger">
    </div>  
    <div class="panel panel-primary">
        <div class="panel-body">
        <form method="post" action="<?php echo $action; ?>">
        <h3>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-4">Name</div>
                <div class="col-md-8">
                    <?php echo isset($record->name)?$record->name:""; ?>
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-4">Email</div>
                <div class="col-md-8">
                <?php echo isset($record->email)?$record->email:""; ?>
            </div>
            </div>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-4">Địa chỉ</div>
                <div class="col-md-8">
                <?php echo isset($record->address)?$record->address:""; ?>
                </div>
            </div>
           <div  class="row" style="margin-top:5px;">
                <div class="col-md-4">Số điện thoại</div>
                <div class="col-md-8">
                <?php echo isset($record->phone)?$record->phone:""; ?>
                </div>
            </div>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-4">Số chứng minh/Thẻ căn cước</div>
                <div class="col-md-8">
                <?php echo isset($record->cmt)?$record->cmt:""; ?>
                </div>
            </div>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-4">Ngày tạo tài khoản</div>
                <div class="col-md-8">
                <?php echo isset($record->createdate)?$record->createdate:""; ?>
                </div>
            </div>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-4">Ngày cập nhật lần cuối</div>
                <div class="col-md-8">
                <?php echo isset($record->lastupdate)?$record->lastupdate:""; ?>
                </div>
            </div>
        </h3>
        </form>
        </div>
    </div>
</div>