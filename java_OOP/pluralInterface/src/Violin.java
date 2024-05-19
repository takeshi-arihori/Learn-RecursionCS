public class Violin implements Audible {

	private double soundFrequency = 659.3;
	private final static double SOUND_DECIBELS = 95;

	public String toString() {
		return "This is a violin that plays music: ";
	}

	public void makeNoise() {
		System.out.println("Beep Beep!!");
	}

	public double soundFrequency() {
		return this.soundFrequency;
	}

	public double soundLevel() {
		return Violin.SOUND_DECIBELS;
	}
}