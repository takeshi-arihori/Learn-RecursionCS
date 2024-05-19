public class Horse implements Audible {
	private double weightKg;
	private double soundFrequency = 120;
	private double soundDecibels = 75;

	public Horse(double weightKg) {
		this.weightKg = weightKg;
	}

	public String toString() {
		return "This is a horse that weights: " + this.weightKg + "kg";
	}

	public void makeNoise() {
		System.out.println("Neeighh!!");
	}

	public double soundFrequency() {
		return this.soundFrequency;
	}

	public double soundLevel() {
		return this.soundDecibels;
	}
}
