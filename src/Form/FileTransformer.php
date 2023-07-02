<?php

namespace App\Form;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class FileTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        // Transforme l'objet File en une chaîne (chemin du fichier)
        if ($value instanceof File) {
            return $value->getPathname();
        }

        return null;
    }

    public function reverseTransform($value)
    {
        // Transforme la chaîne en objet File
        if ($value) {
            return new File($value);
        }

        return null;
    }
}
