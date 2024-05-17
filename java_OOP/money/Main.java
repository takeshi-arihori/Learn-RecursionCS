package money;

class Main {
	public static void main(String[] args) {
		Person p = new Person("Ryu", "Poolhopper", 40, 1.8, 140);
		p.printState();

		p.wallet.insertBill(5, 3);
		p.wallet.insertBill(100, 2);

		p.printState();

		p.setDenominationPreference(DenominationPreference.HIGHEST_FIRST);
		int[] paidHighestFirst = p.getPaid(389);
		p.printState();
		System.out.println("Added bills (Highest First): " + java.util.Arrays.toString(paidHighestFirst));

		p.setDenominationPreference(DenominationPreference.DOLLARS);
		int[] paidDollars = p.getPaid(389);
		p.printState();
		System.out.println("Added bills (Dollars): " + java.util.Arrays.toString(paidDollars));

		p.setDenominationPreference(DenominationPreference.TWENTIES);
		int[] paidTwenties = p.getPaid(389);
		p.printState();
		System.out.println("Added bills (Twenties): " + java.util.Arrays.toString(paidTwenties));

		int[] spentMoney = p.spendMoney(50);
		p.printState();
		System.out.println("Spent bills: " + java.util.Arrays.toString(spentMoney));

		Wallet oldWallet = p.dropWallet();
		System.out.println("Dropped Wallet Total Money: " + oldWallet.getTotalMoney());
		p.printState();
	}
}

class Wallet {
	public int bill1;
	public int bill5;
	public int bill10;
	public int bill20;
	public int bill50;
	public int bill100;

	public Wallet() {
	}

	public int getTotalMoney() {
		return (1 * bill1) + (5 * bill5) + (10 * bill10) + (20 * bill20) + (50 * bill50) + (100 * bill100);
	}

	public int insertBill(int bill, int amount) {
		switch (bill) {
			case (1):
				bill1 += amount;
				break;
			case (5):
				bill5 += amount;
				break;
			case (10):
				bill10 += amount;
				break;
			case (20):
				bill20 += amount;
				break;
			case (50):
				bill50 += amount;
				break;
			case (100):
				bill100 += amount;
				break;
			default:
				return 0;
		}
		return bill * amount;
	}

	public int removeBill(int bill, int amount) {
		switch (bill) {
			case 1:
				bill1 -= amount;
				break;
			case 5:
				bill5 -= amount;
				break;
			case 10:
				bill10 -= amount;
				break;
			case 20:
				bill20 -= amount;
				break;
			case 50:
				bill50 -= amount;
				break;
			case 100:
				bill100 -= amount;
				break;
			default:
				return 0;
		}
		return bill * amount;
	}
}

enum DenominationPreference {
	HIGHEST_FIRST, DOLLARS, TWENTIES
}

class Person {
	public String firstName;
	public String lastName;
	public int age;
	public double heightM;
	public double weightKg;
	public Wallet wallet;
	private DenominationPreference denominationPreference;

	public Person(String firstName, String lastName, int age, double heightM, double weightKg) {
		this.firstName = firstName;
		this.lastName = lastName;
		this.age = age;
		this.heightM = heightM;
		this.weightKg = weightKg;
		this.wallet = new Wallet();
		this.denominationPreference = DenominationPreference.HIGHEST_FIRST;
	}

	public void setDenominationPreference(DenominationPreference preference) {
		this.denominationPreference = preference;
	}

	public int getCash() {
		if (this.wallet == null)
			return 0;
		return this.wallet.getTotalMoney();
	}

	public int[] getPaid(int amount) {
		int[] addedBills = new int[6];
		if (wallet == null)
			return addedBills;

		switch (denominationPreference) {
			case HIGHEST_FIRST:
				addedBills = addMoneyHighestFirst(amount);
				break;
			case DOLLARS:
				addedBills = addMoneyDollars(amount);
				break;
			case TWENTIES:
				addedBills = addMoneyTwenties(amount);
				break;
		}
		return addedBills;
	}

	private int[] addMoneyHighestFirst(int amount) {
		int[] addedBills = new int[6];
		int[] denominations = { 100, 50, 20, 10, 5, 1 };
		for (int i = 0; i < denominations.length; i++) {
			int count = amount / denominations[i];
			amount %= denominations[i];
			wallet.insertBill(denominations[i], count);
			addedBills[5 - i] = count; // Reverse order for array: index 0 for $1, index 5 for $100
		}
		return addedBills;
	}

	private int[] addMoneyDollars(int amount) {
		int[] addedBills = new int[6];
		wallet.insertBill(1, amount);
		addedBills[0] = amount;
		return addedBills;
	}

	private int[] addMoneyTwenties(int amount) {
		int[] addedBills = new int[6];
		int twentiesCount = amount / 20;
		int remainder = amount % 20;
		wallet.insertBill(20, twentiesCount);
		addedBills[3] = twentiesCount;
		int[] highestFirstBills = addMoneyHighestFirst(remainder);
		for (int i = 0; i < highestFirstBills.length; i++) {
			addedBills[i] += highestFirstBills[i];
		}
		return addedBills;
	}

	public int[] spendMoney(int amount) {
		int[] removedBills = new int[6];
		if (wallet == null || wallet.getTotalMoney() < amount)
			return removedBills;

		// Use the same logic as getPaid to determine which bills to remove
		int[] denominations = { 100, 50, 20, 10, 5, 1 };
		for (int i = 0; i < denominations.length; i++) {
			int count = Math.min(amount / denominations[i], getBillCount(denominations[i]));
			amount -= count * denominations[i];
			wallet.removeBill(denominations[i], count);
			removedBills[5 - i] = count; // Reverse order for array: index 0 for $1, index 5 for $100
		}
		return removedBills;
	}

	private int getBillCount(int bill) {
		switch (bill) {
			case 1:
				return wallet.bill1;
			case 5:
				return wallet.bill5;
			case 10:
				return wallet.bill10;
			case 20:
				return wallet.bill20;
			case 50:
				return wallet.bill50;
			case 100:
				return wallet.bill100;
			default:
				return 0;
		}
	}

	public void addWallet(Wallet newWallet) {
		this.wallet = newWallet;
	}

	public Wallet dropWallet() {
		Wallet oldWallet = this.wallet;
		this.wallet = null;
		return oldWallet;
	}

	public void printState() {
		System.out.println("firstname - " + this.firstName);
		System.out.println("lastname - " + this.lastName);
		System.out.println("age - " + this.age);
		System.out.println("height - " + this.heightM);
		System.out.println("weight - " + this.weightKg);
		System.out.println("Current Money - " + this.getCash());
		System.out.println();
	}
}
