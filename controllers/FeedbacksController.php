<?php 
	//load file model
	include "models/FeedbacksModel.php";
	class FeedbacksController extends Controller{
		use FeedbacksModel;
		//createPost
		public function createFeedbacks(){
			$this->modelCreateFeedback();
			$_SESSION['success']="Chúng tôi xin cảm ơn góp ý của bạn và sớm trả lời bạn.";
			header('location:index.php');
		}
	}
 ?>