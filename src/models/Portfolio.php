<?php
class Portfolio
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getCollectionDetails($collection = "")
	{
		if ($collection == "") {
			$details = $this->getStockDetails();
			return $details;
		}
		// retrieve a collection
		// use the name of the collection as page 
		// use the description of the collection as title for the page 
		$this->db->query('SELECT name as page, description as title, headline, introduction, wrap, mosaic FROM portfolio WHERE name LIKE :collection');
		$this->db->bind(':collection', $collection);
		$details = $this->db->single();
		return $details;
	}

	public function getCollection($collection = "")
	{
		if ($collection == "") {
			$artworks = $this->getStock();
			return $artworks;
		}
		$this->db->query('SELECT * FROM sets_vw WHERE collection = :name');
		$this->db->bind(':name', $collection);
		$artworks = (array) $this->db->resultSet();
		$arts = array();
		foreach($artworks as $key => $work) {
			$arts[$key] = (array) $work;
		}
		return $arts;
	}

	public function getCollections()
	{
		$this->db->query('SELECT DISTINCT collection FROM sets_vw');
		$sets = $this->db->resultSet();
		$collections = array();
		foreach($sets as $key => $name) {
			$name = (array) $name;
			$collections[$key] = $name['collection'];
		}
//		var_dump($collections);
		return $collections;
	}

	public function getStockDetails()
	{
		$details['page'] = 'stock';
		$details['title'] = 'Stock van Daanjels';
		$details['headline'] = 'Daanjels shop coming soon!';
		$details['introduction'] = 'Intro';
		$details['wrap'] = 'canvas';
		$details['mosaic'] = 'pins';
		return $details;
	}

	public function getStock()
	{
		$this->db->query('SELECT * FROM sets_vw WHERE stock = :sale AND collection IN (SELECT name FROM portfolio WHERE type = :collection AND active = 1)');
		$this->db->bind(':sale', 'Te koop');
		$this->db->bind(':collection', 'collection');
		$artworks = (array) $this->db->resultSet();
		$arts = array();
		foreach($artworks as $key => $work) {
			$arts[$key] = (array) $work;
		}
		return $arts;
	}

	public function getOneFromStock()
	{
		$this->db->query('SELECT * FROM sets_vw WHERE stock = :sale AND collection IN (SELECT name FROM portfolio WHERE type = :collection AND active = 1)');
		$this->db->bind(':sale', 'Te koop');
		$this->db->bind(':collection', 'Collection');
		$artworks = (array) $this->db->resultSet();
		$arts = array();
		foreach($artworks as $key => $work) {
			$arts[$key] = (array) $work;
		}
		return $arts;
	}

	public function getStockPrice($name)
	{
		// echo $name;
		$this->db->query('SELECT * FROM artworks AS a INNER JOIN sets_vw AS s ON a.art_id = s.art_id WHERE s.url LIKE :name');
		$this->db->bind(':name', $name);
		$work = (array) $this->db->single(); // turn the database object into an array
		var_dump($work);
		return $work;
	}

	public function getArtDetails($name, $collection = "")
	{
		if ($collection == "") {$works = $this->getStock();}
		$this->db->query('SELECT * FROM sets_vw WHERE url = :name AND collection = :collection');
		$this->db->bind(':name', $name);
		$this->db->bind(':collection', $collection);
		$work = (array) $this->db->single(); // turn the database object into an array
		$works = $this->getCollection($work['collection']);

		// let's put a counter on top
		$total = count($works); // get the total
		$count = 1;
		$items = array_column($works, 'url'); // make an array of all the names
		array_unshift($items, $items[$total -1]); // add the name of the last artwork at the start
		array_push($items, $items[1]); // add the name fo the first artwork at the end 
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

	public function setArtSold($name)
	{
		$this->db->query('UPDATE artworks SET availability = "Gereserveerd" WHERE title = :name');
		$this->db->bind(':name', $name);
		$this->db->execute(); // perform the update
		return true;
	}

	public function getCurrentExpo()
	{
		$this->db->query('SELECT name FROM portfolio WHERE type = "expo" AND active = 1');
		$expo = $this->db->single()->name;
		return $expo;
	}
}