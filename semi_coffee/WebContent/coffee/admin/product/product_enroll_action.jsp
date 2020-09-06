<%@page import="java.io.File"%>
<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="com.oreilly.servlet.multipart.DefaultFileRenamePolicy"%>
<%@page import="com.oreilly.servlet.MultipartRequest"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
 <%
 	//입력파일을 저장하기위해 서버디렉토리의 시스템경로를 반환받아 저장
 	String saveDirectory = request.getServletContext().getRealPath("/coffee/admin/product_images");
 	
 	//multipartRequest인스턴스를 생성
 	//=>파일을 업로드 시키기 위함
 	MultipartRequest mr = new MultipartRequest(request, saveDirectory, 30*1024*1024, "utf-8", new DefaultFileRenamePolicy());
 	
 	//enroll페이지에서 전달한 파라미터를 받아온다
 	int pcategoryCode = 0;
 	String product_category = mr.getParameter("product_category"); //1,2,3중에 하나
 	if(product_category.equals("goods")){
 		pcategoryCode = 1;
 	}else if(product_category.equals("blend_beans")){
 		pcategoryCode = 2;
 	}else if(product_category.equals("single_beans")){
 		pcategoryCode = 3;
 	}
 	
 	//System.out.println("카테고리" + product_category);
 	//String selected_no = mr.getParameter("beansGram");
 	//if(selected_no == null) selected_no = "0"; //커피용품일때
 	
 	String product_no_front = mr.getParameter("product_no_front");
 	String product_no = mr.getParameter("product_no");
 	
 	String pNo = product_no_front + product_no;
 	
 	String pDate = mr.getParameter("product_date");
 	String pName = mr.getParameter("product_name");
 	int pCost = Integer.parseInt(mr.getParameter("product_cost"));//
 	String pBrief = mr.getParameter("product_brief");
 	int pStock = Integer.parseInt(mr.getParameter("product_stock"));
 	//String product_detail = mr.getParameter("product_detail");
 	String pImage = mr.getFilesystemName("product_image");
 	String pImageDetail = mr.getFilesystemName("product_detail_image");
 	String pImagePath = "nothing";
 	String pImageDetailPath = "nothing";
 	
 	ProductDTO product = new ProductDTO();
 	product.setpNo(pNo);
 	product.setPcategoryCode(pcategoryCode);
 	product.setpStock(pStock);
 	product.setpName(pName);
 	product.setpCost(pCost);
 	product.setpBrief(pBrief);
 	product.setpImage(pImage);
 	product.setpImagePath(pImagePath);//
 	product.setpImageDetail(pImageDetail);
 	product.setpImageDetailPath(pImageDetailPath);//
 	product.setpDate(pDate);
 //	product.setpStatus(pStatus);//
 	//product.setpSalesCount(pSalesCount);//
 	
 	//제품코드를 전달하여 product 테이블에 저장된 해당 제품정보를 검색하여 반환하는 DAO클래스의 메소드를 호출
	//product테이블에 동일한 제품코드가 저장되는 것을 방지하기 위함임(원래는 입력페이지에서 하는게 좋음)
	//입력된 제품코드가 중복된 경우 제품등록 입력페이지로 이동
	if(ProductAdminDAO.getProductAdminDAO().checkProductNo(pNo) == 1){
		//이미 업로드 처리된 파일을 제거하자
		new File(saveDirectory, pImage).delete();
		
		session.setAttribute("message", "이미등록된 제품코드를 입력했습니다.");
		session.setAttribute("product", product);
		
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/site/index.jsp?workgroup=admin&work=product_add';");
		out.println("</script>");
	}
 	
 	ProductAdminDAO.getProductAdminDAO().insertProductAdmin(product);
 	
	//제품목록 출력페이지 이동
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=product&work=list';");
	out.println("</script>");
 %>
