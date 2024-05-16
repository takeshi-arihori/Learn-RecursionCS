public class Bird extends Animal {
	protected double wingSpan;

	public Bird(String species, double heightM, double weightKg, double lifeSpanDays, String biologicalSex,
			double wingSpan) {
		super(species, heightM, weightKg, lifeSpanDays, biologicalSex);
		this.wingSpan = wingSpan;
	}

	public void fly() {
		if (this.isAlive()) {
			System.out.println(this.species + " is flying with a wingspan of " + this.wingSpan + " meters.");
		}
	}

	@Override
	public String toString() {
		return super.toString() + ", Wing Span: " + wingSpan + " meters";
	}
}
