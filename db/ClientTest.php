<?php

require_once __DIR__ . '/db.php';  


require_once __DIR__ . '/logic/ClientLogic.php';  
$clientLogic = new ClientLogic();

// Обработка добавления клиента
if (isset($_POST['add_client'])) {
    $userId = $_POST['user_id'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $genderId = $_POST['gender_id'];
    $birthDate = $_POST['birth_date'];
    echo $clientLogic->addClient($userId, $email, $firstName, $lastName, $middleName, $genderId, $birthDate);
}

// Обработка удаления клиента
if (isset($_POST['delete_client'])) {
    $email = $_POST['email'];
    echo $clientLogic->deleteClientByEmail($email);
}

// Обработка обновления данных клиента
if (isset($_POST['update_client'])) {
    $email = $_POST['email'];
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newMiddleName = $_POST['new_middle_name'];
    $newGenderId = $_POST['new_gender_id'];
    $newBirthDate = $_POST['new_birth_date'];
    echo $clientLogic->updateClientByEmail($email, $newFirstName, $newLastName, $newMiddleName, $newGenderId, $newBirthDate);
}

// Получаем всех клиентов
$clients = $clientLogic->getAllClients();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление клиентами</title>
</head>
<body>
    <h1>Управление клиентами</h1>

    <h2>Добавить клиента</h2>
    <form method="POST">
        <label>Клиент (ID пользователя): <input type="number" name="user_id" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Имя: <input type="text" name="first_name" required></label><br>
        <label>Фамилия: <input type="text" name="last_name" required></label><br>
        <label>Отчество: <input type="text" name="middle_name" required></label><br>
        <label>Пол (ID): <input type="number" name="gender_id" required></label><br>
        <label>Дата рождения: <input type="date" name="birth_date" required></label><br>
        <input type="submit" name="add_client" value="Добавить клиента">
    </form>

    <h2>Удалить клиента</h2>
    <form method="POST">
        <label>Email клиента: <input type="email" name="email" required></label><br>
        <input type="submit" name="delete_client" value="Удалить клиента">
    </form>

    <h2>Обновить данные клиента</h2>
    <form method="POST">
        <label>Email клиента: <input type="email" name="email" required></label><br>
        <label>Новое имя: <input type="text" name="new_first_name" required></label><br>
        <label>Новая фамилия: <input type="text" name="new_last_name" required></label><br>
        <label>Новое отчество: <input type="text" name="new_middle_name" required></label><br>
        <label>Новый пол (ID): <input type="number" name="new_gender_id" required></label><br>
        <label>Новая дата рождения: <input type="date" name="new_birth_date" required></label><br>
        <input type="submit" name="update_client" value="Обновить данные клиента">
    </form>

    <h2>Список клиентов</h2>
    <table border="1">
        <tr>
            <th>ID пользователя</th>
            <th>Email</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Пол (ID)</th>
            <th>Дата рождения</th>
        </tr>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?php echo htmlspecialchars($client['user_id']); ?></td>
                <td><?php echo htmlspecialchars($client['email']); ?></td>
                <td><?php echo htmlspecialchars($client['first_name']); ?></td>
                <td><?php echo htmlspecialchars($client['last_name']); ?></td>
                <td><?php echo htmlspecialchars($client['middle_name']); ?></td>
                <td><?php echo htmlspecialchars($client['gender_id']); ?></td>
                <td><?php echo htmlspecialchars($client['birth_date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
