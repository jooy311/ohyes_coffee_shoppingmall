package ohyes.coffee.dao;
/*
 이름           널?       유형            
------------ -------- ------------- 
MEM_ID       NOT NULL VARCHAR2(12)  
MEM_PWD      NOT NULL VARCHAR2(500) 
MEM_NAME     NOT NULL VARCHAR2(20)  
MEM_ZIP      NOT NULL VARCHAR2(50)  
MEM_ADDRESS1 NOT NULL VARCHAR2(200) 
MEM_ADDRESS2 NOT NULL VARCHAR2(50)  
MEM_PHONE    NOT NULL VARCHAR2(20)  
MEM_EMAIL    NOT NULL VARCHAR2(100) 
MEM_JOINDATE          DATE          
MEM_STATUS            NUMBER(1)     
 */
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import ohyes.coffee.dto.MemberDTO;

public class MemberDAO extends JdbcDAO{
	private static MemberDAO _dao;
	
	public MemberDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new MemberDAO();
	}
	public static MemberDAO getDAO() {
		return _dao;
	}
	//회원정보를 전달받아 MEMBERS 테이블에 삽입
	//회원상태 : 일반(1), 관리자(9), 탈퇴회원(0)
	public int insertMember(MemberDTO member) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="insert into member values(?,?,?,?,?,?,?,?,sysdate,1)";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, member.getMemId());
			pstmt.setString(2, member.getMemPwd());
			pstmt.setString(3, member.getMemName());
			pstmt.setString(4, member.getMemZip());
			pstmt.setString(5, member.getMemAddress1());
			pstmt.setString(6, member.getMemAddress2());
			pstmt.setString(7, member.getMemPhone());
			pstmt.setString(8, member.getMemEmail());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]insertMember() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
		
	}
	 
	//로그인 기능 구현을 위한 단일행 검색 
		public MemberDTO selectIdMember(String memId) {
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			MemberDTO member=null;
			try {
				con=getConnection();
				
				String sql="select * from member where mem_id=?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, memId);
				
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
				System.out.println("[에러]selectIdMember() 메소드의 SQL 오류 = "+e.getMessage());
			} finally {
				close(con, pstmt, rs);
			}
			return member;
		}
	
	//로그인 세션에 저장된 회원정보 변경
	public int updateMember(MemberDTO member) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update member set mem_pwd=?,mem_name=?"
				+ ",mem_zip=?,mem_address1=?,mem_address2=?,mem_phone=? ,mem_email=? where mem_id=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, member.getMemPwd());
			pstmt.setString(2, member.getMemName());
			pstmt.setString(3, member.getMemZip());
			pstmt.setString(4, member.getMemAddress1());
			pstmt.setString(5, member.getMemAddress2());
			pstmt.setString(6, member.getMemPhone());
			pstmt.setString(7, member.getMemEmail());
			pstmt.setString(8, member.getMemId());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]updateMember() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	//회원탈퇴시 회원상태 변경
	public int updateStatus(String memId) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update member set MEM_STATUS=0 where MEM_ID=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, memId);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]updateStatus() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	//아이디 찾기 기능 구현을 위한 단일행 검색 
			public MemberDTO serchIdMember(String memName) {
				Connection con=null;
				PreparedStatement pstmt=null;
				ResultSet rs=null;
				MemberDTO member=null;
				try {
					con=getConnection();
					
					String sql="select * from member where mem_name=?";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, memName);
					
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
					System.out.println("[에러]selectIdMember() 메소드의 SQL 오류 = "+e.getMessage());
				} finally {
					close(con, pstmt, rs);
				}
				return member;
			}
			
			//비밀번호찾기를 눌렀을때 회원에게 전달된 임시 비밀번호 생성
			public static String randomPassword(int length) {
				
				int index = 0; 
				char[] charset = new char[] { '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
						, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'
						, 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b'
						, 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p'
						, 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' };
				
				StringBuffer sb= new StringBuffer();
				for (int i = 0; i < length; i++) {
					index = (int)(charset.length*Math.random());
					sb.append(charset[index]);
				}

			return sb.toString();
			}
			//임시 비밀번호 생성 후 저장처리를 위한 메소드 
			public int updatePwdMember(MemberDTO member) {
				Connection con=null;
				PreparedStatement pstmt=null;
				int rows=0;
				try {
					con=getConnection();
					
					String sql="update member set mem_pwd=? where MEM_ID=?";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, member.getMemPwd());
					pstmt.setString(2, member.getMemId());
					
					rows=pstmt.executeUpdate();
				} catch (SQLException e) {
					System.out.println("[에러]updateStatus() 메소드의 SQL 오류 = "+e.getMessage());
				} finally {
					close(con, pstmt);
				}
				return rows;
			}
			
			
				
}

	

