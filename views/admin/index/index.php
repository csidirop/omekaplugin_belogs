<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);
    echo flash();
?>

<div class="pagination"><?php echo pagination_links(); ?></div>
<?php echo $this->partial('common/nav.php');?>

<h2>Overview</h2>
<p>Here you can view various omeka related logs.</p>

<div>
    <a class="button green" href="<?php echo url('backend-logs/index/clear-logs'); ?>">Clear All Logs</a>
    <a class="button green" href="<?php echo url('backend-logs/index/trim-logs'); ?>"><?php echo __('Trim Logs (to 25)'); ?></a>
</div>

<div>
    <?php foreach ($this->logs as $logName => $log) : ?>
        <div class=set>
            <div class="title"><h3>Logtype: <?php echo $logName ?> : </h3></div>
            <pre class='short'> <?php echo $log ?></pre><br>
        </div>
    <?php endforeach; ?>
</div>

<div class="search-filters"><?php echo item_search_filters();?></div>

<div class="pagination"><?php echo pagination_links(); ?></div>

<?php
    echo foot();
?>