<?php
    $view = get_view();
?>

<h2><?= __('Check Logging Configuration') ?></h2>
<p>To troubleshoot issues in Omeka Classic, you can enable error messages by editing configuration files. More information at the <a href="https://omeka.org/classic/docs/Troubleshooting/Retrieving_Error_Messages/" target="_blank">Omeka Classic Troubleshooting Guide</a>.</p>
<div class="field">
    <table id="table">
        <tbody>
            <tr>
                <td>
                    <div style="display: flex; align-items: center;"><label>Option 1: </label><span class="indicator <?php echo get_option('belog_setting1') ? 'green' : 'red'; ?>"></span></div>
                    <code>SetEnv APPLICATION_ENV development</code>
                </td>
                <td>
                    <div style="display: flex; align-items: center;"><label>Option 2: </label><span class="indicator <?php echo get_option('belog_setting2') ? 'green' : 'red'; ?>"></span></div>
                    <code>debug.exceptions = true</code>
                </td>
                <td>
                    <div style="display: flex; align-items: center;"><label>Option 3: </label><span class="indicator <?php echo get_option('belog_setting1') ? 'green' : 'red'; ?>"></span></div>
                    <code>log.priority = Zend_Log::DEBUG</code>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="explanation">
                        <?php echo __('Uncomment the line <code>#SetEnv APPLICATION_ENV development</code> in the <code>.htaccess</code> file in the root directory to display robust error messages.'); ?>
                    </p>
                </td>
                <td>
                    <p class="explanation">
                        <?php echo __('Open <code>application/config/config.ini</code>, and change the value of <code>debug.exceptions</code> to <code>true</code>.'); ?>
                    </p>
                </td>
                <td>
                    <p class="explanation">
                        <?php echo __('The minimum priority level of messages that should be logged.'); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<h2><?= __('Configure Log Paths') ?></h2>

<?php foreach ((array)json_decode(get_option('belogs_logPaths')) as $option => $path): ?>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $view->formLabel($option, $option); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php echo __('Path to the file:'); ?>
            </p>
            <?php echo $view->formText($option, $path); ?>
        </div>
    </div>
<?php endforeach; ?>

<h2><?= __('Configure Access Rights') ?></h2>
<div class="field">
    <div class="two columns alpha">
        <?php echo $view->formLabel('belogs-rolesACL', "Backend Logs Access"); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __('Select userroles allowed to see the Logs'); ?></p>

        <table id="table">
            <thead>
                <tr>
                    <th class="boxes"><?php echo __('Role'); ?></th>
                    <th class="boxes"><?php echo __('Show Logs'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $userRoles = json_decode(get_option("belogs_rolesACL"));
                    
                    // display table content
                    foreach ($userRoles as $role=>$option) {
                        echo '<tr>';
                        echo '<td class="column-user">' . __($role) . '</td>';
                        if ($role != "super") {
                            echo '<td class="boxes">' . $view->formCheckbox('belogs-rolesACL[]', $role, ['id' => 'belogs-rolesACL-'.$role.'-id'],  $option ? [$role] : []) . '</td>';
                        } else { //disable the checkbox for the super user
                            echo '<td class="boxes">' . $view->formCheckbox('belogs-rolesACL[]', $role, ['id' => 'belogs-rolesACL-'.$role.'-id', 'disabled' => 'disabled'],  $option ? [$role] : []) . '</td>';
                        }
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    table .indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
    }
    table .indicator.green {
        background-color: green;
    }
    table .indicator.orange {
        background-color: orange;
    }
    table .indicator.red {
        background-color: red;
    }
</style>