package tri

import (
	"fmt"
	"testing"
	"time"
)

func TestTri(t *testing.T) {

	for t := NewTrier(3); t.Try(); t.Wait() {
		fmt.Println("try", time.Now())
	}

}
