<?php
    echo head(array('title' => __('TEST')));
?>

<?php
    echo '<h1>Backend Logs</h1>';

    echo '<h2>Apache Logs</h2>';
    echo '<pre>' . $this->apacheLogs . '</pre>'; // Display Apache logs

    echo '<h2>Omeka Logs</h2>';
    echo '<pre>' . $this->omekaLogs . '</pre>'; // Display Omeka logs
?>

<?php
    echo foot();
?>
