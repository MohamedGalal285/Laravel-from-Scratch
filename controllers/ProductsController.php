<?php

use app\core\Controller;
use app\core\Response;

class ProductsController extends Controller 
{
    private $conn;
    public Response $response;

    public function __construct()
    {
        $this->conn = new Products([
            'db' => [
                'dsn' => $_ENV['DB_DSN'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ],
        ]);
        $this->response = new Response();
    }


    public function index()
    {
        $this->setLayout('admin');
        $data['products'] = $this->conn->getProducts();
        return $this->render('products/index',$data);
    }


    public function add()
    {
        $this->setLayout('admin');
        return $this->render('products/add');
    }

    public function store()
    {
        $this->setLayout('admin');
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $img = $_POST['image'];
            $price = $_POST['price'];
            $brand = $_POST['brand'];
            $id = $_POST['id'];

            $this->conn = new Products([
                'db' => [
                    'dsn' => $_ENV['DB_DSN'],
                    'user' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASSWORD'],
                ],
            ]);
            $dataInsert = Array ( "product_name" => $name ,
                                "prodcut_image" => $img ,
                                "product_price" => $price ,
                                "product_brand" => $brand 
                        );

            if($this->conn->insertProduct($dataInsert))
            {
                $data['success'] = "Data Added Successfully";
                return $this->render('products/add',$data);
            }
            else 
            {
                $data['error'] = "Error";
                return $this->render('products/add',$data);
            }
        }
        return $this->render('products/add');
    }




    public function edit($id)
    {
        $this->setLayout('admin');
        $data['row'] = $this->conn->getProduct($id)[0];
        return $this->render('products/edit',$data);
    }

    public function update()
    {
        $this->setLayout('admin');
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $img = $_POST['image'];
            $price = $_POST['price'];
            $brand = $_POST['brand'];
            $id = $_POST['id'];

            $this->conn = new Products([
                'db' => [
                    'dsn' => $_ENV['DB_DSN'],
                    'user' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASSWORD'],
                ],
            ]);
            $dataInsert = Array ( "product_name" => $name ,
                                "prodcut_image" => $img ,
                                "product_price" => $price ,
                                "product_brand" => $brand 
                        );
            // data of product
            

            if($this->conn->updateProduct($id,$dataInsert))
            {
                $data['success'] = "Updated Successfully";
                $data['row'] = $this->conn->getProduct($id)[0];
                $this->render('products/edit',$data);
            }
            else 
            {
                $data['error'] = "Error";
                $data['row'] = $this->conn->getProduct($id)[0];
                return $this->render('products/edit',$data);
            }
        }
        return $this->response->redirect('home/index');
    }



    
    public function delete($id)
    {
        $this->setLayout('admin');
        if($this->conn->deleteProduct($id))
        {
            $data['success'] = "Product Have Been Deleted";
            return $this->render('products/delete',$data);
        }
        else 
        {
            $data['error'] = "Error";
            return $this->render('products/delete',$data);
        }
    }
}