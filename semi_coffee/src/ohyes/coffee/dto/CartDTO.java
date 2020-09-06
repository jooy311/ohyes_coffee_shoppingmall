package ohyes.coffee.dto;

/*

이름                 널?       유형           
------------------ -------- ------------ 
CART_NO     NOT NULL NUMBER       
CART_MEM_ID NOT NULL VARCHAR2(12) 
CART_P_NO   NOT NULL VARCHAR2(6)  
CART_AMOUNT NOT NULL NUMBER   
 */

public class CartDTO {
	private int cartNo;
	private String cartMemId;
	private String cartPNo;
	private int cartAmount;
	
	public CartDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getCartNo() {
		return cartNo;
	}

	public void setCartNo(int cartNo) {
		this.cartNo = cartNo;
	}

	public String getCartMemId() {
		return cartMemId;
	}

	public void setCartMemId(String cartMemId) {
		this.cartMemId = cartMemId;
	}

	public String getCartPNo() {
		return cartPNo;
	}

	public void setCartPNo(String cartPNo) {
		this.cartPNo = cartPNo;
	}

	public int getCartAmount() {
		return cartAmount;
	}

	public void setCartAmount(int cartAmount) {
		this.cartAmount = cartAmount;
	}
	
	
}
