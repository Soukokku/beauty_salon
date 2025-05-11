<?php
require_once '../db/db.php';  

class MasterLogic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Добавление мастера
    public function addMaster($firstName, $lastName, $middleName, $phoneNumber, $specialization) {
        $sql = "INSERT INTO Master (first_name, last_name, middle_name, phone_number, specialization) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql); //подготавливает SQL-запрос для выполнения
        $stmt->execute([$firstName, $lastName, $middleName, $phoneNumber, $specialization]);  //Выполняет подготовленный запрос с параметрами
        return "Мастер успешно добавлен!";
    }

    // Удаление мастера по имени и фамилии
    public function deleteMasterByName($firstName, $lastName) {
        $sql = "DELETE FROM Master WHERE first_name = ? AND last_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$firstName, $lastName]);
        return "Мастер с именем $firstName $lastName успешно удален!";
    }

    // Обновление данных мастера по имени и фамилии
    public function updateMasterByName($firstName, $lastName, $middleName, $phoneNumber, $specialization) {
        $sql = "UPDATE Master SET first_name = ?, last_name = ?, middle_name = ?, phone_number = ?, specialization = ? 
                WHERE first_name = ? AND last_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$firstName, $lastName, $middleName, $phoneNumber, $specialization, $firstName, $lastName]);
        return "Данные мастера $firstName $lastName успешно обновлены!";
    }

    // Получение списка всех мастеров
    public function getAllMasters() {
        $sql = "SELECT * FROM Master";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  //Извлекает все строки данных из результата запроса и возвращает их в виде массива
    }
}
?>
