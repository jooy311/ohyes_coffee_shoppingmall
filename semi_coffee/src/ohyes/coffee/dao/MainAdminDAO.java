package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import com.sun.xml.internal.ws.Closeable;

import ohyes.coffee.dto.ProductDTO;

public class MainAdminDAO extends JdbcDAO{
	private static MainAdminDAO _dao;

	static {
		_dao = new MainAdminDAO();
	}

	public static MainAdminDAO getOrderPayAdminDAO() {
		return _dao;
	}
	
	//������ ���������� ���� �޼ҵ��
	public int countOrder(int status, boolean flag) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		int count = 0;
		String sql = "";
		
		try {
			con = getConnection();
			if(!flag) {//�ֱ��Ѵ�
				 sql = "select count(*) from order_pay where order_status = " + status + " and order_date >= TO_CHAR(SYSDATE-30,'YYYYMMDD')";
			}else {//����
				 sql = "select count(*) from order_pay where order_status = " + status + " and order_date >= TO_CHAR(SYSDATE,'YYYYMMDD')";
			}
			
			pstmt = con.prepareStatement(sql);
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				count = rs.getInt(1);// �˻������ 1�� �̹Ƿ�
			}
			
		}catch (SQLException e) {
			System.out.println("countOrder()���� �߻��ϴ� ���� " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return count;
		
	}
	
	public int countPay(boolean flag) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		int totalPay = 0;
		String sql = "";
		
		try {
			con = getConnection();
			if(!flag) {
				 sql = "select order_total_cost from order_pay where order_status = 1 and order_date >= TO_CHAR(SYSDATE-30,'YYYYMMDD')";
			}else {
				 sql = "select order_total_cost from order_pay where order_status = 1 and order_date >= TO_CHAR(SYSDATE,'YYYYMMDD')";
			}
			pstmt = con.prepareStatement(sql);
			
			rs = pstmt.executeQuery();
			
			while(rs.next()) {
				totalPay += rs.getInt("order_total_cost");
			}
			
			//System.out.println("���ֹ� ���� " + totalPay);
			
		}catch (SQLException e) {
			System.out.println("countPay()���� �߻��ϴ� ���� " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return totalPay;
	}

	
	//Ȩ������ ����ȭ�鿡 ��õ ��ǰ �߰� �ϱ� ���� �޼ҵ�
	public List<Integer> selectBestProduct(){
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		List<Integer> list = new ArrayList<Integer>();
		
		try {
			con = getConnection();
			
			String sql = "SELECT B.*" + 
					"  FROM ( SELECT ROWNUM RNUM" + 
					"              , A.*" + 
					"          FROM ( SELECT ORDERDETAIL_P_NO" + 
					"                      , COUNT(*) ORD_CNT" + 
					"                   FROM ORDER_DETAIL" + 
					"                  GROUP BY ORDERDETAIL_P_NO" + 
					"                  ORDER BY ORD_CNT ) A ) B" + 
					" WHERE B.RNUM <= 2";
			
			pstmt = con.prepareStatement(sql);
			
			rs = pstmt.executeQuery();
			
			while(rs.next()) {
				
				list.add(rs.getInt("ORDERDETAIL_P_NO"));
				
			}
			
		}catch (SQLException e) {
			System.out.println("MainAdminDAO�� selectBestProduct() �޼ҵ忡�� �߻��ϴ� ���� " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		//System.out.println(list.get(0));
		return  list;//�Ǹ�Ƚ���� ���� �ֻ��� �ΰ��� ��ǰ�ڵ�(��ȣ)�� �޾ƿ´�.
	}

	
	public ProductDTO selectBestProductInfo(int pNo) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		ProductDTO product = null;
		//System.out.println("�޾ƿ���??? " + pNo);
		try {
			con = getConnection();
			String sql = "select * from product where p_no = ?";
			
			pstmt = con.prepareStatement(sql);
			pstmt.setInt(1, pNo);
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				product = new ProductDTO();
				
				product.setpImage(rs.getString("p_image"));
				product.setpName(rs.getString("p_name"));
				product.setpCost(rs.getInt("p_cost"));
			}
			
		}catch (SQLException e) {
			System.out.println("MainAdminDAO���� selectBestProductInfo()������ ���� " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return product;
	}

}
