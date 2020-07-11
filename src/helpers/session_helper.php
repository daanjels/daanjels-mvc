<?php
session_start();
// flash message helper
// example: flash('register success', 'You are now registered', 'alert-danger');
// display in view: echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert-success')
{
    if (!empty($name)) {
        // echo $name;
        // print_r($_SESSION);
        if (!empty($message) && empty($_SESSION[$name])) {
            echo 'message not empty';
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name].'_class')) {
                unset($_SESSION[$name.'_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;

    } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<pre class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</pre>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
} 
