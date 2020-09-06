package ohyes.coffee.dto;
/*
 * 이름                 널?       유형            
------------------ -------- ------------- 
ORDER_NO           NOT NULL VARCHAR2(15)  
ORDER_MEM_ID       NOT NULL VARCHAR2(12)  
ORDER_RECV_NAME    NOT NULL VARCHAR2(10)  
ORDER_RECV_ADDRESS NOT NULL VARCHAR2(180) 
ORDER_RECV_PHONE   NOT NULL VARCHAR2(20)  
ORDER_DATE         NOT NULL DATE          
ORDER_STATUS                NUMBER(1)     
ORDER_TOTAL_COST   NOT NULL NUMBER        
ORDER_MESSAGE               VARCHAR2(200) 
 * 
 * */
public class OrderPayDTO {
	private String orderNo;
	private String orderMemId;
	private String orderRecvName;
	private String orderRecvAddress;
	private String orderRecvPhone;
	private String orderDate;
	private int orderStatus;
	private int orderTotalCost;
	private String orderMessage;
	
	public OrderPayDTO() {
		// TODO Auto-generated constructor stub
	}
	
	public String getOrderNo() {
		return orderNo;
	}
	public void setOrderNo(String orderNo) {
		this.orderNo = orderNo;
	}
	public String getOrderMemId() {
		return orderMemId;
	}
	public void setOrderMemId(String orderMemId) {
		this.orderMemId = orderMemId;
	}
	public String getOrderRecvName() {
		return orderRecvName;
	}
	public void setOrderRecvName(String orderRecvName) {
		this.orderRecvName = orderRecvName;
	}
	public String getOrderRecvAddress() {
		return orderRecvAddress;
	}
	public void setOrderRecvAddress(String orderRecvAddress) {
		this.orderRecvAddress = orderRecvAddress;
	}
	public String getOrderRecvPhone() {
		return orderRecvPhone;
	}
	public void setOrderRecvPhone(String orderRecvPhone) {
		this.orderRecvPhone = orderRecvPhone;
	}
	public String getOrderDate() {
		return orderDate;
	}
	public void setOrderDate(String orderDate) {
		this.orderDate = orderDate;
	}
	public int getOrderStatus() {
		return orderStatus;
	}
	public void setOrderStatus(int orderStatus) {
		this.orderStatus = orderStatus;
	}
	public int getOrderTotalCost() {
		return orderTotalCost;
	}
	public void setOrderTotalCost(int orderTotalCost) {
		this.orderTotalCost = orderTotalCost;
	}
	public String getOrderMessage() {
		return orderMessage;
	}
	public void setOrderMessage(String orderMessage) {
		this.orderMessage = orderMessage;
	}
	
}
