<?php

use app\core\Application;

class m0004_product{

    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE proudcts(
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(100) NOT NULL,
            product_brand VARCHAR(100) NOT NULL,
            product_price VARCHAR(100) NOT NULL,
            category_id INT,
            prodcut_image VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB; ";
        $db->pdo->exec($SQL);
    }
    public function down(){
        $db = Application::$app->db;
        $SQL = " DROP TABLE proudcts ; ";
        $db->pdo->exec($SQL);
    }


}