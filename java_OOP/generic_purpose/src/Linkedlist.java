import java.util.NoSuchElementException;

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