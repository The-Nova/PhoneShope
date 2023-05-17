<?php
    trait FeedbacksModel{

		public function modelCreateFeedback(){
			$name = $_POST["name"];
			$email = $_POST["email"];
			$content = $_POST["content"];
			$createdate=date("Y-m-d");
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into feedbacks set name=:_name,email=:_email,content=:_content,createdate=:_createdate");
			$query->execute([":_name"=>$name,":_email"=>$email,":_content"=>$content,":_createdate"=>$createdate]);		
		}

    }
?>