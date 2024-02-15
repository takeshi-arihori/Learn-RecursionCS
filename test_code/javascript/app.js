'use strict';

// 静的スコープ
const x = 10;

function printX() {
    console.log(x);
}

function run() {
    const x = 20;
    printX();
}

// run();

// クロージャ
// const createCounter = () => {
//     let count = 0;
//     return () => {
//         count++;
//         return count;
//     };
// }
// console.log(createCounter()()); // 参照されなくなったデータはガベージコレクションにより解放される

// const counter = createCounter(); // 関数終了時も参照されるため、データは自動的に解放されることはない
// console.log(counter());
// console.log(counter());
// console.log(counter());
// console.log(counter());
// console.log(counter());

// 新しく作成すると参照先が変わるため、新しいデータが作成される
// const counter2 = createCounter();
// console.log(counter2());
// console.log(counter2());
// console.log(counter2());


const createCounter = () => {
    let count = 0;
    return function increment() {
        // 変数`count`を参照し続けている
        count = count + 1;
        return count;
    };
};
// countUpとnewCountUpはそれぞれ別のincrement関数(内側にあるのも別のcount変数)
const countUp = createCounter();
const newCountUp = createCounter();
// 参照している関数(オブジェクト)は別であるため===は一致しない
// console.log(countUp === newCountUp);// false
// それぞれの状態も別となる
// console.log(countUp()); // => 1
// console.log(newCountUp()); // => 1


function greaterThan(n) {
    return m => m > n;
}

const greaterThan10 = greaterThan(10);
console.log(greaterThan10(20)); // => true
console.log(greaterThan10(5)); // => false



