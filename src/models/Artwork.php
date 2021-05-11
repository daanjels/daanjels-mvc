<?php
class Artwork
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function store($data)
    {

        $this->db->query('
            INSERT INTO artworks 
            (title, year, price, availability, caption, description, tags, 
            name, path, genre, subject, style, medium, surface, collection) 
            VALUES (:title, :year, :price, :availability, :caption, :description, :tags,
            :name, :path, :genre, :subject, :style, :medium, :surface, :collection)
            ');
        // bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':caption', $data['caption']);
        $this->db->bind(':availability', $data['availability']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':tags', $data['tags']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':path', $data['path']);
        $this->db->bind(':genre', $data['genre']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':style', $data['style']);
        $this->db->bind(':medium', $data['medium']);
        $this->db->bind(':surface', $data['surface']);
        $this->db->bind(':collection', $data['collection']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCollections()
    {
        $this->db->query('SELECT headline, name FROM portfolio');

        $col = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $col;
        } else {
            return false;
        }
    }
}