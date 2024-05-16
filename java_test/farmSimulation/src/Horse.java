public class Horse extends Mammal {
	private double runningSpeed;

	public Horse(double heightM, double weightKg, double lifeSpanDays, String biologicalSex, double furLengthCm,
			String furType, double avgBodyTemperatureC, double runningSpeed) {
		super("Horse", heightM, weightKg, lifeSpanDays, biologicalSex, furLengthCm, furType, avgBodyTemperatureC);
		this.runningSpeed = runningSpeed;
	}

	public double getSellPrice() {
		return this.runningSpeed * 100; // example price calculation based on speed
	}

	@Override
	public String toString() {
		return super.toString() + ", Running Speed: " + runningSpeed + " km/h";
	}
}
