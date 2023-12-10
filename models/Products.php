<?php

use app\core\Database;

class Products extends Database
{
    public function getProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProduct($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM products WHERE id = ? ");
        return $stmt->execute([$id]);
    }

    public function insertProduct($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, email) VALUES (?, ?)");
        $stmt->execute([$data]);
        return $this->pdo->lastInsertId();
    }

    public function updateProduct($id,$data)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute($id,$data);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}