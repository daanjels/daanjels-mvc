<?php
class Shop extends Controller
{
    public function __construct()
    {
        $this->portfolioModel = $this->model('Portfolio'); // load the model
        // $this->shopModel = $this->model('Shop'); // load the model
				$this->navigationModel = $this->model('Navigation');
    }

    public function showStock($artwork = null)
    {
        $stock = $this->portfolioModel->getStockDetails();
        $data = (array) $stock;
        if ($artwork == null) { // if no $artwork is provided, show the full stock
            $art = $this->portfolioModel->getStock();
            $data['art'] = $art;
            $this->view('shop/stock', $data);
        } else { // if $name is given, show that artwork with details
						$art = $this->portfolioModel->getStockPrice($artwork);
            $data['art'] = $art;
            $data['title'] = $data['art']['title'].' - '.$data['art']['description'];
            $data['nav'] = 'false'; // this turns the navigation off, should refactor this later
            $this->view('shop/detail', $data);
        }
    }

    public function index($artwork = null)
    {
        // the index is the default method and uses the second parameter in the url as the first argument ($collection)
        // if ($collection == null) {
        //     $this->showCollection('portrait'); // if no collection is provided show the default
        // }
        $this->showStock($artwork); // if $artwork is null show the whole collection
    }
}