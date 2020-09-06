var PGMODULE_payForm;
var PGMODULE_language;
var PGMODULE_LanguagePack = {
    "JP": {
        "popupBlock": "決済を行うために、ポップアップを許容してください。"
        , "PJE001": "[PJE001] Bad Request"
        , "PJE002": "[PJE002] Bad Request"
        , "PJE003": "[PJE003] Bad Request"
        , "PJE004": "[PJE004] Bad Request"
    },
    "EN": {
        "popupBlock": "Allow pop-up to proceed to payment."
        , "PJE001": "[PJE001] Bad Request"
        , "PJE002": "[PJE002] Bad Request"
        , "PJE003": "[PJE003] Bad Request"
        , "PJE004": "[PJE004] Bad Request"
    },
    "CN": {
        "popupBlock": "为了支付，请允许弹出窗口。"
        , "PJE001": "[PJE001] Bad Request"
        , "PJE002": "[PJE002] Bad Request"
        , "PJE003": "[PJE003] Bad Request"
        , "PJE004": "[PJE004] Bad Request"
    },
    "KR": {
        "popupBlock": "팝업차단을 해제해주세요"
        , "PJE001": "[PJE001] 잘못된 요청"
        , "PJE002": "[PJE002] 잘못된 요청"
        , "PJE003": "[PJE003] 잘못된 요청"
        , "PJE004": "[PJE004] 잘못된 요청"
    }
};

/**
 * 결제진행
 * @param string
 * @param form DOM
 * @param string callbackFunction Name
 */
function processStdPay(sPgName, form, callbackName, option) {
    var return_data = {
        sync: true,
        result: false,
        msg: ""
    };

    PGMODULE_Std.option = option || {};

    PGMODULE_language = PGMODULE_LanguagePack.KR;
    try {
        if (form.pg_language.value) {
            PGMODULE_language = PGMODULE_LanguagePack[form.pg_language.value];
        }
    } catch(e) {}

    if (typeof callbackName === "function") {
        PGMODULE_Std.setCallback(callbackName);
    } else {
        alert(PGMODULE_language.PJE003);
        return false;
    }

    if (sPgName === null) {
        return_data.msg = PGMODULE_language.PJE001;
        PGMODULE_Std.sendCallback(return_data);
    }

    eval("var funcType = typeof PGMODULE_" + sPgName + "_std.procPay");
    if (funcType == "function") {
        eval("return_data = PGMODULE_" + sPgName + "_std.procPay(form);");

        if (return_data.sync === true) {
            //동기방식일때만 즉시 응답
            PGMODULE_Std.sendCallback(return_data);
        }
    } else {
        return_data.msg = PGMODULE_language.PJE002;
        PGMODULE_Std.sendCallback(return_data);
    }
}



var PGMODULE_Std = {
    'originalCharset':'',

    setCallback:function(callback) {
        this.callbackFunc = callback;
    },
    sendCallback:function(result) {
        // IE10 이전의 버전에서 강제로 개발자 도구를 띄우는 효과
        try{
            if (!window.console){console={}; console.log = function(){};}
        } catch (e) {}

        try {
            this.callbackFunc(result);
        } catch(e) {
            alert(PGMODULE_language.PJE004);
            return false;
        }
    },
    chkPopup:function(popup_window) {
        var _scope = this;
        if (popup_window) {
            if (/chrome/.test(navigator.userAgent.toLowerCase())) {
                setTimeout(function () {
                    _scope._is_popup_blocked(_scope, popup_window);
                 },2000);
            } else {
                popup_window.onload = function() {
                    _scope._is_popup_blocked(_scope, popup_window);
                };
                _scope._popup_load(popup_window);
            }
        } else {
            _scope._displayError();
        }
    },
    _is_popup_blocked: function(scope, popup_window) {
        if ((popup_window.innerHeight > 0) === false) {
            scope._displayError();
        } else {
            scope._popup_load(popup_window);
        }
    },
    _displayError:function() {
        alert(PGMODULE_language.popupBlock);
    },
    _popup_load:function(popup_window) {
        popup_window.focus();
    },
    /**
     * 캐릭터셋 변경
     * @param  {[type]} form    변경대상 폼객체
     * @param  {[type]} charset 변경대상 캐릭터셋
     * @return void
     */
    chzCharset:function(form, charset) {
        form.acceptCharset = charset;

        try {
            if (document.charset) document.charset = charset;
            //IE만 가능&나머지 브라우저는 readonly
            document.characterSet = charset;
        } catch(e) {}
    },
    /**
     * 캐릭터셋 백업
     * @return void
     */
    backupCharset:function() {
        try {
            if (document.charset) this.originalCharset = document.charset;
            this.originalCharset = document.characterSet;
        } catch(e) {}
    },
    /**
     * 백업된 캐릭터셋으로 복구
     * @param  {[type]} form 복구대상 폼 객체
     * @return void
     */
    restoreCharset:function(form) {
        this.chzCharset(form, this.originalCharset);
    },
    /**
     * 폼에서 disabled 된 element 들을 다시 복구
     */
    restoreFormElements:function(form) {
        //disabled 된 element를 다시 살림
        var iFrmLen = form.length;
        for (var iCnt=0; iCnt<iFrmLen; iCnt++) {
            if (form.elements[iCnt].disabled === true) {
                form.elements[iCnt].disabled = false;
            }
        }
    },
    /**
     * 배열내에 해당 값이 있는가 체크
     */
    chkInArray:function(elem, arr, i) {
        var len;

        if (arr) {
            len = arr.length;
            i = i ? i < 0 ? Math.max( 0, len + i ) : i : 0;

            for ( ; i < len; i++) {
                if (i in arr && arr[i] === elem) {
                    return i;
                }
            }
        }

        return -1;
    },
    setComma:function(n) {
        var reg = /(^[+-]?\d+)(\d{3})/;
        n += '';
        while (reg.test(n)) {
            n = n.replace(reg, '$1' + ',' + '$2');
        }
        return n;
    },
    onLoadedStdConfirmLayer:function() {
        if (document.getElementById('pgm_subscription_title') && typeof this.option.pgmConfirmLayerTitle === 'string') {
            document.getElementById('pgm_subscription_title').innerHTML = this.option.pgmConfirmLayerTitle;
        }

        if (document.getElementById('pgm_subscription_caption_title') && typeof this.option.pgmConfirmLayerTitle === 'string') {
            document.getElementById('pgm_subscription_caption_title').innerHTML = this.option.pgmConfirmLayerTitle;
        }

        if (document.getElementById('pgm_subscription_contents') && typeof this.option.pgmConfirmLayerContents === 'string') {
            document.getElementById('pgm_subscription_contents').innerHTML = this.option.pgmConfirmLayerContents;
        }
    }
};
