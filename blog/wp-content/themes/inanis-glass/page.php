<?php get_header(); ?>
<?php get_sidebar(); ?>


  <div id="page">
    <div id="colwrap">
    <?php include 'banner.php'; ?>
      <!-- Posts -->
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="postcont">
      <div class="alignright">
        <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PTbar">
           <div class="PTds Ptime">&nbsp;</div>
           <div class="edt"><?php edit_post_link('edit','[ ',' ] '); ?></div>
           <div class="PT PTds"><span class="ptblurl">&nbsp;</span><h3><?php the_title(); ?></h3><span class="ptblurr">&nbsp;</span></div>
        </div>
        
          <div class="PTbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
          <div class="p1">
            <?php the_content(' More &raquo;'); ?> 
          </div>
        
        <div class="PFtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PFpst">
        
        
          <span class="spanchunk tagiconbox">
            <img class="tagicon" src="<?php bloginfo('template_directory'); ?>/images/question.png" alt=" " />
          </span>
          <span class="tagstyle spanchunk">
            <strong>Date Posted:</strong> <?php the_time('d M Y') ?> @ <?php the_time('h i A') ?><br />
            <strong>Last Modified:</strong> <?php the_modified_date('d M Y'); ?> @ <?php the_modified_date('h i A'); ?><br />
            <strong>Posted By:</strong> <?php the_author() ?><br />
          </span>
  
          <span class="tagstyle ts-sm spanchunk">
            
            <a rel="nofollow" href="mailto:?subject=<?php the_title(); ?>&amp;body=Thought you might like this: <?php the_permalink() ?>">E-mail</a> | 
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink</a>
          </span>
        </div>
        <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
      </div>
      </div>
      
      <?php comments_template(); ?>
      
      <?php endwhile; ?>

      <?php endif; ?>
      <div style="clear:right;"></div>
      </div>
    </div>
<?php get_footer(); ?>
