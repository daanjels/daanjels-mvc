<?php
class Portfolio
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCollectionDetails($collection)
    {
        // retrieve a collection
        // use the name of the collection as page 
        // use the description of the collection as title for the page 
        $this->db->query('SELECT name as page, description as title, headline, introduction, wrap, mosaic FROM portfolio WHERE name = :collection');
        $this->db->bind(':collection', $collection);
        
        $details = $this->db->single();
        return $details;
    }

    public function getCollection($collection)
    {
        // $this->db->query('SELECT * FROM artworks ORDER BY year DESC, art_id ASC');
        $this->db->query('SELECT * FROM artworks ORDER BY position ASC');
        $artworks = (array) $this->db->resultSet(); // turn the resultset into an array

        $works = array();
        foreach($artworks as $key => $work) {
            if ($work->collection == $collection) {
                    $works[$key] = (array) $work;
            }
        }
        return $works;
    }

    public function getArtDetails($name)
    {
        $this->db->query('SELECT * FROM artworks WHERE name = :name');
        $this->db->bind(':name', $name);
        $work = (array) $this->db->single(); // turn the database object into an array

        $works = $this->getCollection($work['collection']);

        // let's put a counter on top
        $total = count($works); // get the total
        $items = array_column($works, 'name'); // make an aary of all the names
        array_unshift($items, $items[$total -1]); // add the name fo the last artwork at the start
        array_push($items, $items[1]); // add the name fo the first artwork at the the end 
        for ($i = 1; $i <= $total; $i++) { // figure out which artwork this is in the list
        if ($items[$i] == $name) {
            $count = $i;
            break;
        }
        }
        $work['count'] = $count;
        $work['total'] = $total;
        $work['prev'] = $items[$count-1]; // pass the name of the previous artwork as 'prev'
        $work['next'] = $items[$count+1]; // pass the name of the next artwork as 'next'
        
        return $work;
    }
}