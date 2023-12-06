<?php
include(__DIR__."/_loader.php");

$parser = new Parser("datasets/day5.txt");

echo "Answer #1: ".$parser->nb.PHP_EOL;
echo "Answer #2: ".$parser->nb2.PHP_EOL;


class Parser {
    public $nb = 0;
    public $nb2 = 0;

    public function __construct($file) {
        $input = InputHelper::loadFile($file);

        $doubleLetters = [];
        for ($c=97; $c<=122; $c++) $doubleLetters[] = chr($c).chr($c);

        foreach ($input as $line) {
            if (preg_match("/(ab|cd|pq|xy)/i", $line)) continue;
            if (! preg_match("/([aeiou])(.*?)([aeiou])(.*?)([aeiou])/i", $line)) continue;
            if (! preg_match("/(".implode('|', $doubleLetters).")/i", $line)) continue;
            $this->nb++;
        }

        foreach ($input as $line) {
            $pair = $sandwich = false;

            $len = strlen($line);
            for ($i=0; $i<$len; $i++) {
                if (substr($line, $i, 1) == substr($line, $i+2, 1)) $sandwich = true;
                $duet = substr($line, $i, 2);
                if ($i+2 < $len && strpos($line, $duet, $i+2) !== false) $pair = true;
            }

            if (! $pair || !$sandwich) continue;
            $this->nb2++;
        }
    }
}
