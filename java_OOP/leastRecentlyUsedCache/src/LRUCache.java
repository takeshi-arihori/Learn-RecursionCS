import java.util.HashMap;
import java.util.Map;

class LRUCache<K, V> {
	private final int capacity;
	private final Map<K, Node<K, V>> cache;
	private final Node<K, V> head;
	private final Node<K, V> tail;

	private static class Node<K, V> {
		K key;
		V value;
		Node<K, V> prev;
		Node<K, V> next;

		Node(K key, V value) {
			this.key = key;
			this.value = value;
		}
	}

	public LRUCache(int capacity) {
		this.capacity = capacity;
		this.cache = new HashMap<>(capacity);
		this.head = new Node<>(null, null);
		this.tail = new Node<>(null, null);
		head.next = tail;
		tail.prev = head;
	}

	public V get(K key) {
		Node<K, V> node = cache.get(key);
		if (node == null) {
			return null;
		}
		moveToHead(node);
		return node.value;
	}

	public void put(K key, V value) {
		Node<K, V> node = cache.get(key);
		if (node == null) {
			node = new Node<>(key, value);
			cache.put(key, node);
			addToHead(node);
			if (cache.size() > capacity) {
				Node<K, V> tail = removeTail();
				cache.remove(tail.key);
			}
		} else {
			node.value = value;
			moveToHead(node);
		}
	}

	private void addToHead(Node<K, V> node) {
		node.prev = head;
		node.next = head.next;
		head.next.prev = node;
		head.next = node;
	}

	private void moveToHead(Node<K, V> node) {
		removeNode(node);
		addToHead(node);
	}

	private void removeNode(Node<K, V> node) {
		node.prev.next = node.next;
		node.next.prev = node.prev;
	}

	private Node<K, V> removeTail() {
		Node<K, V> res = tail.prev;
		removeNode(res);
		return res;
	}

	public static void main(String[] args) {
		LRUCache<Integer, String> lruCache = new LRUCache<>(2);
		lruCache.put(1, "One");
		lruCache.put(2, "Two");
		System.out.println(lruCache.get(1)); // Prints: One
		lruCache.put(3, "Three");
		System.out.println(lruCache.get(2)); // Prints: null, because 2 was evicted
		lruCache.put(4, "Four");
		System.out.println(lruCache.get(1)); // Prints: null, because 1 was evicted
		System.out.println(lruCache.get(3)); // Prints: Three
		System.out.println(lruCache.get(4)); // Prints: Four
	}
}
