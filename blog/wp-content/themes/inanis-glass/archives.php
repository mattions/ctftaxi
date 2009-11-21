<?php get_header(); ?>
<?php get_sidebar(); ?>
  <div id="page">
    <div id="colwrap">  
    <?php include 'banner.php'; ?>
      <!-- Referrer Hints -->
      <?php
      if((function_exists('ls_getinfo')) && (ls_getinfo('isref'))) { ?> 
      <div class="mission">
        <h2><?php ls_getinfo('terms'); ?></h2> 
        <p>You came here from 
          <?php ls_getinfo('referrer'); ?> searching for <i>
          <?php ls_getinfo('terms'); ?></i>. These posts might be of interest:
        </p>
        <ul>
          <?php ls_related(5, 10, '<li>', '</li>', '', '', false, false); ?> 
        </ul>
      </div>
      <?php } else { ?> 
      <?php } ?>
      
      <!-- Posts -->
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 
      <div class="postcont">
      <div class="alignright">
        <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PTbar">
          <span class="PT spanchunk"><span class="ptblurl">&nbsp;</span><h3><?php the_title(); ?></h3><span class="ptblurr">&nbsp;</span></span>
          <span class="spanchunk edt"><?php edit_post_link('edit','[ ',' ] '); ?></span>
          <span class="spanchunk">
            <span class="ptblurl">&nbsp;</span><span class="Ptime"><?php the_time('d M Y') ?> @ <?php the_time('g:i A') ?></span><span class="ptblurr">&nbsp;</span>
          </span>
        </div>

          <div class="PTbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
          <div class="p1">
            <h4>Browse by Category</h4> 
            <ul>
              <?php wp_list_categories('title_li=') ?> 
            </ul>
            
            <h4>Browse By Month</h4> 
            <ul>
              <?php wp_get_archives('type=monthly'); ?> 
            </ul>
          </div>
        
        <div class="PFtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PFpst">

        </div>
        <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
      </div>
      </div>
      <hr class="rule" />
      <?php endwhile; ?>

      <?php endif; ?>
      <div style="clear:right;"></div>
      </div>
    </div>
  
<?php get_footer(); ?>
