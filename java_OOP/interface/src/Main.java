public class Main {
	public static void main(String[] args) {
		Bird bird = new Bird("Pigeon", 100, 10);
		bird.fly();
		System.out.println("Flight height: " + bird.flightHeight() + "m");
		System.out.println("Fly speed: " + bird.FlySpeed() + "m/s");

		System.out.println();

		Aircraft aircraft = new Aircraft("Boeing 747", 10000, 1000);
		aircraft.fly();
		System.out.println("Flight height: " + aircraft.flightHeight() + "m");
		System.out.println("Fly speed: " + aircraft.FlySpeed() + "m/s");

	}
}