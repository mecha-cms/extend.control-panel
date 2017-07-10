<?php

return [
    'title' => [
        'type' => 'text',
        'value' => $__page[0]->title,
        'placeholder' => $__page[1]->title ?: $language->f_title,
        'is' => [
            'block' => true
        ],
        'attributes' => [
            'data' => [
                'slug-i' => 'title'
            ]
        ],
        'expand' => true,
        'stack' => 10
    ],
    'content' => [
        'type' => 'editor',
        'value' => $__page[0]->content,
        'placeholder' => $language->f_content,
        'union' => ['div'],
        'is' => [
            'expand' => true
        ],
        'attributes' => [
            'data' => [
                'type' => $__page[0]->type
            ]
        ],
        'expand' => true,
        'stack' => 20
    ],
    'description' => [
        'type' => 'textarea',
        'value' => $__page[0]->description,
        'placeholder' => $__page[1]->description ?: $language->f_description($language->page),
        'union' => ['div'],
        'is' => [
            'block' => true
        ],
        'stack' => 30
    ],
    'version' => [
        'type' => 'text',
        'value' => $__page[0]->version,
        'placeholder' => $__page[1]->version,
        'stack' => 40
    ],
    '*slug' => [
        'title' => $language->locale,
        'type' => 'text',
        'value' => $__page[0]->slug,
        'placeholder' => $__page[1]->slug,
        'pattern' => '^[a-z\\d]+(?:-[a-z\\d]+)*$',
        'attributes' => [
            'data' => [
                'slug-o' => 'title'
            ]
        ],
        'stack' => 50
    ],
    // the submit button(s)
    'x' => [
        'type' => 'submit',
        'title' => $language->submit,
        'values' => [
            'page' => $language->{$__action === 's' ? 'create' : 'update'},
            'trash' => $__action !== 's' && $__page[0]->slug !== 'en-us' ? $language->delete : null
        ],
        'stack' => 0
    ]
];