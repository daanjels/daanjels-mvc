<?php
/**
 * App Core Class
 * Creates URL & loads core controller
 * URL format - /controller/method/params
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();
        // print_r($url); // print the array

        // if there is just one part in the url, add Pages in front to turn it into a method
        if (empty($url)) {
            $url = ['Pages']; // it will default to index anyway
        } else if (count($url) == 1) {
            array_unshift($url, 'Pages');
        }

        // look in controllers for first part in url
        if (file_exists('../src/controllers/' . ucwords($url[0]) . '.php')) {
            // use ../ to move from public, where this is called from, to src/controllers
            // capitalize the url to find the class which has a capital first letter
            $this->currentController = ucwords($url[0]);
            // unset class
            unset($url[0]); // indexes stay the same [1] is still the method
        }

        // require the controller class
        require_once '../src/controllers/' . $this->currentController . '.php';

        // instantiate controller class
        $this->currentController = new $this->currentController;

        // check for second part in url
        if(isset($url[1])) {
            // check if the method exists
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // unset method
                unset($url[1]);
            }
        }

        // get params: add the values of the url in the params
        $this->params = $url ? array_values($url) : [];

        // callback with array of params
        call_user_func_array([$this->currentController,
            $this->currentMethod], $this->params);
        
    }
    public function getURL()
    {
        // echo $_GET['url'];
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // remove any trailing backslash
            $url = filter_var($url, FILTER_SANITIZE_URL); // remove unwanted content
            $url = explode('/', $url); // turn into an array
            return $url;
        }
    }
}