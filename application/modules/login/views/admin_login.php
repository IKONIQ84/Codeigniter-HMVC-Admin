	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Para prosseguir, faça o login</h3>
						<?= $message;?>
					</div>
					<div class="panel-body">
						<?= form_open('administrator');?>
						<form role="form">
							<fieldset>
								<div class="form-group">
									<?php
									echo form_label("E-mail", "email");
									echo form_input(array(
										"name"				=> "email",
										"id"				=> "email",
										"class"				=> "form-control",
										"placeholder"		=> "Digite seu e-mail",
										"maxlength"			=> "255",
										"value"				=>  set_value("email", ""),
										"rules"				=> "required",
										"autofocus"			=>	"autofocus"
									));
									echo form_error("email");
									?>
								</div>
								<div class="form-group">
									<?php
									echo form_label("Senha", "senha");
									echo form_password(array(
										"name"				=> "senha",
										"id"				=> "senha",
										"class"				=> "form-control",
										"placeholder"		=> "Digite sua senha",
										"maxlength"			=> "255",
										"value"				=>  set_value("senha", ""),
										"rules"				=> "required",
									));
									echo form_error("senha");
									?>
								</div>
								
								<div class="lembrar_login">
									<div class="switch__container">
									<?= form_checkbox(array(
										'checked'		=>	FALSE,
										'class'			=>	"switch switch--shadow",
										'id'			=>	"switch-shadow",
										'name'			=>	"remember",
										'type'			=>	"checkbox",
										'value'			=>	'1',
									));?>
									<?= form_label('', 'switch-shadow');?>
									</div>
									<div class="for_login">
										<label for="switch-shadow">Lembrar-me</label>
									</div>
									<div class="clr"></div>
								</div>
								<div class="form-group">
									<?php
									echo form_button(array(
										"class"				=> "btn btn-success btn-block",
										"content"			=> "Entrar",
										"type"				=> "submit"
									));
									?>
								</div>
								<p><a href="<?= base_url('administrator/forgot_password');?>"><?php echo lang('login_forgot_password');?></a></p>
							</fieldset>
						<?= form_close();?>
					</div>
				</div>
			</div>
		</div>
	</div>