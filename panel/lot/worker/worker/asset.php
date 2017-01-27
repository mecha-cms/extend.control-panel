<?php

$s = PANEL . DS . 'lot' . DS . 'asset' . DS . 'css' . DS;

Asset::set([
    $s . 'panel.min.css',
    // $s . 'panel.k.min.css',
    $s . 'panel.code-mirror.min.css',
    $s . 'panel.t-i-b.min.css',
    $s . 'panel.t-p.min.css'
], [
    10,
    // 11,
    12,
    13,
    14
]);

$s = PANEL . DS . 'lot' . DS . 'asset' . DS . 'js' . DS;

Asset::set([
    $s . 'panel.min.js',
    $s . 'panel.fire.min.js',
    $s . 'panel.k.min.js',
    $s . 'panel.k.fire.min.js',
    $s . 'panel.code-mirror.min.js',
    $s . 'panel.code-mirror.fire.min.js',
    $s . 'panel.t-i-b.min.js',
    $s . 'panel.t-i-b.fire.min.js',
    $s . 'panel.t-p.js',
    $s . 'panel.t-p.fire.min.js'
], [
    10,
    10.1,
    11,
    11.1,
    12,
    12.1,
    13,
    13.1,
    14,
    14.1
]);

if ($fn = File::exist($__path_shield . DS . 'index.php')) require $fn;
if ($__is_enter) {
    Hook::set('shield.output', function($content) {
        $s = [];
        foreach (get_defined_constants(true)['user'] as $k => $v) {
            if (is_string($v)) {
                $v = x($v); // :(
            }
            $s[] = '$.' . $k . '=' . json_encode($v) . ';';
        }
        return preg_replace('#(\/panel\.min\.js(?:\W.+)?"><\/script>)#', '$1<script>!function($){' . str_replace('$', '\\$', implode("", $s)) . '$.Language.lot=' . json_encode(Language::get()) . '}(Panel);</script>', $content);
    }, 1);
}