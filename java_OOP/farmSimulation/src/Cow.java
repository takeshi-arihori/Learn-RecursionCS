public class Cow extends Mammal {
	private double milkProduction;

	public Cow(double heightM, double weightKg, double lifeSpanDays, String biologicalSex, double furLengthCm,
			String furType, double avgBodyTemperatureC, double milkProduction) {
		super("Cow", heightM, weightKg, lifeSpanDays, biologicalSex, furLengthCm, furType, avgBodyTemperatureC);
		this.milkProduction = milkProduction;
	}

	public double produceMilkAmount() {
		return this.milkProduction;
	}

	public double getSellPrice() {
		return this.bmi.getWeightKg() * 2; // example price calculation based on weight
	}

	@Override
	public String toString() {
		return super.toString() + ", Milk Production: " + milkProduction + " liters/day";
	}
}
