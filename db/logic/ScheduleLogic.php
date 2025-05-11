<?php
require_once '../db/db.php'; 

class ScheduleLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление записи в график
    public function addSchedule($masterId, $workDate, $startTime, $endTime) {
        $sql = "INSERT INTO WorkSchedule (master_id, work_date, start_time, end_time) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$masterId, $workDate, $startTime, $endTime]);
        return "Запись в график успешно добавлена!";
    }

    // Удаление записи из графика
    public function deleteSchedule($scheduleId) {
        $sql = "DELETE FROM WorkSchedule WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$scheduleId]);
        return "Запись успешно удалена!";
    }

    // Обновление записи графика
    public function updateSchedule($scheduleId, $workDate, $startTime, $endTime) {
        $sql = "UPDATE WorkSchedule 
                SET work_date = ?, start_time = ?, end_time = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$workDate, $startTime, $endTime, $scheduleId]);
        return "График успешно обновлён!";
    }

    // Получение всех записей графика
    public function getAllSchedules() {
        $sql = "SELECT * FROM WorkSchedule";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
