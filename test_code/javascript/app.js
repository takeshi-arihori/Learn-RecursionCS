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
// const array = [1, 2];
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


// プロパティの存在確認
// const obj = {
//     key: 'value'
// };

// key プロパティが存在するかを確認する
// console.log('key' in obj); // => true
// console.log(Object.hasOwn(obj, 'key')); // => true


// オブジェクトの複製
// const shallowClone = (obj) => {
//     return Object.assign({}, obj);
// };

// 通常のシャローコピー
// const obj2 = { a: "a" };
// const cloneObj = shallowClone(obj2);

// console.log(obj2 === cloneObj); // => false

// シャローコピーはネストされたオブジェクトを複製できません。
// const obj3 = {
//     level: 1,
//     nest: {
//         level: 2
//     },
// };
// const cloneObj2 = shallowClone(obj3);
// console.log(obj3 === cloneObj2); // => false
// nestプロパティのオブジェクトは同じオブジェクトを参照している
// console.log(obj3.nest === cloneObj2.nest); // => true




// 再起的に複製してコピーする(deep copy)
// const shallowClone = obj => Object.assign({}, obj);

// // 引数の`obj`を浅く複製したオブジェクトを返す
// function deepClone(obj) {
//     const newObj = shallowClone(obj);
//     // プロパティがオブジェクト型であるなら、再起的に複製する
//     Object.keys(newObj)
//         .filter(k => typeof newObj[k] === 'object')
//         .forEach(k => newObj[k] = deepClone(newObj[k]));
//     return newObj;
// }
// const obj = {
//     level: 1,
//     nest: {
//         level: 2
//     }
// };

// const cloneObj = deepClone(obj);
// // `nest`オブジェクトも再起的に複製されている
// console.log(obj.nest === cloneObj.nest); // => false


// const obj = {};
// `obj`というオブジェクト自体に`toString`メソッドが定義されているわけではない
// console.log(Object.hasOwn(obj, "toString")); // => false
// `in`演算子は指定されたプロパティ名が見つかるまで親をたどるため、`Object.prototype`まで見にいく
// console.log("toString" in obj); // => true

// const Array = function () { };
// `Array.prototype`は`Object.prototype`を継承している
// Array.prototype = Object.create(Object.prototype);
// `Array`のインスタンスは、`Array.prototype`を継承している
// const array = Object.create(Array.prototype);

// console.log(array.hasOwnProperty === Object.prototype.hasOwnProperty); // => false



// クロージャ
function createCounter() {
    let count = 0;
    function increment() {
        count = count + 1;
        return count;
    }
    return increment;
}

// const myCounter = createCounter();
// console.log(myCounter()); // => 1
// console.log(myCounter()); // => 2

// const newCounter = createCounter();
// console.log(newCounter()); // => 1
// console.log(newCounter()); // => 2

// console.log(newCounter());
// console.log(myCounter());