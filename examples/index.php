<?php

include dirname(__DIR__) . '/vendor/autoload.php';

use Javiertapia\ChordsMlPhp\Environment;
use Javiertapia\ChordsMlPhp\Source;

$lam = "lam:x-0-2-2-1-0";
$mib = "Mib:3-6-5-3-4-3";

$chords = [
    "lam:x-0-2-2-1-0",
    "Mib:3-6-5-3-4-3",
    "mim7*:0-x-2-4-3-3",
    "lam7*:5-7-7-5-8-5"
];

try {
    foreach ($chords as $chord) {
        $src = new Source($chord);
        $environment = new Environment($src);
        if (php_sapi_name() === 'cli') {
            fwrite(STDOUT, $environment->render() . PHP_EOL . PHP_EOL);
        } else {
            echo '<pre>';
            echo $environment->render();
            echo '</pre>';
            echo '<hr>';
        }
    }
} catch (Throwable $e) {
    die($e->getMessage());
}
