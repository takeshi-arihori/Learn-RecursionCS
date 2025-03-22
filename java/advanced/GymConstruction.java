import java.util.Deque;
import java.util.ArrayDeque;
import java.util.ArrayList;

public class GymConstruction {
    public static void main(String[] args) {
        System.out.println(largestRectangle(new int[] { 1, 2, 3, 4, 5, 1 })); // 9
        System.out.println(largestRectangle(new int[] { 3, 2, 3 })); // 6
        System.out.println(largestRectangle(new int[] { 1, 2, 5, 2, 3, 4 })); // 10
        System.out.println(largestRectangle(new int[] { 1, 2, 3, 4, 5 })); // 9
        System.out.println(largestRectangle(new int[] { 3, 4, 5, 8, 10, 2, 1, 3, 9
        })); // 16
        System.out.println(largestRectangle(new int[] { 1, 2, 1, 3, 5, 2, 3, 4 }));
        // 10
        System.out.println(largestRectangle(new int[] { 11, 11, 10, 10, 10 })); // 50
        System.out.println(largestRectangle(new int[] { 8979, 4570, 6436, 5083, 7780,
                3269, 5400, 7579, 2324, 2116 })); // 26152
    }

    // 通常の解き方(Brute Force)
    // private static int largestRectangle(int[] h) {
    // int max = 0;
    // int[] areas = new int[h.length];
    // // nested for loops, O(n^2)
    // for (int i = 0; i < h.length; i++) {
    // int height = h[i];
    // int width = 1;
    // // Check to the left
    // for (int j = i - 1; j >= 0; j--) {
    // if (h[j] >= height) {
    // width++;
    // } else {
    // break;
    // }
    // }
    // // Check to the right
    // for (int j = i + 1; j < h.length; j++) {
    // if (h[j] >= height) {
    // width++;
    // } else {
    // break;
    // }
    // }
    // areas[i] = height * width;
    // }
    // for (int area : areas) {
    // max = Math.max(max, area);
    // }
    // return max;
    // }

    // スタックを使った解き方(O(n))
    private static int largestRectangle(int[] h) {
        int[] left = stackCounter(h);
        int[] right = reverse(stackCounter(reverse(h)));
        int[] total = new int[h.length];

        for (int i = 0; i < h.length; i++) {
            total[i] = (left[i] + right[i] - 1) * h[i];
        }

        int maxValue = 0;
        for (Integer num : total) {
            maxValue = Math.max(maxValue, num);
        }
        return maxValue;
    }

    private static int[] stackCounter(int[] arr) {
        Deque<Integer> stack = new ArrayDeque<>(); // 両端キュー
        int[] results = new int[arr.length];
        int i = 0;
        for (Integer x : arr) {
            int total = 1;
            while (!stack.isEmpty() && arr[stack.peek()] >= x) {
                int j = stack.pop();
                total += results[j];
            }

            stack.push(i);
            results[i] = total;
            i++;
        }
        return results;
    }

    private static int[] reverse(int[] arr) {
        int[] newArr = new int[arr.length];
        for (int i = arr.length - 1, j = 0; i >= 0; i--, j++) {
            newArr[j] = arr[i];
        }
        return newArr;
    }
}
