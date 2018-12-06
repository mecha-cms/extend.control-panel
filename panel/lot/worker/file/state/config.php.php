<?php

$languages = $shields = $zones = [];

foreach (glob(LANGUAGE . DS . '*.page', GLOB_NOSORT) as $v) {
    $languages[Path::N($v)] = (new Page($v))->title;
}

foreach (glob(SHIELD . DS . '*' . DS . 'about.page', GLOB_NOSORT) as $v) {
    $shields[basename(dirname($v))] = (new Page($v))->title;
}

call_user_func(function() use(&$zones) {
    $regions = [
        \DateTimeZone::AFRICA,
        \DateTimeZone::AMERICA,
        \DateTimeZone::ANTARCTICA,
        \DateTimeZone::ASIA,
        \DateTimeZone::ATLANTIC,
        \DateTimeZone::AUSTRALIA,
        \DateTimeZone::EUROPE,
        \DateTimeZone::INDIAN,
        \DateTimeZone::PACIFIC,
    ];
    $timezones = [];
    $timezone_offsets = [];
    foreach ($regions as $region) {
        $timezones = array_merge($timezones, \DateTimeZone::listIdentifiers($region));
    }
    foreach ($timezones as $timezone) {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }
    asort($timezone_offsets);
    foreach($timezone_offsets as $zone => $offset) {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate('H:i', abs($offset));
        $zones[$zone] = 'GMT' . $offset_prefix . $offset_formatted . ' &#x00B7; ' . strtr($zone, '_', ' ');
    }
});

$key = 'panel.desk.body.tab.file.field.file[?]';
Config::set($key . '[zone]', [
    'type' => 'select',
    'values' => $zones
]);
Config::set($key . '[charset].width', false);
Config::set($key . '[language]', [
    'type' => 'select',
    'width' => false,
    'values' => $languages
]);
Config::set($key . '[direction]', [
    'type' => 'radio[]',
    'width' => false,
    'values' => [
        'ltr' => 'LTR',
        'rtl' => 'RTL'
    ]
]);

Config::reset($key . '[page]');
Hook::set('on.ready', function() use($key, $language, $shields, $site) {
    $editors = (array) $language->o_page_editor;
    Config::set('panel.desk.body.tab', [
        'site' => [
            'field' => [
                'file[?][title]' => [
                    'key' => 'title',
                    'type' => 'text',
                    'width' => true,
                    'value' => $site->title,
                    'stack' => 10
                ],
                'file[?][description]' => [
                    'key' => 'description',
                    'type' => 'textarea',
                    'width' => true,
                    'value' => $site->description,
                    'stack' => 10.1
                ],
                'file[?][shield]' => [
                    'key' => 'shield',
                    'type' => 'select',
                    'value' => $site->shield,
                    'values' => $shields,
                    'stack' => 10.2
                ]
            ],
            'stack' => 10.1
        ],
        'page' => [
            'field' => [
                'file[?][page][title]' => [
                    'key' => 'title',
                    'type' => 'text',
                    'width' => true,
                    'value' => $site->page->title ?? null,
                    'placeholder' => $language->field_hint_page_title,
                    'stack' => 10
                ],
                'file[?][page][content]' => [
                    'key' => 'content',
                    'type' => 'source',
                    'width' => true,
                    'height' => true,
                    'value' => $site->page->content ?? null,
                    'placeholder' => $language->field_hint_file_content,
                    'stack' => 10.1
                ],
                'file[?][page][type]' => [
                    'key' => 'type',
                    'type' => 'select',
                    'value' => $site->page->type ?? null,
                    'values' => (array) $language->o_page_type,
                    'kind' => ['select-input'],
                    'stack' => 10.3
                ],
                'file[?][page][editor]' => $editors ? [
                    'key' => 'editor',
                    'type' => 'select',
                    'value' => $site->page->editor ?? null,
                    'values' => concat(["" => ""], $editors),
                    'stack' => 10.4
                ] : null,
                'file[?][page][author]' => isset($site->page->author) ? [
                    'key' => 'author',
                    'type' => 'hidden',
                    'value' => $site->page->author,
                    'stack' => 0
                ] : null
            ],
            'stack' => 10.2
        ]
    ]);
    Config::reset([
        $key . '[title]',
        $key . '[description]',
        $key . '[shield]'
    ]);
}, .2);

// You can’t delete this file
Config::set('panel.desk.footer.tool.r.hidden', true);