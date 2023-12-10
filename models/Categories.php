<?php

use app\core\Database;

class Categories extends Database
{
    public function getCategories()
    {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategory($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM products WHERE id = ? ");
        return $stmt->execute([$id]);
    }

    public function insertCategory($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, email) VALUES (?, ?)");
        $stmt->execute([$data]);
        return $this->pdo->lastInsertId();
    }

    public function updateCategory($id,$data)
    {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$id,$data]);
    }

    public function deleteCategory($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }

}
