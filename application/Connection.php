<?php 
	//class ket noi csdl
	class Connection{
		//ham ket noi csdl, tra ket qua ve bien ket noi
		//neu su dung tu khoa static o ten ham thi co the: tenclass::tenham()
		public static function getInstance(){
			//$conn = new PDO("chuoi ket noi csdl",username,password);
			$conn = new PDO("mysql:hostname=localhost;dbname=qlshopephone","root","");
			//lay du lieu theo kieu unicode
			$conn->exec("set names utf8");
			//chi dinh kieu duyet cac ban ghi
			$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
			return $conn;
		}
	}
 ?>