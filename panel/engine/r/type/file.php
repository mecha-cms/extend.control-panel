<?php

if (is_dir($f = $_['f']) && 'g' === $_['task']) {
    Alert::error('Path %s is not a %s.', ['<code>' . _\lot\x\panel\h\path($f) . '</code>', 'file']);
    Guard::kick($url . $_['/'] . '/::g::/' . $_['path'] . $url->query('&', [
        'type' => false
    ]) . $url->hash);
}

$type = $f && is_file($f) ? mime_content_type($f) : null;
$name = 'g' === $_['task'] ? basename($f) : "";

$editable = 's' === $_['task'];
if (0 === strpos($type, 'text/') || 'inode/x-empty' === $type || 'image/svg+xml' === $type) {
    $editable = true;
}
if (0 === strpos($type, 'application/')) {
    $editable = false !== strpos(',javascript,json,ld+json,php,x-httpd-php,x-httpd-php-source,x-php,xhtml+xml,xml,', ',' . substr($type, 12) . ',');
}

// -2: Unreadable
// -1: Missing
// +0: Empty
// +1: Printable
// +2: ASCII
// +3: Binary

// TODO: Add it to the core! :*
// <https://stackoverflow.com/a/60861168>
$check_mode = static function($filename, $printable = false, $buffer_size = 256) {
    if(is_bool($printable) === false || is_int($buffer_size) === false)
        return false;
    $buffer_size = floor($buffer_size);
    if($buffer_size <= 0)
        return false;
    if(is_file($filename)) {
        if(is_readable($filename)) {
            $size = filesize($filename);
            if($size === 0)
                return 0; // Empty
            if($buffer_size > $size)
                $buffer_size = $size;
            $chunks = ceil($size / $buffer_size);
            $handle = fopen($filename, 'rb');
            for($chunk = 0; $chunk < $chunks; ++$chunk) {
                $buffer = fread($handle, $buffer_size);
                if(preg_match('/[\x80-\xFF]/', $buffer)) {
                    fclose($handle);
                    return 3; // Binary
                }
                else
                    if($printable === true)
                        $printable = ctype_print($buffer);
            }
            fclose($handle);
            return $printable === true ? 1 : 2; // Printable or ASCII
        }
        else
            return -2; // Unreadable
    }
    else
        return -1; // Missing
};

if (!$editable) {
    $test = $check_mode($f);
    $editable = 0 === $test || 1 === $test || 2 === $test;
}

$content = 'g' === $_['task'] && $f && $editable ? file_get_contents($f) : "";

if ("" === $name) $name = null;
if ("" === $content) $content = null;

$trash = $_['trash'] ? date('Y-m-d-H-i-s') : false;

return [
    'bar' => [
        // type: bar
        'lot' => [
            // type: bar/menu
            0 => [
                'lot' => [
                    'folder' => ['skip' => true],
                    'link' => [
                        'url' => $url . $_['/'] . '/::g::/' . ('g' === $_['task'] ? dirname($_['path']) : $_['path']) . '/1' . $url->query('&', ['tab' => false, 'type' => false]) . $url->hash,
                        'skip' => false
                    ],
                    's' => [
                        'icon' => 'M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z',
                        'title' => false,
                        'description' => ['New %s', 'File'],
                        'url' => str_replace('::g::', '::s::', dirname($url->clean)) . $url->query('&', ['tab' => false, 'type' => 'file']) . $url->hash,
                        'skip' => 's' === $_['task'],
                        'stack' => 10.5
                    ]
                ]
            ]
        ]
    ],
    'desk' => [
        // type: desk
        'lot' => [
            'form' => [
                // type: form/post
                'lot' => [
                    'fields' => [
                        'type' => 'fields',
                        'lot' => [ // Hidden field(s)
                            'token' => [
                                'type' => 'hidden',
                                'value' => $_['token']
                            ]
                        ],
                        'stack' => -1
                    ],
                    1 => [
                        // type: Section
                        'lot' => [
                            'tabs' => [
                                // type: Tabs
                                'lot' => [
                                    'file' => [
                                        'lot' => [
                                            'fields' => [
                                                'type' => 'fields',
                                                'lot' => [
                                                    'content' => [
                                                        'type' => 'source',
                                                        'name' => 'file[content]',
                                                        'alt' => 'Content goes here...',
                                                        'value' => $content,
                                                        'width' => true,
                                                        'height' => true,
                                                        'skip' => !$editable,
                                                        'stack' => 10
                                                    ],
                                                    'name' => [
                                                        'type' => 'text',
                                                        'pattern' => "^([_.]?[a-z\\d]+([_.-][a-z\\d]+)*)?\\.(" . implode('|', array_keys(array_filter(File::$state['x']))) . ")$",
                                                        'focus' => true,
                                                        'name' => 'file[name]',
                                                        'alt' => 'g' === $_['task'] ? ($name ?? 'foo-bar.baz') : 'foo-bar.baz',
                                                        'value' => $name,
                                                        'width' => true,
                                                        'stack' => 20
                                                    ]
                                                ],
                                                'stack' => 10
                                            ]
                                        ],
                                        'stack' => 10
                                    ]
                                ]
                            ]
                        ]
                    ],
                    2 => [
                        // type: section
                        'lot' => [
                            'fields' => [
                                'type' => 'fields',
                                'lot' => [
                                    0 => [
                                        'title' => "",
                                        'type' => 'field',
                                        'lot' => [
                                            'tasks' => [
                                                'type' => 'tasks/button',
                                                'lot' => [
                                                    's' => [
                                                        'title' => 'g' === $_['task'] ? 'Update' : 'Create',
                                                        'description' => ['Save to %s', _\lot\x\panel\h\path($_['f'])],
                                                        'type' => 'submit',
                                                        'name' => false,
                                                        'stack' => 10
                                                    ],
                                                    'l' => [
                                                        'title' => 'Delete',
                                                        'type' => 'link',
                                                        'url' => str_replace('::g::', '::l::', $url->clean . $url->query('&', [
                                                            'token' => $_['token'],
                                                            'trash' => $trash,
                                                            'type' => 'file'
                                                        ])),
                                                        'skip' => 's' === $_['task'],
                                                        'stack' => 20
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'stack' => 10
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
