
perl -i -pe 's/<div id="contatori">
				<!-- Contatori -->
							<?php
								define(\'__PHP_STATS_PATH__\',\'/web/htdocs/www.ctftaxi.it/home/stats/\');
								include(__PHP_STATS_PATH__.\'php-stats.redir.php\');
							?>
					<p>Utenti on line</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=0"></script></p>
					<p>Visitatori totali</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=3">Visitatori totali</script></p>
			</div>//g' index.php
