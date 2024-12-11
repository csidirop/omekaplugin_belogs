<?php
/**
 * // TODO
 *
 * @package BackendLogs
 * @copyright Copyright 2024, Christos Sidiropoulos
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 or any later version
 */
class BackendLogs_IndexController extends Omeka_Controller_AbstractActionController
{
    /**
     * Omeka needs the controller's indexAction function
     * 
     * @return void
     */
    public function indexAction(): void
    {
        foreach ((array)json_decode(get_option('belogs_logPaths')) as $option => $path) {
            $this->getLog($path, $option);
        }
    }

    /**
     * Reads the contents of a log file and appends it to the log contents array.
     *
     * This method checks if a specified log file exists. If the file exists, it reads
     * its contents and stores it in the `$this->view->logs` array under the provided
     * log name. If the file cannot be read or does not exist, an appropriate error message
     * is stored instead.
     *
     * @param string $filename The path to the log file to be read.
     * @param string $logName  The identifier or name for the log entry.
     * 
     * @return void
     */
    private function getLog($filename, $logName): void
    {
        if (file_exists($filename)) {
            $logContents = file_get_contents($filename);
            if (!isset($this->view->logs) || !is_array($this->view->logs)) {
                $this->view->logs = [];
            }
            if ($logContents === false) {
                $this->view->logs[$logName] = "Error reading the log file.";
            } else {
                $this->view->logs[$logName] = htmlspecialchars($logContents);
            }
        } else {
            $this->view->logs[$logName] = "Log file not found: " . htmlspecialchars($filename);
        }
    }

    
    /**
     * Browse the imports.
     */
    public function viewAction()
    {
        // parent::browseAction();
    }
}
?>