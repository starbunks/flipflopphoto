<?php

$footer_cols = of_get_option('ml-footer_columns', 0);
$copy        = of_get_option('ml-copy');

if($footer_cols == 1) {
	$footer_grid = 'ml-one_full';
} else if($footer_cols == 2) {
	$footer_grid = 'ml-one_half';
} else if($footer_cols == 3) {
	$footer_grid = 'ml-one_third';
} else if($footer_cols == 4) {
	$footer_grid = 'ml-one_fourth';
}

?>

	<div class="clearfix"></div>



	<!-- #ml-footer -->
	<div id="ml-footer" class="ml-footer">
		<!-- .ml-wrapper -->
		<div class="ml-wrapper">

			<!-- .ml-wrapper -->
			<div class="ml-wrapper">
				
				<?php

				for ($col=1; $col <= $footer_cols; $col++) :

				$first = ($col == 1) ? ' ml-first' : '';

				?>
					
					<!-- .ml-footer-col -->
					<div class="ml-footer-col ml-grid <?php echo $footer_grid . $first ?>">

						<!-- .ml-footer-widget-area -->
						<ul class="ml-footer-widget ml-area-<?php echo $col ?>">
							
							<?php dynamic_sidebar('ml-footer-' . $col); ?>
							
						</ul>
						<!-- /.ml-footer-widget-area -->

					</div>
					<!-- /.ml-footer-col -->

				<?php endfor; ?>


			</div>
			<!-- /.ml-wrapper -->


			<div class="clearfix"></div>


			<?php if ($footer_cols > 0): ?>
				
			<br><br>

			<?php endif ?>

			
			<!-- .ml-copy -->
			<div class="ml-copy">
				
				<?php echo $copy ?>

			</div>
			<!-- /.ml-copy -->

		</div>
		<!-- /.ml-wrapper -->
	</div>
	<!-- /#ml-footer -->



<?php wp_footer(); ?> 


</body>
</html>