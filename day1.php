<?php
include(__DIR__."/_loader.php");

$parser = new Parser("datasets/day1.txt");

echo "Answer #1: ".$parser->nb.PHP_EOL;
echo "Answer #2: ".$parser->basement.PHP_EOL;


class Parser {
    public $nb = 0;
    public $basement = 0;

    public function __construct($file) {
        $input = InputHelper::loadFile($file);

        foreach ($input as $line) {
            for ($i=0; $i<strlen($line); $i++) {
                $c = substr($line, $i, 1);
                if ($c == '(') $this->nb++;
                elseif ($c == ')') $this->nb--;

                if ($this->nb == -1 && !$this->basement) $this->basement = $i+1;
            }
        }
    }
}
