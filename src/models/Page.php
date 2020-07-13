<?php
class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getQuote()
    {
        $id = idate('W'); // pick this weeks quote (we have only 53 quotes)
        // $id = random_int( 1, count($quotes));
        $this->db->query('SELECT quote, author, life FROM quotes WHERE quote_id = :id');
        $this->db->bind(':id', $id);
        
        $quote = $this->db->single();
        return $quote;
    }
}