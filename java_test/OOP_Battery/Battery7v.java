package OOP_Battery;

public class Battery7v {
	// 要件に応じてprivateに設定してください。
	private String manufacturer;
	private String model;
	private static final double VOLTAGE = 7.2;
	private static final String TYPE = "Lithium-Ion";
	private static int manufacturedCount;
	private double ampHours;
	private double weightKg;
	private double[] dimensionMm;

	public Battery7v(String manufacturer, String model, double ampHours, double weightKg, double wMm, double hMm,
			double dMm) {
		this.manufacturer = manufacturer;
		this.model = model;
		this.ampHours = ampHours;
		this.weightKg = weightKg;
		this.dimensionMm = new double[] { wMm, hMm, dMm };
		Battery7v.manufacturedCount += 1;
	}

	// ゲッターとセッターの作成が必要です。

	public String toString() {
		return this.manufacturer + " " + this.model + " " + Battery7v.TYPE + " Battery: " + this.getPowerCapacity() + "Wh ("
				+ Battery7v.VOLTAGE + "V/" + this.ampHours + "Ah) - " + this.dimensionMm[0] + "(W)x" + this.dimensionMm[1]
				+ "(H)x" + this.dimensionMm[2] + "(D) " + this.getVolume() + " volume " + this.weightKg + "kg";
	}

	public String getManufacturer() {
		return manufacturer;
	}

	public String getModel() {
		return model;
	}

	public static double getVoltage() {
		return VOLTAGE;
	}

	public static String getType() {
		return TYPE;
	}

	public static int getManufacturedCount() {
		return manufacturedCount;
	}

	public double getAmpHours() {
		return ampHours;
	}

	public void setAmpHours(double ampHours) {
		this.ampHours = ampHours;
	}

	public double getWeightKg() {
		return weightKg;
	}

	public void setWeightKg(double weightKg) {
		this.weightKg = weightKg;
	}

	public double[] getDimensionMm() {
		return dimensionMm;
	}

	public void setDimensionMm(double[] dimensionMm) {
		this.dimensionMm = dimensionMm;
	}

	public double getPowerCapacity() {
		return Battery7v.VOLTAGE * this.ampHours;
	}

	public double getVolume() {
		return this.dimensionMm[0] * this.dimensionMm[1] * this.dimensionMm[2];
	}
}