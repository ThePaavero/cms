<?php

return [
    'meta' => [
        'siteName' => 'CMS Prototype Page'
    ],
    'contentTypes' => [
        'Text Block' => [
            'slug' => 'textBlock',
            'className' => 'TextBlock'
        ]
    ],
    'templates' => [
        'Default' => [
            'slug' => 'default',
            'description' => 'Basic template, nothing special.',
            'contentTypes' => ['Text Block']
        ],
        'Wide Content' => [
            'slug' => 'wide_content',
            'description' => 'Template with wider content area.',
            'contentTypes' => ['Text Block']
        ]
    ]
];
