<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function show_users() {
        $data['users'] = $this->UsersModel->all();  
        $this->call->view('UserView', $data);
    }

    //methods
}