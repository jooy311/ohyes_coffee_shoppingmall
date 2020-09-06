package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import ohyes.coffee.dto.QnaCoDTO;

public class QnaCoAdminDAO extends JdbcDAO {

	private static QnaCoAdminDAO _dao;
	
	public QnaCoAdminDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new QnaCoAdminDAO();
	}
	
	public static QnaCoAdminDAO getDAO() {
		return _dao;
	}
	
	/** ����� : �亯�ޱ� **/
	public int insertQnaCoAdmin(int refNo, String content) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		
		try {
			con=getConnection();
			
			String sql="insert into QNA_comment values(?, sysdate, ?)";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, refNo);
			pstmt.setString(2, content);
			
			rows=pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("[����]insertQnaCoAdmin() �޼ҵ��� SQL ���� : "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	/** �� ���� : **/
	public int updateQnaCoAdmin(int refNo, String content) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		
		try {
			con=getConnection();
			
			String sql="update QNA_comment set qnaco_content=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, content);
			
			rows=pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("[����]upadateQnaCoAdmin() �޼ҵ��� SQL ���� : "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	/** �� ���� : **/
	public int deleteQnaCoAdmin(int refNo) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		
		try {
			con=getConnection();
			
			String sql="delete from QNA_comment where qnaco_refno=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, refNo);
			
			rows=pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("[����]deleteQnaCoAdmin() �޼ҵ��� SQL ���� : "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	
	
	/** ������˻� : �θ�۹�ȣ => �亯DTO**/
	public QnaCoDTO selectQnaCoAdmin(int refNo) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		QnaCoDTO qnaCo=null;
		
		try {
			con=getConnection();
			
			String sql="select * from QNA_comment where qnaco_refno=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, refNo);
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				qnaCo=new QnaCoDTO();
				qnaCo.setQnaCoRefNo(rs.getInt("qnaco_refno"));
				qnaCo.setQnaCoDate(rs.getString("qnaco_date"));
				qnaCo.setQnaCoContent(rs.getString("qnaco_content"));
			}
			
		} catch (SQLException e) {
			System.out.println("[���� selectQnaCoAdmin() �޼ҵ��� SQL ���� : "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return qnaCo;
	}
	
	
	
	
	
}
