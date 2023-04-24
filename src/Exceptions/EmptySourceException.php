<?php
namespace Javiertapia\ChordsMlPhp\Exceptions;

use Exception;

class EmptySourceException extends Exception {
    protected $message = "El diagrama del acorde está vacío.";
}
