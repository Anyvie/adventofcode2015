<?php
include(__DIR__."/_loader.php");

$parser = new Parser("datasets/day2.txt");

echo "Answer #1: ".$parser->nb.PHP_EOL;
echo "Answer #2: ".$parser->ribbon.PHP_EOL;


class Parser {
    public $nb = 0;
    public $ribbon = 0;

    public function __construct($file) {
        $input = InputHelper::loadFile($file);

        foreach ($input as $line) {
            list($l, $w, $h) = explode('x', $line);

            // part 1
            $dims = [
                2*$l*$w,
                2*$l*$h,
                2*$h*$w,
            ];

            $this->nb += array_sum($dims) + min($dims)/2;

            // part2
            $dims = [$l, $h, $w];
            sort($dims);

            $this->ribbon += 2*$dims[0] + 2*$dims[1] + array_product($dims);
        }
    }
}
