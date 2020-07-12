<?php
class Portfolio
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}