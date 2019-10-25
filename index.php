<?php

function remove(string $file): void
{
    shell_exec("java -jar ffdec/ffdec.jar -swf2xml {$file} tmp.xml");
    file_put_contents('tmp.xml', preg_replace('~3c(2f)?67726170686963733e~i', null, file_get_contents('tmp.xml')));
    shell_exec("java -jar ffdec/ffdec.jar -xml2swf tmp.xml {$file}");
}

$path = $argv[1];

if (is_dir($path) === false) {
    remove($path);
} else {
    foreach (glob("{$path}/*.swf") as $file) {
        remove($file);
    }
}

exit("done\n");
