<?php
/**
 * @package BackendLogs
 * @copyright Copyright 2024, Christos Sidiropoulos
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 or any later version
 */
class BackendLogsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = [
        'config',
        'config_form',
        'define_acl',
    ];

    protected $_filters = [
        'admin_navigation_main',
    ];

    protected $_options = [
        'template_option'=>'option_value'
    ];

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
        set_option('template_option_3', trim($args['post']['template-option-3']));
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

        $acl->allow(array('super', 'admin'), array('BackendLogs_Index'));
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
}
