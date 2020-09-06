var name;
var count;
var	cost
var totCost;
var payCost;
var nowCost=0;
var payCost;
var btnStatus=0;

//위 버튼 누르면 수량증가
$(".QuantityUp").click(function(){
	name=$(this).attr("name");
	count=document.getElementById("quantity_"+name);
	cost=$("#productCost_"+name).text();
	count.value=Number(count.value)+1;
	totCost=cost*Number(count.value);
	$(".totCost").text(totCost);
	btnStatus=1;
});

//아래 버튼 누르면 수량감소
$(".QuantityDown").click(function(){
	name=$(this).attr("name");
	count=document.getElementById("quantity_"+name);
	cost=$("#productCost_"+name).text();
	count.value=Number(count.value)-1;
	if(count.value<=0){
		count.value=1;
	}
	totCost=cost*Number(count.value);
	$(".totCost").text(totCost);
	btnStatus=1;
});
//============
//변경버튼 누르면 수량변경
function modifyBtn(){
	if(btnStatus==1){
		name=$(this).attr("name");
		var tot=$(".totCost").text()*1;
		var after=$("#totCost_"+name).text()*1;
		$(".beforeCost").text(after);
		$("#totCost_"+name).text(tot);
		btnStatus=0;
		if($("#totCost_"+name).text()*1>$(".beforeCost").text()*1){
			var costPlus=$("#totCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			var payPlus=$("#payCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			$("#totCost").text(costPlus);
			$("#payCost").text(payPlus);
		} else if($("#totCost_"+name).text()*1<$(".beforeCost").text()*1){
			var costMinus=$("#totCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			var payMinus=$("#payCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			$("#totCost").text(costMinus);
			$("#payCost").text(payMinus);
		} else{
			
		}
		$(".amount").attr("value", document.getElementById("quantity_"+name).value);
		$(".no").attr("value", document.getElementById("cartNo_"+name).value);
		$("#modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_modify_action");
		$("#modifyForm").submit();
	}
};
//삭제버튼 눌렀을때 삭제
$(".removeBtn").click(function(){
	if(confirm("정말로 삭제 하시겠습니까?")) {
		name=$(this).attr("name");
		$(".no").attr("value", document.getElementById("cartNo_"+name).value);
		$("#modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_remove_action");
		$("#modifyForm").submit();
	}
});
//장바구니 비우기 버튼 눌렀을때 삭제
$("#allRemove").click(function(){
	if(confirm("정말로 삭제 하시겠습니까?")) {
		$(".remove_status").attr("value", "1");
		$(".modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_remove_action");
		$(".modifyForm").submit();
	}
});

//처음페이지 출력했을 때 전체가격 계산
$(document).ready(function(){
	if($("#allChacked").is(":checked")) {
		var checkClassLeng=document.getElementsByClassName("basket_chk_class").length;
		if(checkClassLeng!=0){
			for (i=0; i < checkClassLeng; i++) {
				name=$(".basket_chk_class").eq(i).attr("value");				
		        if ($("#basket_chk_"+name).attr("checked")=="checked") {
					count=document.getElementById("quantity_"+name);
					cost=$("#productCost_"+name).text();
					ptotCost=cost*Number(count.value);
					$("#totCost_"+name).text(ptotCost);
					nowCost=$("#totCost").text()*1;
					totCost=nowCost+(cost*Number(count.value));
					$("#totCost").text(totCost);
		        }
			}
			payCost=totCost+2500;
			$("#payCost").text(payCost);
		} else {
		$("#payCost").text(0);				
		}
	}
});

//전체선택 체크박스누르면 아래 체크박스 선택/취소
$("#allChacked").change(function(){
	if($(this).is(":checked")) {
		$(".basket_chk_class").prop("checked", true);
		$("#totCost").text(0);
		$("#payCost").text(0);
		var checkClass=new Array();
		checkClass=document.getElementsByClassName("basket_chk_class");
		var checkClassLeng=checkClass.length;
		for (i=0; i < checkClassLeng; i++) {
			name=$(".basket_chk_class").eq(i).attr("value");
	        if ($("#basket_chk_"+name).attr("checked")=="checked") {
				name=$("#basket_chk_"+name).attr("value");
				count=document.getElementById("quantity_"+name);
				cost=$("#productCost_"+name).text();
				nowCost=$("#totCost").text()*1;
				totCost=nowCost+(cost*Number(count.value));
				$("#totCost").text(totCost);
	        }
		}
		payCost=totCost+2500;
		$("#payCost").text(payCost);
	} else {
		$(".basket_chk_class").prop("checked", false);
		$("#totCost").text(0);
		$("#payCost").text(0);
	}
});

//체크박스 하나씩 누를때 가격 추가/감소
$(".basket_chk_class").change(function(){
	var checkClass=new Array();
		checkClass=document.getElementsByClassName("basket_chk_class");
	var checkClassLeng=checkClass.length;
	var checked=0;
	if($(this).is(":checked")) {
		name=$(this).attr("value");
		count=document.getElementById("quantity_"+name);
		cost=$("#productCost_"+name).text();
		nowCost=$("#totCost").text()*1;
		totCost=nowCost+(cost*Number(count.value));
		for (i=0; i < checkClassLeng; i++) {
	        if (checkClass[i].checked==true) {
	            checked += 1;
	        }
		}
	} else {
		name=$(this).attr("value");
		count=document.getElementById("quantity_"+name);
		cost=$("#productCost_"+name).text();
		nowCost=$("#totCost").text()*1;
		totCost=nowCost-(cost*Number(count.value));
		for (i=0; i < checkClassLeng; i++) {
	        if (checkClass[i].checked==true) {
	            checked -= 1;
	        }
		}
	}
	payCost=totCost+2500;
	if(checked==0){
		payCost=0;
		$("#allChacked").prop("checked", false);
	}
	if(checked==checkClassLeng){
		$("#allChacked").prop("checked", true);
	}
	$("#totCost").text(totCost);
	$("#payCost").text(payCost);
});

//-------------------------------------------

	$("#allOrder").click(function(){
		$("#cartForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=pay&work=Pay_cart");
		cartForm.submit();
	});
	
	$("#selectOrder").click(function(){
		$("#cartForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=pay&work=Pay_cart");
		cartForm.submit();
	});