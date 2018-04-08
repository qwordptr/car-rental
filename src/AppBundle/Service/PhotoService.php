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
use AppBundle\Repository\PhotoRepository;
use AppBundle\Service\Interfaces\IFileUploader;
use AppBundle\Service\Interfaces\IPhotoService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoService implements IPhotoService
{
    private $fileuploader;
    private $photoDirectory;
    private $publicPhotoDirectory;
    private $photoRepository;
    /**
     * PhotoService constructor.
     * @param string $photoDirectory
     * @param string $publicPhotoDirectory
     * @param IFileUploader $fileUploader
     */
    public function __construct(
        string $photoDirectory,
        string $publicPhotoDirectory,
        PhotoRepository $photoRepository,
        IFileUploader $fileUploader
    )

    {
        $this->fileuploader = $fileUploader;
        $this->photoDirectory = $photoDirectory;
        $this->publicPhotoDirectory = $publicPhotoDirectory;
        $this->photoRepository = $photoRepository;
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

    public function remove(Photo $photo)
    {
        $photoRepository = $this->photoRepository;
        $photoPath = sprintf("/%s/%s", $this->photoDirectory, $photo->getFilename());
        $filesystem = new Filesystem();
        $filesystem->remove($photoPath);
        $photoRepository->remove($photo);
    }
}