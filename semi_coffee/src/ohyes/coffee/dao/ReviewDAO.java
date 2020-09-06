package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.ReviewDTO;

public class ReviewDAO extends JdbcDAO{
	private static ReviewDAO _dao;
	
	public ReviewDAO() {
		// TODO Auto-generated constructor stub
	}

	static {
		_dao=new ReviewDAO();
	}
	
	public static ReviewDAO getDAO() {
		return _dao;
	}
	
	//REVIEW ���̺��� ����� �Խñ��� ������ �˻��Ͽ� ��ȯ�ϴ� �޼ҵ�
	// => �˻� ����� �����ϱ� ���� �Ű������� �˻� ���� ������ ���޹޾� ����
	public int selectReviewCount(String search, String keyword, int category) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int count=0;
		try {
			con=getConnection();
			
			if (keyword.equals("")) {//�˻� ����� ������� ���� ���
				if(category==0) {
					String sql="select count(*) from review";
					pstmt=con.prepareStatement(sql);					
				} else {
					String sql="select count(*) from review join product on review_p_no=p_no where pcategory_code=?";
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, category);
				}
			} else {
				if(category==0) {
					String sql="select count(*) from review where "+search+" like '%'||?||'%' and review_status = 1";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, keyword);
				} else {
					String sql="select count(*) from review join product on review_p_no=p_no"
							+ " where "+search+" like '%'||?||'%' and review_status = 1 and pcategory_code=?";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, keyword);
					pstmt.setInt(2, category);
				}
			}
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				count=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[����]selectReviewCount() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return count;
	}
	
	//�Խñ��� �������ȣ�� ������ ��ȣ�� ���޹޾� ���̺��� ����� �Խñۿ��� ���� ���� ������ �Խñ۸� �˻��Ͽ� ��ȯ�ϴ¸޼ҵ�
	public List<ReviewDTO> selectReview(int startRow, int endRow, String search, String keyword, int category){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<ReviewDTO> reviewList=new ArrayList<ReviewDTO>();
		try {
			con=getConnection();
			
			if(keyword.equals("")) {
				if(category==0) {
					String sql="select * from (select rownum rn,temp.* from (select * from review order by review_no desc) temp) "
							+ " where rn between ? and ?";
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, startRow);
					pstmt.setInt(2, endRow);
				} else {
					String sql="select review_no, review_p_no, review_title, review_memid, review_content, review_date, review_readcount,"
							+ " review_status from (select rownum rn,temp.* from (select * from review join product on review_p_no=p_no"
							+ " where pcategory_code=? order by review_no desc) temp) where rn between ? and ?";
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, category);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);
				}
			} else {
				if(category==0) {
					String sql="select * from (select rownum rn,temp.* from (select * from review where "+search
							+ " like '%'||?||'%' and review_status!=0 order by review_no desc) temp) where rn between ? and ?";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, keyword);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);
				} else if(category==99) {
					String sql="select * from (select rownum rn,temp.* from (select * from review where "+search
							+ " like '%'||?||'%' and review_status!=0 order by review_no asc) temp order by rn asc) where rn between ? and ?";
					pstmt=con.prepareStatement(sql);
					pstmt.setString(1, keyword);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);
				} else {
					String sql="select review_no, review_p_no, review_title, review_memid, review_content, review_date, review_readcount,"
							+ " review_status from (select rownum rn,temp.* from (select * from review join product on review_p_no=p_no"
							+ " where pcategory_code=? order by review_no desc) and "+search
							+ " like '%'||?||'%' and review_status!=0 order by review_no desc) temp) where rn between ? and ?";
					pstmt=con.prepareStatement(sql);
					pstmt.setInt(1, category);
					pstmt.setString(2, keyword);
					pstmt.setInt(3, startRow);
					pstmt.setInt(4, endRow);					
				}
			}
			
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				ReviewDTO review=new ReviewDTO();
				review.setReviewNo(rs.getInt("review_no"));
				review.setReviewPNo(rs.getString("review_p_no"));
				review.setReviewTitle(rs.getString("review_title"));
				review.setReviewMemid(rs.getString("review_memid"));
				review.setReviewContent(rs.getString("review_content"));
				review.setReviewDate(rs.getString("review_date"));
				review.setReviewReadcount(rs.getInt("review_readcount"));
				review.setReviewStatus(rs.getInt("review_status"));
				reviewList.add(review);
			}
		} catch (SQLException e) {
			System.out.println("[����]selectReview() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return reviewList;
	}
	
	//������ ��ü�� ������ �˻��Ͽ� ��ȯ
	public int selectNextNum() {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		int nextNum=0;
		try {
			con=getConnection();
			String sql="select review_seq.nextval from dual";
			pstmt=con.prepareStatement(sql);
			rs=pstmt.executeQuery();
			
			while (rs.next()){
				nextNum=rs.getInt(1);
			}
		} catch (SQLException e) {
			System.out.println("[����]selectNextNum() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return nextNum;
	}
	
	//�Խñ��� ���޹޾� review ���̺��� �����ϰ� �������� ���� ��ȯ
	public int insertReview(ReviewDTO review) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		
		try {
			con=getConnection();
			String sql="insert into review values(?,?,?,?,?,sysdate,0,1)";
			
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, review.getReviewNo());
			pstmt.setString(2, review.getReviewPNo());
			pstmt.setString(3, review.getReviewTitle());
			pstmt.setString(4, review.getReviewMemid());
			pstmt.setString(5, review.getReviewContent());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]insertReview() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	//�Խñ� ��ȣ�� ���޹޾� review ���̺��� ����� �Խñ��� �˻��Ͽ� ��ȯ
	public ReviewDTO selectNumReview(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		ReviewDTO review=null;
		
		try {
			con=getConnection();
			
			String sql="select * from review where review_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, num);
			
			rs=pstmt.executeQuery();
			
			if(rs.next()) {
				review=new ReviewDTO();
				review.setReviewNo(rs.getInt("review_no"));
				review.setReviewPNo(rs.getString("review_p_no"));
				review.setReviewTitle(rs.getString("review_title"));
				review.setReviewMemid(rs.getString("review_memid"));
				review.setReviewContent(rs.getString("review_content"));
				review.setReviewDate(rs.getString("review_date"));
				review.setReviewReadcount(rs.getInt("review_readcount"));
				review.setReviewStatus(rs.getInt("review_status"));
			}
		} catch (SQLException e) {
			System.out.println("[����]selectNumReview() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return review;
	}
	
	//�Խñ۹�ȣ�� ���޹޾� review ���̺��� ����� �ش� �Խñ��� ��ȸ���� 1 �����ǵ��� �����ϰ� �������� ������ ��ȯ�ϴ� �޼ҵ�
	public int updateReadCount(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update review set review_readcount=review_readcount+1 where review_no=?";
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
	
	//�Խñ� ��ȣ�� ���޹޾� review ���̺��� ����� �ش� �Խñ��� ���� ó���ϰ� ó������ ������ ��ȯ�ϴ� �޼ҵ� => �������¸� 9�κ���
	public int deleteReview(int num) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update review set review_status=0 where review_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, num);
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]deleteReview() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	//�Խñ��� ���޹޾� REWIEW ���̺��� ����� �ش� �Խñ��� �����ϰ� �������� ������ ��ȯ�ϴ� �޼ҵ�
	public int updateReview(ReviewDTO review) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="update review set review_title=?, review_content=?, review_date=sysdate where review_no=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, review.getReviewTitle());
			pstmt.setString(2, review.getReviewContent());
			pstmt.setInt(3, review.getReviewNo());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[����]updateReview() �޼ҵ��� SQL ���� = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
}