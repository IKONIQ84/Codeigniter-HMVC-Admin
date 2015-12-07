CREATE TABLE IF NOT EXISTS `configs` (
	`idConfigs`												int(11) NOT NULL AUTO_INCREMENT,
	`site_nomeConfigs`										varchar(255) NOT NULL,	# Nome do Site
	`site_tituloConfigs`									varchar(255) NOT NULL,	# Titulo do Site
	`site_descricaoConfigs`									varchar(255) NOT NULL,	# Descrição do Site
	`site_keywordsConfigs`									varchar(255) NOT NULL,	# Keywords do Site
	`site_authorConfigs`									varchar(255) NOT NULL,	# Author do Site + Site
	`site_authorMailConfigs`								varchar(255) NOT NULL,	# E-mail do Author do Site

	`cor_principal_1_Configs`								varchar(20) NOT NULL,	# Cor Principal 1 do Site
	`cor_principal_2_Configs`								varchar(20) NOT NULL,	# Cor Principal 2 do Site
	`cor_principal_3_Configs`								varchar(20) NOT NULL,	# Cor Principal 3 do Site
	`cor_principal_4_Configs`								varchar(20) NOT NULL,	# Cor Principal 4 do Site
	`cor_principal_5_Configs`								varchar(20) NOT NULL,	# Cor Principal 5 do Site
	`cor_principal_6_Configs`								varchar(20) NOT NULL,	# Cor Principal 6 do Site

	`font_google_admin_1_Configs`							varchar(50) NOT NULL,	# Google Fonts - 1 - Admin
	`font_google_admin_2_Configs`							varchar(50) NOT NULL,	# Google Fonts - 2 - Admin
	`font_google_site_1_Configs`							varchar(50) NOT NULL,	# Google Fonts - 1 - Site
	`font_google_site_2_Configs`							varchar(50) NOT NULL,	# Google Fonts - 2 - Site

	`key_GoogleAnalytics`									varchar(40) NOT NULL,	# KEY do Google Analytics

	`mail_enviaConfigs`										varchar(255) NOT NULL,	# email que envia os dados
	`mail_senhaConfigs`										varchar(255) NOT NULL,	# senha do email que envia os dados (senha pura, sem criptografia)
	`mail_smtpConfigs`										varchar(255) NOT NULL,	# smtp do email que envia os dados
	`mail_portaConfigs`										int(3) NOT NULL,		# porta do email que envia os dados
	`mail_recebeConfigs`									varchar(255) NOT NULL,	# email que vai receber informações no formulário de contatos

	`atualiza_idConfigs`									int(11) NOT NULL,
	`atualiza_dataConfigs`									datetime NOT NULL,
	PRIMARY KEY (`idConfigs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
