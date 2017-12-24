<?php

namespace MasterPoBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    
    public function upload(UploadedFile $file, $dir = null)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move($this->targetDir . $dir, $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}