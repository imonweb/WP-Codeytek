<?php
/**
*
*  Footer template
*
*  @package Codeytek 
*
 **/
 
?>
<div class="container">
  <footer>
    <h3>Footer</h3>
    <?php 
      if( is_active_sidebar( 'sidebar-2') ){
        ?>
          <aside>
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
          </aside>
        <?php
      }
    ?>
  </footer>
</div>
</div> <!--========= page ==========-->
</div> <!--========= content ==========-->

<?php wp_footer(); ?>


</body>
</html>