<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	String message=(String)session.getAttribute("message");
	if(message==null) {
		message="";
	} else {
		session.removeAttribute("message");
	}
	
	String memId=(String)session.getAttribute("memId");
	if(memId==null) {
		memId="";
	} else {
		session.removeAttribute("memId");
	}
%>

<link rel="stylesheet" type="text/css" href="./member/login/optimizer.php">
<link rel="stylesheet" type="text/css" href="./member/login/optimizer(1).php">


<!--allStore_contents-->
<div id="allStore_contents">
    <div class="allStore_layout">
        <!--로그인-->
        <div class="allStore-login">

            <div class="login-box">
                <div class="login-cont">
                    <div class="xans-element- xans-member xans-member-login ">
                        <div class="login">
                            <h3><img src="./member/login/h3_login.gif" alt="회원로그인"></h3>
                            <form id="login" name="loginForm"
                                action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=login_action"
                                method="post" onsubmit="return;">
                                <fieldset>
                                    <legend>회원로그인</legend>
                                    <div id="message" style=" color: red;"><%=message %></div>
                                    <label class="id ePlaceholder" title="아이디">
                                        <input id="memId" name="memId" value="<%=memId%>" placeholder="아이디"
                                            type="text"></label>
                                    <label class="password ePlaceholder" title="비밀번호">
                                        <input id="memPwd" name="memPwd" value="" type="password"
                                            placeholder="비밀번호"></label>
                                    <a><button type="submit" id="loginbtn"><img src="./member/login/btn_login.gif"
                                                alt="로그인"></button></a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- 아이디,비밀번호찾기 -->
                <div class="forget">
                    <ul>
                        <li>
                            <font><i class="fa fa-caret-right" aria-hidden="true"></i> 가입을 하시면 다양한 혜택이 준비되어 있습니다.</font>
                            <a href="index.jsp?workgroup=member&work=join">회원가입 <i class="fa fa-angle-right"
                                    aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <font><i class="fa fa-caret-right" aria-hidden="true"></i> 혹시 아이디 혹은 비밀번호를 잊으셨나요?</font>
                            <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=fine_id">아이디
                                찾기 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=fine_pwd">비밀번호
                                찾기 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#memId").focus();

    $("#loginbtn").click(function () {
        if ($("#memId").val() == "") {
            alert("아이디를 입력해 주세요.");
            $("#memId").focus();
            return false;
        }

        if ($("#memPwd").val() == "") {
            alert("비밀번호를 입력해 주세요.");
            $("#memPwd").focus();
            return false;
        } else if (checkPWD.test($("#memPwd").val()) != true) {
            alert("영문자/숫자/특수문자가 반드시 하나이상 포함된 6~20자리로 입력해 주세요.");
            $("#memPwd").focus();
            return false;
        }
        $("#login").submit();
    });

</script>