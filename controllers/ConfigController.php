<?php
/**
 * // TODO
 *
 * @package BackendLogs
 * @copyright Copyright 2024, Christos Sidiropoulos
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 or any later version
 */
class BackendLogs_ConfigController extends Omeka_Controller_AbstractActionController
{
    private array $configFiles = [
        'omekaConfigDebugEx' => [
            'path' => '/app/application/config/config.ini',
            'needle' => 'debug.exceptions = true',
            'active' => 0
        ],
        'omekaConfigLogPrio' => [
            'path' => '/app/application/config/config.ini',
            'needle' => 'log.priority = Zend_Log::DEBUG',
            'active' => 0
        ],
        '.htaccess' => [
            'path' => '/app/.htaccess',
            'needle' => 'SetEnv APPLICATION_ENV development',
            'active' => 0
        ],
    ];

    public function configFormAction(): void
    {

        debug("!");

        $this->checkLogOptions();

        // debug($this->configFiles['omekaConfigDebugEx']['active']);
        // debug($this->configFiles['omekaConfigLogPrio']['active']);
        // debug($this->configFiles['.htaccess']['active']);
    }


    /**
     * Omeka needs the controller's indexAction function
     * 
     * @return void
     */
    public function indexAction(): void
    {
        $this->checkLogOptions();

        // debug($this->configFiles['omekaConfigDebugEx']['active']);
        // debug($this->configFiles['omekaConfigLogPrio']['active']);
        // debug($this->configFiles['.htaccess']['active']);
    }

    /**
     * TODO
     * 
     * @return void
     */
    private function checkLogOptions(): void {
        foreach($this->configFiles as $configFileName => &$configFile) {
            $filePath = $configFile['path'];

            // Check if the file exists:
            if (!file_exists($filePath)) {
                $configFile['active'] = false;
                die("The configuration file does not exist.\n");
            }
            
            // Read the file contents:
            $fileContents = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            if ($fileContents === false) {
                $configFile['active'] = false;
                die("Failed to read the configuration file.\n");
            }
            
            $configFile['active'] = $this->scanConfigfiles($fileContents, $configFile['needle']);
        }
    }

    /**
     * Iterate through the config file line by line an look for the specified line
     * 
     * @param mixed $fileContents
     * @param mixed $needle
     * @return void
     */
    private function scanConfigfiles($fileContents, $needle): bool {
        foreach ($fileContents as $line) {
            $trimmedLine = trim($line); // Trim whitespace from the line

            // Check if the line is set:
            if (strpos($trimmedLine, $needle) === 0) {
                return true;
            }
        }
        return false;
    }
}

?>