<?php
require_once '../db/db.php';  

class ServiceLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление новой услуги
    public function addService($name, $description, $price, $durationMinutes) {
        $sql = "INSERT INTO Service (name, description, price, duration_minutes) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $description, $price, $durationMinutes]);
        return "Услуга '$name' успешно добавлена!";
    }

    // Удаление услуги по названию
    public function deleteServiceByName($name) {
        $sql = "DELETE FROM Service WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
        return "Услуга '$name' успешно удалена!";
    }

    // Обновление данных услуги по названию
    public function updateServiceByName($name, $newDescription, $newPrice, $newDurationMinutes) {
        $sql = "UPDATE Service SET description = ?, price = ?, duration_minutes = ? WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newDescription, $newPrice, $newDurationMinutes, $name]);
        return "Данные услуги '$name' успешно обновлены!";
    }

    // Получение списка всех услуг
    public function getAllServices() {
        $sql = "SELECT * FROM Service";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Возвращаем все записи в виде массива
    }
}
?>
