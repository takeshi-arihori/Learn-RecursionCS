import java.util.ArrayList;

public class Company {
	// 企業は、できるだけ多くの従業員の雇用が可能です。
	// したがって、employeesは従業員のリストを保持するための動的配列です（多重度は*）
	private ArrayList<Employee> employees = new ArrayList<>(); // []

	// 会社は1-10名の役員で運営されています。
	// boardMembersは、会社の役員を表します。役員の数は最大10名です（多重度は1-10）
	private BoardMember[] boardMembers = new BoardMember[10];

	// 会社は親会社に属すことも、そうでないこともあります。
	// parentCompanyは親会社を表します。親会社がない場合はnullです（多重度は0-1）
	private Company parentCompany;

	// 会社は多くの子会社を所有することがあります。
	// subsidiariesは子会社のリストを保持するための動的配列です（多重度は*）
	private ArrayList<Company> subsidiaries = new ArrayList<>();

	public void addEmployee(Employee employee) {
		if (employee == null) {
			throw new IllegalArgumentException("Employee cannot be null");
		}
		this.employees.add(employee);
	}

	public void setBoardMember(BoardMember boardMember, int position) {
		this.boardMembers[position] = boardMember;
	}

	public void setParentCompany(Company company) {
		this.parentCompany = company;
	}

	public void addSubsidiary(Company company) {
		this.subsidiaries.add(company);
	}

	public ArrayList<Employee> getEmployee() {
		return this.employees;
	}

	public BoardMember[] getBoardMember() {
		return this.boardMembers;
	}

	public Company getParentCompany() {
		return this.parentCompany;
	}

	public ArrayList<Company> getSubsidiary() {
		return this.subsidiaries;
	}
}
