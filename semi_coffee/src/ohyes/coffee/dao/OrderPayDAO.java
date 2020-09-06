package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.CartOrderDTO;
import ohyes.coffee.dto.OrderListDTO;
import ohyes.coffee.dto.OrderPayDTO;
import ohyes.coffee.dto.ProductDTO;


public class OrderPayDAO extends JdbcDAO{
private static OrderPayDAO _dao;
	
	public OrderPayDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new OrderPayDAO();
	}
	
	public static OrderPayDAO getOrderPayDAO() {
		return _dao;
	}
	
	public ProductDTO selectProductSingle(int pno){
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		ProductDTO product = null;// = new ProductDTO();
		
		try {
			con = getConnection();
			String sql = "select * from product where p_no = ?";
			pstmt = con.prepareStatement(sql);
			
			pstmt.setInt(1, pno);
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				product = new ProductDTO();
				
				product.setpName(rs.getString("p_name"));
				product.setpImage(rs.getString("p_image"));
				product.setpCost(rs.getInt("p_cost"));
				
			}
			
			
		}catch (SQLException e) {
			System.out.println("OrderPayDAO에서 selectProductSingle()메소드에서의 오류 ");
		}
		
		return product;
		
	}

	public int insertOrderPay(OrderListDTO orderList, String allAddress, String memPhone, String postMessage, String memName) {
		Connection con = null;
		PreparedStatement pstmt = null;
		//ResultSet rs = null;
		int rows = 0;
		
		try {
			con = getConnection();
			//주문
			String sql = "insert into order_pay values(?,?,?,?,?,?,1,?,?)";
			
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, orderList.getOrderNo());
			pstmt.setString(2, orderList.getMemID());
			pstmt.setString(3, memName);
			pstmt.setString(4, allAddress);
			pstmt.setString(5, memPhone);
			pstmt.setString(6, orderList.getOrderDate());
			pstmt.setInt(7, orderList.getOrderTotalCost());
			pstmt.setString(8, postMessage);
			
			rows = pstmt.executeUpdate();
			
			
		} catch (SQLException e) {
			System.out.println("OrderPayDAO에서 insertOrderPayToMember() 메소드에서의 오류 " + e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public int insertOrderDetail(OrderListDTO orderList, String allAddress, String memPhone, String postMessage, String memName, int singleProductCount) {
		Connection con = null;
		PreparedStatement pstmt = null;
		//ResultSet rs = null;
		int rows = 0;
		
		try {
			con = getConnection();
			//주문
			String sql = "insert into order_detail values(orderDetail_seq.nextval,?,?,?)";
			
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, orderList.getOrderNo());
			pstmt.setInt(2, orderList.getOrderdetailPNo());
			pstmt.setInt(3, singleProductCount);
			
			rows = pstmt.executeUpdate();
			
			
		} catch (SQLException e) {
			System.out.println("OrderPayDAO에서 insertOrderDetail() 메소드에서의 오류 " + e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}

	
	public CartOrderDTO selectCartToPay(String memId, int pno){
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		 //List<CartOrderDTO> list = new ArrayList<CartOrderDTO>();
		CartOrderDTO dto = null;
		
		 try {
			 con = getConnection();
			 String sql = "select p.p_name, p.p_image, c.cart_amount, p.p_cost, c.cart_p_no from cart c, product p where c.cart_p_no = p.p_no and cart_mem_id = ? and p_no = ?";
			 pstmt = con.prepareStatement(sql);
			 
			 pstmt.setString(1, memId);
			 pstmt.setInt(2, pno);
			 
			 rs = pstmt.executeQuery();
			 
			 while(rs.next()) {
				 dto = new CartOrderDTO();
				 
				 dto.setpNo(rs.getInt("cart_p_no"));
				 dto.setpName(rs.getString("p_name"));
				 dto.setpImage(rs.getString("p_image"));
				 dto.setpCost(rs.getInt("p_cost"));
				 dto.setCartAmount(rs.getInt("cart_amount"));
				 
				// list.add(dto);
			 }
			 
		 }catch (SQLException e) {
			System.out.println("OrderPayDAO의 selectCartToPay()메소드에서의 오류 " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		 return dto;
	}
	
}
