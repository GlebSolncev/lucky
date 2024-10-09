<?php

return [

    // Время жизни ссылки в днях
    'link_lifetime' => 7,

    // Правила подсчета очков
    'score_rules' => [
        [
            'min' => 901,
            'max' => 1000,
            'percentage' => 0.7,
        ],
        [
            'min' => 601,
            'max' => 900,
            'percentage' => 0.5,
        ],
        [
            'min' => 301,
            'max' => 600,
            'percentage' => 0.3,
        ],
        [
            'min' => 1,
            'max' => 300,
            'percentage' => 0.1,
        ],
    ],

];
