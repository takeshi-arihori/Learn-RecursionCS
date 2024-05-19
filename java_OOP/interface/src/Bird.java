public class Bird implements Fly {
	private String name;
	private double flightHeight;
	private double flySpeed;

	public Bird(String name, double flightHeight, double flySpeed) {
		this.name = name;
		this.flightHeight = flightHeight;
		this.flySpeed = flySpeed;
	}

	public void fly() {
		System.out.println(this.name + " is flying.");
	}

	public double flightHeight() {
		return this.flightHeight;
	}

	public double FlySpeed() {
		return this.flySpeed;
	}
}
