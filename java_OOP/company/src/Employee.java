// 従業員は1人につき、1-2社に勤務にします。
public class Employee {
	// 従業員は最大で2つの会社で働くことができます（多重度は1-2）
	private Company mainJob;
	private Company secondJob;

	public Employee(Company mainJob, Company secondJob) {
		this.mainJob = mainJob;
		this.secondJob = secondJob;
	}

	public Employee(Company mainJob) {
		this.mainJob = mainJob;
	}

	public Company getMainJob() {
		return this.mainJob;
	}

	public Company getSecondJobs() {
		return this.secondJob;
	}

	public void setMainJob(Company company) {
		this.mainJob = company;
	}

	public void setSecondJobs(Company company) {
		this.secondJob = company;
	}
}