<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);
?>

<div class="pagination"><?php echo pagination_links(); ?></div>
<?php echo $this->partial('common/nav.php', [
    'variable1' => "val1",
    'variable2' => "val2",
]);?>

<h2>Overview</h2>
<p>Here you can view various omeka related logs.</p>

<?php
    foreach ($this->logs as $logName => $log) {
        echo '<div class="title">Logtype: ' . $logName . ': </div><br>';
        echo "<pre>" . $log . "</pre><br>";
    }
?>

<div class="search-filters"><?php echo item_search_filters();?></div>

<div class="pagination"><?php echo pagination_links(); ?></div>

<?php
    echo foot();
?>