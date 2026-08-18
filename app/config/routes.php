<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 * (license header omitted here for brevity — keep your existing one)
 */

/** @var object $router **/

$router->get('/', 'StudentController::index');

$router->get('student', 'StudentController::index');

$router->get('student/profile', 'StudentController::profile')
       ->middleware('StudentMiddleware');