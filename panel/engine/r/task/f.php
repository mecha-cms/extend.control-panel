<?php namespace _\lot\x\panel\task\f;

$GLOBALS['_']['fn'] = $_['fn'] = $fn = \array_shift($_['chops']);
$GLOBALS['_']['chops'] = $_['chops'];
$GLOBALS['_']['f'] = $_['f'] = \stream_resolve_include_path(\LOT . \DS . \implode(\DS, $_['chops'])) ?: null;
$GLOBALS['_']['form'] = $_['form'] = \e($GLOBALS['_' . ($_SERVER['REQUEST_METHOD'] ?? 'GET')] ?? []);

if (\is_file($_f = __DIR__ . \DS . 'f' . \DS . $fn . '.php')) {
    \Hook::set('do.task.' . $fn, function() use($_f) {
        extract($GLOBALS, \EXTR_SKIP);
        return require $_f;
    }, 10);
} else if (\function_exists($fn = "\\_\\lot\\x\\panel\\task\\f\\" . $fn)) {
    \Hook::set('do.task.' . $fn, function() use($fn) {
        return \call_user_func($fn, $GLOBALS['_']);
    }, 10);
}

if ($r = \Hook::fire('do.task.' . $fn, [$_, $_['form']])) {
    $_ = $r;
}

$GLOBALS['_'] = $_; // Update data
