<?php 

	/**
	 * Menu Sidebar do ADMIN 
	**/
	function getMenuSidebar(){
	$menuSidebar = '<div class="sidebar-nav navbar-collapse">'.PHP_EOL;
		$menuSidebar .= '<ul class="nav" id="side-menu">'.PHP_EOL;
			$menuSidebar .= '<li><a href="'.base_url("administracao").'"><i class="fa fa-dashboard fa-fw"></i> Página Inicial</a></li>'.PHP_EOL;
				
					$menuSidebar .= '<li>'.PHP_EOL;
						$menuSidebar .= '<a href="#"><i class="fa fa-users fa-fw"></i> Usuários<span class="fa arrow"></span></a>'.PHP_EOL;
						$menuSidebar .= '<ul class="nav nav-second-level">'.PHP_EOL;
							$menuSidebar .= '<li><a href="'.base_url("administracao/ver_usuarios").'">Ver Usuários</a></li>'.PHP_EOL;
						$menuSidebar .= '</ul>'.PHP_EOL;
					$menuSidebar .= '</li>'.PHP_EOL;					
					$menuSidebar .= '<li><a href="'.base_url("administracao/configuracoes").'"><i class="fa fa-cogs fa-fw"></i> Configurações</a></li>'.PHP_EOL;
					$menuSidebar .= '<li>'.PHP_EOL;
						$menuSidebar .= '<a href="#"><i class="fa fa-user fa-fw"></i> Perfil<span class="fa arrow"></span></a>'.PHP_EOL;
						$menuSidebar .= '<ul class="nav nav-second-level">'.PHP_EOL;
							$menuSidebar .= '<li><a href="'.base_url("administracao/editar_perfil").'">Editar Perfil</a></li>'.PHP_EOL;
							$menuSidebar .= '<li class="divider"></li>'.PHP_EOL;
							$menuSidebar .= '<li><a href="'.base_url("login/logout").'">Sair</a></li>'.PHP_EOL;
						$menuSidebar .= '</ul>'.PHP_EOL;
					$menuSidebar .= '</li>'.PHP_EOL;
				$menuSidebar .= '</ul>'.PHP_EOL;
			$menuSidebar .= '</div>'.PHP_EOL;


return $menuSidebar;

}
