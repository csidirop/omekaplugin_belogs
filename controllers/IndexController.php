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
    private int $logs = 0;
    private string $omekaLogFile = '/app/application/logs/errors.log';
    private string $apacheLogFile = '/var/log/apache2/error.log';

    /**
     * Omeka needs the controller's indexAction function
     * 
     * @return void
     */
    public function indexAction(): void
    {
        $this->printLog($this->omekaLogFile);
        $this->printLog($this->apacheLogFile);
    }

    private function printLog($logFile): void
    {
        $i = $this->logs++;

        if (file_exists($logFile)) {
            $logContents = file_get_contents($logFile);
            if ($logContents === false) {
                $this->view->logContents = [$i => "Error reading the log file."];
            } else {
                $this->view->logContents = [$i => htmlspecialchars($logContents)];
                debug("wrote log to " . $i );
                debug($logContents);
            }
        } else {
            $this->view->logContents = [$i => "Log file not found: " . htmlspecialchars($logFile)];
        }
    }

    // here comming all actions performed on that page: ...
}

?>