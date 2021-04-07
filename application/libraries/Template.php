<?php
class Template{
 	protected $_CI;

 	function __construct(){
 		$this->_CI=&get_instance();
 		
 		// if (!empty($this->_CI->session->userdata('iduser'))) {
 		// 	refresh_session();
 		// 	if (cek_akses('akses_login',1) != true) {
 		// 		redirect('auth/no_access');
 		// 	}
 		// }else{
 		// 	redirect('auth/logout');
 		// }
 		
 	}

 	function layout($template, $data=null){
 		
 		$data['_sidebar'] = $this->_CI->load->view('samping',$data,TRUE);
		$data['_js'] = $this->_CI->load->view($template.".js",$data,TRUE);
		$data['_content'] = $this->_CI->load->view($template,$data,TRUE);
    	$this->_CI->load->view('utama', $data);
 	}

}
?>