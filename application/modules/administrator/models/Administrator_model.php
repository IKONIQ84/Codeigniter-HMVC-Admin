<?php 

class Administrator_model extends CI_Model{


	// ==================================================================
	//
	// + CONFIGURAÇÕES DO SITE
	//
	// ------------------------------------------------------------------

	/**
	* Pega as configurações do site
	**/
	function getConfigs(){ return $this->db->get_where('configs', array('idConfigs' => '1'))->row_array();	}



	// ==================================================================
	//
	// / CONFIGURAÇÕES DO SITE
	//
	// ------------------------------------------------------------------














} // fecha a model