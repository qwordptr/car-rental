<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 28.03.18
 * Time: 21:54
 */

namespace AppBundle\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface IFileUploader
{
    public function uploadFile(UploadedFile $file);
}