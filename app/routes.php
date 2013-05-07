<?php

$app['router']->add('home', '/')->defaults(array(
    'controller' => 'welcome',
    'action' => 'view'
));