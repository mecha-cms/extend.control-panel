<?php namespace _\lot\x\panel\type;

function bar($value, $key) {
    if (\array_key_exists('title', $value) && !\array_key_exists('level', $value)) {
        $value['level'] = 1;
    }
    if (isset($value['lot'])) {
        foreach ($value['lot'] as &$v) {
            // If `type` is not defined, the default value will be `links`
            if (!\array_key_exists('type', $v)) {
                $v['type'] = 'links';
                // Remove the wrapper `<div>`
                $v[0] = false;
            }
        }
        unset($v);
        $out = \_\lot\x\panel\type\lot($value, $key);
    } else if (isset($value['content'])) {
        $out = \_\lot\x\panel\type\content($value, $key);
    }
    $out[0] = 'nav';
    return $out;
}

function button($value, $key) {
    $out = \_\lot\x\panel\type\link($value, $key);
    $out[0] = 'button';
    $out['class'] = 'button';
    $out['disabled'] = isset($value['active']) && !$value['active'];
    $out['name'] = $value['name'] ?? $key;
    $out['value'] = $value['value'] ?? null;
    unset($out['href'], $out['target']);
    return $out;
}

function description($value, $key) {
    $description = $value[1] ?? $value['content'] ?? "";
    $description = \w('<!--0-->' . \i(...((array) $description)), ['a', 'abbr', 'b', 'code', 'del', 'em', 'i', 'ins', 'span', 'strong', 'sub', 'sup']);
    if ('0' !== $description && !$description) {
        return;
    }
    $out = [
        0 => $value[0] ?? 'p',
        1 => $description,
        2 => $value[2] ?? []
    ];
    \_\lot\x\panel\_set_class($out[2], \array_replace([
        'description' => true
    ], $value['tags'] ?? []));
    return new \HTML($out);
}

function desk($value, $key) {
    $styles = $tags = [];
    if (isset($value['width']) && false !== $value['width']) {
        $tags['width'] = true;
        if (true !== $value['width']) {
            $styles['width'] = $value['width'];
        }
    }
    if (!isset($value[2])) {
        $value[2] = [];
    }
    \_\lot\x\panel\_set_class($value[2], $tags);
    \_\lot\x\panel\_set_style($value[2], $styles);
    if (isset($value['content'])) {
        $out = \_\lot\x\panel\type\content($value, $key);
        $out[0] = 'main';
        return $out;
    }
    if (isset($value['lot'])) {
        $out = \_\lot\x\panel\type\lot($value, $key);
        $out[0] = 'main';
        return $out;
    }
    return new \HTML([
        0 => $value[0] ?? 'main',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ]);
}

function field($value, $key) {
    $is_active = !isset($value['active']) || $value['active'];
    $is_lock = !empty($value['lock']);
    $is_vital = !empty($value['vital']);
    $tags_status = [
        'has:pattern' => !empty($value['pattern']),
        'is:active' => $is_active,
        'is:lock' => $is_lock,
        'is:vital' => $is_vital,
        'not:active' => !$is_active,
        'not:lock' => !$is_lock,
        'not:vital' => !$is_vital
    ];
    $tags = [
        'field' => true,
        'has:title' => !empty($value['title']),
        'p' => true
    ];
    if (isset($value['type'])) {
        $tags[\strtr($value['type'], '/', ':')] = true;
    }
    $id = $value['id'] ?? 'f:' . \dechex(\time());
    $value[2]['id'] = $value[2]['id'] ?? \strtr($id, ['f:' => 'field:']);
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    if (!\array_key_exists('title', $value) || false !== $value['title']) {
        $title = \_\lot\x\panel\to\title($value['title'] ?? \To::title($key), -2);
        $out[1] .= '<label' . ("" === \strip_tags($title) ? ' class="count:0"' : "") . ' for="' . $id . '">' . $title . '</label>';
        $tags['has:title'] = true;
    }
    $tags['has:description'] = !empty($value['description']);
    $before = "";
    $after = "";
    foreach (['before', 'after'] as $v) {
        if (isset($value[$v])) {
            if (\is_string($value[$v])) {
                ${$v} = '<span class="fix"><span>' . $value[$v] . '</span></span>';
            } else if (\is_array($value[$v])) {
                $icon = \_\lot\x\panel\to\icon($value[$v]['icon'] ?? []);
                \_\lot\x\panel\_set_class($icon[0], ['fix' => true]);
                ${$v} = $icon[0];
            }
        }
    }
    if (isset($value['content'])) {
        if (\is_array($value['content'])) {
            $styles = $tags_status_extra = [];
            if (isset($value['height']) && false !== $value['height']) {
                $tags_status_extra['height'] = true;
                if (true !== $value['height']) {
                    $styles['height'] = $value['height'];
                }
            }
            if (isset($value['width']) && false !== $value['width']) {
                $tags_status_extra['width'] = true;
                if (true !== $value['width']) {
                    $styles['width'] = $value['width'];
                }
            }
            if (\is_array($value['content'])) {
                \_\lot\x\panel\_set_class($value['content'][2], \array_replace($tags_status, $tags_status_extra));
                \_\lot\x\panel\_set_style($value['content'][2], $styles);
            }
        }
        $out[1] .= '<div>';
        $out[1] .= $before || $after ? '<div class="lot lot:f' . (!empty($value['width']) ? ' width' : "") . '">' : "";
        $out[1] .= $before;
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
        $out[1] .= $after;
        $out[1] .= $before || $after ? '</div>' : "";
        $out[1] .= \_\lot\x\panel\to\description($value['description'] ?? "");
        $out[1] .= '</div>';
    } else if (isset($value['lot'])) {
        $count = 0;
        $out[1] .= '<div>';
        $out[1] .= '<div class="lot">';
        $out[1] .= \_\lot\x\panel\to\lot($value['lot'], $count, $value['sort'] ?? true);
        $out[1] .= '</div>';
        $out[1] .= \_\lot\x\panel\to\description($value['description'] ?? "");
        $out[1] .= '</div>';
    }
    \_\lot\x\panel\_set_class($out[2], \array_replace($tags, $tags_status, $value['tags'] ?? []));
    if (isset($value['form']) && \is_array($value['form'])) {
        foreach ($value['form'] as $k => $v) {
            if (null === $v || false === $v) {
                continue;
            }
            if (\is_array($v) || \is_object($v)) {
                $v = \json_encode($v);
            }
            $out[1] .= new \HTML(['input', false, [
                'name' => $k,
                'type' => 'hidden',
                'value' => $v
            ]]);
        }
    }
    return new \HTML($out);
}

function fields($value, $key) {
    $tags = \array_replace([
        'lot' => true,
        'lot:fields' => true,
        'p' => true
    ], $value['tags'] ?? []);
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    $append = "";
    $title = \_\lot\x\panel\to\title($value['title'] ?? "", $value['level'] ?? 3);
    $description = \_\lot\x\panel\to\description($value['description'] ?? "");
    if (isset($value['content'])) {
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    } else if (isset($value['lot'])) {
        \_\lot\x\panel\_set_type_prefix($value['lot'], 'field');
        foreach ((new \Anemon($value['lot']))->sort([1, 'stack', 10], true) as $k => &$v) {
            if (null === $v || false === $v || !empty($v['skip'])) {
                continue;
            }
            $type = $v['type'] ?? null;
            if ($type && \function_exists($fn = __NAMESPACE__ . "\\" . \strtr($type, [
                '/' => "\\",
                '-' => '_',
                '.' => '__'
            ]))) {
                if ('field/hidden' !== $type) {
                    $out[1] .= \call_user_func($fn, $v, $k);
                } else {
                    $append .= \_\lot\x\panel\type\field\hidden($v, $k);
                }
            } else {
                $append .= \_\lot\x\panel\type\field\_($v, $k); // Unknown `field` type
            }
            unset($v);
        }
        $out[1] .= $append;
    }
    $out[1] = $title . $description . $out[1];
    \_\lot\x\panel\_set_class($out[2], $tags);
    return "" !== $out[1] ? new \HTML($out) : null;
}

function file($value, $key) {
    $tags = \array_replace($value['tags'] ?? [], [
        'is:file' => true,
        'not:active' => isset($value['active']) && !$value['active']
    ]);
    $out = [
        0 => 'li',
        1 => "",
        2 => []
    ];
    $out[1] .= '<h3>' . \_\lot\x\panel\type\link([
        'description' => $value['description'] ?? null,
        'link' => $value['link'] ?? null,
        'title' => $value['title'] ?? null,
        'url' => $value['url'] ?? null
    ], $key) . '</h3>';
    $out[1] .= \_\lot\x\panel\type\tasks\link([
        '0' => 'p',
        'lot' => $value['tasks'] ?? []
    ], 0);
    \_\lot\x\panel\_set_class($out[2], $tags);
    return new \HTML($out);
}

function files($value, $key) {
    $out = [
        0 => 'ul',
        1 => "",
        2 => []
    ];
    $lot = [];
    if (isset($value['lot'])) {
        foreach ($value['lot'] as $k => $v) {
            if (null === $v || false === $v || !empty($v['skip'])) {
                continue;
            }
            $lot[$k] = $v;
        }
        if (!empty($value['sort'])) {
            $sort = $value['sort'];
            if (true === $sort) {
                $sort = [1, 'stack', 10];
            }
            $lot = (new \Anemon($lot))->sort($sort)->get();
        }
    }
    $count = 0;
    foreach ($lot as $k => $v) {
        $path = \rtrim($v['path'] ?? "", \DS);
        if (!empty($v['current']) || $path && (
            isset($_SESSION['_']['file'][$path]) ||
            isset($_SESSION['_']['folder'][$path])
        )) {
            $v['tags']['is:active'] = true;
            unset($_SESSION['_']['file'][$path]);
            unset($_SESSION['_']['folder'][$path]);
        }
        if (!\array_key_exists('type', $v)) {
            $v['type'] = 'file';
        }
        $out[1] .= \_\lot\x\panel\type($v, $k);
        ++$count;
    }
    unset($lot);
    \_\lot\x\panel\_set_class($out[2], \array_replace([
        'count:' . $count => true,
        'lot' => true,
        'lot:files' => true
    ], $value['tags'] ?? []));
    return new \HTML($out);
}

function folder($value, $key) {
    $tags = \array_replace([
        'is:folder' => true,
        'not:active' => isset($value['active']) && !$value['active']
    ], $value['tags'] ?? []);
    $out = [
        0 => 'li',
        1 => "",
        2 => []
    ];
    $out[1] .= '<h3>' . \_\lot\x\panel\type\link([
        'description' => $value['description'] ?? \i('Open folder'),
        'link' => $value['link'] ?? null,
        'title' => $value['title'] ?? null,
        'url' => $value['url'] ?? null
    ], $key) . '</h3>';
    $out[1] .= \_\lot\x\panel\type\tasks\link([
        '0' => 'p',
        'lot' => $value['tasks'] ?? []
    ], 0);
    \_\lot\x\panel\_set_class($out[2], $tags);
    return new \HTML($out);
}

function folders($value, $key) {
    return \_\lot\x\panel\type\files($value, $key);
}

function form($value, $key) {
    $out = [
        0 => $value[0] ?? 'form',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    if (isset($value['active']) && empty($value['active'])) {
        // Set node name to `false` to remove the `<form>` element
        $out[0] = false;
    }
    if (isset($value['content'])) {
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    } else if (isset($value['lot'])) {
        $count = 0;
        $out[1] .= \_\lot\x\panel\to\lot($value['lot'], $count, $value['sort'] ?? true);
    }
    $href = $value['link'] ?? $value['url'] ?? null;
    if (!isset($out[2]['action'])) {
        $out[2]['action'] = $href;
    }
    if (!isset($out[2]['name'])) {
        $out[2]['name'] = $value['name'] ?? $key;
    }
    \_\lot\x\panel\_set_class($out[2], $value['tags'] ?? []);
    return new \HTML($out);
}

function icon($value, $key) {
    $icon = \array_replace([null, null], (array) ($value['content'] ?? $value['lot'] ?? []));
    if ($icon[0] && false === \strpos($icon[0], '<')) {
        if (!isset($GLOBALS['_']['icon'][$id = \dechex(\crc32($icon[0]))])) {
            $GLOBALS['_']['icon'][$id] = $icon[0];
        }
        $icon[0] = new \HTML(['svg', '<use href="#icon:' . $id . '"></use>', [
            'class' => 'icon',
            'height' => 12,
            'width' => 12
        ]]);
    }
    if ($icon[1] && false === \strpos($icon[1], '<')) {
        if (!isset($GLOBALS['_']['icon'][$id = \dechex(\crc32($icon[1]))])) {
            $GLOBALS['_']['icon'][$id] = $icon[1];
        }
        $icon[1] = new \HTML(['svg', '<use href="#icon:' . $id . '"></use>', [
            'class' => 'icon',
            'height' => 12,
            'width' => 12
        ]]);
    }
    return $icon;
}

function link($value, $key) {
    $out = [
        0 => $value[0] ?? 'a',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    if ("" === $out[1]) {
        $out[1] = \_\lot\x\panel\type\title([
            'description' => $value['description'] ?? null,
            'icon' => $value['icon'] ?? [],
            'level' => -1,
            'content' => $value['title'] ?? \To::title($key)
        ], $key);
    }
    $href = $value['link'] ?? $value['url'] ?? \P;
    $href = false === $href ? \P : (string) $href;
    $tags = \array_replace([
        'not:active' => \P === $href || (isset($value['active']) && !$value['active'])
    ], $value['tags'] ?? []);
    $out[2]['href'] = \P === $href ? null : $href;
    if (isset($value['id'])) {
        $out[2]['id'] = $value['id'];
    }
    $out[2]['target'] = $value[2]['target'] ?? (isset($value['link']) ? '_blank' : null);
    $out[2]['title'] = \i(...((array) ($value['description'] ?? [])));
    \_\lot\x\panel\_set_class($out[2], $tags);
    return new \HTML($out);
}

function links($value, $key) {
    $out = \_\lot\x\panel\type\menu($value, $key, -1);
    \_\lot\x\panel\_set_class($out, [
        'lot:links' => true,
        'lot:menu' => false
    ]);
    return $out;
}

function menu($value, $key, int $i = 0) {
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    $tags = \array_replace([
        'count:1' => true,
        'lot' => true,
        'lot:menu' => true,
        'p' => true
    ], $value['tags'] ?? []);
    if (isset($value['content'])) {
        $tags['count:1'] = true;
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    } else if (isset($value['lot'])) {
        $count = 0;
        foreach ((new \Anemon($value['lot']))->sort([1, 'stack', 10], true) as $k => $v) {
            if (null === $v || false === $v || !empty($v['skip'])) {
                continue;
            }
            ++$count;
            $li = [
                0 => 'li',
                1 => $v[1] ?? "",
                2 => $v[2] ?? []
            ];
            if (isset($v['type'])) {
                if ('separator' === $v['type']) {
                    $li[2]['class'] = 'is:separator';
                } else {
                    $li[1] .= \_\lot\x\panel\type($v, $k);
                }
            } else if (\is_array($v)) {
                if (\array_key_exists('icon', $v)) {
                    $v['icon'] = (array) $v['icon'];
                }
                $caret = false;
                if (!empty($v['lot']) && (!empty($v['caret']) || !\array_key_exists('caret', $v))) {
                    $v['icon'][1] = $v['caret'] ?? ($i < 0 ? 'M7,10L12,15L17,10H7Z' : 'M10,17L15,12L10,7V17Z');
                    $caret = true;
                }
                $v['icon'] = \_\lot\x\panel\to\icon($v['icon'] ?? []);
                if ($caret) {
                    \_\lot\x\panel\_set_class($v['icon'][1], ['caret' => true]);
                }
                $a = \array_replace([
                    'is:current' => !empty($v['current']),
                    'not:active' => isset($v['active']) && !$v['active']
                ], $v['tags'] ?? []);
                if (!isset($v[1])) {
                    $li[1] = \_\lot\x\panel\type\link($v, $k);
                    if (!empty($v['lot'])) {
                        $div = \_\lot\x\panel\type\menu($v, $k, $i + 1); // Recurse
                        \_\lot\x\panel\_set_class($div, [
                            'lot' => true,
                            'lot:menu' => true,
                            'p' => true
                        ]);
                        $li[1] .= $div;
                        if ($i < 0) {
                            $a['has:menu'] = true;
                        }
                    }
                }
                \_\lot\x\panel\_set_class($li[2], $a);
            } else {
                $li[1] = \_\lot\x\panel\type\link(['title' => $v], $k);
            }
            $out[1] .= new \HTML($li);
        }
    }
    \_\lot\x\panel\_set_class($out[2], $tags);
    if ("" !== $out[1]) {
        $out[1] = '<ul class="count:' . $count . '">' . $out[1] . '</ul>';
    }
    return new \HTML($out);
}

function page($value, $key) {
    $tags = \array_replace([
        'is:file' => true,
        'not:active' => isset($value['active']) && !$value['active']
    ], $value['tags'] ?? []);
    $path = $value['path'] ?? $key;
    if (isset($value['invoke']) && \is_callable($value['invoke'])) {
        $value = \array_replace_recursive($value, \call_user_func($value['invoke'], $path));
        unset($value['invoke']);
    }
    if (!empty($value['skip'])) {
        return;
    }
    $out = [
        0 => 'li',
        1 => "",
        2 => []
    ];
    $date = isset($value['time']) ? \strtr($value['time'], '-', '/') : null;
    $out[1] .= '<div' . (isset($value['image']) && false === $value['image'] ? ' hidden' : "") . '>' . (!empty($value['image']) ? '<img alt="" height="72" src="' . \htmlspecialchars($value['image']) . '" width="72">' : '<span class="img" style="background: #' . \substr(\md5(\strtr($path, [
        \ROOT => "",
        \DS => '/'
    ])), 0, 6) . ';"></span>') . '</div>';
    $out[1] .= '<div><h3>' . \_\lot\x\panel\type\link([
        'link' => $value['link'] ?? null,
        'title' => $value['title'] ?? $date,
        'url' => $value['url'] ?? null
    ], $key) . '</h3>' . \_\lot\x\panel\to\description($value['description'] ?? $date) . '</div>';
    $out[1] .= '<div>' . \_\lot\x\panel\type\tasks\link([
        '0' => 'p',
        'lot' => $value['tasks'] ?? []
    ], 0) . '</div>';
    \_\lot\x\panel\_set_class($out[2], $tags);
    return new \HTML($out);
}

function pager($value, $key) {
    $pager = static function($current, $count, $chunk, $peek, $fn, $first, $prev, $next, $last) {
        $begin = 1;
        $end = (int) \ceil($count / $chunk);
        $out = "";
        if ($end <= 1) {
            return $out;
        }
        if ($current <= $peek + $peek) {
            $min = $begin;
            $max = \min($begin + $peek + $peek, $end);
        } else if ($current > $end - $peek - $peek) {
            $min = $end - $peek - $peek;
            $max = $end;
        } else {
            $min = $current - $peek;
            $max = $current + $peek;
        }
        if ($prev) {
            $out = '<span>';
            if ($current === $begin) {
                $out .= '<b title="' . $prev . '">' . $prev . '</b>';
            } else {
                $out .= '<a href="' . \call_user_func($fn, $current - 1) . '" title="' . $prev . '" rel="prev">' . $prev . '</a>';
            }
            $out .= '</span> ';
        }
        if ($first && $last) {
            $out .= '<span>';
            if ($min > $begin) {
                $out .= '<a href="' . \call_user_func($fn, $begin) . '" title="' . $first . '" rel="prev">' . $begin . '</a>';
                if ($min > $begin + 1) {
                    $out .= ' <span>&#x2026;</span>';
                }
            }
            for ($i = $min; $i <= $max; ++$i) {
                if ($current === $i) {
                    $out .= ' <b title="' . $i . '">' . $i . '</b>';
                } else {
                    $out .= ' <a href="' .\call_user_func($fn, $i) . '" title="' . $i . '" rel="' . ($current >= $i ? 'prev' : 'next') . '">' . $i . '</a>';
                }
            }
            if ($max < $end) {
                if ($max < $end - 1) {
                    $out .= ' <span>&#x2026;</span>';
                }
                $out .= ' <a href="' . \call_user_func($fn, $end) . '" title="' . $last . '" rel="next">' . $end . '</a>';
            }
            $out .= '</span>';
        }
        if ($next) {
            $out .= ' <span>';
            if ($current === $end) {
                $out .= '<b title="' . $next . '">' . $next . '</b>';
            } else {
                $out .= '<a href="' . \call_user_func($fn, $current + 1) . '" title="' . $next . '" rel="next">' . $next . '</a>';
            }
            $out .= '</span>';
        }
        return $out;
    };
    $value['content'] = $content = $pager($value['current'] ?? 1, $value['count'] ?? 0, $value['chunk'] ?? 20, 2, function($i) {
        extract($GLOBALS, \EXTR_SKIP);
        return $url . $_['/'] . '/::g::/' . $_['path'] . '/' . $i . $url->query . $url->hash;
    }, \i('First'), \i('Previous'), \i('Next'), \i('Last'));
    $value['tags'] = \array_replace([
        'lot' => true,
        'lot:pager' => true
    ], $value['tags'] ?? []);
    $out = \_\lot\x\panel\type\content($value, $key);
    $out[0] = 'p';
    return "" !== $content ? $out : null;
}

function pages($value, $key) {
    $out = [
        0 => 'ul',
        1 => "",
        2 => []
    ];
    $lot = [];
    if (isset($value['lot'])) {
        foreach ($value['lot'] as $k => $v) {
            if (null === $v || false === $v || !empty($v['skip'])) {
                continue;
            }
            $lot[$k] = $v;
        }
        if (!empty($value['sort'])) {
            $sort = $value['sort'];
            if (true === $sort) {
                $sort = [1, 'stack', 10];
            }
            $lot = (new \Anemon($lot))->sort($sort)->get();
        }
    }
    $count = 0;
    foreach ($lot as $k => $v) {
        $path = \rtrim($v['path'] ?? "", \DS);
        if (!empty($v['current']) || $path && isset($_SESSION['_']['file'][$path])) {
            $v['tags']['is:active'] = true;
            unset($_SESSION['_']['file'][$path]);
        }
        if (!\array_key_exists('type', $v)) {
            $v['type'] = 'page';
        }
        $out[1] .= \_\lot\x\panel\type($v, $k);
        ++$count;
    }
    unset($lot);
    \_\lot\x\panel\_set_class($out[2], \array_replace([
        'count:' . $count => true,
        'lot' => true,
        'lot:pages' => true
    ], $value['tags'] ?? []));
    return new \HTML($out);
}

function section($value, $key) {
    if (isset($value['content'])) {
        $out = \_\lot\x\panel\type\content($value, $key);
        $out[0] = 'section';
        return $out;
    }
    if (isset($value['lot'])) {
        $out = \_\lot\x\panel\type\lot($value, $key);
        $out[0] = 'section';
        return $out;
    }
    return new \HTML([
        0 => $value[0] ?? 'section',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ]);
}

function separator($value, $key) {
    return new \HTML(['hr', false]);
}

function tab($value, $key) {
    unset($value['description'], $value['title']);
    $out = \_\lot\x\panel\type\section($value, $key);
    if (!isset($value[2]['data-name'])) {
        $out['data-name'] = $key;
    }
    return "" !== $out[1] ? $out : null;
}

function tabs($value, $key) {
    $name = $value['name'] ?? $key;
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? "",
        2 => \array_replace([
            'data-name' => $name
        ], $value[2] ?? [])
    ];
    if (isset($value['content'])) {
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    } else if (isset($value['lot'])) {
        $links = $sections = [];
        $tags = [
            'lot' => true,
            'lot:tabs' => true,
            'p' => true
        ];
        $sort = $value['sort'] ?? true;
        if (true === $sort) {
            $sort = [1, 'stack', 10];
        }
        $lot = (new \Anemon($value['lot']))->sort($sort, true)->get();
        $count = 0;
        foreach ($lot as $k => $v) {
            if (null === $v || false === $v || !empty($v['skip'])) {
                continue;
            }
            $kk = $v['name'] ?? $k;
            if (\is_array($v)) {
                if (empty($v['url']) && empty($v['link'])) {
                    $v['url'] = $GLOBALS['url']->query('&', [
                        'tab' => [$name => $kk]
                    ]);
                } else {
                    $v['tags']['has:link'] = true;
                    if (!\array_key_exists('content', $v) && !\array_key_exists('lot', $v)) {
                        // Make sure link tab has a content to preserve the tab title
                        $v['content'] = \P;
                    }
                }
            }
            $v[2]['data-name'] = $kk;
            $v[2]['target'] = $v[2]['target'] ?? 'tab:' . $kk;
            $links[$kk] = $v;
            $sections[$kk] = $v;
            unset($links[$kk]['content'], $links[$kk]['lot'], $links[$kk]['type']);
        }
        $first = \array_keys($links)[0] ?? null; // The first tab
        $current = $_GET['tab'][$name] ?? $value['current'] ?? $first ?? null;
        if (null !== $current && isset($links[$current]) && \is_array($links[$current])) {
            $links[$current]['tags']['is:current'] = true;
            $sections[$current]['tags']['is:current'] = true;
        } else if (null !== $first && isset($links[$first]) && \is_array($links[$first])) {
            $links[$first]['tags']['is:current'] = true;
            $sections[$first]['tags']['is:current'] = true;
        }
        foreach ($sections as $k => $v) {
            // If `type` is not defined, the default value will be `tab`
            if (!\array_key_exists('type', $v)) {
                $v['type'] = 'tab';
            }
            $vv = (string) \_\lot\x\panel\type($v, $k);
            if ("" === $vv) {
                unset($links[$k]);
            } else {
                ++$count;
            }
            $sections[$k] = $vv;
        }
        $out[1] = '<nav>' . \_\lot\x\panel\type([
            'type' => 'links',
            'lot' => $links
        ], $name) . '</nav>';
        $out[1] .= \implode("", $sections);
    }
    $tags['count:' . $count] = true;
    \_\lot\x\panel\_set_class($out[2], \array_replace($tags, $value['tags'] ?? []));
    return new \HTML($out);
}

function tasks($value, $key) {
    $tags = \array_replace([
        'lot' => true,
        'lot:tasks' => true
    ], $value['tags'] ?? []);
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? "",
        2 => $value[2] ?? []
    ];
    $count = 0;
    if (isset($value['content'])) {
        $tags['count:' . ($count = 1)] = true;
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    } else if (isset($value['lot'])) {
        $out[1] .= \_\lot\x\panel\to\lot($value['lot'], $count, $value['sort'] ?? true);
        $tags['count:' . $count] = true;
    }
    if ($count > 0) {
        \_\lot\x\panel\_set_class($out[2], $tags);
        return new \HTML($out);
    }
    return null;
}

function content($value, $key) {
    $type = $value['type'] ?? null;
    $title = \_\lot\x\panel\to\title($value['title'] ?? "", $value['level'] ?? 2);
    $description = \_\lot\x\panel\to\description($value['description'] ?? "");
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? $title . $description,
        2 => $value[2] ?? []
    ];
    if (isset($value['content'])) {
        $out[1] .= \_\lot\x\panel\to\content($value['content']);
    }
    $tags = [
        'content' => true,
        'count:1' => true,
        'p' => true
    ];
    if (isset($type)) {
        foreach (\step(\strtr($type, '/', '.')) as $v) {
            $tags['content:' . $v] = true;
        }
    }
    $out[2]['id'] = $value['id'] ?? null;
    \_\lot\x\panel\_set_class($out[2], \array_replace($tags, $value['tags'] ?? []));
    return new \HTML($out);
}

function lot($value, $key) {
    $type = $value['type'] ?? null;
    $title = \_\lot\x\panel\to\title($value['title'] ?? "", $value['level'] ?? 2);
    $description = \_\lot\x\panel\to\description($value['description'] ?? "");
    $count = 0;
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? $title . $description,
        2 => $value[2] ?? []
    ];
    if (isset($value['lot'])) {
        $out[1] .= \_\lot\x\panel\to\lot($value['lot'], $count, $value['sort'] ?? true);
    }
    $tags = [
        'count:' . $count => true,
        'lot' => true,
        'p' => true
    ];
    if (isset($type)) {
        foreach (\step(\strtr($type, '/', '.')) as $v) {
            $tags['lot:' . $v] = true;
        }
    }
    $out[2]['id'] = $value['id'] ?? null;
    \_\lot\x\panel\_set_class($out[2], \array_replace($tags, $value['tags'] ?? []));
    return new \HTML($out);
}

function title($value, $key) {
    $icon = $value['icon'] ?? [];
    $title = $value[1] ?? $value['content'] ?? "";
    $title = \w('<!--0-->' . \i(...((array) $title)), ['a', 'abbr', 'b', 'code', 'del', 'em', 'i', 'ins', 'strong', 'sub', 'sup']);
    if ('0' !== $title && !$title && !$icon) {
        return;
    }
    $out = [
        0 => $value[0] ?? [
           -1 => 'span',
            0 => 'p',
            1 => 'h1',
            2 => 'h2',
            3 => 'h3',
            4 => 'h4',
            5 => 'h5',
            6 => 'h6'
        ][$level = $value['level'] ?? 1] ?? false,
        1 => "",
        2 => $value[2] ?? []
    ];
    $icon = \_\lot\x\panel\to\icon($value['icon'] ?? []);
    $out[1] = $icon[0] . ("" !== $title ? '<span>' . $title . '</span>' : "") . $icon[1];
    \_\lot\x\panel\_set_class($out[2], [
        'has:icon' => !!($icon[0] || $icon[1]),
        'has:title' => !!$title,
        'title' => true,
        'title:' . $level => $level >= 0
    ]);
    return new \HTML($out);
}

require __DIR__ . \DS . 'type' . \DS . 'button.php';
require __DIR__ . \DS . 'type' . \DS . 'field.php';
require __DIR__ . \DS . 'type' . \DS . 'form.php';
require __DIR__ . \DS . 'type' . \DS . 'link.php';
require __DIR__ . \DS . 'type' . \DS . 'tasks.php';
