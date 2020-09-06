package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.CartDTO;

public class CartDAO extends JdbcDAO {
	private static CartDAO _dao;
	
	public CartDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new CartDAO();
	}
	
	public static CartDAO getDAO() {
		return _dao;
	}
	
	public int cartNextNum() {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int nuxtNum=0;
		try {
			con=getConnection();
			
			String sql="select cart_seq.nextval from dual";
			pstmt=con.prepareStatement(sql);
			
			rs=pstmt.executeQuery();
			while(rs.next()) {
				nuxtNum=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[에러]cartNextNum() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return nuxtNum;
	}
	
	public int insertCart(CartDTO cart) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="insert into cart values(?, ?, ?, ?)";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, cart.getCartNo());
			pstmt.setString(2, cart.getCartMemId());
			pstmt.setString(3, cart.getCartPNo());
			pstmt.setInt(4, cart.getCartAmount());
			
			rows=pstmt.executeUpdate();	
		} catch (SQLException e) {
			System.out.println("[에러]insertCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public int updateCart(int amount, int no) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			String sql="update cart set cart_amount=? where cart_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, amount);
			pstmt.setInt(2, no);
			
			rows=pstmt.executeUpdate();			
		} catch (SQLException e) {
			System.out.println("[에러]updateCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		} return rows;
	}
	
	public int removeCart(int no, String memId) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			String sql="delete cart where cart_no=? and cart_mem_id=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, no);
			pstmt.setString(2, memId);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]removeCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		} return rows;
	}
	
	public int removeAllCart(String memId){
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			String sql="delete cart where cart_mem_id=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, memId);
			
			rows=pstmt.executeUpdate();			
		} catch (SQLException e) {
			System.out.println("[에러]removeAllCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		} return rows;
	}
	
	//제품정보를 전달받아 장바구니 상품을 출력하는 메소드
	public CartDTO selectNumCart(String pNo, String memId) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		CartDTO cart=null;
		try {
			con=getConnection();
			String sql="select * from cart where cart_p_no=? and cart_mem_id=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, pNo);
			pstmt.setString(2, memId);
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				cart=new CartDTO();
				cart.setCartNo(rs.getInt("cart_no"));
				cart.setCartMemId(rs.getString("cart_mem_id"));
				cart.setCartPNo(rs.getString("cart_p_no"));
				cart.setCartAmount(rs.getInt("cart_amount"));
			}
		} catch (SQLException e) {
			System.out.println("[에러]selectNumCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt,rs);
		} return cart;
	}
	
	//멤버아이디를 전달받아 장바구니에 저장된 정보를 반환하는 메소드
	public List<CartDTO> selectAllCart(String memId) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<CartDTO> cartList=new ArrayList<CartDTO>();
		try {
			con=getConnection();
			
			String sql="select * from cart where cart_mem_id=? order by cart_no";
			
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, memId);
			
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				CartDTO cart=new CartDTO();
				cart.setCartNo(rs.getInt("cart_no"));
				cart.setCartMemId(rs.getString("cart_mem_id"));
				cart.setCartPNo(rs.getString("cart_p_no"));
				cart.setCartAmount(rs.getInt("cart_amount"));
				cartList.add(cart);
			}
		} catch (SQLException e) {
			System.out.println("[에러]selectAllCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt,rs);
		}
		return cartList;
	}
	
	public List<CartDTO> selectCheckedCart(String memId, int pno) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<CartDTO> cartList=new ArrayList<CartDTO>();
		try {
			con=getConnection();
			
			String sql="select * from cart where cart_mem_id=? and p_no = ?";
			
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, memId);
			pstmt.setInt(2, pno);
			
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				CartDTO cart=new CartDTO();
				cart.setCartNo(rs.getInt("cart_no"));
				cart.setCartMemId(rs.getString("cart_mem_id"));
				cart.setCartPNo(rs.getString("cart_p_no"));
				cart.setCartAmount(rs.getInt("cart_amount"));
				cartList.add(cart);
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]selectAllCart() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt,rs);
		}
		return cartList;
	}
	
}
