console.log("index.js: loaded");

// JSONテスト
const jsonStr = `{"name":"Yamada","age":25,"bloodType":"B"}`;

// JSON文字列をオブジェクトに変換
const obj = JSON.parse(jsonStr);
console.log(obj.name); // Yamada