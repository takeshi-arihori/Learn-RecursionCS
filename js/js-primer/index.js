const hello = document.getElementById("parent").textContent = "Hello, world!";

// h1タグを生成して表示
const h1 = document.createElement("h1");
h1.textContent = "Hello, world!";

// 以下のコード
let displayVal; // 入力欄の値を格納する変数
console.log(displayVal);


{/* <input type="text"
    onChange={(e) => {
        displayVal = e.target.value;
    }} /> = { displayVal } */}
// は以下のように書き換えられる
<input type="text" id="input" />
const input = document.getElementById("input");
input.addEventListener("input", (e) => {
    displayVal = e.target.value;
    console.log(displayVal);
});

// 以下のコード
// <button onClick={() => {
//     console.log(displayVal);
