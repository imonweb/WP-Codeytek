<?php
/**
*
*  Main template file. 
*
* @package codeytek
 **/

 get_header();
?>

<div id="primary">
  <main id="main" class="site-main mat-5" role="main">
    <?php 
      if( have_posts() ) :
        ?>
          <div class="container">
            <?php 
              if( is_home() && ! is_front_page() ){
                ?>
                  <header class="mb-5">
                    <h1 class="page-title screen-reader-text=">
                      <?php single_post_title(); ?>
                    </h1>
                  </header>
                <?php
              }
            ?> 

            <div class="row">
               <?php 
                $index = 0;
                $no_of_columns = 3;

                // Start the loop;
                  while( have_posts() ) : the_post();
                    
                    if( 0 === $index % $no_of_columns ){
                      ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                      <?php 
                    }
                    
                    get_template_part( 'template-parts/content' );

                    $index++;

                      if( 0 !== $index && 0 === $index % $no_of_columns ){
                      ?>
                        </div> <!--========= col-lg-4 ==========-->
                      <?php 
                      }
                  endwhile;
               ?>
            </div> <!--========= row ==========-->
          </div> <!--========= container ==========-->
        <?php 
      else :
        get_template_part( 'template-parts/content-none' );
      endif; // have post
      get_template_part( 'template-parts/content-none' );
    ?>
  </main>
</div> <!--========= primary ==========-->


<?php 
get_footer();