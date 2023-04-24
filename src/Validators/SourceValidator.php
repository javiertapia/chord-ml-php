<?php
namespace Javiertapia\ChordsMlPhp\Validators;

use Javiertapia\ChordsMlPhp\Exceptions\EmptyDiagramException;
use Javiertapia\ChordsMlPhp\Exceptions\EmptyNameException;
use Javiertapia\ChordsMlPhp\Exceptions\EmptySourceException;

final class SourceValidator {

    public function validateSource(string $source): void
    {
        if (empty($source)) {
            throw new EmptySourceException();
        }
    }

    public function validateName(string $name): void
    {
        if (empty($name)) {
            throw new EmptyNameException();
        }
    }

    public function validateDiagram(string $diagram): void
    {
        if (empty($diagram)) {
            throw new EmptyDiagramException();
        }
    }
}
