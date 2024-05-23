import java.util.NoSuchElementException;
import java.util.Arrays;

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

interface Stack<E> {
	E peekFirst(); // リストの最初の要素を返します。

	E poll(); // リストの最初の要素を削除し、削除した要素を返します。

	void push(E element); // リストの最初に要素を追加します。
}

interface Queue<E> {
	E peekLast(); // リストの最後の要素を返します。

	E pop(); // リストの最後の要素を削除し、削除した要素を返します。

	void push(E element); // リストの最後に要素を追加します。
}

interface Deque<E> extends Stack<E>, Queue<E> {
	void addFirst(E element); // リストの先頭に要素を追加します。

	void addLast(E element); // リストの末尾に要素を追加します。

	E removeFirst(); // リストの最初の要素を削除し、削除した要素を返します。

	E removeLast(); // リストの最後の要素を削除し、削除した要素を返します。

	int size(); // リストの要素数を返します。
}

abstract class AbstractList<E> implements Deque<E> {
	public abstract E get(int position);

	public abstract void add(int position, E element);

	public abstract E remove(int position);

	public abstract int size();
}

class LinkedList<E> extends AbstractList<E> {
	private class Node {
		E data;
		Node next;

		Node(E data) {
			this.data = data;
			this.next = null;
		}
	}

	private Node head;
	private Node tail;
	private int size;

	public LinkedList() {
		this.head = null;
		this.tail = null;
		this.size = 0;
	}

	private Node getNode(int index) {
		if (index >= size || index < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		Node current = head;
		for (int i = 0; i < index; i++) {
			current = current.next;
		}
		return current;
	}

	@Override
	public E get(int position) {
		return getNode(position).data;
	}

	@Override
	public void add(int position, E element) {
		if (position > size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		Node newNode = new Node(element);
		if (position == 0) {
			newNode.next = head;
			head = newNode;
			if (size == 0) {
				tail = newNode;
			}
		} else {
			Node prev = getNode(position - 1);
			newNode.next = prev.next;
			prev.next = newNode;
			if (newNode.next == null) {
				tail = newNode;
			}
		}
		size++;
	}

	@Override
	public E remove(int position) {
		if (position >= size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		if (position == 0) {
			E data = head.data;
			head = head.next;
			if (head == null) {
				tail = null;
			}
			size--;
			return data;
		} else {
			Node prev = getNode(position - 1);
			E data = prev.next.data;
			prev.next = prev.next.next;
			if (prev.next == null) {
				tail = prev;
			}
			size--;
			return data;
		}
	}

	@Override
	public int size() {
		return size;
	}

	@Override
	public void addFirst(E element) {
		add(0, element);
	}

	@Override
	public void addLast(E element) {
		add(size, element);
	}

	@Override
	public E removeFirst() {
		return remove(0);
	}

	@Override
	public E removeLast() {
		return remove(size - 1);
	}

	@Override
	public E peekFirst() {
		if (head == null) {
			throw new NoSuchElementException("List is empty");
		}
		return head.data;
	}

	@Override
	public E peekLast() {
		if (tail == null) {
			throw new NoSuchElementException("List is empty");
		}
		return tail.data;
	}

	@Override
	public E poll() {
		return removeFirst();
	}

	@Override
	public E pop() {
		return removeLast();
	}

	@Override
	public void push(E element) {
		addFirst(element);
	}
}

class ArrayList<E> extends AbstractList<E> {
	private E[] array;
	private int size;

	@SuppressWarnings("unchecked")
	public ArrayList() {
		array = (E[]) new Object[10];
		size = 0;
	}

	private void ensureCapacity() {
		if (size == array.length) {
			array = Arrays.copyOf(array, array.length * 2);
		}
	}

	@Override
	public E get(int position) {
		if (position >= size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		return array[position];
	}

	@Override
	public void add(int position, E element) {
		if (position > size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		ensureCapacity();
		System.arraycopy(array, position, array, position + 1, size - position);
		array[position] = element;
		size++;
	}

	@Override
	public E remove(int position) {
		if (position >= size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		E element = array[position];
		System.arraycopy(array, position + 1, array, position, size - position - 1);
		size--;
		return element;
	}

	@Override
	public int size() {
		return size;
	}

	@Override
	public void addFirst(E element) {
		add(0, element);
	}

	@Override
	public void addLast(E element) {
		add(size, element);
	}

	@Override
	public E removeFirst() {
		return remove(0);
	}

	@Override
	public E removeLast() {
		return remove(size - 1);
	}

	@Override
	public E peekFirst() {
		if (size == 0) {
			throw new NoSuchElementException("List is empty");
		}
		return array[0];
	}

	@Override
	public E peekLast() {
		if (size == 0) {
			throw new NoSuchElementException("List is empty");
		}
		return array[size - 1];
	}

	@Override
	public E poll() {
		return removeFirst();
	}

	@Override
	public E pop() {
		return removeLast();
	}

	@Override
	public void push(E element) {
		addFirst(element);
	}
}
