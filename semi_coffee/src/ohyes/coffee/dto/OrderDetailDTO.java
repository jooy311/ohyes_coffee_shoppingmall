package ohyes.coffee.dto;

/*이름               널?       유형           
---------------- -------- ------------ 
ORDER_DETAIL_NO  NOT NULL NUMBER       
ORDER_NO         NOT NULL VARCHAR2(15) 
ORDERDETAIL_P_NO NOT NULL VARCHAR2(6)  
ORDER_P_AMOUNT   NOT NULL NUMBER       */

public class OrderDetailDTO {
	private int orderDetailNo;
	private String orderNo;
	private String orderDetailPNo;
	private int orderPAmount;
	
	public OrderDetailDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getOrderDetailNo() {
		return orderDetailNo;
	}

	public void setOrderDetailNo(int orderDetailNo) {
		this.orderDetailNo = orderDetailNo;
	}

	public String getOrderNo() {
		return orderNo;
	}

	public void setOrderNo(String orderNo) {
		this.orderNo = orderNo;
	}

	public String getOrderDetailPNo() {
		return orderDetailPNo;
	}

	public void setOrderDetailPNo(String orderDetailPNo) {
		this.orderDetailPNo = orderDetailPNo;
	}

	public int getOrderPAmount() {
		return orderPAmount;
	}

	public void setOrderPAmount(int orderPAmount) {
		this.orderPAmount = orderPAmount;
	}
	
	
}
