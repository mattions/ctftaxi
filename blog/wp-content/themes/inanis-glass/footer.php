
    <div class="clear"></div>

    <div id="StartBaloon">
  <img src="<?php bloginfo('template_directory'); ?>/images/ardn_16.png" alt="\/" /> More Options ...
</div>

<div id="StartMenu" onclick="SMClkd();">
  <div class="SMTop"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
  <div class="SMMiddle">
    <div class="SMsub">
      <ul>
        <li onclick="SMRaise(1);">
          <a href="javascript: void(0)">
          <img src="<?php bloginfo('template_directory'); ?>/images/categories_32.png" alt=" " />
          <b>Categories</b><br />
          Show category details...
          </a>
        </li>
        <li onclick="SMRaise(2);">
          <a href="javascript: void(0)">
          <img src="<?php bloginfo('template_directory'); ?>/images/tags_32.png" alt=" " />
          <b>Tag Cloud</b><br />
          Show the Tag Cloud...
          </a>
        </li>
        <li>
          <a href="<?php bloginfo('atom_url'); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/feed_32.png" alt=" " />
          <b>Blog RSS</b><br />
          Follow the Blog RSS...
          </a>
        </li>
        <li>
          <a href="<?php bloginfo('comments_rss2_url'); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/comments_32.png" alt=" " />
          <b>Comments RSS</b><br />
          Follow the Comments RSS...
          </a>
        </li>
      </ul>
      <div class="SMsgbhr"><img src="<?php bloginfo('template_directory'); ?>/images/smhrlt.png" alt=" " /></div>
      <div class="SMsgb" onclick="SMRaise(3);"><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/images/smfwd.png" alt=" " />Last 50 Posts </a></div>
      <div id="SMSearchForm"><?php include (TEMPLATEPATH . '/sm_searchform.php'); ?></div>
    </div>
    
    <div class="SMsub SMsh" id="SMSub1">
      <div class="SMSubDiv" style="padding:0;margin:4px 0 0 4px;">
        <div class="SMCats"><ul><?php wp_list_categories('show_count=1&hierarchical=1&title_li='); ?></ul></div>
        <div class="SMsgbhr"><img src="<?php bloginfo('template_directory'); ?>/images/smhrlt.png" alt=" " /></div>
        <div class="SMsgb" onclick="SMLower(1);"><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/images/smback.png" alt=" " />Back</a></div>
      </div>
    </div>
    
    <div class="SMsub SMsh" id="SMSub2">
      <div class="SMSubDiv" style="padding:0;margin:4px 0 0 4px;">
          <div class="SMTags SMCats">
            <?php wp_tag_cloud('number=30'); ?>
          </div>
        <div class="SMsgbhr"><img src="<?php bloginfo('template_directory'); ?>/images/smhrlt.png" alt=" " /></div>
        <div class="SMsgb" onclick="SMLower(2);"><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/images/smback.png" alt=" " />Back</a></div>
      </div>
    </div>
    
    <div class="SMsub SMsh" id="SMSub3">
      <div class="SMSubDiv SMap">
          <ul><?php wp_get_archives('type=postbypost&limit=50'); ?></ul>
        <div class="SMsgbhr"><img src="<?php bloginfo('template_directory'); ?>/images/smhrlt.png" alt=" " /></div>
        <div class="SMsgb" onclick="SMLower(3);"><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/images/smback.png" alt=" " />Back</a></div>
      </div>
    </div>
        
    <div class="SMRight">
    <div class="SMAvatarB"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
    
    
    <div class="SMAvatar">
      <?php global $userdata;
      get_currentuserinfo();
      echo get_avatar( $userdata->ID, 46 ); ?>
    </div>

    <?php if (is_user_logged_in()){ global $current_user; ?>
    <?php
      global $current_user, $wpdb;
      $role = $wpdb->prefix . 'capabilities';
      $current_user->role = array_keys($current_user->$role);
      $role = $current_user->role[0];
      $count_posts = wp_count_posts();
      $count_comments = wp_count_comments();
      $published_posts = $count_posts->publish;
      $published_comments = $count_comments->total_comments;
      
      echo '<div class="SMRtDiv">';
      ?><img class="SMSep" src="<?php bloginfo('template_directory'); ?>/images/sm-sep.png" alt=" " /><?php
      if ($role=="administrator" || $role=="editor" || $role=="author")
        { echo ('<a class="SMRtHov" href="' . get_option('siteurl') . '/wp-admin/post-new.php" title="Write a Post">Write a Post</a>'); }
      if ($role=="administrator" || $role=="editor")
        { echo ('<a class="SMRtHov" href="' . get_option('siteurl') . '/wp-admin/page-new.php" title="Write a Page">Write a Page</a>'); }
      ?><img class="SMSep" src="<?php bloginfo('template_directory'); ?>/images/sm-sep.png" alt=" " /><?php
      echo '</div>';
       ?>
    <?php } else {echo " ";} ?>
    
    
    <div class="clear"></div>
    
    <?php
      if (is_user_logged_in()){ global $current_user;
        if ($role!="subscriber")
          {
            $adminbtn1='<a class="SMRtHov" href="';
            $adminbtn2='/wp-admin/" title="Site Admin"><span>Site Admin</span></a>';
          }
        else
          {
            $adminbtn1='<a class="SMRtHov" href="';
            $adminbtn2='/wp-admin/" title="Edit Your Profile"><span>Edit Your Profile</span></a>';
          } 
          
      } else {
        $adminbtn1='<a class="SMRtHov" href="';
        $adminbtn2='/wp-login.php?action=register" title="Register a new account"><span>Register an account</span></a>';
      } 
    ?>
      
      <div class="SMAdmin">
        <?php echo $adminbtn1;echo get_option('siteurl');echo $adminbtn2;?>
      </div>
      
      <div class="SMRtPoCom" onclick="SMFlot(5);">Change Theme...</div>
      
      <div class="liload">
      
      <?php
      //determine which state the logout/login/Admin buttons should be in
      if (is_user_logged_in()) {
        $logoutbtn1 = '<a title="Logout" href="' . get_option('siteurl') . '/wp-login.php?action=logout"><span>Logout</span>';
        $logoutbtn2 = '</a>';
        $logoutcls = 'logout';
        
        $loginbtn1 = '<span>[Logged In';
        $loginbtn2 = ']</span>';
        $logincls = 'loggedin';
      }
      else {
        $logoutbtn1 = '<span>[Logged Out';
        $logoutbtn2 = ']</span>';
        $logoutcls ='loggedout';
        
        $loginbtn1 = '<a title="Login" href="' . get_option('siteurl') . '/wp-login.php?action=login"><span>Login</span>';
        $loginbtn2 = '</a>';
        $logincls = 'login';
      }?>

        <div class="LogAdmin">
          <ul>
            <li class="<?php echo $logoutcls; ?>"><?php echo $logoutbtn1;echo $logoutbtn2;?></li>
            <li class="<?php echo $logincls; ?>"><?php echo $loginbtn1;echo $loginbtn2;?></li>
            <li title="User Info" class="opts" onclick="SMFlot(4);">&nbsp;</li>
          </ul>
        </div>

      </div>
    </div>

    <div class="SMRtPoComFl SMsh" onclick="FlyOutWasClicked=1;" id="SMSub4">
      <ul class="SMRtFlOpt SMRtFlOptInd">
        <li><b>Role</b> &raquo; <?php echo $role; ?></li>
        <li><b>Posts</b> &raquo; <?php echo $published_posts; ?></li>
        <li><b>Comments</b> &raquo; <?php echo $published_comments; ?></li>
      </ul>
    </div>

    <div class="SMRtOptsFl SMsh" onclick="FlyOutWasClicked=1;" id="SMSub5">
      <div class="SMRtFlHd">Change Theme...</div>
      <ul class="SMRtFlOpt">
        <li title="The default theme. Dark and mysterious." onclick="chooseStyle('none', 30)"><img class="switchbutton voidb" src="<?php bloginfo('template_directory'); ?>/images/void-button.png" alt="Void" title="Void" />Void (Default)</li>
        <li title="The green bounty of life." onclick="chooseStyle('life-theme', 30)"><img class="switchbutton lifeb" src="<?php bloginfo('template_directory'); ?>/images/life-button.png" alt="Life" title="Life" />Life</li>
        <li title="Subtle earth tones in browns and reds." onclick="chooseStyle('earth-theme', 30)"><img class="switchbutton earthb" src="<?php bloginfo('template_directory'); ?>/images/earth-button.png" alt="Earth" title="Earth" />Earth</li>
        <li title="Bright and refreshing sky tones." onclick="chooseStyle('wind-theme', 30)"><img class="switchbutton windb" src="<?php bloginfo('template_directory'); ?>/images/wind-button.png" alt="Wind" title="Wind" />Wind</li>
        <li title="The deep blue power of the ocean." onclick="chooseStyle('water-theme', 30)"><img class="switchbutton waterb" src="<?php bloginfo('template_directory'); ?>/images/water-button.png" alt="Water" title="Water" />Water</li>
        <li title="Intense red-orange, raging inferno." onclick="chooseStyle('fire-theme', 30)"><img class="switchbutton fireb" src="<?php bloginfo('template_directory'); ?>/images/fire-button.png" alt="Fire" title="Fire" />Fire</li>
        <li title="Light on color and on bandwidth." onclick="chooseStyle('lite-theme', 30)"><img class="switchbutton liteb" src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt="Lite" title="Lite" />Lightweight</li>
      </ul>
    </div>

  </div>
  <div class="SMBottom"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
</div>

<!-- Task Bar -->
<div id="menuspan" class="mnusp">
  <div class="menu">
    <div class="nvtl"><ul><li onclick="OClkd();"><a><span>- O -</span></a></li></ul></div>
    <div class="menu-sep"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /></div>
      <!-- Quick Launch Goes Here, If You Want It... -->
    <div class="nav"><ul>
    <li<?php if (is_home()){?> class="current_page_item" <?php } ?>><a href="<?php echo get_settings('home'); ?>/">Home</a></li>
    <?php 
      global $baby, $matches;
      menu_ids(wp_list_pages('sort_column=menu_order&depth=1&title_li=&echo=0'));
    ?></ul> 
    </div>

    <div class="clock">
      <span id="clockhr">&nbsp;</span>:<span id="clockmin">&nbsp;</span>&nbsp;<span id="clockpart">&nbsp;</span>
    </div>
  </div>
</div>


    <div style="position:fixed;bottom:33px;left:0;">
    <?php 
      $count = 0;
      foreach ($baby as $key => $value){
        $baby[$key] = str_replace ("current_page_item"  , "cpi"  , $baby[$key]);
        $baby[$key] = str_replace ("current_page_ancestor"  , "cpa"  , $baby[$key]);
        $baby[$key] = str_replace ("current_page_parent"  , "cpp"  , $baby[$key]);
        ?>
        <div onmouseover="hovmhov();" onmouseout="unhovmhov();" class="mhov" id="hov<?php echo $matches[$count]; ?>" style="position:absolute;bottom:0;left:<?php echo ((($count+1)*73)+10); ?>px;">
        <div style="overflow: auto;width:158px;height:112px;">
          <ul> 
            <?php 
            if ($baby[$key]){echo $baby[$key];}
            else {echo ("<li>No Child Pages...</li>");}
            $count = $count +1;
            ?>
          </ul>
        </div>
        </div>
        <?php
      }
    ?>
    </div>
    
    
    <div class="clear"></div>
    
    <div class="footer"><img src="<?php bloginfo('template_directory'); ?>/images/1pxtrans.gif" alt=" " /><?php wp_footer(); ?></div>
  </body>
</html>
