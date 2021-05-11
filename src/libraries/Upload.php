<?php
Class Upload
{
    protected $destination;
    protected $max = 1024000;
    protected $messages = [];
    protected $permitted = [
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/webp'
    ];
    protected $newName;
    
    public function __construct($path)
    {
        if (is_dir($path) && is_writable($path)) {
            $this->destination = rtrim($path, '/\\') 
                . DIRECTORY_SEPARATOR;
        } else {
            throw new Exception("$path must be a valid, writable directory.");
        }
    }

    public function upload($fieldname, $size = null, array $mime = null, $renameDuplicates = true) 
    {
        $uploaded = $_FILES[$fieldname];
        if (!is_null($size) && $size > 0) {
            $this->max = (int) $size;
        }
        if (!is_null($mime)) {
            $this->permitted = array_merge($this->permitted, $mime);
        }
        if ($this->checkFile($uploaded)) {
            $this->checkName($uploaded, $renameDuplicates);
            $this->moveFile($uploaded);
        }
    }

    public function getMessages() 
    {
        return $this->messages;
    }

    public function getMaxSize()
    {
        $size = number_format($this->max/1024, 1) . ' KB';
        if ($this->max >= 1024000) {
            $size = number_format($this->max/1024000, 1) . ' MB'; // 1048576
        }
        return $size;
    }

    protected function moveFile($file) 
    {
        $filename = $this->newName ?? $file['name']; // if a newName is defined, use it
        $success = move_uploaded_file($file['tmp_name'], 
            $this->destination . $filename);
        if ($success) {
            $result = '"' . $file['name'] . '" is correct verwerkt';
            if (!is_null($this->newName)) {
                $result .= ' met de naam ' . $this->newName . '.';
            }
            $this->messages[] = $result;
        } else {
            $this->messages[] = 'Uploaden van "' . $file['name'] . '" is mislukt.';
        }
    }

    protected function checkFile($file) 
    {
        $accept = $this->getErrorLevel($file);
        $accept = $this->checkSize($file);
        // if a file is not uploaded because it is too big,
        // we must not check the type (it will be empty)
        if (!empty($file['type'])) {
            $accept = $this->checkType($file);
        }
        return $accept;
    }

    protected function checkName($file, $renameDuplicates)
    {
        $this->newName = null;
        $nospaces = str_replace(' ', '_', $file['name']);
        if ($nospaces != $file['name']) {
            $this->newName = $nospaces;
        }
        if ($renameDuplicates) {
            $name = $this->newName ?? $file['name'];
            if (file_exists($this->destination . $name)) {
                $basename = pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $this->newName = $basename . '_' . time() . '.' . $extension;    
            }
        }
    }

    protected function getErrorLevel($file)
    {
        switch($file['error']) {
            case 0:
                return true;
            case 1:
            case 2:
                $this->messages[] = '"' . $file['name'] 
                    . '" is te groot: (max: ' 
                    . $this->getMaxSize()
                    . ').';
                break;
            case 3:
                $this->messages[] = '"' . $file['name']
                    . '" was only partially uploaded.';
                break;
            case 4:
                $this->messages[] = 'Geen bestand gekozen.';
                break;
            default:
                $this->messages[] = 'Sorry, there was a problem uploading "'
                    . $file['name']
                    . '".';
        }
        return false;   
    }

    protected function checkSize($file)
    {
        if ($file['error'] == 1 || $file['error'] == 2) {
            return false;
        } elseif ($file['size'] == 0) {
            $this->messages[] = '"' . $file['name'] 
                . '" is an empty file.';
            return false; 
        } elseif ($file['size'] > $this->max) {
            $this->messages[] = '"' . $file['name']
                . '" exceeds the maximum size for a file ('
                . $this->getMaxSize()
                . ').';
            return false;
        }
        return true;
    }

    protected function checkType($file)
    {
        if (!in_array($file['type'], $this->permitted)) {
            $this->messages[] = '"' . $file['name']
                . '" is not an accepted file type.';
            return false;
        }
        return true;
    }
}