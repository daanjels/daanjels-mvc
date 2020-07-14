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
        require APPROOT.'/resources/data.php';
        $works = array();
        foreach($artworks as $key => $work) {
            if ($work['collection'] == $collection) {
                $works[$key] = $work;
            }
        }
        return $works;
    }

    public function getArtDetails($art_id)
    {
        require APPROOT.'/resources/data.php';
        $work = $artworks[$art_id];
        $works = $this->getWorksByCollection($work['collection']);
        $total = count($works);
        $items = array_keys($works);
        array_unshift($items, $items[$total -1]);
        array_push($items, $items[1]);
        for ($i = 1; $i <= $total; $i++) {
        if ($items[$i] == $art_id) {
            $count = $i;
            break;
        }
        }
        $work['count'] = $count;
        $work['total'] = $total;
        $work['prev'] = $items[$count-1];
        $work['next'] = $items[$count+1];
        
        return $work;
    }
}