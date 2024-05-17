// 役員は1-5社の会社を管理します。
public class BoardMember {
	// companiesManagingは、役員が管理している会社の配列です。
	// 役員は最大で5つの会社を管理できます（多重度は1-5）
	private Company[] companiesManaging = new Company[5];

	public void setCompany(Company company, int position) {
		this.companiesManaging[position] = company;
	}
}