	<?php if( !is_page_template('template-blank.php') ) : ?>
		<footer class="page-footer">
			<?php if( vu_get_option('show-footer-top') ) : ?>
				<div class="footer-light">
					<div class="container">
						<div id="footer-top-widgets">
							<div class="row">
								<?php dynamic_sidebar('footer-top-sidebar'); ?>
							</div>
						</div>
					</div>
				</div><!-- /footer-light -->
			<?php endif; ?>
			<div class="footer-dark">
				<div class="container">
					<?php if( vu_get_option('show-footer-bottom') ) : ?>
						<div id="footer-bottom-widgets">
							<div class="row">
								<?php dynamic_sidebar('footer-bottom-sidebar'); ?>
							</div>
						</div>
					<?php endif; ?>
					
					<?php if( vu_get_option('show-copyright-text') ) : ?>
					<p class="site-info"><?php echo (vu_get_option('copyright-text')); ?></p>
					<?php endif; ?>

					<?php if( vu_get_option('show-back-to-top') ) : ?>
						<a href="#all" class="to-top scroll-to"></a>
					<?php endif; ?>
				</div>
			</div><!-- /footer-dark -->
		</footer>
	<?php endif; ?>

	</div>

	<?php wp_footer(); ?>
</body>
</html>