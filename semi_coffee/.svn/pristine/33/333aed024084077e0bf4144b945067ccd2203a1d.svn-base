var stdCallBackFunc;
var PGMODULE_payForm;

var PGMODULE_inicis_std = {
    'Channel':'web',

    procPay:function(frm) {
        this.filterReqData(frm);
        PGMODULE_payForm = frm;
        if (typeof PGMODULE_payForm.pgm_nointerest != 'undefined') {
            $('<input />').attr('type', 'hidden').attr('id', 'nointerest').attr('name', 'nointerest')
                          .attr('value', PGMODULE_payForm.pgm_nointerest.value)
                          .appendTo(PGMODULE_payForm);
        }
        window.name = "INICIS_STD_PAYMENT";

        var sPatternMode = /^Mobile/;
        if (sPatternMode.test(PGMODULE_payForm.moduleMode.value)) {
            this.Channel = 'mobile';
        }

        try {
            this.createPayLayer();
        } catch(e) {
            processPayResult(false, '[PJE-010] Not found');
            return false;
        }

        var return_data = {
            sync: false,
            result: true,
            msg: ""
        };

        return return_data;
    },

    /**
     * 요청데이터중에서 결제이슈가 발생되는 일부 스펙에 대하여 disabled처리
     * PGMODULE_Std.restoreFormElements 를 통해 원복함
     *   > filterList에 명시된 것만 disable 한다
     */
    filterReqData:function(frm) {
        var filterList = [
            "pgm_extra_req_data",
            "pgm_offer_period"
        ];
        var iFrmLen = frm.length;
        var remoteList = [];

        for (var iCnt=0; iCnt<iFrmLen; iCnt++) {
            var sEleName = frm.elements[iCnt].name;
            var result = PGMODULE_Std.chkInArray(sEleName, filterList);

            if (result >= 0) {
                //삭제처리
                remoteList.push(sEleName);
            }
        }

        var iLen = iFrmLen;
        while (iLen--) {
            var sEleName = frm.elements[iLen].name;
            var result = PGMODULE_Std.chkInArray(sEleName, remoteList);
            if (result >= 0 && sEleName) {
                frm.elements[iLen].disabled = true;
            }
        }
    },

    createPayLayer:function() {
        var layerObj, itemObj;

        layerObj = document.getElementById('stdPaymentConfirm');
        if (layerObj === null) {
            try {
                //ie
                layerObj = document.createElement('<div id="stdPaymentConfirm">');
            } catch (e) {
                //non ie
                layerObj = document.createElement('div');
                layerObj.setAttribute('id', 'stdPaymentConfirm');
            }

            try {
                //ie
                itemObj = document.createElement('<div id="stdPaymentConfirmBackground">');
            } catch (e) {
                //non ie
                itemObj = document.createElement('div');
                itemObj.setAttribute('id', 'stdPaymentConfirmBackground');
            }

            if (PGMODULE_inicis_std.Channel === 'mobile') {
                itemObj.style.opacity = '0.5';
                itemObj.style.filter = 'alpha(opacity=50)';
                itemObj.style.position = 'fixed';
            } else {
                itemObj.style.filter = 'alpha(opacity=20)';
                itemObj.style.opacity = '0.2';
                itemObj.style.position = 'absolute';
            }

            itemObj.style.left = '0px';
            itemObj.style.top = '0px';
            itemObj.style.backgroundColor = '#999';
            itemObj.style.width = '100%';
            itemObj.style.height = '100%';
            itemObj.style.zIndex = '2000';
            layerObj.appendChild(itemObj);

            try {
                //ie
                itemObj = document.createElement('<div id="stdPaymentConfirmView">');
            } catch (e) {
                //non ie
                itemObj = document.createElement('div');
                itemObj.setAttribute('id', 'stdPaymentConfirmView');
            }

            layerObj.appendChild(itemObj);

            document.getElementsByTagName('body')[0].appendChild(layerObj);
        } else {
            document.getElementById('stdPaymentConfirmView').innerHTML = '';
            document.getElementById('stdPaymentConfirmView').style.top = '0';
            document.getElementById('stdPaymentConfirmView').style.left = '0';
        }
        this.setPaymentData();
    },
    getHtml:function () {
        var con = document.getElementById('stdPaymentConfirmView')
            , xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                con.innerHTML = xhr.responseText;

                var hBody = document.body;

                var scrollTop = 0;
                var hObjView = document.getElementById('stdPaymentConfirmView');
                if (hBody.scrollTop == 0) {
                    scrollTop = document.documentElement.scrollTop;
                } else {
                    scrollTop = hBody.scrollTop;
                }

                if (PGMODULE_inicis_std.Channel === 'mobile') {
                    hObjView.style.top = '10px';
                    hObjView.style.left = '0px';
                    hObjView.style.width = '95%';
                    hObjView.style.minWidth = '320px';

                    window.scrollTo(0,0);
                } else {
                    PGMODULE_inicis_std.togglePayLayer(true);

                    hObjView.style.top = parseInt(scrollTop) + (parseInt(hObjView.offsetHeight) / 2) + 'px';
                    hObjView.style.left = (parseInt(hBody.scrollLeft) + (parseInt(hBody.offsetWidth) - parseInt(hObjView.offsetWidth)) / 2) + 'px';
                }

                if (PGMODULE_payForm.reqType.value === 'SubscriptionRegister') {
                    PGMODULE_Std.onLoadedStdConfirmLayer();
                } else {
                    var amountText = PGMODULE_inicis_std.setComma(PGMODULE_payForm.goodAmount.value);
                    document.getElementById('pgm_inicis_std_amount').innerHTML = amountText;
                    document.getElementById('pgm_inicis_std_product_name').innerHTML = PGMODULE_payForm.goodName.value;
                }


                var hObjBg = document.getElementById('stdPaymentConfirmBackground');
                hObjBg.style.width = document.body.scrollWidth + 'px';
                hObjBg.style.height = document.body.scrollHeight + 'px';

                PGMODULE_inicis_std.togglePayLayer(true);
            }
        }
        if (PGMODULE_payForm.reqType.value === 'SubscriptionRegister') {
            var load_html = '/Pay/html/inicis/layer_std_subscription.html';
        } else {
            var load_html = '/Pay/html/inicis/layer_std_common.html';
        }

        xhr.open("GET", load_html, true);
        xhr.setRequestHeader('Content-type', 'text/html');
        if (xhr.overrideMimeType) {
            xhr.overrideMimeType('text/html; charset=UTF-8');
        }
        xhr.send();
    },
    setPaymentData:function() {
        var layerObj = document.getElementById('stdPaymentConfirmView');
        var string, sHtml;

        this.getHtml();
    },
    setComma:function(n) {
        var reg = /(^[+-]?\d+)(\d{3})/;
        n += '';
        while (reg.test(n)) {
            n = n.replace(reg, '$1' + ',' + '$2');
        }
        return n;
    },
    togglePayLayer:function(bType) {
        var layerObj = document.getElementById('stdPaymentConfirm');
        if (bType === true) {
            layerObj.style.display = 'block';
        } else {
            layerObj.style.display = 'none';
        }
    },
    getCss:function() {
        var URL = "//ecimg.echosting.cafe24.com/sfd/pgm/css/inicis/layer_std_common.css";
        var o = document.createElement('link');
            o.setAttribute('rel', 'stylesheet');
            o.setAttribute('type', 'text/css');
            o.setAttribute('id', 'InicisStdStylesheet');
            o.setAttribute('href', URL);
        document.getElementsByTagName('head').item(0).appendChild(o);
    },

    closePayLayer:function(){
        this.togglePayLayer(false);
        processPayResult(false, '사용자가 취소하였습니다.');
    },
    procOpen:function() {
        this.togglePayLayer(false);
        stdCallBackFunc = PGMODULE_Std;

        PGMODULE_Std.backupCharset();
        PGMODULE_Std.chzCharset(PGMODULE_payForm, 'EUC-KR');

        INIStdPay.pay(PGMODULE_payForm);

        setTimeout('PGMODULE_Std.restoreCharset(PGMODULE_payForm)', '2000');
    },

    procResult:function(bType, sMsg) {
        if (bType === false) {
            processPayResult(bType, sMsg);
        }
    }
};

PGMODULE_inicis_std.getCss();
