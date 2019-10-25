<?php

shell_exec("java -jar ffdec/ffdec.jar -swf2xml {$argv[1]} tmp.xml");

file_put_contents('tmp.xml', preg_replace('~3c(2f)?67726170686963733e~i', null, file_get_contents('tmp.xml')));

shell_exec("java -jar ffdec/ffdec.jar -xml2swf tmp.xml {$argv[1]}");
