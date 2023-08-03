<?php
/**
 * Phippy Family Block
 *
 * This block was generated by create-acf-block-json.
 *
 * @package WordPress
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Block Name (sluggified).
$block_name = 'phippy-family';

$namespace = 'lf';

// Create full block name to use in classes.
$block_name = 'wp-block-' . $namespace . '-' . $block_name;

$additional_classes = $block['className'] ?? '';

$all_classes = array(
	$block_name,
	$additional_classes,
);

$classes = implode( ' ', $all_classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">

	<?php if ( have_rows( 'phippy_family', 'option' ) ) : ?>

	<div class="lf-grid wp-block-lf-phippy-family__grid">
		<?php
		while ( have_rows( 'phippy_family', 'option' ) ) :
			the_row();
			?>

		<div class="wp-block-lf-phippy-family__grid-col">

			<?php LF_Utils::display_responsive_images( esc_html( get_sub_field( 'headshot' ) ), 'medium', '200px', 'wp-block-lf-phippy-family__image is-style-rounded-border', 'lazy', esc_attr( 'Picture of' . get_sub_field( 'name' ) ) ); ?>

			<p
				class="wp-block-lf-phippy-family__name is-style-spaced-uppercase"><?php the_sub_field( 'name' ); ?></p>

			<p class="wp-block-lf-phippy-family__text">
			<?php the_sub_field( 'bio' ); ?></p>
		</div>

		<?php endwhile; ?>

		<?php
		if ( get_field( 'display_character_coming_soon', 'option' ) ) :

			$coming_soon_title    = get_field( 'coming_soon_title', 'option' ) ?? null;
			$coming_soon_bio      = get_field( 'coming_soon_bio', 'option' ) ?? null;
			$coming_soon_image_id = get_field( 'coming_soon_image', 'option' ) ?? null;

			if ( $coming_soon_title && $coming_soon_bio && $coming_soon_image_id ) :
				?>

		<div class="wp-block-lf-phippy-family__grid-col">

				<?php LF_Utils::display_responsive_images( esc_html( $coming_soon_image_id ), 'medium', '200px', 'wp-block-lf-phippy-family__image is-style-rounded-border', 'lazy', 'An outline of a character to symbolise one is coming soon' ); ?>

			<p
				class="wp-block-lf-phippy-family__name is-style-spaced-uppercase"><?php echo esc_html( $coming_soon_title ); ?></p>

			<p class="wp-block-lf-phippy-family__text">
				<?php echo esc_html( $coming_soon_bio ); ?></p>
		</div>

				<?php
		endif;
	endif;
		?>

	</div>

	<?php endif; ?>

</div>
