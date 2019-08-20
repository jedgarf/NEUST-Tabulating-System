<?php
include('../../server/finduser/model.php');

class LoginCtrl {
	
	public static function login($data){
		if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'));
		}
		if(isset($data['quest']) && empty($data['quest'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Security Question is required'));
		}
		if(isset($data['ans']) && empty($data['ans'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Security Answer is required'));
		}
		if(isset($data['pass']) && empty($data['pass'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'New Password is required'));
		}
		if(isset($data['repass']) && empty($data['repass'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Retyping Password is required'));
		}else{
			LoginModel::login($data);
		}
	}
}

?>
