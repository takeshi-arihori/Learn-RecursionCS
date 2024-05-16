import java.util.ArrayList;

class Main {
	public static void main(String[] args) {
		Company company1 = new Company();
		Company company2 = new Company();

		// 社員は2つの会社で働いている
		Employee employee = new Employee(company1, company2);

		company1.addEmployee(employee);
		company2.addEmployee(employee);

		// 会社1に役員がいる
		BoardMember boardMember = new BoardMember();
		company1.setBoardMember(boardMember, 0);

		// 役員は会社2も管理している
		boardMember.setCompany(company2, 0);

		// 会社1は親会社で、会社2は子会社
		company1.addSubsidiary(company2);
		company2.setParentCompany(company1);

		System.out.println("Company 1 Employees: " + company1);

		// 会社1の従業員を取得
		ArrayList<Employee> employees = company1.getEmployee();
		for (Employee e : employees) {
			System.out.println("Employee: " + e);
		}
	}
}
