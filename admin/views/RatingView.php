<?php 
	//load file layout.php vao day
	$this->layoutPath = "Layout.php";
    unset($_SESSION['product_id']);
 ?>
<div class="col-md-12">
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="col-1 col-md-1 row" style="text-align: right;"><h4>Lọc:</h4>
                </td>
                <td class="col-11 col-md-2 row">
                    <select class="form-control" name="opRating" action="index.php?controller=rating" >
                        <option value="avgstar" selected>Trung bình</option>
                        <option value="5">5 sao</i></option>
                        <option value="4">4 sao</i></option>
                        <option value="3">3 sao</i></option>
                        <option value="2">2 sao</i></option>
                        <option value="1">1 sao</option>
                    </select>
                </td>
                <td class="col-md-8 col">

                </td>
            </tr>
        </table>
    </form>
</div>
<div class="col-md-12 mt-2">
    <?php include "views/ListRating.php"?>
</div>