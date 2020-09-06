package ohyes.coffee.pagination;

public class ProductSearch extends Page{
	private String selectedNameOrNo;
	private String productKeyword;
	private String selectedCategory;
	//private String selectedCategoryName;
	private String fordays;
	
	public ProductSearch() {
		// TODO Auto-generated constructor stub
	}

	public String getSelectedNameOrNo() {
		return selectedNameOrNo;
	}

	public void setSelectedNameOrNo(String selectedNameOrNo) {
		this.selectedNameOrNo = selectedNameOrNo;
	}

	public String getProductKeyword() {
		return productKeyword;
	}

	public void setProductKeyword(String productKeyword) {
		this.productKeyword = productKeyword;
	}


	public String getSelectedCategory() {
		return selectedCategory;
	}

	public void setSelectedCategory(String selectedCategory) {
		this.selectedCategory = selectedCategory;
	}

	public String getFordays() {
		return fordays;
	}

	public void setFordays(String fordays) {
		this.fordays = fordays;
	}
	
	
	
	
}
