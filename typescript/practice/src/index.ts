import { createInterface } from "readline";

const rl = createInterface({
    input: process.stdin,
    output: process.stdout,
});

rl.question("数値を入力して下さい:", (line) => {
    const num = Number(line);

    if (0 <= num && num <= 100) {
        console.log("範囲内です");
    } else {
        console.log("範囲外です");
    }
    rl.close();
});
