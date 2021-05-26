<?php

return [
    'style_variables' => [
        // index, detail field
        '--nti-tag-bgcolor' => 'var(--primary)',
        '--nti-tag-mr' => '5px',
        '--nti-tag-color' => '#fff',
        // form field
        '--ti-valid-bgcolor' => 'var(--primary)',
        '--ti-deletion-mark-bgcolor' => 'var(--danger)',
        '--ti-selected-item-bgcolor' => 'var(--primary)',
    ],
    'props' => [
        'add-from-paste' => true,
        'add-on-blur' => true,
        'add-on-key' => [13],
        'add-only-from-autocomplete' => false,
        'allow-edit-tags' => false,
        'autocomplete-always-open' => false,
        'autocomplete-filter-duplicates' => true,
        'autocomplete-min-length' => 1,
        'avoid-adding-duplicates' => true,
        'delete-on-backspace' => true,
        'disabled' => false,
        'max-tags' => null,
        'maxlength' => null,
        'placeholder' => 'Add Tag',
        'save-on-key' => [13, ':', ';'],
        'separators' => [';'],
    ],
];
