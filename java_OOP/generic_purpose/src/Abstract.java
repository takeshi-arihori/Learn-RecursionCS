abstract class AbstractList<E> implements Deque<E> {
	public abstract E get(int position);

	public abstract void add(int position, E element);

	public abstract E remove(int position);

	public abstract int size();
}
