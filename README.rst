Script Natalizio
================

Use this one liner to change to Christmas!

perl -i -pe 's/\$natale = 0/\$natale = 1/g' index.*

and this to go back to normal

perl -i -pe 's/\$natale = 1/\$natale = 0/g' index.*
