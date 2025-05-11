<?php
// Подключаем класс для работы с базой данных
require_once __DIR__ . '/db.php';  // Путь к db.php внутри папки db

// Подключаем логику работы с записями
require_once __DIR__ . '/logic/AppointmentLogic.php';  // Путь к AppointmentLogic.php внутри папки db/logic

$appointmentLogic = new AppointmentLogic();

// Обработка добавления записи
if (isset($_POST['add_appointment'])) {
    $clientId = $_POST['client_id'];
    $masterId = $_POST['master_id'];
    $serviceId = $_POST['service_id'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $statusId = $_POST['status_id'];
    echo $appointmentLogic->addAppointment($clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId);
}

// Обработка удаления записи
if (isset($_POST['delete_appointment'])) {
    $id = $_POST['id'];
    echo $appointmentLogic->deleteAppointmentById($id);
}

// Обработка обновления записи
if (isset($_POST['update_appointment'])) {
    $id = $_POST['id'];
    $clientId = $_POST['client_id'];
    $masterId = $_POST['master_id'];
    $serviceId = $_POST['service_id'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $statusId = $_POST['status_id'];
    echo $appointmentLogic->updateAppointmentById($id, $clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId);
}

// Получаем все записи или фильтруем по различным параметрам
$appointments = [];

if (isset($_GET['filter_client'])) {
    $appointments = $appointmentLogic->getAppointmentsByClientId($_GET['filter_client']);
} elseif (isset($_GET['filter_master'])) {
    $appointments = $appointmentLogic->getAppointmentsByMasterId($_GET['filter_master']);
} elseif (isset($_GET['filter_status'])) {
    $appointments = $appointmentLogic->getAppointmentsByStatusId($_GET['filter_status']);
} else {
    $appointments = $appointmentLogic->getAllAppointments();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление записями</title>
</head>
<body>
    <h1>Управление записями</h1>

    <h2>Добавить запись</h2>
    <form method="POST">
        <label>Клиент (ID): <input type="number" name="client_id" required></label><br>
        <label>Мастер (ID): <input type="number" name="master_id" required></label><br>
        <label>Услуга (ID): <input type="number" name="service_id" required></label><br>
        <label>Дата записи: <input type="date" name="appointment_date" required></label><br>
        <label>Время записи: <input type="time" name="appointment_time" required></label><br>
        <label>Статус (ID): <input type="number" name="status_id" required></label><br>
        <input type="submit" name="add_appointment" value="Добавить запись">
    </form>

    <h2>Удалить запись</h2>
    <form method="POST">
        <label>ID записи: <input type="number" name="id" required></label><br>
        <input type="submit" name="delete_appointment" value="Удалить запись">
    </form>

    <h2>Обновить запись</h2>
    <form method="POST">
        <label>ID записи: <input type="number" name="id" required></label><br>
        <label>Клиент (ID): <input type="number" name="client_id" required></label><br>
        <label>Мастер (ID): <input type="number" name="master_id" required></label><br>
        <label>Услуга (ID): <input type="number" name="service_id" required></label><br>
        <label>Дата записи: <input type="date" name="appointment_date" required></label><br>
        <label>Время записи: <input type="time" name="appointment_time" required></label><br>
        <label>Статус (ID): <input type="number" name="status_id" required></label><br>
        <input type="submit" name="update_appointment" value="Обновить запись">
    </form>

    <h2>Фильтры</h2>
    <form method="GET">
        <label>Фильтр по клиенту (ID): <input type="number" name="filter_client"></label><br>
        <label>Фильтр по мастеру (ID): <input type="number" name="filter_master"></label><br>
        <label>Фильтр по статусу (ID): <input type="number" name="filter_status"></label><br>
        <input type="submit" value="Применить фильтр">
    </form>

    <h2>Список записей</h2>
    <table border="1">
        <tr>
            <th>ID клиента</th>
            <th>ID мастера</th>
            <th>ID услуги</th>
            <th>Дата записи</th>
            <th>Время записи</th>
            <th>Статус</th>
        </tr>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?php echo htmlspecialchars($appointment['client_id']); ?></td>
                <td><?php echo htmlspecialchars($appointment['master_id']); ?></td>
                <td><?php echo htmlspecialchars($appointment['service_id']); ?></td>
                <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                <td><?php echo htmlspecialchars($appointment['status_id']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
