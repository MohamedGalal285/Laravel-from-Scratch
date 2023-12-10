<?php

use app\core\Controller;
use app\core\Response;

class CategoriesController extends Controller 
{
    private $conn;
    public Response $response;

    public function __construct()
    {
        $this->conn = new Categories([
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
        $data['categories'] = $this->conn->getCategories();
        return $this->render('categories/index',$data);
    }


    public function add()
    {
        $this->setLayout('admin');
        return $this->render('categories/add');
    }

    public function store()
    {
        $this->setLayout('admin');
        if(isset($_POST['submit']))
        {
            $tittle = $_POST['tittle'];
            $desc = $_POST['desc'];
            $id = $_POST['id'];

            $this->conn = new Categories([
                'db' => [
                    'dsn' => $_ENV['DB_DSN'],
                    'user' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASSWORD'],
                ],
            ]);
            $data = Array ( "tittle" => $tittle ,
                                "desc" => $desc ,
                        );

            if($this->conn->insertCategory($data))
            {
                $data['success'] = "Data Added Successfully";
                return $this->render('categories/add',$data);
            }
            else 
            {
                $data['error'] = "Error";
                return $this->render('categories/add',$data);
            }
        }
        return $this->render('categories/add');
    }

    public function edit($id)
    {
        $this->setLayout('admin');
        $data['row'] = $this->conn->getCategory($id)[0];
        return $this->render('categories/edit',$data);
    }

    public function update()
    {
        $this->setLayout('admin');
        if(isset($_POST['submit']))
        {
            $tittle = $_POST['tittle'];
            $desc = $_POST['desc'];
            $id = $_POST['id'];

            $this->conn = new Categories([
                'db' => [
                    'dsn' => $_ENV['DB_DSN'],
                    'user' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASSWORD'],
                ],
            ]);
            $dataInsert = Array ( "tittle" => $tittle ,
                                "desc" => $desc ,
                        );

            if($this->conn->updateCategory($id,$dataInsert))
            {
                $data['success'] = "Updated Successfully";
                $data['row'] = $this->conn->getCategory($id)[0];
                $this->render('categories/edit',$data);
            }
            else 
            {
                $data['error'] = "Error";
                $data['row'] = $this->conn->getCategory($id)[0];
                return $this->render('categories/edit',$data);
            }
        }
        return $this->response->redirect('home/index');
    }

    public function delete($id)
    {
        $this->setLayout('admin');
        if($this->conn->deleteCategory($id))
        {
            $data['success'] = "Category Have Been Deleted";
            return $this->render('categories/delete',$data);
        }
        else 
        {
            $data['error'] = "Error";
            return $this->render('categories/delete',$data);
        }
    }
}