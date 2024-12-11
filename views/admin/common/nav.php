<nav id="section-nav" class="navigation vertical">
<?php
    $navArray = array(
        array(
            'label' => 'Overview',
            'action' => 'index',
            'module' => 'backend-logs',
        ),
        array(
            'label' => 'Log1',
            'action' => 'view',
            'module' => 'backend-logs',
            'params' => array('log' => '1'),
        ),
        array(
            'label' => 'Log2',
            'action' => 'view',
            'module' => 'backend-logs',
            'params' => array('log' => '2'),
        ),
    );
    echo nav($navArray, 'admin_navigation_settings');
?>
</nav>