import java.util.HashMap;
import java.util.Map;

class LRUCache<K, V> {
	private final int capacity;
	private final Map<K, Node<K, V>> cache;
	private final Node<K, V> head;
	private final Node<K, V> tail;

	// ノードクラス: キーと値、前後のポインタを持つ
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

	// コンストラクタ: キャッシュの容量を設定し、ダミーノードを初期化
	public LRUCache(int capacity) {
		this.capacity = capacity;
		this.cache = new HashMap<>(capacity);
		this.head = new Node<>(null, null);
		this.tail = new Node<>(null, null);
		head.next = tail;
		tail.prev = head;
	}

	// 値を取得: ノードをリストの先頭に移動し、値を返す
	public V get(K key) {
		Node<K, V> node = cache.get(key);
		if (node == null) {
			return null;
		}
		moveToHead(node);
		return node.value;
	}

	// 値を追加: 新しいノードをリストの先頭に追加し、必要に応じて末尾のノードを削除
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

	// ノードをリストの先頭に追加
	private void addToHead(Node<K, V> node) {
		node.prev = head;
		node.next = head.next;
		head.next.prev = node;
		head.next = node;
	}

	// ノードをリストの先頭に移動
	private void moveToHead(Node<K, V> node) {
		removeNode(node);
		addToHead(node);
	}

	// ノードをリストから削除
	private void removeNode(Node<K, V> node) {
		node.prev.next = node.next;
		node.next.prev = node.prev;
	}

	// 末尾のノードを削除し、削除したノードを返す
	private Node<K, V> removeTail() {
		Node<K, V> res = tail.prev;
		removeNode(res);
		return res;
	}
}
