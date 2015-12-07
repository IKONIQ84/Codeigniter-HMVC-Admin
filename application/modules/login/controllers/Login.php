<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('language'));
		$this->load->model(array('administrator/administrator_model'));

		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');

	}

	function index()
	{	
		$dados['configs']				=		$this->administrator_model->getConfigs();

		$dados['titulo_pagina']			=		"Login de Usuários - " . $dados['configs']['site_nomeConfigs'];
		$this->tpl_site('login/index', $dados);
		
	}


	function admin_login()
	{	
		$dados['configs']				=		$this->administrator_model->getConfigs();

		$dados['titulo_pagina']			=		"Login de Usuários - " . $dados['configs']['site_nomeConfigs'];
		$this->tpl_site('login/admin_login', $dados);
		
	}






	// log the user out
	function logout()
	{
		// log the user out
		$logout = $this->ion_auth->logout();
		// redirect them to the login page
		$this->session->set_flashdata('success', $this->ion_auth->messages());
		redirect('administrator', 'refresh');
	}



















} // fecha a classe

/* End of file Login.php */
/* Location: ./application/modules/login/controllers/Login.php */