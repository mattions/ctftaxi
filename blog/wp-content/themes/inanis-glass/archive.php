<?php get_header(); ?>
<?php get_sidebar(); ?>
  <div id="page">
    <div id="colwrap">
    <?php include 'banner.php'; ?>
      <div class="navigation">
        <?php if (have_posts()) : ?> 
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?> 
        <?php /* If this is a category archive */ if (is_category()) { ?> <h3>Archive for the ' 
        <?php echo single_cat_title(); ?> ' Category</h3> 
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?> <h3>Archive for 
        <?php the_time('F jS, Y'); ?></h3> 
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?> <h3>Archive for 
        <?php the_time('F, Y'); ?></h3> 
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?> <h3>Archive for 
        <?php the_time('Y'); ?></h3> 
        <?php /* If this is a search */ } elseif (is_search()) { ?> <h3>Search Results</h3> 
        <?php /* If this is an author archive */ } elseif (is_author()) { ?> <h3>Author Archive</h3> 
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?> <h3>Blog Archives</h3> 
        <?php } elseif (is_tag()) { ?> <h3>Posts tagged as ' 
        <?php echo single_cat_title(); ?> ' ...</h3> 
        <?php } ?>
      </div>

      <!-- Posts -->
      <?php while (have_posts()) : the_post(); ?>
      <div class="postcont">
      <Div class="alignright">
        <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PTbar">
           <div class="PTds Ptime"><span class="ptblurl">&nbsp;</span><span class="blurt"><?php the_time('d M Y') ?> @ <?php the_time('g:i A') ?></span><span class="ptblurr">&nbsp;</span></div>
           <div class="edt"><?php edit_post_link('edit','[ ',' ] '); ?></div>
           <div class="PT PTds"><span class="ptblurl">&nbsp;</span><h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3><span class="ptblurr">&nbsp;</span></div>
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
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink</a> &bull; 
              <?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?>
            </span>
        </div>
        <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        </div>
      </div>
      <?php endwhile; ?>
      
      <?php
      if(function_exists('pagination')) {
      pagination(2,array("Previous ","Next"));
      } else { ?> 
      <div class="navigation">
        <span style="float:left;"><?php next_posts_link('<img style="vertical-align:middle;" src="'.get_bloginfo('template_directory').'/images/arbk.png" alt=" " /> Previous Entries') ?></span>
        <span style="float:right;"><?php previous_posts_link('Next Entries <img style="vertical-align:middle;" src="'.get_bloginfo('template_directory').'/images/arfw.png" />') ?></span>
      </div>
      <?php } ?> 
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
</div></div>

<?php get_footer(); ?>