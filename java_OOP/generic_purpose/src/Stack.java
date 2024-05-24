interface Stack<E> {
	E peekFirst(); // リストの最初の要素を返します。

	E poll(); // リストの最初の要素を削除し、削除した要素を返します。

	void push(E element); // リストの最初に要素を追加します。
}