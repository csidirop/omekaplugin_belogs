<?php
/**
 * @package BackendLogs
 * @copyright Copyright 2024, Christos Sidiropoulos
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 or any later version
 */
class BackendLogsPlugin extends Omeka_Plugin_AbstractPlugin
{
    // Define hooks and filters used by the plugin
    protected $_hooks = array(
        // 'define_routes',    // Define custom routes for our plugin
        'admin_head',       // Hook to include custom styles/scripts in admin
        'config_form',      // Hook to include the config form
        // 'admin_dashboard',  // Hook to display content on admin dashboard
    );

    /**
     * @var array Filters for the plugin.
     */
    // protected $_filters = array('admin_navigation_main');

    /**
     * @var array Options and their default values.
     */
    protected $_options = array();

    /**
     * Hook to define custom routes.
    */
    public function hookDefineRoutes($args): void
    {
        $router = $args['router'];
        $router->addRoute(
            'backend_logs',
            new Zend_Controller_Router_Route(
                'backend-logs',
                array(
                    'module' => 'default',
                    'controller' => 'backend-logs',
                    'action' => 'index',
                )
            )
        );
    }


    public function hookConfigForm(): void
    {
        include 'config_form.php';
        // require dirname(__FILE__) . '/config_form.php';
    }

    /**
     * Add navigation link.
     */
    public function filterAdminNavigationMain($nav)
    {
        $nav[] = array(
            'label' => __('belog'),
            'uri' => url('belog'),
            'resource' => 'BackendLog_Index',
            // 'uri' => url('index'),
            'privilege' => 'index'
        );
        return $nav;
    }

    /**
     * Hook to add any necessary admin head scripts or styles.
    */
    public function hookAdminHead($args): void
    {
        // Add any custom CSS or JS here (optional)
    }
}
