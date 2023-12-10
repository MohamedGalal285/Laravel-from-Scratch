<?php

use app\core\Application;

class m0003_categories{

    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE categories(
            id INT AUTO_INCREMENT PRIMARY KEY,
            tittle VARCHAR(100) NOT NULL,
            category_desc VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB; ";
        $db->pdo->exec($SQL);
    }
    public function down(){
        $db = Application::$app->db;
        $SQL = " DROP TABLE categories ; ";
        $db->pdo->exec($SQL);
    }


}