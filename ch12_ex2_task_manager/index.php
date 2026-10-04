<?php
// 1. Khởi tạo session tồn tại 1 năm (Yêu cầu 2)
$lifetime = 60 * 60 * 24 * 365;
session_set_cookie_params($lifetime, '/');
session_start();

// 2. Nếu chưa có mảng công việc trong session thì tạo mới (Yêu cầu 3)
if (empty($_SESSION['task_list'])) {
    $_SESSION['task_list'] = array();
}

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_tasks';
    }
}

switch ($action) {
    case 'add':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (!empty($new_task)) {
            // Thêm vào Session thay vì mảng thường
            $_SESSION['task_list'][] = $new_task;
        }
        include('task_list.php');
        break;

    case 'delete':
        $task_id = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_id !== NULL && $task_id !== FALSE) {
            // Xóa khỏi Session
            unset($_SESSION['task_list'][$task_id]);
            $_SESSION['task_list'] = array_values($_SESSION['task_list']);
        }
        include('task_list.php');
        break;

    case 'show_tasks':
    default:
        include('task_list.php');
        break;
}
?>