<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);
?>

<?php echo $this->partial('common/nav.php');?>

<h2>Logview</h2>

<?php
    foreach ($this->logs as $logName => $log) {
        echo '<div class="title"><h3>'. $logName . ': </h3></div>';
        echo "<pre class='full'>" . $log . "</pre><br>";
    }
?>