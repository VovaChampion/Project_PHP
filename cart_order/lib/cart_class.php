<?php

class Cart {
    //private $products;

    private $db;

    function __construct() {
        $obj = new DB();
        $this->db = $obj->pdo;
    }

    public function getAllProducts() {
        $sql = 'SELECT * FROM products';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function addProduct($product_id) {
        
        $sql = 'SELECT * FROM products WHERE product_id LIKE :product_id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    // public function deleteProduct($product_id) {
    //     $product_id = (int)$product_id;

    //     $key = array_search($product_id, $this->db);
    //     if ($key !== false) {
    //         unset($this->db[$key]);
    //     }
    //     Cookie::set('products', serialize($this->db));
    // }

    // public function clear() {
    //     Cookie::delete('products');
    // }

    // public function isEmpty() {
    //     return !$this->db;
    // }

}

?>