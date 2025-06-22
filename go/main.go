package main

import (
	"fmt"
	"unsafe"
)

type Feet float64

func main() {
	var str string = "Hello, World!"
	var i int
	var num int64 = 2147483648
	var x uintptr = uintptr(unsafe.Pointer(&i))
	var xfloat Feet = 5.5
	fmt.Println("Address of i:", x)
	fmt.Println("Value of num:", num)
	fmt.Println("Size of int:", unsafe.Sizeof(i))
	fmt.Println("Size of string:", unsafe.Sizeof(str))
	fmt.Println("Size of Feet:", unsafe.Sizeof(xfloat))
}
