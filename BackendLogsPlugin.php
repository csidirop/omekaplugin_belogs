<?php
/**
 * @package BackendLogs
 * @copyright Copyright 2024, Christos Sidiropoulos
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 or any later version
 */
class BackendLogsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = [
        'install',
        'uninstall',
        'config',
        'config_form',
        'define_acl',
    ];

    protected $_filters = [
        'admin_navigation_main',
    ];

    protected $_options = [
        'belogs_logPaths' => [
            'omekaLogFile' => '/app/application/logs/errors.log',
            'apacheErrorLogFile' => '/var/log/apache2/error.log',
            'apacheAccessLogFile' => '/var/log/apache2/access.log',
            'apacheOtherVHALogFile' => '/var/log/apache2/other_vhosts_access.log',
        ]
    ];

    /**
     *  Hooks in the proccess of installing the plugin.
     */
    public function hookInstall(): void
    {
        // Add default values to plugin options as 'belogs_logPaths' array:
        set_option('belogs_logPaths', json_encode($this->_options['belogs_logPaths']));
        set_option('belogs_rolesACL', json_encode($this->generateRolesArray()));
    }

    /**
     *  Hooks in the proccess of uninstalling the plugin.
     */
    public function hookUninstall(): void
    {
        // Remove default plugin options:
        delete_option('belogs_logPaths');
        delete_option('belogs_rolesACL');
    }

    /**
     * Display the configuration form.
     */
    public function hookConfigForm(): void
    {
        include 'views/admin/config-form.php';
    }

    /**
     * Process the configuration form submission.
     */
    public function hookConfig($args): void
    {
        // Set log paths:
        $logPaths = json_decode(get_option('belogs_logPaths'), true);
        foreach ($logPaths as $option => $path) {
            $logPaths[$option] = trim($args['post'][$option]);
        }
        set_option('belogs_logPaths', json_encode($logPaths));

        // Set ACL:
        $rolesArr = $this->generateRolesArray();
        foreach ($args['post']['belogs-rolesACL'] as $option) {
            $rolesArr[$option] = true;
        }
        set_option("belogs_rolesACL", json_encode($rolesArr));
    }

    /**
     * Define the plugin's Access Control List.
     * 
     * @param array $args
     */
    public function hookDefineAcl($args): void
    {
        $acl = $args['acl']; // get the Zend_Acl
        $acl->addResource('BackendLogs_Index');

        // Allow only specific users the view to the logs:
        $trueKeys = array_keys(array_filter(json_decode(get_option("belogs_rolesACL"),true )));

        $acl->allow($trueKeys, array('BackendLogs_Index'));
        $acl->deny(null, array('BackendLogs_Index'));
    }

    /**
     * Add the BackendLogs link to the admin main navigation.
     * 
     * @param array Navigation array.
     * @return array Filtered navigation array.
     */
    public function filterAdminNavigationMain($nav): array
    {
        $nav[] = array(
            'label' => __('Backend Logs'),
            'uri' => url('backend-logs'),
            'resource' => 'BackendLogs_Index',
            'privilege' => 'index'
        );
        return $nav;
    }

    /**
     * Generates an array of roles for the plugin's Access Control List.
     *
     * @return array
     */
    private function generateRolesArray(): array
    {
        // Create an array with the role names as keys and a value indicating whether they are enabled or not. (default = false)
        $rolesArr = array_fill_keys(array_keys(get_user_roles()), false);
        $rolesArr['super'] = true; // super user is
        return $rolesArr;
    }
}
