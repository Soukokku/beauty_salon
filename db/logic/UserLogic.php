<?php
require_once '../db/db.php';  

class UserLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление пользователя
    public function addUser($phoneNumber, $password, $roleId) {
        $sql = "INSERT INTO User (phone_number, password, role_id) 
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$phoneNumber, $password, $roleId]);
        return "Пользователь успешно добавлен!";
    }

    // Удаление пользователя по телефону
    public function deleteUserByPhone($phoneNumber) {
        $sql = "DELETE FROM User WHERE phone_number = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$phoneNumber]);
        return "Пользователь с телефоном $phoneNumber успешно удален!";
    }

    // Обновление данных пользователя по телефону
    public function updateUserByPhone($phoneNumber, $newPassword, $newRoleId) {
        $sql = "UPDATE User SET password = ?, role_id = ? WHERE phone_number = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newPassword, $newRoleId, $phoneNumber]);
        return "Данные пользователя с телефоном $phoneNumber успешно обновлены!";
    }

    // Получение списка всех пользователей
    public function getAllUsers() {
        $sql = "SELECT * FROM User";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Возвращаем все записи в виде массива
    }
}
?>
