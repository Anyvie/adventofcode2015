<?php
include(__DIR__."/_loader.php");

$parser = new Parser("datasets/day4.txt");

echo "Answer #1: ".$parser->nb.PHP_EOL;
echo "Answer #2: ".$parser->nb2.PHP_EOL;


class Parser {
    public $nb = 0;
    public $nb2 = 0;

    public function __construct($file) {
        $input = InputHelper::loadFile($file);

        foreach ($input as $line) {
            // if no results, try adjusting the max 
            for ($i=0; $i<200000000; $i++) {
                $md5 = md5($line.$i);
                if (substr($md5, 0, 5) === "00000" && !$this->nb) {
                    $this->nb = $i;
                }
                if (substr($md5, 0, 6) === "000000") {
                    $this->nb2 = $i;
                    break;
                }
            }
        }
    }
}
