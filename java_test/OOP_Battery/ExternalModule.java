package oop_battery;

public class ExternalModule {
	public static void dangerousMethod(String customerId, Battery7v battery) {
		System.out.println("Processing data....internals");
		System.out.println("Client " + customerId + " purchased a " + battery.toString());
		// battery.manufacturedCount += 4234;
	}

	public static void otherDangerousMethod() {
		// Battery7v.manufacturedCount += 10000;
	}
}