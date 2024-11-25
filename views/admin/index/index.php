<?php
$head = array(
        'bodyclass' => 'Template index',
        'title' => html_escape(__('Template'))
    );

    echo head($head);

    // <!--  For view-related function see: https://omeka.readthedocs.io/en/latest/Reference/packages/Function/View/index.html -->
?>

<div class="pagination"><?php echo pagination_links(); ?></div>

<h2>Template Plugin Admin View</h2>
<p>This is a sample admin view for the Template plugin.</p>
<p>Here are some of the options set by this plugin loaded:</p>

<ul>
    <li>Config option 1: <strong><?php echo htmlspecialchars(get_option('template_option_1')); ?></strong></li>
    <li>Config option 2: <strong><?php echo htmlspecialchars(get_option('template_option_2')); ?></strong></li>
    <li>Config option 3: <strong><?php echo htmlspecialchars(get_option('template_option_3')); ?></strong></li>
</ul>

<div class="search-filters"><?php echo item_search_filters();?></div>

<div class="pagination"><?php echo pagination_links(); ?></div>

<?php
    echo foot();
?>