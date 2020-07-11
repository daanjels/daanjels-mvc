<?php
class Pages extends Controller
{
    public function __construct()
    {
        // activate models here: $this->exampleModel = $this->model('Example');
        // for now we'll keep this simple and do most stuff in the views
        // later on we may collect parts from the database
        // especially to add stuff in the header (title, description), or to add classes (wrap)
    }

    public function index()
    {
        // $example = $this->exampleModel->getExample();
        $data = [
            'title' => 'd a: n j e l s',
            'description' => '<p>More to come...</p>',
            // 'example' => $example,
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title'=>'About',
            'description' => '<p>Coming soon...</p>',
        ];
        $this->view('pages/about', $data);
    }
}