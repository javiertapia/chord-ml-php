<?php
namespace Javiertapia\ChordsMlPhp\Exceptions;

use Exception;

class NotValidDiagramException extends Exception {
    protected $message = "El diagrama del acorde no es válido.";
}
