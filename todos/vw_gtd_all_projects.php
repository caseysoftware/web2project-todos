<?php

global $AppUI;

$project = new CProject();
$projects = array(0 => array('project_name' => 'No project specified', 'project_id' => 0 ));
$projects += $project->getAllowedProjects($AppUI->user_id, false);

$todo = new CTodo();
$todoCategories = w2PgetSysVal('TodoType');

?>
<table width="100%">
    <tr>
        <td id="todos_list" style="width: 100%; vertical-align: top;">
            <?php
            foreach ($projects as $data) {
                $todos = $todo->loadAll('todo_due_date', 'todo_status = 1 AND todo_owner = ' . $AppUI->user_id . ' AND todo_project = ' . $data['project_id']);

                if (count($todos)) {
                    echo '<strong>'.$data['project_name'].'</strong>';
                    echo '<ul style="list-style-type: none;">';
                    $i = 0;
                    foreach($todos as $todoItem) {
                        $i++;
                        if ($i > 3) {
                            break;
                        }
                        $todo->renderItem($todoItem, $todoCategories);
                    }
                    echo '</ul>';
                }
            }
            ?>
        </td>
    </tr>
</table>