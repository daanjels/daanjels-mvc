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
        $art = $this->portfolioModel->getCollection($collection);
        $data['art'] = $art;
        $this->view('portfolios/collection', $data);
    }

    public function showArtwork($name, $collection)
    {
        $portfolio = $this->portfolioModel->getCollectionDetails($collection);
        $data = (array) $portfolio;
        $art = $this->portfolioModel->getArtDetails($name);
        $data['art'] = $art;
        $data['title'] = $data['art']['title'].' - '.$data['art']['caption'];
        $data['nav'] = 'false'; // this turns the navigation off, should refactor this later
        $this->view('portfolios/singledetail', $data);
    }
    public function index()
    {
        redirect('portfolios/portrait');
    }
    public function portrait($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('portrait');
        } else {
            $this->showArtwork($name, 'portrait');
        }
    }
    public function landscape($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('landscape');
        } else {
            $this->showArtwork($name, 'landscape');
        }
    }
    public function bird($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('bird');
        } else {
            $this->showArtwork($name, 'bird');
        }
    }
    public function figure($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('figure');
        } else {
            $this->showArtwork($name, 'figure');
        }
    }
    public function figurestudy($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('figurestudy');
        } else {
            $this->showArtwork($name, 'figurestudy');
        }
    }
    public function pleinair($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('pleinair');
        } else {
            $this->showArtwork($name, 'pleinair');
        }
    }
    public function summer($name = '')
    {
        if ($name == 'index' || $name == '') {
            $this->showCollection('summer');
        } else {
            $this->showArtwork($name, 'summer');
        }
    }
}