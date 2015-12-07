				</div>
				<!-- /.col-lg-12 -->
			</div>
		</div>
	</div>

</div>
		<?php
		if (isset($jsArrayRodape) && is_array($jsArrayRodape)) {
			foreach ($jsArrayRodape as $value) {
				echo '<script type="text/javascript" src="' . base_url() . $value.'"></script>' . PHP_EOL;
			}
		}
		?>

		<?php // Bootstrap ?>
		<script src="<?= base_url("assets/js/bootstrap.min.js"); ?>"></script>		
		<?php
		if (isset($scriptArrayRodape) && is_array($scriptArrayRodape)) {
			foreach ($scriptArrayRodape as $value) {
				echo '<script type="text/javascript">' . PHP_EOL;
					echo '$(document).ready(function () {' . PHP_EOL;
						echo $value . PHP_EOL;
					echo '});' . PHP_EOL;
				echo '</script>' . PHP_EOL;
			}
		}
		?>

		<script src="<?= base_url("assets/js/admin/sb-admin-2.js"); ?>"></script>
		<script src="<?= base_url("assets/js/admin/menu/metisMenu.js"); ?>"></script>
	</body>
</html>