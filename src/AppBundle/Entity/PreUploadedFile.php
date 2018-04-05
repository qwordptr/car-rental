<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 30.03.18
 * Time: 14:14
 */

namespace AppBundle\Entity;


class PreUploadedFile
{
    private $filename;
    private $extension;

    public function __construct($filename, $extension)
    {
        $this->filename = $filename;
        $this->extension = $extension;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}