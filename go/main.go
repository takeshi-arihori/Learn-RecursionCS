package main

import "fmt"

// var name string = "John Smith"
// name := "John Smith"

var name string = "John Smith"
var age int = 30
var height float64 = 5.9
var isMarried bool = false
var colors [3]string = [3]string{"red", "green", "blue"}
var numbers []int = []int{1, 2, 3, 4, 5}
var person map[string]string = map[string]string{"name": "John", "age": "30"}

type Person struct {
	Name   string
	Age    int
	Height float64
	IsMarried bool
	Colors  [3]string
	Numbers []int
}

var john Person = Person{Name: "John Smith", Age: 30, Height: 5.9, IsMarried: false, Colors: [3]string{"red", "green", "blue"}, Numbers: []int{1, 2, 3, 4, 5}}

var (
	userID   int    = 123
	username  string = "johnsmith"
	email     string = "johnsmith@example.com"
	firstName string = "John"
	lastName  string = "Smith"
	isActive  bool   = true
	balance  float64 = 1000.00
)

func main() {
	fmt.Println("User Information:")
	fmt.Println("User ID:", userID)
	fmt.Println("Username:", username)
	fmt.Println("Email:", email)
	fmt.Println("First Name:", firstName)
	fmt.Println("Last Name:", lastName)
	fmt.Println("Active:", isActive)
	fmt.Println("Balance:", balance)
	fmt.Println("Person struct:", john)

	name := "Alice"
	ptr := &name
	fmt.Println("Name:", name)
	fmt.Println("Pointer to name:", ptr)
}
