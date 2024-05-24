public class Main {
	public static void main(String[] args) {
		LRUCache<Integer, String> lruCache = new LRUCache<>(2);

		// キャッシュに値を追加
		lruCache.put(1, "One");
		lruCache.put(2, "Two");

		// キャッシュから値を取得
		System.out.println(lruCache.get(1)); // 出力: One

		// 新しい値を追加して古い値を削除
		lruCache.put(3, "Three");
		System.out.println(lruCache.get(2)); // 出力: null, 2は削除されたため

		// さらに新しい値を追加
		lruCache.put(4, "Four");
		System.out.println(lruCache.get(1)); // 出力: null, 1は削除されたため
		System.out.println(lruCache.get(3)); // 出力: Three
		System.out.println(lruCache.get(4)); // 出力: Four
	}
}