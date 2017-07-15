<?php

User::reset(Cookie::get('panel.c.user.key'));

// Delete trash…
foreach (File::explore(PAGE, true, true) as $k => $v) {
    if ($v === 0) continue;
    $s = Path::F($k);
    foreach (g($s, 'trash') as $v) {
        File::open($v)->delete();
    }
    if (Path::X($k) === 'trash') {
        File::open($k)->delete();
        if (Is::D($s)) {
            File::open($s)->delete();
        }
    }
}

// --ditto
foreach (g(LANGUAGE, 'trash') as $v) {
    File::open($v)->delete();
}

Message::success('user_exit');
Hook::NS('on.user.exit');
Guardian::kick($__state->path . '/::g::/enter');