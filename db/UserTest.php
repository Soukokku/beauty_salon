<?php
require_once __DIR__ . '/db.php';  


require_once __DIR__ . '/logic/UserLogic.php';  

$userLogic = new UserLogic();

// Добавление пользователя
if (isset($_POST['add_user'])) {
    $phone = $_POST['phone_number'];
    $password = $_POST['password'];
    $roleId = $_POST['role_id'];
    echo $userLogic->addUser($phone, $password, $roleId);
}

// Удаление пользователя
if (isset($_POST['delete_user'])) {
    $phone = $_POST['phone_number'];
    echo $userLogic->deleteUserByPhone($phone);
}

// Обновление пользователя
if (isset($_POST['update_user'])) {
    $phone = $_POST['phone_number'];
    $newPass = $_POST['new_password'];
    $newRoleId = $_POST['new_role_id'];
    echo $userLogic->updateUserByPhone($phone, $newPass, $newRoleId);
}

// Получение всех пользователей
$users = $userLogic->getAllUsers();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление пользователями</title>
</head>
<body>
    <h1>Пользователи</h1>

    <h2>Добавить пользователя</h2>
    <form method="POST">
        <label>Телефон: <input type="text" name="phone_number" required></label><br>
        <label>Пароль: <input type="text" name="password" required></label><br>
        <label>Роль (ID): <input type="number" name="role_id" required></label><br>
        <input type="submit" name="add_user" value="Добавить">
    </form>

    <h2>Удалить пользователя</h2>
    <form method="POST">
        <label>Телефон: <input type="text" name="phone_number" required></label><br>
        <input type="submit" name="delete_user" value="Удалить">
    </form>

    <h2>Обновить пользователя</h2>
    <form method="POST">
        <label>Телефон: <input type="text" name="phone_number" required></label><br>
        <label>Новый пароль: <input type="text" name="new_password" required></label><br>
        <label>Новая роль (ID): <input type="number" name="new_role_id" required></label><br>
        <input type="submit" name="update_user" value="Обновить">
    </form>

    <h2>Список всех пользователей</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Телефон</th>
            <th>Пароль</th>
            <th>Роль (ID)</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['phone_number']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td><?= htmlspecialchars($user['role_id']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
