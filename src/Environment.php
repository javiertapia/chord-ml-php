<?php
namespace Javiertapia\ChordsMlPhp;

use Javiertapia\ChordsMlPhp\Drawers\TextDrawer;

/**
 * Environment class
 *
 * @author Javier Tapia <javier.tapia.d@gmail.com>
 * @description This is the entry point for this module.
 */
final readonly class Environment
{
    /**
     * @param \Javiertapia\ChordsMlPhp\Source $source Contains the source ChordsMl definition
     */
    public function __construct(
        private Source $source
    ) {
    }

    /**
     * Given a drawer, uses the parser info to draw the chords diagram.
     * @param \Javiertapia\ChordsMlPhp\Drawer $drawer
     * @return string
     */
    public function render(
        Drawer $drawer = new TextDrawer()
    ): string {
        $parser = new Parser($this->source);
        return $drawer->draw($parser);
    }
}
