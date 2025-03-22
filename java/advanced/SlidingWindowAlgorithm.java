import java.util.Deque;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.ArrayDeque;

/**
 * 【問題428】medium サイズkの部分配列の最小値を求める問題
 * 配列 intArr と整数 k が与えられるので、サイズ k の連続する部分配列の最小値を返す、minWindowArrK を作成してください。
 * 
 * Brute-Force => 連続する部分配列を全て反復する必要があるため O(n・k) になる
 * スライディングウィンドゥを使って解く => 両端キューを使用することで O(n) で解決できる
 * 
 * 例: intArr = [3, 9, 10, 2, 4, 5], k = 3 -> [3,2,2,2]
 * 1. deque が空の時、最初の要素 3 (index=0) のインデックスを deque に追加する -> deque = [0]
 * 2. 次の要素 9 (index=1) が 3 より大きいため、deque に追加する -> deque = [0, 1]
 * 3. 次の要素 10 (index=2) が 9 より大きいため、deque に追加する -> deque = [0, 1, 2]
 * 4. 最初のウィンドゥ[0, 1, 2] のdequeが完成。
 * 5. dequeの先頭は最小値なので、対応する要素 3 を配列に追加する -> deque = [0, 1, 2], res = [3]
 * 6. dequeの先頭がウィンドゥからはみ出るので、dequeの先頭を削除する -> deque = [1, 2]
 * 7. 次の要素 2 (index=3) が 10 より小さいため、10 (index=2) を pop する -> deque = [1]
 * 8. さらに 9 (index=1) よりも小さいので、9 (index=1) を pop する -> deque = []
 * 9. 2(index=3) を追加する -> deque = [3]
 * 10. res に intArr の要素 2 (index=3) を追加する -> res = [3, 2]
 * 11. ウィンドゥが右に1つずれて、[1~3]になった。
 * 12. 次の要素 4 (index=4) が 2 より大きいため、deque に 4(index=4) を追加する -> deque = [3, 4]
 * 13. res に deque の先頭 1 (index=3) を追加する -> res = [3, 2, 2]
 * 14. ウィンドゥが右に 1 つずれて、[2~4] になった。
 * 15. 次の要素 5 (index=5) が 4 より大きいため、deque に 5 (index=5) を追加する -> deque = [3, 4,
 * 5]
 * 16. ウィンドゥが右端まで来たのでループを終了し、最後のウィンドゥの分を res に追加する -> res = [3, 2, 2, 2]
 */
class SlidingWindowAlgorithm {
    public static void main(String[] args) {
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 3, 9, 10, 2, 4, 5 }, 3))); // [3,2,2,2]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 2, 3, 1, 1, 12,
                3, 10 }, 1))); // [2,3,1,1,12,3,10]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 2, 3, 1, 1, 12,
                3, 10 }, 3))); // [1,1,1,1,3]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 2, 3, 1, 1, 12,
                3, 10 }, 4))); // [1,1,1,1]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 3, 9, 10, 2, 4,
                5 }, 5))); // [2,2]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 30, 50, 60, 20,
                30, 64, 80 }, 3))); // [30,20,20,20,30]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 30, 50, 60, 20,
                30, 64, 80 }, 2))); // [30,50,20,20,30,64]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 24, 5, 67, 60,
                24, 64, 23, 536, 345 }, 3))); // [5,5,24,24,23,23,23]
        System.out.println(Arrays.toString(minWindowArrK(new int[] { 2, 3, 1, 1, 12,
                3, 10 }, 3))); // [1,1,1,1,3]
    }

    public static int[] minWindowArrK(int[] intArr, int k) {
        Deque<Integer> deque = new ArrayDeque<>();
        ArrayList<Integer> res = new ArrayList<>();

        // まずは配列intArrの先頭からk番目までの最初のウィンドゥを考える
        for (int i = 0; i < k; i++) {
            // dequeの最後尾の要素がintArr[i]より大きい場合、dequeの最後尾の要素を削除して、intArr[i]を追加する
            // dequeの最後尾の要素は最小値を保持できる。
            while (!deque.isEmpty() && intArr[i] <= intArr[deque.peekLast()]) {
                deque.pollLast();
            }
            deque.offerLast(i);
        }
        System.out.println("Initialized Deque: " + deque);

        for (int i = k; i < intArr.length; i++) {
            // dequeの先頭は最小値なので、先頭の要素をresに追加する
            res.add(intArr[deque.peekFirst()]);
            // dequeの先頭がウィンドゥからはみ出る場合、先頭を削除する
            if (deque.peekFirst() <= i - k) {
                deque.pollFirst();
            }
            // dequeの最後尾の要素がintArr[i]より大きい場合、dequeの最後尾の要素を削除して、intArr[i]を追加する
            while (!deque.isEmpty() && intArr[i] <= intArr[deque.peekLast()]) {
                deque.pollLast();
            }
            deque.offerLast(i);
        }
        // 最後のウィンドゥの最小値をresに追加する
        res.add(intArr[deque.peekFirst()]);
        System.out.println("Final Deque: " + deque);
        return res.stream().mapToInt(i -> i).toArray();
    }
}