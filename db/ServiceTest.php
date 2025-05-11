<?php

require_once __DIR__ . '/db.php'; 


require_once __DIR__ . '/logic/ServiceLogic.php';  

$serviceLogic = new ServiceLogic();

// Обработка добавления услуги
if (isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $durationMinutes = $_POST['duration_minutes'];
    echo $serviceLogic->addService($name, $description, $price, $durationMinutes);
}

// Обработка удаления услуги
if (isset($_POST['delete_service'])) {
    $name = $_POST['name'];
    echo $serviceLogic->deleteServiceByName($name);
}

// Обработка обновления услуги
if (isset($_POST['update_service'])) {
    $name = $_POST['name'];
    $newDescription = $_POST['new_description'];
    $newPrice = $_POST['new_price'];
    $newDurationMinutes = $_POST['new_duration_minutes'];
    echo $serviceLogic->updateServiceByName($name, $newDescription, $newPrice, $newDurationMinutes);
}

// Получаем все услуги
$services = $serviceLogic->getAllServices();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление услугами</title>
</head>
<body>
    <h1>Управление услугами</h1>

    <h2>Добавить новую услугу</h2>
    <form method="POST">
        <label>Название услуги: <input type="text" name="name" required></label><br>
        <label>Описание: <textarea name="description" required></textarea></label><br>
        <label>Цена: <input type="number" name="price" step="0.01" required></label><br>
        <label>Продолжительность (в минутах): <input type="number" name="duration_minutes" required></label><br>
        <input type="submit" name="add_service" value="Добавить услугу">
    </form>

    <h2>Удалить услугу</h2>
    <form method="POST">
        <label>Название услуги: <input type="text" name="name" required></label><br>
        <input type="submit" name="delete_service" value="Удалить услугу">
    </form>

    <h2>Обновить услугу</h2>
    <form method="POST">
        <label>Название услуги: <input type="text" name="name" required></label><br>
        <label>Новое описание: <textarea name="new_description" required></textarea></label><br>
        <label>Новая цена: <input type="number" name="new_price" step="0.01" required></label><br>
        <label>Новая продолжительность (в минутах): <input type="number" name="new_duration_minutes" required></label><br>
        <input type="submit" name="update_service" value="Обновить услугу">
    </form>

    <h2>Список услуг</h2>
    <table border="1">
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Продолжительность (мин.)</th>
        </tr>
        <?php foreach ($services as $service): ?>
            <tr>
                <td><?php echo htmlspecialchars($service['name']); ?></td>
                <td><?php echo htmlspecialchars($service['description']); ?></td>
                <td><?php echo htmlspecialchars($service['price']); ?></td>
                <td><?php echo htmlspecialchars($service['duration_minutes']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
