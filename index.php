<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix masonry-container" role="main">
							
							<?php $count = 0; ?>
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); $count++?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix masonry-entry' ); ?> role="article">

								<header class="article-header">
									
									<div class="post-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php if ( has_post_thumbnail() ) { 
											the_post_thumbnail('featured-thumb');
											} else { ?>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/nothumb.gif" alt="There is no featured image for this post" >
											<?php } ?>
									</a></div>
									
									<h1 class="h2 index-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<!--<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span><br>Filed under %4$s.', 'creativetheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', '));
									?></p>-->

								</header>

								<section class="entry-content clearfix">
									<?php the_excerpt(); ?>
									<a class="excerpt-read-more" href="<?php echo get_permalink($post->ID) ?>" title="<?php _e( 'Read', 'creativetheme' ); get_the_title($post->ID) ?>"><?php _e( 'Read full post', 'creativetheme' ) ?></a>
								</section>

								<!--<footer class="entry-content article-footer">
									<p class="tags"><?php the_tags( '<span class="tags-title">' . __( 'Tags:', 'creativetheme' ) . '</span> ', ', ', '' ); ?></p>
								</footer>-->

								<?php // comments_template(); // uncomment if you want to use them ?>

							</article>
							
							<?php 
								if ( 0 == $count%3 ) {
									echo '<br class="clear">';
								}
							?>

							<?php endwhile; ?>

									<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
											<?php bones_page_navi(); ?>
									<?php } else { ?>
											<nav class="wp-prev-next">
													<ul class="clearfix">
														<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'creativetheme' )) ?></li>
														<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'creativetheme' )) ?></li>
													</ul>
											</nav>
									<?php } ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'creativetheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'creativetheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'creativetheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
