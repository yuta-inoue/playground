<?php
$application->registerModules(
    array(
        'api'  => array(
            'className' => 'Multiple\Api\Module',
            'path'      => '../apps/api/Module.php',
        ),
        'front' => array(
            'className' => 'Multiple\Front\Module',
            'path'      => '../apps/front/Module.php',
        ),
        'etc'  => array(
            'className' => 'Multiple\Etc\Module',
            'path'      => '../apps/etc/Module.php',
        )
    )
);