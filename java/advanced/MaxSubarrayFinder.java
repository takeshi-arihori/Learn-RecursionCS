import java.util.Deque;
import java.util.ArrayList;
import java.util.ArrayDeque;

/**
 * 与えられた配列と整数 k に対して、サイズ k の連続する部分配列の中で最大の値を見つけるメソッドを実装する方法
 * 
 * 例: arr = [1, 2, 3, 1, 4, 5, 2, 3, 6], k = 3
 * 1. 最初の3つの要素で構成される部分配列は [1, 2, 3] で、最大値は 3 です。
 * 2. 次の3つの要素で構成される部分配列は [2, 3, 1] で、最大値は 3 です。
 * 3. 3つの要素で構成される部分配列は [3, 1, 4] で、最大値は 4 です。
 * 4. 3つの要素で構成される部分配列は [1, 4, 5] で、最大値は 5 です。
 * 
 * 問題を解くために Brute-Force（強引）な方法を使うと、連続する部分配列をすべて反復して調べる必要があります。
 * そのため、時間計算量が O(nk)になります。両端キューを使うことで、この問題を効率的に O(n) で解くことができます。(スライディングウィンドゥ)
 */
class MaxSubarrayFinder {
    public static void main(String[] args) {
        int[] arr = { 1, 2, 3, 1, 4, 5, 2, 3, 6 };
        System.out.println(getMaxWindows(arr, 3));

        // [64, 64, 64, 34, 14, 353, 353, 353, 353, 63]
        int[] arr2 = new int[] { 34, 35, 64, 34, 10, 2, 14, 5, 353, 23, 35, 63, 23 };
        System.out.println(getMaxWindows(arr2, 4));
    }

    public static ArrayList<Integer> getMaxWindows(int[] arr, int k) {
        ArrayList<Integer> results = new ArrayList<>();
        if (k > arr.length) {
            return results;
        }

        Deque<Integer> deque = new ArrayDeque<>();

        // dequeの初期化
        for (int i = 0; i < k; i++) {
            // 新しい値と既存の値を比較して、新しい値以下は全て削除するので、dequeの末尾には新しい値より大きい値が入る
            // dequeの先頭は、新しい値より大きくなるため、最大値になる。
            if (!deque.isEmpty() && arr[i] >= arr[deque.peekLast()]) {
                // dequeの末尾から要素を削除
                deque.pollLast();
            }
            // dequeの末尾に新しい値を追加
            deque.offerLast(i);
        }

        for (int i = k; i < arr.length; i++) {
            // dequeの先頭は最大値
            results.add(arr[deque.peekFirst()]);

            // ウィンドゥ外にある要素は取り除く
            while (!deque.isEmpty() && deque.peekFirst() <= i - k) {
                deque.pollFirst();
            }
            // 現在の値とそれより小さい全てのdequeの値をチェック
            while (!deque.isEmpty() && arr[i] >= arr[deque.peekLast()]) {
                deque.pollLast();
            }
            // dequeの末尾に新しい値を追加
            deque.offerLast(i);
        }

        // 最後のウィンドゥの最大値を追加
        results.add(arr[deque.peekFirst()]);
        return results;
    }
}