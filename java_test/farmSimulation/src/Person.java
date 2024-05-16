import java.util.ArrayList;
import java.util.List;

public class Person extends Mammal {
	private List<Animal> farmAnimals;
	private double income;

	public Person(String name, double heightM, double weightKg, double lifeSpanDays, String biologicalSex) {
		super(name, heightM, weightKg, lifeSpanDays, biologicalSex, 0, "None", 37.0);
		this.farmAnimals = new ArrayList<>();
		this.income = 0;
	}

	public void addAnimal(Animal animal) {
		farmAnimals.add(animal);
	}

	public void sellAnimal(Animal animal) {
		if (farmAnimals.remove(animal)) {
			if (animal instanceof Cow) {
				income += ((Cow) animal).getSellPrice();
			} else if (animal instanceof Horse) {
				income += ((Horse) animal).getSellPrice();
			} else if (animal instanceof Chicken) {
				income += ((Chicken) animal).getSellPrice();
			}
		}
	}

	public double getIncome() {
		return income;
	}

	@Override
	public String toString() {
		return "Person: " + super.toString() + ", Income: " + income;
	}
}
