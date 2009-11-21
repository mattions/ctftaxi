<div id="sidebar">
  <div class="bp">
    <div class="bpt"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
    <div class="bpm"><div id="bp"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div></div>
    <div class="bpb"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  </div>
  
  <!-- About This Entry -->
  <?php /* Single */ if(is_single()) { ?>
  <div class="sidebar-top"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  <div class="sidebar-mid">
    <h3>About this Post</h3>    
    <?php rewind_posts(); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <p>&raquo; <b>Title:</b> <a href="<?php the_permalink() ?>" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a><br />&raquo; <b>Posted:</b> <?php the_time('F jS, Y'); ?><br />&raquo; <b>Author:</b> <?php the_author_posts_link(); ?><br />&raquo; <b>Filed Under:</b> <?php the_category(',') ?>.</p>
    <?php endwhile; endif; ?>
    <?php rewind_posts(); ?>
    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
    
    // Both Comments and Pings are open ?>
    <p><?php comments_number('&raquo; There are no responses','&raquo; There is one response','&raquo; There are % responses'); ?>.</p>
    <p>&raquo;  <a href="#comments">Read comments</a>, <a href="#post">respond</a> or follow responses via <?php comments_rss_link(__("RSS")); ?>.</p>
    <p><span id="trackback">&raquo; 
    <a href="<?php trackback_url() ?>" title="Copy this URI to trackback this entry." rel="nofollow">Trackback</a> this entry.</span></p>
    <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
    
    // Only Pings are Open ?>
    <p><span id="trackback">
    <a href="<?php trackback_url() ?>" title="Copy this URI to trackback this entry." rel="nofollow">Trackback</a> this entry.</span></p>
    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
    
    // Comments are open, Pings are not ?>
    <p><?php comments_number('There are no responses','There is one response','There are % responses'); ?>.</p>
    <p>&darr; <a href="#comments">Jump to comments</a> or follow responses via <?php comments_rss_link(__("RSS")); ?>.</p>
    <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
    // Neither Comments, nor Pings are open ?>
  <?php } ?>
  </div>
  <div class="sidebar-bottom"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  
  <!-- Related Posts -->
  <?php if ((function_exists('related_posts'))) { ?>
  <div class="sidebar-top"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  <div class="sidebar-mid">
  <h3>Related Posts</h3>
  <ul>
  <?php related_posts($limit, $len, '$before_title', '$after_title', '$before_post', '$after_post', $show_pass_post, $show_excerpt); ?>
  </ul>
  </div>
  <div class="sidebar-bottom"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  <?php } ?>
  <?php } ?>
  
  <!-- Dynamic Sidebar Code -->
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
    
    <!-- Recent Posts -->
    <div class="sidebar-top"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
    <div class="sidebar-mid">
      <h3>Recent Posts</h3>
      <ul>
        <?php wp_get_archives('type=postbypost&limit=10'); ?>
      </ul>
    </div>
    <div class="sidebar-bottom"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
    <?php endif; ?>

  <div class="sidebar-top"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  <div class="sidebar-mid">
    <!-- Disclaimer -->
    <h3>Disclaimer</h3>
      <p><small>The opinions expressed herein are my own personal opinions and do not represent anyone else's view in any way, including those of my employer.<br />&copy; Copyright <?php the_time('Y') ?></small></p>
        <p style="text-align:center;">
          <a href="http://validator.w3.org/check?uri=referer"><img
              src="http://www.w3.org/Icons/valid-xhtml10"
              alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
          <a href="http://jigsaw.w3.org/css-validator/">
              <img style="border:0;width:88px;height:31px"
                  src="http://jigsaw.w3.org/css-validator/images/vcss"
                  alt="Valid CSS!" />
          </a>
        </p>
        <p style="text-align:center;">
          <a href="http://www.wordpress.org"><img src="<?php bloginfo('template_directory'); ?>/images/wplogo_32.png" alt="" /></a>  <a href="http://www.inanis.net/"><img src="<?php bloginfo('template_directory'); ?>/images/ilogo_32.png" alt="" /></a>
        </p>
  </div>
  <div class="sidebar-bottom"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
</div>
<hr class="rule" />