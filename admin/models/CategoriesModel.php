<?php 
//if($_SESSION['role']==1||$_SESSION['role']==3){
	trait CategoriesModel{
		//lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where parent_id = 0 order by id desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			//---
			return $result;
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from categories where parent_id=0");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}
		public function modelUpdate($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$name = $_POST["name"];
			$parent_id = $_POST["parent_id"];
			$displayhomepage = isset($_POST["displayhomepage"]) ? 1:0;
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update categories set name=:_name,parent_id=:_parent_id,displayhomepage=:_displayhomepage where id=:_id");
			$query->execute([":_name"=>$name,":_parent_id"=>$parent_id,":_displayhomepage"=>$displayhomepage,":_id"=>$id]);
		}
		public function modelCreate(){
			$name = $_POST["name"];
			$parent_id = $_POST["parent_id"];
			$displayhomepage = isset($_POST["displayhomepage"]) ? 1:0;
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into categories set name=:_name,parent_id=:_parent_id,displayhomepage=:_displayhomepage");
			$query->execute([":_name"=>$name,":_parent_id"=>$parent_id,":_displayhomepage"=>$displayhomepage]);
		}
		//thay doi the loai san pham
		public function modelchange($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$parent_id=$conn->query("select parent_id from categories where id=$id")->fetch();
			$query = $conn->query("update products set category_id=$parent_id->parent_id where category_id=$id");
		}
		//xoa ban ghi
		public function modelDelete($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("delete from categories where id=$id");
		}
		//lay cac ban ghi categories
		public function modelListCategories($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where parent_id=0 and id <> $id order by id desc");
			return $query->fetchAll();
		}
		//lay cac ban ghi categories con
		public function modelListCategoriesSub($category_id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where parent_id=$category_id order by id desc");
			return $query->fetchAll();
		}
	}
//}else{
	//echo "Không có quyền truy cập";
//}
?>