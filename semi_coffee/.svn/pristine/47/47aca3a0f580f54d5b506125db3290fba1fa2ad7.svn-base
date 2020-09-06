document.write("<div id='MOBILIANS_PAYMENTWINDOW' style='position:absolute; display:none; width:100%;height:100%;min-height:650px; z-index:1000;background-color:#D3D3D3;top:0px;left:0px;'>"
         + "<iframe id='MOBILIANS_PAYMENT_IFRAME' name='MOBILIANS_PAYMENT_IFRAME' style='width:100%;height:100%;min-height:650px;' scrolling='no' frameborder='0'></iframe>"
         + "<input type='hidden' id='PGMODULE_MOBILIANS_ENCDATA' value=''>"
         + "</div>");

//결제진행
function processCellPay(frm)
{
    return true;
}

//결제취소진행
function processCellCancel(frm)
{
    return true;
}

//PG에서 제공되는 ActiveX 설치여부 체크
function processSettingCellActiveX()
{
}

function processCellResult(bType) {
    if (bType === false) {
        if (winType != undefined && winType == 'popup') {
            parent.paymentOrder.toggleCellLayer(bType);
            parent.processPayResult(bType);
        }else{
            self.close();
        }
    }
}

var PGMODULE_mobilians = {
    processPay:function(frm) {
        PGMODULE_mobilians.transEncryptData();

        document.getElementById("MOBILIANS_PAYMENTWINDOW").style.display = 'block';
        frm.IFRAME_NAME.value = 'MOBILIANS_PAYMENT_IFRAME';
        MCASH_PAYMENT(frm);
    }
    , transEncryptData:function() {
        try {
            var sEncString = document.getElementById("PGMODULE_ENC_DATA").value;
            PGMODULE_mobilians.setEncryptData(sEncString);
        } catch(e) {
            alert("[ER-J03] 결제진행오류. 결제창을 찾을 수 없습니다!");
        }
    }
    , setEncryptData:function(sValue) {
        document.getElementById("PGMODULE_MOBILIANS_ENCDATA").value = sValue;
    }
}