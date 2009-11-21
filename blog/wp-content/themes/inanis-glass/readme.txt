Inanis Glass Notes and Errata

The following are a list of tips, tricks, notes and hints about the Inanis
Glass WordPress Theme. More stuff will find it's way here as relevant.

Changes/Fixes
  Version 1.1 
    # [ADDED] - Better IE6 support.
    # [ADDED] - Style text elements (blockquote, pre, code, etc.)
    # [ADDED] - make page children pop above taskbar buttons (think “Taskbar Preview”)
    # [ADDED] - Better description of theme/features for next WordPress Extend posting.
    # [ADDED] - Add a Readme File to the theme, and urge people to read it first.
    # [ADDED] - ability to click on post title and go to full post
    # [ADDED] - Add “last edited date” on post footer
    # [ADDED] - make the “Change Theme” options more apparent/obvious
    # [ADDED] - Support for the “wrapper” element id.
    # [FIXED] - Sidebar glitch with UL in Lightweight theme.
    # [FIXED] - “About This Post” links don’t all work.
    # [FIXED] - Proper, complete and final fix for the “clear:both” bug.
    
  Version 1.0.01
      # Initial Release

Notes
  1. Theme is Bandwidth Heavy
    I know. It's emulating a well known GUI from a neat looking operating
    system, also known for it's heaviness. What did you expect? :) If this is
    really a problem for you, either don't use the theme or take a look below
    at "Tips and Tricks" to find out how to force the default sub-theme to
    be the "Lightweight" theme.
    
  2. Some things aren't in the right place
    I know, I may have bucked WordPress theme tradition and placed things in
    weird places, or changed the way some "holy" things display information, 
    but I disagreed with the way they were doing things, and I'm not one to
    follow the rules if the rules are stupid. If you disagree, feel free to 
    modify the theme to your liking.
  
Tips and Tricks
  1. User Changed Sub-Themes
    Don't forget, there are multiple Sub-Themes, not just the default black/blue
    "Void" theme. If your viewers change this theme, that change only appears
    for them, and reappears each time they visit, that is if they allow cookies.
    
  2. Admin Changed Sub-Theme
    It is possible to change the default Sub-Theme, so that your visitors will
    see something other than the default black/blue "void" theme when they first
    visit. As of the time of posting, this can only be changed by manually
    modifying one of the theme's core files. This may be hacked later to allow
    you to change it from the WordPress admin area. No guarantees.
      If you open up the "js" folder in the theme's folder, and then open up
    "functions.js" and look at the top for a line that looks like this:
    
        var defaultstyle = ""; // Default Theme
      
    By placing the right magic word between those double-quotes, you can make
    the theme pull a different default Sub-Theme. Those magic words are:
    
      [nothing between the quotes]    = "Void" theme - dark blacks, blues, greys
      water-theme                     = "Water" theme - Deep blues
      life-theme                      = "Life" theme - Pretty greens
      earth-theme                     = "Earth" theme - brown earth tones
      wind-theme                      = "Wind" theme - light blue, clouds
      fire-theme                      = "Fire" theme - Fire orange
      lite-theme                      = "Lightweight" theme - very few graphics
      
    