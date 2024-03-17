"use strict";

class ArrayLike {

    constructor(items) {
        this._items = items;
    }

    get items() {
        return this._items;
    }

    get length() {
        return this._items.length;
    }

    set length(newLength) {
        const currentItemLength = this._items.length;
        // 現在要素数よりも小さな`newLength`が指定された場合、指定した要素数となるように末尾に空要素を追加する
        if (newLength < currentItemLength) {
            this._items = this._items.slice(0, newLength);
        } else if (newLength > currentItemLength) {
            // 現在要素数よりも大きな`newLength`が指定された場合、指定した要素数となるように末尾に空要素を追加する
            this._items = this._items.concat(new Array(newLength - currentItemLength));
        }
    }
}

// const arrayLike = new ArrayLike([1, 2, 3, 4, 5]);
// console.log(arrayLike.items.join(", ")); // => "1, 2, 3, 4, 5"
// // 要素数を減らすとインデックス以降の要素が削除される
// arrayLike.length = 2;
// console.log(arrayLike.items.join(", ")); // => "1, 2"

// arrayLike.length = 5;
// console.log(arrayLike.items.join(", ")); // => "1, 2, , , "


class Counter {
    count = 0;
    // クラスフィールドでの`this`はクラスのインスタンスとなる
    // upメソッドは、クラスのインスタンスに定義される
    up = () => {
        this.increment();
    };
    increment() {
        this.count++;
    }
}

const counter = new Counter();
// Arrow Functionなので、thisはクラスのインスタンスに固定されている
const up = counter.up;
// up();
// up();
// up();
// console.log(counter.count); // => 1
// 通常のメソッド定義では、thisは`undefined`となってしまうため例外が発生する
// const increment = counter.increment;
// increment(); // => TypeError: Cannot read property 'count' of undefined

