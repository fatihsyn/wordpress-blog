<?php
/*

Plugin Name: Blog Eklentisi
Plugin URI: /blog
Description: Bu eklenti Bizden Haberler'in yazılarını getirir.
Version: 1.0
Author: TAG

*/

function Blog($atts){
  wp_enqueue_style( 'blog', plugins_url( 'style.css', __FILE__ ) );

  $query = new WP_Query( array(
         'cat' => '111',
         'posts_per_page' => 100
     ) );

     if ( $query->have_posts() ) :
         $output = '<section class="posts-listing">';

         while ( $query->have_posts() ) :
             $query->the_post();
             $output .= '
             <article class="post-item">
               <a class="post-item__inner" href="'.get_permalink().'">

                 <div class="post-item__thumbnail-wrapper">
                   <div class="post-item__thumbnail" style="background-image:url('.get_the_post_thumbnail_url().');"></div>
                 </div>

                 <div class="post-item__content-wrapper">
                   <h2 class="post-item__title heading-size-4"><span style="color:white;">'.get_the_title().'</span></h2>
             <div class="post-item__metas">
               <time class="post-item__meta post-item__meta--date" datetime="2022-02-14T20:24:54+00:00">'.get_the_date().'</time>
                     <p class="post-item__meta post-item__meta--category">'.get_the_author().'</p>
                   </div>
                       <div class="post-item__excerpt" style="color:black;">
                       '.wp_trim_words(get_the_excerpt(), 15).'
                       </div>

                   <div class="post-item__read-more-wrapper" style="display:none;">
                     <p class="post-item__read-more" style="font-size:15px;color:black;">DEVAMINI GÖR</p>
                   </div>

                 </div>

               </a>
             </article>
             ';
         endwhile;

         $output .= '</section>';
     else :
         $output = 'No posts found';
     endif;

     wp_reset_postdata();

     return $output;



}

add_shortcode('Blog','Blog');
