<?php

class Trier {
    const AttemptCeiling = 5;

    private $attempts, $tries;

    public function __construct($n) {
        $this->tries = $n;
    }

    public function Attempt() {
        return $this->attempts++ < $this->tries;
    }

    // (1<<n) - (n/2) + (rand float * n)
    // n  ->  seconds
    // 0  ->  1
    // 1  ->  1~3
    // 2  ->  2~6
    // 3  ->  4~12
    // 4  ->  8~24
    // 5  ->  16~48
    public function Wait() {
        $n = min($this->attempts, self::AttemptCeiling);
        usleep(1000000 * (((1<<$n) - ($n*0.5)) + ((mt_rand()/mt_getrandmax())*$n)));
    }
}

$err = null;

for ($t = new Trier(5); $t->Attempt(); $t->Wait()) {

    echo "trying...\n";

    // try so hard
    $err = "fail";
    if ($err) {
        continue;
    }

}

if ($err) {
    echo "all tries failed: ", $err, "\n";
}
