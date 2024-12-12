<nav id="section-nav" class="navigation vertical">
<?php
    // Build nav array: first tab is 'Overview' all other log tabs are build dynamically from the config
    $navArray = array(
        array(
            'label' => 'Overview',
            'action' => 'index',
            'module' => 'backend-logs',
        )
    );
    foreach (json_decode(get_option('belogs_logPaths')) as $log => $path) {
        if(isset($path)){
            array_push($navArray, array(
                'label' => $log,
                'action' => 'view',
                'module' => 'backend-logs',
                'params' => array('log' => $log),
            ));
        }
    }
    echo nav($navArray, 'admin_navigation_settings');
?>
</nav>