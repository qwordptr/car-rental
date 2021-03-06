<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 28.03.18
 * Time: 21:54
 */

namespace AppBundle\Service\Interfaces;


use AppBundle\Entity\PreUploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface IFileUploader
{
    public function uploadTemporaryFile(UploadedFile $file);
    public function persistFile(PreUploadedFile $file, string $directory);
}