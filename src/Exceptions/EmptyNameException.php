<?php
namespace Javiertapia\ChordsMlPhp\Exceptions;

use Exception;

class EmptyNameException extends Exception {
    protected $message = "El nombre del acorde está vacío.";
}
