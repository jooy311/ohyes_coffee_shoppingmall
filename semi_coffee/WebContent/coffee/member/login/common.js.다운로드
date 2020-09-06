function formatAMPM(dateStr) {
	var date;
	if(dateStr==""){
		date = new Date();
	}else{
		date = new Date(dateStr);
	}
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
} 

// 널 체크
function checkNull(obj){
	if ( 
		typeof(obj)  === 'undefined'
		|| typeof(obj)  === undefined
		|| typeof(obj) == 'undefined'
		|| typeof(obj) == undefined 
		|| '' == obj 
		|| 'null' == obj 
		|| null == obj 
	){
		return false;
	}
	return true;
}

function month_add(sDate , nMonths , t ) {
	var yy = parseInt(sDate.substr(0, 4), 10);
	var mm = parseInt(sDate.substr(5, 2), 10);
	if ( t == "pre" ) mm = mm - nMonths;
	else if ( t == "next" ) mm = mm + nMonths;
	d = new Date(yy, mm - 1, 1 );
	yy = d.getFullYear();
	mm = d.getMonth() + 1; mm = (mm < 10) ? '0' + mm : mm;
	return '' + yy + '-' +  mm  ;
}

function is_mobile(){
	var UserAgent = navigator.userAgent;
	var device = false;
	if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null){
		device = true;
	}
	return device;
}



function goParentChat(this_adkey , type,  room){
    var url = '/chat/' + type + "?searchChatroom=" + room ;
    if ( this_adkey == 'Y' ){
        location.href = url;
    }else{

        var form = parent.document.createElement("form");
        form.setAttribute("charset", "UTF-8");
        form.setAttribute("method", "Post");  //Post 방식
        form.setAttribute("action", "/main"); //요청 보낼 주소

        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "usersite");
        hiddenField.setAttribute("value", this_adkey);
        form.appendChild(hiddenField);

        hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "redirect_url");
        hiddenField.setAttribute("value", url);
        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    }
    self.close();    
    // alert(url);

// http://localhost:3000/chat/naver?searchChatroom=xqLPIz2SsRDL1Uhc2AoiVw
// http://localhost:3000/chat/mirae?searchChatroom=rxNmM2zahyyuCJrt9nbVqH9mjrKKssOX
    
	// location.href = '/chat/' + type;
	
}

function nl2br (varTest){
	return varTest.replace(/\n/g, "<br>");
};

function br2nl (varTest){
	return varTest.replace(/<br>/g, "\r");
};


function url_parse (url){
    var result = {};
    var scheme ='';
    var host ='';
    var port ='';
    var path ='';
    var query ='';
    var fragment = '';
    try{
        var url_arr = url.split("?");

        var domain = url_arr[0];
        if ( url_arr.length > 1 ) query = "?" + url_arr[1];

        var query_temp = query.split("#");
        query = query_temp[0];
        if ( query_temp.length > 1 ) fragment = query_temp[1];

		var expUrl = /^http[s]?\:\/\//i;
		if ( expUrl.test(domain)  ){
			scheme = domain.indexOf("https") > -1 ? "https" : "http";
			host = domain.replace(scheme + "://" ,"");
		}else{
			host = domain;
		}
		path_temp = host.split("/");

        var host_temp = host.split(":");
        if ( host_temp.length > 1 ) {
			host = host_temp[0];
			port = host_temp[1].split("/")[0];
		}

        var path_arr = [];
        if ( path_temp.length > 1 ) {
            for( var i = 1 ; i < path_temp.length ; i++ ) path_arr.push(path_temp[i]);
        }
        path = path_arr.join("/");
        
        result.url = url ;
        result.scheme = scheme;
        result.host = host;
        result.port = port;
        result.path = path;
        result.query = query;
        result.fragment = fragment;
    }catch(e){
        result.url = url ;
        result.scheme = scheme;
        result.host = host;
        result.port = port;
        result.path = path;
        result.query = query;
        result.fragment = fragment;
    }
    return result;
}