<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { // and it doesn't match the cookie
?> 
<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
<?php
return;
}
}
/* This variable is for alternating comment background */
$oddcomment = 'alt';
?>
<!-- You can start editing here. -->


      <div class="postcont">
      <div class="alignright">
        <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PTbar">
           <div class="PT PTds"><span class="ptblurl">&nbsp;</span><h3><a name="comments"></a>Responses to this post &raquo; (<?php comments_number('None', 'One Total', '% Total' );?>)</h3><span class="ptblurr">&nbsp;</span></div>
        </div>
        <div class="PTbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="p1">
          <?php if ($comments) : ?>
            <ol id="commentlist">
            <?php foreach ($comments as $comment) : ?> 
              <li id="comment-<?php comment_ID() ?>"> 
                <span class="avatar"><?php echo get_avatar($comment, $size = '50'); ?></span>
                <div class="commentbox <?php echo $oddcomment; ?>">
                  <span class="commentauthor"><?php comment_author_link() ?> said...</span><br />
                  <span class="comment-time"><?php comment_time() ?> - <?php comment_date('F jS, Y') ?></span>
                  <?php if ($comment->comment_approved == '0') : ?><em>Your comment is awaiting moderation.</em><?php endif; ?> 
                  <?php comment_text() ?>
                  
                </div>
              </li>
              <?php /* Changes every other comment to a different class */
              /* if ('greybox' == $oddcomment) $oddcomment = 'alt';
              else $oddcomment = 'greybox'; */
              ?> 
            <?php endforeach; /* end for each comment */ ?> 
            </ol>
            <?php else : // this is displayed if there are no comments so far ?> 
              <?php if ('open' == $post->comment_status) : ?>
                <br /><br />
                <div class="ctr">Comments are open. Feel free to leave a comment below.</div>
                <br /><br />
              <!-- If comments are open, but there are no comments. -->
              <?php else : // comments are closed ?> 
              <!-- If comments are closed. -->
              <p class="nocomments">Sorry, but comments are now closed. Check out another post and speak up!</p>
            <?php endif; ?>
          <?php endif; ?>
          
        </div>
        <div class="PFtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PFpst">
          <span class="tagstyle spanchunk">
            <img class="tagicon" src="<?php bloginfo('template_directory'); ?>/images/feed_50.png" alt=" " />
            <small><strong>Comment Meta:</strong></small><br />
            <?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> Feed for comments')); ?><br />
            <?php if ( pings_open() ) : ?> 
              <a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a> 
            <?php endif; ?>
          </span>

        </div>
        <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        </div>
      </div>
      
      <div class="postcont">
      <div class="alignright">
        <div class="PTtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PTbar">
           <div class="PT PTds"><span class="ptblurl">&nbsp;</span><h3><a name="post"></a>Leave A Comment ...</h3><span class="ptblurr">&nbsp;</span></div>
        </div>
        <div class="PTbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="p1">
          
          <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
            <br /><br />
            <div class="ctr">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</div>
            <br /><br />
            <?php else : ?>
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
              <?php if ( $user_ID ) : ?>
              <p>Logged in as 
                <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a>
              </p>
              <?php else : ?>
              <p>
                <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="form-text"/>
                <label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label>
              </p>
              <p>
                <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="form-text"/>
                <label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label>
              </p>
              <p>
                <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="form-text"/>
                <label for="url"><small>Website</small></label>
              </p>
              <?php endif; ?>
              <p><textarea name="comment" id="comment" cols="50%" rows="10" tabindex="4" class="form-textarea"></textarea></p>
              <p>
                <input name="submit" type="submit" id="submit" tabindex="5" value="Comment now" class="form-submit"/>
                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
              </p>
              <?php do_action('comment_form', $post->ID); ?>
            </form>
            <?php endif; // If registration required and not logged in ?>

        </div>
        <div class="PFtop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        <div class="PFpst">
          <span style="width:550px;" class="tagstyle spanchunk">
            <img class="tagicon" src="<?php bloginfo('template_directory'); ?>/images/comments_50.png" alt=" " />
            <small><strong>XHTML:</strong><br />You can use these tags: <?php echo allowed_tags(); ?></small>
          </span>

        </div>
        <div class="PFbtm"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
        </div>
      </div>

