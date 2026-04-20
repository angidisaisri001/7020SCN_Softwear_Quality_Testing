<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $role = $_POST['role'];
            $user = $userModel->login($_POST['email'], $_POST['password'], $role);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                if ($role == 'admin') $this->redirect('admin/dashboard');
                else $this->redirect('patient/dashboard');
            } else {
                $this->view('login', ['error' => 'Invalid credentials']);
            }
        } else {
            $this->view('login');
        }
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $userModel->register($_POST);
            $this->redirect('auth/login');
        } else {
            $this->view('signup');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('home/index');
    }
}