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
        $url = $this->getURL(); // get the part that comes after  the

        // if there is nothing extra in the url, add Pages in front to turn it into a method
        if (empty($url)) {
            $url = ['Pages']; // it will default to index anyway
            // echo '<h1>Empty url!</h1>';
        }

        // look in controllers for first part in url
        if (file_exists('../src/controllers/' . ucwords($url[0]) . '.php')) {
            // use ../ to move from public, where this is called from, to src/controllers
            // capitalize the url to find the class which has a capital first letter
            $this->currentController = ucwords($url[0]);
            // unset class
            unset($url[0]); // indexes stay the same [1] is still the method
            // echo '<h1>Class was foundl!</h1>';
        } elseif (count($url) == 1) { // if the first and single part is not a class, add Pages in front to turn it into a method
            array_unshift($url, 'Pages');
            $this->currentController = 'Pages';
        }

        // require the controller class
        require_once '../src/controllers/' . $this->currentController . '.php';

        // check for second part in url
        if(isset($url[1])) {
            // check if the method exists
            if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // unset the method in the url
                    unset($url[1]);
            }
            // when there is no specific method, index will be used
            // in this case we do not remove the 'method' from the url, keeping it as a parameter for the index method
            // this means we can use index as a default method which uses the url parameters as arguments
            }

						// get params: add the values of the url in the params
        $this->params = $url ? array_values($url) : [];

        // instantiate controller class
        $this->currentController = new $this->currentController;

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