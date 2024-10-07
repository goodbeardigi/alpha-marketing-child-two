<?php
/**
 * Products Block
 *
 * @package Alpha
 */

$block_id = 'alpha-products-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'alpha-products';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => get_field( 'per_page_display' ),
);

if ( get_query_var( 'paged' ) ) {
	$args['paged'] = get_query_var( 'paged' );
}

$pick_products = get_field( 'pick_products' );
if ( $pick_products ) {
	$args['post__in']    = $pick_products;
		$args['orderby'] = 'post__in';
}

$q = new WP_Query( $args );

?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<?php
	if ( $q->have_posts() ) :
		while ( $q->have_posts() ) :
			$q->the_post();
			?>
			<div class="alpha-products-single">
				<div class="alpha-products-single-wrap">
					<div class="overlay"></div>
					<figure>
						<?php the_post_thumbnail( 'extra-large' ); ?>
					</figure>
					<div class="alpha-products-single-summary">
						<h2><?php the_title(); ?></h2>

						<div class="hover-expand">
							<div class="alpha-products-single-subtitle">
								<?php the_field( 'subtitle', get_the_ID() ); ?>
							</div>

							<div class="alpha-products-single-meta">
								<?php if ( have_rows( 'product_meta', get_the_ID() ) ) : ?>
								<ul>
									<?php
									while ( have_rows( 'product_meta', get_the_ID() ) ) :
										the_row();
										?>
										<li>
											<i class="aicon-<?php echo the_sub_field( 'icon' ); ?>"></i>
											<?php the_sub_field( 'text' ); ?>
										</li>
									<?php endwhile; ?>
								</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="alpha-products-single-actions">
						<?php if ( get_field( 'redirect_to', get_the_ID() ) ) : ?>
							<?php $redirect = get_field( 'redirect_to', get_the_ID()); ?>
							<a href="<?php the_permalink( $redirect->ID ); ?>" class="btn btn-primary"><?php _e( 'Find Out More', 'alpha' ); ?></a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e( 'Find Out More', 'alpha' ); ?></a>
						<?php endif; ?>					
						<?php if ( get_field( 'teaser_video', get_the_ID() ) ) : ?>
							<a href="<?php the_field( 'teaser_video', get_the_ID() ); ?>" class="trailer-link"><?php _e( 'Watch Trailer', 'alpha' ); ?></a>	
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		endwhile;
	endif;
	?>
</section>

<div class="pagination">
	<?php
	echo paginate_links(
		array(
			'prev_text' => '<span class="aicon-arrow-left"></span>',
			'next_text' => '<span class="aicon-arrow-right"></span>',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $q->max_num_pages,
			'mid_size'  => 1,
		)
	);
	?>
</div>
