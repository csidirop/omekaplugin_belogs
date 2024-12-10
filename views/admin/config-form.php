<h1><?= __('Edit log paths') ?></h1>

<?php foreach ((array)json_decode(get_option('logPaths')) as $option => $path): ?>
    <div class="field">
        <div class="two columns alpha">
            <?php echo get_view()->formLabel($option, $option); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php echo __('Path to the file:'); ?>
            </p>
            <?php echo get_view()->formText($option, $path); ?>
        </div>
    </div>
<?php endforeach; ?>
