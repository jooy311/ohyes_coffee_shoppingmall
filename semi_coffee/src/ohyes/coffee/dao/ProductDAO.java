package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.ProductDTO;

public class ProductDAO extends JdbcDAO{
	//싱글톤 사용
		private static ProductDAO _dao;
		
		public ProductDAO() {
			// TODO Auto-generated constructor stub
		}
		
		static {
			_dao = new ProductDAO();
		}
		
		public static ProductDAO getProductDAO() {
			return _dao;
		}
	public int insertProduct(ProductDTO product) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="insert into member values(?,?,?,?,?,?,?,?,?,?,sysdate,'1',?)";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, product.getpNo());
			pstmt.setInt(2, product.getPcategoryCode());
			pstmt.setInt(3, product.getpStock());
			pstmt.setString(4, product.getpName());
			pstmt.setInt(5, product.getpCost());
			pstmt.setString(6, product.getpBrief());
			pstmt.setString(7, product.getpImage());
			pstmt.setString(8, product.getpImagePath());
			pstmt.setString(9, product.getpImageDetail());
			pstmt.setString(10, product.getpImageDetailPath());
			pstmt.setInt(11, product.getpSalesCount());
			
			rows=pstmt.executeUpdate();
		} catch (SQLException e) {
			System.out.println("[에러]insertProduct() 메소드의 SQL 오류 = "+e.getMessage());
		} finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public int updateProduct(ProductDTO product) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="UPDATE PRODUCT SET P_STOCK=?, P_NAME=?, P_COST=?, P_BREEF=?, P_IMAGE=?, P_IMGAE_PAHT=?, P_IMAG_EDETAIL=?, P_IMAGE_DETAIL_PATH=?, P_DATE=SYSDATE, P_ISDELETE=? WHERE P_NO=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setInt(1, product.getpStock());
			pstmt.setString(2, product.getpName());
			pstmt.setInt(3, product.getpCost());
			pstmt.setString(4, product.getpBrief());
			pstmt.setString(5, product.getpImage());
			pstmt.setString(6, product.getpImagePath());
			pstmt.setString(7, product.getpImageDetail());
			pstmt.setString(8, product.getpImageDetailPath());
			pstmt.setString(9, product.getpStatus());
			pstmt.setString(10, product.getpNo());
			
			rows=pstmt.executeUpdate();
		}catch (SQLException e) {
			System.out.println("[에러]updateProduct() 메소드의 SQL 오류 = "+e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}

	public int deleteProduct(String no) {
		Connection con=null;
		PreparedStatement pstmt=null;
		int rows=0;
		try {
			con=getConnection();
			
			String sql="UPDATE P_ISDELETE=0 WHERE P_NO=?";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, no);
			
			rows=pstmt.executeUpdate();
		}catch (SQLException e) {
			System.out.println("[에러]deleteProduct() 메소드의 SQL 오류 = "+e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public ProductDTO selectNoProduct(String no) {
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		ProductDTO product=null;
		try {
			con=getConnection();
			
			String sql="SELECT * FROM PRODUCT WHERE P_NO like ? and p_status=1";
			pstmt=con.prepareStatement(sql);
			pstmt.setString(1, no);
			rs=pstmt.executeQuery();
			if(rs.next() ) {
				product=new ProductDTO();
				product.setpNo(rs.getString("p_no"));
				product.setPcategoryCode(rs.getInt("pcategory_code"));
				product.setpStock(rs.getInt("p_stock"));
				product.setpName(rs.getString("p_name"));
				product.setpCost(rs.getInt("p_cost"));
				product.setpBrief(rs.getString("p_brief"));
				product.setpImage(rs.getString("p_image"));
				product.setpImagePath(rs.getString("p_image_path"));
				product.setpImageDetail(rs.getString("p_image_detail"));
				product.setpImageDetailPath(rs.getString("p_image_detail_path"));
				product.setpDate(rs.getString("p_date"));
				product.setpStatus(rs.getString("p_status"));
				product.setpSalesCount(rs.getInt("p_salescount"));
			}
			
		}catch (SQLException e) {
			System.out.println("[에러]selectNoProduct() 메소드의 SQL 오류 = "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return product;
	}
	
	//카테고리 번호를 전달받아 카테고리 페이지에서 상품출력하기 위한 메소드
	public List<ProductDTO> selectProduct(int no){
		Connection con=null;
		PreparedStatement pstmt=null;
		ResultSet rs=null;
		List<ProductDTO> productList=new ArrayList<ProductDTO>();
		try {
			con=getConnection();
			
			if(no==0) {
					String sql="SELECT * FROM PRODUCT where p_status=1 ORDER BY PCATEGORY_CODE";
					pstmt=con.prepareStatement(sql);
			} else {
				String sql="SELECT * FROM PRODUCT WHERE PCATEGORY_CODE=? and p_status=1";
				pstmt=con.prepareStatement(sql);
				pstmt.setInt(1, no);
			}
			rs=pstmt.executeQuery();
			
			while(rs.next()) {
				ProductDTO product=new ProductDTO();
				product.setpNo(rs.getString("p_no"));
				product.setPcategoryCode(rs.getInt("pcategory_code"));
				product.setpStock(rs.getInt("p_stock"));
				product.setpName(rs.getString("p_name"));
				product.setpCost(rs.getInt("p_cost"));
				product.setpBrief(rs.getString("p_brief"));
				product.setpImage(rs.getString("p_image"));
				product.setpImagePath(rs.getString("p_image_path"));
				product.setpImageDetail(rs.getString("p_image_detail"));
				product.setpImageDetailPath(rs.getString("p_image_detail_path"));
				product.setpDate(rs.getString("p_date"));
				product.setpStatus(rs.getString("p_status"));
				product.setpSalesCount(rs.getInt("p_salescount"));
				
				productList.add(product);
			}
		}catch (SQLException e) {
			System.out.println("[에러]selectProduct() 메소드의 SQL 오류 = "+e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return productList;
	}
	
	//상품이름을 전달받아 상품출력하기 위한 메소드
		public List<ProductDTO> selectNameProduct(int startRow, int endRow, String search, String keyword, int category){
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			List<ProductDTO> productList=new ArrayList<ProductDTO>();
			try {
				con=getConnection();
				
				if(keyword.equals("")) {
					if(category==0) {
						String sql="select * from (select rownum rn,temp.* from (select * from product where p_status=1 order by p_no desc)"
								+ " temp) where rn between ? and ?";
						pstmt=con.prepareStatement(sql);
						pstmt.setInt(1, startRow);
						pstmt.setInt(2, endRow);
					} else {
						String sql="select * from (select rownum rn,temp.* from (select * from product "
								+ "where pcategory_code=? and p_status=1 order by p_no desc)"
								+ " temp) where rn between ? and ?";
						pstmt=con.prepareStatement(sql);
						pstmt.setInt(1, category);
						pstmt.setInt(2, startRow);
						pstmt.setInt(3, endRow);
					}					
				} else {
					if(category==0) {
						String sql="select * from (select rownum rn,temp.* from (select * from product "
								+ "where "+search+" like '%'||?||'%' and p_status=1 order by p_no desc)"
								+ " temp) where rn between ? and ?";
						pstmt=con.prepareStatement(sql);
						pstmt.setString(1, keyword);
						pstmt.setInt(2, startRow);
						pstmt.setInt(3, endRow);
					} else {
						String sql="select * from (select rownum rn,temp.* from (select * from product "
								+ "where pcategory like ? and "+search+" like '%'||?||'%' and p_status=1 order by p_no desc)"
								+ " temp) where rn between ? and ?";
						pstmt=con.prepareStatement(sql);
						pstmt.setInt(1, category);
						pstmt.setString(2, keyword);
						pstmt.setInt(3, startRow);
						pstmt.setInt(4, endRow);
					}
				}
				
				rs=pstmt.executeQuery();
				
				while(rs.next()) {
					ProductDTO product=new ProductDTO();
					product.setpNo(rs.getString("p_no"));
					product.setPcategoryCode(rs.getInt("pcategory_code"));
					product.setpStock(rs.getInt("p_stock"));
					product.setpName(rs.getString("p_name"));
					product.setpCost(rs.getInt("p_cost"));
					product.setpBrief(rs.getString("p_brief"));
					product.setpImage(rs.getString("p_image"));
					product.setpImagePath(rs.getString("p_image_path"));
					product.setpImageDetail(rs.getString("p_image_detail"));
					product.setpImageDetailPath(rs.getString("p_image_detail_path"));
					product.setpDate(rs.getString("p_date"));
					product.setpStatus(rs.getString("p_status"));
					product.setpSalesCount(rs.getInt("p_salescount"));
					
					productList.add(product);
				}
			}catch (SQLException e) {
				System.out.println("[에러]selectNameProduct() 메소드의 SQL 오류 = "+e.getMessage());
			}finally {
				close(con, pstmt, rs);
			}
			return productList;
		}
		
		//검색키워드를 전달받아 상품목록 출력
		public int selectProductCount(String search, String keyword, int category) {
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			int count=0;
			try {
				con=getConnection();
				
				if(keyword.equals("")) {
					if(category==0) {
						String sql="select count(*) from product where p_status=1";
						pstmt=con.prepareStatement(sql);
					} else {
						String sql="select count(*) from product where pcategory_code=? and p_status=1";
						pstmt=con.prepareStatement(sql);
						pstmt.setInt(1, category);
					}					
				} else {
					if(category==0) {
						String sql="select count(*) from product where "+search+" like '%'||?||'%' and p_status=1";
						pstmt=con.prepareStatement(sql);
						pstmt.setString(1, keyword);					
					} else {
						String sql="select count(*) from product where "+search+" like '%'||?||'%' and pcategory_code=? and p_status=1 ";
						pstmt=con.prepareStatement(sql);
						pstmt.setString(1, keyword);
						pstmt.setInt(2, category);
					}										
				}
				
				rs=pstmt.executeQuery();
				
				while (rs.next()){
					count=rs.getInt(1);
				}
			} catch (SQLException e) {
				System.out.println("[에러]selectProductCount() 메소드의 SQL 오류 = "+e.getMessage());
			} finally {
				close(con, pstmt, rs);
			}
			return count;
		}

		public int selectProductCost(int pno) {
			Connection con=null;
			PreparedStatement pstmt=null;
			ResultSet rs=null;
			
			int result = 0;
			
			try {
				con = getConnection();
				String sql = "select p_cost from product where p_status = 1 where p_no = ?";
				pstmt = con.prepareStatement(sql);
				
				pstmt.setInt(1, pno);
				rs = pstmt.executeQuery();
				
				if(rs.next()) {
					result = rs.getInt("p_cost");
				}
				
			}catch (SQLException e) {
				System.out.println("[에러]selectProductCost() 메소드의 SQL 오류 = "+e.getMessage());
			}finally {
				close(con, pstmt, rs);
			}
			return result;
		}
}
