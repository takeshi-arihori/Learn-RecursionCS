public class Main {
	public static void main(String[] args) {
		Person farmer = new Person("John Doe", 1.75, 70, 29200, "male");

		Cow cow = new Cow(1.5, 500, 3650, "female", 1.0, "Short", 37.5, 20);
		Horse horse = new Horse(1.6, 600, 3650, "male", 1.0, "Short", 37.5, 60);
		Chicken chicken = new Chicken(0.5, 2.5, 365, "female", 0.5, 10);

		farmer.addAnimal(cow);
		farmer.addAnimal(horse);
		farmer.addAnimal(chicken);

		System.out.println(farmer);
		System.out.println();

		System.out.println(cow);
		System.out.println();
		System.out.println(horse);
		System.out.println();
		System.out.println(chicken);
		System.out.println();

		// Test income generation
		farmer.sellAnimal(cow);
		farmer.sellAnimal(horse);
		farmer.sellAnimal(chicken);

		System.out.println("Income after selling animals: " + farmer.getIncome());
	}
}
