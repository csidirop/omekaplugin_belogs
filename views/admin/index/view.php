<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);
    echo flash();
?>

<?php echo $this->partial('common/nav.php');?>

<h2>Logview</h2>

<div>
    <!-- <?php // if (!isset($this->logs)) {  $this->_helper->redirector('index', 'index'); }; ?> -->
    <?php foreach ($this->logs as $logName => $log) : ?> <!-- There should be only on element in the array -->
        <div>
            <a class="button red" href="<?php echo url("backend-logs/index/clear-log?log=$logName"); ?>"><?php echo __('Clear Log'); ?></a>
            <a class="button red" href="<?php echo url("backend-logs/index/trim-log?log=$logName"); ?>"><?php echo __('Trim Log (to 25)'); ?></a>
            <?php if ($logName === "omekaLogFile" || $logName === "apacheErrorLogFile") : ?>
                <a class="button blue" href="<?php echo url("backend-logs/index/test-log?log=$logName"); ?>"><?php echo __('Test logging'); ?></a>
            <?php endif ?>
        </div>

        <div>
            <div class="title"><h3>Logtype: <?php echo $logName ?> : </h3></div>
            <pre class='full'> <?php echo $log ?></pre><br>
        </div>
    <?php endforeach; ?>
</div>
