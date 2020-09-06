package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.QnaDTO;

public class QnaBoardDAO extends JdbcDAO{
	private static QnaBoardDAO _dao;
	
	private QnaBoardDAO() {
		// TODO Auto-generated constructor stub
	}
	
	static {
		_dao=new QnaBoardDAO();
	}
	
	public static QnaBoardDAO getDAO() {
		return _dao;
	}
	
	//BOARD ���̺��� ����� �Խñ��� ������ �˻��Ͽ� ��ȯ�ϴ� �޼ҵ�
	// => �˻� ����� �����ϱ� ���� �Ű������� �˻� ���� ������ ���޹޾� ����
	//public int selectBoardCount() {
	public int selectBoardCount(String search, String keyword) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int count=0;
		
		try {
			con=getConnection();
			
			//�޼ҵ��� �Ű������� ���尪�� ���� �ٸ� SQL ������ ����
			//�Ͽ� ����ǵ��� ���� - ���� SQL
			if(keyword.equals("")) {//�˻� ����� ������� ���� ���
				String sql="select count(*) from QNA";
				pstmt=con.prepareStatement(sql);
			} else {//�˻� ����� ����� ���
				String sql="select count(*) from QNA where "
						+search+" like '%'||?||'%'";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, keyword);
			}
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				count=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[����]selectBoardCount() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return count;
	}
	
	//�Խñ��� ���� ���ȣ�� ���� ���ȣ�� ���޹޾� BOARD ���̺��� ����� 
	//�Խñۿ��� ���۰� ���� ������ ���Ե� �Խñ۸� �˻��Ͽ� ��ȯ�ϴ� �޼ҵ�
	//public List<BoardDTO> selectBoard(int startRow, int endRow) {
	public List<QnaDTO> selectBoard(int startRow, int endRow, String search, String keyword, int category) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<QnaDTO> boardList=new ArrayList<QnaDTO>();
		try {
			con=getConnection();
			
			if(keyword.equals("")) {
				if (category==0) {
					
				String sql="select * from (select rownum rn,temp.* from ("
					+ "select * from QNA order by qna_no desc)"
					+ " temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, startRow);
				pstmt.setInt(2, endRow);
				}else {
					String sql="select * from (select rownum rn,temp.* from ("
							+ "select * from QNA order by qna_no desc)"
							+ " temp) where qna_code=? and rn between ? and ?";
						pstmt=con.prepareStatement(sql);
						pstmt.setInt(1, category);
						pstmt.setInt(2, startRow);
						pstmt.setInt(3, endRow);
				}
				System.out.println(category);
			}else {
				String sql="select * from (select rownum rn,temp.* from ("
						+ "select * from qna where "+search
						+" like '%'||?||'%'  order by qna_no"
						+ ") temp) where rn between ? and ?";
				pstmt=con.prepareStatement(sql);
				pstmt.setString(1, keyword);
				pstmt.setInt(2, startRow);
				pstmt.setInt(3, endRow);
			}
			rs=pstmt.executeQuery();
			while(rs.next()) {
				QnaDTO board=new QnaDTO();
				board.setQnaNo(rs.getInt("qna_no"));
				board.setQnaTitle(rs.getString("qna_title"));
				board.setQnaMemId(rs.getString("qna_mem_id"));
				board.setQnaContents(rs.getString("qna_contents"));
				board.setQnaDate(rs.getString("qna_date"));
				board.setQnaReadcount(rs.getInt("qna_readcount"));
				board.setQnaStatus(rs.getInt("qna_status"));
				board.setQnaCode(rs.getInt("qna_code"));
					boardList.add(board);
				
				
			}
		} catch (SQLException e) {
			System.out.println("[����]selectBoard() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return boardList;
	}

	
	//BOARD_SEQ ������ ��ü�� �������� �˻��Ͽ� ��ȯ�ϴ� �޼ҵ�
	public int selectNextNum() {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int nextNum=0;
		try {
			con=getConnection();
			
			String sql="select qna_seq.nextval from dual";
			pstmt=con.prepareStatement(sql);
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				nextNum=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[����]selectNextNum() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		} 
		return nextNum;
	}
	
	//�Խñ��� ���޹޾� BOARD ���̺��� �����ϰ� �������� ������ ��ȯ�ϴ� �޼ҵ�
	public int insertBoard(QnaDTO board) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="insert into qna values(?,?,?,?,sysdate,0,0,?)";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, board.getQnaNo());
			pstmt.setString(2, board.getQnaTitle());
			pstmt.setString(3, board.getQnaMemId());
			pstmt.setString(4, board.getQnaContents());
			pstmt.setInt(5, board.getQnaCode());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]insertBoard() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	
	//�Խñ� ��ȣ�� ���޹޾� BOARD ���̺��� ����� �Խñ��� �˻��Ͽ� ��ȯ�ϴ� �޼ҵ�
	public QnaDTO selectNumBoard(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		QnaDTO board=null;
		try {
			con=getConnection();
			
			String sql="select * from qna where qna_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, num);
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				board=new QnaDTO();
				board.setQnaNo(rs.getInt("qna_no"));
				board.setQnaTitle(rs.getString("qna_title"));
				board.setQnaMemId(rs.getString("qna_mem_id"));
				board.setQnaContents(rs.getString("qna_contents"));
				board.setQnaDate(rs.getString("qna_date"));
				board.setQnaReadcount(rs.getInt("qna_readcount"));
				board.setQnaStatus(rs.getInt("qna_status"));
				board.setQnaCode(rs.getInt("qna_code"));
			}
		} catch (SQLException e) {
			System.out.println("[����]selectNumBoard() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return board;
	}
	
	//�Խñ۹�ȣ�� ���޹޾� BOARD ���̺��� ����� �ش� �Խñ��� ��ȸ����
	//1 �����ǵ��� �����ϰ� �������� ������ ��ȯ�ϴ� �޼ҵ�
	public int updateReadCount(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update qna set qna_readcount=qna_readcount+1 where qna_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, num);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]updateReadCount() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt); 
		}
		return rows;
	}
	
	//�Խñ۹�ȣ�� ���޹޾� BOARD ���̺��� ����� �ش� �Խñ��� ���� 
	//ó���ϰ� ó�� ���� ������ ��ȯ�ϴ� �޼ҵ� 
	// => �Խñ��� ���� �÷����� ���� ����(9)�� ����
	public int deleteBoard(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update qna set qna-status=0 where qna_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, num);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]deleteBoard() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt); 
		}
		return rows;
	}
	
	//�Խñ��� ���޹޾� BOARD ���̺��� ����� �ش� �Խñ��� �����ϰ�
	//�������� ������ ��ȯ�ϴ� �޼ҵ�
	public int updateBoard(QnaDTO board) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update qna set qna_title=?,qna_contents=?,qna_code=? where qna_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, board.getQnaTitle());
			pstmt.setString(2, board.getQnaContents());
			pstmt.setInt(3, board.getQnaCode());
			pstmt.setInt(4, board.getQnaNo());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]modifyBoard() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt); 
		}
		return rows;
	}
	//�ۻ����� ���� ���� ����
	public int updateStatus(int qnaNo) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();

			String sql="update qna set QNA_STATUS=2 where QNA_NO =?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, qnaNo);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]updateStatus() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
}

	
