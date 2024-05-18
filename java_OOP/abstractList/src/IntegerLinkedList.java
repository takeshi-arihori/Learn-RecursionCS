import java.util.Arrays;
import java.util.LinkedList;

public class IntegerLinkedList extends AbstractListInteger {
	private LinkedList<Integer> list;

	public IntegerLinkedList() {
		this.list = new LinkedList<>();
	}

	public IntegerLinkedList(int[] arr) {
		this.list = new LinkedList<>();
		for (int i : arr) {
			list.add(i);
		}
	}

	// 特定位置の要素を取得します。
	@Override
	public int get(int position) {
		return list.get(position);
	};

	// リストの最後に追加します。
	@Override
	public void add(int element) {
		list.add(element);
	};

	// リストの最後の要素に追加します。
	@Override
	public void add(int[] elements) {
		for (int i : elements) {
			list.add(i);
		}
	};

	// リストの最後から削除します。削除した要素を返します。
	@Override
	public int pop() {
		return list.removeLast();
	};

	// 指定された位置に要素を追加します。
	@Override
	public void addAt(int position, int element) {
		list.add(position, element);
	};

	// 指定された位置に複数の要素を追加します。
	@Override
	public void addAt(int position, int[] elements) {
		for (int i : elements) {
			list.add(position++, i);
		}
	};

	// 指定した位置にある要素を削除します。削除した要素を返します。
	@Override
	public int removeAt(int position) {
		return list.remove(position);
	};

	// 指定された位置から始まるすべての要素を削除します。
	@Override
	public void removeAllAt(int start) {
		while (list.size() > start) {
			list.remove(start);
		}
	};

	// startからendまでの全ての要素を削除します。
	@Override
	public void removeAllAt(int start, int end) {
		while (end >= start) {
			list.remove(start);
			end--;
		}
	};

	// AbstractListIntegerの部分リストを、指定された位置から最後まで返します。
	@Override
	public AbstractListInteger subList(int start) {
		return subList(start, list.size());
	};

	// startからendまでのAbstractListIntegerの部分リストを返します。
	@Override
	public AbstractListInteger subList(int start, int end) {
		IntegerLinkedList subList = new IntegerLinkedList();
		for (int i = start; i < end; i++) {
			subList.add(list.get(i));
		}
		return subList;
	};
}
