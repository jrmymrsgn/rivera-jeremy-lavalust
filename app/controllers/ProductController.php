<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
        parent::__construct();
        session_start();
        if (!isset($_SESSION['logged_in'])) {
            app_redirect('login');
            exit;
        }
        $this->call->database();
        $this->call->model('ProductModel');
    }

    public function index() {
        $data['products'] = $this->ProductModel->all();
        $this->call->view('products/list', $data);
    }

    public function create() {
        $this->call->view('products/create');
    }

    public function store() {
        $data = [
            'product_name' => $_POST['product_name'],
            'description'  => $_POST['description'],
            'price'        => $_POST['price'],
            'quantity'     => $_POST['quantity'],
        ];
        $this->ProductModel->insert($data);
        $_SESSION['flash_message'] = 'Product added successfully.';
        app_redirect('products');
    }

    public function edit($id) {
        $data['product'] = $this->ProductModel->find($id);
        $this->call->view('products/edit', $data);
    }

    public function update($id) {
        $data = [
            'product_name' => $_POST['product_name'],
            'description'  => $_POST['description'],
            'price'        => $_POST['price'],
            'quantity'     => $_POST['quantity'],
        ];
        $this->ProductModel->update($id, $data);
        $_SESSION['flash_message'] = 'Product updated successfully.';
        app_redirect('products');
    }

    public function delete($id) {
        $this->ProductModel->delete($id);
        $_SESSION['flash_message'] = 'Product deleted.';
        app_redirect('products');
    }
}