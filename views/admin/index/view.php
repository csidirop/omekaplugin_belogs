<?php
    queue_css_file('belogs');

    $head = array('bodyclass' => 'BackendLogs index','title' => html_escape(__('Backend Logs')));
    echo head($head);

    var_dump($this);
?>

<?php echo $this->partial('common/nav.php', [
    'variable1' => "val1",
    'variable2' => "val2",
]);?>

<h2>Logview</h2>
<p>Here you can view the log.</p>

<div class="title">Logtype: <?php echo $this->variable1 ?> </div><br>
<pre> var: <?php echo $this->variable2 ?> </pre><br>