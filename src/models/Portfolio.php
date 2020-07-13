<?php
class Portfolio
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getWorksByCollection($collection)
    {
        require_once APPROOT.'/resources/data.php';
        $works = array();
        foreach($artworks as $key => $work) {
            if ($work['collection'] == $collection) {
                $works[$key] = $work;
            }
        }
        return $works;
    }
}