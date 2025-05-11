<?php
class Database {
    private $host = 'db-mysql';       
    private $dbname = 'web2024-yusupova-julia'; 
    private $username = 'web2024-yusupova-julia';        
    private $password = 'web2024-yusupova-julia';            
    private $pdo = null;               

    public function connect() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Ошибка подключения к БД: ' . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}
?>
