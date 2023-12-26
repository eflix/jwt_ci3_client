<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function index(){
        $this->load->view('auth/login');
    }

    public function register(){
        $this->load->view('templates/auth_header');
			$this->load->view('auth/register');
			$this->load->view('templates/auth_footer');	
    }
    public function login(){
        $this->load->view('templates/auth_header');
		$this->load->view('auth/login');
		$this->load->view('templates/auth_footer');
    }

    public function create(){
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
        
        $post = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
        ];

        $ch = curl_init();
        $url = "http://localhost/jwt-ci3-server/api/register/";
        $url = mb_convert_encoding($url, "iso-8859-7", "UTF-8");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($ch, CURLOPT_HEADER, true);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        // var_dump($response);

        redirect('auth/login');

        // echo $email;
    }

    public function do_login(){
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');

        // if (!isset($_SESSION['session_end_time'])) {
        //     redirect('auth/dashboard');
        // }
        
        $post = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        ];

        $ch = curl_init();
        $url = "http://localhost/jwt-ci3-server/api/login/";
        $url = mb_convert_encoding($url, "iso-8859-7", "UTF-8");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($ch, CURLOPT_HEADER, true);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        // var_dump(json_decode($response)->data->token);
        // echo $response['data'];

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            session_regenerate_id();
        }

        //Create a session token
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            $_SESSION['token'] = json_decode($response)->data->token;
        }

        //Set a session end time
        if (!isset($_SESSION['session_end_time'])) {
            $_SESSION['session_end_time'] = json_decode($response)->data->exp;
        }

        //Set a session end time
        if (!isset($_SESSION['username'])) {
            $_SESSION['username'] = $this->input->post('username');
        }

        //Set a session end time
        if (!isset($_SESSION['password'])) {
            $_SESSION['password'] = $this->input->post('password');
        }


        redirect('auth/dashboard',$response);

        // echo $email;
    }

    public function dashboard(){
        $S_end_time = $_SESSION['session_end_time'];
        $now = time();

        if ($now >= $S_end_time) {
            session_destroy();

            redirect('auth/login');
        }

        // echo $S_end_time. "<br>";
        // echo $now. "\n";

        $this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('auth/dashboard');
		$this->load->view('templates/footer');
    }

    public function logout(){

        session_destroy();

        redirect('auth/login');
    }
    
    public function user(){
        $S_end_time = $_SESSION['session_end_time'];
        $now = time();

        if ($now >= $S_end_time) {
            session_destroy();

            redirect('auth/login');
        }

        // echo $S_end_time. "<br>";
        // echo $now. "\n";

        $post = [
            'username' => $_SESSION['username'],
            'password' => $_SESSION['password'],
        ];

        $ch = curl_init();
        $url = "http://localhost/jwt-ci3-server/api/user/";
        $url = mb_convert_encoding($url, "iso-8859-7", "UTF-8");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($ch, CURLOPT_HEADER, true);

        // execute!
        $response = curl_exec($ch);
        $data['user'] = json_decode($response);

        // close the connection, release resources used
        curl_close($ch);

        $this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('auth/user',$data);
		$this->load->view('templates/footer');
    }

}