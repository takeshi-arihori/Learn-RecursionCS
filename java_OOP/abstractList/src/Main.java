import java.util.Arrays;

public class Main {
	public static void main(String[] args) {
		// テストコード例
		// 新しいIntegerArrayListを作成
		IntegerArrayList arrayList = new IntegerArrayList();

		// 要素を追加
		arrayList.add(1);
		arrayList.add(2);
		arrayList.add(3);
		arrayList.addAt(1, 4); // 位置1に4を追加

		System.out.println(arrayList);

		System.out.println();
		// 結果を表示
		for (int i = 0; i < arrayList.size(); i++) {
			System.out.print(arrayList.get(i) + " ");
		}
		System.out.println();
		System.out.println();

		IntegerLinkedList linkedList = new IntegerLinkedList(new int[] { 1, 2, 3, 4,
				5 });
		linkedList.addAt(2, new int[] { 6, 7, 8 });
		System.out.println(linkedList.get(2)); // 6
	}
}