<%@page import="java.io.File"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="com.oreilly.servlet.multipart.DefaultFileRenamePolicy"%>
<%@page import="com.oreilly.servlet.MultipartRequest"%>
<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
<%
	//입력파일을 저장하기 위한 서버 디렉토리의 시스템 경로를 반환받아 저장
	String saveDirectory=request.getServletContext().getRealPath("/coffee/admin/product_images");
	
	//MultipartRequest 인스턴스 생성
	// => 모든 입력파일을 서버 디렉토리에 자동으로 업로드 처리하여 저장
	MultipartRequest mr=new MultipartRequest(request, saveDirectory
			, 30*1024*1024, "UTF-8", new DefaultFileRenamePolicy());
	

   	//String productNO = (String)request.getParameter("productNO");

  	//edit페이지에서 전달한 파라미터를 받아온다
 	
 	String product_no_front = mr.getParameter("product_no_front");
 	String product_no = mr.getParameter("product_no");
 	
 	String pNo = product_no_front + product_no;
 	
 	String currentImage = mr.getParameter("currentImage");
 	String currentDetailImage = mr.getParameter("currentDetailImage");
 	
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
 //	product.setPcategoryCode(pcategoryCode);
 	product.setpStock(pStock);
 	product.setpName(pName);
 	product.setpCost(pCost);
 	product.setpBrief(pBrief);
 	
	if(pImage!=null) {//제품이미지를 변경한 경우
		product.setpImage(pImage);
		//기존 제품이미지 파일 제거
		new File(saveDirectory,currentImage).delete();		
	} else {//제품이미지를 변경하지 않을 경우
		product.setpImage(currentImage);
	}
	
	if(pImageDetail!=null) {//제품이미지를 변경한 경우
		product.setpImageDetail(pImageDetail);
		//기존 제품이미지 파일 제거
		new File(saveDirectory,currentDetailImage).delete();		
	} else {//제품이미지를 변경하지 않을 경우
		product.setpImageDetail(currentDetailImage);
	}
	

   	//3. 받아온값으로 DAO로 보내서 검색하도록 한다.
   	int selectedPno = ProductAdminDAO.getProductAdminDAO().updateProdcutAdmin(product);
   	//System.out.println("dao에서 받아온값 : "+"productNo");
   	
  	//제품목록 출력페이지 이동
  	out.println("<script type='text/javascript'>");
  	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=product&work=list';");
  	out.println("</script>");
%>