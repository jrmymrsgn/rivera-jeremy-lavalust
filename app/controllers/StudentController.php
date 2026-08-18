<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Student Home Page
     * URL: /student
     */
    public function index()
    {
        $data['page_title'] = 'Student Home';

        // Visiting the home page is what grants access to the protected
        // profile route below — this is this student's chosen "unique
        // middleware access condition" for the activity.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['student_access'] = true;
        $_SESSION['jrmyy_pass'] = 'granted';

        // Check if we just got here because the middleware denied
        // access to /student/profile (a fresh/unauthorized session).
        $data['access_denied'] = !empty($_SESSION['access_denied_flash']);
        unset($_SESSION['access_denied_flash']);

        $data['student'] = [
            'student_id' => 'MCC2024-00230',
            'name'       => 'Jeremy M. Rivera',
            'course'     => 'BS Information Technology',
            'year'       => '3rd-Year',
        ];

        $this->call->view('student_home', $data);
    }

    /**
     * Student Profile Page (protected by StudentMiddleware)
     * URL: /student/profile
     */
    public function profile()
    {
        $data['page_title'] = 'Student Profile';

        $data['student'] = [
            'student_id'  => 'MCC2024-00230',
            'name'        => 'Jeremy M. Rivera',
            'course'      => 'Bachelor Of Science Information Technology',
            'year'        => '3rd-Year',
            'section'     => '3-F5',
            'email'       => 'jrmymrsgn6@gmail.com',
            'address'     => 'Brgy. Suqui, Calapan City, Oriental Mindoro',
            'contact'     => '0929-374-5053',
            'hobbies'     => 'Playing football, watching movies, listening to music, and repairing things.',
            'description' => 'Football, movies, music and road trips, I\'m usually fixing or repairing something small, and this page counts as one of those.',
            'photo'       => 'assets/img/profile.jpg', // path relative to public/, put your photo there
        ];

        $data['socials'] = [
            'facebook'  => 'https://www.facebook.com/profile.php?id=100015297638983',
            'instagram' => 'https://www.instagram.com/jrmymrsgn/',
        ];

        $this->call->view('student_profile', $data);
    }
}