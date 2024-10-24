<?php
class BackendLogsController extends Omeka_Controller_AbstractActionController
{
    public function indexAction(): void
    {
        // Read Apache and Omeka log files
        $apacheLogFile = '/var/log/apache2/error.log';
        $omekaLogFile = '/app/application/logs/errors.log'; //TODO

        // Check if log files are readable
        $apacheLogs = is_readable($apacheLogFile) ? file_get_contents($apacheLogFile) : 'Apache log file not accessible.';
        $omekaLogs = is_readable($omekaLogFile) ? file_get_contents($omekaLogFile) : 'Omeka log file not accessible.';

        // Send logs to the view
        $this->view->apacheLogs = nl2br($apacheLogs); // Convert newlines to <br> for HTML
        $this->view->omekaLogs = nl2br($omekaLogs);
    }
}
