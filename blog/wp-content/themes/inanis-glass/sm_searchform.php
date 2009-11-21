<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
  <div class="search-form">
    <input onfocus="SearchBoxFocus();" onblur="SearchBoxBlur();" id="searchbox" type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" class="sm-search-text"/><input type="submit" id="searchsubmit" value="" class="sm-search-submit" />
  </div>
</form>
