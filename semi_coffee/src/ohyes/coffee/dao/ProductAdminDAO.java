package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.ProductDTO;
import ohyes.coffee.pagination.ProductSearch;

public class ProductAdminDAO extends JdbcDAO {
	//싱글톤 사용
	private static ProductAdminDAO _dao;
	
	public ProductAdminDAO() {	
	}
	
	static {
		_dao = new ProductAdminDAO();
	}
	
	public static ProductAdminDAO getProductAdminDAO() {
		return _dao;
	}
	
	public int insertProductAdmin(ProductDTO product) {
		Connection con = null;
		PreparedStatement pstmt = null;
		//ResultSet rs = null;
		
		int rows = 0;
		
		try {
			con = getConnection();
			String sql = "insert into product values(?,?,?,?,?,?,?,?,?,?,?,1,1)";//판매횟수는 임시적으로 1
			pstmt = con.prepareStatement(sql);
			
			pstmt.setString(1, product.getpNo());
			pstmt.setInt(2, product.getPcategoryCode());
			pstmt.setInt(3, product.getpStock());
			pstmt.setString(4, product.getpName());
			pstmt.setInt(5, product.getpCost());
			pstmt.setString(6, product.getpBrief());
			pstmt.setString(7, product.getpImage());
			pstmt.setString(8, product.getpImagePath());//필요없긴함..
			pstmt.setString(9, product.getpImageDetail());
			pstmt.setString(10, product.getpImageDetailPath());//얘도 필요없긴함...
			pstmt.setString(11, product.getpDate());
			//pstmt.setString(12, product.getpStatus());
			//pstmt.setInt(13, product.getpSalesCount());//어떻게..?
			
			rows=pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("insertProductAdmin()메소드에서 발생하는 오류 " + e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	//상품의 갯수를 반환하는 메소드. 
	//검색을 하면 검색한 만큼의 게시물의 갯수가 카운팅 되어야 한다 -> 동적 sql사용
	public int selectCountProduct(String select_classification, String search_product, String pcategory_code, String p_date) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		int count = 0;
		
		String query1 = "";
		String query2 = "";
		String query3 = "";
		
		// list에 ""값이 아닌 애들만 넣는다.
		List<String> list = new ArrayList<String>();
		if (!search_product.equals("")) {// 
			list.add(select_classification);//p_name or p_no
		} 
		if (!pcategory_code.equals("")) {//상품카테고리 1,2,3
			list.add("pcategory_code");
		} 
		if (!p_date.equals("")) {
			list.add("p_date");
		}
		
		System.out.println(" DAO에서 리스트사이즈 " + list.size());
		
		try {
			con = getConnection();
			
			if (list.size() == 0) {
				String sql = "select count(*) from product where p_status = 1";//페이지 처음 들어갔을 때 count 해주는 쿼리문
				
				pstmt = con.prepareStatement(sql);
				rs = pstmt.executeQuery();
			}else {
				
				boolean flag1 = false;
				boolean flag2 = false;
				
				for (String colname : list) {
					if (colname.equals("p_name") || colname.equals("p_no")) {
						query1 =  " and "+colname + " like '%'||?||'%' ";// 파라미터는 search_order
						flag1 = true;
					} else if (colname.equals("p_date")) {//colname = p_date
						
						if(p_date.equals("for7days"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-7,'YYYYMMDD') ";
						else if(p_date.equals("for1month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-30,'YYYYMMDD') ";
						else if(p_date.equals("for3month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-90,'YYYYMMDD') ";
						
					}else if(colname.equals("pcategory_code")) {//커피용품
						if(!pcategory_code.equals("all")) {
							query3 = " and " + colname + " = ? ";
							flag2 = true;
						}
					}
				}
				
				
				String sql = "select count(*) from product where p_status = 1 " + query1 + query2 + query3;
				
				pstmt = con.prepareStatement(sql);
				
				if(flag1 && flag2) {
					pstmt.setString(1, search_product);
					pstmt.setInt(2, Integer.parseInt(pcategory_code));
				
				}else if(flag1 && !flag2){
					pstmt.setString(1, search_product);
					
				}else if(!flag1 && flag2) {
					pstmt.setInt(1, Integer.parseInt(pcategory_code));
					
				}
				
				rs = pstmt.executeQuery();
			}
			
			
			if(rs.next()) {
				count = rs.getInt(1);//검색대상이 1개 이므로
			}
			
		}catch (SQLException e) {
			System.out.println("selectCountProduct() 메소드에서 발생하는 오류 " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return count;
	}
	
	//페이징처리하여 게시물을 조회하는 메소드
	public List<ProductDTO> selectProductAdminAll(int startRow, int endRow, String select_classification, String search_product, String pcategory_code, String p_date) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		System.out.println("ddddddddddddddddddddd "+search_product);
		List<ProductDTO> productList = new ArrayList<ProductDTO>();
		
		String query1 = "";
		String query2 = "";
		String query3 = "";
		
		// list에 ""값이 아닌 애들만 넣는다.
		List<String> list = new ArrayList<String>();
		if (!search_product.equals("")) {// 
			list.add(select_classification);//p_name or p_no
		} 
		if (!pcategory_code.equals("")) {//상품카테고리 1,2,3
			list.add("pcategory_code");
		} 
		if (!p_date.equals("")) {
			list.add("p_date");
		}
		
		System.out.println(" DAO에서 리스트사이즈 " + list.size());
		
		try {
			con = getConnection();
			
			if (list.size() == 0) {
				String sql = "select * from (select rownum rn , "
						+ "temp.* from (select * from product where p_status = 1) temp) "
						+ "where rn between ? and ?";
				
				pstmt = con.prepareStatement(sql);
				pstmt.setInt(1, startRow);
				pstmt.setInt(2, endRow);
				
				rs = pstmt.executeQuery();
				
			}else {
					
				boolean flag1 = false;
				boolean flag2 = false;
				
				for (String colname : list) {
					if (colname.equals("p_name") || colname.equals("p_no")) {
						query1 =  " and "+colname + " like '%'||?||'%' ";// 파라미터는 search_order
						flag1 = true;
					} else if (colname.equals("p_date")) {//colname = p_date
						
						if(p_date.equals("for7days"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-7,'YYYYMMDD') ";
						else if(p_date.equals("for1month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-30,'YYYYMMDD') ";
						else if(colname.equals("for3month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-90,'YYYYMMDD') ";
						
					}else if(colname.equals("pcategory_code")) {//커피용품
						if(!pcategory_code.equals("all")) {
							query3 = " and " + colname + " = ? ";
							flag2 = true;
						}
					}
				}
				
				String sql = "select * from (select rownum rn , "
						+ "temp.* from (select * from product where p_status = 1 " + query1 + query2 + query3 + ") temp) "
						+ "where rn between ? and ?";
				
				pstmt = con.prepareStatement(sql);
				
				System.out.println(sql);
				
				if(flag1 && flag2) {
					pstmt.setString(1, search_product);
					pstmt.setInt(2, Integer.parseInt(pcategory_code));
					pstmt.setInt(3, startRow);
					pstmt.setInt(4, endRow);
				}else if(flag1 && !flag2){
					pstmt.setString(1, search_product);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);
				}else if(!flag1 && flag2) {
					pstmt.setInt(1, Integer.parseInt(pcategory_code));
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);
				}else {
					pstmt.setInt(1, startRow);
					pstmt.setInt(2, endRow);
				}
				
				rs = pstmt.executeQuery();
			}
			
			while(rs.next()) {
				ProductDTO product = new ProductDTO();
				
				product.setpNo(rs.getString("p_no"));
			//	product.setPcategoryCode(rs.getInt("pcategory_code"));
				product.setpStock(rs.getInt("p_stock"));
				product.setpName(rs.getString("p_name"));
				product.setpCost(rs.getInt("p_cost"));
				//product.setpBrief(rs.getString("p_brief"));
				product.setpImage(rs.getString("P_IMAGE"));
				//product.setpImagePath(rs.getString("P_IMAGE_PATH"));
				//product.setpImageDetail(rs.getString("P_IMAGE_DETAIL"));
				//product.setpImageDetailPath(rs.getString("P_IMAGE_DETAIL_PATH"));
				product.setpDate(rs.getString("P_DATE"));
				//product.setpStatus(rs.getString("P_STATUS"));
				product.setpSalesCount(rs.getInt("P_SALESCOUNT"));
				
				productList.add(product);
				
			}
			
		}catch (SQLException e) {
			System.out.println("selectProductAdminAll()메소드에서의 오류" + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		
		
		return productList; 
	}

	//관리자에서 관리자가 원하는 값으로 검색하기 위한 메소드
	public ProductDTO selectProductAdminPno(String pno){
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		ProductDTO product = null;
		
		try {
			con = getConnection();
			String sql = "select * from product where p_no = ?";
			
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, pno);//value = 관리자가 뭐라고 text를 적었는지.
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				product = new ProductDTO();
				
				product.setpNo(rs.getString("p_no"));
		    	//product.setPcategoryCode(rs.getInt("pcategory_code"));
				product.setpStock(rs.getInt("p_stock"));
				product.setpName(rs.getString("p_name"));
				product.setpCost(rs.getInt("p_cost"));
				product.setpBrief(rs.getString("p_brief"));
				product.setpImage(rs.getString("P_IMAGE"));
				//product.setpImagePath(rs.getString("P_IMAGE_PATH"));
				product.setpImageDetail(rs.getString("P_IMAGE_DETAIL"));
				//product.setpImageDetailPath(rs.getString("P_IMAGE_DETAIL_PATH"));
				product.setpDate(rs.getString("P_DATE"));
				//product.setpStatus(rs.getString("P_STATUS"));
				//product.setpSalesCount(rs.getInt("P_SALESCOUNT"));
		
			}
			
		}catch (SQLException e) {
			System.out.println("selectProductAdminNameNo()메소드에서의 오류 " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return product;
	}

	//관리자에서 관라자가 원하는 상품을 삭제(=숨김)하기 위한 메소드(체크박스 값 리스트로 가져와서 for문돌려서 다 삭제해서 이용해봐도 될거같은데...나중에 해보자)
	public int deleteProductAdmin(String pno){
		Connection con = null;
		PreparedStatement pstmt = null;
		
		int rows = 0;
		
		try {
			con = getConnection();
			String sql = "update product set p_status = 0 where p_no = ?";
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, pno);//value = 관리자가 뭐라고 text를 적었는지.
			
			rows = pstmt.executeUpdate();
			
		}catch (SQLException e) {
			System.out.println("deleteProductAdmin()메소드에서의 오류 " + e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public int updateProdcutAdmin(ProductDTO product) {
		Connection con = null;
		PreparedStatement pstmt = null;
		
		int rows = 0;
		try {
			con = getConnection();
			String sql = "update product set p_name = ?, p_cost = ?, p_brief = ? , p_stock = ?, p_image = ?, p_image_detail = ? where p_no = ?";
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, product.getpName());
			pstmt.setInt(2, product.getpCost());
			pstmt.setString(3, product.getpBrief());
			pstmt.setInt(4, product.getpStock());
			pstmt.setString(5, product.getpImage());
			pstmt.setString(6, product.getpImageDetail());
			pstmt.setString(7, product.getpNo());
			rows = pstmt.executeUpdate();
			
		}catch (SQLException e) {
			System.out.println("updateProdcutAdmin()메소드에서의 오류 발생 " + e.getMessage());
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
	
	public int checkProductNo(String p_no) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		int result =0 ;
		
		try {
			con = getConnection();
			String sql = "select p_no from product where p_no = ?";
			pstmt = con.prepareStatement(sql);
			
			pstmt.setString(1, p_no);
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				if(rs.getString("p_no").equals(p_no)){
					result = 1;//같은 상품번호가 존재한다는 뜻
				}
			}
			
		}catch (SQLException e) {
			System.out.println("checkProductNo()메소드에서 발생하는 오류 " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return result;
	}


	//조인해서 판매횟수를 받아 오기 위한 메소드
	public int countSalesProduct(String p_no) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		int result =0 ;
		
		
		try {
			con = getConnection();
			
			//해당상품번호에 해당하는 상품판매 수량을 가져온다.
			String sql = "select p.p_no , od.order_p_amount from product p , order_detail od , order_pay o "
					+ "where p.p_no = od.orderDetail_p_no and o.order_no = od.order_no and o.order_status = 1 and p.p_status = 1 and p.p_no = ?";
			
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, p_no);
			
			rs = pstmt.executeQuery();
			
			if(rs.next()) {
				result += rs.getInt("order_p_amount");
			}
			
		}catch (SQLException e) {
			System.out.println("countSalesProduct() 에서 발생하는 오류 "  + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		
		//System.out.println("판매횟수다!!! " + result);
		return result;
		
	}

}
