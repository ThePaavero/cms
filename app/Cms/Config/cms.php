<?php

return [
    'meta' => [
        'siteName' => 'CMS Prototype Page'
    ],
    'contentTypes' => [
        'Heading' => [
            'slug' => 'heading',
            'className' => 'Heading',
            'placeholder' => '---'
        ],
        'Text Block' => [
            'slug' => 'textBlock',
            'className' => 'TextBlock',
            'placeholder' => '---'
        ]
    ],
    'templates' => [
        'Default' => [
            'slug' => 'default',
            'description' => 'Basic template, nothing special.',
            'contentTypes' => ['Text Block', 'Heading']
        ],
        'Wide Content' => [
            'slug' => 'wide_content',
            'description' => 'Template with wider content area.',
            'contentTypes' => ['Text Block', 'Heading']
        ]
    ],
    'modules' => [
    ]
];
