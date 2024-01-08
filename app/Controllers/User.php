<?php

class User extends Controller {
    public function indexLogin() {
        $this->view('user/login');
    }

    public function indexRegister() {
        $this->view('user/register');
    }
}