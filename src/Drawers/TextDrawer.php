<?php
namespace Javiertapia\ChordsMlPhp\Drawers;

use Javiertapia\ChordsMlPhp\Drawer;
use Javiertapia\ChordsMlPhp\Lexer;
use Javiertapia\ChordsMlPhp\Parser;

/**
 * TextDrawer class
 *
 * @author Javier Tapia <javier.tapia.d@gmail.com>
 * @description Given the info provided vy the parser, draw the chord diagram
 * for a text output, using the symbols defined as class constants.
 */
final class TextDrawer extends Drawer
{
    // Symbols used to graph the diagram parts
    const CAPO_SYMBOL = '=';
    const FINGER_SYMBOL = 'o';
    const X_SYMBOL = 'x';
    const FRET_SYMBOL = '+';
    const STRING_SYMBOL = '|';
    const SPACE_SYMBOL = ' ';

    public function draw(Parser $parser): string
    {
        $maxPositionInDiagram = max($parser->maxPosition, Lexer::MIN_DIAGRAM_SPACES);
        $diagram = $this->buildEmptyDiagram($maxPositionInDiagram, count($parser->strings));
        $diagram = $this->addFingersToDiagram($diagram, $parser->strings);
        if ($parser->hasCapo) {
            $diagram = $this->addCapoToDiagram($diagram, $parser->capoPosition);
        }
        if ($parser->offsetSpaces > 0) {
            $diagram = $this->addSpaceNumberToDiagram($diagram, $parser->minPosition);
        }
        $diagram = $this->removeEmptySpacesFromDiagram($diagram, count($parser->strings));
        $diagram = $this->addEmptyXSpace($diagram, $parser->strings);

        $drawing = $parser->getChordName();
        foreach ($diagram as $space) {
            $drawing .= PHP_EOL . implode($space);
        }
        return $drawing;
    }

    /**
     * Builds an empty diagram (num strings x num spaces).
     * Adds an empty row to end
     * @param int $numSpaces Total num of spaces (frets) to populate (matrix rows)
     * @param int $numStrings Total num of strings (matrix columns)
     * @return array Empty diagram
     */
    private function buildEmptyDiagram(int $numSpaces, int $numStrings): array
    {
        $diagram = [];
        for ($i = 0; $i < $numSpaces; $i++) {
            $diagram[] = array_fill(0, $numStrings, self::STRING_SYMBOL);
        }
        return $diagram;
    }

    /**
     * Locate the finger positions into the diagram and put the symbol on it.
     * @param array $diagram Initial diagram to put finger symbols
     * @param array $strings Initial array of positions
     * @return array Updated diagram
     */
    private function addFingersToDiagram(array $diagram, array $strings): array
    {
        foreach ($strings as $string => $position) {
            if (is_numeric($position) && $position > 0) {
                $diagram[$position - 1][$string] = self::FINGER_SYMBOL;
            }
        }
        return $diagram;
    }

    /**
     * Replace the space (fret) for the capo position with the capo symbol.
     * @param array $diagram Initial diagram to put finger symbols
     * @param int $position Capo position
     * @return array Updated diagram
     */
    private function addCapoToDiagram(array $diagram, int $position): array
    {
        if (!empty($diagram[$position - 1])) {
            foreach (array_keys($diagram[$position - 1]) as $string) {
                $diagram[$position - 1][$string] = self::CAPO_SYMBOL;
            }
        }
        return $diagram;
    }

    /**
     * Remove empty spaces '||||||' from diagram if this has more than minimal
     * required spaces.
     * @param array $diagram Initial diagram to remove spaces
     * @param int $numStrings Number of strings used
     * @return array Updated diagram
     */
    private function removeEmptySpacesFromDiagram(array $diagram, int $numStrings): array
    {
        foreach ($diagram as $space) {
            $isACapo = implode('', array_slice($space, 0, $numStrings)) === str_repeat(self::CAPO_SYMBOL, $numStrings);
            if ($isACapo) {
                return $diagram;
            }
            $hasMinSpaces = count($diagram) > Lexer::MIN_DIAGRAM_SPACES;
            $isASpace = implode('', $space) === str_repeat(self::STRING_SYMBOL, $numStrings);
            if ($hasMinSpaces && $isASpace) {
                array_shift($diagram);
            }
        }
        return $diagram;
    }

    /**
     * Add number position to diagram
     * @param array $diagram Initial diagram to add number position
     * @param int $minPosition Position to add
     * @return array Updated diagram
     */
    private function addSpaceNumberToDiagram(array $diagram, int $minPosition): array
    {
        $diagram[$minPosition - 1][] = ' ' . $minPosition;
        return $diagram;
    }

    /**
     * Adds an empty row with "X" following the initial positions.
     * @param array $diagram Initial diagram to add empty row
     * @param array $strings Initial array of positions
     * @return array Updated diagram
     */
    private function addEmptyXSpace(array $diagram, array $strings): array
    {
        $space = array_fill(0, count($strings), self::SPACE_SYMBOL);
        foreach ($strings as $pos => $string) {
            if (!is_numeric($string) && strtolower($string) === self::X_SYMBOL) {
                $space[$pos] = self::X_SYMBOL;
            }
        }
        $diagram[] = $space;
        return $diagram;
    }
}
