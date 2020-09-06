package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.OrderListDTO;
import ohyes.coffee.dto.ProductDTO;

public class MypageDAO extends JdbcDAO{
	private static MypageDAO _dao;
	
	private MypageDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new MypageDAO();
	}
	
	public static MypageDAO getDAO() {
		return _dao;
	}
	//마이페이지에서 주문내역 조회를 위한 메소드 
	public List<OrderListDTO> selectOrderAll(String memId){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<OrderListDTO> orderList=new ArrayList<OrderListDTO>();
		try {
			con=getConnection();
			//String sql="select M.mem_name, M.mem_id mem_id, o.orderdetail_p_no, o.order_p_amount ,p.order_no order_no, p.order_total_cost, p.order_status, p.order_date , pd.p_name " + 
				//	" from member M,order_detail O,order_pay P, product pd where m.mem_id = p.order_mem_id and p.order_no = o.order_no and pd.p_no = o.orderdetail_p_no and mem_id = ? order by p.order_no desc";
			String sql = "select DISTINCT p.order_no order_no ,M.mem_name, M.mem_id mem_id, p.order_total_cost, p.order_status, p.order_date , p.order_recv_name " +
			  " from member M,order_detail O,order_pay P where m.mem_id = p.order_mem_id and p.order_no = o.order_no and mem_id = ? order by p.order_no desc";
			
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, memId);
					rs=pstmt.executeQuery();
					
					while(rs.next()) {
						OrderListDTO order=new OrderListDTO();
						order.setMemName(rs.getString("mem_name"));
						order.setMemID(rs.getString("mem_id"));
						//order.setOrderdetailPNo(rs.getInt("orderdetail_p_no"));
						//order.setOrderPAmount(rs.getInt("order_p_amount"));
						order.setOrderNo(rs.getString("order_no"));
						order.setOrderTotalCost(rs.getInt("order_total_cost"));
						order.setOrderStatus(rs.getInt("order_status"));
						order.setOrderDate(rs.getString("order_date"));
						//order.setpName(rs.getString("p_name"));
						order.setRecvName(rs.getString("order_recv_name"));
						orderList.add(order);
						
						
						
					}
		} catch (Exception e) {
			System.out.println("[에러]selectOrderAll() 메소드의 SQL 오류 : "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return orderList;
		
	}
	
	public int selectOrderAll2(String orderNo){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;

		int result = 0;
		
		try {
			con=getConnection();
			String sql = "select sum(order_detail.order_p_amount) total_amount from order_pay inner join order_detail on order_pay.order_no = order_detail.order_no where order_pay.order_no = ?";
				
			pstmt=con.prepareStatement(sql);
					pstmt.setString(1, orderNo);
					rs=pstmt.executeQuery();
					
					if(rs.next()) {
						result = rs.getInt("total_amount");
					}
					
		} catch (Exception e) {
			System.out.println("[에러]selectOrderAll() 메소드의 SQL 오류 : "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return result;
		
	}
	
	public List<OrderListDTO> selectOrderAll3(String memId, String orderNO){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<OrderListDTO> orderList=new ArrayList<OrderListDTO>();
		try {
			con=getConnection();
			//String sql="select M.mem_name, M.mem_id mem_id, o.orderdetail_p_no, o.order_p_amount ,p.order_no order_no, p.order_total_cost, p.order_status, p.order_date , pd.p_name " + 
				//	" from member M,order_detail O,order_pay P, product pd where m.mem_id = p.order_mem_id and p.order_no = o.order_no and pd.p_no = o.orderdetail_p_no and mem_id = ? order by p.order_no desc";
			String sql = "select DISTINCT p.order_no order_no, pd.p_name , o.orderdetail_p_no ,M.mem_name, M.mem_id mem_id, o.order_p_amount , p.order_total_cost, p.order_status, p.order_date " +
			  " from member M,order_detail O,order_pay P, product pd where m.mem_id = p.order_mem_id and p.order_no = o.order_no and pd.p_no = o.orderdetail_p_no and mem_id = ? and p.order_no = ? order by p.order_no desc";
			
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, memId);
					pstmt.setString(2, orderNO);
					rs=pstmt.executeQuery();
					
					while(rs.next()) {
						OrderListDTO order=new OrderListDTO();
						order.setMemName(rs.getString("mem_name"));
						order.setMemID(rs.getString("mem_id"));
						order.setOrderdetailPNo(rs.getInt("orderdetail_p_no"));
						order.setOrderPAmount(rs.getInt("order_p_amount"));
						order.setOrderNo(rs.getString("order_no"));
						order.setOrderTotalCost(rs.getInt("order_total_cost"));
						order.setOrderStatus(rs.getInt("order_status"));
						order.setOrderDate(rs.getString("order_date"));
						order.setpName(rs.getString("p_name"));
						orderList.add(order);
						
						
						
					}
		} catch (Exception e) {
			System.out.println("[에러]selectOrderAll() 메소드의 SQL 오류 : "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return orderList;
		
	}

	public ProductDTO getProductImage(int pno) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		ProductDTO product = null;
		try {
			con=getConnection();
			String sql = "select * from product where p_no = ?";
				
			pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, pno);
					rs=pstmt.executeQuery();
					
					if(rs.next()) {
						product = new ProductDTO();
						product.setpImage(rs.getString("p_image"));
					}
					
		} catch (Exception e) {
			System.out.println("[에러]selectOrderAll() 메소드의 SQL 오류 : "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return product;
	}
}

	
	


