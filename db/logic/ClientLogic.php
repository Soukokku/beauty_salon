<?php
require_once '../db/db.php';  

class ClientLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление клиента
    public function addClient($userId, $email, $firstName, $lastName, $middleName, $genderId, $birthDate) {
        $sql = "INSERT INTO Client (user_id, email, first_name, last_name, middle_name, gender_id, birth_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $email, $firstName, $lastName, $middleName, $genderId, $birthDate]);
        return "Клиент успешно добавлен!";
    }

    // Удаление клиента по email
    public function deleteClientByEmail($email) {
        $sql = "DELETE FROM Client WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return "Клиент с email $email успешно удален!";
    }

    // Обновление данных клиента по email
    public function updateClientByEmail($email, $newFirstName, $newLastName, $newMiddleName, $newGenderId, $newBirthDate) {
        $sql = "UPDATE Client SET first_name = ?, last_name = ?, middle_name = ?, gender_id = ?, birth_date = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newFirstName, $newLastName, $newMiddleName, $newGenderId, $newBirthDate, $email]);
        return "Данные клиента с email $email успешно обновлены!";
    }

    // Получение списка всех клиентов
    public function getAllClients() {
        $sql = "SELECT * FROM Client";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Возвращаем все записи в виде массива
    }
}
?>
