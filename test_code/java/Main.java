package test_code.java;

import java.util.ArrayList;
import java.util.stream.IntStream;

public class Main {

    public static ArrayList<ArrayList<Integer>> getDivisorCombinationList(int n) { // 10
        ArrayList<ArrayList<Integer>> divisor = new ArrayList<>();
        for (int i = 1; i <= Math.ceil(Math.sqrt(n)); i++) {
            ArrayList<Integer> combination = new ArrayList<>();
            if (n % i != 0) {
                continue;
            }
            combination.add(i);
            combination.add(n / i);
            divisor.add(combination);
        }
        return divisor;
    }

    public static boolean divisorCheck(int k, int num) {
        // getDivisorCombinationList関数の整合性をチェックしてください
        ArrayList<ArrayList<Integer>> divisor = getDivisorCombinationList(k);
        // 重複削除 && kより大きくnumより小さいものを対象とする
        return divisor.size() == num;
    }

    public static void unitTestCheck(boolean predicate) {
        if (predicate) {
            System.out.println("The test passed!!");
        } else {
            System.out.println("ERROR! The test failed!!");
        }
    }

    public static void unitTests(int[] inputs, int[] outputs) {

        IntStream.range(0, inputs.length).forEach(i -> {
            int input = inputs[i];
            int output = outputs[i];
            boolean predicate = divisorCheck(input, output);
            unitTestCheck(predicate);
        });
    }

    public static void main(String[] args) {
        // テストケース: unitTests([1,10,120,720,1260,5040,25200],[0,2,8,15,18,30,45])
        int[] inputs = { 1, 10, 120, 720, 1260, 5040, 25200 };
        int[] outputs = { 0, 2, 8, 15, 18, 30, 45 };
        unitTests(inputs, outputs);
    }
}