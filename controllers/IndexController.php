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
    // Paths to the log file: //TODO get from config
    private string $omekaLogFile = '/app/application/logs/errors.log';
    private string $apacheErrorLogFile = '/var/log/apache2/error.log';
    private string $apacheAccessLogFile = '/var/log/apache2/access.log';
    private string $apacheOtherVHALogFile = '/var/log/apache2/other_vhosts_access.log';

    /**
     * Omeka needs the controller's indexAction function
     * 
     * @return void
     */
    public function indexAction(): void
    {
        $this->printLog($this->omekaLogFile, "omeka error.log");
        $this->printLog($this->apacheErrorLogFile, "apache2 error.log");
        $this->printLog($this->apacheAccessLogFile, "apache2 access.log");
        $this->printLog($this->apacheOtherVHALogFile, "apache2 other_vhosts_access.log");
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
    private function printLog($filename, $logName): void
    {
        if (file_exists($filename)) {
            $logContents = file_get_contents($filename);
            if (!isset($this->view->logs) || !is_array($this->view->logs)) {
                $this->view->logs = [];
            }
            if ($logContents === false) {
                $this->view->logs[$logName] =  "Error reading the log file.";
            } else {
                $this->view->logs[$logName] = htmlspecialchars($logContents);
            }
        } else {
            $this->view->logs[$logName] = "Log file not found: " . htmlspecialchars($filename);
        }
    }
}

?>