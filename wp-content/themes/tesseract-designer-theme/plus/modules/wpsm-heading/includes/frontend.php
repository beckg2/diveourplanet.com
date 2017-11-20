<?php //echo "<pre>"; print_r($settings); echo "</pre>"; ?>

<?php if( !empty($settings->font) && $settings->font['family'] != 'Default' ) { ?>
	<link rel='stylesheet' id='heading-font-css'  href='https://fonts.googleapis.com/css?family=<?php echo $settings->font['family'].':'.$settings->font['weight']; ?>' type='text/css' media='all' />
<?php } ?>
<div class="wpsm-heading-wrap">
	
	<?php $module->render_divider( 'above_heading'); ?>
	<div class="wpsm-heading">
		<<?php echo $settings->tag; ?> class="wpsm-heading-text"><?php echo $settings->heading; ?></<?php echo $settings->tag; ?>>
	</div>
	
	<?php $module->render_divider( 'below_heading'); ?>

	<?php if ( !empty( $settings->sub_heading ) ) { ?>
	<div class="wpsm-subheading">
		<<?php echo $settings->sub_tag; ?> class="wpsm-subheading-text"><?php echo $settings->sub_heading; ?></<?php echo $settings->sub_tag; ?>>
	</div>
	<?php } ?>

</div>


<?php if(!empty($settings->link)) : ?>
	<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo $settings->link_target; ?>">
<?php endif; ?>

