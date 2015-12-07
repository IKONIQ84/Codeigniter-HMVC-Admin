<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends MY_Controller 
{

// ==================================================================
//
// + necessário
//
// ------------------------------------------------------------------

	public function __construct()
	{
				parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('menuSidebar','language'));
		$this->load->model(array('administrator/administrator_model'));

		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/* ORIGINAL
	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->tpl_admin($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}*/

	function _render_page($view, $dados=null, $returnhtml=false) { /*I think this makes more sense */

		if(empty($dados)){
			$this->viewdata = $this->dados;
		} else { 
			$this->viewdata = $dados;
		}

		$view_html = $this->tpl_admin($view, $this->viewdata, $returnhtml);

		if ($returnhtml){
			return $view_html;//This will return html on 3rd argument being true
		}
	}

// ==================================================================
//
// / necessário
//
// ------------------------------------------------------------------




	function index()
	{
		if ( !$this->ion_auth->logged_in() ) 
		{
			$dados['configs']				=		$this->administrator_model->getConfigs();

			//validate form input
			$this->form_validation->set_rules('email', 'E-mail', 'required');
			$this->form_validation->set_rules('senha', 'Senha', 'required');

			if ($this->form_validation->run() == true)
			{
				// check to see if the user is logging in
				// check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('email'), $this->input->post('senha'), $remember))
				{
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('success', $this->ion_auth->messages());
					redirect('administrator', 'refresh');
				}
				else
				{
					// if the login was un-successful
					// redirect them back to the login page
					$this->session->set_flashdata('danger', $this->ion_auth->errors());
					redirect('administrator', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			}
			else
			{
				// the user is not logging in so display the login page
				// set the flash data error message if there is one

				$dados['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$dados['titulo_pagina']			=		"Login de Usuários - ". $dados['configs']['site_nomeConfigs'];
				$this->tpl_adm_login('login/admin_login', $dados);
				//$this->_render_page('administrator', $dados);
			}
			
		} 
		else
		{
			$dados['configs']				=		$this->administrator_model->getConfigs();

			if( $this->ion_auth->is_admin() )
			{
				$dados['titulo_pagina']			=		"Administração - " . $dados['configs']['site_nomeConfigs'];
				$this->tpl_admin('administrator/index', $dados);
			} 
			else 
			{
				return show_error('You must be an administrator to view this page.');				// se está logado e não é admin, mostra 404
			}
		}
	}
 

	/* **********************************************************
	************************ + USUÁRIOS *************************
	********************************************************** */
	function ver_usuarios()
	{
		if ( $this->ion_auth->is_admin() || $this->ion_auth->in_group('gerentes') ) 
		{
			$this->load->helper('date'); 
			$this->load->model(array("login/login_model"));
			$dados['usuarios']              =   $this->login_model->getAllUsers();
			$dados['titulo_pagina']         =   "Usuários Cadastrados";
			$this->tpl_admin2('login/ver_usuarios', $dados);
		}
		else
		{
			show_404();
		}
	}





	/* **********************************************************
	************************ / USUÁRIOS *************************
	********************************************************** */


	// ==================================================================
	//
	// + CONFIGURAÇÕES
	//
	// ------------------------------------------------------------------
	
	function configuracoes(){
		if ( $this->ion_auth->is_admin() || $this->ion_auth->in_group('gerentes') ) {
			$this->load->model(array('login/login_model', 'configuracoes/configuracoes_model'));

			//$dados['user'] = $this->ion_auth->user()->row();

			$dados['cssArray']				=   array('assets/css/administracao/jquery.datetimepicker.css');
			$dados['jsArrayRodape']			=   array('assets/js/jquery.mask.min.js', 'assets/js/administracao/jquery.datetimepicker.full.min.js' );
			$dados['scriptArrayRodape']		=   array("
				// mascara jquery
				$('#telefone').mask('(00) 0000-0000'); 
				$('#telefone2').mask('(00) 00000-0000'); 
				
				// time picker
				jQuery('.timepicker').datetimepicker({
				  datepicker:false,
				  format:'H:i:s',
				  step:15,
				});
			");

			$dados['configs']				=   $this->configuracoes_model->getConfigs();
			$dados['atualizado']			=	$this->login_model->getUser($dados['configs']['idAtualizaConfigs']);
			$dados['titulo_pagina']			=   "Configurações do Site";
			$this->tpl_admin2('administracao/configuracoes', $dados);
		} else {
			show_404();
		}

	}

	function atualiza_configuracoes(){ 
		if ( $this->ion_auth->is_admin() || $this->ion_auth->in_group('gerentes') ) {
			$this->load->model(array('configuracoes/configuracoes_model'));

			// validação do formulário de atualização do produto
			$this->load->library(array("form_validation"));
			$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>", "</p>");
			
			// validações abaixo
			$this->form_validation->set_rules("titulo_navegador",		"Título no Navegador",				"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("keywords_navegador",		"Palavras-Chaves para Busca",		"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("descricao_navegador",	"Descrição do site",				"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("telefone1",				"Telefone 1",						"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("telefone2",				"Telefone 2",						"trim|xss_clean");
			$this->form_validation->set_rules("facebook",				"Facebook",							"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("twitter",				"Twitter",							"trim|xss_clean");
			$this->form_validation->set_rules("instagram",				"Instagram",						"trim|xss_clean");
			$this->form_validation->set_rules("delivery",				"Valor da Entrega",					"trim|required|min_length[2]|max_length[255]|xss_clean");

			$this->form_validation->set_rules("endereco_loja",			"Endereço da Loja",					"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("bairro_loja",			"Bairro da Loja",					"trim|required|min_length[2]|max_length[255]|xss_clean");
			$this->form_validation->set_rules("referencia_loja",		"Referência do Endereço",			"trim|required|min_length[2]|max_length[255]|xss_clean");

			if( $this->input->post("latitude_loja") != "" || $this->input->post("longitude_loja") != "" || $this->input->post("api_googlemaps") != ""){ 
				$this->form_validation->set_rules("latitude_loja",			"Latitude da Loja",					"trim|required|xss_clean");
				$this->form_validation->set_rules("longitude_loja",			"Longitude da Loja",				"trim|required|xss_clean");
				$this->form_validation->set_rules("api_googlemaps",			"API do Google Maps",				"trim|required|xss_clean");
			}

			$this->form_validation->set_rules("domingo",				"Domingo Abre?",					"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("domAbre",				"Horário que Abre Domingo",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("domFecha",				"Horário que Fecha Domingo",		"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("segunda",				"Segunda Abre?",					"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("segAbre",				"Horário que Abre Segunda",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("segFecha",				"Horário que Fecha Segunda",		"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("terca",					"Terça Abre?",						"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("terAbre",				"Horário que Abre Terça",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("terFecha",				"Horário que Fecha Terça",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("quarta",					"Quarta Abre?",						"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("quaAbre",				"Horário que Abre Quarta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("quaFecha",				"Horário que Fecha Quarta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("quinta",					"Quinta Abre?",						"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("quiAbre",				"Horário que Abre Quinta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("quiFecha",				"Horário que Fecha Quinta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("sexta",					"Sexta Abre?",						"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("sexAbre",				"Horário que Abre Sexta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("sexFecha",				"Horário que Fecha Sexta",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("sabado",					"Sábado Abre?",						"trim|required|min_length[1]|max_length[1]|xss_clean");
			$this->form_validation->set_rules("sabAbre",				"Horário que Abre Sábado",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("sabFecha",				"Horário que Fecha Sábado",			"trim|required|min_length[2]|max_length[10]|xss_clean");
			// validações acima

			// dá "start" na função de validação
			$sucesso = $this->form_validation->run();
			// verifica se foi "sucesso" e avança, caso contrário retorna para a mesma página e exibe o que está errado.
			
			if($sucesso){

				$user = $this->ion_auth->user()->row();
				$idUser = $user->id;

				$configuracoes  = array (
					// coluna                               campo
					"tituloHomeConfigs"				=>		$this->input->post("titulo_navegador"),
					"keywordsHomeConfigs"			=>		$this->input->post("keywords_navegador"),
					"descricaoHomeConfigs"			=>		$this->input->post("descricao_navegador"),
					"telefone1Configs"				=>		$this->input->post("telefone1"),
					"telefone2Configs"				=>		$this->input->post("telefone2"),
					"facebookConfigs"				=>		$this->input->post("facebook"),
					"twitterConfigs"				=>		$this->input->post("twitter"),
					"instagramConfigs"				=>		$this->input->post("instagram"),
					"valorFreteConfigs"				=>		$this->input->post("delivery"),

					"enderecoConfigs"				=>		$this->input->post("endereco_loja"),
					"bairroConfigs"					=>		$this->input->post("bairro_loja"),
					"referenciaConfigs"				=>		$this->input->post("referencia_loja"),
					"latitudeConfigs"				=>		$this->input->post("latitude_loja"),
					"longitudeConfigs"				=>		$this->input->post("longitude_loja"),
					"apiMapsConfigs"				=>		$this->input->post("api_googlemaps"),

					"idGoogleAnalyticsConfigs"		=>		$this->input->post("key_googleanalytics"),


					"idAtualizaConfigs"				=>		$idUser,
					"dataAtualizaConfigs"			=>		date("Y-m-d H:i:s"),
				);
				
				$atualiza = $this->configuracoes_model->atualizaConfiguracoes($configuracoes);
				if($atualiza){
					$this->session->set_flashdata("success", "Configurações atualizadas com sucesso!");
					redirect("administracao");
				} else {
					$this->session->set_flashdata("danger", "As Configurações não foram atualizadas");
					$this->configuracoes();
				}
			} else {
				$this->session->set_flashdata("danger", "As Configurações não foram atualizadas");
				$this->configuracoes();
			}
		} else {
			show_404();
		}

	}

	// ==================================================================
	//
	// / CONFIGURAÇÕES
	//
	// ------------------------------------------------------------------
	


} // fecha classe