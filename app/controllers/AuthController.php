<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
        parent::__construct();
        $this->call->database();
        $this->call->model('AccountModel');
    }

    public function login_form() {
        $this->call->view('auth/login');
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $account = $this->AccountModel->find_by('username', $username);

        if ($account && password_verify($password, $account['password'])) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $account['username'];
            $_SESSION['flash_message'] = 'Signed in successfully.';
            app_redirect('products');
        } else {
            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        session_start();
        $_SESSION['flash_message'] = 'You have been logged out.';
        app_redirect('login');
    }
}