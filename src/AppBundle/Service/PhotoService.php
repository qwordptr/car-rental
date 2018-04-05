<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 30.03.18
 * Time: 14:35
 */

namespace AppBundle\Service;


use AppBundle\Entity\Photo;
use AppBundle\Entity\PreUploadedFile;
use AppBundle\Form\PhotoType;
use AppBundle\Service\Interfaces\IFileUploader;
use AppBundle\Service\Interfaces\IPhotoService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoService implements IPhotoService
{
    private $fileuploader;
    private $photoDirectory;
    private $publicPhotoDirectory;

    /**
     * PhotoService constructor.
     * @param string $photoDirectory
     * @param string $publicPhotoDirectory
     * @param IFileUploader $fileUploader
     */
    public function __construct(string $photoDirectory, string $publicPhotoDirectory, IFileUploader $fileUploader)
    {
        $this->fileuploader = $fileUploader;
        $this->photoDirectory = $photoDirectory;
        $this->publicPhotoDirectory = $publicPhotoDirectory;
    }

    /**
     * @param Photo $photo
     * @ Photo
     * @return Photo
     */
    public function create(Photo $photo)
    {
        $uploader = $this->fileuploader;
        $uploader->persistFile(new PreUploadedFile(
            $photo->getFilename(),
            $photo->getExtension()
        ), $this->photoDirectory);

        $photo->setPath(sprintf("%s/%s", $this->publicPhotoDirectory, $photo->getFilename()));
        return $photo;
    }
}