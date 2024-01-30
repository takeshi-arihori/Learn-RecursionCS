package test_code.java;

import java.util.*;

public class Main {

    public static long fibonacci(int n) {

        if (n == 0) {
            return 0;
        }

        if (n == 1) {
            return 1;
        }

        long[] cache = new long[n + 1];
        cache[0] = 0;
        cache[1] = 1;

        for (int i = 2; i <= n; i++) {
            cache[i] = cache[i - 1] + cache[i - 2];
        }

        return cache[n];
    }

    public static void unitTestCheck(boolean predicate) {
        if (predicate) {
            System.out.println("The test passed!!");
        } else {
            System.out.println("ERROR! The test failed!!");
        }
    }

    public static void main(String[] args) {
        System.out.println("------------- fibonacchテスト ------------");
        // unitTestCheck(fibonacci(0) == 0);
        // unitTestCheck(fibonacci(1) == 1);

        // List<Integer> list = new ArrayList<Integer>();
        // System.out.println(list instanceof List);
        // System.out.println(list instanceof ArrayList);
    }
}