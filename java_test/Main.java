import java.util.ArrayList;
import java.util.stream.IntStream;

// このクラスは、与えられた数の約数の組み合わせを見つけ、特定の条件に基づいて整合性チェックを行うユーティリティクラスです。
public class Main {

	// 与えられた数nの約数の組み合わせリストを返すメソッドです。
	public static ArrayList<ArrayList<Integer>> getDivisorCombinationList(int n) {
		ArrayList<ArrayList<Integer>> divisor = new ArrayList<>();
		for (int i = 1; i <= Math.ceil(Math.sqrt(n)); i++) {
			ArrayList<Integer> combination = new ArrayList<>();
			if (n % i != 0) { // nがiで割り切れない場合はスキップ
				continue;
			}
			combination.add(i); // 約数を追加
			combination.add(n / i); // 対になる約数を追加
			divisor.add(combination); // 組み合わせリストに追加
		}
		return divisor;
	}

	// 与えられた数kの約数の組み合わせが、指定された数numと一致するかどうかをチェックするメソッドです。
	public static boolean divisorCheck(int k, int num) {
		ArrayList<ArrayList<Integer>> divisor = getDivisorCombinationList(k);
		// ここでは、約数の組み合わせリストのサイズがnumと一致するかどうかを返します。
		return divisor.size() == num;
	}

	// ユニットテストの結果を表示するメソッドです。
	public static void unitTestCheck(boolean predicate) {
		if (predicate) {
			System.out.println("The test passed!!");
		} else {
			System.out.println("ERROR! The test failed!!");
		}
	}

	// 複数のユニットテストを実行するメソッドです。
	public static void unitTests(int[] inputs, int[] outputs) {
		IntStream.range(0, inputs.length).forEach(i -> {
			int input = inputs[i];
			int output = outputs[i];
			boolean predicate = divisorCheck(input, output);
			unitTestCheck(predicate); // 各テストケースの結果をチェック
		});
	}

	// メインメソッドです。ユニットテストを実行します。
	public static void main(String[] args) {
		// テストケース: unitTests([1,10,120,720,1260,5040,25200],[0,2,8,15,18,30,45])
		int[] inputs = { 1, 10, 120, 720, 1260, 5040, 25200 };
		int[] outputs = { 0, 2, 8, 15, 18, 30, 45 };
		unitTests(inputs, outputs); // ユニットテストを実行
	}
}