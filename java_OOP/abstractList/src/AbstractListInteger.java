abstract class AbstractListInteger {
	private int[] initialList;

	// AbstractListIntegerを整数リストで開始することも、空のリストで開始することもできます。
	public AbstractListInteger() {
		this.initialList = new int[0];
	}

	public AbstractListInteger(int[] arr) {
		this.initialList = arr;
	}

	public int[] getOriginalList() {
		return initialList;
	}

	// AbstractListIntegerが実装しなければならない抽象メソッド
	public abstract int get(int position); // 特定位置の要素を取得します。

	public abstract void add(int element); // リストの最後に追加します。

	public abstract void add(int[] elements); // リストの最後の要素に追加します。

	public abstract int pop();// リストの最後から削除します。削除した要素を返します。

	public abstract void addAt(int position, int element);// 指定された位置に要素を追加します。

	public abstract void addAt(int position, int[] elements);// 指定された位置に複数の要素を追加します。

	public abstract int removeAt(int position);// 指定した位置にある要素を削除します。削除した要素を返します。

	public abstract void removeAllAt(int start);// 指定された位置から始まるすべての要素を削除します。

	public abstract void removeAllAt(int start, int end);// startからendまでの全ての要素を削除します。

	public abstract AbstractListInteger subList(int start); // AbstractListIntegerの部分リストを、指定された位置から最後まで返します。

	public abstract AbstractListInteger subList(int start, int end); // startからendまでのAbstractListIntegerの部分リストを返します。
}
