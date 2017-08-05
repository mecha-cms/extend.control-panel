<?php

// Load the main task(s)…
require __DIR__ . DS . '..' . DS . 'worker' . DS . 'page.php';

// Do not allow user to create page child(s)…
if ($__f && $__command === 's') {
    Shield::abort(PANEL_404);
}

// Set custom file manager layout
Config::set('panel.l', 'page');

// Set or modify the default panel content(s)…
$__x = $__page[0] ? $__page[0]->state : 'page';
Config::set('panel.f.page', [
    'x' => [
        'values' => [
            '*' . $__x => $__command === 's' ? null : $language->update,
            'page' => $__x === 'page' ? null : $language->create,
            'draft' => $__x === 'draft' ? null : $language->save,
            'archive' => null
        ],
        'order' => ['*' . $__x, 'page', 'draft', 'trash'],
    ],
    '+[time]' => null,
    'link' => null,
    'tags' => null
]);

Config::set('panel.s', [
    1 => [
        'kin' => [
            'stack' => 20
        ],
        'current' => null,
        'parent' => null,
        'setting' => null
    ],
    2 => [
        'id' => [
            'content' => __DIR__ . DS . '..' . DS . 'page' . DS . 'tag' . DS . '-id.php',
            'stack' => 20
        ],
        'child' => null
    ]
]);