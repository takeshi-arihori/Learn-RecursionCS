
class Main {
	public static void personInteractsWithObject(Person p, Audible noiseObject) {
		System.out.println(p + " will interact with " + noiseObject + " and cause it to make a noise");
		noiseObject.makeNoise();
		System.out.println("The noise was made at " + noiseObject.soundFrequency() + "Hz at a level of "
				+ noiseObject.soundLevel() + "dB");
		System.out.println();
	}

	public static void personEatsEdible(Person p, Edible rawFood) {
		System.out.println(p + " will preparœe and eat :" + rawFood + ". They do the following:" + rawFood.howToPrepare());
		System.out.println("The person prepared and ate the meal. " + rawFood.calories() + " calories consumed.");
		System.out.println();
	}

	public static void main(String[] args) {
		Person ashley = new Person("Ashley", "William", 1.8, 110, 29);

		Person obj1 = new Person("Toshi", "Takemura", 1.7, 105, 41);
		Horse obj2 = new Horse(450);
		Cow obj3 = new Cow(1300);
		Truck obj4 = new Truck(3230.5);
		Violin obj5 = new Violin();

		personInteractsWithObject(ashley, obj1);
		personInteractsWithObject(ashley, obj2);

		personInteractsWithObject(ashley, obj3);
		personEatsEdible(ashley, obj3);

		personInteractsWithObject(ashley, obj4);
		personInteractsWithObject(ashley, obj5);

	}
}