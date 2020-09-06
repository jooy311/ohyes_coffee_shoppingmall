package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.NoticeDTO;

public class NoticeAdminDAO extends JdbcDAO {
	
	private static NoticeAdminDAO _dao;
	
	private NoticeAdminDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new NoticeAdminDAO();
	}
	
	public static NoticeAdminDAO getDAO() {
		return _dao;
	}
	
	/**����ʵ�**/
	public final static int UPDATE=9;
	public final static int DELETE=0;
	public final static int SAVE_ONLY=1;
	public final static int SAVE_AND_SUBMIT=2;
	
	
	/** ������ select (������) : ����� �˻� **/
	public List<NoticeDTO> selectNoticeAdminAll(){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<NoticeDTO> noticeList=new ArrayList<NoticeDTO>();
		
		try {
			con=getConnection();
			
			String sql="select * from notice where notice_status in (1,2) order by notice_no";
			pstmt=con.prepareStatement(sql);
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				NoticeDTO notice=new NoticeDTO();
				notice.setNoticeNo(rs.getInt("notice_no"));
				notice.setNoticeTitle(rs.getString("notice_title"));
				notice.setNoticeContents(rs.getString("notice_contents"));
				notice.setNoticeDate(rs.getString("notice_date"));
				notice.setNoticeReadcount(rs.getInt("notice_readcount"));
				notice.setNoticeStatus(rs.getInt("notice_status"));
				
				noticeList.add(notice);
			}
			
		} catch (SQLException e) {
			System.out.println("[����] selectNoticeAdminAll() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return noticeList;
	}
	
	/** ������ select : �۹�ȣ => DTO**/
	public NoticeDTO selectNoticeAdminNo(int noticeNo){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		NoticeDTO notice=null;
		
		try {
			con=getConnection();
			
			String sql="select * from Notice where notice_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, noticeNo);

			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				notice=new NoticeDTO();
				notice.setNoticeNo(rs.getInt("notice_no"));
				notice.setNoticeTitle(rs.getString("notice_title"));
				notice.setNoticeContents(rs.getString("notice_contents"));
				notice.setNoticeDate(rs.getString("notice_date"));
				notice.setNoticeReadcount(rs.getInt("notice_readcount"));
				notice.setNoticeStatus(rs.getInt("notice_status"));
			}
			
		} catch (SQLException e) {
			System.out.println("[����] selectNoticeAdminNo() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return notice;
	}
	
	
	
	/** ������ insert : DTO => int **/
	public int insertNoticeAdmin(NoticeDTO notice) {
			Connection con=null;
			PreparedStatement pstmt=null;
			int row=0;
			
			try {
				con=getConnection();
				
				String sql="insert into notice values(?, ?, ?, sysdate, ?, 1)";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, notice.getNoticeNo());
				pstmt.setString(2,  notice.getNoticeTitle());
				pstmt.setString(3, notice.getNoticeContents());
				pstmt.setInt(4, notice.getNoticeReadcount());
				
				pstmt.executeUpdate();
				
			} catch (SQLException e) {
				System.out.println("[����] insertNotice() �޼ҵ��� SQL ���� : " + e.getMessage());
			} finally {
				close(con, pstmt);
			}
			return row;
	}
	
	/** ������ select : ���� ������ ��ȣ **/
	public int selectNextNo() {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int nextNo=0;
		
		try {
			con=getConnection();
			
			String sql="select notice_seq.nextval from dual";
			pstmt=con.prepareStatement(sql);
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				nextNo=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[����] selectNextNo() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return nextNo;
		
	}

	/** ������ update :  **/
	public int updateNoticeAdmin(NoticeDTO notice, final int noticeStatus) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int row=0;
		
		try {
			con=getConnection();
			
			if(noticeStatus==UPDATE) {
				String sql="update Notice set notice_title=?, notice_contents=? where notice_no=? ";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, notice.getNoticeTitle());
				pstmt.setString(2, notice.getNoticeContents());
				pstmt.setInt(3, notice.getNoticeNo());
			} else {
				String sql="update Notice set notice_status=? where notice_no=? ";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, noticeStatus);
				pstmt.setInt(2, notice.getNoticeNo());
				
			}
			pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("[����] updateNotice() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return row;
}
	
	
	/** ����ʵ� **/
	public final static int ALL=0;
	public final static int TEMP=1;
	public final static int SUBMIT=2;
	
	/** �˻��гο��� ���� �˻� **/
	public List<NoticeDTO> selectNoticeAdminByKeyword(int startRow, int endRow, String keyword, final int status ){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<NoticeDTO> noticeList=new  ArrayList<NoticeDTO>();
		
		try {
			con=getConnection();
			
			String sql1="select * from notice ";
			
			String sql2="";
			if(status==ALL) {
				sql2="where notice_status in (1,2) ";
			} else if(status==TEMP) {
				sql2="where notice_status=1 ";
			} else if(status==SUBMIT) {
				sql2="where notice_status=2 ";
			}
			//select * from (select rownum rn, temp.* from (select * from notice where notice_title like '%'||'��'||'%') temp) where rn between 1 and 10;
			if(keyword.equals("")){
				sql1+=sql2;
				String sql="select * from (select rownum rn, temp.* from ("+sql1+") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, startRow);
				pstmt.setInt(2, endRow);
			} else {
				sql1+=sql2+" and (notice_title like '%'||?||'%' or notice_contents like '%'||?||'%') ";
				String sql="select * from (select rownum rn, temp.* from ("+sql1+") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, keyword);
				pstmt.setString(2, keyword);
				pstmt.setInt(3, startRow);
				pstmt.setInt(4, endRow);
			}
			
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				NoticeDTO notice=new NoticeDTO();
				notice.setNoticeNo(rs.getInt("notice_no"));
				notice.setNoticeTitle(rs.getString("notice_title"));
				notice.setNoticeContents(rs.getString("notice_contents"));
				notice.setNoticeDate(rs.getString("notice_date"));
				notice.setNoticeReadcount(rs.getInt("notice_readcount"));
				notice.setNoticeStatus(rs.getInt("notice_status"));
				
				noticeList.add(notice);
			}
			
		} catch (SQLException e) {
			System.out.println("[����] selectNoticeAdminByKeyword() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return noticeList;
	}
	

	/**�˻��� �� ���� ��ȯ**/
	public int selectNoticeAdminCount(String keyword, final int status ){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int count=0;
		
		try {
			con=getConnection();
			
			String sql="select count(*) from notice ";
			
			String sql1="";
			if(status==ALL) {
				sql1="where notice_status in (1,2) ";
			} else if(status==TEMP) {
				sql1="where notice_status=1 ";
			} else if(status==SUBMIT) {
				sql1="where notice_status=2 ";
			}
			
			if(keyword.equals("")){
				sql+=sql1;
				pstmt=con.prepareStatement(sql);
			} else {
				sql+=sql1+" and (notice_title like '%'||?||'%' or notice_contents like '%'||?||'%') ";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, keyword);
				pstmt.setString(2, keyword);
			}
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				count=rs.getInt(1);
			}
			
		} catch (SQLException e) {
			System.out.println("[����] selectNoticeAdminByKeyword() �޼ҵ��� SQL ���� : " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return count;
	}
}
