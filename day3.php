<?php
include(__DIR__."/_loader.php");

$parser = new Parser("datasets/day3.txt");

echo "Answer #1: ".count($parser->houses).PHP_EOL;
echo "Answer #2: ".count($parser->houses2).PHP_EOL;


class Parser {
    public $houses = [ "0;0" => 1 ]; // part1
    public $houses2 = [ "0;0" => 1 ]; // part2

    public function __construct($file) {
        $input = InputHelper::loadFile($file);

        $x = $y = 0;

        // part2
        $xx = [0 => 0, 1 => 0];
        $yy = [0 => 0, 1 => 0];

        $nbLines=0;
        foreach ($input as $line) {
            for ($i=0; $i<strlen($line); $i++) {
                $c = substr($line, $i, 1);
                if ($c == '<') $x--;
                elseif ($c == '>') $x++;
                elseif ($c == '^') $y++;
                elseif ($c == 'v') $y--;

                $house = $x.';'.$y;
                if (! isset($this->houses[$house])) $this->houses[$house] = 0;
                $this->houses[$house]++;


                // part2
                $modulo = ($nbLines%2);

                if ($c == '<') $xx[$modulo]--;
                elseif ($c == '>') $xx[$modulo]++;
                elseif ($c == '^') $yy[$modulo]++;
                elseif ($c == 'v') $yy[$modulo]--;

                $house = $xx[$modulo].';'.$yy[$modulo];
                if (! isset($this->houses2[$house])) $this->houses2[$house] = 0;
                $this->houses2[$house]++;

                $nbLines++;
            }
        }
    }
}
