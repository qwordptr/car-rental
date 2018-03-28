<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 28.03.18
 * Time: 21:56
 */

namespace AppBundle\Service;


use AppBundle\Entity\Photo;
use AppBundle\Service\Interfaces\IFileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader implements IFileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function uploadFile(UploadedFile $file)
    {
        $ext = $file->guessExtension();
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->targetDirectory, $filename);
        $photo = new Photo();
        $photo->setFilename($filename);
        $photo->setExtension($ext);

        return $photo;

    }
}