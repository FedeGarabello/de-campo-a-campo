<?php

namespace Src\Domain;

use PDO;
use Src\Model\Product;

class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetchObject(Product::class);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
            $stmt->execute([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);

            $product = $this->find($this->db->lastInsertId());
            $this->db->commit();
            return $product;
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("UPDATE products SET name=:name, description=:description, price=:price WHERE id=:id");
            $stmt->execute([
                'id' => $id,
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);
            $this->db->commit();
            return $this->find($id);
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("DELETE FROM products WHERE id=:id");
            $stmt->execute(['id' => $id]);
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw new \RuntimeException($e->getMessage());
        }
    }
}
