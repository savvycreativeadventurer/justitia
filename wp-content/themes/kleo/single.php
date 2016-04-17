<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php
//Specific class for post listing */


if ( kleo_postmeta_enabled() ) {
	$meta_status = ' with-meta';
	add_filter( 'kleo_main_template_classes', create_function( '$cls','$cls .= "'.$meta_status.'"; return $cls;' ) );
}
$related = sq_option( 'related_posts', 1 );
if(get_cfield( 'related_posts') != '' ) {
	$related = get_cfield( 'related_posts' );
}
?>


<?php get_template_part( 'page-parts/general-title-section' ); ?>

<?php get_template_part( 'page-parts/general-before-wrap' );?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'content', get_post_format() ); ?>

		<?php get_template_part( 'page-parts/posts-social-share' ); ?>

		<?php 
		if( $related == 1 ) {
			get_template_part( 'page-parts/posts-related' );
		}
		?>

		<?php
		// Previous/next post navigation.
		kleo_post_nav();
		?>


    <!-- Begin Comments -->
    <?php comments_template( '', true ); ?>
    <!-- End Comments -->

<?php endwhile; ?>

<?php get_template_part('page-parts/general-after-wrap');?>

<?php get_footer(); ?>