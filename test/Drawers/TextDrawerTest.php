<?php
namespace Javiertapia\ChordsMlPhpTests\Drawers;

use Javiertapia\ChordsMlPhp\Drawers\TextDrawer;
use Javiertapia\ChordsMlPhp\Parser;
use Javiertapia\ChordsMlPhp\Source;
use PHPUnit\Framework\TestCase;

class TextDrawerTest extends TestCase
{
    const LAM = 'lam:0-0-2-2-1-0';
    const LAM_TEXTDRAW = 'lam'
        . PHP_EOL . '||||o|'
        . PHP_EOL . '||oo||'
        . PHP_EOL . '||||||'
        . PHP_EOL . '      ';

    const MIB = 'Mib:3-6-5-3-4-3';
    const MIB_TEXTDRAW = 'Mib'
        . PHP_EOL . '====== 3'
        . PHP_EOL . '||||o|'
        . PHP_EOL . '||o|||'
        . PHP_EOL . '|o||||'
        . PHP_EOL . '      ';

    const DO_D7 = 'do#d7:x-4-5-4-5-x';
    const DO_D7_TEXTDRAW = 'do#d7'
        . PHP_EOL . '||||||'
        . PHP_EOL . '|o|o|| 4'
        . PHP_EOL . '||o|o|'
        . PHP_EOL . 'x    x';

    const LA = 'LA:0-2-3-2';
    const LA_TEXTDRAW = 'LA'
        . PHP_EOL . '||||'
        . PHP_EOL . '|o|o'
        . PHP_EOL . '||o|'
        . PHP_EOL . '    ';

    const LAM7 = 'lam7*: 5-7-7-5-8-5';
    const LAM7_TEXTDRAW = 'lam7*'
        . PHP_EOL . '====== 5'
        . PHP_EOL . '||||||'
        . PHP_EOL . '|oo|||'
        . PHP_EOL . '||||o|'
        . PHP_EOL . '      ';

    const DO = 'DO:   0-3-2-0-1-0';
    const DO_TEXTDRAW = 'DO'
    . PHP_EOL . '||||o|'
    . PHP_EOL . '||o|||'
    . PHP_EOL . '|o||||'
    . PHP_EOL . '      ';

    const LAD7 = 'lad7: x-0-5-5-4-3';
    const LAD7_TEXTDRAW = 'lad7'
    . PHP_EOL . '|||||o 3'
    . PHP_EOL . '||||o|'
    . PHP_EOL . '||oo||'
    . PHP_EOL . 'x     ';

    const FA_7 = 'FA#7: 2-4-2-3-5-2';
    const FA_7_TEXTDRAW = 'FA#7'
    . PHP_EOL . '====== 2'
    . PHP_EOL . '|||o||'
    . PHP_EOL . '|o||||'
    . PHP_EOL . '||||o|'
    . PHP_EOL . '      ';

    public function testLam(): void
    {
        $src = new Source(self::LAM);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::LAM_TEXTDRAW, $drawer->draw($parser));
    }

    public function testMib(): void
    {
        $src = new Source(self::MIB);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::MIB_TEXTDRAW, $drawer->draw($parser));
    }

    public function testDod7(): void
    {
        $src = new Source(self::DO_D7);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::DO_D7_TEXTDRAW, $drawer->draw($parser));
    }

    public function testLaCuatro(): void
    {
        $src = new Source(self::LA);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::LA_TEXTDRAW, $drawer->draw($parser));
    }

    public function testLam3aPos(): void
    {
        $src = new Source(self::LAM7);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::LAM7_TEXTDRAW, $drawer->draw($parser));
    }

    public function testDo(): void
    {
        $src = new Source(self::DO);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::DO_TEXTDRAW, $drawer->draw($parser));
    }

    public function testLad7(): void
    {
        $src = new Source(self::LAD7);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::LAD7_TEXTDRAW, $drawer->draw($parser));
    }

    public function testFas(): void
    {
        $src = new Source(self::FA_7);
        $parser = new Parser($src);
        $drawer = new TextDrawer($parser);
        $this->assertEquals(self::FA_7_TEXTDRAW, $drawer->draw($parser));
    }
}
