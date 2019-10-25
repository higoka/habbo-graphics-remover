<?php

function add(string $file): void
{
    shell_exec("java -jar ffdec/ffdec.jar -swf2xml {$file} tmp.xml");

    $name = basename($file, '.swf');
    $hex  = bin2hex("<visualizationData type=\"${name}\">");

    $content = file_get_contents('tmp.xml');
    $content = str_replace([$hex, '3c2f76697375616c697a6174696f6e446174613e'], ["{$hex}3c67726170686963733e", '3c2f67726170686963733e3c2f76697375616c697a6174696f6e446174613e'], $content);

    file_put_contents('tmp.xml', $content);
    shell_exec("java -jar ffdec/ffdec.jar -xml2swf tmp.xml {$file}");
}

function remove(string $file): void
{
    shell_exec("java -jar ffdec/ffdec.jar -swf2xml {$file} tmp.xml");
    file_put_contents('tmp.xml', preg_replace('~3c(2f)?67726170686963733e~i', null, file_get_contents('tmp.xml')));
    shell_exec("java -jar ffdec/ffdec.jar -xml2swf tmp.xml {$file}");
}

$type = $argv[1];

if ($type !== 'add' && $type !== 'remove') {
    exit("invalid argument: {$type}");
}

$path = $argv[2];

if (is_dir($path) === false) {
    call_user_func($type, $path);
} else {
    foreach (glob("{$path}/*.swf") as $file) {
        call_user_func($type, $file);
    }
}

exit("done.\n");
