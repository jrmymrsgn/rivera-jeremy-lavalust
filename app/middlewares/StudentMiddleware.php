<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentMiddleware
 *
 * Guards access to /student/profile.
 *
 * Unique access condition for this activity: the visitor must have
 * a session flag 'student_access' set to true AND a session flag
 * 'jrmyy_pass' equal to the string 'granted'. These flags are only
 * set when the student visits the /student home page first
 * (see StudentController::index()) — visiting /student/profile
 * directly with a fresh session will be denied and redirected back,
 * with a flash flag set so the home page can show a toast about it.
 */
class StudentMiddleware
{
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $allowed = isset($_SESSION['student_access'])
            && $_SESSION['student_access'] === true
            && isset($_SESSION['jrmyy_pass'])
            && $_SESSION['jrmyy_pass'] === 'granted';

        if (!$allowed) {
            // Unauthorized: flash a flag for the home page, then redirect
            $_SESSION['access_denied_flash'] = true;
            redirect('student');
            exit;
        }

        // Allowed: continue the pipeline to StudentController::profile()
        return $next();
    }
}