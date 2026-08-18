<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware extends Middleware
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Guards access to /student/profile.
     *
     * Unique access condition for this activity: the visitor must have
     * a session flag 'student_access' set to true AND a session flag
     * 'jrmyy_pass' equal to the string 'granted'. This double-check is
     * this student's individualized twist on the basic middleware pattern
     * described in the lab (most versions only check one flag).
     */
    public function handle()
    {
        session_start();

        // Simulate the access condition being granted the first time the
        // student visits (in a real app this would come from a login step).
        if (!isset($_SESSION['student_access'])) {
            $_SESSION['student_access'] = true;
            $_SESSION['jrmyy_pass'] = 'granted';
        }

        $allowed = isset($_SESSION['student_access'])
            && $_SESSION['student_access'] === true
            && isset($_SESSION['jrmyy_pass'])
            && $_SESSION['jrmyy_pass'] === 'granted';

        if (!$allowed) {
            // Unauthorized: bounce back to the student home page
            redirect('student');
            exit;
        }

        // Allowed: let the request continue to StudentController::profile()
        return true;
    }
}