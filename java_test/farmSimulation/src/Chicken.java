public class Chicken extends Bird {
	private int eggsLaidPerWeek;

	public Chicken(double heightM, double weightKg, double lifeSpanDays, String biologicalSex, double wingSpan,
			int eggsLaidPerWeek) {
		super("Chicken", heightM, weightKg, lifeSpanDays, biologicalSex, wingSpan);
		this.eggsLaidPerWeek = eggsLaidPerWeek;
	}

	public int layEggs() {
		return this.eggsLaidPerWeek;
	}

	public double getSellPrice() {
		return this.bmi.getWeightKg() * 1.5; // example price calculation based on weight
	}

	@Override
	public String toString() {
		return super.toString() + ", Eggs Laid Per Week: " + eggsLaidPerWeek;
	}
}
