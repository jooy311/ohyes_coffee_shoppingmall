package ohyes.coffee.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import ohyes.coffee.dto.OrderListDTO;
import ohyes.coffee.dto.OrderPayDTO;

//Admin������ select�ҰŹۿ� ����+�ణ�� update
//insert �� update�� ���� ���������� �����ؾߵ�

public class OrderPayAdminDAO extends JdbcDAO {
	private static OrderPayAdminDAO _dao;

	static {
		_dao = new OrderPayAdminDAO();
	}

	public static OrderPayAdminDAO getOrderPayAdminDAO() {
		return _dao;
	}

	// �ֹ���� ó�������� �Խù��� ������ ���ϱ� ���� �޼ҵ�
	public int selectCountOrderPay(String select_classification, String search_order, String order_date, String order_p,
		String[] order_status, String search_order_p) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;

		int count = 0;
		// System.out.println("�ڡ�"+order_status[0] + " , " + order_status[1]);
		String query1 = "";
		String query2 = "";
		String query3 = "";
		String query4 = "";

		// list�� ""���� �ƴ� �ֵ鸸 �ִ´�.
		List<String> list = new ArrayList<String>();
		if (!search_order.equals("")) {// �ֹ��ڳ� �ֹ���ȣ��
			list.add(select_classification);
		} 
		if (!order_date.equals("")) {// �Ⱓ
			list.add("order_date");
		} 
		if (!search_order_p.equals("")) {//
			list.add(order_p);
		}

		try {
			con = getConnection();
			if (list.size() == 0) {// �ƹ��͵� �˻����� ����
				String sql = "select count(*) from (select distinct p.order_no order_no, M.mem_name, M.mem_id mem_id, p.order_total_cost, p.order_status, p.order_date " + 
						" from member M,order_detail O,order_pay P where m.mem_id = p.order_mem_id and p.order_no = o.order_no )";
				pstmt = con.prepareStatement(sql);
				rs = pstmt.executeQuery();
			} else {// �˻��Ѱ� ��� �ϳ��� ����
				int size = list.size();
				System.out.println("�˻��� ���� : " + size);
				boolean flag1 = false, flag2 = false;

				// �ֹ��� �̸��� ���� member���̺� ����
				// ��ǰ��ȣ�� ��ǰ���̺� ����
				for (String colname : list) {
					if (colname.equals("mem_id") || colname.equals("order_no")) {
						if(colname.equals("order_no")) {
							colname = "p.order_no";
						}
						query1 =  " and "+colname + " like '%'||?||'%'";// �Ķ���ʹ� search_order
						flag1 = true;
					} else if (colname.equals("order_date")) {//colname = p_date
						
						if(order_date.equals("for7days"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-7,'YYYYMMDD') ";
						else if(order_date.equals("for1month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-30,'YYYYMMDD') ";
						else if(order_date.equals("for3month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-90,'YYYYMMDD') ";
						
					} else if (colname.equals("p_name") || colname.equals("p_no")) {
						
						query3 = " and " + colname + " like '%'||?||'%'";// �Ķ���ʹ� search_order_p
						
						flag2 = true;
					}
				}

				if (order_status[0] != "") {
					if (query2 != "" || flag1 || query3 != "") {
						if (order_status[0].equals("1")) {
							query4 = " and order_status = 1";
						} else {
							query4 = " and order_status = 0";
						}
					} else {
						if (order_status[0].equals("1")) {
							query4 = " and order_status = 1";
						} else {
							query4 = " and order_status = 0";
						}
					}
				}

				String sql = "select count(*) from (select distinct p.order_no order_no, M.mem_name, M.mem_id mem_id , p.order_total_cost, p.order_status, p.order_date" + 
						" from member M, order_detail O, order_pay P where m.mem_id = p.order_mem_id and p.order_no = o.order_no " + query1 + query2 + query3 + query4 + ")";
			//	System.out.println("ī��Ʈ �Լ����� " + sql);
				pstmt = con.prepareStatement(sql);

				if (flag1 && flag2) {
					pstmt.setString(1, search_order);
					pstmt.setString(2, search_order_p);
				} else if (flag1 && !flag2) {
					pstmt.setString(1, search_order);
				} else if (flag2 && !flag1) {
					pstmt.setString(1, search_order_p);
				}

				rs = pstmt.executeQuery();
			}

			if (rs.next()) {
				count = rs.getInt(1);// �˻������ 1�� �̹Ƿ�
			}

		} catch (SQLException e) {
			System.out.println("selectCountOrderPay()�޼ҵ忡�� �߻��ϴ� ���� " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
		return count;
	}

	public List<OrderListDTO> selectOrderPayAdminAll(int startRow, int endRow, String select_classification,
			String search_order, String order_date, String order_p, String[] order_status, String search_order_p) {
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;

		List<OrderListDTO> orderList = new ArrayList<OrderListDTO>();

		String query1 = "";
		String query2 = "";
		String query3 = "";
		String query4 = "";
	//	System.out.println("search_order_p  " + search_order_p);

		// list�� ""���� �ƴ� �ֵ鸸 �ִ´�.
		List<String> list = new ArrayList<String>();
		if (!search_order.equals("")) {// �ֹ��ڳ� �ֹ���ȣ��
			list.add(select_classification);
			System.out.println("select_classification    " + select_classification);
			System.out.println("search_order    " + search_order);
		} 
		if (!order_date.equals("")) {// �Ⱓ
			list.add("order_date");
			//System.out.println("order_date   " + order_date);
		} 
		if (!search_order_p.equals("")) {//
			list.add(order_p);
			System.out.println("search_order_p  " + search_order_p);
		}
		System.out.println(" DAO���� ����Ʈ������ " + list.size());

		try {
			con = getConnection();

			if (list.size() == 0) {
			//	String sql = "select * from (select rownum rn, temp.* from (select * from order_pay) temp)"
			//			+ " where rn between ? and ?";
				
				String sql = "select * from (select rownum rn, temp.* from ("
						+ "select distinct p.order_no order_no , M.mem_name, M.mem_id mem_id , p.order_total_cost, p.order_status, p.order_date " + 
						" from member M," + 
						"order_detail O," + 
						"order_pay P"
						 + 
						" where m.mem_id = p.order_mem_id" + 
						" and p.order_no = o.order_no"
						+ " order by order_date desc) temp)"
						+ " where rn between ? and ?";

				pstmt = con.prepareStatement(sql);
				pstmt.setInt(1, startRow);
				pstmt.setInt(2, endRow);

				rs = pstmt.executeQuery();

			} else {// �˻��Ѱ� ��� �ϳ��� ����
					// int size = list.size();
					// System.out.println("�˻��� ���� : "+ size);
				boolean flag1 = false, flag2 = false;

				// �ֹ��� �̸��� ���� member���̺� ����
				// ��ǰ��ȣ�� ��ǰ���̺� ����
				for (String colname : list) {
					if (colname.equals("mem_id") || colname.equals("order_no")) {
						if(colname.equals("order_no")) {
							colname = "p.order_no";
						}
						query1 = " and " + colname + " like '%'||?||'%'";// �Ķ���ʹ� search_order
						flag1 = true;
					} else if (colname.equals("order_date")) {//colname = p_date
						
						if(order_date.equals("for7days"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-7,'YYYYMMDD') ";
						else if(order_date.equals("for1month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-30,'YYYYMMDD') ";
						else if(order_date.equals("for3month"))
							query2 = " and " + colname + " >= TO_CHAR(SYSDATE-90,'YYYYMMDD') ";
						
					} else if (colname.equals("p_name") || colname.equals("p_no")) {
						
						query3 = " and " + colname + " like '%'||?||'%'";// �Ķ���ʹ� search_order_p
						
						flag2 = true;
					}
				}
				if (order_status[0] != "") {
					if (query2 != "" || flag1 || query3 != "") {
						if (order_status[0].equals("1")) {
							query4 = "and order_status = 1";
						} else {
							query4 = "and order_status = 0";
						}
					} else {
						if (order_status[0].equals("1")) {
							query4 = " and order_status = 1";
						} else {
							query4 = " and order_status = 0";
						}
					}

				}

				String sql = "select * from (select rownum rn, temp.* from ("
						+ "select distinct p.order_no order_no, M.mem_name, M.mem_id mem_id , p.order_total_cost, p.order_status, p.order_date " + 
						" from member M," + 
						" order_detail O," + 
						" order_pay P"
						+ 
						" where m.mem_id = p.order_mem_id" + 
						" and p.order_no = o.order_no"
						+ query1
						+ query2 + query3 + query4+ " order by order_date desc) temp)"
						+ " where rn between ? and ?";
				
				pstmt = con.prepareStatement(sql);

				if (flag1 && flag2) {
					pstmt.setString(1, search_order);
					pstmt.setString(2, search_order_p);
					pstmt.setInt(3, startRow);
					pstmt.setInt(4, endRow);

				} else if (flag1 && !flag2) {
					pstmt.setString(1, search_order);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);

				} else if (flag2 && !flag1) {
					pstmt.setString(1, search_order_p);
					pstmt.setInt(2, startRow);
					pstmt.setInt(3, endRow);

				} else if(!flag2 && !flag1) {
					pstmt.setInt(1, startRow);
					pstmt.setInt(2, endRow);
				}
				System.out.println(sql);
				//System.out.println("�Ѿ�°�" + search_order_p);
				rs = pstmt.executeQuery();
			}

			while (rs.next()) {
				OrderListDTO dto = new OrderListDTO();
				dto.setMemName(rs.getString("mem_name"));
				//System.out.println("�־ȳ���" + rs.getString("mem_name"));
				
				dto.setMemID(rs.getString("mem_id"));
				//dto.setOrderdetailPNo(rs.getInt("orderdetail_p_no"));
				//dto.setOrderPAmount(rs.getInt("order_p_amount"));
				dto.setOrderNo(rs.getString("order_no"));
				dto.setOrderTotalCost(rs.getInt("order_total_cost"));
				dto.setOrderStatus(rs.getInt("order_status"));
				dto.setOrderDate(rs.getString("order_date"));
				//dto.setpName(rs.getString("p_name"));

				orderList.add(dto);
				
			}

		} catch (SQLException e) {
			System.out.println("selectOrderPayAdminAll() ���� �߻��ϴ� ���� " + e.getMessage());
		} finally {
			close(con, pstmt, rs);
		}
	//	System.out.println("�ߤ��������� " +orderList.size() );
		return orderList;
	}
	

	public List<OrderListDTO> selectOrderDetail(String orderNo){
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		List<OrderListDTO> list = new ArrayList<OrderListDTO>();
		
		try {
			con = getConnection();
			
			String sql = "select M.mem_name, M.mem_id mem_id , o.orderdetail_p_no, o.order_p_amount ,p.order_no, p.order_total_cost, p.order_status, p.order_date, pd.p_name, pd.p_cost" + 
						" from member M," + 
						" order_detail O," + 
						" order_pay P,"
						+ " product pd" + 
						" where m.mem_id = p.order_mem_id" + 
						" and p.order_no = o.order_no"
						+ " and pd.p_no = o.orderdetail_p_no and o.order_no = ?";
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, orderNo);
			
			rs = pstmt.executeQuery();
			
			while(rs.next()) {
				OrderListDTO dto = new OrderListDTO();
				dto.setpName(rs.getString("P_name"));
				dto.setpCost(rs.getInt("p_cost"));
				dto.setOrderPAmount(rs.getInt("order_p_amount"));
				dto.setOrderTotalCost(rs.getInt("order_total_cost"));
				list.add(dto);
			}
			
		} catch (SQLException e) {
			System.out.println("selectOrderDetail()������ ���� �߻� " + e.getMessage());
		}finally {
			close(con, pstmt, rs);
		}
		return list;
	}

	public int deleteOrder(String orderNo) {
		Connection con = null;
		PreparedStatement pstmt = null;
		//ResultSet rs = null;
		
		int rows = 0;
		
		try {
			con = getConnection();
			String sql = "update order_pay set order_status = 0 where order_no = ?";
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, orderNo);
			
			rows = pstmt.executeUpdate();
			
		} catch (SQLException e) {
			System.out.println("");
		}finally {
			close(con, pstmt);
		}
		return rows;
	}
}
