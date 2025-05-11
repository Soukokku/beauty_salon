<?php
// Подключаем класс для работы с базой данных
require_once __DIR__ . '/db.php';  // Путь к db.php внутри папки db

// Подключаем логику работы с графиком
require_once __DIR__ . '/logic/MasterLogic.php';  // Путь к ScheduleLogic.php внутри папки db/logic



$masterLogic = new MasterLogic();

// Обработка добавления мастера
if (isset($_POST['add_master'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $phoneNumber = $_POST['phone_number'];
    $specialization = $_POST['specialization'];
    echo $masterLogic->addMaster($firstName, $lastName, $middleName, $phoneNumber, $specialization);
}

// Обработка удаления мастера
if (isset($_POST['delete_master'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    echo $masterLogic->deleteMasterByName($firstName, $lastName);
}

// Обработка обновления мастера
if (isset($_POST['update_master'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $phoneNumber = $_POST['phone_number'];
    $specialization = $_POST['specialization'];
    echo $masterLogic->updateMasterByName($firstName, $lastName, $middleName, $phoneNumber, $specialization);
}

// Получаем всех мастеров
$masters = $masterLogic->getAllMasters();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление мастерами</title>
</head>
<body>
    <h1>Управление мастерами</h1>

    <h2>Добавить мастера</h2>
    <form method="POST">
        <label>Имя: <input type="text" name="first_name" required></label><br>
        <label>Фамилия: <input type="text" name="last_name" required></label><br>
        <label>Отчество: <input type="text" name="middle_name" required></label><br>
        <label>Телефон: <input type="text" name="phone_number" required></label><br>
        <label>Специализация: <input type="text" name="specialization" required></label><br>
        <input type="submit" name="add_master" value="Добавить мастера">
    </form>

    <h2>Удалить мастера</h2>
    <form method="POST">
        <label>Имя: <input type="text" name="first_name" required></label><br>
        <label>Фамилия: <input type="text" name="last_name" required></label><br>
        <input type="submit" name="delete_master" value="Удалить мастера">
    </form>

    <h2>Обновить данные мастера</h2>
    <form method="POST">
        <label>Имя: <input type="text" name="first_name" required></label><br>
        <label>Фамилия: <input type="text" name="last_name" required></label><br>
        <label>Отчество: <input type="text" name="middle_name" required></label><br>
        <label>Телефон: <input type="text" name="phone_number" required></label><br>
        <label>Специализация: <input type="text" name="specialization" required></label><br>
        <input type="submit" name="update_master" value="Обновить данные мастера">
    </form>

    <h2>Список мастеров</h2>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Телефон</th>
            <th>Специализация</th>
        </tr>
        <?php foreach ($masters as $master): ?>
            <tr>
                <td><?php echo htmlspecialchars($master['first_name']); ?></td>
                <td><?php echo htmlspecialchars($master['last_name']); ?></td>
                <td><?php echo htmlspecialchars($master['middle_name']); ?></td>
                <td><?php echo htmlspecialchars($master['phone_number']); ?></td>
                <td><?php echo htmlspecialchars($master['specialization']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
