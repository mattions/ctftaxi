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
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
      <div class="postcont">
        <div class="alignright">
          <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
          <div class="PTbar">
             <div class="PTds Ptime"><span class="ptblurl">&nbsp;</span><span class="blurt"><?php the_time('d M Y') ?> @ <?php the_time('g:i A') ?></span><span class="ptblurr">&nbsp;</span></div>
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
              <img class="tagicon" src="<?php bloginfo('template_directory'); ?>/images/tags_50.png" alt="Tags" />
            </span>
            <span class="tagstyle spanchunk">
              <?php the_tags('<strong>Tags:</strong> ', ', ', '<br />'); ?>
              <strong>Categories:</strong> <?php the_category(', ') ?>  
            </span>
    
            <span class="tagstyle ts-sm spanchunk">
              <strong>Posted By:</strong> <?php the_author() ?><br />
              <strong>Last Edit:</strong> <?php the_modified_date('d M Y'); ?> @ <?php the_modified_date('h i A'); ?><br /><br />
              <a rel="nofollow" href="mailto:?subject=<?php the_title(); ?>&amp;body=Thought you might like this: <?php the_permalink() ?>">E-mail</a> &bull; 
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink</a>
            </span>
          </div>
          <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        </div>
      </div>

      <div class="navigation">
        <span style="float:left;"><?php previous_post('%', '<img style="vertical-align:middle;" src="'.get_bloginfo('template_directory').'/images/arbk.png" alt=" " /> Previous: ', 'no') ?></span>
        <span style="float:right;"><?php next_post('%', '<img style="vertical-align:middle;" src="'.get_bloginfo('template_directory').'/images/arfw.png"> Next: ', 'no') ?></span>
      </div>

      <?php comments_template(); ?>

      <?php endwhile; ?>
      <?php else : ?> 
        <div id="bodycontents"><h1>Not Found</h1> 
          <p>You seemed to have found a mislinked file, page, or search query with no results. If you feel you have reached this page in error, double check the URL and try again, browse by tag or search again.</p>
          <?php
          if(function_exists('UTW_ShowTagsForCurrentPost')) { ?> <h2>Browse by tag</h2> 
          <?php UTW_ShowWeightedTagSetAlphabetical("coloredsizedtagcloud","","120") ?> 
          <?php } ?> <h2>Search</h2> 
          <?php include (TEMPLATEPATH . "/searchform.php"); ?>
        </div>
      <?php endif; ?>
      <div style="clear:right;"></div>
    </div>
  </div>
<?php get_footer(); ?>
