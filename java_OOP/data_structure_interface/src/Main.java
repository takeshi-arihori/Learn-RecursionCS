import java.util.NoSuchElementException;

class Main {
	public static void main(String[] args) {
		// DequeInt のテスト
		DequeInt<Integer> deque = new IntegerLinkedList();
		deque.addFirst(1);
		deque.addLast(2);
		deque.addFirst(3);
		deque.addLast(4);
		DequePrint(deque);

		// StackInt のテスト
		StackInt<Integer> stack = new IntegerLinkedList();
		stack.push(1);
		stack.push(2);
		stack.push(3);
		StackPrint(stack);

		// QueueInt のテスト
		QueueInt<Integer> queue = new IntegerLinkedList();
		queue.push(1);
		queue.push(2);
		queue.push(3);
		QueuePrint(queue);

		// AbstractListInteger のテスト
		AbstractListInteger list = new IntegerLinkedList();
		list.add(1);
		list.add(2);
		list.add(3);
		AbstractListIntegerPrint(list);
	}

	static void QueuePrint(QueueInt<Integer> q) {
		while (true) {
			try {
				System.out.print(q.poll() + " ");
			} catch (NoSuchElementException e) {
				break;
			}
		}
		System.out.println();
	}

	static void StackPrint(StackInt<Integer> s) {
		while (true) {
			try {
				System.out.print(s.pop() + " ");
			} catch (NoSuchElementException e) {
				break;
			}
		}
		System.out.println();
	}

	static void DequePrint(DequeInt<Integer> d) {
		try {
			System.out.print(d.removeFirst() + " ");
			System.out.print(d.removeLast() + " ");
		} catch (NoSuchElementException e) {
			// Do nothing
		}
		System.out.println();
	}

	static void AbstractListIntegerPrint(AbstractListInteger l) {
		for (int i = 0; i < ((IntegerLinkedList) l).size; i++) {
			System.out.print(l.get(i) + " ");
		}
		System.out.println();
	}
}

interface StackInt<E> {
	E peekLast();

	E pop();

	E push(E e);
}

interface QueueInt<E> {
	E peekFirst();

	E poll();

	E push(E e);
}

interface DequeInt<E> extends StackInt<E>, QueueInt<E> {
	E addFirst(E e);

	E addLast(E e);

	E removeFirst();

	E removeLast();
}

abstract class AbstractListInteger {
	private int[] initialList;

	public AbstractListInteger() {
		this.initialList = new int[0];
	}

	public AbstractListInteger(int[] arr) {
		this.initialList = arr;
	}

	public int[] getOriginalList() {
		return initialList;
	}

	public abstract int get(int position);

	public abstract void add(int element);

	public abstract void add(int[] elements);

	public abstract int popElement(); // 名前を変更して競合を避ける

	public abstract void addAt(int position, int element);

	public abstract void addAt(int position, int[] elements);

	public abstract int removeAt(int position);

	public abstract void removeAllAt(int start);

	public abstract void removeAllAt(int start, int end);

	public abstract AbstractListInteger subList(int start);

	public abstract AbstractListInteger subList(int start, int end);
}

class IntegerLinkedList extends AbstractListInteger implements DequeInt<Integer> {
	private class Node {
		int data;
		Node next;

		Node(int data) {
			this.data = data;
			this.next = null;
		}
	}

	private Node head;
	private Node tail;
	public int size;

	public IntegerLinkedList() {
		this.head = null;
		this.tail = null;
		this.size = 0;
	}

	public IntegerLinkedList(int[] arr) {
		this.head = null;
		this.tail = null;
		this.size = 0;
		for (int i : arr) {
			addLast(i);
		}
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

	public int get(int position) {
		return getNode(position).data;
	}

	public void add(int element) {
		addLast(element);
	}

	public void add(int[] elements) {
		for (int element : elements) {
			addLast(element);
		}
	}

	public int popElement() {
		return removeLast();
	}

	public void addAt(int position, int element) {
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

	public void addAt(int position, int[] elements) {
		for (int i = 0; i < elements.length; i++) {
			addAt(position + i, elements[i]);
		}
	}

	public int removeAt(int position) {
		if (position >= size || position < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		if (position == 0) {
			int data = head.data;
			head = head.next;
			if (head == null) {
				tail = null;
			}
			size--;
			return data;
		} else {
			Node prev = getNode(position - 1);
			int data = prev.next.data;
			prev.next = prev.next.next;
			if (prev.next == null) {
				tail = prev;
			}
			size--;
			return data;
		}
	}

	public void removeAllAt(int start) {
		if (start >= size || start < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		if (start == 0) {
			head = null;
			tail = null;
		} else {
			Node prev = getNode(start - 1);
			prev.next = null;
			tail = prev;
		}
		size = start;
	}

	public void removeAllAt(int start, int end) {
		if (start >= size || start < 0 || end > size || start > end) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		if (start == 0) {
			head = getNode(end);
			if (head == null) {
				tail = null;
			}
		} else {
			Node prev = getNode(start - 1);
			Node endNode = getNode(end);
			prev.next = endNode;
			if (endNode == null) {
				tail = prev;
			}
		}
		size -= (end - start);
	}

	public AbstractListInteger subList(int start) {
		if (start >= size || start < 0) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		IntegerLinkedList subList = new IntegerLinkedList();
		Node current = getNode(start);
		while (current != null) {
			subList.add(current.data);
			current = current.next;
		}
		return subList;
	}

	public AbstractListInteger subList(int start, int end) {
		if (start >= size || start < 0 || end > size || start > end) {
			throw new IndexOutOfBoundsException("Index out of bounds");
		}
		IntegerLinkedList subList = new IntegerLinkedList();
		Node current = getNode(start);
		for (int i = start; i < end; i++) {
			subList.add(current.data);
			current = current.next;
		}
		return subList;
	}

	// DequeInt インターフェースのメソッド
	public Integer addFirst(Integer element) {
		Node newNode = new Node(element);
		if (head == null) {
			head = tail = newNode;
		} else {
			newNode.next = head;
			head = newNode;
		}
		size++;
		return element;
	}

	public Integer push(Integer element) {
		return addFirst(element);
	}

	public Integer addLast(Integer element) {
		Node newNode = new Node(element);
		if (tail == null) {
			head = tail = newNode;
		} else {
			tail.next = newNode;
			tail = newNode;
		}
		size++;
		return element;
	}

	public Integer removeFirst() {
		if (head == null) {
			throw new NoSuchElementException("List is empty");
		}
		int data = head.data;
		head = head.next;
		if (head == null) {
			tail = null;
		}
		size--;
		return data;
	}

	public Integer poll() {
		return removeFirst();
	}

	public Integer removeLast() {
		if (tail == null) {
			throw new NoSuchElementException("List is empty");
		}
		if (head == tail) {
			int data = tail.data;
			head = tail = null;
			size--;
			return data;
		}
		Node current = head;
		while (current.next != tail) {
			current = current.next;
		}
		int data = tail.data;
		tail = current;
		tail.next = null;
		size--;
		return data;
	}

	public Integer pop() {
		return removeLast();
	}

	public Integer peekFirst() {
		if (head == null) {
			throw new NoSuchElementException("List is empty");
		}
		return head.data;
	}

	public Integer peekLast() {
		if (tail == null) {
			throw new NoSuchElementException("List is empty");
		}
		return tail.data;
	}
}
