<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 30.03.18
 * Time: 14:34
 */

namespace AppBundle\Service\Interfaces;


use AppBundle\Entity\Photo;
use AppBundle\Entity\PreUploadedFile;
use AppBundle\Form\PhotoType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface IPhotoService
{
    public function create(Photo $file);
}