<?php
namespace Javiertapia\ChordsMlPhp\Exceptions;

use Exception;

class EmptyDiagramException extends Exception {
    protected $message = "El diagrama del acorde está vacío.";
}
