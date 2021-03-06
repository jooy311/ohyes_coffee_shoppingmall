package ohyes.coffee.dto;
/*
 * M.mem_name, M.mem_id, o.orderdetail_p_no,o.order_p_amount ,p.order_no, p.order_total_cost, p.order_status
 * */
public class OrderListDTO {
	private String memName;
	private String memID;
	private int orderdetailPNo;//상품번호
	private int orderPAmount;//주문된 상품의 갯수(각 상품의 갯수)
	private String orderNo;
	private int orderTotalCost;//주문된 총 가격
	private int orderStatus;
	private String orderDate;
	private String pName;//상품의 이름
	private int pCost;//상품의 가격	
	private String recvName;

	public OrderListDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getMemName() {
		return memName;
	}

	public void setMemName(String memName) {
		this.memName = memName;
	}

	public String getMemID() {
		return memID;
	}

	public void setMemID(String memID) {
		this.memID = memID;
	}

	public int getOrderdetailPNo() {
		return orderdetailPNo;
	}

	public void setOrderdetailPNo(int orderdetailPNo) {
		this.orderdetailPNo = orderdetailPNo;
	}

	public int getOrderPAmount() {
		return orderPAmount;
	}

	public void setOrderPAmount(int orderPAmount) {
		this.orderPAmount = orderPAmount;
	}

	public String getOrderNo() {
		return orderNo;
	}

	public void setOrderNo(String orderNo) {
		this.orderNo = orderNo;
	}

	public int getOrderTotalCost() {
		return orderTotalCost;
	}

	public void setOrderTotalCost(int orderTotalCost) {
		this.orderTotalCost = orderTotalCost;
	}

	public int getOrderStatus() {
		return orderStatus;
	}

	public void setOrderStatus(int orderStatus) {
		this.orderStatus = orderStatus;
	}
	
	public String getOrderDate() {
		return orderDate;
	}

	public void setOrderDate(String orderDate) {
		this.orderDate = orderDate;
	}

	public String getpName() {
		return pName;
	}

	public void setpName(String pName) {
		this.pName = pName;
	}

	public int getpCost() {
		return pCost;
	}

	public void setpCost(int pCost) {
		this.pCost = pCost;
	}

	public String getRecvName() {
		return recvName;
	}

	public void setRecvName(String recvName) {
		this.recvName = recvName;
	}
		
	
	
}
