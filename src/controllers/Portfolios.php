<?php
class Portfolios extends Controller
{
    public function __construct()
    {
        $this->portfolioModel = $this->model('Portfolio'); // load the user model
    }

    public function showcollection($collection)
    {
        $portfolio = $this->portfolioModel->getCollectionDetails($collection);
        $data = (array) $portfolio;
        $art = $this->portfolioModel->getWorksByCollection($collection);
        $data['art'] = $art;
        $this->view('portfolios/collection', $data);
    }

    public function showArtwork($art_id, $collection)
    {
        $portfolio = $this->portfolioModel->getCollectionDetails($collection);
        $data = (array) $portfolio;
        $art = $this->portfolioModel->getArtDetails($art_id);
        $data['art'] = $art;
        $data['art_id'] = $art_id; // do we need to pass this??
        $data['nav'] = 'false'; // this turns the navigation off, should refactor this later
        $this->view('portfolios/singledetail', $data);

    }
    public function index()
    {
        redirect('portfolios/portrait');
    }
    public function portrait($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('portrait');
        } else {
            $this->showArtwork($art_id, 'portrait');
        }
    }
    public function landscape($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('landscape');
        } else {
            $this->showArtwork($art_id, 'landscape');
        }
    }
    public function bird($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('bird');
        } else {
            $this->showArtwork($art_id, 'bird');
        }
    }
    public function figure($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('figure');
        } else {
            $this->showArtwork($art_id, 'figure');
        }
    }
    public function figurestudy($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('figurestudy');
        } else {
            $this->showArtwork($art_id, 'figurestudy');
        }
    }
    public function pleinair($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('pleinair');
        } else {
            $this->showArtwork($art_id, 'pleinair');
        }
    }
    public function summer($art_id = '')
    {
        if ($art_id == 'index' || $art_id == '') {
            $this->showCollection('summer');
        } else {
            $this->showArtwork($art_id, 'summer');
        }
    }
}