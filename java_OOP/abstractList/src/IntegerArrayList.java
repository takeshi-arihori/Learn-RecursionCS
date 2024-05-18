import java.util.Arrays;

// Listインタフェースのサイズ変更可能な配列の実装。
// リストのオプションの操作をすべて実装し、nullを含むすべての要素を許容します。
// このクラスは、Listインタフェースを実装するほか、リストを格納するために内部的に使われる配列のサイズを操作するメソッドを提供します。
public class IntegerArrayList extends AbstractListInteger {
	private int[] array;
	private int size;

	public IntegerArrayList() {
		this.array = new int[10];
		this.size = 0;
	}

	public IntegerArrayList(int[] arr) {
		this.array = Arrays.copyOf(arr, arr.length);
		this.size = arr.length;
	}

	public int size() {
		return this.size;
	}

	public String toString() {
		// arrayを文字列に変換して返します。
		return Arrays.toString(Arrays.copyOf(array, size));
	}

	// 特定位置の要素を取得します。
	@Override
	public int get(int position) {
		if (position >= 0 && position < size) {
			return array[position];
		} else {
			throw new IndexOutOfBoundsException("Index: " + position + ", Size: " + size);
		}
	};

	// リストの最後に追加します。
	@Override
	public void add(int element) {
		ensureCapacity(size + 1);
		array[size++] = element;
	};

	// リストの最後の要素に追加します。
	@Override
	public void add(int[] elements) {
		ensureCapacity(size + elements.length);
		System.arraycopy(elements, 0, array, size, elements.length);
		size += elements.length;
	};

	// リストの最後から削除します。削除した要素を返します。
	@Override
	public int pop() {
		if (size == 0) {
			throw new IndexOutOfBoundsException("Array is empty");
		} else {
			return array[--size];
		}
	};

	// 指定された位置に要素を追加します。
	@Override
	public void addAt(int position, int element) {
		if (position < 0 || position > size) {
			throw new IndexOutOfBoundsException("Index: " + position + ", Size: " + size);
		}
		ensureCapacity(size + 1);
		System.arraycopy(array, position, array, position + 1, size - position);
		array[position] = element;
		size++;
	};

	// 指定された位置に複数の要素を追加します。
	@Override
	public void addAt(int position, int[] elements) {
		if (position < 0 || position > size) {
			throw new IndexOutOfBoundsException("Index: " + position + ", Size: " + size);
		}
		ensureCapacity(size + elements.length);
		System.arraycopy(array, position, array, position + elements.length, size - position);
		System.arraycopy(elements, 0, array, position, elements.length);
		size += elements.length;
	};

	// 指定した位置にある要素を削除します。削除した要素を返します。
	@Override
	public int removeAt(int position) {
		if (position < 0 || position >= size) {
			throw new IndexOutOfBoundsException("Index: " + position + ", Size: " + size);
		}
		int removedElement = array[position];
		System.arraycopy(array, position + 1, array, position, size - position - 1);
		size--;
		return removedElement;
	};

	// 指定された位置から始まるすべての要素を削除します。
	@Override
	public void removeAllAt(int start) {
		if (start < 0 || start >= size) {
			throw new IndexOutOfBoundsException("Index: " + start + ", Size: " + size);
		}
		size = start;
	};

	// startからendまでの全ての要素を削除します。
	@Override
	public void removeAllAt(int start, int end) {
		if (start < 0 || start >= size || end < 0 || end >= size) {
			throw new IndexOutOfBoundsException("Index: " + start + ", Size: " + size);
		}
		System.arraycopy(array, end + 1, array, start, size - end - 1);
		size -= end - start + 1;
	};

	// AbstractListIntegerの部分リストを、指定された位置から最後まで返します。
	@Override
	public AbstractListInteger subList(int start) {
		return subList(start, size);
	};

	// startからendまでのAbstractListIntegerの部分リストを返します。
	@Override
	public AbstractListInteger subList(int start, int end) {
		if (start < 0 || start >= size || end < 0 || end >= size) {
			throw new IndexOutOfBoundsException("Index: " + start + ", Size: " + size);
		}
		return new IntegerArrayList(Arrays.copyOfRange(array, start, end));
	};

	// このArrayListインスタンスの容量を必要に応じて増やし、少なくとも最小容量引数で指定される要素数を保持できるようにします。
	private void ensureCapacity(int minCapacity) {
		if (minCapacity > array.length) {
			int oldCapacity = array.length;
			int newCapacity = oldCapacity + (oldCapacity >> 1); // Increase by 1.5 times
			if (newCapacity < minCapacity) {
				newCapacity = minCapacity;
			}
			array = Arrays.copyOf(array, newCapacity);
		}
	}

}
