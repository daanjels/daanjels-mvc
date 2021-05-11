<?php
class UploadImage extends Upload
{
    protected $thumbDestination;
    protected $deleteOriginal = false;
    protected $maxsize;
    protected $suffix;

    public function __construct($path, $deleteOriginal = false) 
    {
        parent::__construct($path);
        $this->thumbDestination = $path;
        $this->deleteOriginal = $deleteOriginal;
    }

    public function setThumbOptions($path, $maxsize = null, $suffix = null) 
    {
        if (is_dir($path) && is_writable($path)) {
            $this->thumbDestination = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
        } else {
            throw new \Exception("$path must be a valid, writable directory");
        }
        if (!is_null($suffix)) {
            $this->suffix = $suffix;
        }
    }

    protected function moveFile($file) 
    {
        $filename = $this->newName ?? $file['name']; // if a newName is defined, use it
        $success = move_uploaded_file($file['tmp_name'], 
            $this->destination . $filename);
        if ($success) {
            // add a message only of the original image is not deleted
            if (!$this->deleteOriginal) {
                $result = '"' . $file['name'] . '" was uploaded successfully';
                if (!is_null($this->newName)) {
                    $result .= ' and was renamed ' . $this->newName . '.';
                }
                $this->messages[] = $result;    
            }
            // create a thumbnail from the uploaded image
            $this->createThumbnail($this->destination . $filename);
            // delete the originalif required
            if ($this->deleteOriginal) {
                unlink($this->destination . $filename);
            }
        } else {
            $this->messages[] = 'Could not upload "' . $file['name'] . '".';
        }
    }

    protected function createThumbnail($image) 
    {
        $thumb = new Thumbnail($image, $this->thumbDestination, $this->maxsize, $this->suffix);
        $thumb->create();
        $messages = $thumb->getMessages();
        $this->messages = array_merge($this->messages, $messages);
    }
}