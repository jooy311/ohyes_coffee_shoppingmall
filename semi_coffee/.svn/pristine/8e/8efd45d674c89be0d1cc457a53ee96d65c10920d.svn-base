package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.MemberDTO;


public class MemberAdminDAO extends JdbcDAO{
	private static MemberAdminDAO _dao;
	
	public MemberAdminDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new MemberAdminDAO();
	}
	public static MemberAdminDAO getDAO() {
		return _dao;
	}

	/** 회원 선택 (다중행)**/
	public List<MemberDTO> selectMemAdminAll() {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<MemberDTO> memberList=new ArrayList<MemberDTO>();
		try {
			
			con=getConnection();
			String sql="select * from member where mem_status in (1,9) order by mem_id";
			pstmt=con.prepareStatement(sql);
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				MemberDTO member=new MemberDTO();
				member.setMemId(rs.getString("mem_id"));
				member.setMemPwd(rs.getString("mem_pwd"));
				member.setMemName(rs.getString("mem_name"));
				member.setMemZip(rs.getString("mem_zip"));
				member.setMemAddress1(rs.getString("mem_address1"));
				member.setMemAddress2(rs.getString("mem_address2"));
				member.setMemPhone(rs.getString("mem_phone"));
				member.setMemEmail(rs.getString("mem_email"));
				member.setMemJoinDate(rs.getString("mem_joinDate"));
				member.setMemStatus(rs.getInt("mem_status"));
				
				memberList.add(member);
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]selectMemAdminAll() 메소드의 SQL 오류 : "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return memberList;
	}
	
	/** 회원 선택 (단일행)**/
	public MemberDTO selectMemAdminId(String memberId) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		MemberDTO member=null;
		try {
			con=getConnection();
			
			String sql="select * from member where mem_id=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, memberId);
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				member=new MemberDTO();
				member.setMemId(rs.getString("mem_id"));
				member.setMemPwd(rs.getString("mem_pwd"));
				member.setMemName(rs.getString("mem_name"));
				member.setMemZip(rs.getString("mem_zip"));
				member.setMemAddress1(rs.getString("mem_address1"));
				member.setMemAddress2(rs.getString("mem_address2"));
				member.setMemPhone(rs.getString("mem_phone"));
				member.setMemEmail(rs.getString("mem_email"));
				member.setMemJoinDate(rs.getString("mem_joinDate"));
				member.setMemStatus(rs.getInt("mem_status"));
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]selectIdMemberId() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return member;
	}
	
	
	
	/** update를 위한 상수필드  **/
	public final static int PHONE = 1;
	public final static int ZIP = 2;
	public final static int ADDRESS1 = 3;
	public final static int ADDRESS2 = 4;
	public final static int STATUS = 5;
	
	/** 회원변경 **/
	public int updateMemAdmin(MemberDTO member, final int what, String string) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;

	
		try {
			con=getConnection();
			
			String sql="update member set ";
			
			if(what==STATUS) {
				int stringToInt=Integer.parseInt(string);
				sql+="mem_status=? where mem_id=?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, stringToInt);
				pstmt.setString(2, member.getMemId());
				rows=pstmt.executeUpdate();
			} else {
			
				if(what==PHONE) {
					sql+="mem_phone=?";
				} else if(what==ZIP) {
					sql+="mem_zip=?";
				}  else if(what==ADDRESS1) {
					sql+="mem_address1=?";
				}  else if(what==ADDRESS2) {
					sql+="mem_address2=?";
				}  
				sql+="where mem_id=?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, string);
				pstmt.setString(2, member.getMemId());
				
				rows=pstmt.executeUpdate();
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]updateMemAdmin() 메소드의 SQL 오류 : "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public final static int ALL=0;
	public final static int MEM=1;
	public final static int ADMIN=2;
	
	
	/** 검색패널 **/
	public List<MemberDTO> searchMemAdmin(int startRow, int endRow, String phone, String name, final int status ){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<MemberDTO> memberList=new ArrayList<MemberDTO>();
		
		try {
			con=getConnection();
			
			String statusQuery="";
			if(status==ALL) {
				statusQuery="mem_status!=0 ";
			} else if(status==MEM) {
				statusQuery="mem_status=1";
			} else if(status==ADMIN) {
				statusQuery="mem_status=9";
			}
			String phoneQuery="mem_phone like '%'||?";
			String nameQuery="mem_name = ?";
			
			String sql="";
			if(!phone.equals("") && name.equals("")){	//O X O
				sql="select * from (select rownum rn, temp.* from (select * from member where "+phoneQuery+" and " +statusQuery +") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, phone);
				pstmt.setInt(2, startRow );
				pstmt.setInt(3, endRow);
				
			} else if(!name.equals("") && phone.equals("")) {	//X O O
				sql="select * from (select rownum rn, temp.* from (select * from member where "+nameQuery+" and " +statusQuery +") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, name);
				pstmt.setInt(2, startRow );
				pstmt.setInt(3, endRow);
			
			} else if(!name.equals("") && !phone.equals("") ){	//O O O
				sql="select * from (select rownum rn, temp.* from (select * from member where "+nameQuery+" and " +phoneQuery +" and " +statusQuery +") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, phone);
				pstmt.setString(2, name);
				pstmt.setInt(3, startRow );
				pstmt.setInt(4, endRow);
				
			} else {	// X X O
				sql="select * from (select rownum rn, temp.* from (select * from member where " +statusQuery +") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, startRow );
				pstmt.setInt(2, endRow);
			}
			
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				MemberDTO member=new MemberDTO();
				member.setMemId(rs.getString("mem_id"));
				member.setMemPwd(rs.getString("mem_pwd"));
				member.setMemName(rs.getString("mem_name"));
				member.setMemZip(rs.getString("mem_zip"));
				member.setMemAddress1(rs.getString("mem_address1"));
				member.setMemAddress2(rs.getString("mem_address2"));
				member.setMemPhone(rs.getString("mem_phone"));
				member.setMemEmail(rs.getString("mem_email"));
				member.setMemJoinDate(rs.getString("mem_joinDate"));
				member.setMemStatus(rs.getInt("mem_status"));
				
				memberList.add(member);
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]searchMemAdmin() 메소드의 SQL 오류 : "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return memberList;
	}

	/**검색행 후 갯수 반환**/
	public int searchCountMemAdmin( String phone, String name, final int status ){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int count=0;
		
		try {
			con=getConnection();
			
			
			String sql="select count(*) from member ";
			
			String statusQuery="";
			if(status==ALL) {
				statusQuery="mem_status !=0 ";
			} else if(status==MEM) {
				statusQuery="mem_status=1";
			} else if(status==ADMIN) {
				statusQuery="mem_status=9";
			}
			String phoneQuery="mem_phone like '%'||?";
			String nameQuery="mem_name = ?";
			
			if(!phone.equals("") && name.equals("")){	//phone만 입력
				sql+="where "+phoneQuery+" and " +statusQuery;
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, phone);
				
			} else if(!name.equals("") && phone.equals("")) {	//name만 입력
				sql+="where "+nameQuery+" and " +statusQuery;
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, name);
			
			} else if(!name.equals("") && !phone.equals("") ){	//phone, name 모두 입력
				sql+="where "+phoneQuery+" and " +nameQuery+" and " +statusQuery;
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, phone);
				pstmt.setString(2, name);
				
			} else {
				sql+="where "+statusQuery;
				pstmt=con.prepareStatement(sql);
			}
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				count=rs.getInt(1);
			}
			
		} catch (SQLException e) {
			System.out.println("[에러]searchCountMemAdmin() 메소드의 SQL 오류 : "+e.getMessage());
		}  finally {
			close(con, pstmt, rs);
		}
		
		return count;
	}

	
	
}
