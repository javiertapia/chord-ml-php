<?php
namespace Javiertapia\ChordsMlPhp;

abstract class Drawer
{
    public abstract function draw(Parser $parser): string;
}
