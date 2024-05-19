public class Person implements Audible, Lenses {
	private String firstName;
	private String lastName;
	private double heightM;
	private double weightKg;
	private int age;

	public Person(String firstName, String lastName, double heightM, double weightKg, int age) {
		this.firstName = firstName;
		this.lastName = lastName;
		this.heightM = heightM;
		this.weightKg = weightKg;
		this.age = age;
	}

	public String getFullName() {
		return this.firstName + " " + this.lastName;
	}

	public String toString() {
		return this.getFullName() + " who is " + this.heightM + "m tall and weights " + this.weightKg + "kg.";
	}

	public void makeNoise() {
		System.out.println("Hello World!");
	}

	public double soundFrequency() {
		return this.age > 16 ? 110 : 130;
	}

	public double soundLevel() {
		return this.age > 16 ? 60 : 65;
	}

	// lightRange(): このオブジェクトが捕捉できる最小の光スペクトルと最大の光スペクトルの 2
	// タプルを返します。具体的な実装方法は、各オブジェクト（人間、カメラ、など）の特性によります。例えば、人間の目に関しては、最小の光スペクトル（紫の端）は約
	// 400nm、最大の光スペクトル（赤の端）は約 700nm となります。一方、特定のカメラやセンサーはこれよりも広い範囲の光を感知できるかもしれません。
	public double[] lightRange() {
		return new double[] { 400, 700 };
	}

	// see(object): オブジェクトを受け取り、このオブジェクトが何を見ているかを出力します。これは object.toString()
	// を使用した単純な文字列の説明で十分です。例えば、this cat sees cow through its night vision
	// のような文字列を指します。
	public void see(Object object) {
		System.out.println(this.getFullName() + " sees " + object.toString());
	};
}
