public interface Lenses {
	// lightRange(): このオブジェクトが捕捉できる最小の光スペクトルと最大の光スペクトルの 2
	// タプルを返します。具体的な実装方法は、各オブジェクト（人間、カメラ、など）の特性によります。例えば、人間の目に関しては、最小の光スペクトル（紫の端）は約
	// 400nm、最大の光スペクトル（赤の端）は約 700nm となります。一方、特定のカメラやセンサーはこれよりも広い範囲の光を感知できるかもしれません。
	public abstract double[] lightRange();

	// see(object): オブジェクトを受け取り、このオブジェクトが何を見ているかを出力します。これは object.toString()
	// を使用した単純な文字列の説明で十分です。例えば、this cat sees cow through its night vision
	// のような文字列を指します。
	public abstract void see(Object object);
}
