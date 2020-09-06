package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.MemberDTO;
import ohyes.coffee.dto.QnaDTO;

public class QnaAdminDAO extends JdbcDAO {

	public static QnaAdminDAO _dao;
	
	public QnaAdminDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new QnaAdminDAO();
	}
	
	public static QnaAdminDAO getDAO() {
		return _dao;
	}
	
	/** 모든행 검색 **/
	public List<QnaDTO> selectQnaAdminAll(){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<QnaDTO> qnaList=new ArrayList<QnaDTO>();
		
		try {
			con=getConnection();
			String sql="select * from qna where qna_status in (0, 1)";
			pstmt=con.prepareStatement(sql);
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				QnaDTO qna=new QnaDTO();
				qna.setQnaNo(rs.getInt("qna_no"));
				qna.setQnaTitle(rs.getString("qna_title"));
				qna.setQnaMemId(rs.getString("qna_mem_id"));
				qna.setQnaContents(rs.getString("qna_contents"));
				qna.setQnaDate(rs.getString("qna_date"));
				qna.setQnaReadcount(rs.getInt("qna_readcount"));
				qna.setQnaStatus(rs.getInt("qna_status"));
				qna.setQnaCode(rs.getInt("qna_code"));
				
				qnaList.add(qna);
			}
			
			
		} catch (SQLException e) {
			System.out.println("[에러]selectQnaAdminAll() 메소드의 SQL 오류 : "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		
		return qnaList;
		
	}
	
	/** 행삽입 **/
	public int insertQnaAdmin(QnaDTO qna) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="insert into qna values(?,?,?,?,sysdate,0,0,?)";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, qna.getQnaNo());
			pstmt.setString(2, qna.getQnaTitle());
			pstmt.setString(3, qna.getQnaMemId());
			pstmt.setString(4, qna.getQnaContents());
			pstmt.setInt(5, qna.getQnaCode());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]insertQnaAdmin() 메소드의 SQL 오류 : "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	/** 단일행 검색 : 글번호 => DTO**/
		public QnaDTO selectQnaAdminNo(int no) {
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			QnaDTO qna=null;
			try {
				con=getConnection();
				
				String sql="select * from qna where qna_no=?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, no);
				
				rs=pstmt.executeQuery();
				
				if(rs.next()) {
					qna=new QnaDTO();
					qna.setQnaNo(rs.getInt("qna_no"));
					qna.setQnaTitle(rs.getString("qna_title"));
					qna.setQnaMemId(rs.getString("qna_mem_id"));
					qna.setQnaContents(rs.getString("qna_contents"));
					qna.setQnaDate(rs.getString("qna_date"));
					qna.setQnaReadcount(rs.getInt("qna_readcount"));
					qna.setQnaStatus(rs.getInt("qna_status"));
					qna.setQnaCode(rs.getInt("qna_code"));
				}
			} catch (SQLException e) {
				System.out.println("[에러]selectQnaAdminNo() 메소드의 SQL 오류 : "+e.getMessage());
			} finally {
				close(con, pstmt, rs);
			}
			return qna;
		}
		
		/** 삭제 : 0으로 상태변경 **/
		public int deleteQnaAdmin(int qnaNo) {
			Connection con=null;
			PreparedStatement pstmt=null;
			int rows=0;
			try {
				con=getConnection();
				
				String sql="update qna set qna_status=2 where qna_no=?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, qnaNo);
				
				rows=pstmt.executeUpdate();
			} catch (SQLException e) {
				System.out.println("[에러]deleteQnaAdmin() 메소드의 SQL 오류 : "+e.getMessage());
			} finally {
				close(con, pstmt);
			}
			return rows;
		}
		
		
		/** 검색패널에서 검색하기 **/
		public List<QnaDTO> selectQnaAdminByKeyword(int startRow, int endRow, String code, String date, String status ){
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			List<QnaDTO> qnaList=new ArrayList<QnaDTO>();
		
			try {
				con=getConnection();
				
				String query="select * from qna";
				
				int c=Integer.parseInt(code);
				String codeQuery="";
				if(c!=0) {
					codeQuery="qna_code=?";
				}
				
				String dateQuery="";
				if(date.equals("1")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-7,'YYYYMMDD')";
				} else if(date.equals("2")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-30,'YYYYMMDD')";
				} else if(date.equals("3")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-90,'YYYYMMDD')";
				} 
				
				int s=Integer.parseInt(status);
				String statusQuery="qna_status!=?";
				if(s!=2) {
					statusQuery="qna_status=?";
				}
				
				String sql="";
				if(c!=0 && date.equals("0")) {	//카테고리만 입력
					sql="select * from (select rownum rn, temp.* from (select * from qna where "+codeQuery+" and " +statusQuery +") temp) where rn between ? and ?";
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, c);
					pstmt.setInt(2, s);
					pstmt.setInt(3, startRow );
					pstmt.setInt(4, endRow);
					
				} else if(c==0 && !date.equals("0")) {	//기간만 입력
					sql="select * from (select rownum rn, temp.* from (select * from qna where "+dateQuery+" and " +statusQuery +") temp) where rn between ? and ?";
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, s);
					pstmt.setInt(2, startRow );
					pstmt.setInt(3, endRow);
					
				} else if(c!=0 && !date.equals("0")) {	//카테고리, 기간 모두 입력
					sql="select * from (select rownum rn, temp.* from (select * from qna where "+codeQuery+" and " +dateQuery +" and " +statusQuery +") temp) where rn between ? and ?";
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, c);
					pstmt.setInt(2, s);
					pstmt.setInt(3, startRow );
					pstmt.setInt(4, endRow);
					
				} else{		//카테고리, 기간 모두 입력하지 X
					sql="select * from (select rownum rn, temp.* from (select * from qna where "+statusQuery +") temp) where rn between ? and ?";
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, s);
					pstmt.setInt(2, startRow );
					pstmt.setInt(3, endRow);
				}
				
				rs=pstmt.executeQuery();
				
				while(rs.next()) {
					QnaDTO qna=new QnaDTO();
					qna.setQnaNo(rs.getInt("qna_no"));
					qna.setQnaTitle(rs.getString("qna_title"));
					qna.setQnaMemId(rs.getString("qna_mem_id"));
					qna.setQnaContents(rs.getString("qna_contents"));
					qna.setQnaDate(rs.getString("qna_date"));
					qna.setQnaReadcount(rs.getInt("qna_readcount"));
					qna.setQnaStatus(rs.getInt("qna_status"));
					qna.setQnaCode(rs.getInt("qna_code"));
					
					qnaList.add(qna);
				}
				
			} catch (SQLException e) {
				System.out.println("[에러]selectQnaAdminByKeyword() 메소드의 SQL 오류 : "+e.getMessage());
			} finally {
				close(con, pstmt, rs);
			}
			
			return qnaList;
		
		}
		
		
		/** 검색결과의 총 갯수 반환 **/
		public int searchCountQnaAdmin(String code, String date, String status ){
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			int count=0;
		
			try {
				con=getConnection();
				
				String sql="select count(*) from qna";
				
				int c=Integer.parseInt(code);
				String codeQuery="";
				if(c!=0) {
					codeQuery="qna_code=?";
				}
				System.out.println(codeQuery);
				
				String dateQuery="";
				if(date.equals("1")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-7,'YYYYMMDD')";
				} else if(date.equals("2")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-30,'YYYYMMDD')";
				} else if(date.equals("3")) {
					dateQuery="qna_date >= TO_CHAR(SYSDATE-90,'YYYYMMDD')";
				} 
				System.out.println(dateQuery);
				
				int s=Integer.parseInt(status);
				String statusQuery="qna_status!=?";
				if(s!=2) {
					statusQuery="qna_status=?";
				}
				System.out.println(statusQuery);
				
				if(c!=0 && date.equals("0")) {	//카테고리만 입력
					sql+=" where "+codeQuery +" and "+statusQuery;
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, c);
					pstmt.setInt(2, s);
					
				} else if(c==0 && !date.equals("0")) {	//기간만 입력
					sql+=" where "+dateQuery+" and "+statusQuery;
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, s);
					
				} else if(c!=0 && !date.equals("0")) {	//카테고리, 기간 모두 입력
					sql+=" where "+codeQuery+" and "+dateQuery+" and "+statusQuery;
					System.out.println(sql);
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, c);
					pstmt.setInt(2, s);
					
				} else {
					sql+=" where "+statusQuery;
					System.out.println(sql);
					pstmt = con.prepareStatement(sql);
					pstmt.setInt(1, s);
				}
				
				rs=pstmt.executeQuery();
				
				if(rs.next()) {
					count=rs.getInt(1);
				}
				
			} catch (SQLException e) {
				System.out.println("[에러] searchCountQnaAdmin()메소드의 SQL 오류 : "+e.getMessage());
			} finally {
				close(con, pstmt, rs);
			}
			
			return count;
		
		}
		
}

