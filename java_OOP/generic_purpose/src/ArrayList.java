import java.util.Arrays;
import java.util.NoSuchElementException;

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
