class Mammal extends Animal {
	private double furLengthCm;
	private String furType;
	private int toothCounter;
	private double bodyTemperatureC;
	private double avgBodyTemperatureC;
	private boolean mammaryGland = false;
	private boolean sweatGland = true;
	private boolean isPregnant = false;

	public Mammal(String species, double heightM, double weightKg, double lifeSpanDays, String biologicalSex,
			double furLengthCm, String furType, double avgBodyTemperatureC) {
		super(species, heightM, weightKg, lifeSpanDays, biologicalSex);
		this.furLengthCm = furLengthCm;
		this.furType = furType;
		this.mammaryGland = biologicalSex.equals("female");
		this.avgBodyTemperatureC = avgBodyTemperatureC;
		this.bodyTemperatureC = this.avgBodyTemperatureC;
	}

	public void sweat() {
		if (!this.isAlive())
			return;
		if (this.sweatGland)
			System.out.print("Sweating....");
		this.bodyTemperatureC -= 0.3;
		System.out.print("Body temperature is now " + this.bodyTemperatureC + "C");
		System.out.println();
	}

	public void produceMilk() {
		if (!this.isAlive())
			return;
		if (this.isPregnant() && this.mammaryGland)
			System.out.println("Producing milk...");
		else
			System.out.println("Cannot produce milk");
		System.out.println();
	}

	public void mate(Mammal mammal) {
		if (!this.isAlive())
			return;
		if (!this.species.equals(mammal.species))
			return;
		if (this.biologicalSex.equals("female") && mammal.biologicalSex.equals("male"))
			this.fertalize();
		else if (this.biologicalSex.equals("male") && mammal.biologicalSex.equals("female"))
			mammal.fertalize();
	}

	public void fertalize() {
		if (!this.isAlive())
			return;
		this.isPregnant = true;
	}

	public boolean isPregnant() {
		if (!this.isAlive())
			return false;
		return this.isPregnant;
	}

	public void bite() {
		if (!this.isAlive())
			return;
		System.out.println(this.species + " bites with their single lower jaws which has"
				+ (this.toothCounter == 0 ? " not" : "") + " replaced its teeth: " + (this.toothCounter > 0));
		System.out.println();
	}

	public void replaceTeeth() {
		if (!this.isAlive())
			return;
		if (this.toothCounter == 0)
			this.toothCounter++;
	}

	public void increaseBodyHeat(double celcius) {
		this.bodyTemperatureC += celcius;
	}

	public void decreaseBodyHeat(double celcius) {
		this.bodyTemperatureC -= celcius;
	}

	public void adjustBodyHeat() {
		this.bodyTemperatureC = this.avgBodyTemperatureC;
	}

	@Override
	public void move() {
		if (!this.isAlive())
			return;
		System.out.println("This mammal is moving.....");
		System.out.println();
	}

	@Override
	public String toString() {
		return super.toString() + this.mammalInformation();
	}

	public String mammalInformation() {
		return "This is a mammal with the following - " + "fur:" + this.furType + "/teethReplaced:"
				+ (this.toothCounter > 0) + "/Pregnant:" + this.isPregnant() + "/Body Temperature:" + this.bodyTemperatureC;
	}

	@Override
	public void eat() {
		super.eat();
		this.bite();
		System.out.println("this " + this.species + " is eating with its single lower jaw");
	}
}
