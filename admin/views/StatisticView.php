<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="col-md-12">
<form method="post" enctype="multipart/form-data">
    <div class="col-md-3">Chọn mục:
        <select class="form-control" name="opStatistic" action="index.php?controller=statistic" required>
            <option value="">-- Chọn --</option>
            <option value="newCustomersSL" >Khách hàng mới(SL)</option>
            <option value="newOrdersSL">Hóa đơn mới(SL)</option>
            <option value="ordersSuccessSL">Hóa đơn thành công(SL)</option>
            <option value="ordersWaitingSL">Hóa đơn chưa giao(SL)</option>
            <option value="ordersCancelSL">Hóa đơn bị hủy(SL)</option>
            <option value="newProductsSL">Sản phẩm mới(SL)</option>
            <option value="newOrdersVND">Hóa đơn mới(VNĐ)</option>
            <option value="ordersSuccessVND">Hóa đơn thành công(VNĐ)</option>
            <option value="ordersWaitingVND">Hóa đơn chưa giao(VNĐ)</option>
            <option value="ordersCancelVND">Hóa đơn bị hủy(VNĐ)</option>
            <option value="newProductsVND">Sản phẩm mới(VNĐ)</option>
        </select>
    </div>
    <div class="col-md-2">Chọn thời gian:
        <select class="form-control" name="opTimeType" id="opTimeType" required>
            <option value="">-- Chọn --</option>
            <option value="byDate">Theo ngày</option>
            <option value="byMonth">Theo tháng</option>
            <option value="byQuarter">Theo quý</option>
            <option value="byYear">Theo năm</option>
        </select>
    </div>
    <div id="addOption"></div>

    <script>
        $(document).ready(function(){
            $('#opTimeType').change(function () {
            var timeType =  $('#opTimeType').val();
            //var timeType=;
            if(timeType=='byDate'){
                document.getElementById('addOption').innerHTML = '<div class="col-md-2">Từ ngày:'+
                '<input type="date" class="form-control" name="dateBegin" value="'+
                '<?php if(!empty($_REQUEST['dateBegin'])) { echo $_REQUEST['dateBegin'];  }?>" required>'+
                '</div><div class="col-md-2">Tới ngày:'+' <input type="date" class="form-control" name="dateEnd" value="'+
                '<?php if(!empty($_REQUEST['dateEnd'])) { echo $_REQUEST['dateEnd'];  } ?>" required></div>'+
                '<div class="col-md-2 d-flex justify-content-end"> <br>'+
                '<input type="submit" value="Filter" class="btn btn-info"></div>';
            } else if(timeType=='byMonth'){
                document.getElementById('addOption').innerHTML = 
                '<div class="col-md-2">Chọn tháng:<select class="form-control" name="opMonth" id="opMonth" required>'+
                '<option value="">-- Chọn --</option>'+
                <?php for($i=1;$i<=12;$i++):?>
                    '<option value="<?php echo $i;?>"><?php echo $i;?></option>'+
                <?php endfor;?>
                '</select></div>'+
                '<div class="col-md-2">Chọn năm:<select class="form-control" name="opYear" id="opYear" required>'+
                '<option value="">-- Chọn --</option>'+
                <?php foreach($dataYears as $rows):?>
                    '<option value="<?php echo $rows->years;?>"><?php echo $rows->years;?></option>'+
                <?php endforeach;?>
                '</select></div>'+
                '<div class="col-md-2 d-flex justify-content-end"> '+
                '<br><input type="submit" value="Filter" class="btn btn-info"></div>';
            }else if(timeType=='byQuarter'){
                document.getElementById('addOption').innerHTML = 
                '<div class="col-md-2">Chọn quý:<select class="form-control" name="opQuarter" id="opQuarter" required>'+
                '<option value="">-- Chọn --</option>'+
                '<option value="1">Quý I</option>'+
                '<option value="2">Quý II</option>'+
                '<option value="3">Quý III</option>'+
                '<option value="4">Quý IV</option></select></div>'+
                '<div class="col-md-2">Chọn năm:<select class="form-control" name="opYear" id="opYear" required>'+
                '<option value="">-- Chọn --</option>'+
                <?php foreach($dataYears as $rows):?>
                    '<option value="<?php echo $rows->years;?>"><?php echo $rows->years;?></option>'+
                <?php endforeach;?>
                '</select></div>'+
                '<div class="col-md-2 d-flex justify-content-end"> <br><input type="submit" value="Filter" class="btn btn-info"></div>';
            }else if(timeType=='byYear'){
                document.getElementById('addOption').innerHTML = 
                '<div class="col-md-2">Chọn năm:<select class="form-control" name="opYear" id="opYear" required>'+
                '<option value="">-- Chọn --</option>'+
                <?php foreach($dataYears as $rows):?>
                    '<option value="<?php echo $rows->years;?>"><?php echo $rows->years;?></option>'+
                <?php endforeach;?>
                '<option value="allyear">Tất cả</option></select></div>'+
                '<div class="col-md-2 d-flex justify-content-end"> <br><input type="submit" value="Filter" class="btn btn-info"></div>';
            }else{
                document.getElementById('addOption').innerHTML = '';
            }
            })
        })
    </script>
    </form>
</div>
<?php include "views/StatisticChart.php"; ?>
