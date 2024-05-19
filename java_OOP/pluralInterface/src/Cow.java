public class Cow implements Audible, Edible {
	private double weightKg;
	private double soundFrequency = 90;
	private double soundDecibels = 70;

	public Cow(double weightKg) {
		this.weightKg = weightKg;
	}

	public String toString() {
		return "This is a cow that weights: " + this.weightKg + "kg";
	}

	public void makeNoise() {
		System.out.println("Moooo!!");
	}

	public double soundFrequency() {
		return this.soundFrequency;
	}

	public double soundLevel() {
		return this.soundDecibels;
	}

	public String howToPrepare() {
		return "Cut the cow with a butchering knife into even pieces, and grill each piece at 220C";
	}

	public double calories() {
		return this.weightKg * 1850;
	}
}
