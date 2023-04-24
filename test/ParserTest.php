<?php
namespace Javiertapia\ChordsMlPhpTests;

use Javiertapia\ChordsMlPhp\Parser;
use Javiertapia\ChordsMlPhp\Source;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    const LAM = 'lam:0-0-2-2-1-0';
    const MIB = 'Mib:3-6-5-3-4-3';
    const DO_D7 = 'do#d7: x-4-5-4-5-x';
    const LA = 'LA: 0-2-3-2';
    const LAM_7 = 'lam7*:5-7-7-5-8-5';

    public function testLam(): void
    {
        $src = new Source(self::LAM);
        $parser = new Parser($src);

        $this->assertCount(6, $parser->strings);
        $this->assertCount(2, $parser->positions);
        $this->assertEquals(1, $parser->minPosition);
        $this->assertEquals(2, $parser->maxPosition);
        $this->assertFalse($parser->hasCapo);
        $this->assertEquals(3, $parser->spaces);
        $this->assertEquals(0, $parser->offsetSpaces);
    }

    public function testMib(): void
    {
        $src = new Source(self::MIB);
        $parser = new Parser($src);

        $this->assertCount(6, $parser->strings);
        $this->assertCount(4, $parser->positions, 'Mib ocupa 4 posiciones');
        $this->assertEquals(3, $parser->minPosition, 'La posición mínima es 3');
        $this->assertEquals(6, $parser->maxPosition, 'La posición máxima es 6');
        $this->assertTrue($parser->hasCapo, 'Mib usa capo');
        $this->assertEquals(4, $parser->spaces, 'Mib ocupa 4 espacios');
        $this->assertEquals(2, $parser->offsetSpaces, 'Mib se dibuja ignorando los primeros 2 trastes');
    }

    public function testDosd7(): void
    {
        $src = new Source(self::DO_D7);
        $parser = new Parser($src);

        $this->assertCount(6, $parser->strings);
        $this->assertCount(2, $parser->positions, 'do#d7 ocupa 2 posiciones');
        $this->assertEquals(4, $parser->minPosition, 'La posición mínima es 4');
        $this->assertEquals(5, $parser->maxPosition, 'La posición máxima es 5');
        $this->assertFalse($parser->hasCapo, 'do#d7 no usa capo');
        $this->assertEquals(3, $parser->spaces, 'do#d7 se dibuja ocupando 3 espacios');
        $this->assertEquals(3, $parser->offsetSpaces, 'do#d7 se dibuja ignorando los primeros 3 trastes');
    }

    public function testLaCuatro(): void
    {
        $src = new Source(self::LA);
        $parser = new Parser($src);

        $this->assertCount(4, $parser->strings);
        $this->assertCount(2, $parser->positions, 'LA (cuatro) ocupa 1 posición');
        $this->assertEquals(2, $parser->minPosition, 'La posición mínima es 2');
        $this->assertEquals(3, $parser->maxPosition, 'La posición máxima es 3');
        $this->assertFalse($parser->hasCapo, 'LA (cuatro) no usa capo');
        $this->assertEquals(3, $parser->spaces, 'LA (cuatro) se dibuja ocupando 3 espacios');
        $this->assertEquals(0, $parser->offsetSpaces, 'LA (cuatro) se dibuja ignorando los primeros 0 trastes');
    }

    public function testLam7(): void
    {
        $src = new Source(self::LAM_7);
        $parser = new Parser($src);

        $this->assertCount(6, $parser->strings);
        $this->assertEquals(4, $parser->usedPositions, 'Lam7* ocupa 4 posiciones');
        $this->assertEquals(5, $parser->minPosition, 'La posición mínima es 5');
        $this->assertEquals(8, $parser->maxPosition, 'La posición máxima es 8');
        $this->assertTrue($parser->hasCapo, 'Lam7* usa capo');
        $this->assertEquals(4, $parser->spaces, 'Lam7* se dibuja ocupando 4 espacios');
        $this->assertEquals(4, $parser->offsetSpaces, 'Lam7* se dibuja ignorando los primeros 4 trastes');
    }
}
