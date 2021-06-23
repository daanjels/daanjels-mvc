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
        // $this->db->query('SELECT * FROM artworks ORDER BY position ASC');
        // $artworks = (array) $this->db->resultSet(); // turn the resultset into an array
        // $works = array();
        // foreach($artworks as $key => $work) {
        //     if ($work->collection == $collection) {
        //             $works[$key] = (array) $work;
        //     }
        // }

				// the data is now stored in dedicated tables, the table 'sets' holds the data pertaining to sets or collections: the set, the artworks and an ordering.
				// This means we need to retrieve necessary data from different tables:
				// $this->db->query('SELECT a.art_id, a.path, a.genre, a.title, a.description, p.name as collection
				// 	FROM artworks a 
				// 	INNER JOIN sets s ON a.art_id = s.art_id 
				// 	INNER JOIN portfolio p ON p.folio_id = s.set_id
				// 	WHERE p.name = :name
				// 	ORDER BY s.rank_id');
        // $this->db->bind(':name', $collection);
				// $artworks = (array) $this->db->resultSet();
        // $works = array();
        // foreach($artworks as $key => $work) {
				// 	$works[$key] = (array) $work;
        // }
				// var_dump($works);

				// we can improve all this using a view that gathers the data from different tables and creates default captions on the fly using metadata 
				$this->db->query('SELECT * FROM sets_vw
					WHERE collection = :name');
        $this->db->bind(':name', $collection);
				$artworks = (array) $this->db->resultSet();
        $arts = array();
        foreach($artworks as $key => $work) {
					$arts[$key] = (array) $work;
        }
				// var_dump($arts);
				return $arts;
    }

    public function getArtDetails($name)
    {
        // $this->db->query('SELECT * FROM artworks WHERE name = :name');
				// $this->db->query('SELECT a.art_id, a.path, a.name, a.title, a.caption, a.collection FROM artworks a WHERE name = :name');
				// $this->db->query('SELECT a.art_id, a.path, a.name, a.title, a.caption, p.name as collection 
				// 	FROM artworks a 
				// 	INNER JOIN sets s ON a.art_id = s.art_id 
				// 	INNER JOIN portfolio p ON p.folio_id = s.set_id
				// 	WHERE a.name = :name');
				$this->db->query('SELECT * FROM sets_vw WHERE url = :name');
        $this->db->bind(':name', $name);
        $work = (array) $this->db->single(); // turn the database object into an array

        $works = $this->getCollection($work['collection']);

        // let's put a counter on top
        $total = count($works); // get the total
        $items = array_column($works, 'url'); // make an array of all the names
        array_unshift($items, $items[$total -1]); // add the name of the last artwork at the start
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