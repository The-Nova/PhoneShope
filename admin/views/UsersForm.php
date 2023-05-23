<?php 
	$this->layoutPath = "Layout.php";
 ?>
 <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <input onclick="window.location=('index.php?controller=users')" type="button" value="Back" class="btn btn-danger">
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit user</div>
        <div class="panel-body">
        <form method="post" action="<?php echo $action; ?>">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10"><?php if(!empty($_SESSION["error"])) echo $_SESSION["error"];?></div>
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
                <div class="col-md-2">Email</div>
                <div class="col-md-10">
                    <input type="email" value="<?php echo isset($record->email)?$record->email:""; ?>" <?php if(isset($record->email)): ?> disabled <?php endif; ?> name="email" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Password</div>
                <div class="col-md-10">
                    <input type="password" <?php if(isset($record->email)): ?> placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" <?php else: ?> required <?php endif; ?> name="password" class="form-control">
                </div>
            </div>
            <!-- end rows -->
            <?php if($_SESSION['role']==1):?>
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2" >Chức vụ</div>
                <div class="col-md-2">
                    <select class="form-control" name="role" >
                    <?php if($record->id!= 0):?>
                        <option value="<?php echo isset($record->role)?$record->role:""; ?>" >
                            <?php if($record->role== 1){
                                echo "Admin";
                            } elseif ($record->role== 2) {
                                echo "Chăm sóc khách hàng";
                            } else {
                                echo "Nhân viên bán hàng";
                            } ?>
                        </option>
                    <?php endif;?>
                    <?php if($record->role!= 2&&$record->role!= 1):?>
                        <option value="2">Chăm sóc khách hàng</option>
                    <?php endif;?>
                    <?php if($record->role!= 3&&$record->role!= 1):?>
                        <option value="3">Nhân viên bán hàng</option>
                    <?php endif;?>
                    </select>
                </div>
            </div>
            <!-- end rows -->
            <?php endif;?>
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