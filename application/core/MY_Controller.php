<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Sao_Paulo');
	}

	// Carrega Templates
	public function tpl_site($nome = array(), $dados = array()) {
		$this->load->view("cabecalho_site.php", $dados);
		$this->load->view($nome, $dados);
		$this->load->view("rodape_site.php");
	}

	public function tpl_adm_login($nome = array(), $dados = array()) {
		$this->load->view("cabecalho_adm_login.php", $dados);
		$this->load->view($nome, $dados);
		$this->load->view("rodape_admin.php");
	}


	public function tpl_admin($nome = array(), $dados = array()) {
		$this->load->view("cabecalho_admin.php", $dados);
		$this->load->view($nome, $dados);
		$this->load->view("rodape_admin.php");
	}






} // Fecha a classe
/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */