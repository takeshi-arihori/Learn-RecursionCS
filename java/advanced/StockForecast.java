import java.util.Stack;

/**
 * 【問題296】medium 株式予測
 * 毎日の予想株価リスト stocksが与えられたとき、各日にちの株価がより高くなるまで何日待つかを示したリストを返す、dailyStockPrice
 * という関数を実装してください。
 * 株価がより高くなる日がない場合は 0 を入力してください。
 */
class StockForecastTest {
    // 例: [58,59,56,44,37,83] -> res = [0,0,0,0,0,0] とする
    // 【課題】:前からチェックしていくと、要素の先にどのような要素が存在するか毎回確認しなければいけないため効率の悪い計算になってしまう。
    // 【解決策】: スタックを使ってインデックスの差分を積み上げていき、逆からチェックしていくことで、より効率的に計算できる。
    // i = 5, array[5] = 83 -> push, stack = [5]
    // i = 4, array[4] = 37 -> push, stack = [5, 4]
    // i = 3, array[3] = 44, stackの頂上 37 と比較
    // 44未満が続く間は pop し、最後に array[3] を push, stack = [5, 3]
    // i = 2, array[2] = 56, stackの頂上 44 と比較
    // 56未満が続く間は pop し、最後に array[2] を push, stack = [5, 2]
    // i = 1, array[1] = 59, stackの頂上 56 と比較
    // 59未満が続く間は pop し、最後に array[1] を push, stack = [5, 1]
    // スタックの中に59以上の数字のインデックスが入っていることが保証されるため、59からそのインデックスまでどれだけ差が開いているか計算することができる。
    public static int[] dailyStockPrice(int[] stocks) {
        Stack<Integer> stack = new Stack<>();
        int[] res = new int[stocks.length];
        // 配列の後ろから追跡する
        for (int i = stocks.length - 1; i >= 0; i--) {
            // 積み上げたスタックの頂上と現在の要素を常に比較し、現在の要素が大きければ、その要素より小さくなるまでスタックをpopし続ける。
            while (stack.size() > 0 && stocks[stack.peek()] <= stocks[i])
                stack.pop();
            // スタックの頂上と現在の要素の差をres[i]に記録する。
            if (stack.size() > 0)
                res[i] = stack.peek() - i;
            stack.push(i);
        }

        return res;
    }

    public static void printList(int[] arr) {
        System.out.print("[");
        for (Integer num : arr) {
            System.out.print(num + " ");
        }
        System.out.println("]");
    }

    public static void main(String[] args) {
        printList(dailyStockPrice(new int[] { 58, 59, 71 })); // [1, 1, 0]
        printList(dailyStockPrice(new int[] { 58, 59, 37, 83 })); // [1, 2, 1, 0]
        printList(dailyStockPrice(new int[] { 63, 63, 64 })); // [2, 1, 0]
        printList(dailyStockPrice(new int[] { 85, 83, 67, 83, 81, 38, 88, 85 })); // [6, 5, 1, 3, 2, 1, 0, 0]
        printList(dailyStockPrice(new int[] { 38, 37, 38, 35, 34, 37, 39, 40, 33, 33 })); // [6, 1, 4, 2, 1, 1, 1, 0, 0,
                                                                                          // 0]
    }
}
