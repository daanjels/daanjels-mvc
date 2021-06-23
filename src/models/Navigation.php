<?php
class Navigation
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

	public function getPortfolio()
	// This function retrieves names for the portfolio and puts them in an array
	{
		$this->db->query('SELECT name, headline FROM portfolio WHERE active = 1 ORDER BY ord');
		$sets = (array) $this->db->resultSet();
		$folio = array();
		foreach($sets as $key => $set) {
			$folio[((array) $set)['name']] = ((array) $set)['headline'];
		}
		return $folio;
	}
}