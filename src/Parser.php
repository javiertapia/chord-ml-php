<?php
namespace Javiertapia\ChordsMlPhp;

/**
 * Parser class
 *
 * @author Javier Tapia <javier.tapia.d@gmail.com>
 * @description Extract information for the source diagram. This info must be
 * used later to draw the chord diagram.
 */
final readonly class Parser
{
    /** @var array|string[] $strings Strings diagram */
    public array $strings;
    /** @var bool $hasCapo Uses capo or not */
    public bool $hasCapo;
    /** @var array|number[] $positions Unique diagram positions, without 0 nor X */
    public array $positions;
    /** @var int $usedPositions Number of $positions */
    public int $usedPositions;
    /** @var int $minPosition Lower position in diagram */
    public int $minPosition;
    /** @var int $maxPosition Higher position in diagram */
    public int $maxPosition;
    /** @var int Capo number of space/fret */
    public int $capoPosition;
    /** @var int $spaces How many spaces/frets must be drawed */
    public int $spaces;
    /** @var int $offsetSpaces How many fret/spaces are not shown in drawing */
    public int $offsetSpaces;

    public function __construct(
        private Source $source
    ) {
        // Builds an array of string positions using the string separator
        $this->strings = explode(Lexer::SEP_DIAGRAM_STRINGS, $this->source->diagram);
        // Removes empty, duplicated and "x" positions
        $this->positions = $this->findUniquePositions($this->strings);
        // Must be drawn a capo?
        $this->hasCapo = $this->findUseCapo($this->strings);
        // Get min/max positions in diagram
        $this->minPosition = (int)$this->positions[0];
        $this->maxPosition = (int)$this->positions[count($this->positions) - 1];
        $this->usedPositions = $this->maxPosition - $this->minPosition + 1;
        // Get capo position in diagram
        if ($this->hasCapo) {
            $this->capoPosition = $this->minPosition;
        }
        // How many spaces/frets must be drawn
        $usedSpaces = $this->maxPosition - $this->minPosition + 1;
        $this->spaces = max($usedSpaces, Lexer::MIN_DIAGRAM_SPACES);
        // How many fret/spaces are not shown in drawing
        $this->offsetSpaces = $this->minPosition > 1 && $this->maxPosition > $this->spaces
            ? $this->minPosition - 1 : 0;
    }

    /**
     * Access the original source to get the chord name
     * @return string
     */
    public function getChordName(): string
    {
        return $this->source->name;
    }

    /**
     * Find used positions (no 0 neither X) from the diagram
     * @param array $strings Original diagram of strings. Ex: x-4-5-4-5-x
     * @return number[] Used positions array. Ex: [4,5,4,5]
     */
    private function findPositions(array $strings): array
    {
        $positions = [];
        foreach($strings as $string) {
            if (!empty($string) && $string !== 'X') {
                $positions[] = (int)$string;
            }
        }
        return $positions;
    }

    /**
     * Find unique used positions from the diagram
     * @param array $strings Original diagram of strings. Ex: x-4-5-4-5-x
     * @return number[] Unique used positions array, sorted. Ex: [4,5]
     */
    private function findUniquePositions(array $strings): array
    {
        $positions = array_unique($this->findPositions($strings));
        sort($positions);
        return $positions;
    }

    /**
     * Determines if this diagram uses a capo:
     * Used positions must be higher than 4
     * @param array $strings Original diagram of strings. Ex: x-4-5-4-5-x
     * @return bool
     */
    private function findUseCapo(array $strings): bool
    {
        $positions = $this->findPositions($strings);
        return count($positions) > 4;
    }
}
