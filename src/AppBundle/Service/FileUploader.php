<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 28.03.18
 * Time: 21:56
 */

namespace AppBundle\Service;


use AppBundle\Entity\Photo;
use AppBundle\Entity\PreUploadedFile;
use AppBundle\Service\Interfaces\IFileUploader;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileUploader implements IFileUploader
{
    private $temporaryDirectory;
    private $filesystem;

    public function __construct($temporaryDirectory, Filesystem $filesystem)
    {
        $this->temporaryDirectory = $temporaryDirectory;
        $this->filesystem = $filesystem;
    }

    public function persistFile(PreUploadedFile $file, string $directory)
    {
        $filesystem = $this->filesystem;
        $tempFilePath = sprintf("/%s/%s", $this->temporaryDirectory, $file->getFilename());
        $persistFilePath = sprintf("/%s/%s", $directory, $file->getFilename());

        if (!$filesystem->exists($tempFilePath)) {
            throw new NotFoundHttpException("File not found.");
        }
        //TODO: USPRAWNIC

        $filesystem->copy($tempFilePath, $persistFilePath);
        $filesystem->remove($tempFilePath);

        return $file;
    }

    public function uploadTemporaryFile(UploadedFile $file)
    {
        $ext = $file->guessExtension();
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->temporaryDirectory, $filename);
        $uploadedFile = new PreUploadedFile($filename, $ext);

        return $uploadedFile;
    }
}