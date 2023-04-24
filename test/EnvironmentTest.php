<?php
namespace Javiertapia\ChordsMlPhpTests;

use Javiertapia\ChordsMlPhp\Drawers\TextDrawer;
use Javiertapia\ChordsMlPhp\Environment;
use Javiertapia\ChordsMlPhp\Source;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    const LAM = 'lam:0-0-2-2-1-0';
    const LAM_TEXTDRAW = 'lam'
    . PHP_EOL . '||||o|'
    . PHP_EOL . '||oo||'
    . PHP_EOL . '||||||'
    . PHP_EOL . '      ';

    public function testTextDrawerEnvironment(): void
    {
        $environment = new Environment(new Source(self::LAM));
        $drawing = $environment->render(new TextDrawer());
        $this->assertEquals(self::LAM_TEXTDRAW, $drawing);
    }
}
