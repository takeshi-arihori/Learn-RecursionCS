interface Deque<E> extends Stack<E>, Queue<E> {
	void addFirst(E element); // リストの先頭に要素を追加します。

	void addLast(E element); // リストの末尾に要素を追加します。

	E removeFirst(); // リストの最初の要素を削除し、削除した要素を返します。

	E removeLast(); // リストの最後の要素を削除し、削除した要素を返します。

	int size(); // リストの要素数を返します。
}