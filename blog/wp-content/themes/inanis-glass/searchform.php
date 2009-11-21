<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
  <div class="search-form">
    <input onfocus="SearchBoxFocus();" onblur="SearchBoxBlur();" id="searchbox1" type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="search-text"/><input type="submit" id="searchsubmit" value="" class="search-submit" />
  </div>
</form>
