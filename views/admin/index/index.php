<?php
    queue_css_file('belogs');

    $head = array(
            'bodyclass' => 'BackendLogs index',
            'title' => html_escape(__('Backend Logs'))
        );

        echo head($head);
?>

<div class="pagination"><?php echo pagination_links(); ?></div>

<h2>Overview</h2>
<p>Here you can view various omeka related logs. </p>

<pre><?php
    foreach ($this->logContents as $i => $log) {
        echo $i . "<br>";
        echo $log . "<br>";
    }
?></pre>

<div class="search-filters"><?php echo item_search_filters();?></div>

<div class="pagination"><?php echo pagination_links(); ?></div>

<?php
    echo foot();
?>