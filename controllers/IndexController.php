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
        $logName = $this->getRequest()->getParam('log');
        $filename = ((array)json_decode(get_option('belogs_logPaths')))[$logName] ;
        $this->getLog($filename, $logName);
    }

    /**
     * Clears all logs
     * 
     * @return void
     */
    public function clearLogsAction(): void {
        $paths = (array)json_decode(get_option('belogs_logPaths'),true);
        foreach ($paths as $name => $path) {
            $this->trimLogs($path, $name, 0,0);
        }

        $this->_helper->redirector('index', 'index');
    }

    /**
     * Trims all logs
     * 
     * @return void
     */
    public function trimLogsAction(): void {
        // $len = $this->getRequest()->getParam('len'); //TODO
        $paths = (array)json_decode(get_option('belogs_logPaths'),true);
        foreach ($paths as $name => $path) {
            $this->trimLogs($path, $name, 25);
        }

        $this->_helper->redirector('index', 'index');
    }

    /**
     * Middleworker to call the trimLogToLength() function from the clear and trim actions.
     * 
     * @param mixed $path
     * @param mixed $name
     * @param mixed $maxLines
     * @param mixed $lenght
     * @return void
     */
    private function trimLogs($path, $name, $maxLines, $lenght = null): void {
        if (($path) != '') {
            try {
                $this->trimLogToLength($path, $maxLines, $lenght);
                $this->_helper->flashMessenger(__('Trimmed: '. $name . ' ('. $path .')', 'success'));
            } catch (Exception $e) {
                debug($msg = 'Not trimmed: ' . $name . ' ('. $path . ') | ' .$e->getMessage());
                $this->_helper->flashMessenger($msg, 'failure');
            }
        }
    }

    /**
     * Trims given file content to the specified lenght
     * 
     * @param string $filePath
     * @param int $maxLines
     * @param int $lenght use lenght = 0 to delete all lines
     * @throws \Exception
     * @return void
     */
    private function trimLogToLength($filePath, $maxLines, $lenght = null): void {
        // Check if the file exists:
        if (!file_exists($filePath)) {
            throw new Exception("Log file does not exist: $filePath");
        }

        // Read the file into an array of lines:
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new Exception("Failed to read the log file.");
        }

        // Get only the last $maxLines lines:
        $trimmedLines = array_slice($lines, -$maxLines, $lenght);

        // Write the trimmed lines back to the file:
        $fileHandle = fopen($filePath, 'w');
        if (!$fileHandle) {
            throw new Exception("Failed to open the log file for writing.");
        }

        // Lock the file to avoid conflicts:
        if (!flock($fileHandle, LOCK_EX)) {
            fclose($fileHandle);
            throw new Exception("Unable to lock the file.");
        }

        // Write the trimmed lines to the file:
        fwrite($fileHandle, implode(PHP_EOL, $trimmedLines) . PHP_EOL);

        // Unlock and close the file:
        flock($fileHandle, LOCK_UN);
        fclose($fileHandle);
    }
}
?>