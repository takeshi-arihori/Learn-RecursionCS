'use strict';


// ビット排他的論理和
// console.log(15 ^ 9); // 6
// console.log(0b1111 ^ 0b1001); // 0b0110

// ビット論理積
// console.log((-9) >> 2); // => -3

// NaN
// console.log(Number({})); // => NaN

// Rest parameters


// 分割代入
// 分割代入はオブジェクトや配列からプロパティを取り出し、変数として定義し直す構文です。
const user = {
    id: 42,
};
// オブジェクトの分割代入
const { id } = user;
// console.log(id); // => 42

// 関数の引数で分割代入
function printUserId({ id }) {
    console.log(id);
}
// printUserId(user); // => 42

// 配列の分割代入
function print([first, second]) {
    console.log(first); // => 1
    console.log(second); // => 2
}
const array = [1, 2];
// print(array);


// 関数式
// 名前を持たない関数を無名関数（または匿名関数）と呼びます。
// 関数の名前は関数の外からは呼ぶことができません。 一方、関数の中からは呼ぶことができるため、再帰的に関数を呼び出す際などに利用されます。

const factorial = function innerFact(n) {
    if (n === 0) {
        return 1;
    }
    return n * innerFact(n - 1);
}
// console.log(factorial); // => 6

const fibonacch = function innerFib(n) {
    if (n === 0) {
        return 0;
    } else if (n === 1) {
        return 1;
    }
    return innerFib(n - 1) + innerFib(n - 2);
}

// console.log(fibonacch(10)); // => 55

