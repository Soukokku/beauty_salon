<?php
require_once '../db/db.php';  // Подключаем файл для работы с базой данных

class AppointmentLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление новой записи
    public function addAppointment($clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId) {
        $sql = "INSERT INTO Appointment (client_id, master_id, service_id, appointment_date, appointment_time, status_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId]);
        return "Запись успешно добавлена!";
    }

    // Удаление записи по id
    public function deleteAppointmentById($id) {
        $sql = "DELETE FROM Appointment WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return "Запись с id = $id успешно удалена!";
    }

    // Обновление записи по id
    public function updateAppointmentById($id, $clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId) {
        $sql = "UPDATE Appointment 
                SET client_id = ?, master_id = ?, service_id = ?, appointment_date = ?, appointment_time = ?, status_id = ?
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$clientId, $masterId, $serviceId, $appointmentDate, $appointmentTime, $statusId, $id]);
        return "Запись с id = $id успешно обновлена!";
    }

    // Получение всех записей
    public function getAllAppointments() {
        $sql = "SELECT * FROM Appointment";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Возвращаем все записи в виде массива
    }

    // Получение записей по клиенту
    public function getAppointmentsByClientId($clientId) {
        $sql = "SELECT * FROM Appointment WHERE client_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получение записей по мастеру
    public function getAppointmentsByMasterId($masterId) {
        $sql = "SELECT * FROM Appointment WHERE master_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$masterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получение записей по статусу
    public function getAppointmentsByStatusId($statusId) {
        $sql = "SELECT * FROM Appointment WHERE status_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$statusId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
