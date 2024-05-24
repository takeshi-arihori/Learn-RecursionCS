public class Main {
	public static void main(String[] args) {
		// LinkedList のテスト
		Deque<Integer> linkedList = new LinkedList<>();
		linkedList.addFirst(1);
		linkedList.addLast(2);
		linkedList.addFirst(3);
		linkedList.addLast(4);
		dequePrint(linkedList);

		// ArrayList のテスト
		Deque<Integer> arrayList = new ArrayList<>();
		arrayList.addFirst(1);
		arrayList.addLast(2);
		arrayList.addFirst(3);
		arrayList.addLast(4);
		dequePrint(arrayList);
	}

	static void dequePrint(Deque<Integer> deque) {
		while (deque.size() > 0) {
			System.out.print(deque.removeFirst() + " ");
		}
		System.out.println();
	}
}
