<?php

require __DIR__ . DS . '3.php';

if ('g' === $_['task'] && $user->path === $_['f']) {
    // Hide navigation bar
    $_['lot']['bar']['hidden'] = true;
    $_['lot']['desk']['lot']['form']['lot'][0]['title'] = $user['author'];
    $_['lot']['desk']['lot']['form']['lot'][0]['description'] = 'Waiting for reviews.';
    $_['lot']['desk']['lot']['form']['lot'][0]['content'] = '<p>' . i('While waiting to be reviewed, you can update your user information at any time.') . '</p>';
}
