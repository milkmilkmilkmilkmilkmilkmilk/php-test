<?php

/**
 * Class Init
 *
 * Класс для работы с таблицей test.
 * Содержит методы для создания и заполнения таблицы, а также для получения данных.
 */
final class Init {
    private $conn;

    /**
     * Конструктор класса Init.
     * Вызывает методы create и fill для инициализации таблицы.
     */
    public function __construct() {
        $this->connect();
        $this->create();
        $this->fill();
    }

    /**
     * Устанавливает соединение с базой данных.
     */
    private function connect() {
        $this->conn = new mysqli('localhost', 'root', '', 'user_database');


        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Создает таблицу test в базе данных.
     * Доступен только внутри класса.
     */
    private function create() {
        // SQL-запрос для создания таблицы test
        $sql = "CREATE TABLE IF NOT EXISTS test (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            result ENUM('normal', 'success', 'fail'),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        $this->executeQuery($sql);
    }

    /**
     * Заполняет таблицу test случайными данными.
     * Доступен только внутри класса.
     */
    private function fill() {
        // Пример заполнения таблицы случайными данными
        for ($i = 0; $i < 10; $i++) {
            $name = 'Name ' . rand(1, 100);
            $result = rand(0, 1) ? 'normal' : 'success';
            $sql = "INSERT INTO test (name, result) VALUES ('$name', '$result');";
            
            $this->executeQuery($sql);
        }
    }

    /**
     * Выполняет SQL-запрос.
     *
     * @param string $sql SQL-запрос для выполнения.
     */
    private function executeQuery($sql) {
        if ($this->conn->query($sql) === TRUE) {
            // Запрос выполнен успешно
        } else {
            echo "Error executing query: " . $this->conn->error;
        }
    }

    /**
     * Получает данные из таблицы test по критерию result.
     *
     * @return array Массив с результатами запроса.
     */
    public function get() {
        // SQL-запрос для получения данных с result 'normal' или 'success'
        $sql = "SELECT * FROM test WHERE result IN ('normal', 'success');";
        
        return $this->fetchResults($sql);
    }

    /**
     * Получает результаты запроса из базы данных.
     *
     * @param string $sql SQL-запрос для выполнения.
     * @return array Массив с результатами запроса.
     */
    public function fetchResults($sql) {
        $result = $this->conn->query($sql);
        $data = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Закрывает соединение с базой данных.
     */
    public function __destruct() {
        $this->conn->close();
    }
}

// Использование класса Init
$init = new Init();
$data = $init->get();

// Отображение данных на странице
foreach ($data as $row) {
    echo "ID: " . $row['id'] . " - Name: " . $row['name'] . " - Result: " . $row['result'] . "<br>";
}
?>
