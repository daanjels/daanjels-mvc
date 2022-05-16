<?php
class Portfolios extends Controller
{
    public function __construct()
    {
        $this->portfolioModel = $this->model('Portfolio'); // load the model
				$this->navigationModel = $this->model('Navigation');
    }

    public function showCollection($collection, $artwork = null)
    {
        if ($collection == null) {
            $collection = 'portrait';
        }
        $portfolio = $this->portfolioModel->getCollectionDetails($collection);
        $data = (array) $portfolio;
        if ($artwork == null) { // if no $name is provided, show the full collection
            $art = $this->portfolioModel->getCollection($collection);
            $data['art'] = $art;
            $this->view('portfolios/collection', $data);
        } else { // if $name is given, show that artwork with details
            $art = $this->portfolioModel->getArtDetails($artwork, $collection);
						// var_dump($art);
            $data['art'] = $art;
            $data['title'] = $data['art']['title'].' - '.$data['art']['caption'];
            $data['nav'] = 'false'; // this turns the navigation off, should refactor this later
            $this->view('portfolios/singledetail', $data);
        }
    }

    public function index($collection = null, $artwork = null)
    {
        // the index is the default method and uses the second parameter in the url as the first argument ($collection)
				if ($collection == null) {
					// $this->showCollection('portrait'); // if no collection is provided show the default
            $this->showCollection(''); // if no collection is provided show the default
        }
        $this->showCollection($collection, $artwork); // if $artwork is null show the whole collection
    }
}