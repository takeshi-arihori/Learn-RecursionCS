interface Queue<E> {
	E peekLast(); // リストの最後の要素を返します。

	E pop(); // リストの最後の要素を削除し、削除した要素を返します。

	void push(E element); // リストの最後に要素を追加します。
}