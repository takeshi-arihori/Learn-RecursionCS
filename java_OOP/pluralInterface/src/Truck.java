public class Truck implements Audible, PhysicsObject {
	private double weightKg;

	public Truck(double weightKg) {
		this.weightKg = weightKg;
	}

	public String toString() {
		return "This is a truck that weights: " + this.weightKg + "kg";
	}

	public void makeNoise() {
		System.out.println("Beep Beep!!");
	}

	public double soundFrequency() {
		return 165;
	}

	public double soundLevel() {
		return 120;
	}

	public double workToMove(double m) {
		return 0.5 * m * m;
	};

	public double density() {
		return 1000;
	};

	public double weight(double gravity) {
		return this.weightKg * gravity;
	};

}