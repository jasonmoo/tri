package tri

import (
	"math"
	"math/rand"
	"time"
)

type Trier struct {
	attempts float64
	tries    float64
}

var AttemptCeiling float64 = 5

func init() {
	rand.Seed(time.Now().UnixNano())
}

func NewTrier(tries float64) *Trier {
	return &Trier{tries: tries}
}

func (t *Trier) Try() bool {
	t.attempts++
	return t.attempts <= t.tries
}

func (t *Trier) Wait() {
	n := math.Min(t.attempts, AttemptCeiling)
	n = float64(int(1)<<uint(n)) - (n * 0.5) + (rand.Float64() * n)
	time.Sleep(time.Second * time.Duration(n))
}
