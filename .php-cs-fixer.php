<?php

return (new PhpCsFixer\Config())
    ->setRules([
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block',
                'extra',
                // 'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
            ]
        ],
    ])
    ->setLineEnding("\n")
;