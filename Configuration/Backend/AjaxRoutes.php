<?php

return [
    'threeamfreecontentmode_freemode' => [
        'path' => '/threeam/freemode',
        'target' => \Threeam\ThreeamFreeContentMode\Service\ContentModeService::class . '::setFreeMode',
    ],
];
