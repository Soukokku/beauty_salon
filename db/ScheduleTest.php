<?php

require_once __DIR__ . '/db.php';  


require_once __DIR__ . '/logic/ScheduleLogic.php';  

$scheduleLogic = new ScheduleLogic();

// Обработка добавления записи в график
if (isset($_POST['add_schedule'])) {
    $masterId = $_POST['master_id'];
    $workDate = $_POST['work_date'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    echo $scheduleLogic->addSchedule($masterId, $workDate, $startTime, $endTime);
}

// Обработка удаления записи из графика
if (isset($_POST['delete_schedule'])) {
    $scheduleId = $_POST['schedule_id'];
    echo $scheduleLogic->deleteSchedule($scheduleId);
}

// Обработка обновления записи в графике
if (isset($_POST['update_schedule'])) {
    $scheduleId = $_POST['schedule_id'];
    $workDate = $_POST['work_date'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    echo $scheduleLogic->updateSchedule($scheduleId, $workDate, $startTime, $endTime);
}

// Получаем все записи графика
$schedules = $scheduleLogic->getAllSchedules();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление графиком</title>
</head>
<body>
    <h1>Управление графиком</h1>

    <h2>Добавить запись в график</h2>
    <form method="POST">
        <label>ID мастера: <input type="number" name="master_id" required></label><br>
        <label>Дата работы: <input type="date" name="work_date" required></label><br>
        <label>Время начала: <input type="time" name="start_time" required></label><br>
        <label>Время окончания: <input type="time" name="end_time" required></label><br>
        <input type="submit" name="add_schedule" value="Добавить запись">
    </form>

    <h2>Удалить запись из графика</h2>
    <form method="POST">
        <label>ID записи: <input type="number" name="schedule_id" required></label><br>
        <input type="submit" name="delete_schedule" value="Удалить запись">
    </form>

    <h2>Обновить запись графика</h2>
    <form method="POST">
        <label>ID записи: <input type="number" name="schedule_id" required></label><br>
        <label>Новая дата работы: <input type="date" name="work_date" required></label><br>
        <label>Новое время начала: <input type="time" name="start_time" required></label><br>
        <label>Новое время окончания: <input type="time" name="end_time" required></label><br>
        <input type="submit" name="update_schedule" value="Обновить запись">
    </form>

    <h2>Список записей графика</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID мастера</th>
            <th>Дата работы</th>
            <th>Время начала</th>
            <th>Время окончания</th>
        </tr>
        <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?php echo htmlspecialchars($schedule['id']); ?></td>
                <td><?php echo htmlspecialchars($schedule['master_id']); ?></td>
                <td><?php echo htmlspecialchars($schedule['work_date']); ?></td>
                <td><?php echo htmlspecialchars($schedule['start_time']); ?></td>
                <td><?php echo htmlspecialchars($schedule['end_time']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
