<?php 
	trait NewsModel{
		//lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			if($from==1){
				$query = $conn->query("select * from news where hot=1 desc limit $from,$recordPerPage");
			} else {
				$query = $conn->query("select * from news order by id desc limit $from,$recordPerPage");
			}
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			//---
			return $result;
		}
		//lay danh sach cac ban ghi, co phan trang phan tim  kiem
		public function modelReadSearch($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from news where name like '%$keyword%' order by createdate desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		//lay danh sach cac ban ghi, co phan trang phan loc theo ngay
		public function modelReadfillter($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from news where createdate = '$datefil' order by id desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from news");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//ham tinh tong so ban ghi products dang tim
		public function modelTotalSearch(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			$query = $conn->query("select * from news where name like '%$keyword%'");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//ham tinh tong so ban ghi products dang tim
		public function modelTotalFilterDate(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			$query = $conn->query("select * from news where createdate = '$datefil' ");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from news where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}
		public function modelUpdate($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$name = $_POST["name"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"])?1:0;
			$roleaccept=$_SESSION["role"];
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update news set name=:_name,description=:_description,content=:_content,hot=:_hot,roleaccept=:_roleaccept where id=:_id");
			$query->execute([":_name"=>$name,":_description"=>$description,":_content"=>$content,":_hot"=>$hot,":_id"=>$id,":_roleaccept"=>$roleaccept]);
			//---
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){
				//---
				//lay anh cu de xoa
				$oldQuery = $conn->query("select photo from news where id=$id");
				if($oldQuery->rowCount() > 0)
					$oldPhoto = $oldQuery->fetch();
					if(file_exists("../assets/upload/news/".$oldPhoto->photo))
						unlink("../assets/upload/news/".$oldPhoto->photo);
				//---
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/news/$photo");
				//update csdl
				$query = $conn->prepare("update news set photo = :_photo where id=:_id");
				$query->execute([":_photo"=>$photo,":_id"=>$id]);
				//---
			}
			//---
		}
		public function modelCreate(){
			$name = $_POST["name"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"])?1:0;
			$createdate = date("y-m-d");
			$createdby= $_SESSION["id"];
			$roleaccept=$_SESSION["role"];
			$photo = "";
			//---
			//neu user upload anh thi lay anh cu de xoa, sau do upload anh moi va update database
			if($_FILES["photo"]["name"] != ""){				
				$photo = time()."_".$_FILES["photo"]["name"];
				//upload anh moi
				move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/upload/news/$photo");
			}
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into news set name=:_name,description=:_description,content=:_content,hot=:_hot,photo=:_photo,createdate=:_createdate,createdby=:_createdby,roleaccept=:_roleaccept");
			$query->execute([":_name"=>$name,":_description"=>$description,":_content"=>$content,":_hot"=>$hot,":_photo"=>$photo,":_createdate"=>$createdate,":_createdby"=>$createdby,":_roleaccept"=>$roleaccept]);			
		}
		//xoa ban ghi
		public function modelDelete($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			//---
			//lay anh cu de xoa
			$oldQuery = $conn->query("select photo from news where id=$id");
			if($oldQuery->rowCount() > 0)
				$oldPhoto = $oldQuery->fetch();
				if(file_exists("../assets/upload/news/".$oldPhoto->photo))
					unlink("../assets/upload/news/".$oldPhoto->photo);
			//---
			$conn->query("delete from news where id=$id");
		}
		//lay mot ban ghi user tuong ung voi id truyen vao
		public function modelGetcreatedby($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select name from users where id=$id");
			//tra ve mot ban ghi
			$result = $query->fetch();
            return $result;
		}
	}
 ?>