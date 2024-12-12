<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);
?>

<div class="pagination"><?php echo pagination_links(); ?></div>
<?php echo $this->partial('common/nav.php');?>

<h2>Overview</h2>
<p>Here you can view various omeka related logs.</p>

<?php
    foreach ($this->logs as $logName => $log) {
        echo "<div class=set>";
        echo '<div class="title"><h3>Logtype: ' . $logName . ': </h3></div>';
        echo "<pre class='short'>" . $log . "</pre><br>";
        echo "</div>";
    }
?>

<div class="search-filters"><?php echo item_search_filters();?></div>

<div class="pagination"><?php echo pagination_links(); ?></div>

<?php
    echo foot();
?>