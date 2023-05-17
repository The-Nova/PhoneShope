<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
 ?> 
	<section class="vh-100 bg-image" >
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Tài khoản</h2>

              <form method="post" action="<?php echo $action; ?>" onsubmit="checkpassword()" id="myform">

                <div class="form-outline mb-4">
                  <input type="text" value="<?php echo isset($record->name)?$record->name:""; ?>" name="name" class="form-control" required/>
                  <label class="form-label" >Họ tên</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" value="<?php echo isset($record->email)?$record->email:""; ?>" name="email" class="form-control" disabled/>
                  <label class="form-label" >Email</label>
                </div>

				        <div class="form-outline mb-4">
                  <input type="text" value="<?php echo isset($record->phone)?$record->phone:""; ?>" name="phone" class="form-control" required/>
                  <label class="form-label" >Số điện thoại</label>
                </div>

				        <div class="form-outline mb-4">
                  <input type="text" value="<?php echo isset($record->address)?$record->address:""; ?>" name="address" class="form-control" />
                  <label class="form-label" >Địa chỉ</label>
                </div>

				        <div class="form-outline mb-4">
                  <input type="text" value="<?php echo isset($record->cmt)?$record->cmt:""; ?>" name="cmt" class="form-control" />
                  <label class="form-label" >Số chứng minh hoặc căn cước</label>
                </div>

                <div class="form-outline mb-4">
				        <input id="pass" type="password" <?php if(isset($record->password)): ?> placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" <?php else: ?> required <?php endif; ?> name="password" class="form-control">
                  <label class="form-label" >Mật khẩu</label>
                </div>

                <div class="form-outline mb-4">
                  <input  id="repass" type="password" value="<?php echo isset($record->repassword)?$record->repassword:""; ?>" name="repassword" class="form-control" required/>
                  <label class="form-label" >Nhập lại mật khẩu</label>
                </div>
                <div  id="err"></div>
                 <?php if(!isset($_SESSION['customer_id'])):?>
                <div class="form-check d-flex justify-content-center mb-5">
                  <input class=" me-2 float-left" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label float-right" for="form2Example3g">
                    Tôi chấp nhận <a href="#!" class="text-body"><u>Điều khoản dịch vụ</u></a>
                  </label>
                </div>
                 
                  <div class="d-flex justify-content-center">
                    <input type="submit" value="Tạo tài khoản" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                  </div>

                  <p class="text-center text-muted mt-5 mb-0">Bạn đã có tài khoản? <a href="index.php?controller=login&action=login"
                      class="fw-bold text-body"><u> Đăng nhập</u></a></p>
                  <?php else:?>
                    <div class="d-flex justify-content-center">
                      <input type="submit" value="Cập nhật" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                    </div>
                    <?php endif;?>
              </form>
                <script>
                  document.getElementById('#myform').submit(function() {
										var x=document.getElementById("pass").value;
                    if(x!=document.getElementById("repass").value){
                      document.getElementById('err').innerHTML = '<div class="form-outline mb-4 col text-danger text-left"> *Mật khẩu nhập lại không trùng nhau</div>';

                    }});
                </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>