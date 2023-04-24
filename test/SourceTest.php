<?php
namespace Javiertapia\ChordsMlPhpTests;

use Javiertapia\ChordsMlPhp\Exceptions\EmptyDiagramException;
use Javiertapia\ChordsMlPhp\Exceptions\EmptyNameException;
use Javiertapia\ChordsMlPhp\Exceptions\EmptySourceException;
use Javiertapia\ChordsMlPhp\Lexer;
use Javiertapia\ChordsMlPhp\Source;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    const NAME = 'lam';
    const DIAGRAM = '0-0-2-2-1-0';

    public function testSourceExceptions(): void
    {
        $this->expectException(EmptySourceException::class);
        new Source('');

        $this->expectException(EmptyNameException::class);
        new Source(Lexer::SEP_NAME_DIAGRAM . self::DIAGRAM);

        $this->expectException(EmptyDiagramException::class);
        new Source(self::NAME);
    }

    public function testSourceValidity(): void
    {
        $lam = new Source(self::NAME . Lexer::SEP_NAME_DIAGRAM . self::DIAGRAM);
        $this->assertTrue($lam->isValid());
    }
}
