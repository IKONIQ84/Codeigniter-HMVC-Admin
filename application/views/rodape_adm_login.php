
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
	</body>
</html>