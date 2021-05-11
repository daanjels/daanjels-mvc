<?php
class Thumbnail
{
    protected $original;
    protected $originalwidth;
    protected $originalheight;
    protected $basename;
    protected $maxsize = 128;
    protected $imageType;
    protected $destination;
    protected $suffix = '_s';
    protected $messages = [];

    public function __construct($image, $destination = APPROOT.'/uploads/thumbs', $maxsize = 128, $suffix = '_thb')
    {
        if (is_file($image) && is_readable($image)) {
            $details = getimagesize($image);
        } else {
            throw new \Exception("Cannot open $image.");
        }

        if (!is_array($details)) {
            throw new \Exception("$image doesn't appear to be an image.");
        } else {
            if ($details[0] == 0) {
                throw new \Exception("Cannot determine the size of $image.");
            }
            if (!$this->checkType($details['mime'])) {
                throw new \Exception("Cannot process this type of file.");
            }
            $this->original = $image;
            $this->originalwidth = $details[0];
            $this->originalheight = $details[1];
            $this->basename = pathinfo($image, PATHINFO_FILENAME);
            $this->setDestination($destination);
            $this->setMaxsize($maxsize);
            $this->setSuffix($suffix);
        }
    }

    public function create()
    {
        $ratio = $this->calculateRatio($this->originalwidth, $this->originalheight, $this->maxsize);
        $thumbwidth = round($this->originalwidth * $ratio);
        $thumbheight = round($this->originalheight * $ratio);
        $resource = $this->createImageResource();
        $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);

        imagecopyresampled(
            $thumb, $resource, // destination and source 
            0, 0, // x and y in destination image
            0, 0, // x and y in source image
            $thumbwidth, $thumbheight, // w and h of destiantion image
            $this->originalwidth, $this->originalheight // w and h of source image
        ); // this copies the resample image into $thumb

        $newname = $this->basename . $this->suffix;
        switch ($this->imageType) {
            case 'jpeg':
                $newname .= '.jpg';
                $success = imagejpeg($thumb, $this->destination . $newname);
                break;
            case 'png':
                $newname .= '.png';
                $success = imagepng($thumb, $this->destination . $newname);
                break;
            case 'gif':
                $newname .= '.gif';
                $success = imagegif($thumb, $this->destination . $newname);
                break;
            case 'webp':
                $newname .= '.webp';
                $success = imagewebp($thumb, $this->destination . $newname);
                break;
        }
        if ($success) {
            $this->messages[] = "$newname created successfully.";
        } else {
            $this->messages[] = "Couldn't create a thumbnail for " . basename($this->original) . ".";
        }
        imagedestroy($resource); // clean up memory
        imagedestroy($thumb); // clean up memory
    }

    public function getMessages() 
    {
        return $this->messages;
    }

    protected function createImageResource() {
        switch ($this->imageType) {
            case 'jpeg':
                return imagecreatefromjpeg($this->original);
            case 'png':
                return imagecreatefrompng($this->original);
            case 'gif':
                return imagecreatefromgif($this->original);
            case 'webp':
                return imagecreatefromwebp($this->original);
        }
    }
    protected function calculateRatio($width, $height, $maxsize)
    {
        if ($width <= $maxsize && $height <= $maxsize) {
            return 1;
        } elseif ($width > $height) {
            return $maxsize / $width;
        } else {
            return $maxsize / $height;
        }
    }

    protected function checkType($mime)
    {
        $mimetypes = [
        'image/gif',
        'image/jpeg',
        'image/png',
        'image/webp'
        ];
        if (in_array($mime, $mimetypes)) {
            $this->imageType = substr($mime, strpos($mime, '/')+1);
            return true;
        }
        return false;
    }

    protected function setDestination($destination) 
    {
        if (is_dir($destination) && is_writable($destination)) {
            $this->destination = rtrim($destination, '/\\') . DIRECTORY_SEPARATOR;
        } else {
            throw new \Exception("Cannot write to $destination");
        }
    }

    protected function setMaxsize($size)
    {
        if (is_numeric($size)) {
            $this->maxsize = abs($size);
        }
    }

    protected function setSuffix($suffix) 
    {
        if (preg_match('/^\w+$/', $suffix)) {
            // using regular expression: ^\w+$
            // ^ start at the beginning
            // \w match alphanumeric or underscore
            // + match it one or more time
            // $ untill the end of the string
            if (strpos($suffix, '_') !== 0) {
                $this->suffix = '_'.$suffix;
            } else {
                $this->suffix = $suffix;
            }
        }
    }

    public function test()
    {
        $ratio = $this->calculateRatio($this->originalwidth, $this->originalheight, $this->maxsize);
        $thumbwidth = round($this->originalwidth * $ratio);
        $thumbheight = round($this->originalheight * $ratio);
        $details = <<<END
        <pre>
        File: $this->original
        Original width: $this->originalwidth
        Original heigth: $this->originalheight
        Base name: $this->basename
        Imagetype: $this->imageType
        Destination: $this->destination
        Max size: $this->maxsize
        Suffix: $this->suffix
        Ratio: $ratio
        Thumb width: $thumbwidth
        Thumb height: $thumbheight
        </pre>
        END;
        echo $details;
        if ($this->messages) {
            print_R($this->messages);
        }
    }
}