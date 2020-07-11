<?php
/**
 * Base Controller
 * Loads the models and views
 */

class Controller
{
    // Load model
    public function model($model)
    {
        // require model class
        require_once '../src/models/' . $model . '.php';

        // Instantiate
        return new $model();
    }

    // Load view
    public function view($view, $data = [])
    {
        // check for the view file
        if (file_exists('../src/views/' . $view . '.php')) {
         // require view class
            require_once '../src/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }

}