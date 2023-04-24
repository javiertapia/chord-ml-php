<?php
namespace Javiertapia\ChordsMlPhp;

use Javiertapia\ChordsMlPhp\Validators\SourceValidator;
use Throwable;

/**
 * Source class
 *
 * @author Javier Tapia <javier.tapia.d@gmail.com>
 * @description Store information about a ChordsMl template.
 */
final class Source
{
    public readonly string $name;
    public readonly string $diagram;

    public function __construct(
        private string $source
    ) {
        $this->source = trim($this->source);
        try {
            $validator = new SourceValidator();
            $validator->validateSource($this->source);
            [$name, $diagram] = explode(Lexer::SEP_NAME_DIAGRAM, $this->source);
            $validator->validateName($name);
            $validator->validateDiagram(trim($diagram));
            $this->name = $name;
            $this->diagram = strtoupper(trim($diagram));
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function getSource(): string
    {
        return trim($this->source);
    }

    public function isValid(): bool
    {
        return $this->name && $this->diagram;
    }
}
