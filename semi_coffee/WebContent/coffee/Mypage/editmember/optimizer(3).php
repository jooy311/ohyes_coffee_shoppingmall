/**
 * FwValidator.Filter
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Filter = {

    parent : FwValidator,

    isFill : function(Response, cond) {
        if (typeof cond != 'string') {
            var count = cond.length;
            var result = this.parent.Helper.getResult(Response, parent.CODE_SUCCESS);

            for (var i = 0; i < count; ++i) {
                result = this._fillConditionCheck(Response, cond[i]);

                if (result.passed === true) {
                    return result;
                }
            }

            return result;
        }

        return this._fillConditionCheck(Response, cond);
    },

    isMatch : function(Response, sField) {
        if(Response.elmCurrValue == ''){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        //Radio 나 Checkbox의 경우 무시
        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        var elmTarget = $('#'+sField);
        var elmTargetValue = elmTarget.val();

        if (Response.elmCurrValue != elmTargetValue) {
            var label = elmTarget.attr(this.parent.ATTR_LABEL);
            var match = label ? label : sField;

            Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{match\}/i, match);

            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMax : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    ++chkCount;
                }
            });

            if (chkCount > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        } else {
            var len = Response.elmCurrValue.length;

            if (len > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if (result.passed === this.parent.CODE_FAIL) {
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMin : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if($(this).get(0).checked === true){
                    ++chkCount;
                }
            });

            if (chkCount < iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        }else{
            var len = Response.elmCurrValue.length;

            if(len < iLen){
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if(result.passed === this.parent.CODE_FAIL){
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isNumber : function(Response, iCond) {
        var result = this.parent.Verify.isNumber(Response.elmCurrValue, iCond);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIdentity : function(Response){
        var result = this.parent.Verify.isIdentity(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isKorean : function(Response){
        var result = this.parent.Verify.isKorean(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlpha : function(Response){
        var result = this.parent.Verify.isAlpha(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaLower : function(Response){
        var result = this.parent.Verify.isAlphaLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaUpper : function(Response){
        var result = this.parent.Verify.isAlphaUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNum : function(Response){
        var result = this.parent.Verify.isAlphaNum(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumLower : function(Response){
        var result = this.parent.Verify.isAlphaNumLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumUpper : function(Response){
        var result = this.parent.Verify.isAlphaNumUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDash : function(Response){
        var result = this.parent.Verify.isAlphaDash(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashLower : function(Response){
        var result = this.parent.Verify.isAlphaDashLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashUpper : function(Response){
        var result = this.parent.Verify.isAlphaDashUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSsn : function(Response){
        var result = this.parent.Verify.isSsn(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isForeignerNo : function(Response){
        var result = this.parent.Verify.isForeignerNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isBizNo : function(Response){
        var result = this.parent.Verify.isBizNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isJuriNo : function(Response){
        var result = this.parent.Verify.isJuriNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPhone : function(Response){
        var result = this.parent.Verify.isPhone(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMobile : function(Response){
        var result = this.parent.Verify.isMobile(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isZipcode : function(Response){
        var result = this.parent.Verify.isZipcode(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIp : function(Response){
        var result = this.parent.Verify.isIp(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isEmail : function(Response){
        var result = this.parent.Verify.isEmail(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isUrl : function(Response){
        var result = this.parent.Verify.isUrl(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isDate : function(Response){
        var result = this.parent.Verify.isDate(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isRegex : function(Response, regex){
        regex = eval(regex);

        if( regex.test(Response.elmCurrValue) === false ){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPassport : function(Response){
        var result = this.parent.Verify.isPassport(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSimplexEditorFill : function(Response){

        var result = eval(Response.elmCurrValue + ".isEmptyContent();");

        if(result === true){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

    },

    isMaxByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len > iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMinByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isByteRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iMin || len > iMax) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isLengthRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var resultMin = this.isMin(Response, iMin);
        var resultMax = this.isMax(Response, iMax);

        if (resultMin.passed === this.parent.CODE_FAIL || resultMax.passed === this.parent.CODE_FAIL) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isNumberMin : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMin(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLimit);
        }

        return result;
    },

    isNumberMax : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMax(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLimit);
        }

        return result;
    },

    isNumberRange : function(Response, range) {
        var iMin = range[0];
        var iMax = range[1];

        var check = this.parent.Verify.isNumberRange(Response.elmCurrValue, iMin, iMax);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    _getRangeNum : function(range) {
        var result = {};

        result.min = range[0] <= 0 ? 0 : parseInt(range[0]);
        result.max = range[1] <= 0 ? 0 : parseInt(range[1]);

        return result;
    },

    _fillConditionCheck : function(Response, cond) {
        cond = $.trim(cond);

        var parent = this.parent;

        //조건식이 들어오면 조건식에 맞을 경우만 필수값을 체크함
        if (cond) {
            var conditions = cond.split('=');
            var fieldId = $.trim(conditions[0]);
            var fieldVal = $.trim(conditions[1]);

            try {
                var val = parent.Helper.getValue(Response.formId, $('#'+fieldId));
                val = $.trim(val);

                if(fieldVal != val) {
                    return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            } catch(e) {
                if (parent.DEBUG_MODE == true) {
                    Response.elmCurrErrorMsg = parent.msgs['isFillError'];
                    Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{condition\}/i, cond);
                    return parent.Helper.getResult(Response, parent.CODE_FAIL);
                }

                return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
            }
        }

        //Radio 나 Checkbox의 경우 선택한값이 있는지 여부를 체크함
        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {

            var sName = Response.elmCurrField.attr('name');
            var result = parent.Helper.getResult(Response, parent.CODE_FAIL);

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    result = parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            });

            return result;

        }

        //일반 텍스트 박스
        if (Response.elmCurrValue != '') {
            return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
        }

        return parent.Helper.getResult(Response, parent.CODE_FAIL);
    }
};

FwValidator.msgs = {

    //기본
    'isFill' : '{label} 항목은 필수 입력값입니다.',

    'isNumber' : '{label} 항목이 숫자 형식이 아닙니다.',

    'isEmail' : '{label} 항목이 이메일 형식이 아닙니다.',

    'isIdentity' : '{label} 항목이 아이디 형식이 아닙니다.',

    'isMax' : '{label} 을(를) {max}자 이하로 입력해주세요.',

    'isMin' : '{label} 항목이 {min}자(개) 이상으로 해주십시오 .',

    'isRegex' : '{label} 항목이 올바른 입력값이 아닙니다.',

    'isAlpha' : '{label} 항목이 영문이 아닙니다',

    'isAlphaLower' : '{label} 항목이 영문 소문자 형식이 아닙니다',

    'isAlphaUpper' : '{label} 항목이 영문 대문자 형식이 아닙니다',

    'isAlphaNum' : '{label} 항목이 영문이나 숫자 형식이 아닙니다.',

    'isAlphaNumLower' : '{label} 항목이 영문 소문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaNumUpper' : '{label} 항목이 영문 대문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaDash' : '{label} 항목이 [영문,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashLower' : '{label} 항목이 [영문 소문자,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashUpper' : '{label} 항목이 [영문 대문자,숫자,_,-] 형식이 아닙니다.',

    'isKorean' : '{label} 항목이 한국어 형식이 아닙니다.',

    'isUrl' : '{label} 항목이 URL 형식이 아닙니다.',

    'isSsn' : '{label} 항목이 주민등록번호 형식이 아닙니다.',

    'isForeignerNo' : '{label} 항목이 외국인등록번호 형식이 아닙니다.',

    'isBizNo' : '{label} 항목이 사업자번호 형식이 아닙니다.',

    'isPhone' : '{label} 항목이 전화번호 형식이 아닙니다.',

    'isMobile' : '{label} 항목이 핸드폰 형식이 아닙니다.',

    'isZipcode' : '{label} 항목이 우편번호 형식이 아닙니다.',

    'isJuriNo' : '{label} 항목이 법인번호 형식이 아닙니다.',

    'isIp' : '{label} 항목이 아이피 형식이 아닙니다.',

    'isDate' : '{label} 항목이 날짜 형식이 아닙니다.',

    'isMatch' : '{label} 항목과 {match} 항목이 같지 않습니다.',

    'isSuccess' : '{label} 항목의 데이터는 전송할 수 없습니다.',

    'isSimplexEditorFill' : '{label}(을/를) 입력하세요',

    'isPassport' : '{label} 항목이 여권번호 형식이 아닙니다.',

    'isMaxByte' : '{label} 항목은 {max}bytes 이하로 해주십시오.',

    'isMinByte' : '{label} 항목은 {min}bytes 이상으로 해주십시오.',

    'isByteRange' : '{label} 항목은 {min} ~ {max}bytes 범위로 해주십시오.',

    'isLengthRange' : '{label} 항목은 {min} ~ {max}자(개) 범위로 해주십시오.',

    'isNumberMin' : '{label} 항목은 {min} 이상으로 해주십시오.',

    'isNumberMax' : '{label} 항목은 {max} 이하로 해주십시오.',

    'isNumberRange' : '{label} 항목은 {min} ~ {max} 범위로 해주세요.',


    //디버깅
    'notMethod' : '{label} 항목에 존재하지 않는 필터를 사용했습니다.',

    'isFillError' : "[{label}] 필드의 isFill {condition} 문장이 잘못되었습니다.\r\n해당 필드의 아이디를 확인하세요."

};

FwValidator.Handler.overrideMsgs({

    //기본
    'isFill' : sprintf(__('IS.REQUIRED.FIELD', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isNumber' : sprintf(__('MAY.ONLY.CONTAIN.NUMBERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isEmail' : sprintf(__('VALID.EMAIL.ADDRESS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isIdentity' : sprintf(__('FIELD.CORRECT.ID.FORMAT', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isMax' : sprintf(__('EXCEED.CHARACTERS.LENGTH', 'RESOUCE.JS.VALIDATOR'), '{label}', '{max}'),

    'isMin' : sprintf(__('MUST.AT.LEAST.CHARACTERS', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}'),

    'isRegex' : sprintf(__('FIELD.IN.CORRECT.FORMAT', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlpha' : sprintf(__('ALPHABETICAL.CHARACTERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaLower' : sprintf(__('CONTAIN.LOWERCASE.LETTERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaUpper' : sprintf(__('CONTAIN.UPPERCASE.LETTERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaNum' : sprintf(__('ALPHANUMERIC.CHARACTERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaNumLower' : sprintf(__('CONTAIN.LOWERCASE.LETTERS.001', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaNumUpper' : sprintf(__('CONTAIN.UPPERCASE.LETTERS.001', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaDash' : sprintf(__('UNDERSCORES.DASHES', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaDashLower' : sprintf(__('UNDERSCORES.DASHES.001', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isAlphaDashUpper' : sprintf(__('UNDERSCORES.DASHES.002', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isKorean' : sprintf(__('CONTAIN.KOREAN.CHARACTERS', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isUrl' : sprintf(__('MUST.CONTAIN.VALID.URL', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isSsn' : sprintf(__('MUST.CONTAIN.VALID.SSN', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isForeignerNo' : sprintf(__('ALIEN.REGISTRATION.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isBizNo' : sprintf(__('REGISTRATION.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isPhone' : sprintf(__('VALID.PHONE.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isMobile' : sprintf(__('VALID.MOBILE.PHONE.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isZipcode' : sprintf(__('CONTAIN.VALID.ZIP.CODE', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isJuriNo' : sprintf(__('CORPORATE.IDENTITY.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isIp' : sprintf(__('MUST.CONTAIN.VALID.IP', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isDate' : sprintf(__('MUST.CONTAIN.VALID.DATE', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isMatch' : sprintf(__('THE.FIELD.DOES.NOT.MATCH', 'RESOUCE.JS.VALIDATOR'), '{label}', '{match}'),

    'isSuccess' : sprintf(__('THE.DATA.BE.TRANSFERRED', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isSimplexEditorFill' : sprintf(__('THE.FIELD.MUST.HAVE.VALUE', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isPassport' : sprintf(__('VALID.PASSPORT.NUMBER', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isMaxByte' : sprintf(__('VALUE.CAN.NOT.EXCEED', 'RESOUCE.JS.VALIDATOR'), '{label}', '{max}'),

    'isMinByte' : sprintf(__('THE.FIELD.VALUE.MUST.BE', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}'),

    'isByteRange' : sprintf(__('THE.FIELD.VALUE.MUST.BE.001', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}', '{max}'),

    'isLengthRange' : sprintf(__('MUST.CHARACTERS.LENGTH', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}', '{max}'),

    'isNumberMin' : sprintf(__('THE.FIELD.VALUE.MUST.BE.002', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}'),

    'isNumberMax' : sprintf(__('VALUE.CAN.NOT.EXCEED.001', 'RESOUCE.JS.VALIDATOR'), '{label}', '{max}'),

    'isNumberRange' : sprintf(__('THE.FIELD.VALUE.MUST.BE.003', 'RESOUCE.JS.VALIDATOR'), '{label}', '{min}', '{max}'),


    //디버깅
    'notMethod' : sprintf(__('FILTER.WAS.USED.FIELD', 'RESOUCE.JS.VALIDATOR'), '{label}'),

    'isFillError' : sprintf(__('SENTENCE.INCORRECT.PLEASE', 'RESOUCE.JS.VALIDATOR'), '{label}', '{condition}')

});
$(document).ready(function(){
    /**
     * 이미지 롤오버
     * */
    $('img[id^="cate_img_"]')
        .parent()
        .mouseover(function(){
            var $img = $(this).find('img');

            if (!$img.attr('org_src')) $img.attr('org_src', $img.attr('src'));

            $img.attr('src', $img.attr('rollover'));
        })
        .mouseout(function(){
            var $img = $(this).find('img');

            $img.attr('src', $img.attr('org_src'));
        });
        
    /**
     * 카테고리 상세분류를 보기위한 처리
     * 모바일은 온마우스 안됨
     * -구스킨은 레이어 무조건 노출중이라사용안함 
     */
    if (mobileWeb != true) {
        $('.xans-product-displaycategory .button').hover(
            function() {
                $(this).addClass('selected');
            },
            function() {
                $(this).removeClass('selected');
            }
        );
    } else {
        try {
            $('.icoClose').live('click', function (v) {
                $('.xans-product-displaycategory .button').removeClass('selected');
                // event bubbling으로 추가
                return false;
            });
            $('.xans-product-displaycategory .button').live('click', function (v) {
                $('.xans-product-displaycategory .button').removeClass('selected');
                $(this).closest('div .button').addClass('selected');
            });
        } catch (e) {};
    }
    
    /**
     * 서브카테고리 display - mouseOver
     * */
    /*
    $('.xans-product-listcategory a').mouseover(function(){
        
        var pNode = $(this).parents('li');
        var sHref = $(this).attr('href')
        sHref = sHref.substr(sHref.indexOf('?'));
        var sUrl = '/product/sub_category.html'+sHref; 

        $.get(sUrl, '', function(result) {
            if (result != '') {
                $('#product-listcategory-read').remove();
                $(pNode).append('<div id="product-listcategory-read">'+result+'</div>');
                
                $('.xans-product-subcategory').css('left', '100px');
                subTop = $('.xans-product-subcategory').css('top').replace('px','') - 20;
                $('.xans-product-subcategory').css('top', subTop);
                $('.xans-product-subcategory').mouseover(function() {
                    $('.xans-product-subcategory').show();
                });
                
            }
        });
    });

    $('.xans-product-listcategory a').mouseout(function(){
        //$('#product-listcategory-read').remove();
    });
    
    $('[id^="sub_cate"]').mouseout(function(){
        $(this).css('display:none;');
    });  
    */
});

/**
 * AUTHSSL HEAD
 */
var AUTHSSL_HEAD = {
    holdReady: function(hold) {
        if ( hold ) { 
            $.readyWait++; 
        } else { 
            $.ready(true); 
        } 
    } 
}; 

AUTHSSL_HEAD.holdReady(true);
/**
 * AUTHSSL을 통한 Server to Client 복호화
 */
var AUTHSSL_SC = {
    
    aAppAction : [],
    
    /**
     * 복호화
     * @param sEncrypted 암호화된 값
     */
    decrypt: function(sEncrypted)
    {
        //로딩바 (주문서 작성폼에서만 노출시킨다)
        if (loadContainer.bInitFalg ==false && $.inArray('OrderForm',this.aAppAction) > -1) {
            loadContainer.init();
        }

        if ($.inArray('OrderForm',this.aAppAction) > -1 && $('#authssl_loadingbar').css('display') == 'none') {
            loadContainer.load();
        }

        AuthSSLManager.weave({
            'auth_mode' : 'decryptClient', //mode
            'auth_string' : sEncrypted, //auth_string
            'auth_callbackName'  : 'AUTHSSL_SC.decryptCallbackFn' //callback function
        });
    },

    /**
     * 복호화 콜백함수
     * @param sOutput 복호화된 값
     */
    decryptCallbackFn: function(sOutput)
    {
        var sOutput = decodeURIComponent(sOutput);

        if ( AuthSSLManager.isError(sOutput) == true ) {
            return;
        }

        var aDataAll = AuthSSLManager.unserialize(sOutput);

        // 복호화된 값 각 element에 어싸인
        this.assignByClass(aDataAll['text']);
        this.assignFormById(aDataAll['formDataById']);

        //주문서 작성폼 모듈이 포함된 페이지인경우
        if ($.inArray('OrderForm',this.aAppAction) > -1) {
            //로딩바
            setTimeout("loadContainer.remove()",500);
            //주문서작성폼 decrypt일때 호출시킴
            if (typeof(aDataAll['parentModule']) == 'string' && aDataAll['parentModule'] == 'OrderForm') {
                AUTHSSL_HEAD.holdReady(false);
            }
        } else {
            AUTHSSL_HEAD.holdReady(false);
        }
    },

    /**
     * 어싸인 - 일반 텍스트
     * @param aData id => text 배열
     */
    assignByClass: function(aData)
    {
        AUTHSSL_SC.aAuthSSLData = aData;
        for (var sClass in aData) {
            if (aData.hasOwnProperty(sClass)) {
                $('.' + sClass).each(function() {
                    var oSpanElement = document.createElement('span');
                    oSpanElement.innerHTML = (aData[sClass]);
                    $(this).replaceWith(oSpanElement);
                });
            }
        }
    },

    /**
     * 어싸인 - 입력폼
     * @param aData id => value 배열
     */
    assignFormById: function(aData)
    {
        for (var sId in aData) {
            if (aData[sId] != null && aData[sId] != '') {
                $('[id="' + sId + '"]').val(aData[sId]);
            }
            if (sId == 'faddress' && $("#si_name_f").length > 0) {
                $("#ec-shop-address1SpanId_f").text(aData[sId]);
            } else if (sId == 'address_addr1' && $("#si_name").length > 0) {
                $("#ec-myshop-address1SpanId").text(aData[sId]);
            }
        }
    },
    
    /**
     * 일부 페이지에서만 제어하게끔 세팅 (주문서작성폼에서만 로딩바 노출)
     */
    setAppAction : function(sAppAction) 
    {
        if (sAppAction !='') {
            this.aAppAction.push(sAppAction);
        }
    }
};

/**
 * 로딩바
 */
var loadContainer = {
        
    bInitFalg : false,
    //로딩바 append    
    init : function() {
        var agent = navigator.userAgent.toLowerCase();
        var $window = $(window);
        var $body = $(document.body);
        var $loadingLayer, $loadingLayerOuter, $loadingLayerText;
        
        if (agent.indexOf('iphone') != -1 || agent.indexOf('android') != -1 || isMobileFuncAuth() === true) {
            $loadingLayer = $('<div id="authssl_loadingbar" style="display:none;"></div>').appendTo($body);
            $('<div style="z-index:1000; position:fixed; left:0; top:0; right:0; bottom:0; width:100%; height:100%; background-color:#000; "></div>').appendTo($loadingLayer).css("opacity", 0.5);
            $loadingLayerOuter = $('<div id="authssl_loadingbar_layer" style="z-index:1010; position:fixed; left:50%; top:50%; width:310px; padding:55px 10px 10px; text-align:center; margin:0 0 0 -155px; background:#fff url(\'//img.echosting.cafe24.com/skin/mobile_ko_KR/common/img_loading.gif\') no-repeat 50% 15px; box-sizing:border-box; border-radius:6px; -webkit-border-top-left-radius:6px; -webkit-border-top-right-radius:6px; -webkit-border-bottom-left-radius:6px; -webkit-border-bottom-right-radius:6px; box-shadow:0 0 8px rgba(0,0,0,0.7);  "></div>').appendTo($loadingLayer);
            $loadingLayerText = $('<p style="line-height:1.4; color:#1b1b1b; color:#508bed; font-size:16px; font-weight:bold;"><strong style="display:block;">'+__('개인정보 보호를 위한<br/>암호화 송수신 작업 중입니다.')+'</strong></p>'
                    +'<p style="line-height:1.4; color:#1b1b1b; margin:5px; font-size:13px; color:#757575;">'+__('잠시만 기다려 주십시오.')+'</p>').appendTo($loadingLayerOuter);
        } else {
            $loadingLayer = $('<div id="authssl_loadingbar" style="display:none;"></div>').appendTo($body);
            $('<div style="z-index:1000; position:fixed; left:0; top:0; right:0; bottom:0; width:100%; height:100%; background-color:#000; "></div>').appendTo($loadingLayer).css("opacity", 0.5);
            $loadingLayerOuter = $('<div id="authssl_loadingbar_layer" style="z-index:1010; position:fixed; left:50%; top:50%; width:350px; padding:6px 0 0; margin:0 0 0 -175px; background:url(\'//img.echosting.cafe24.com/skin/base_ko_KR/common/bg_layer_encrypt.png\') no-repeat 0 0; "></div>').appendTo($loadingLayer);
            $loadingLayerText = $('<div style="padding:17px 15px 23px; background:url(\'//img.echosting.cafe24.com/skin/base_ko_KR/common/bg_layer_encrypt.png\') repeat-y -360px bottom; ">'
                    +'<span style="display:block; width:32px; height:32px; margin:0 auto; background:url(\'//img.echosting.cafe24.com/skin/base_ko_KR/common/img_loading.gif\') no-repeat 50% 0;"></span>'
                    +'<p style="text-align:center; font-weight:bold; line-height:1.4; margin:15px 0 5px; font-size:18px; color:#000; ">'
                    +'<strong style="display:block; color:#008bc9;">'+__('개인정보 보호를 위한<br/>암호화 송수신 작업 중입니다.')+'</strong></p>'
                    +'<p style="text-align:center; font-weight:bold; line-height:1.4; font-size:14px; color:#7b7b7b;">'+__('잠시만 기다려 주십시오.')+'</p></div>').appendTo($loadingLayerOuter);
        }
        
        this.bInitFalg = true;
    },
    //로딩바 show
    load : function() {
        $('#authssl_loadingbar').show();
        //display한후 높이값 가져옴.
        $('#authssl_loadingbar_layer').css('margin-top',-(Math.floor($('#authssl_loadingbar_layer').outerHeight()/2))+'px')
        
    },
    //로딩바 hide
    remove : function() {
        $('#authssl_loadingbar').hide();
    }
    
};

/**
 * 모바일 여부
 * @returns {Boolean}
 */
function isMobileFuncAuth()
{
    if (window.location.hostname.substr(0, 2) == 'm.' || window.location.hostname.substr(0, 12) == 'mobile--shop' || window.location.hostname.substr(0, 11) == 'skin-mobile') {
        return true;
    } else {
        return false;
    }
}

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.moment=t()}(this,function(){"use strict";var e,i;function c(){return e.apply(null,arguments)}function o(e){return e instanceof Array||"[object Array]"===Object.prototype.toString.call(e)}function u(e){return null!=e&&"[object Object]"===Object.prototype.toString.call(e)}function l(e){return void 0===e}function h(e){return"number"==typeof e||"[object Number]"===Object.prototype.toString.call(e)}function d(e){return e instanceof Date||"[object Date]"===Object.prototype.toString.call(e)}function f(e,t){var n,s=[];for(n=0;n<e.length;++n)s.push(t(e[n],n));return s}function m(e,t){return Object.prototype.hasOwnProperty.call(e,t)}function _(e,t){for(var n in t)m(t,n)&&(e[n]=t[n]);return m(t,"toString")&&(e.toString=t.toString),m(t,"valueOf")&&(e.valueOf=t.valueOf),e}function y(e,t,n,s){return Tt(e,t,n,s,!0).utc()}function g(e){return null==e._pf&&(e._pf={empty:!1,unusedTokens:[],unusedInput:[],overflow:-2,charsLeftOver:0,nullInput:!1,invalidMonth:null,invalidFormat:!1,userInvalidated:!1,iso:!1,parsedDateParts:[],meridiem:null,rfc2822:!1,weekdayMismatch:!1}),e._pf}function v(e){if(null==e._isValid){var t=g(e),n=i.call(t.parsedDateParts,function(e){return null!=e}),s=!isNaN(e._d.getTime())&&t.overflow<0&&!t.empty&&!t.invalidMonth&&!t.invalidWeekday&&!t.weekdayMismatch&&!t.nullInput&&!t.invalidFormat&&!t.userInvalidated&&(!t.meridiem||t.meridiem&&n);if(e._strict&&(s=s&&0===t.charsLeftOver&&0===t.unusedTokens.length&&void 0===t.bigHour),null!=Object.isFrozen&&Object.isFrozen(e))return s;e._isValid=s}return e._isValid}function p(e){var t=y(NaN);return null!=e?_(g(t),e):g(t).userInvalidated=!0,t}i=Array.prototype.some?Array.prototype.some:function(e){for(var t=Object(this),n=t.length>>>0,s=0;s<n;s++)if(s in t&&e.call(this,t[s],s,t))return!0;return!1};var r=c.momentProperties=[];function w(e,t){var n,s,i;if(l(t._isAMomentObject)||(e._isAMomentObject=t._isAMomentObject),l(t._i)||(e._i=t._i),l(t._f)||(e._f=t._f),l(t._l)||(e._l=t._l),l(t._strict)||(e._strict=t._strict),l(t._tzm)||(e._tzm=t._tzm),l(t._isUTC)||(e._isUTC=t._isUTC),l(t._offset)||(e._offset=t._offset),l(t._pf)||(e._pf=g(t)),l(t._locale)||(e._locale=t._locale),0<r.length)for(n=0;n<r.length;n++)l(i=t[s=r[n]])||(e[s]=i);return e}var t=!1;function M(e){w(this,e),this._d=new Date(null!=e._d?e._d.getTime():NaN),this.isValid()||(this._d=new Date(NaN)),!1===t&&(t=!0,c.updateOffset(this),t=!1)}function k(e){return e instanceof M||null!=e&&null!=e._isAMomentObject}function S(e){return e<0?Math.ceil(e)||0:Math.floor(e)}function D(e){var t=+e,n=0;return 0!==t&&isFinite(t)&&(n=S(t)),n}function a(e,t,n){var s,i=Math.min(e.length,t.length),r=Math.abs(e.length-t.length),a=0;for(s=0;s<i;s++)(n&&e[s]!==t[s]||!n&&D(e[s])!==D(t[s]))&&a++;return a+r}function Y(e){!1===c.suppressDeprecationWarnings&&"undefined"!=typeof console&&console.warn&&console.warn("Deprecation warning: "+e)}function n(i,r){var a=!0;return _(function(){if(null!=c.deprecationHandler&&c.deprecationHandler(null,i),a){for(var e,t=[],n=0;n<arguments.length;n++){if(e="","object"==typeof arguments[n]){for(var s in e+="\n["+n+"] ",arguments[0])e+=s+": "+arguments[0][s]+", ";e=e.slice(0,-2)}else e=arguments[n];t.push(e)}Y(i+"\nArguments: "+Array.prototype.slice.call(t).join("")+"\n"+(new Error).stack),a=!1}return r.apply(this,arguments)},r)}var s,O={};function T(e,t){null!=c.deprecationHandler&&c.deprecationHandler(e,t),O[e]||(Y(t),O[e]=!0)}function b(e){return e instanceof Function||"[object Function]"===Object.prototype.toString.call(e)}function x(e,t){var n,s=_({},e);for(n in t)m(t,n)&&(u(e[n])&&u(t[n])?(s[n]={},_(s[n],e[n]),_(s[n],t[n])):null!=t[n]?s[n]=t[n]:delete s[n]);for(n in e)m(e,n)&&!m(t,n)&&u(e[n])&&(s[n]=_({},s[n]));return s}function P(e){null!=e&&this.set(e)}c.suppressDeprecationWarnings=!1,c.deprecationHandler=null,s=Object.keys?Object.keys:function(e){var t,n=[];for(t in e)m(e,t)&&n.push(t);return n};var W={};function C(e,t){var n=e.toLowerCase();W[n]=W[n+"s"]=W[t]=e}function H(e){return"string"==typeof e?W[e]||W[e.toLowerCase()]:void 0}function R(e){var t,n,s={};for(n in e)m(e,n)&&(t=H(n))&&(s[t]=e[n]);return s}var U={};function F(e,t){U[e]=t}function L(e,t,n){var s=""+Math.abs(e),i=t-s.length;return(0<=e?n?"+":"":"-")+Math.pow(10,Math.max(0,i)).toString().substr(1)+s}var N=/(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,G=/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,V={},E={};function I(e,t,n,s){var i=s;"string"==typeof s&&(i=function(){return this[s]()}),e&&(E[e]=i),t&&(E[t[0]]=function(){return L(i.apply(this,arguments),t[1],t[2])}),n&&(E[n]=function(){return this.localeData().ordinal(i.apply(this,arguments),e)})}function A(e,t){return e.isValid()?(t=j(t,e.localeData()),V[t]=V[t]||function(s){var e,i,t,r=s.match(N);for(e=0,i=r.length;e<i;e++)E[r[e]]?r[e]=E[r[e]]:r[e]=(t=r[e]).match(/\[[\s\S]/)?t.replace(/^\[|\]$/g,""):t.replace(/\\/g,"");return function(e){var t,n="";for(t=0;t<i;t++)n+=b(r[t])?r[t].call(e,s):r[t];return n}}(t),V[t](e)):e.localeData().invalidDate()}function j(e,t){var n=5;function s(e){return t.longDateFormat(e)||e}for(G.lastIndex=0;0<=n&&G.test(e);)e=e.replace(G,s),G.lastIndex=0,n-=1;return e}var Z=/\d/,z=/\d\d/,$=/\d{3}/,q=/\d{4}/,J=/[+-]?\d{6}/,B=/\d\d?/,Q=/\d\d\d\d?/,X=/\d\d\d\d\d\d?/,K=/\d{1,3}/,ee=/\d{1,4}/,te=/[+-]?\d{1,6}/,ne=/\d+/,se=/[+-]?\d+/,ie=/Z|[+-]\d\d:?\d\d/gi,re=/Z|[+-]\d\d(?::?\d\d)?/gi,ae=/[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i,oe={};function ue(e,n,s){oe[e]=b(n)?n:function(e,t){return e&&s?s:n}}function le(e,t){return m(oe,e)?oe[e](t._strict,t._locale):new RegExp(he(e.replace("\\","").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(e,t,n,s,i){return t||n||s||i})))}function he(e){return e.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")}var de={};function ce(e,n){var t,s=n;for("string"==typeof e&&(e=[e]),h(n)&&(s=function(e,t){t[n]=D(e)}),t=0;t<e.length;t++)de[e[t]]=s}function fe(e,i){ce(e,function(e,t,n,s){n._w=n._w||{},i(e,n._w,n,s)})}var me=0,_e=1,ye=2,ge=3,ve=4,pe=5,we=6,Me=7,ke=8;function Se(e){return De(e)?366:365}function De(e){return e%4==0&&e%100!=0||e%400==0}I("Y",0,0,function(){var e=this.year();return e<=9999?""+e:"+"+e}),I(0,["YY",2],0,function(){return this.year()%100}),I(0,["YYYY",4],0,"year"),I(0,["YYYYY",5],0,"year"),I(0,["YYYYYY",6,!0],0,"year"),C("year","y"),F("year",1),ue("Y",se),ue("YY",B,z),ue("YYYY",ee,q),ue("YYYYY",te,J),ue("YYYYYY",te,J),ce(["YYYYY","YYYYYY"],me),ce("YYYY",function(e,t){t[me]=2===e.length?c.parseTwoDigitYear(e):D(e)}),ce("YY",function(e,t){t[me]=c.parseTwoDigitYear(e)}),ce("Y",function(e,t){t[me]=parseInt(e,10)}),c.parseTwoDigitYear=function(e){return D(e)+(68<D(e)?1900:2e3)};var Ye,Oe=Te("FullYear",!0);function Te(t,n){return function(e){return null!=e?(xe(this,t,e),c.updateOffset(this,n),this):be(this,t)}}function be(e,t){return e.isValid()?e._d["get"+(e._isUTC?"UTC":"")+t]():NaN}function xe(e,t,n){e.isValid()&&!isNaN(n)&&("FullYear"===t&&De(e.year())&&1===e.month()&&29===e.date()?e._d["set"+(e._isUTC?"UTC":"")+t](n,e.month(),Pe(n,e.month())):e._d["set"+(e._isUTC?"UTC":"")+t](n))}function Pe(e,t){if(isNaN(e)||isNaN(t))return NaN;var n,s=(t%(n=12)+n)%n;return e+=(t-s)/12,1===s?De(e)?29:28:31-s%7%2}Ye=Array.prototype.indexOf?Array.prototype.indexOf:function(e){var t;for(t=0;t<this.length;++t)if(this[t]===e)return t;return-1},I("M",["MM",2],"Mo",function(){return this.month()+1}),I("MMM",0,0,function(e){return this.localeData().monthsShort(this,e)}),I("MMMM",0,0,function(e){return this.localeData().months(this,e)}),C("month","M"),F("month",8),ue("M",B),ue("MM",B,z),ue("MMM",function(e,t){return t.monthsShortRegex(e)}),ue("MMMM",function(e,t){return t.monthsRegex(e)}),ce(["M","MM"],function(e,t){t[_e]=D(e)-1}),ce(["MMM","MMMM"],function(e,t,n,s){var i=n._locale.monthsParse(e,s,n._strict);null!=i?t[_e]=i:g(n).invalidMonth=e});var We=/D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,Ce="January_February_March_April_May_June_July_August_September_October_November_December".split("_");var He="Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_");function Re(e,t){var n;if(!e.isValid())return e;if("string"==typeof t)if(/^\d+$/.test(t))t=D(t);else if(!h(t=e.localeData().monthsParse(t)))return e;return n=Math.min(e.date(),Pe(e.year(),t)),e._d["set"+(e._isUTC?"UTC":"")+"Month"](t,n),e}function Ue(e){return null!=e?(Re(this,e),c.updateOffset(this,!0),this):be(this,"Month")}var Fe=ae;var Le=ae;function Ne(){function e(e,t){return t.length-e.length}var t,n,s=[],i=[],r=[];for(t=0;t<12;t++)n=y([2e3,t]),s.push(this.monthsShort(n,"")),i.push(this.months(n,"")),r.push(this.months(n,"")),r.push(this.monthsShort(n,""));for(s.sort(e),i.sort(e),r.sort(e),t=0;t<12;t++)s[t]=he(s[t]),i[t]=he(i[t]);for(t=0;t<24;t++)r[t]=he(r[t]);this._monthsRegex=new RegExp("^("+r.join("|")+")","i"),this._monthsShortRegex=this._monthsRegex,this._monthsStrictRegex=new RegExp("^("+i.join("|")+")","i"),this._monthsShortStrictRegex=new RegExp("^("+s.join("|")+")","i")}function Ge(e){var t;if(e<100&&0<=e){var n=Array.prototype.slice.call(arguments);n[0]=e+400,t=new Date(Date.UTC.apply(null,n)),isFinite(t.getUTCFullYear())&&t.setUTCFullYear(e)}else t=new Date(Date.UTC.apply(null,arguments));return t}function Ve(e,t,n){var s=7+t-n;return-((7+Ge(e,0,s).getUTCDay()-t)%7)+s-1}function Ee(e,t,n,s,i){var r,a,o=1+7*(t-1)+(7+n-s)%7+Ve(e,s,i);return a=o<=0?Se(r=e-1)+o:o>Se(e)?(r=e+1,o-Se(e)):(r=e,o),{year:r,dayOfYear:a}}function Ie(e,t,n){var s,i,r=Ve(e.year(),t,n),a=Math.floor((e.dayOfYear()-r-1)/7)+1;return a<1?s=a+Ae(i=e.year()-1,t,n):a>Ae(e.year(),t,n)?(s=a-Ae(e.year(),t,n),i=e.year()+1):(i=e.year(),s=a),{week:s,year:i}}function Ae(e,t,n){var s=Ve(e,t,n),i=Ve(e+1,t,n);return(Se(e)-s+i)/7}I("w",["ww",2],"wo","week"),I("W",["WW",2],"Wo","isoWeek"),C("week","w"),C("isoWeek","W"),F("week",5),F("isoWeek",5),ue("w",B),ue("ww",B,z),ue("W",B),ue("WW",B,z),fe(["w","ww","W","WW"],function(e,t,n,s){t[s.substr(0,1)]=D(e)});function je(e,t){return e.slice(t,7).concat(e.slice(0,t))}I("d",0,"do","day"),I("dd",0,0,function(e){return this.localeData().weekdaysMin(this,e)}),I("ddd",0,0,function(e){return this.localeData().weekdaysShort(this,e)}),I("dddd",0,0,function(e){return this.localeData().weekdays(this,e)}),I("e",0,0,"weekday"),I("E",0,0,"isoWeekday"),C("day","d"),C("weekday","e"),C("isoWeekday","E"),F("day",11),F("weekday",11),F("isoWeekday",11),ue("d",B),ue("e",B),ue("E",B),ue("dd",function(e,t){return t.weekdaysMinRegex(e)}),ue("ddd",function(e,t){return t.weekdaysShortRegex(e)}),ue("dddd",function(e,t){return t.weekdaysRegex(e)}),fe(["dd","ddd","dddd"],function(e,t,n,s){var i=n._locale.weekdaysParse(e,s,n._strict);null!=i?t.d=i:g(n).invalidWeekday=e}),fe(["d","e","E"],function(e,t,n,s){t[s]=D(e)});var Ze="Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_");var ze="Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_");var $e="Su_Mo_Tu_We_Th_Fr_Sa".split("_");var qe=ae;var Je=ae;var Be=ae;function Qe(){function e(e,t){return t.length-e.length}var t,n,s,i,r,a=[],o=[],u=[],l=[];for(t=0;t<7;t++)n=y([2e3,1]).day(t),s=this.weekdaysMin(n,""),i=this.weekdaysShort(n,""),r=this.weekdays(n,""),a.push(s),o.push(i),u.push(r),l.push(s),l.push(i),l.push(r);for(a.sort(e),o.sort(e),u.sort(e),l.sort(e),t=0;t<7;t++)o[t]=he(o[t]),u[t]=he(u[t]),l[t]=he(l[t]);this._weekdaysRegex=new RegExp("^("+l.join("|")+")","i"),this._weekdaysShortRegex=this._weekdaysRegex,this._weekdaysMinRegex=this._weekdaysRegex,this._weekdaysStrictRegex=new RegExp("^("+u.join("|")+")","i"),this._weekdaysShortStrictRegex=new RegExp("^("+o.join("|")+")","i"),this._weekdaysMinStrictRegex=new RegExp("^("+a.join("|")+")","i")}function Xe(){return this.hours()%12||12}function Ke(e,t){I(e,0,0,function(){return this.localeData().meridiem(this.hours(),this.minutes(),t)})}function et(e,t){return t._meridiemParse}I("H",["HH",2],0,"hour"),I("h",["hh",2],0,Xe),I("k",["kk",2],0,function(){return this.hours()||24}),I("hmm",0,0,function(){return""+Xe.apply(this)+L(this.minutes(),2)}),I("hmmss",0,0,function(){return""+Xe.apply(this)+L(this.minutes(),2)+L(this.seconds(),2)}),I("Hmm",0,0,function(){return""+this.hours()+L(this.minutes(),2)}),I("Hmmss",0,0,function(){return""+this.hours()+L(this.minutes(),2)+L(this.seconds(),2)}),Ke("a",!0),Ke("A",!1),C("hour","h"),F("hour",13),ue("a",et),ue("A",et),ue("H",B),ue("h",B),ue("k",B),ue("HH",B,z),ue("hh",B,z),ue("kk",B,z),ue("hmm",Q),ue("hmmss",X),ue("Hmm",Q),ue("Hmmss",X),ce(["H","HH"],ge),ce(["k","kk"],function(e,t,n){var s=D(e);t[ge]=24===s?0:s}),ce(["a","A"],function(e,t,n){n._isPm=n._locale.isPM(e),n._meridiem=e}),ce(["h","hh"],function(e,t,n){t[ge]=D(e),g(n).bigHour=!0}),ce("hmm",function(e,t,n){var s=e.length-2;t[ge]=D(e.substr(0,s)),t[ve]=D(e.substr(s)),g(n).bigHour=!0}),ce("hmmss",function(e,t,n){var s=e.length-4,i=e.length-2;t[ge]=D(e.substr(0,s)),t[ve]=D(e.substr(s,2)),t[pe]=D(e.substr(i)),g(n).bigHour=!0}),ce("Hmm",function(e,t,n){var s=e.length-2;t[ge]=D(e.substr(0,s)),t[ve]=D(e.substr(s))}),ce("Hmmss",function(e,t,n){var s=e.length-4,i=e.length-2;t[ge]=D(e.substr(0,s)),t[ve]=D(e.substr(s,2)),t[pe]=D(e.substr(i))});var tt,nt=Te("Hours",!0),st={calendar:{sameDay:"[Today at] LT",nextDay:"[Tomorrow at] LT",nextWeek:"dddd [at] LT",lastDay:"[Yesterday at] LT",lastWeek:"[Last] dddd [at] LT",sameElse:"L"},longDateFormat:{LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"},invalidDate:"Invalid date",ordinal:"%d",dayOfMonthOrdinalParse:/\d{1,2}/,relativeTime:{future:"in %s",past:"%s ago",s:"a few seconds",ss:"%d seconds",m:"a minute",mm:"%d minutes",h:"an hour",hh:"%d hours",d:"a day",dd:"%d days",M:"a month",MM:"%d months",y:"a year",yy:"%d years"},months:Ce,monthsShort:He,week:{dow:0,doy:6},weekdays:Ze,weekdaysMin:$e,weekdaysShort:ze,meridiemParse:/[ap]\.?m?\.?/i},it={},rt={};function at(e){return e?e.toLowerCase().replace("_","-"):e}function ot(e){var t=null;if(!it[e]&&"undefined"!=typeof module&&module&&module.exports)try{t=tt._abbr,require("./locale/"+e),ut(t)}catch(e){}return it[e]}function ut(e,t){var n;return e&&((n=l(t)?ht(e):lt(e,t))?tt=n:"undefined"!=typeof console&&console.warn&&console.warn("Locale "+e+" not found. Did you forget to load it?")),tt._abbr}function lt(e,t){if(null===t)return delete it[e],null;var n,s=st;if(t.abbr=e,null!=it[e])T("defineLocaleOverride","use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."),s=it[e]._config;else if(null!=t.parentLocale)if(null!=it[t.parentLocale])s=it[t.parentLocale]._config;else{if(null==(n=ot(t.parentLocale)))return rt[t.parentLocale]||(rt[t.parentLocale]=[]),rt[t.parentLocale].push({name:e,config:t}),null;s=n._config}return it[e]=new P(x(s,t)),rt[e]&&rt[e].forEach(function(e){lt(e.name,e.config)}),ut(e),it[e]}function ht(e){var t;if(e&&e._locale&&e._locale._abbr&&(e=e._locale._abbr),!e)return tt;if(!o(e)){if(t=ot(e))return t;e=[e]}return function(e){for(var t,n,s,i,r=0;r<e.length;){for(t=(i=at(e[r]).split("-")).length,n=(n=at(e[r+1]))?n.split("-"):null;0<t;){if(s=ot(i.slice(0,t).join("-")))return s;if(n&&n.length>=t&&a(i,n,!0)>=t-1)break;t--}r++}return tt}(e)}function dt(e){var t,n=e._a;return n&&-2===g(e).overflow&&(t=n[_e]<0||11<n[_e]?_e:n[ye]<1||n[ye]>Pe(n[me],n[_e])?ye:n[ge]<0||24<n[ge]||24===n[ge]&&(0!==n[ve]||0!==n[pe]||0!==n[we])?ge:n[ve]<0||59<n[ve]?ve:n[pe]<0||59<n[pe]?pe:n[we]<0||999<n[we]?we:-1,g(e)._overflowDayOfYear&&(t<me||ye<t)&&(t=ye),g(e)._overflowWeeks&&-1===t&&(t=Me),g(e)._overflowWeekday&&-1===t&&(t=ke),g(e).overflow=t),e}function ct(e,t,n){return null!=e?e:null!=t?t:n}function ft(e){var t,n,s,i,r,a=[];if(!e._d){var o,u;for(o=e,u=new Date(c.now()),s=o._useUTC?[u.getUTCFullYear(),u.getUTCMonth(),u.getUTCDate()]:[u.getFullYear(),u.getMonth(),u.getDate()],e._w&&null==e._a[ye]&&null==e._a[_e]&&function(e){var t,n,s,i,r,a,o,u;if(null!=(t=e._w).GG||null!=t.W||null!=t.E)r=1,a=4,n=ct(t.GG,e._a[me],Ie(bt(),1,4).year),s=ct(t.W,1),((i=ct(t.E,1))<1||7<i)&&(u=!0);else{r=e._locale._week.dow,a=e._locale._week.doy;var l=Ie(bt(),r,a);n=ct(t.gg,e._a[me],l.year),s=ct(t.w,l.week),null!=t.d?((i=t.d)<0||6<i)&&(u=!0):null!=t.e?(i=t.e+r,(t.e<0||6<t.e)&&(u=!0)):i=r}s<1||s>Ae(n,r,a)?g(e)._overflowWeeks=!0:null!=u?g(e)._overflowWeekday=!0:(o=Ee(n,s,i,r,a),e._a[me]=o.year,e._dayOfYear=o.dayOfYear)}(e),null!=e._dayOfYear&&(r=ct(e._a[me],s[me]),(e._dayOfYear>Se(r)||0===e._dayOfYear)&&(g(e)._overflowDayOfYear=!0),n=Ge(r,0,e._dayOfYear),e._a[_e]=n.getUTCMonth(),e._a[ye]=n.getUTCDate()),t=0;t<3&&null==e._a[t];++t)e._a[t]=a[t]=s[t];for(;t<7;t++)e._a[t]=a[t]=null==e._a[t]?2===t?1:0:e._a[t];24===e._a[ge]&&0===e._a[ve]&&0===e._a[pe]&&0===e._a[we]&&(e._nextDay=!0,e._a[ge]=0),e._d=(e._useUTC?Ge:function(e,t,n,s,i,r,a){var o;return e<100&&0<=e?(o=new Date(e+400,t,n,s,i,r,a),isFinite(o.getFullYear())&&o.setFullYear(e)):o=new Date(e,t,n,s,i,r,a),o}).apply(null,a),i=e._useUTC?e._d.getUTCDay():e._d.getDay(),null!=e._tzm&&e._d.setUTCMinutes(e._d.getUTCMinutes()-e._tzm),e._nextDay&&(e._a[ge]=24),e._w&&void 0!==e._w.d&&e._w.d!==i&&(g(e).weekdayMismatch=!0)}}var mt=/^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,_t=/^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,yt=/Z|[+-]\d\d(?::?\d\d)?/,gt=[["YYYYYY-MM-DD",/[+-]\d{6}-\d\d-\d\d/],["YYYY-MM-DD",/\d{4}-\d\d-\d\d/],["GGGG-[W]WW-E",/\d{4}-W\d\d-\d/],["GGGG-[W]WW",/\d{4}-W\d\d/,!1],["YYYY-DDD",/\d{4}-\d{3}/],["YYYY-MM",/\d{4}-\d\d/,!1],["YYYYYYMMDD",/[+-]\d{10}/],["YYYYMMDD",/\d{8}/],["GGGG[W]WWE",/\d{4}W\d{3}/],["GGGG[W]WW",/\d{4}W\d{2}/,!1],["YYYYDDD",/\d{7}/]],vt=[["HH:mm:ss.SSSS",/\d\d:\d\d:\d\d\.\d+/],["HH:mm:ss,SSSS",/\d\d:\d\d:\d\d,\d+/],["HH:mm:ss",/\d\d:\d\d:\d\d/],["HH:mm",/\d\d:\d\d/],["HHmmss.SSSS",/\d\d\d\d\d\d\.\d+/],["HHmmss,SSSS",/\d\d\d\d\d\d,\d+/],["HHmmss",/\d\d\d\d\d\d/],["HHmm",/\d\d\d\d/],["HH",/\d\d/]],pt=/^\/?Date\((\-?\d+)/i;function wt(e){var t,n,s,i,r,a,o=e._i,u=mt.exec(o)||_t.exec(o);if(u){for(g(e).iso=!0,t=0,n=gt.length;t<n;t++)if(gt[t][1].exec(u[1])){i=gt[t][0],s=!1!==gt[t][2];break}if(null==i)return void(e._isValid=!1);if(u[3]){for(t=0,n=vt.length;t<n;t++)if(vt[t][1].exec(u[3])){r=(u[2]||" ")+vt[t][0];break}if(null==r)return void(e._isValid=!1)}if(!s&&null!=r)return void(e._isValid=!1);if(u[4]){if(!yt.exec(u[4]))return void(e._isValid=!1);a="Z"}e._f=i+(r||"")+(a||""),Yt(e)}else e._isValid=!1}var Mt=/^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/;function kt(e,t,n,s,i,r){var a=[function(e){var t=parseInt(e,10);{if(t<=49)return 2e3+t;if(t<=999)return 1900+t}return t}(e),He.indexOf(t),parseInt(n,10),parseInt(s,10),parseInt(i,10)];return r&&a.push(parseInt(r,10)),a}var St={UT:0,GMT:0,EDT:-240,EST:-300,CDT:-300,CST:-360,MDT:-360,MST:-420,PDT:-420,PST:-480};function Dt(e){var t,n,s,i=Mt.exec(e._i.replace(/\([^)]*\)|[\n\t]/g," ").replace(/(\s\s+)/g," ").replace(/^\s\s*/,"").replace(/\s\s*$/,""));if(i){var r=kt(i[4],i[3],i[2],i[5],i[6],i[7]);if(t=i[1],n=r,s=e,t&&ze.indexOf(t)!==new Date(n[0],n[1],n[2]).getDay()&&(g(s).weekdayMismatch=!0,!(s._isValid=!1)))return;e._a=r,e._tzm=function(e,t,n){if(e)return St[e];if(t)return 0;var s=parseInt(n,10),i=s%100;return(s-i)/100*60+i}(i[8],i[9],i[10]),e._d=Ge.apply(null,e._a),e._d.setUTCMinutes(e._d.getUTCMinutes()-e._tzm),g(e).rfc2822=!0}else e._isValid=!1}function Yt(e){if(e._f!==c.ISO_8601)if(e._f!==c.RFC_2822){e._a=[],g(e).empty=!0;var t,n,s,i,r,a,o,u,l=""+e._i,h=l.length,d=0;for(s=j(e._f,e._locale).match(N)||[],t=0;t<s.length;t++)i=s[t],(n=(l.match(le(i,e))||[])[0])&&(0<(r=l.substr(0,l.indexOf(n))).length&&g(e).unusedInput.push(r),l=l.slice(l.indexOf(n)+n.length),d+=n.length),E[i]?(n?g(e).empty=!1:g(e).unusedTokens.push(i),a=i,u=e,null!=(o=n)&&m(de,a)&&de[a](o,u._a,u,a)):e._strict&&!n&&g(e).unusedTokens.push(i);g(e).charsLeftOver=h-d,0<l.length&&g(e).unusedInput.push(l),e._a[ge]<=12&&!0===g(e).bigHour&&0<e._a[ge]&&(g(e).bigHour=void 0),g(e).parsedDateParts=e._a.slice(0),g(e).meridiem=e._meridiem,e._a[ge]=function(e,t,n){var s;if(null==n)return t;return null!=e.meridiemHour?e.meridiemHour(t,n):(null!=e.isPM&&((s=e.isPM(n))&&t<12&&(t+=12),s||12!==t||(t=0)),t)}(e._locale,e._a[ge],e._meridiem),ft(e),dt(e)}else Dt(e);else wt(e)}function Ot(e){var t,n,s,i,r=e._i,a=e._f;return e._locale=e._locale||ht(e._l),null===r||void 0===a&&""===r?p({nullInput:!0}):("string"==typeof r&&(e._i=r=e._locale.preparse(r)),k(r)?new M(dt(r)):(d(r)?e._d=r:o(a)?function(e){var t,n,s,i,r;if(0===e._f.length)return g(e).invalidFormat=!0,e._d=new Date(NaN);for(i=0;i<e._f.length;i++)r=0,t=w({},e),null!=e._useUTC&&(t._useUTC=e._useUTC),t._f=e._f[i],Yt(t),v(t)&&(r+=g(t).charsLeftOver,r+=10*g(t).unusedTokens.length,g(t).score=r,(null==s||r<s)&&(s=r,n=t));_(e,n||t)}(e):a?Yt(e):l(n=(t=e)._i)?t._d=new Date(c.now()):d(n)?t._d=new Date(n.valueOf()):"string"==typeof n?(s=t,null===(i=pt.exec(s._i))?(wt(s),!1===s._isValid&&(delete s._isValid,Dt(s),!1===s._isValid&&(delete s._isValid,c.createFromInputFallback(s)))):s._d=new Date(+i[1])):o(n)?(t._a=f(n.slice(0),function(e){return parseInt(e,10)}),ft(t)):u(n)?function(e){if(!e._d){var t=R(e._i);e._a=f([t.year,t.month,t.day||t.date,t.hour,t.minute,t.second,t.millisecond],function(e){return e&&parseInt(e,10)}),ft(e)}}(t):h(n)?t._d=new Date(n):c.createFromInputFallback(t),v(e)||(e._d=null),e))}function Tt(e,t,n,s,i){var r,a={};return!0!==n&&!1!==n||(s=n,n=void 0),(u(e)&&function(e){if(Object.getOwnPropertyNames)return 0===Object.getOwnPropertyNames(e).length;var t;for(t in e)if(e.hasOwnProperty(t))return!1;return!0}(e)||o(e)&&0===e.length)&&(e=void 0),a._isAMomentObject=!0,a._useUTC=a._isUTC=i,a._l=n,a._i=e,a._f=t,a._strict=s,(r=new M(dt(Ot(a))))._nextDay&&(r.add(1,"d"),r._nextDay=void 0),r}function bt(e,t,n,s){return Tt(e,t,n,s,!1)}c.createFromInputFallback=n("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.",function(e){e._d=new Date(e._i+(e._useUTC?" UTC":""))}),c.ISO_8601=function(){},c.RFC_2822=function(){};var xt=n("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/",function(){var e=bt.apply(null,arguments);return this.isValid()&&e.isValid()?e<this?this:e:p()}),Pt=n("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/",function(){var e=bt.apply(null,arguments);return this.isValid()&&e.isValid()?this<e?this:e:p()});function Wt(e,t){var n,s;if(1===t.length&&o(t[0])&&(t=t[0]),!t.length)return bt();for(n=t[0],s=1;s<t.length;++s)t[s].isValid()&&!t[s][e](n)||(n=t[s]);return n}var Ct=["year","quarter","month","week","day","hour","minute","second","millisecond"];function Ht(e){var t=R(e),n=t.year||0,s=t.quarter||0,i=t.month||0,r=t.week||t.isoWeek||0,a=t.day||0,o=t.hour||0,u=t.minute||0,l=t.second||0,h=t.millisecond||0;this._isValid=function(e){for(var t in e)if(-1===Ye.call(Ct,t)||null!=e[t]&&isNaN(e[t]))return!1;for(var n=!1,s=0;s<Ct.length;++s)if(e[Ct[s]]){if(n)return!1;parseFloat(e[Ct[s]])!==D(e[Ct[s]])&&(n=!0)}return!0}(t),this._milliseconds=+h+1e3*l+6e4*u+1e3*o*60*60,this._days=+a+7*r,this._months=+i+3*s+12*n,this._data={},this._locale=ht(),this._bubble()}function Rt(e){return e instanceof Ht}function Ut(e){return e<0?-1*Math.round(-1*e):Math.round(e)}function Ft(e,n){I(e,0,0,function(){var e=this.utcOffset(),t="+";return e<0&&(e=-e,t="-"),t+L(~~(e/60),2)+n+L(~~e%60,2)})}Ft("Z",":"),Ft("ZZ",""),ue("Z",re),ue("ZZ",re),ce(["Z","ZZ"],function(e,t,n){n._useUTC=!0,n._tzm=Nt(re,e)});var Lt=/([\+\-]|\d\d)/gi;function Nt(e,t){var n=(t||"").match(e);if(null===n)return null;var s=((n[n.length-1]||[])+"").match(Lt)||["-",0,0],i=60*s[1]+D(s[2]);return 0===i?0:"+"===s[0]?i:-i}function Gt(e,t){var n,s;return t._isUTC?(n=t.clone(),s=(k(e)||d(e)?e.valueOf():bt(e).valueOf())-n.valueOf(),n._d.setTime(n._d.valueOf()+s),c.updateOffset(n,!1),n):bt(e).local()}function Vt(e){return 15*-Math.round(e._d.getTimezoneOffset()/15)}function Et(){return!!this.isValid()&&(this._isUTC&&0===this._offset)}c.updateOffset=function(){};var It=/^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,At=/^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;function jt(e,t){var n,s,i,r=e,a=null;return Rt(e)?r={ms:e._milliseconds,d:e._days,M:e._months}:h(e)?(r={},t?r[t]=e:r.milliseconds=e):(a=It.exec(e))?(n="-"===a[1]?-1:1,r={y:0,d:D(a[ye])*n,h:D(a[ge])*n,m:D(a[ve])*n,s:D(a[pe])*n,ms:D(Ut(1e3*a[we]))*n}):(a=At.exec(e))?(n="-"===a[1]?-1:1,r={y:Zt(a[2],n),M:Zt(a[3],n),w:Zt(a[4],n),d:Zt(a[5],n),h:Zt(a[6],n),m:Zt(a[7],n),s:Zt(a[8],n)}):null==r?r={}:"object"==typeof r&&("from"in r||"to"in r)&&(i=function(e,t){var n;if(!e.isValid()||!t.isValid())return{milliseconds:0,months:0};t=Gt(t,e),e.isBefore(t)?n=zt(e,t):((n=zt(t,e)).milliseconds=-n.milliseconds,n.months=-n.months);return n}(bt(r.from),bt(r.to)),(r={}).ms=i.milliseconds,r.M=i.months),s=new Ht(r),Rt(e)&&m(e,"_locale")&&(s._locale=e._locale),s}function Zt(e,t){var n=e&&parseFloat(e.replace(",","."));return(isNaN(n)?0:n)*t}function zt(e,t){var n={};return n.months=t.month()-e.month()+12*(t.year()-e.year()),e.clone().add(n.months,"M").isAfter(t)&&--n.months,n.milliseconds=+t-+e.clone().add(n.months,"M"),n}function $t(s,i){return function(e,t){var n;return null===t||isNaN(+t)||(T(i,"moment()."+i+"(period, number) is deprecated. Please use moment()."+i+"(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."),n=e,e=t,t=n),qt(this,jt(e="string"==typeof e?+e:e,t),s),this}}function qt(e,t,n,s){var i=t._milliseconds,r=Ut(t._days),a=Ut(t._months);e.isValid()&&(s=null==s||s,a&&Re(e,be(e,"Month")+a*n),r&&xe(e,"Date",be(e,"Date")+r*n),i&&e._d.setTime(e._d.valueOf()+i*n),s&&c.updateOffset(e,r||a))}jt.fn=Ht.prototype,jt.invalid=function(){return jt(NaN)};var Jt=$t(1,"add"),Bt=$t(-1,"subtract");function Qt(e,t){var n=12*(t.year()-e.year())+(t.month()-e.month()),s=e.clone().add(n,"months");return-(n+(t-s<0?(t-s)/(s-e.clone().add(n-1,"months")):(t-s)/(e.clone().add(n+1,"months")-s)))||0}function Xt(e){var t;return void 0===e?this._locale._abbr:(null!=(t=ht(e))&&(this._locale=t),this)}c.defaultFormat="YYYY-MM-DDTHH:mm:ssZ",c.defaultFormatUtc="YYYY-MM-DDTHH:mm:ss[Z]";var Kt=n("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.",function(e){return void 0===e?this.localeData():this.locale(e)});function en(){return this._locale}var tn=126227808e5;function nn(e,t){return(e%t+t)%t}function sn(e,t,n){return e<100&&0<=e?new Date(e+400,t,n)-tn:new Date(e,t,n).valueOf()}function rn(e,t,n){return e<100&&0<=e?Date.UTC(e+400,t,n)-tn:Date.UTC(e,t,n)}function an(e,t){I(0,[e,e.length],0,t)}function on(e,t,n,s,i){var r;return null==e?Ie(this,s,i).year:((r=Ae(e,s,i))<t&&(t=r),function(e,t,n,s,i){var r=Ee(e,t,n,s,i),a=Ge(r.year,0,r.dayOfYear);return this.year(a.getUTCFullYear()),this.month(a.getUTCMonth()),this.date(a.getUTCDate()),this}.call(this,e,t,n,s,i))}I(0,["gg",2],0,function(){return this.weekYear()%100}),I(0,["GG",2],0,function(){return this.isoWeekYear()%100}),an("gggg","weekYear"),an("ggggg","weekYear"),an("GGGG","isoWeekYear"),an("GGGGG","isoWeekYear"),C("weekYear","gg"),C("isoWeekYear","GG"),F("weekYear",1),F("isoWeekYear",1),ue("G",se),ue("g",se),ue("GG",B,z),ue("gg",B,z),ue("GGGG",ee,q),ue("gggg",ee,q),ue("GGGGG",te,J),ue("ggggg",te,J),fe(["gggg","ggggg","GGGG","GGGGG"],function(e,t,n,s){t[s.substr(0,2)]=D(e)}),fe(["gg","GG"],function(e,t,n,s){t[s]=c.parseTwoDigitYear(e)}),I("Q",0,"Qo","quarter"),C("quarter","Q"),F("quarter",7),ue("Q",Z),ce("Q",function(e,t){t[_e]=3*(D(e)-1)}),I("D",["DD",2],"Do","date"),C("date","D"),F("date",9),ue("D",B),ue("DD",B,z),ue("Do",function(e,t){return e?t._dayOfMonthOrdinalParse||t._ordinalParse:t._dayOfMonthOrdinalParseLenient}),ce(["D","DD"],ye),ce("Do",function(e,t){t[ye]=D(e.match(B)[0])});var un=Te("Date",!0);I("DDD",["DDDD",3],"DDDo","dayOfYear"),C("dayOfYear","DDD"),F("dayOfYear",4),ue("DDD",K),ue("DDDD",$),ce(["DDD","DDDD"],function(e,t,n){n._dayOfYear=D(e)}),I("m",["mm",2],0,"minute"),C("minute","m"),F("minute",14),ue("m",B),ue("mm",B,z),ce(["m","mm"],ve);var ln=Te("Minutes",!1);I("s",["ss",2],0,"second"),C("second","s"),F("second",15),ue("s",B),ue("ss",B,z),ce(["s","ss"],pe);var hn,dn=Te("Seconds",!1);for(I("S",0,0,function(){return~~(this.millisecond()/100)}),I(0,["SS",2],0,function(){return~~(this.millisecond()/10)}),I(0,["SSS",3],0,"millisecond"),I(0,["SSSS",4],0,function(){return 10*this.millisecond()}),I(0,["SSSSS",5],0,function(){return 100*this.millisecond()}),I(0,["SSSSSS",6],0,function(){return 1e3*this.millisecond()}),I(0,["SSSSSSS",7],0,function(){return 1e4*this.millisecond()}),I(0,["SSSSSSSS",8],0,function(){return 1e5*this.millisecond()}),I(0,["SSSSSSSSS",9],0,function(){return 1e6*this.millisecond()}),C("millisecond","ms"),F("millisecond",16),ue("S",K,Z),ue("SS",K,z),ue("SSS",K,$),hn="SSSS";hn.length<=9;hn+="S")ue(hn,ne);function cn(e,t){t[we]=D(1e3*("0."+e))}for(hn="S";hn.length<=9;hn+="S")ce(hn,cn);var fn=Te("Milliseconds",!1);I("z",0,0,"zoneAbbr"),I("zz",0,0,"zoneName");var mn=M.prototype;function _n(e){return e}mn.add=Jt,mn.calendar=function(e,t){var n=e||bt(),s=Gt(n,this).startOf("day"),i=c.calendarFormat(this,s)||"sameElse",r=t&&(b(t[i])?t[i].call(this,n):t[i]);return this.format(r||this.localeData().calendar(i,this,bt(n)))},mn.clone=function(){return new M(this)},mn.diff=function(e,t,n){var s,i,r;if(!this.isValid())return NaN;if(!(s=Gt(e,this)).isValid())return NaN;switch(i=6e4*(s.utcOffset()-this.utcOffset()),t=H(t)){case"year":r=Qt(this,s)/12;break;case"month":r=Qt(this,s);break;case"quarter":r=Qt(this,s)/3;break;case"second":r=(this-s)/1e3;break;case"minute":r=(this-s)/6e4;break;case"hour":r=(this-s)/36e5;break;case"day":r=(this-s-i)/864e5;break;case"week":r=(this-s-i)/6048e5;break;default:r=this-s}return n?r:S(r)},mn.endOf=function(e){var t;if(void 0===(e=H(e))||"millisecond"===e||!this.isValid())return this;var n=this._isUTC?rn:sn;switch(e){case"year":t=n(this.year()+1,0,1)-1;break;case"quarter":t=n(this.year(),this.month()-this.month()%3+3,1)-1;break;case"month":t=n(this.year(),this.month()+1,1)-1;break;case"week":t=n(this.year(),this.month(),this.date()-this.weekday()+7)-1;break;case"isoWeek":t=n(this.year(),this.month(),this.date()-(this.isoWeekday()-1)+7)-1;break;case"day":case"date":t=n(this.year(),this.month(),this.date()+1)-1;break;case"hour":t=this._d.valueOf(),t+=36e5-nn(t+(this._isUTC?0:6e4*this.utcOffset()),36e5)-1;break;case"minute":t=this._d.valueOf(),t+=6e4-nn(t,6e4)-1;break;case"second":t=this._d.valueOf(),t+=1e3-nn(t,1e3)-1;break}return this._d.setTime(t),c.updateOffset(this,!0),this},mn.format=function(e){e||(e=this.isUtc()?c.defaultFormatUtc:c.defaultFormat);var t=A(this,e);return this.localeData().postformat(t)},mn.from=function(e,t){return this.isValid()&&(k(e)&&e.isValid()||bt(e).isValid())?jt({to:this,from:e}).locale(this.locale()).humanize(!t):this.localeData().invalidDate()},mn.fromNow=function(e){return this.from(bt(),e)},mn.to=function(e,t){return this.isValid()&&(k(e)&&e.isValid()||bt(e).isValid())?jt({from:this,to:e}).locale(this.locale()).humanize(!t):this.localeData().invalidDate()},mn.toNow=function(e){return this.to(bt(),e)},mn.get=function(e){return b(this[e=H(e)])?this[e]():this},mn.invalidAt=function(){return g(this).overflow},mn.isAfter=function(e,t){var n=k(e)?e:bt(e);return!(!this.isValid()||!n.isValid())&&("millisecond"===(t=H(t)||"millisecond")?this.valueOf()>n.valueOf():n.valueOf()<this.clone().startOf(t).valueOf())},mn.isBefore=function(e,t){var n=k(e)?e:bt(e);return!(!this.isValid()||!n.isValid())&&("millisecond"===(t=H(t)||"millisecond")?this.valueOf()<n.valueOf():this.clone().endOf(t).valueOf()<n.valueOf())},mn.isBetween=function(e,t,n,s){var i=k(e)?e:bt(e),r=k(t)?t:bt(t);return!!(this.isValid()&&i.isValid()&&r.isValid())&&("("===(s=s||"()")[0]?this.isAfter(i,n):!this.isBefore(i,n))&&(")"===s[1]?this.isBefore(r,n):!this.isAfter(r,n))},mn.isSame=function(e,t){var n,s=k(e)?e:bt(e);return!(!this.isValid()||!s.isValid())&&("millisecond"===(t=H(t)||"millisecond")?this.valueOf()===s.valueOf():(n=s.valueOf(),this.clone().startOf(t).valueOf()<=n&&n<=this.clone().endOf(t).valueOf()))},mn.isSameOrAfter=function(e,t){return this.isSame(e,t)||this.isAfter(e,t)},mn.isSameOrBefore=function(e,t){return this.isSame(e,t)||this.isBefore(e,t)},mn.isValid=function(){return v(this)},mn.lang=Kt,mn.locale=Xt,mn.localeData=en,mn.max=Pt,mn.min=xt,mn.parsingFlags=function(){return _({},g(this))},mn.set=function(e,t){if("object"==typeof e)for(var n=function(e){var t=[];for(var n in e)t.push({unit:n,priority:U[n]});return t.sort(function(e,t){return e.priority-t.priority}),t}(e=R(e)),s=0;s<n.length;s++)this[n[s].unit](e[n[s].unit]);else if(b(this[e=H(e)]))return this[e](t);return this},mn.startOf=function(e){var t;if(void 0===(e=H(e))||"millisecond"===e||!this.isValid())return this;var n=this._isUTC?rn:sn;switch(e){case"year":t=n(this.year(),0,1);break;case"quarter":t=n(this.year(),this.month()-this.month()%3,1);break;case"month":t=n(this.year(),this.month(),1);break;case"week":t=n(this.year(),this.month(),this.date()-this.weekday());break;case"isoWeek":t=n(this.year(),this.month(),this.date()-(this.isoWeekday()-1));break;case"day":case"date":t=n(this.year(),this.month(),this.date());break;case"hour":t=this._d.valueOf(),t-=nn(t+(this._isUTC?0:6e4*this.utcOffset()),36e5);break;case"minute":t=this._d.valueOf(),t-=nn(t,6e4);break;case"second":t=this._d.valueOf(),t-=nn(t,1e3);break}return this._d.setTime(t),c.updateOffset(this,!0),this},mn.subtract=Bt,mn.toArray=function(){var e=this;return[e.year(),e.month(),e.date(),e.hour(),e.minute(),e.second(),e.millisecond()]},mn.toObject=function(){var e=this;return{years:e.year(),months:e.month(),date:e.date(),hours:e.hours(),minutes:e.minutes(),seconds:e.seconds(),milliseconds:e.milliseconds()}},mn.toDate=function(){return new Date(this.valueOf())},mn.toISOString=function(e){if(!this.isValid())return null;var t=!0!==e,n=t?this.clone().utc():this;return n.year()<0||9999<n.year()?A(n,t?"YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]":"YYYYYY-MM-DD[T]HH:mm:ss.SSSZ"):b(Date.prototype.toISOString)?t?this.toDate().toISOString():new Date(this.valueOf()+60*this.utcOffset()*1e3).toISOString().replace("Z",A(n,"Z")):A(n,t?"YYYY-MM-DD[T]HH:mm:ss.SSS[Z]":"YYYY-MM-DD[T]HH:mm:ss.SSSZ")},mn.inspect=function(){if(!this.isValid())return"moment.invalid(/* "+this._i+" */)";var e="moment",t="";this.isLocal()||(e=0===this.utcOffset()?"moment.utc":"moment.parseZone",t="Z");var n="["+e+'("]',s=0<=this.year()&&this.year()<=9999?"YYYY":"YYYYYY",i=t+'[")]';return this.format(n+s+"-MM-DD[T]HH:mm:ss.SSS"+i)},mn.toJSON=function(){return this.isValid()?this.toISOString():null},mn.toString=function(){return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")},mn.unix=function(){return Math.floor(this.valueOf()/1e3)},mn.valueOf=function(){return this._d.valueOf()-6e4*(this._offset||0)},mn.creationData=function(){return{input:this._i,format:this._f,locale:this._locale,isUTC:this._isUTC,strict:this._strict}},mn.year=Oe,mn.isLeapYear=function(){return De(this.year())},mn.weekYear=function(e){return on.call(this,e,this.week(),this.weekday(),this.localeData()._week.dow,this.localeData()._week.doy)},mn.isoWeekYear=function(e){return on.call(this,e,this.isoWeek(),this.isoWeekday(),1,4)},mn.quarter=mn.quarters=function(e){return null==e?Math.ceil((this.month()+1)/3):this.month(3*(e-1)+this.month()%3)},mn.month=Ue,mn.daysInMonth=function(){return Pe(this.year(),this.month())},mn.week=mn.weeks=function(e){var t=this.localeData().week(this);return null==e?t:this.add(7*(e-t),"d")},mn.isoWeek=mn.isoWeeks=function(e){var t=Ie(this,1,4).week;return null==e?t:this.add(7*(e-t),"d")},mn.weeksInYear=function(){var e=this.localeData()._week;return Ae(this.year(),e.dow,e.doy)},mn.isoWeeksInYear=function(){return Ae(this.year(),1,4)},mn.date=un,mn.day=mn.days=function(e){if(!this.isValid())return null!=e?this:NaN;var t,n,s=this._isUTC?this._d.getUTCDay():this._d.getDay();return null!=e?(t=e,n=this.localeData(),e="string"!=typeof t?t:isNaN(t)?"number"==typeof(t=n.weekdaysParse(t))?t:null:parseInt(t,10),this.add(e-s,"d")):s},mn.weekday=function(e){if(!this.isValid())return null!=e?this:NaN;var t=(this.day()+7-this.localeData()._week.dow)%7;return null==e?t:this.add(e-t,"d")},mn.isoWeekday=function(e){if(!this.isValid())return null!=e?this:NaN;if(null==e)return this.day()||7;var t,n,s=(t=e,n=this.localeData(),"string"==typeof t?n.weekdaysParse(t)%7||7:isNaN(t)?null:t);return this.day(this.day()%7?s:s-7)},mn.dayOfYear=function(e){var t=Math.round((this.clone().startOf("day")-this.clone().startOf("year"))/864e5)+1;return null==e?t:this.add(e-t,"d")},mn.hour=mn.hours=nt,mn.minute=mn.minutes=ln,mn.second=mn.seconds=dn,mn.millisecond=mn.milliseconds=fn,mn.utcOffset=function(e,t,n){var s,i=this._offset||0;if(!this.isValid())return null!=e?this:NaN;if(null==e)return this._isUTC?i:Vt(this);if("string"==typeof e){if(null===(e=Nt(re,e)))return this}else Math.abs(e)<16&&!n&&(e*=60);return!this._isUTC&&t&&(s=Vt(this)),this._offset=e,this._isUTC=!0,null!=s&&this.add(s,"m"),i!==e&&(!t||this._changeInProgress?qt(this,jt(e-i,"m"),1,!1):this._changeInProgress||(this._changeInProgress=!0,c.updateOffset(this,!0),this._changeInProgress=null)),this},mn.utc=function(e){return this.utcOffset(0,e)},mn.local=function(e){return this._isUTC&&(this.utcOffset(0,e),this._isUTC=!1,e&&this.subtract(Vt(this),"m")),this},mn.parseZone=function(){if(null!=this._tzm)this.utcOffset(this._tzm,!1,!0);else if("string"==typeof this._i){var e=Nt(ie,this._i);null!=e?this.utcOffset(e):this.utcOffset(0,!0)}return this},mn.hasAlignedHourOffset=function(e){return!!this.isValid()&&(e=e?bt(e).utcOffset():0,(this.utcOffset()-e)%60==0)},mn.isDST=function(){return this.utcOffset()>this.clone().month(0).utcOffset()||this.utcOffset()>this.clone().month(5).utcOffset()},mn.isLocal=function(){return!!this.isValid()&&!this._isUTC},mn.isUtcOffset=function(){return!!this.isValid()&&this._isUTC},mn.isUtc=Et,mn.isUTC=Et,mn.zoneAbbr=function(){return this._isUTC?"UTC":""},mn.zoneName=function(){return this._isUTC?"Coordinated Universal Time":""},mn.dates=n("dates accessor is deprecated. Use date instead.",un),mn.months=n("months accessor is deprecated. Use month instead",Ue),mn.years=n("years accessor is deprecated. Use year instead",Oe),mn.zone=n("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/",function(e,t){return null!=e?("string"!=typeof e&&(e=-e),this.utcOffset(e,t),this):-this.utcOffset()}),mn.isDSTShifted=n("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information",function(){if(!l(this._isDSTShifted))return this._isDSTShifted;var e={};if(w(e,this),(e=Ot(e))._a){var t=e._isUTC?y(e._a):bt(e._a);this._isDSTShifted=this.isValid()&&0<a(e._a,t.toArray())}else this._isDSTShifted=!1;return this._isDSTShifted});var yn=P.prototype;function gn(e,t,n,s){var i=ht(),r=y().set(s,t);return i[n](r,e)}function vn(e,t,n){if(h(e)&&(t=e,e=void 0),e=e||"",null!=t)return gn(e,t,n,"month");var s,i=[];for(s=0;s<12;s++)i[s]=gn(e,s,n,"month");return i}function pn(e,t,n,s){t=("boolean"==typeof e?h(t)&&(n=t,t=void 0):(t=e,e=!1,h(n=t)&&(n=t,t=void 0)),t||"");var i,r=ht(),a=e?r._week.dow:0;if(null!=n)return gn(t,(n+a)%7,s,"day");var o=[];for(i=0;i<7;i++)o[i]=gn(t,(i+a)%7,s,"day");return o}yn.calendar=function(e,t,n){var s=this._calendar[e]||this._calendar.sameElse;return b(s)?s.call(t,n):s},yn.longDateFormat=function(e){var t=this._longDateFormat[e],n=this._longDateFormat[e.toUpperCase()];return t||!n?t:(this._longDateFormat[e]=n.replace(/MMMM|MM|DD|dddd/g,function(e){return e.slice(1)}),this._longDateFormat[e])},yn.invalidDate=function(){return this._invalidDate},yn.ordinal=function(e){return this._ordinal.replace("%d",e)},yn.preparse=_n,yn.postformat=_n,yn.relativeTime=function(e,t,n,s){var i=this._relativeTime[n];return b(i)?i(e,t,n,s):i.replace(/%d/i,e)},yn.pastFuture=function(e,t){var n=this._relativeTime[0<e?"future":"past"];return b(n)?n(t):n.replace(/%s/i,t)},yn.set=function(e){var t,n;for(n in e)b(t=e[n])?this[n]=t:this["_"+n]=t;this._config=e,this._dayOfMonthOrdinalParseLenient=new RegExp((this._dayOfMonthOrdinalParse.source||this._ordinalParse.source)+"|"+/\d{1,2}/.source)},yn.months=function(e,t){return e?o(this._months)?this._months[e.month()]:this._months[(this._months.isFormat||We).test(t)?"format":"standalone"][e.month()]:o(this._months)?this._months:this._months.standalone},yn.monthsShort=function(e,t){return e?o(this._monthsShort)?this._monthsShort[e.month()]:this._monthsShort[We.test(t)?"format":"standalone"][e.month()]:o(this._monthsShort)?this._monthsShort:this._monthsShort.standalone},yn.monthsParse=function(e,t,n){var s,i,r;if(this._monthsParseExact)return function(e,t,n){var s,i,r,a=e.toLocaleLowerCase();if(!this._monthsParse)for(this._monthsParse=[],this._longMonthsParse=[],this._shortMonthsParse=[],s=0;s<12;++s)r=y([2e3,s]),this._shortMonthsParse[s]=this.monthsShort(r,"").toLocaleLowerCase(),this._longMonthsParse[s]=this.months(r,"").toLocaleLowerCase();return n?"MMM"===t?-1!==(i=Ye.call(this._shortMonthsParse,a))?i:null:-1!==(i=Ye.call(this._longMonthsParse,a))?i:null:"MMM"===t?-1!==(i=Ye.call(this._shortMonthsParse,a))?i:-1!==(i=Ye.call(this._longMonthsParse,a))?i:null:-1!==(i=Ye.call(this._longMonthsParse,a))?i:-1!==(i=Ye.call(this._shortMonthsParse,a))?i:null}.call(this,e,t,n);for(this._monthsParse||(this._monthsParse=[],this._longMonthsParse=[],this._shortMonthsParse=[]),s=0;s<12;s++){if(i=y([2e3,s]),n&&!this._longMonthsParse[s]&&(this._longMonthsParse[s]=new RegExp("^"+this.months(i,"").replace(".","")+"$","i"),this._shortMonthsParse[s]=new RegExp("^"+this.monthsShort(i,"").replace(".","")+"$","i")),n||this._monthsParse[s]||(r="^"+this.months(i,"")+"|^"+this.monthsShort(i,""),this._monthsParse[s]=new RegExp(r.replace(".",""),"i")),n&&"MMMM"===t&&this._longMonthsParse[s].test(e))return s;if(n&&"MMM"===t&&this._shortMonthsParse[s].test(e))return s;if(!n&&this._monthsParse[s].test(e))return s}},yn.monthsRegex=function(e){return this._monthsParseExact?(m(this,"_monthsRegex")||Ne.call(this),e?this._monthsStrictRegex:this._monthsRegex):(m(this,"_monthsRegex")||(this._monthsRegex=Le),this._monthsStrictRegex&&e?this._monthsStrictRegex:this._monthsRegex)},yn.monthsShortRegex=function(e){return this._monthsParseExact?(m(this,"_monthsRegex")||Ne.call(this),e?this._monthsShortStrictRegex:this._monthsShortRegex):(m(this,"_monthsShortRegex")||(this._monthsShortRegex=Fe),this._monthsShortStrictRegex&&e?this._monthsShortStrictRegex:this._monthsShortRegex)},yn.week=function(e){return Ie(e,this._week.dow,this._week.doy).week},yn.firstDayOfYear=function(){return this._week.doy},yn.firstDayOfWeek=function(){return this._week.dow},yn.weekdays=function(e,t){var n=o(this._weekdays)?this._weekdays:this._weekdays[e&&!0!==e&&this._weekdays.isFormat.test(t)?"format":"standalone"];return!0===e?je(n,this._week.dow):e?n[e.day()]:n},yn.weekdaysMin=function(e){return!0===e?je(this._weekdaysMin,this._week.dow):e?this._weekdaysMin[e.day()]:this._weekdaysMin},yn.weekdaysShort=function(e){return!0===e?je(this._weekdaysShort,this._week.dow):e?this._weekdaysShort[e.day()]:this._weekdaysShort},yn.weekdaysParse=function(e,t,n){var s,i,r;if(this._weekdaysParseExact)return function(e,t,n){var s,i,r,a=e.toLocaleLowerCase();if(!this._weekdaysParse)for(this._weekdaysParse=[],this._shortWeekdaysParse=[],this._minWeekdaysParse=[],s=0;s<7;++s)r=y([2e3,1]).day(s),this._minWeekdaysParse[s]=this.weekdaysMin(r,"").toLocaleLowerCase(),this._shortWeekdaysParse[s]=this.weekdaysShort(r,"").toLocaleLowerCase(),this._weekdaysParse[s]=this.weekdays(r,"").toLocaleLowerCase();return n?"dddd"===t?-1!==(i=Ye.call(this._weekdaysParse,a))?i:null:"ddd"===t?-1!==(i=Ye.call(this._shortWeekdaysParse,a))?i:null:-1!==(i=Ye.call(this._minWeekdaysParse,a))?i:null:"dddd"===t?-1!==(i=Ye.call(this._weekdaysParse,a))?i:-1!==(i=Ye.call(this._shortWeekdaysParse,a))?i:-1!==(i=Ye.call(this._minWeekdaysParse,a))?i:null:"ddd"===t?-1!==(i=Ye.call(this._shortWeekdaysParse,a))?i:-1!==(i=Ye.call(this._weekdaysParse,a))?i:-1!==(i=Ye.call(this._minWeekdaysParse,a))?i:null:-1!==(i=Ye.call(this._minWeekdaysParse,a))?i:-1!==(i=Ye.call(this._weekdaysParse,a))?i:-1!==(i=Ye.call(this._shortWeekdaysParse,a))?i:null}.call(this,e,t,n);for(this._weekdaysParse||(this._weekdaysParse=[],this._minWeekdaysParse=[],this._shortWeekdaysParse=[],this._fullWeekdaysParse=[]),s=0;s<7;s++){if(i=y([2e3,1]).day(s),n&&!this._fullWeekdaysParse[s]&&(this._fullWeekdaysParse[s]=new RegExp("^"+this.weekdays(i,"").replace(".","\\.?")+"$","i"),this._shortWeekdaysParse[s]=new RegExp("^"+this.weekdaysShort(i,"").replace(".","\\.?")+"$","i"),this._minWeekdaysParse[s]=new RegExp("^"+this.weekdaysMin(i,"").replace(".","\\.?")+"$","i")),this._weekdaysParse[s]||(r="^"+this.weekdays(i,"")+"|^"+this.weekdaysShort(i,"")+"|^"+this.weekdaysMin(i,""),this._weekdaysParse[s]=new RegExp(r.replace(".",""),"i")),n&&"dddd"===t&&this._fullWeekdaysParse[s].test(e))return s;if(n&&"ddd"===t&&this._shortWeekdaysParse[s].test(e))return s;if(n&&"dd"===t&&this._minWeekdaysParse[s].test(e))return s;if(!n&&this._weekdaysParse[s].test(e))return s}},yn.weekdaysRegex=function(e){return this._weekdaysParseExact?(m(this,"_weekdaysRegex")||Qe.call(this),e?this._weekdaysStrictRegex:this._weekdaysRegex):(m(this,"_weekdaysRegex")||(this._weekdaysRegex=qe),this._weekdaysStrictRegex&&e?this._weekdaysStrictRegex:this._weekdaysRegex)},yn.weekdaysShortRegex=function(e){return this._weekdaysParseExact?(m(this,"_weekdaysRegex")||Qe.call(this),e?this._weekdaysShortStrictRegex:this._weekdaysShortRegex):(m(this,"_weekdaysShortRegex")||(this._weekdaysShortRegex=Je),this._weekdaysShortStrictRegex&&e?this._weekdaysShortStrictRegex:this._weekdaysShortRegex)},yn.weekdaysMinRegex=function(e){return this._weekdaysParseExact?(m(this,"_weekdaysRegex")||Qe.call(this),e?this._weekdaysMinStrictRegex:this._weekdaysMinRegex):(m(this,"_weekdaysMinRegex")||(this._weekdaysMinRegex=Be),this._weekdaysMinStrictRegex&&e?this._weekdaysMinStrictRegex:this._weekdaysMinRegex)},yn.isPM=function(e){return"p"===(e+"").toLowerCase().charAt(0)},yn.meridiem=function(e,t,n){return 11<e?n?"pm":"PM":n?"am":"AM"},ut("en",{dayOfMonthOrdinalParse:/\d{1,2}(th|st|nd|rd)/,ordinal:function(e){var t=e%10;return e+(1===D(e%100/10)?"th":1===t?"st":2===t?"nd":3===t?"rd":"th")}}),c.lang=n("moment.lang is deprecated. Use moment.locale instead.",ut),c.langData=n("moment.langData is deprecated. Use moment.localeData instead.",ht);var wn=Math.abs;function Mn(e,t,n,s){var i=jt(t,n);return e._milliseconds+=s*i._milliseconds,e._days+=s*i._days,e._months+=s*i._months,e._bubble()}function kn(e){return e<0?Math.floor(e):Math.ceil(e)}function Sn(e){return 4800*e/146097}function Dn(e){return 146097*e/4800}function Yn(e){return function(){return this.as(e)}}var On=Yn("ms"),Tn=Yn("s"),bn=Yn("m"),xn=Yn("h"),Pn=Yn("d"),Wn=Yn("w"),Cn=Yn("M"),Hn=Yn("Q"),Rn=Yn("y");function Un(e){return function(){return this.isValid()?this._data[e]:NaN}}var Fn=Un("milliseconds"),Ln=Un("seconds"),Nn=Un("minutes"),Gn=Un("hours"),Vn=Un("days"),En=Un("months"),In=Un("years");var An=Math.round,jn={ss:44,s:45,m:45,h:22,d:26,M:11};var Zn=Math.abs;function zn(e){return(0<e)-(e<0)||+e}function $n(){if(!this.isValid())return this.localeData().invalidDate();var e,t,n=Zn(this._milliseconds)/1e3,s=Zn(this._days),i=Zn(this._months);t=S((e=S(n/60))/60),n%=60,e%=60;var r=S(i/12),a=i%=12,o=s,u=t,l=e,h=n?n.toFixed(3).replace(/\.?0+$/,""):"",d=this.asSeconds();if(!d)return"P0D";var c=d<0?"-":"",f=zn(this._months)!==zn(d)?"-":"",m=zn(this._days)!==zn(d)?"-":"",_=zn(this._milliseconds)!==zn(d)?"-":"";return c+"P"+(r?f+r+"Y":"")+(a?f+a+"M":"")+(o?m+o+"D":"")+(u||l||h?"T":"")+(u?_+u+"H":"")+(l?_+l+"M":"")+(h?_+h+"S":"")}var qn=Ht.prototype;return qn.isValid=function(){return this._isValid},qn.abs=function(){var e=this._data;return this._milliseconds=wn(this._milliseconds),this._days=wn(this._days),this._months=wn(this._months),e.milliseconds=wn(e.milliseconds),e.seconds=wn(e.seconds),e.minutes=wn(e.minutes),e.hours=wn(e.hours),e.months=wn(e.months),e.years=wn(e.years),this},qn.add=function(e,t){return Mn(this,e,t,1)},qn.subtract=function(e,t){return Mn(this,e,t,-1)},qn.as=function(e){if(!this.isValid())return NaN;var t,n,s=this._milliseconds;if("month"===(e=H(e))||"quarter"===e||"year"===e)switch(t=this._days+s/864e5,n=this._months+Sn(t),e){case"month":return n;case"quarter":return n/3;case"year":return n/12}else switch(t=this._days+Math.round(Dn(this._months)),e){case"week":return t/7+s/6048e5;case"day":return t+s/864e5;case"hour":return 24*t+s/36e5;case"minute":return 1440*t+s/6e4;case"second":return 86400*t+s/1e3;case"millisecond":return Math.floor(864e5*t)+s;default:throw new Error("Unknown unit "+e)}},qn.asMilliseconds=On,qn.asSeconds=Tn,qn.asMinutes=bn,qn.asHours=xn,qn.asDays=Pn,qn.asWeeks=Wn,qn.asMonths=Cn,qn.asQuarters=Hn,qn.asYears=Rn,qn.valueOf=function(){return this.isValid()?this._milliseconds+864e5*this._days+this._months%12*2592e6+31536e6*D(this._months/12):NaN},qn._bubble=function(){var e,t,n,s,i,r=this._milliseconds,a=this._days,o=this._months,u=this._data;return 0<=r&&0<=a&&0<=o||r<=0&&a<=0&&o<=0||(r+=864e5*kn(Dn(o)+a),o=a=0),u.milliseconds=r%1e3,e=S(r/1e3),u.seconds=e%60,t=S(e/60),u.minutes=t%60,n=S(t/60),u.hours=n%24,o+=i=S(Sn(a+=S(n/24))),a-=kn(Dn(i)),s=S(o/12),o%=12,u.days=a,u.months=o,u.years=s,this},qn.clone=function(){return jt(this)},qn.get=function(e){return e=H(e),this.isValid()?this[e+"s"]():NaN},qn.milliseconds=Fn,qn.seconds=Ln,qn.minutes=Nn,qn.hours=Gn,qn.days=Vn,qn.weeks=function(){return S(this.days()/7)},qn.months=En,qn.years=In,qn.humanize=function(e){if(!this.isValid())return this.localeData().invalidDate();var t,n,s,i,r,a,o,u,l,h,d,c=this.localeData(),f=(n=!e,s=c,i=jt(t=this).abs(),r=An(i.as("s")),a=An(i.as("m")),o=An(i.as("h")),u=An(i.as("d")),l=An(i.as("M")),h=An(i.as("y")),(d=r<=jn.ss&&["s",r]||r<jn.s&&["ss",r]||a<=1&&["m"]||a<jn.m&&["mm",a]||o<=1&&["h"]||o<jn.h&&["hh",o]||u<=1&&["d"]||u<jn.d&&["dd",u]||l<=1&&["M"]||l<jn.M&&["MM",l]||h<=1&&["y"]||["yy",h])[2]=n,d[3]=0<+t,d[4]=s,function(e,t,n,s,i){return i.relativeTime(t||1,!!n,e,s)}.apply(null,d));return e&&(f=c.pastFuture(+this,f)),c.postformat(f)},qn.toISOString=$n,qn.toString=$n,qn.toJSON=$n,qn.locale=Xt,qn.localeData=en,qn.toIsoString=n("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)",$n),qn.lang=Kt,I("X",0,0,"unix"),I("x",0,0,"valueOf"),ue("x",se),ue("X",/[+-]?\d+(\.\d{1,3})?/),ce("X",function(e,t,n){n._d=new Date(1e3*parseFloat(e,10))}),ce("x",function(e,t,n){n._d=new Date(D(e))}),c.version="2.24.0",e=bt,c.fn=mn,c.min=function(){return Wt("isBefore",[].slice.call(arguments,0))},c.max=function(){return Wt("isAfter",[].slice.call(arguments,0))},c.now=function(){return Date.now?Date.now():+new Date},c.utc=y,c.unix=function(e){return bt(1e3*e)},c.months=function(e,t){return vn(e,t,"months")},c.isDate=d,c.locale=ut,c.invalid=p,c.duration=jt,c.isMoment=k,c.weekdays=function(e,t,n){return pn(e,t,n,"weekdays")},c.parseZone=function(){return bt.apply(null,arguments).parseZone()},c.localeData=ht,c.isDuration=Rt,c.monthsShort=function(e,t){return vn(e,t,"monthsShort")},c.weekdaysMin=function(e,t,n){return pn(e,t,n,"weekdaysMin")},c.defineLocale=lt,c.updateLocale=function(e,t){if(null!=t){var n,s,i=st;null!=(s=ot(e))&&(i=s._config),(n=new P(t=x(i,t))).parentLocale=it[e],it[e]=n,ut(e)}else null!=it[e]&&(null!=it[e].parentLocale?it[e]=it[e].parentLocale:null!=it[e]&&delete it[e]);return it[e]},c.locales=function(){return s(it)},c.weekdaysShort=function(e,t,n){return pn(e,t,n,"weekdaysShort")},c.normalizeUnits=H,c.relativeTimeRounding=function(e){return void 0===e?An:"function"==typeof e&&(An=e,!0)},c.relativeTimeThreshold=function(e,t){return void 0!==jn[e]&&(void 0===t?jn[e]:(jn[e]=t,"s"===e&&(jn.ss=t-1),!0))},c.calendarFormat=function(e,t){var n=e.diff(t,"days",!0);return n<-6?"sameElse":n<-1?"lastWeek":n<0?"lastDay":n<1?"sameDay":n<2?"nextDay":n<7?"nextWeek":"sameElse"},c.prototype=mn,c.HTML5_FMT={DATETIME_LOCAL:"YYYY-MM-DDTHH:mm",DATETIME_LOCAL_SECONDS:"YYYY-MM-DDTHH:mm:ss",DATETIME_LOCAL_MS:"YYYY-MM-DDTHH:mm:ss.SSS",DATE:"YYYY-MM-DD",TIME:"HH:mm",TIME_SECONDS:"HH:mm:ss",TIME_MS:"HH:mm:ss.SSS",WEEK:"GGGG-[W]WW",MONTH:"YYYY-MM"},c});
!function(t,e){"use strict";"object"==typeof module&&module.exports?module.exports=e(require("moment")):"function"==typeof define&&define.amd?define(["moment"],e):e(t.moment)}(this,function(s){"use strict";var e,i={},f={},u={},c={};s&&"string"==typeof s.version||A("Moment Timezone requires Moment.js. See https://momentjs.com/timezone/docs/#/use-it/browser/");var t=s.version.split("."),n=+t[0],o=+t[1];function a(t){return 96<t?t-87:64<t?t-29:t-48}function r(t){var e=0,n=t.split("."),o=n[0],r=n[1]||"",s=1,i=0,f=1;for(45===t.charCodeAt(0)&&(f=-(e=1));e<o.length;e++)i=60*i+a(o.charCodeAt(e));for(e=0;e<r.length;e++)s/=60,i+=a(r.charCodeAt(e))*s;return i*f}function l(t){for(var e=0;e<t.length;e++)t[e]=r(t[e])}function h(t,e){var n,o=[];for(n=0;n<e.length;n++)o[n]=t[e[n]];return o}function m(t){var e=t.split("|"),n=e[2].split(" "),o=e[3].split(""),r=e[4].split(" ");return l(n),l(o),l(r),function(t,e){for(var n=0;n<e;n++)t[n]=Math.round((t[n-1]||0)+6e4*t[n]);t[e-1]=1/0}(r,o.length),{name:e[0],abbrs:h(e[1].split(" "),o),offsets:h(n,o),untils:r,population:0|e[5]}}function p(t){t&&this._set(m(t))}function d(t){var e=t.toTimeString(),n=e.match(/\([a-z ]+\)/i);"GMT"===(n=n&&n[0]?(n=n[0].match(/[A-Z]/g))?n.join(""):void 0:(n=e.match(/[A-Z]{3,5}/g))?n[0]:void 0)&&(n=void 0),this.at=+t,this.abbr=n,this.offset=t.getTimezoneOffset()}function z(t){this.zone=t,this.offsetScore=0,this.abbrScore=0}function v(t,e){for(var n,o;o=6e4*((e.at-t.at)/12e4|0);)(n=new d(new Date(t.at+o))).offset===t.offset?t=n:e=n;return t}function b(t,e){return t.offsetScore!==e.offsetScore?t.offsetScore-e.offsetScore:t.abbrScore!==e.abbrScore?t.abbrScore-e.abbrScore:e.zone.population-t.zone.population}function g(t,e){var n,o;for(l(e),n=0;n<e.length;n++)o=e[n],c[o]=c[o]||{},c[o][t]=!0}function _(){try{var t=Intl.DateTimeFormat().resolvedOptions().timeZone;if(t&&3<t.length){var e=u[w(t)];if(e)return e;A("Moment Timezone found "+t+" from the Intl api, but did not have that data loaded.")}}catch(t){}var n,o,r,s=function(){var t,e,n,o=(new Date).getFullYear()-2,r=new d(new Date(o,0,1)),s=[r];for(n=1;n<48;n++)(e=new d(new Date(o,n,1))).offset!==r.offset&&(t=v(r,e),s.push(t),s.push(new d(new Date(t.at+6e4)))),r=e;for(n=0;n<4;n++)s.push(new d(new Date(o+n,0,1))),s.push(new d(new Date(o+n,6,1)));return s}(),i=s.length,f=function(t){var e,n,o,r=t.length,s={},i=[];for(e=0;e<r;e++)for(n in o=c[t[e].offset]||{})o.hasOwnProperty(n)&&(s[n]=!0);for(e in s)s.hasOwnProperty(e)&&i.push(u[e]);return i}(s),a=[];for(o=0;o<f.length;o++){for(n=new z(O(f[o]),i),r=0;r<i;r++)n.scoreOffsetAt(s[r]);a.push(n)}return a.sort(b),0<a.length?a[0].zone.name:void 0}function w(t){return(t||"").toLowerCase().replace(/\//g,"_")}function y(t){var e,n,o,r;for("string"==typeof t&&(t=[t]),e=0;e<t.length;e++)r=w(n=(o=t[e].split("|"))[0]),i[r]=t[e],u[r]=n,g(r,o[2].split(" "))}function O(t,e){t=w(t);var n,o=i[t];return o instanceof p?o:"string"==typeof o?(o=new p(o),i[t]=o):f[t]&&e!==O&&(n=O(f[t],O))?((o=i[t]=new p)._set(n),o.name=u[t],o):null}function S(t){var e,n,o,r;for("string"==typeof t&&(t=[t]),e=0;e<t.length;e++)o=w((n=t[e].split("|"))[0]),r=w(n[1]),f[o]=r,u[o]=n[0],f[r]=o,u[r]=n[1]}function M(t){var e="X"===t._f||"x"===t._f;return!(!t._a||void 0!==t._tzm||e)}function A(t){"undefined"!=typeof console&&"function"==typeof console.error&&console.error(t)}function j(t){var e=Array.prototype.slice.call(arguments,0,-1),n=arguments[arguments.length-1],o=O(n),r=s.utc.apply(null,e);return o&&!s.isMoment(t)&&M(r)&&r.add(o.parse(r),"minutes"),r.tz(n),r}(n<2||2==n&&o<6)&&A("Moment Timezone requires Moment.js >= 2.6.0. You are using Moment.js "+s.version+". See momentjs.com"),p.prototype={_set:function(t){this.name=t.name,this.abbrs=t.abbrs,this.untils=t.untils,this.offsets=t.offsets,this.population=t.population},_index:function(t){var e,n=+t,o=this.untils;for(e=0;e<o.length;e++)if(n<o[e])return e},parse:function(t){var e,n,o,r,s=+t,i=this.offsets,f=this.untils,a=f.length-1;for(r=0;r<a;r++)if(e=i[r],n=i[r+1],o=i[r?r-1:r],e<n&&j.moveAmbiguousForward?e=n:o<e&&j.moveInvalidForward&&(e=o),s<f[r]-6e4*e)return i[r];return i[a]},abbr:function(t){return this.abbrs[this._index(t)]},offset:function(t){return A("zone.offset has been deprecated in favor of zone.utcOffset"),this.offsets[this._index(t)]},utcOffset:function(t){return this.offsets[this._index(t)]}},z.prototype.scoreOffsetAt=function(t){this.offsetScore+=Math.abs(this.zone.utcOffset(t.at)-t.offset),this.zone.abbr(t.at).replace(/[^A-Z]/g,"")!==t.abbr&&this.abbrScore++},j.version="0.5.25",j.dataVersion="",j._zones=i,j._links=f,j._names=u,j.add=y,j.link=S,j.load=function(t){y(t.zones),S(t.links),j.dataVersion=t.version},j.zone=O,j.zoneExists=function t(e){return t.didShowError||(t.didShowError=!0,A("moment.tz.zoneExists('"+e+"') has been deprecated in favor of !moment.tz.zone('"+e+"')")),!!O(e)},j.guess=function(t){return e&&!t||(e=_()),e},j.names=function(){var t,e=[];for(t in u)u.hasOwnProperty(t)&&(i[t]||i[f[t]])&&u[t]&&e.push(u[t]);return e.sort()},j.Zone=p,j.unpack=m,j.unpackBase60=r,j.needsOffset=M,j.moveInvalidForward=!0,j.moveAmbiguousForward=!1;var T,D=s.fn;function x(t){return function(){return this._z?this._z.abbr(this):t.call(this)}}function Z(t){return function(){return this._z=null,t.apply(this,arguments)}}s.tz=j,s.defaultZone=null,s.updateOffset=function(t,e){var n,o=s.defaultZone;if(void 0===t._z&&(o&&M(t)&&!t._isUTC&&(t._d=s.utc(t._a)._d,t.utc().add(o.parse(t),"minutes")),t._z=o),t._z)if(n=t._z.utcOffset(t),Math.abs(n)<16&&(n/=60),void 0!==t.utcOffset){var r=t._z;t.utcOffset(-n,e),t._z=r}else t.zone(n,e)},D.tz=function(t,e){if(t){if("string"!=typeof t)throw new Error("Time zone name must be a string, got "+t+" ["+typeof t+"]");return this._z=O(t),this._z?s.updateOffset(this,e):A("Moment Timezone has no data for "+t+". See http://momentjs.com/timezone/docs/#/data-loading/."),this}if(this._z)return this._z.name},D.zoneName=x(D.zoneName),D.zoneAbbr=x(D.zoneAbbr),D.utc=Z(D.utc),D.local=Z(D.local),D.utcOffset=(T=D.utcOffset,function(){return 0<arguments.length&&(this._z=null),T.apply(this,arguments)}),s.tz.setDefault=function(t){return(n<2||2==n&&o<9)&&A("Moment Timezone setDefault() requires Moment.js >= 2.9.0. You are using Moment.js "+s.version+"."),s.defaultZone=t?O(t):null,s};var F=s.momentProperties;return"[object Array]"===Object.prototype.toString.call(F)?(F.push("_z"),F.push("_a")):F&&(F._z=null),s});
/**
 * Validator
 *
 */
var utilValidator = {
    // focus 위치 설정 number
    iElementNumber: 0,

    /**
     * 휴대폰 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkMobile : function(mMobile)
    {
        // 국문몰인경우 유효성체크
        if (SHOP.getLanguage() != 'ko_KR') return true;

        var mobile_number_pattern = /01[016789][0-9]{3,4}[0-9]{4}$/;

        // 초기화
        this.iElementNumber = 0;

        // 유효성 체크
        if (typeof(mMobile) == 'string') {
            if (!mobile_number_pattern.test(mMobile)) return false;
            return true;
        }

        if (typeof(mMobile.mobile2) == 'undefined' || typeof(mMobile.mobile3) == 'undefined') return false;

        var mobile2_pattern = /^\d{3,4}$/;
        var mobile3_pattern = /^\d{4}$/;

        if (!mobile2_pattern.test(mMobile['mobile2'])) {
            // mobile2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        if (!mobile3_pattern.test(mMobile['mobile3'])) {
            // mobile3 focus 위치 하도록 설정
            this.iElementNumber = 3;
            return false;
        }

        if (!mobile_number_pattern.test(mMobile.mobile1 + mMobile.mobile2 + mMobile.mobile3)) {

            // mobile1 focus 위치 하도록 설정
            this.iElementNumber = 1;
            return false;
        }
        return true;
    },

    /**
     * 일반전화 패턴 체크
     * @param string|array mPhone
     * @returns {boolean}
     */
    checkPhone : function(mPhone)
    {
        // 국문몰인경우 유효성체크
        if (SHOP.getLanguage() != 'ko_KR') return true;

        // 초기화
        this.iElementNumber = 0;

        var phone_pattern = /^\d{7,8}$/;

        // 유효성 체크
        if (typeof(mPhone) == 'string') {
            if (!phone_pattern.test(mPhone)) return false;
            return true;
        }

        if (typeof(mPhone.phone2) == 'undefined' || typeof(mPhone.phone3) == 'undefined') return false;

        var phone2_pattern = /^\d{3,4}$/;
        var phone3_pattern = /^\d{4}$/;

        if (!phone2_pattern.test(mPhone['phone2'])) {
            // phone2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        if (!phone3_pattern.test(mPhone['phone3'])) {
            // phone3 focus 위치 하도록 설정
            this.iElementNumber = 3;
            return false;
        }

        return true;
    }
};
/**
 * Validator
 *
 */
var utilvalidatorJp = {
    // focus 위치 설정 number
    iElementNumber: 0,

    // 일본 국가 코드
    iCountryPhoneCode: 81,

    /**
     * 휴대폰 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkMobile : function(mMobile)
    {
        // 국문몰 외 유효성체크
        if (SHOP.getLanguage() == 'ko_KR') return true;

        // 일본국가코드 11자리
        var mobile_number_pattern = /^\d{11}$/;

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mMobile.mobile2) == 'undefined') return false;

        // 국가 번호 일본
        if (this.iCountryPhoneCode != mMobile['mobile1']) {

            if (mMobile['mobile1'] == "") {
                this.iElementNumber = 1;
                return false;
            }

            if (mMobile['mobile2'] == "") {
                this.iElementNumber = 2;
                return false;
            }

            if (mMobile['mobile3'] == "") {
                this.iElementNumber = 3;
                return false;
            }

            return true;
        }

        if (!mobile_number_pattern.test(mMobile.mobile2)) {
            // mobile2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        return true;
    },

    /**
     * 일반전화 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkPhone : function(mPhone)
    {
        // 국문몰 외 유효성체크
        if (SHOP.getLanguage() == 'ko_KR') return true;

        // 10~11 자리
        var phone_number_pattern = /^\d{10,11}$/;

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mPhone.phone2) == 'undefined') return false;

        // 국가 번호 일본
        if (this.iCountryPhoneCode != mPhone['phone1']) {

            if (mPhone['phone1'] == "") {
                this.iElementNumber = 1;
                return false;
            }

            if (mPhone['phone2'] == "") {
                this.iElementNumber = 2;
                return false;
            }

            if (mPhone['phone3'] == "") {
                this.iElementNumber = 3;
                return false;
            }

            return true;
        }

        if (!phone_number_pattern.test(mPhone['phone2'])) {
            // phone2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        return true;
    }
};
function utilValidatorFactory() {
    this.createValidator = function () {
        var oValidatorObject;

        if (SHOP.getLanguage() == "ko_KR") {
            oValidatorObject = utilValidator;
        } else {
            oValidatorObject = utilvalidatorJp;
        }
        return oValidatorObject;
    }
}
var utilValidatorController = {
    utilvalidator: "",

    init : function() {
        var utilValidatorFactoryObject = new utilValidatorFactory();
        this.utilvalidator = utilValidatorFactoryObject.createValidator();
    },

    isValidatorObject : function() {
        var sReturn = 'T';
        if (this.utilvalidator == undefined || this.utilvalidator == "") {
            this.init();
        }

        if (this.utilvalidator == undefined || this.utilvalidator == "") {
            sReturn = 'F';
        }
        return sReturn
    },

    existsFunction : function(sMethodName) {
        var sReturn = "F";

        if (typeof this.utilvalidator[sMethodName] === "function") {
            sReturn = "T";
        }
        return sReturn;
    },

    checkMobile : function(mMobile) {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        if (this.existsFunction("checkMobile") == "F") {
            return true;
        }

        return this.utilvalidator.checkMobile(mMobile);
    },

    checkPhone : function(mMobile) {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        if (this.existsFunction("checkPhone") == "F") {
            return true;
        }

        return this.utilvalidator.checkPhone(mMobile);
    },

    getElementNumber : function() {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        return this.utilvalidator.iElementNumber;
    }
}
var memberVerifyMobile = {}

/**
 * 회원 가입시 인증 번호 전송에 필요한 정보 암호화
 */
memberVerifyMobile.joinSendVerificationNumber = function()
{
    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': ['joinForm::mobile1', 'joinForm::mobile2', 'joinForm::mobile3'],
        'auth_callbackName': 'memberVerifyMobile.sendVerificationNumberEncryptResult'
    });
}

/**
 * 회원 정보 수정시 인증 번호 전송에 필요한 정보 암호화
 */
memberVerifyMobile.editSendVerificationNumber = function()
{
    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': ['editForm::mobile1', 'editForm::mobile2', 'editForm::mobile3'],
        'auth_callbackName': 'memberVerifyMobile.sendVerificationNumberEncryptResult'
    });
}

memberVerifyMobile.sendVerificationNumberEncryptResult = function(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    $.ajax({
        url: '/exec/front/member/ApiAuthsms',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str=' + sEncrypted,
        success: function(response) {
            try {
                response.sResultMsg = decodeURIComponent(response.sResultMsg);
            } catch (e) {}

            if (response.sResultCode == '0000') {
                memberVerifyMobile.sendVerificationNumberSuccess(response);
            } else {
                memberVerifyMobile.sendVerificationNumberFail(response);
            }
        }
    });
}

/**
 * 회원 가입 휴대전화 인증 번호 전송 성공
 */
memberVerifyMobile.sendVerificationNumberSuccess = function(response)
{
    // sms 실제 발송 여부 확인
    if (response.isSendMobileSms !== true) {
        return;
    }

    if ($("#btn_action_verify_mobile").html() == __('GET.VERIFICATION.NUMBER', 'MEMBER.UTIL.VERIFY')) {
        alert(__('NUMBER.RESENT', 'MEMBER.UTIL.VERIFY'));
    }

    this.verifyNumberCountdown();

    $("#btn_action_verify_mobile").html(__('RETRANSMISSION', 'MEMBER.UTIL.VERIFY'));
    $("#confirm_verify_mobile").removeClass("displaynone");
    $("#confirm_verify_mobile").show();

    var oVerifySmsNumber = $("#verify_sms_number");

    oVerifySmsNumber.attr("placeholder", "");

    if (EC_MOBILE === true) {
        alert(response.sResultMsg);
        return;
    }

    $("#result_send_verify_mobile_fail").hide();
    $("#result_send_verify_mobile_success").removeClass("displaynone");
    $("#result_send_verify_mobile_success").show();
    $("#btn_verify_mobile_confirm").attr("disabled", false);
    oVerifySmsNumber.attr('disabled', false);
}

/**
 * 회원 가입 휴대전화 인증 번호 전송 실패
 */
memberVerifyMobile.sendVerificationNumberFail = function(response)
{
    $("#btn_action_verify_mobile").html(__('GET.VERIFICATION.NUMBER', 'MEMBER.UTIL.VERIFY'));

    if (EC_MOBILE === true) {
        alert(response.sResultMsg);
        return;
    }

    $("#result_send_verify_mobile_success").hide();

    var oResultSendVerifyMobileFail = $("#result_send_verify_mobile_fail");
    oResultSendVerifyMobileFail.removeClass("displaynone");
    oResultSendVerifyMobileFail.show();
    oResultSendVerifyMobileFail.html(response.sResultMsg.replace(/\n/g, "<br />"));

    $("#expiryTime").html("");
    clearInterval(memberVerifyMobile.timer);

    var oVerifySmsNumber = $("#verify_sms_number");
    if (response.sResultCode == "3001") {
        $("#confirm_verify_mobile").removeClass("displaynone");
        $("#confirm_verify_mobile").show();
        oVerifySmsNumber.val("");
        oVerifySmsNumber.attr("placeholder", __('TRY.AGAIN.IN.MINUTES', 'MEMBER.UTIL.VERIFY'));
        oVerifySmsNumber.attr("disabled", true);
        $("#btn_verify_mobile_confirm").attr("disabled", true);
        return;
    } else {
        oVerifySmsNumber.removeAttr("placeholder");
        $("#expiryTime").attr("disabled", false);
    }

    $("#confirm_verify_mobile").hide();
}

/**
 * 휴대폰 인증 번호 카운트 다운
 */
memberVerifyMobile.verifyNumberCountdown = function()
{
    //초기값
    var iMinute = 3;
    var iSecond = "00";
    var iZero = "";
    var iTmpSecond = "";

    // 초기화
    if (typeof memberVerifyMobile.timer != "undefined") {
        clearInterval(memberVerifyMobile.timer);
    }

    $("#expiryTime").html(iMinute +":"+iSecond);

    // 초기화
    memberVerifyMobile.timer = setInterval(function () {
        iSecond = iSecond.toString();

        if (iSecond.length < 2) {
            iTmpSecond = iSecond;
            iZero = 0;
            iSecond = iZero + iTmpSecond;
        }

        // 설정
        $("#expiryTime").html(iMinute +":"+iSecond);
        if (iSecond == 0 && iMinute == 0) {
            clearInterval(memberVerifyMobile.timer); /* 타이머 종료 */
            $("#confirm_verify_mobile").hide();
            $("#result_send_verify_mobile_success").hide();
        } else {
            iSecond--;
            // 분처리
            if(iSecond < 0){
                iMinute--;
                iSecond = 59;
            }
        }
    }, 1000); /* millisecond 단위의 인터벌 */
}


/**
 * 회원 가입시 인증 번호 전송에 필요한 정보 암호화
 */
memberVerifyMobile.joinVerifySmsNumberConfirm = function()
{
    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': ['joinForm::mobile1', 'joinForm::mobile2', 'joinForm::mobile3', 'joinForm::verify_sms_number'],
        'auth_callbackName': 'memberVerifyMobile.joinVerifySmsNumberConfirmResult'
    });
}

/**
 * 회원 가입시 인증 번호 전송에 필요한 정보 암호화
 */
memberVerifyMobile.editVerifySmsNumberConfirm = function()
{
    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': ['editForm::mobile1', 'editForm::mobile2', 'editForm::mobile3', 'editForm::verify_sms_number'],
        'auth_callbackName': 'memberVerifyMobile.joinVerifySmsNumberConfirmResult'
    });
}

/**
 * 인증번호 확인
 * @param output
 */
memberVerifyMobile.joinVerifySmsNumberConfirmResult = function(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    $.ajax({
        url: '/exec/front/member/ApiAuthJoinconfirm',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str=' + sEncrypted,
        success: function(response) {
            try {
                response['sResultMsg'] = decodeURIComponent(response['sResultMsg']);
            } catch (err) {}

            if (response.sResultCode == '0000') {
                memberVerifyMobile.joinVerifySmsNumberConfirmSuccess(response);
            } else {
                memberVerifyMobile.joinVerifySmsNumberConfirmFail(response);
            }
        }
    });
}

/**
 * 회원 가입 휴대전화 인증 성공
 */
memberVerifyMobile.joinVerifySmsNumberConfirmSuccess = function(response)
{
    $("#verify_sms_number").val("");
    $("#verify_sms_number").attr("placeholder", response['sResultMsg']);
    $("#verify_sms_number").attr('disabled', true);

    $("#expiryTime").hide();
    $("#isMobileVerify").val("T");
}

/**
 * 회원 가입 휴대전화 인증 실패
 */
memberVerifyMobile.joinVerifySmsNumberConfirmFail = function(response)
{
    alert(response['sResultMsg']);
    $("#isMobileVerify").val("F");
}

memberVerifyMobile.requireMobileNumber = function(oMobileElement)
{
    if (oMobileElement.val() != "") {
        return;
    }

    var oResultSendVerifyMobileFail = $("#result_send_verify_mobile_fail");
    oResultSendVerifyMobileFail.removeClass("displaynone");
    oResultSendVerifyMobileFail.show();
    oResultSendVerifyMobileFail.html(__('ENTER.YOUR.MOBILE.NUMBER', 'MEMBER.UTIL.VERIFY'));
}

/**
 * 휴대전화 인증 여부
 * @returns {boolean}
 */
memberVerifyMobile.isMobileVerify = function()
{
    if ($("#use_checking_mobile_number_duplication").val() != "T") {
        return true;
    }

    if ($("#isMobileVerify").val() == "F") {
        return false;
    }

    return true;
}

/**
 * 휴대전화 변경 전 기존 정보 확인
 */
memberVerifyMobile.setEditMobileNumberBefore = function(aMember)
{
    if (aMember.hasOwnProperty('mobile1')) {
        memberVerifyMobile.editMobile1 = aMember['mobile1'];
    }

    if (aMember.hasOwnProperty('mobile2')) {
        memberVerifyMobile.editMobile2 = aMember['mobile2'];
    }

    if (aMember.hasOwnProperty('mobile3')) {
        memberVerifyMobile.editMobile3 = aMember['mobile3'];
    }
}

/**
 * 휴대전화 번호 변경 됐는지 확인
 */
memberVerifyMobile.isMobileNumberChange = function()
{
    if ($("#use_checking_mobile_number_duplication").val() != "T") {
        return false;
    }

    if ($("#mobile1").val() != memberVerifyMobile.editMobile1) {
        return true;
    }

    if ($("#mobile2").val() != memberVerifyMobile.editMobile2) {
        return true;
    }

    if ($("#mobile3").val() != memberVerifyMobile.editMobile3) {
        return true;
    }

    return false;
}

$(document).ready(function() {
    $("#mobile2").blur(function(){
        memberVerifyMobile.requireMobileNumber($(this));
    });

    $("#mobile3").blur(function(){
        memberVerifyMobile.requireMobileNumber($(this));
    });
})
/**
 * 닉네임 중복 체크
 */
function checkNick()
{
    var sNickName = $.trim($('#nick_name').val());
    var bIsLength = checkLength(sNickName);
    
    if (bIsLength['passed'] == false) {
        $('#nickMsg').html(bIsLength['msg']);
        return false;
    }
    
    $.ajax({
        url: '/exec/front/Member/CheckNick',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&nickName=' + sNickName,
        timeout: 1000,   
        success: function(response){
            
            $('#nickMsg').html(response['msg']);
            
            if (response['passed'] == true) { 
                $('#nick_name_confirm').val('T');
            } else {
                $('#nick_name_confirm').val('F');
            }
            
        }
    });
}

/**
 * 닉네임 글자수 체크
 * @param sNickName 닉네임
 * @returns {Boolean}
 */
function checkLength(sNickName)
{
        
    if ($('#nick_name_flag').val() != 'T') return {'passed' : true};//닉네임 사용 안함    
    
    var iBtye = 0;
    
    for (var i = 0; i < sNickName.length; i++) {
        
        if (sNickName.charCodeAt(i) > 128) {
            iBtye += 2;
        } else {
            iBtye += 1;
        }
    }
    
    if (iBtye < 4)
        return {'passed' : false, 'msg' : __('한글 2자 이상/영문 대소문자 4자/숫자 혼용 사용 가능합니다.')};        


    if (iBtye > 20)        
        return {'passed' : false, 'msg' : __('한글 10자 이하/영문 대소문자 20자/숫자 혼용 사용 가능합니다.')};

    return {'passed' : true};
}

/**
 * 개인사업자번호 중복 체크
 */
function checkCssnDupl()
{
    var sCssn = EC$('#cssn').val();

    if (sCssn == '') {
        EC$('#cssnMsg').addClass('error').html(__('올바른 사업자번호를 입력해 주세요.'));
        return false;
    }

    var aData = ['cssn'];
    var bIsLogin = document.cookie.match(/(?:^| |;)iscache=F/) ? true : false;

    // 수정 페이지에서 넘어왔다면
    if (bIsLogin) {
        aData.push('member_id');
    }

    // ssl 암호화 처리
    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': aData,
        'auth_callbackName': 'callbackCssnCheck'
    });
}

/**
 * 개인사업자번호 체크 callback
 */
function callbackCssnCheck(sOutput)
{
    EC$.ajax({
        url: '/exec/front/Member/CheckCssn',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str='+encodeURIComponent(sOutput),
        timeout: 3000,
        success: function(response){
            if (response['passed'] == true) {
                EC$('#cssnMsg').removeClass('error').html(response['msg']);
                EC$('#cssnDuplCheck').val('T');
            } else {
                EC$('#cssnMsg').addClass('error').html(__(response['msg']));
                EC$('#cssnDuplCheck').val('F');
            }
        }
    });
}

/**
 * 사업자 번호 valid 체크
 * @return Boolean
 */
function checkCssnValid(sCssn)
{
    // 정규식 체크
    var regexp = /^([0-9]{3})-([0-9]{2})-([0-9]{5})$/;
    var regexp2 = /^([0-9]{10})$/;
    if (regexp.test(sCssn) === false && regexp2.test(sCssn) === false) {
        EC$('#cssnMsg').addClass('error').html(__('올바른 사업자번호를 입력해 주세요.'));
        return false;
    } else {
        EC$('#cssnMsg').removeClass('error').html(__('사용 가능합니다.'));
        return true;
    }
}
var memberCommon = (function() {

    var oAgreeCheckbox = [
        {"obj": $('input:checkbox[name="agree_service_check[]"]')},//이용약관 동의
        {"obj": $('input:checkbox[name="agree_privacy_check[]"]')}, // 개인정보 수집 및 이용 동의
        {"obj": $('input:checkbox[name="agree_privacy_optional_check[]"]'), 'sIsDisplayFlagId':"display_agree_privacy_optional_check_flag"}, // 개인정보 수집 및 이용 동의 (선택)
        {"obj": $('input:checkbox[name="agree_information_check[]"]'), "sIsDisplayFlagId":"display_agree_information_check_flag"}, // 개인정보 제3자 제공 동의(선택)
        {"obj": $('input:checkbox[name="agree_consignment_check[]"]'), "sIsDisplayFlagId":"display_agree_consignment_check_flag"}, // 개인정보 처리 위탁 동의
        {"obj": $('input:checkbox[name="is_sms"]'), "sIsDisplayFlagId":"required_is_sms_flag"}, // sms 수신 동의
        {"obj": $('input:checkbox[name="is_news_mail"]'), "sIsDisplayFlagId":"required_is_news_mail_flag"}, // 이메일 수신 동의
        {"obj": $('#sMarketingAgreeAllChecked')} // mobile 이메일 수신, sms 수신 동의 전체 체크
    ];

    var oMarketingAgreeCheckbox = [
        {"obj": $('input:checkbox[name="is_sms"]'), "sIsDisplayFlagId":"required_is_sms_flag"}, // sms 수신 동의
        {"obj": $('input:checkbox[name="is_news_mail"]'), "sIsDisplayFlagId":"required_is_news_mail_flag"}, // 이메일 수신 동의
    ];

    var oMarketingAgreeAllChecked = $('input:checkbox[id="sMarketingAgreeAllChecked"]');

    /**
     * 약관 일괄 동의 체크
     */
    function agreeAllChecked()
    {
        var bAgreeAllChecked = $('input:checkbox[id="sAgreeAllChecked"]').is(":checked");

        if (bAgreeAllChecked.length < 1) {
            return;
        }

        $.each(oAgreeCheckbox, function(i, oVal) {
            if (oVal.obj.length < 1) {
                // continue
                return true;
            }

            if (bAgreeAllChecked === true) {
                if ($('#'+oVal.sIsDisplayFlagId).length > 0) {
                    if ($('#'+oVal.sIsDisplayFlagId).val() != "T") {
                        return true;
                    }
                }
                oVal.obj.attr("checked", true);
            } else {
                oVal.obj.attr("checked", false);
            }
        });
    }

    /**
     * 약관 일괄 동의 체크 or 해제 처리
     */
    function agreeAllUnChecked(obj)
    {
        if (obj.length < 1) {
            return;
        }
        var sIsUnchecked = "F";
        if (obj.is(":checked") === false) {
            if ($('input:checkbox[id="sAgreeAllChecked"]').length > 0) {
                $('input:checkbox[id="sAgreeAllChecked"]').attr("checked", false);
            }
            sIsUnchecked = "T";

            // 모바일 쇼핑정보 수신 동의 선택 박스 언체크
            if (obj.attr("name") == "is_sms" || obj.attr("name") == "is_news_mail") {
                if (memberCommon.oMarketingAgreeAllChecked.length > 0) {
                    memberCommon.oMarketingAgreeAllChecked.attr("checked", false);
                }
            }
        }
        return sIsUnchecked;
    }

    /**
     * 모바일 마케팅 약관 일괄 동의 체크
     */
    function marketingAgreeAllCheckboxIsChecked()
    {
        var sIsAllChecked = "T";

        $.each(memberCommon.oMarketingAgreeCheckbox, function(i, oVal) {
            if (oVal.length < 1) {
                // continue
                return true;
            }

            if (oVal.obj.is(":checked") === false) {
                sIsAllChecked = "F";
                return false;
            }
        });

        if (sIsAllChecked == "T") {
            if (memberCommon.oMarketingAgreeAllChecked.length > 0) {
                memberCommon.oMarketingAgreeAllChecked.attr("checked", true);
            }
        }
    }

    /**
     * 모바일 sms, email 수신 동의 전체 선택
     */
    function marketingAllChecked()
    {
        if (memberCommon.oMarketingAgreeAllChecked.length < 1) {
            return;
        }
        var bAgreeAllChecked = memberCommon.oMarketingAgreeAllChecked.is(":checked");

        $.each(memberCommon.oMarketingAgreeCheckbox, function(i, oVal) {
            if (oVal.obj.length < 1) {
                // continue
                return true;
            }

            if (bAgreeAllChecked === true) {
                if ($('#'+oVal.sIsDisplayFlagId).length > 0) {
                    if ($('#'+oVal.sIsDisplayFlagId).val() != "T") {
                        return true;
                    }
                }
                oVal.obj.attr("checked", true);
            } else {
                oVal.obj.attr("checked", false);
            }
        });
    }

    /**
     * 모바일 sms, email 수신 동의 필수 입력 제거
     */
    function marketingRemoveFilter()
    {
        // sms 수신 동의
        if ($('input:checkbox[name="is_sms"]').length > 0) {
            if ($('input:checkbox[name="is_sms"]').attr("fw-filter").indexOf("isFill") > -1) {
                $('input:checkbox[name="is_sms"]').removeAttr("fw-filter");
            }
        }

        // 이메일 수신 동의
        if ($('input:checkbox[name="is_news_mail"]').length > 0) {
            if ($('input:checkbox[name="is_news_mail"]').attr("fw-filter").indexOf("isFill") > -1) {
                $('input:checkbox[name="is_news_mail"]').removeAttr("fw-filter");
            }
        }
    }

    /**
     * 전체 동의 외 체크박스 모두 체크시 전체 동의 체크
     */
    function eachCheckboxAgreeAllChecked()
    {
        var sIsAllChecked = "T";

        $.each($('.agreeArea'), function(i, oVal) {
            if (($(oVal).hasClass('displaynone')) === true) {
                return true;
            }

            $.each($(oVal).find("input:checkbox"), function(j, oVal2) {
                // 심플디자인 전체 동의 버튼 제외 처리
                if ($(oVal2).attr('id') == "sAgreeAllChecked") {
                    return true;
                }
                
                if ($(oVal2).is(":checked") === false) {
                    sIsAllChecked = "F";
                    return false;
                }
            });
        });

        if (sIsAllChecked == "T") {
            $('input:checkbox[id="sAgreeAllChecked"]').attr("checked", true);
        }
    }

    /**
     * 모바일 유효성 패턴 체크
     */
    function isValidMobile()
    {
        // 모바일 등록 여부
        if ($('#mobile2').length < 1 && $('#mobile3').length < 1) {
            return true;
        }

        // 모바일 등록 여부
        if ( SHOP.getLanguage() == 'ko_KR' ) {
            if ($('#mobile1').length < 1 && $('#mobile2').length < 1 && $('#mobile3').length < 1) {
                return true;
            }
        } else {
            if ($('#mobile1').length < 1 && $('#mobile2').length < 1) {
                return true;
            }
        }

        // 휴대폰 패턴체크
        var aMobile = {};

        if ($('#mobile1').length > 0) {
            aMobile.mobile1 = $('#mobile1').val();
        }

        if ($('#mobile2').length > 0) {
            aMobile.mobile2 = $('#mobile2').val();
        }

        if ($('#mobile3').length > 0) {
            aMobile.mobile3 = $('#mobile3').val();
        }

        if (utilValidatorController.checkMobile(aMobile) === true) {
            return true;
        }

        alert(__('올바른 휴대전화번호를 입력 하세요.'));

        var iElementNumber = utilValidatorController.getElementNumber();

        // focus 처리
        if (iElementNumber == 1) {
            $('#mobile1').focus();
        } else if (iElementNumber == 2) {
            $('#mobile2').focus();
        } else if (iElementNumber == 3) {
            $('#mobile3').focus();
        }
        return false;
    }

    /**
     * 모바일번호 회원가입 유효성 체크
     * @return boolean
     */
    function checkJoinMobile()
    {
        // 회원 가입 휴대전화 필수입력 체크를 기존에 추가로 해 주고 있는 부분 추가
        if ($('#is_display_register_mobile').val() == 'T') {
            if ( $.trim($('#mobile1').val()) == '' || $.trim($('#mobile2').val()) == '' || ($('#mobile3').length > 0 && $.trim($('#mobile3').val()) == '')) {
                alert(__('휴대전화를  입력해주세요.'));
                $('#mobile1').focus();
                return false;
            }
        }

        if (memberCommon.isJoinMobileValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidMobile() === true) {
            return true;
        }
        return false;
    }

    /**
     * 모바일번호 유효성 체크
     * @return boolean
     */
    function checkEditMobile()
    {
        // 회원 정보 수정 휴대전화 필수입력 체크를 기존에 추가로 해 주고 있는 부분 추가
        if ($('#is_display_register_mobile').val() == 'T') {
            if ($.trim($('#mobile1').val()) == '' || $.trim($('#mobile2').val()) == '') {
                alert(__('올바른 휴대전화번호를 입력하세요.'));
                $('#mobile2').focus();
                return false;
            }
        }

        if (memberCommon.isEditMobileValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidMobile() === true) {
            return true;
        }
        return false;
    }

    /**
     * 회원가입 유효성 체크 통과 케이스
     * @returns {boolean}
     */
    function isJoinMobileValidPassConditionCheck()
    {
        // 회원 가입 항목 상세 설정 && 일반전화 항목 등록 설정 후 다시 기본 항목 설정으로 변경시  일반전화 항목 미입력으로 설정으로 복구 되지 않는다.
        // 기존 설정 유지되는 부분이 있어 예외처리
        if ($("#useSimpleSignin").length > 0) {
            // 기본 회원가입항목
            if ($("#useSimpleSignin").val() == 'T') {
                // 휴대전화 항목 등록 항목 노출 && 휴대전화 필수입력
                if ($('#display_register_mobile').val() != "T" || $('#display_required_cell').val() != "T") {
                    return true;
                }
            }
        }

        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 모바일 필수입력만 체크
            if ($('#display_required_cell').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 모바일사용여부 && 필수입력 체크
            if ($('#is_display_register_mobile').val() != "T" || $('#display_required_cell').val() != "T") {
                return true;
            }
        }
        return false;
    }

    /**
     * 회원정보 수정 유효성 체크 통과 케이스
     * 회원가입과 동일하게 유지
     * @returns {boolean}
     */
    function isEditMobileValidPassConditionCheck()
    {
        if (memberCommon.isJoinMobileValidPassConditionCheck() === true) {
            return true;
        }
        return false;
    }

    /**
     * 일반전화 유효성 체크
     * @return boolean
     */
    function isValidPhone()
    {
        // 일반전화 등록 여부
        if ( SHOP.getLanguage() == 'ko_KR' ) {
            if ($('#phone1').length < 1 && $('#phone2').length < 1 && $('#phone3').length < 1) {
                return true;
            }
        } else {
            if ($('#phone1').length < 1 && $('#phone2').length < 1) {
                return true;
            }
        }

        // 일반전화 패턴체크
        var aPhone = {};

        if ($('#phone1').length > 0) {
            aPhone.phone1 = $('#phone1').val();
        }

        if ($('#phone2').length > 0) {
            aPhone.phone2 = $('#phone2').val();
        }

        if ($('#phone3').length > 0) {
            aPhone.phone3 = $('#phone3').val();
        }

        if (utilValidatorController.checkPhone(aPhone) === true) {
            return true;
        }

        alert(__('올바른 전화번호를 입력하세요.'));

        var iElementNumber = utilValidatorController.getElementNumber();

        // focus 처리
        if (iElementNumber == 1) {
            $('#phone1').focus();
        } else if (iElementNumber == 2) {
            $('#phone2').focus();
        } else if (iElementNumber == 3) {
            $('#phone3').focus();
        }
        return false;
    }

    /**
     * 일반전화 회원가입 유효성 체크 통과 케이스
     */
    function isJoinPhoneValidPassConditionCheck()
    {
        // 회원 가입 항목 상세 설정 && 일반전화 항목 등록 설정 후 다시 기본 항목 설정으로 변경시  일반전화 항목 미입력으로 설정으로 복구 되지 않는다.
        // 기존 설정 유지되는 부분이 있어 예외처리
        if ($("#useSimpleSignin").length > 0) {
            if ($("#useSimpleSignin").val() == 'T') {
                return true;
            }
        }

        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 일반전화 필수입력만 체크
            if ($('#display_required_phone').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 일반전화 사용여부 && 필수입력 체크
            if ($('#is_display_register_phone').val() != "T" || $('#display_required_phone').val() != "T") {
                return true;
            }
        }
    }

    /**
     * 일반전화 회원정보 수정 유효성 체크 통과 케이스
     */
    function isEditPhoneValidPassConditionCheck()
    {
        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 일반전화 필수입력만 체크
            if ($('#display_required_phone').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 일반전화 사용여부 && 필수입력 체크
            if ($('#is_display_register_phone').val() != "T" || $('#display_required_phone').val() != "T") {
                return true;
            }
        }
    }

    /**
     * 일반전화 회원가입 유효성 체크
     * @return boolean
     */
    function checkJoinPhone()
    {
        if (memberCommon.isJoinPhoneValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidPhone() === true) {
            return true;
        }
        return false;
    }

    /**
     * 일반전화 회원정보 수정 유효성 체크
     * @return boolean
     */
    function checkEditPhone()
    {
        if (memberCommon.isEditPhoneValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidPhone() === true) {
            return true;
        }
        return false;
    }

    /**
     * 영문몰 국가 미국, 캐나다 선택 시 주/도 select box 설정
     */
    function setUsStateNameVisible() {
        if ( SHOP.getLanguage() != 'en_US' ) {
            return;
        }

        try {
            var sCountry = $('#country').val();
            var sStateName = $('#__state_name').val();
            var sStateNameElement = $('#state_name');
            var sStateListCaElement = $('#stateListCa');
            var sStateListUsElement = $('#stateListUs');

            if (sCountry == 'USA') {
                sStateNameElement.attr('disabled', true);
                sStateNameElement.hide();
                sStateListCaElement.attr('disabled', true);
                sStateListCaElement.hide();
                sStateListUsElement.attr('disabled', false);
                sStateListUsElement.show();
                sStateListUsElement.val(sStateName).attr('selected', 'selected');
            } else if (sCountry == 'CAN') {
                sStateNameElement.attr('disabled', true);
                sStateNameElement.hide();
                sStateListUsElement.attr('disabled', true);
                sStateListUsElement.hide();
                sStateListCaElement.attr('disabled', false);
                sStateListCaElement.show();
                sStateListCaElement.val(sStateName).attr('selected', 'selected');
            } else {
                sStateListUsElement.attr('disabled', true);
                sStateListUsElement.hide();
                sStateListCaElement.attr('disabled', true);
                sStateListCaElement.hide();
                sStateNameElement.attr('disabled', false);
                sStateNameElement.show();
            }
        } catch(e) {}
    }

    /**
     * 미국 주/도 선택 값 설정
     */
    function setCountryUsStateNameValue() {
        if ( SHOP.getLanguage() != 'en_US' ) {
            return;
        }

        try {
            var sStateName = $('#stateListUs').val();
            $('#__state_name').val(sStateName);
        } catch(e) {}
    }

    /**
     * 캐나다 주/도 선택 값 설정
     */
    function setCountryCaStateNameValue() {
        if ( SHOP.getLanguage() != 'en_US' ) {
            return;
        }

        try {
            var sStateName = $('#stateListCa').val();
            $('#__state_name').val(sStateName);
        } catch(e) {}
    }

    /**
     * 영문몰 state_name 유효성 체크
     * @returns {boolean}
     */
    function checkUsStatename()
    {
        if (SHOP.getLanguage() != 'en_US') {
            return true;
        }

        if ($('#display_required_address').val() != 'T') {
            return true;
        }

        try {
            var sCountry = $('#country').val();
            var bIsEmptyStatenameValue = true;
            var sStateNameId = 'state_name';

            if (sCountry == 'USA') {
                sStateNameId = 'stateListUs';
            } else if (sCountry == 'CAN') {
                sStateNameId = 'stateListCa';
            }

            if ($('#' + sStateNameId).val() == '') {
                $('#' + sStateNameId).focus();
                bIsEmptyStatenameValue = false;

                if (sStateNameId == "state_name") {
                    alert(sprintf(__('IS.REQUIRED.FIELD', 'MEMBER.RESOURCE.JS.COMMON'), $('#' + sStateNameId).attr('fw-label')));
                } else {
                    alert(__('SELECT.STATE.PROVINCE', 'MEMBER.RESOURCE.JS.COMMON'));
                }
            }

            return bIsEmptyStatenameValue;
        } catch(e) {}

        return true;
    }

    /**
     * 국가 변경시 휴대전화, 일반전화 국가 코드 변경
     */
    function setSelectedPhoneCountryCode()
    {
        if (typeof(oCountryVars) != "object") {
            return;
        }

        if ($('#country').length < 1) {
            return;
        }

        var sCode = $('#country').val();
        var sDialingCode = parseInt(oCountryVars[sCode].d_code, 10);
        var sCountryName = oCountryVars[sCode].country_name_en;
        var aMultiplCode = [1, 7, 262];
        var oFilter = eval("/" + sCountryName + "/ig");

        // 나라별 국번이 동일하면
        if ($.inArray(sDialingCode, aMultiplCode) >= 0) {
            if ($("#mobile1").length > 0) {
                $("#mobile1>option").each(function() {
                    if (oFilter.test($(this).text()) == true) {
                        $(this).attr("selected", true);
                    }
                });
            }
            if ($("#phone1").length > 0) {
                $("#phone1>option").each(function() {
                    if (oFilter.test($(this).text()) == true) {
                        $(this).attr("selected", true);
                    }
                });
            }
        } else {
            if ($("#mobile1").length > 0) { $("#mobile1").val(sDialingCode); }
            if ($("#phone1").length > 0) { $("#phone1").val(sDialingCode); }
        }

    }

    /**
     * 국가 변경시 실행 필요한 설정
     */
    function setChangeCountry()
    {
        setFindZipcode();

        try {
            // 일문 주소 readonly 설정
            zipcodeCommonController.setJapanCountryAddr1($(this).val(), $('#addr1'), $('#postcode1'));
        } catch (e) {
        }

        try {
            if (isCountryOfLanguage == 'T') {
                setAddressOfLanguage.changeCountry();
            }
        } catch (e) {}
        this.setUsStateNameVisible();
        this.setSelectedPhoneCountryCode();
    }

    /**
     * 메일 입력 폼 기존 하드코딩 되어 있을 경우 동작
     */
    function bindEmail()
    {
        if ($('#email3').length < 1) {
            return;
        }

        if ($('#email2').length < 1) {
            return;
        }

        $('#email3').bind('change', function() {

            var host = this.value;

            if (host != 'etc' && host != '') {
                $('#email2').attr('readonly', true);
                $('#email2').val(host).change();
            } else if (host == 'etc') {
                $('#email2').attr('readonly', false);
                $('#email2').val('').change();
                $('#email2').focus();
            } else {
                $('#email2').attr('readonly', true);
                $('#email2').val('').change();
            }

        });
    }

    /**
     * <a href="url" oncolick="memberCommon.agreementPopup(this)"/>
     * url 정보를 읽어 팝업을 띄운다
     */
    function agreementPopup(oALinkObject)
    {
        var sPopupUrl = oALinkObject.href;
        if (EC_MOBILE_DEVICE == true) {
            window.open(sPopupUrl);
        } else {
            window.open(sPopupUrl, '', 'width=450,height=350');
        }
    }

    /**
     * 선택항목 약관 체크
     */
    function optionalCheck()
    {
        // 개인정보 수집 및 이용 동의(선택)
        if ($('#display_agree_privacy_optional_check_flag').val() != "T") {
            return true;
        }


        if ($('input[name="agree_privacy_optional_check[]"]').is(":checkbox") === true) {
            if ($("input[name='agree_privacy_optional_check[]']").is(":checked") === true) {
                return true;
            }
        } else if ($('input[name="agree_privacy_optional_check[]"]').length > 0) {
            if ($("input[name='agree_privacy_optional_check[]']").val() == "T") {
                return true;
            }
        }

        var isConfirm = true;
        $.each(registerOptionalList, function(sKey1, sValue1) {
            // 존재하는지 확인
            if ($("#"+sValue1.sDomId).length < 1) {
                return true;
            }

            // 회원 정보 입력 항목 필수 상태 값으로 처리
            if (sValue1.hasOwnProperty('is_required') === true) {
                // 필수 항목 제외
                if (sValue1.is_required == "T") {
                    return true;
                }
            }

            // 필수처리 dom 존재 확인
            if ($("#"+sValue1.is_required_dom).length > 0) {
                // 필수 항목 제외
                if ($("#"+sValue1.is_required_dom).val() == "T") {
                    return true;
                }
            }

            // data 등록 했는지 확인
            if (sValue1.sDomId.isArray === true) {
                $.each(sValue1.sDomId, function (sKey2, sValue2) {
                    if (memberCommon.issetOptionalElementValue(sValue2, sValue1.default_value) === false) {
                        isConfirm = false;
                        return false;
                    }
                });
            } else {
                if (memberCommon.issetOptionalElementValue(sValue1.sDomId, sValue1.default_value) === false) {
                    isConfirm = false;
                    return false;
                }
            }
        });

        if (isConfirm === false) {
            if (confirm(__('DO.NOT.AGREE.TERMS', 'MEMBER.RESOURCE.JS.COMMON')) === true) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * 객체 type 확인 후 값 확인
     * @param sSelector dom
     * @param sDefaultValue 기본 값
     * @returns {boolean} 결과
     */
    function issetOptionalElementValue(sSelector, sDefaultValue)
    {
        if (sSelector.length < 1) {
            return true;
        }

        if ($("#"+sSelector).is(":radio") === true || $("#"+sSelector).is(":checkbox") === true) {
            if ($("#"+sSelector).is(":checked") === true) {
                if ($("#"+sSelector).val() == sDefaultValue) {
                    return true;
                }
                return false;
            }
        }

        if ($("#"+sSelector).val() != "") {
            if ($("#"+sSelector).val() == sDefaultValue) {
                return true;
            }
            return false;
        }

    }
    return {
        oAgreeCheckbox: oAgreeCheckbox,
        oMarketingAgreeCheckbox: oMarketingAgreeCheckbox,
        oMarketingAgreeAllChecked: oMarketingAgreeAllChecked,
        agreeAllChecked: agreeAllChecked,
        marketingAgreeAllCheckboxIsChecked: marketingAgreeAllCheckboxIsChecked,
        marketingAllChecked: marketingAllChecked,
        agreeAllUnChecked: agreeAllUnChecked,
        marketingRemoveFilter: marketingRemoveFilter,
        eachCheckboxAgreeAllChecked: eachCheckboxAgreeAllChecked,
        checkJoinMobile: checkJoinMobile,
        checkEditMobile: checkEditMobile,
        isJoinMobileValidPassConditionCheck: isJoinMobileValidPassConditionCheck,
        isEditMobileValidPassConditionCheck: isEditMobileValidPassConditionCheck,
        isJoinPhoneValidPassConditionCheck: isJoinPhoneValidPassConditionCheck,
        isEditPhoneValidPassConditionCheck: isEditPhoneValidPassConditionCheck,
        checkJoinPhone: checkJoinPhone,
        checkEditPhone: checkEditPhone,
        isValidPhone: isValidPhone,
        isValidMobile: isValidMobile,
        setUsStateNameVisible: setUsStateNameVisible,
        setCountryUsStateNameValue: setCountryUsStateNameValue,
        setCountryCaStateNameValue: setCountryCaStateNameValue,
        checkUsStatename: checkUsStatename,
        setChangeCountry: setChangeCountry,
        setSelectedPhoneCountryCode: setSelectedPhoneCountryCode,
        bindEmail: bindEmail,
        agreementPopup: agreementPopup,
        optionalCheck: optionalCheck,
        issetOptionalElementValue: issetOptionalElementValue
    }
})();
/**
 * 회원 정보 수정 Auth SSL
 * 동적으로 생성하여 처리 하려 했으나 호출이 되지 않아 static 선언
 *
 * @package app/Member
 * @subpackage Resource
 * @author 이장규
 * @since 2011. 12. 29.
 * @version 1.0
 *
 */
var MemberEditAuthtSSL = new function()
{

    /**
     * auth SSL 로 받은 값을 decode 해서 해당 영역에 update
     */
    this.setMember = function(sEncodeMember)
    {
        var output = decodeURIComponent(sEncodeMember);

        if ( AuthSSLManager.isError(output) == true ) {
            
            if (output == 'ERROR: not found parameters token') {
                window.location.reload();
                return;
                
            } else {
                alert(output);
                return;
            }
        }

        var aMember = AuthSSLManager.unserialize(output);
        updateDefault(aMember);
        updateException(aMember);
        memberCommon.setUsStateNameVisible();
        memberVerifyMobile.setEditMobileNumberBefore(aMember);
    };

    /**
     * 개인정보 update
     */
    var updateDefault = function(aMember)
    {
        var aException = ['name_contents', 'ssn_contents'];

        $.each(aMember, function(key, value){
            if ($.inArray(key, aException) < 0) {
                $('#' + key).val(value);
            }
        });
    };

    /**
     * 예외 처리 항목
     */
    var updateException = function(aMember)
    {
        $('#name_contents').text(aMember.name_contents);//이름
        $('#ssn_contents').text(aMember.ssn_contents);//주민번호

        //email 직접 선택
        if ($('#email3').val() == null && aMember.email3 != null) {
            if ( aMember.email3.length > 0 ) {
                $('#email3').val('etc');
                $('#email2').attr('readonly', false);
            }
        }

        // 이부분이 없으면 화면에 null이 보임
        if (aMember.email1 == null)     aMember.email1 = '';
        if (aMember.email2 == null)     aMember.email2 = '';
        if (aMember.email3 == null)     aMember.email3 = '';

        if ($('#email1').length > 0 && ($('#email2').length == 0 || $('#email3').length == 0)) {
            var sEmail = aMember['email1'] + '@' + aMember['email2'];
            $('#email1').val(sEmail);
        }
    };

    
    /**
     * 휴대폰, 아이폰 인증 후 이름, 휴대폰 번호등 display
     */
    this.setDisplayMember = function(sEncodeMember)
    {
        var output = decodeURIComponent(sEncodeMember);

        if ( AuthSSLManager.isError(output) == true ) {
            alert(output);
            return;
        }

        var aMember = AuthSSLManager.unserialize(output);
        
        if ($('#nameContents') != undefined) {
            $('#nameContents').html(aMember.name);
        }
        
        try{
            $('#birth_year').val(aMember.birth_year);
            $('#birth_month').val(aMember.birth_month);
            $('#birth_day').val(aMember.birth_day);

            if ($('#editForm') != null) {
                $('#mobile1').val(aMember.mobile1);
                $('#mobile2').val(aMember.mobile2);
                $('#mobile3').val(aMember.mobile3);
            }
        }catch(e){}
        
        if (aMember.sIsUnder14Joinable == 'F' || aMember.sIsUnder14Joinable == 'M') {
            checkIsUnder14({ birth : aMember.birth });
        }
    };
 

};


function validatePassword()
{
    if ($('#passwd').val() == '' || $('#user_passwd_confirm').val() == '') {
        alert(__('비밀번호 항목은 필수 입력값입니다.'));
        return false;
    }

    var sPasswdType = ($('#passwd_type').val() == '' || $('#passwd_type').length < 1 ) ? 'A' : $('#passwd_type').val();

    // 비밀번호 조합 체크
    var passwd_chk = ckPwdPattern($('#passwd').val(), sPasswdType);

    if (passwd_chk !== true) {

        // 뉴상품 구분
        if (typeof(SHOP) == 'object' && SHOP.getProductVer() > 1) {

        } else {
            // 구상품용 알럿 처리
            return oldPasswdChk('passwd', sPasswdType);
        }


        var sMsgWord = __("입력 가능 특수문자 :  ~ ` ! @ # $ % ^ ( ) _ - = { } [ ] | ; : < > , . ? /");
        var aMsgWord = sMsgWord.split(':');
        var aMsgWordSub = {};

        if (sPasswdType == 'A') {
            var sMsg = ''
                + __('비밀번호 입력 조건을 다시 한번 확인해주세요.') + "\n"
                + "\n"
                + '※ ' + __('비밀번호 입력 조건') + "\n"
                + '- ' + __('대소문자/숫자 4자~16자') + "\n"
                + '- ' + __('특수문자 및 공백 입력 불가능') + "\n";
        } else {
            if (sPasswdType == 'B') {
                aMsgWordSub = __('대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자');
            } else if (sPasswdType == 'C') {
                aMsgWordSub = __('대소문자/숫자/특수문자 중 2가지 이상 조합, 10자~16자');
            } else if (sPasswdType == 'D') {
                aMsgWordSub = __('대소문자/숫자/특수문자 중 3가지 이상 조합, 8자~16자');
            }
            var sMsg = ''
                + __('비밀번호 입력 조건을 다시 한번 확인해주세요.') + "\n"
                + "\n"
                + '※ ' + __('비밀번호 입력 조건') + "\n"
                + '- ' + aMsgWordSub + "\n"
                + '- ' + aMsgWord[0] + "\n" + "  " + aMsgWord[1] + ":" + aMsgWord[2] + "\n"
                + '- ' + __('공백 입력 불가능') + "\n";
        }

        if (sMsg) alert(sMsg);

        $('#passwd').focus();
        return false;
    }
}

/**
 * 비밀번호 확인 체크
 */
function checkPwConfirm(sType) {

    if (sType == 'new_passwd_confirm') {
        var sPasswdInput = '#new_passwd';
        var sPasswdConfirmInput = '#new_passwd_confirm';
        var sElementIdMsg = '#new_pwConfirmMsg';
    } else if (sType == 'etc_subparam_user_passwd_confirm') {
        var sPasswdInput = '#etc_subparam_passwd';
        var sPasswdConfirmInput = '#etc_subparam_user_passwd_confirm';
        var sElementIdMsg = '#pwConfirmMsg';
    } else {
        var sPasswdInput = '#passwd';
        var sPasswdConfirmInput = '#user_passwd_confirm';
        var sElementIdMsg = '#pwConfirmMsg';
    }

    var sPasswd = $.trim($(sPasswdInput).val());
    var sPasswdConfirm = $.trim($(sPasswdConfirmInput).val());
    
    if (sPasswd != sPasswdConfirm) {
        $(sElementIdMsg).addClass('error').html(__('비밀번호가 일치하지 않습니다.'));        
    } else {
        $(sElementIdMsg).removeClass('error').html(' ');
    }
}

function oldPasswdChk(sPasswdId, sPasswdType)
{
    var oCheckErrorMessage = {
        A : __('4~16자로 입력해 주세요.'),
        B : __('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 8~16자로 입력해 주세요.'),
        C : __('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 10~16자로 입력해 주세요.'),
        D : __('비밀번호는 영문 대소문자/숫자/특수문자 중 3가지 이상 조합,8자 ~ 16자로 설정하셔야 합니다.')
    };

    var sDefaultErrorMessage = __("공백 또는 허용된 특수문자 (~ ` ! @ # $ % ^ ( ) _ - = { [ } ] ; : < > , . ? /) 외의 특수문자는 사용할 수 없습니다.");
    var sDefaultErrorMessage2 = __("공백 또는 허용 불가한 특수문자는 사용할 수 없습니다.");

    if (sPasswdType == 'A') {
        sDefaultErrorMessage = sDefaultErrorMessage2;
    }

    // 비밀번호 조합 체크
    var passwd_chk = ckPwdPattern($('#' + sPasswdId).val(), sPasswdType);
    if (passwd_chk !== true) {
        $('#' + sPasswdId).focus();

        var sMessage = passwd_chk == 'F' ? sDefaultErrorMessage : oCheckErrorMessage[sPasswdType];

        alert(sMessage);

        return false;
    }
    return true;
}

/**
 * 비밀번호 체크
 */
function ckPwdPattern(sPwd, sPwdType)
{
    if (sPwdType == 'A') {
        var pattern = /^[a-zA-Z0-9]{4,16}$/; //조합없이 4~16
        var chk = (pattern.test(sPwd)) ? true : 'F';
        // 4보다 작거나 16보다 큰경우
        if (sPwd.length < 4 || 16 < sPwd.length) {
            chk = false;
        }
        return chk;
    } else {
        var chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //영대소문자
        var chars2 = '0123456789'; //숫자
        var chars3 = '\~\`\!\@\#\$\%\^\(\)\_\-\=\{\}\[\]\|\;\:\<\>\,\.\?\/';

        var s = containsChar(sPwd, chars1, chars2, chars3);
        var s1 = s.split("/");
        var check_length = 0;

        if (s1[0] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[0]);
            s1[0] = 1;
        }
        if (s1[1] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[1]);
            s1[1] = 1;
        }
        if (s1[2] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[2]);
            s1[2] = 1;
        }

        //영대문자, 숫자, 특수문자 중 2가지 이상 조합이면
        if ((parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2])) >= 2) {
            if (sPwdType == 'B') {
                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {//허용되지 않은 문자가 포함된 경우
                        return 'F';//허용되지 않은 문자가 포함됨
                    } else {
                        return true;
                    }
                } else {
                    return false;//8자~16자가 안됨
                }
            } else if (sPwdType == 'C') {
                if (sPwd.length >= 10 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//10자~16자가 안됨
                }
            } else if (sPwdType == 'D') {
                if (parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2]) != 3)
                    return false;

                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//8자~16자가 안됨
                }
            } else {
                return false;
            }
        } else {
            return false; //영문대소문자, 숫자, 특수문자 2가지 조합이 안됨
        }
    }
}

function containsChar(input, chars1, chars2, chars3)
{
    var cnt1 = 0;
    var cnt2 = 0;
    var cnt3 = 0;

    for (var i=0;i<input.length;i++)
    {
        //영대소문자 포함여부
        if (chars1.indexOf(input.charAt(i))!= -1) {
            cnt1++;
        }
        //숫자 포함여부
        if (chars2.indexOf(input.charAt(i))!= -1) {
            cnt2++;
        }
        //특수문자 포함여부
        if (chars3.indexOf(input.charAt(i))!= -1) {
            cnt3++;
        }
    }
    return (cnt1+"/"+cnt2+"/"+cnt3);
}
/**
 * 이메일 중복 체크
 */
function checkDuplEmail()
{
    var aEleId = [];

    if ( $('#member_id').val() != '' && $('#member_id').val() != undefined ) {
        aEleId.push('member_id');
    }

    if ($('#email2').length > 0) {
        var sEmail = $.trim($('#email1').val())+'@'+$.trim($('#email2').val());
        aEleId.push('email1', 'email2');
    } else {
        if ( $('#etc_subparam_email1').val() != undefined ) {
            var sEmail = $.trim($('#etc_subparam_email1').val());
            aEleId.push('etc_subparam_email1');
        } else {
            var sEmail = $.trim($('#email1').val());
            aEleId.push('email1');
        }
    }

    var bCheck = checkEmailValidation(sEmail);
    if (bCheck['passed'] == false) {
        $('#emailMsg').addClass('error').html(bCheck['msg']);
        return false;
    }

    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': aEleId,
        'auth_callbackName': 'checkEmailEncryptedResult'
    });

}

/**
 *  * 아이디중복체크 암호화 처리 (모바일)
 *   * @param output
 *    */
function checkEmailEncryptedResult(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    $.ajax({
        url: '/exec/front/Member/CheckEmail',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str=' + sEncrypted,
        timeout: 3000,   
        success: function(response){
            var msg = response['msg'];
            try {
                msg = decodeURIComponent(msg);
            } catch (err) {}
            
            if (response['passed'] == true) {
                $('#emailMsg').removeClass('error').html(msg);
                $('#emailDuplCheck').val('T');

                if (SHOP.getLanguage() == 'ja_JP' && response['jp_email_check'] != '') {
                    checkSoftbankEmail(response['jp_email_check']);
                }

                // 중복 체크 성공 
                bCheckedEmailDupl = true;
            } else {
                $('#emailMsg').addClass('error').html(msg);
                $('#emailDuplCheck').val('F');
                bCheckedEmailDupl = false;
            }
            
            // 추천아이디 중복체크 완료 (회원가입, 수정페이지 둘다쓰임)
            var $oMemberId = '';
            if ( $('#etc_subparam_member_id').val() != undefined ) {
                $oMemberId = $('#etc_subparam_member_id');
            } else {
                $oMemberId = $('#joinForm').find('#member_id');
            }
            if ( response['id'] != null && $oMemberId.val() == '' && $('#login_id_type').val() == 'email') {
                $oMemberId.val(response['id']);
                $('#idDuplCheck').val('T');
                $('#idMsg').removeClass('error').html( __('추천아이디이므로 그대로 사용할 수 있으며, 수정도 가능합니다.') );
            }
        }
    });
}

/**
 * 글자수 체크
 * @param 회원아이디 닉네임
 * @returns {Boolean}
 */
function checkEmailValidation(sEmail)
{       
    if (sEmail.length == 0 )
        return {'passed' : false, 'msg' : __('이메일을 입력해 주세요.')};
    
    if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255)
        return {'passed' : false, 'msg' : __('유효한 이메일을 입력해 주세요.')};

    return {'passed' : true};
}

/**
 * 소프트뱅크 메일여부 체크
 * @param sEmail 이메일주소
 */
function checkSoftbankEmail(jp_email_check)
{
    if (SHOP.getLanguage() != 'ja_JP') return;
    
    // 모바일 구디자인의 경우 emailMsg가 없어서 처리 해줌 ( memberJoin에 같은 소스가 있는데 모바일일 경우 중복 노출 되어 위치 이동 시킴 )
    if ( $("#emailMsg").length > 0) {
        
        if (jp_email_check == 'jp_email_wanning') {
            $('#emailMsg').html('ご入力のアドレスはMMSサービスとなり、大容量のデータ受信ができかねます。');
        }
    } else {
        
        var bExistEmailBtn = false;
        if ($('#check_email_button').length > 0) bExistEmailBtn = true;
        (bExistEmailBtn == true) ? $('#check_email_button').next('p').remove() : $('#email1').next('p').remove();
        
        if (jp_email_check == 'jp_email_wanning') {
            $sInfoText = '<p style="color:#747474;">ご入力のアドレスはMMSサービスとなり、大容量のデータ受信ができかねます。</p>';
            if (bExistEmailBtn) {
                $('#check_email_button').after($sInfoText);
            } else {
                $('#email1').after($sInfoText);
            }
        }
    }
}


// 제3자 정보제공 동의현황, 취급위탁 동의현황
function checkAgreement(agreement_type, app_id, is_agreed, avn_perinfo_item_md5)
{
    if (agreement_type == 'information') {
        sType = '제3자 정보제공';
    } else {
        sType = '처리위탁';
    }

    if (is_agreed == 'T') {
        sMsg = sType+'에 동의하시겠습니까?';
    } else {
        sMsg = sType+' 동의를 철회하시겠습니까?';
    }

    if (!confirm(sMsg)) {
        return;
    }

    callAgreementAjax({
        agreement_type : agreement_type,
        app_id : app_id,
        is_agreed : is_agreed,
        avn_perinfo_item_md5 : avn_perinfo_item_md5
    }); 
}


function callAgreementAjax(aParam)
{
    $.ajax({
        type: "POST",
        url: "/exec/front/Member/EditAgreement/'",
        data: aParam,
        dataType: 'JSON',
        success: function(data) {
            aJson = $.parseJSON(data);
            status = aJson.status;
            if (status == 'success') {
                $('#'+aJson.app_id+'_status').html(aJson.date);
                $('#'+aJson.app_id+'_button').html(aJson.button);
            }
            alert(aJson.msg);
        }
    });
}
var sPasswdId = 'passwd',
    sPasswdConfirmId = 'user_passwd_confirm',
    sUseCertification = $('#is_certification').val();

//이메일 중복 체크 여부
var bCheckedEmailDupl = true;
var MemberAction = {};

if ($('#new_passwd').length > 0 && $('#new_passwd_confirm').length > 0 && sUseCertification == 'T') {
    sPasswdId = 'new_passwd';
    sPasswdConfirmId = 'new_passwd_confirm';
}

$(document).ready(function(){
    // Moment 스크립트 초기화
    EC_GLOBAL_DATETIME.init(function () {});

    if (!$('#country option[selected=selected]').val()) {
        var aCountryInfo = [];
        aCountryInfo['ja_JP'] = 'JPN';
        aCountryInfo['en_US'] = 'USA';
        aCountryInfo['es_ES'] = 'ESP';
        aCountryInfo['pt_PT'] = 'PRT';
        aCountryInfo['zh_CN'] = 'CHN';
        aCountryInfo['zh_TW'] = 'TWN';
        aCountryInfo['ko_KR'] = 'KOR';
        var sCountryCode = aCountryInfo[SHOP.getLanguage()];
        $('#country option[value='+sCountryCode+']').attr('selected', true);
    }

    //닉네임 체크
    $('#nick_name').bind('blur', function(){
        checkNick();
    });

    //기존부터 값이 없어서.. 일단 방어코드
    //필요없어지면 삭제
    var sCountry = '';

    // 기본 국가이외에서는 우편번호 검색을 감춘다.
    $('#county_code').change( function () {
        if ( sCountry != $('#county_code').val() ) {
            $('#SearchAddress').hide();
        }
    });

    setFindZipcode();

    // 우편번호창 레이어로 오픈
    $('[onclick^="findAddress"]').attr('onclick','').unbind('click');
    $('[onclick^="findAddress"]').bind('click', {
        'zipId1' : 'postcode1',
        'zipId2' : 'postcode2',
        'addrId' : 'addr1',
        'cityId' : '',
        'stateId' : '',
        'type' : 'mobile',
        'sLanguage' : SHOP.getLanguage(),
        'addrId2' : ''
    }, ZipcodeFinder.Opener.Event.onClickBtnPopup);

    // 국가선택시
    $('#country').bind('change', function(){

        //주소정보 초기화
        $('#postcode1, #postcode2, #addr1, #addr2, #city_name, #state_name, #__addr1, #__city_name, #__state_name').val("");

        memberCommon.setChangeCountry();
    });

    //주소입력시 입력값 동기화
    $('#addr1, #city_name, #state_name').bind('change', function(){
        $('#__'+$(this).attr('id')).val($(this).val());
    });

    $('#stateListUs').bind('change', function() {
        memberCommon.setCountryUsStateNameValue();
    });

    $('#stateListCa').bind('change', function() {
        memberCommon.setCountryCaStateNameValue();
    });

    try {
        memberCommon.bindEmail();
    } catch(e) {}

    // 회원정보 수정의 설정 항목 필수 아이콘 숨김 처리 - ECHOSTING-115627
    $(':hidden[name^="display_required_"]').each(function (i) {
        bDisplayFlag = ($(this).val() == 'T') ? true : false;
        sExtractId = $(this).attr('id').substr(17);

        if (sExtractId == 'bank_account_no') { // 환불계좌 쪽은 id값이 매칭이 되지 않아 예외 처리
            sDisplayTargetId = 'icon_is_display_bank';
        } else if (sExtractId == 'name_phonetic') { // 이름 발음 쪽은 id값이 매칭이 되지 않아 예외 처리
            sDisplayTargetId = 'icon_phonetic';
        } else {
            sDisplayTargetId = 'icon_' + sExtractId;
        }

        // 한국어 몰은 이름 항목은 무조건 '필수'
        if (SHOP.getLanguage() == 'ko_KR' && sDisplayTargetId == 'icon_name') {
            bDisplayFlag = true;
        }

        if (bDisplayFlag == false) {
            $('#' + sDisplayTargetId).hide();
        } else {
            $('#' + sDisplayTargetId).show();
        }
    });

    $('#nozip').bind('change', function(){
        if ( $(this).is(':checked') == true ) {
            $('#postcode1').attr("disabled", true);
            //주소정보 초기화
            $('#postcode1').val("");
            $('#addr1').focus();
            if (SHOP.getLanguage() == 'en_US') {
                return;
            }

            //우편번호 백업
            $('#postcode1').attr('backup_postcode', $('#postcode1').val());

            //주소정보 초기화
            $('#postcode2, #addr1, #city_name, #state_name, #__addr1, #__city_name, #__state_name').val("");
            if (SHOP.getLanguage() != 'vi_VN') {
                $('#addr2').val("");
            }

            $('#postcode1, #addr1').removeAttr("readonly").val('');
            $('#postBtn').attr('onclick','').unbind('click').css('cursor','unset');
            $('#SearchAddress').attr('src', $('#SearchAddress').attr('off'));
        } else {
            $('#postcode1').removeAttr("disabled");
            //주소정보 초기화
            $('#postcode1').val("");
            if (SHOP.getLanguage() == 'en_US') {
                return;
            }

            $('#postcode2, #addr1').val('');
            $('#postBtn').bind('click', {
                    'zipId1' : 'postcode1',
                    'zipId2' : 'postcode2',
                    'addrId' : 'addr1',
                    'cityId' : 'city_name',
                    'stateId' : 'state_name',
                    'type' : 'layer',
                    'sLanguage' : SHOP.getLanguage(),
                    'addrId2' : 'addr2'
                }, ZipcodeFinder.Opener.Event.onClickBtnPopup);
            $('#postBtn').css('cursor','pointer');
            $('#SearchAddress').attr('src', $('#SearchAddress').attr('on'));
            setFindZipcode();
        }
    });
    $('#direct_input_postcode1_addr0').bind('change', function(){
        var oPostBtn = $("#postBtn");
        var oPostcode1 = $("#postcode1");
        var oAddr1 = $("#addr1");
        oPostcode1.val('');
        oAddr1.val('');
        if ( $(this).is(':checked') == true ) {
            oPostBtn.hide();
            oPostcode1.attr('readonly', false);
            oAddr1.attr('readonly', false);
        } else {
            oPostBtn.show();
            oPostcode1.attr('readonly', true);
            oAddr1.attr('readonly', true);
        }
    });
    if ( SHOP.getLanguage() != 'ko_KR' && $('#idMsg').length > 0 ) {
        if ( $('#login_id_type').val() == 'email' &&  $('#use_email_confirm').val() == 'F') {
            $('#idMsg').removeClass('error').html(__('아이디 로그인만 가능합니다.'));
        }
    }

    EC$('#cssn').on('blur', function(){
        if (EC$('#cssn').val() == '') return;

        if (EC$('#use_checking_cssn_duplication').val() == 'F') {
            checkCssnValid(EC$('#cssn').val());
        }
    });

    EC$('#cssn').on('change', function() {
        if (EC$('#use_checking_cssn_duplication').val() == 'T') {
            EC$('#cssnDuplCheck').val('F');
        }
    });

    // 이메일 중복 체크
    $('#email1').bind('blur', function() {
        setDuplEmail();
    });

    if (SHOP.getLanguage() == 'ko_KR') {
        $('#email2').bind('change', function() {
            setDuplEmail();
        });
    }

    // 이메일 중복 체크
    function setDuplEmail() {
        $('#emailMsg').removeClass('error').html('');

        if ($('#email2').length > 0) {
            var sEmail = $('#email1').val()+'@'+$('#email2').val();
        } else {
            var sEmail = $('#email1').val();
        }

        if ( sEmail == '') {
            $('#emailMsg').addClass('error').html(__('이메일을 입력해 주세요.'));
            return false;
        }
        if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255) {
            $('#emailMsg').addClass('error').html(__('유효한 이메일을 입력해 주세요.'));
            return false;
        }

        // 이메일 인증수단 사용 또는 이메일 중복 체크 설정 사용 중인 경우 이메일 중복체크를한다.
        if ( $('#use_email_confirm').val() == 'T' || $("#useCheckEmailDuplication").val() == "T" ) {
            checkDuplEmail();
        }

    };

    // 비밀번호 확인 체크
    $('#' + sPasswdConfirmId + '').bind('blur', function(){
        if ($('#pwConfirmMsg').length < 1 ) return;
        if ( $('#' + sPasswdConfirmId + '').val() == '' && $('#' + sPasswdId + '').val() == '') return;
        checkPwConfirm(sPasswdConfirmId);
    });

    // 이메일 사용
    $('#use_email_confirm_button').bind('click', function() {

        if ( $('#login_id_type').val() != 'email' ) return;
        if ( SHOP.getLanguage() == 'ko_KR' || $('#idMsg').length < 1) return;

        var sQuestion;
        sQuestion = __('이메일로 로그인하려면 회원님 이메일이 아이디로 사용중인지 점검이 필요합니다. 아이디 또는 이메일로 로그인 가능하도록 이메일 중복확인하시겠습니까?');

        if (confirm(sQuestion) == true) {
            $('#use_email_confirm').val('T');
            $('#idMsg').removeClass('error').html(__('회원정보수정 후 저장하여야 이메일 로그인이 가능합니다.') );
            checkDuplEmail();
            $('#use_email_confirm_button').hide();
        } else {
            $('#use_email_confirm').val('F');
        }

    });

    // last_name 자르기
    cutLastName();

    var oAgreeInformation = $("input:checkbox[name='agree_information_check[]']");
    var oAgreeConsignment = $("input:checkbox[name='agree_consignment_check[]']");
    var oAgreePrivacyOptional = $("input:checkbox[name='agree_privacy_optional_check[]']");

    if (oAgreeInformation.length > 0) {
        $('#editForm').append('<input type="hidden" name="agree_information_check_display" value="T">');
    }
    if (oAgreeConsignment.length > 0) {
        $('#editForm').append('<input type="hidden" name="agree_consignment_check_display" value="T">');
    }
    if (oAgreePrivacyOptional.length > 0) {
        $('#editForm').append('<input type="hidden" name="agree_privacy_optional_check_display" value="T">');
    }

    if (SHOP.getLanguage() != "ko_KR") {
        setFphone();    // 해외배송 - 국가 변경시 국가 전화번호 코드 동기화
    }


    try {
        // 일문 주소 readonly 설정
        zipcodeCommonController.setJapanCountryAddr1($('#country').val(), $('#addr1'), $('#postcode1'));
    } catch(e) {}

    try {
        if (isCountryOfLanguage == 'T') {
            // 주소 관련 UI 처리
            setAddressOfLanguage.editInit();
        }
    } catch(e) {}

    $('#si_name_addr').bind('change', function(){
        setAddressOfLanguage.setZipcode(this);
        setAddressOfLanguage.setLastZipcode();
    });
    $('#ci_name_addr').bind('change', function(){
        setAddressOfLanguage.setZipcode(this);
        setAddressOfLanguage.setLastZipcode();
    });
    $('#gu_name_addr').bind('change', function(){
        setAddressOfLanguage.setZipcode('last');
        setAddressOfLanguage.setLastZipcode();
    });

    try {
        setAddressCommon.setUseCountryNumberModifyUi($('#phone1'), $('#mobile1'));
    } catch(e) {}

    try {
        // sms, email 수신동의 필수 입력 제거
        memberCommon.marketingRemoveFilter();
    } catch(e) {}
});

// 이메일 중복체크
function checkEmail() {
    if (mobileWeb == true && $('#emailMsg').length > 0) {
        checkDuplEmail();
    }
}

// 해당국가 외에는 직접 우편번호를 넣는다.
function setFindZipcode() {

    var sCountry = $('#country').val();
    var sLanguage = SHOP.getLanguage();

    //주소정보 초기화
    $('#postcode1, #postcode2, #addr1, #city_name, #state_name, #__addr1, #__city_name, #__state_name').val("");

    if (SHOP.getLanguage() != 'vi_VN') {
        $('#addr2').val("");
    }

    //우편번호 복원
    $('#postcode1').val($('#postcode1').attr('backup_postcode'));

    //멀티샵언어와 국가정보가 일치하는지 체크
    if ( ( sLanguage == 'zh_CN' && ( sCountry != 'CHN' && sCountry != 'TWN') ) ||
        ( sLanguage == 'ja_JP' && sCountry != 'JPN') ||
        ( sLanguage == 'zh_TW' && sCountry != 'TWN') ) {

        //우편번호찾기 버튼제어
        $('#SearchAddress').hide();

        if (mobileWeb == true) {
            $('#postBtn').hide();
        }

        //city, state 입력가능하도록
        //$('tr:has(td:has(#city_name)), tr:has(td:has(#state_name))').show();
    } else {
        if ( sLanguage != 'en_US' && sLanguage != 'es_ES' && sLanguage != 'pt_PT') {
            $('#SearchAddress').show();

            if (mobileWeb == true) {
                $('#postBtn').show();
            }

            if ($('#nozip').attr('checked') == true) {
                $('#nozip').attr('checked', false).change();
                $('#nozip').attr('checked', false);
            }

            //city, state 히든처리
            $('tr:has(td:has(#city_name)), tr:has(td:has(#state_name))').hide();
        }
    }
}

/**
 * 해외배송 - 국가 변경시 국가 전화번호 코드 동기화
*/
function setFphone() {

    var sCode        = $('#country').val();
    var sDialingCode = parseInt(oCountryVars[sCode].d_code);
    var sCountryName = oCountryVars[sCode].country_name_en;
    var aMultiplCode = [1, 7, 262];
    var oFilter = eval("/" + sCountryName + "/ig");

    // 나라별 국번이 동일하면
    if ($.inArray(sDialingCode, aMultiplCode) >= 0) {
        if ($("#phone1").length > 0) {
            $("#phone1>option").each(function() {
                if (oFilter.test($(this).text()) == true) {
                    $(this).attr("selected", true);
                    $('#phone1 > option:contains("'+$(this).text()+'")').eq(0).attr('selected', true);
                }
            });
        }
        if ($("#mobile1").length > 0) {
            $("#mobile1>option").each(function() {
                if (oFilter.test($(this).text()) == true) {
                    $(this).attr("selected", true);
                }
            });
        }
    }
    else {
        if ($("#phone1").length > 0) { $("#phone1").val(sDialingCode); }
        if ($("#mobile1").length > 0) { $("#mobile1").val(sDialingCode); }
    }
}

//last_name 입력필드가 있는 경우, name입력필드에서 last_name값을 제외
function cutLastName()
{
    // 해외몰만 해당
    if (SHOP.getLanguage() == 'ko_KR') return;

    var sName = $('#name').val();
    if (sName.indexOf('|') > -1) {
        if ($('#last_name').length > 0) {
            sName = sName.substring(0, sName.indexOf('|'));
        } else {
            sName = sName.replace('|', '');
        }
        $('#name').val(sName);
    }
}

var globalEditData = [];
var essn_array = null;
var iRerun = 0;

function isSnsMember(sMemeberId)
{
    var iIndex = sMemeberId.indexOf('@');
    return (iIndex < 0) ? false : true;
}

/**
 * 수정
 */
function memberEditAction()
{
    if (MemberAction.isSubmit != true) {

        // 백업 내용있을경우 원복을 한다
        for (var key in globalEditData) {
            if (typeof globalEditData[key] == 'object') {
                $('#' + key).attr("fw-filter", globalEditData[key]['fw-filter']);
            }
        }

        // 감춤 영역의 fw-filter 설정을 백업 한다
        $('#editForm .displaynone [fw-filter*="is"]').each(function () {
            globalEditData[$(this).attr('id')] = {"fw-filter": $(this).attr('fw-filter')};
            $(this).removeAttr("fw-filter");
        });
        // 감춤 영역의 fw-filter 설정을 백업 한다
        $('#editForm [fw-filter*="is"]:not(:visible)').each(function () {
            globalEditData[$(this).attr('id')] = {"fw-filter": $(this).attr('fw-filter')};
            $(this).removeAttr("fw-filter");
        });
        // 수정 불가 영역의 fw-filter 설정을 백업 한다
        $('#editForm [fw-filter*="is"]:disabled').each(function () {
            globalEditData[$(this).attr('id')] = {"fw-filter": $(this).attr('fw-filter')};
            $(this).removeAttr("fw-filter");
        });
        // 수정 불가 영역의 fw-filter 설정을 백업 한다
        $('#editForm #member_id[fw-filter*="is"]').each(function () {
            globalEditData[$(this).attr('id')] = {"fw-filter": $(this).attr('fw-filter')};
            $(this).removeAttr("fw-filter");
        });
        if ($('#email1').val() != '' && $('#email2').val() != '' && $('#email3 :selected').val() == '') {
            $('#email3 option[value=etc]').attr('selected', true);
        }

        var bSnsMember = isSnsMember($('#member_id').val());

        if ($('#unauthorized_member_modify_limit').length > 0) {
            if ($('#unauthorized_member_modify_limit').val() == 'T' && $('input[name="personal_type"]').length > 0) {
                //아이핀 인증 체크
                if (SHOP.getLanguage() === 'ko_KR' && $('#member_name_cert_flag').val() == 'T' && $('#is_ipin_auth_use').val() == 'T' && $('#realNameEncrypt').val() == '') {
                    alert('먼저 본인인증을 진행해주세요');
                    return false;
                }

                // 휴대폰 인증 체크
                if (SHOP.getLanguage() === 'ko_KR' && $('#member_name_cert_flag').val() == 'T' && $('#is_mobile_auth_use').val() == 'T' && $('#realNameEncrypt').val() == '') {
                    alert('먼저 본인인증을 진행해주세요');
                    return false;
                }
            }
        }

        // ECHOSTING-82237 이름을 성,이름으로 구분하여 사용하는 경우 둘중 하나라도 입력하지 않으면 안내 메세지 출력
        if ($('#is_display_register_name').val() == 'T') {
            if ($.trim($('#name').val()) == '' && $('#name').length > 0) {
                alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                $('#name').focus();
                return false;
            }

            if (SHOP.getLanguage() != 'ko_KR') {
                if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name').length < 1) {
                    alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                    return false;
                } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name').length > 0) {
                    if ($.trim($('#last_name').val()) == '') {
                        alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                        $('#last_name').focus();
                        return false;
                    }
                }
            }
        }

        // 영문이름 체크
        if ($('#is_display_register_eng_name').val() == 'T' && $("#useSimpleSignin").val() != 'T') {
            if ($('#name_en').val() == '' && $('#name_en').length > 0) {
                alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                $('#name_en').focus();
                return false;
            }

            if (SHOP.getLanguage() != 'ko_KR') {
                if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_en').length < 1) {
                    alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                    return false;
                } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_en').length > 0) {
                    if ($.trim($('#last_name_en').val()) == '') {
                        alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                        $('#last_name_en').focus();
                        return false;
                    }
                }
            }
        }

        // 이름(발음) 체크
        if ($('#is_display_register_name_phonetic').val() == 'T' && $("#useSimpleSignin").val() != 'T') {
            if ($('#name_phonetic').val() == '' && $('#name_phonetic').length > 0) {
                alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
                $('#name_phonetic').focus();
                return false;
            }

            if (SHOP.getLanguage() != 'ko_KR') {
                if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_phonetic').length < 1) {
                    alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
                    return false;
                } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_phonetic').length > 0) {
                    if ($.trim($('#last_name_phonetic').val()) == '') {
                        alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
                        $('#last_name_phonetic').focus();
                        return false;
                    }
                }
            }
        }

        //별명체크
        //need to include memberJoinCheckNick.js
        var aCheckNick = checkLength($('#nick_name').val());
        var bIsNickFilter = ($('#nick_name').attr('fw-filter')) ? 'T' : 'F';
        if (aCheckNick['passed'] == false && bIsNickFilter == 'T') {
            alert(aCheckNick['msg']);
            $('#nick_name').focus();
            return false;
        }

        // 사업자 번호 체크
        if (EC$("#cssn").length > 0) {
            // 사업자번호 관련 에러 메시지가 있는 경우
            if (EC$("#cssnMsg").attr('id') == 'cssnMsg' && EC$("#cssnMsg").hasClass('error')) {
                alert(EC$("#cssnMsg").text());
                EC$('#cssn').focus();
                return false;
            }

            // 중복 제한 체크 설정 했는데 체크 버튼을 클릭 안한 경우
            if (EC$('#use_checking_cssn_duplication').val() == 'T' && EC$('#cssnDuplCheck').val() == 'F') {
                alert(__('사업자번호 중복 체크를 해주세요'));
                EC$('#cssn').focus();
                return false;
            }
        }

        // ECHOSTING-136604 직접 우편번호 입력시에는 입력내용에 대해 체크를 한다
        var bCheckKrZipcode = true;
        if ($('#direct_input_postcode1_addr0')) {
            if ($('#direct_input_postcode1_addr0').attr('checked')) {
                if ($("#postcode1").val().match(/^[a-zA-Z0-9- ]{2,14}$/g) == null) {
                    alert(__("우편번호는 영문, 숫자, 대시(-)만 입력가능합니다.\n입력내용을 확인해주세요."));
                    $("#postcode1").focus();
                    return false;
                }
                bCheckKrZipcode = false;
            }
        }

        // 주소 체크
        if ($('#is_display_register_addr').val() == 'T') {
            if (SHOP.getLanguage() == 'ko_KR') {
                if ($('#postcode1').val() == '') {
                    alert(__('주소를 입력해주세요'));
                    $('#postcode1').focus();
                    return false;
                }
            } else {
                if ($('#nozip').is(':checked') == false) {
                    if ($.trim($('#postcode1').val()) == '') {
                        alert(__('우편번호를 입력해주세요.'));
                        $('#postcode1').focus();
                        return false;
                    }

                    if ($("#postcode1").val().length < 2 || $("#postcode1").val().length > 14) {
                        alert(__("우편번호는 2자 ~ 14자까지 입력가능합니다."));
                        $("#postcode1").focus();
                        return false;
                    }

                    if ($("#postcode1").val().match(/^[a-zA-Z0-9- ]{2,14}$/g) == null) {
                        alert(__("우편번호는 영문, 숫자, 대시(-)만 입력가능합니다.\n입력내용을 확인해주세요."));
                        $("#postcode1").focus();
                        return false;
                    }
                }
            }

            if ($('#display_required_address').val() == 'T' && $('#addr1').val() == '') {
                alert(__('주소를 입력해주세요'));
                $('#addr1').focus();
                return false;
            }

            if ($('#display_required_address2').val() == 'T' && $('#addr2').val() == '') {
                alert(__('주소를 입력해주세요'));
                $('#addr2').focus();
                return false;
            }
        }

        // 주소가 입력되어 있으면 우편번호 벨리데이션 체크
        if (SHOP.getLanguage() == 'ko_KR' && $('#postcode1').val() != '' && $('#postcode1').val() != undefined && bCheckKrZipcode == true) {

            var zipcode = $('#postcode1').val();
            zipcode = zipcode.replace('-', '');

            // 숫자가 아니거나 5자리 미만이면 체크
            if (FwValidator.Verify.isNumber(zipcode) == false || zipcode.length < 5 || zipcode.length > 6) {
                alert('우편번호를 확인해주세요');
                $('#postcode2').val('');
                $('#postcode1').focus();
                return false;
            }
        }

        if (memberCommon.checkUsStatename() === false) {
            return false;
        }

        // 일반전화 체크
        if (memberCommon.checkEditPhone() === false) {
            return false;
        }

        // 휴대전화 체크
        if (memberCommon.checkEditMobile() === false) {
            return false;
        }

        // ECHOSTING-103567 - 회원가입 형식으로 통일
        var aCheckDateMap = [{'idPrefix': 'birth', 'idName': __('생년월일')}, {
            'idPrefix': 'marry',
            'idName': __('결혼기념일')
        }, {'idPrefix': 'partner', 'idName': __('배우자 생일')}];

        for (var i = 0; i < aCheckDateMap.length; i++) {
            var bDateResult = checkDate(aCheckDateMap[i]['idPrefix'], aCheckDateMap[i]['idName']);
            if (bDateResult == false) return false;
        }

        // ECHOSTING-5133
        if ($('#real_name:visible').length > 0) {
            var name = $('#real_name').val();
            var ssn1 = $('#real_ssn1').val();
            var ssn2 = $('#real_ssn2').val();

            if (!name) {
                alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                $('#real_name').focus();
                return false;
            }

            if (!ssn1 || !ssn2) {
                if (!ssn1) {
                    $('#real_ssn1').focus();
                } else {
                    $('#real_ssn2').focus();
                }
                alert(__('주민등록 번호를 입력해 주세요.'));
                return false;
            }

            if ($('#identification_check0:visible').length > 0) {
                if ($('#identification_check0:visible')[0].checked === false) {
                    alert(__('고유식별정보 처리에 동의해 주세요.'));
                    $('#identification_check0:visible').focus();
                    return false;
                }
            }
            if ($('#realNameEncrypt').val() == '') {
                alert(__('실명인증을 진행해주세요.'));
                return false;
            }

        }

        var sPasswdChkPass = true;

        if (!bSnsMember) {
            if (sPasswdId == 'passwd') {
                if ($('#passwd').val() == '' || $('#user_passwd_confirm').val() == '') {
                    alert(__('비밀번호 항목은 필수 입력값입니다.'));
                    sPasswdChkPass = false;
                    return false;
                }
            } else {
                if ($('#passwd').val() != '') {
                    if ($('#new_passwd').val() == '' || $('#new_passwd_confirm').val() == '') {
                        alert(__('새 비밀번호를 입력해 주세요.'));
                        sPasswdChkPass = false;
                        return false;
                    }
                    if ($('#passwd').val() == $('#new_passwd').val()) {
                        alert(__('새 비밀번호가 현재 비밀번호와 동일합니다. 다시 입력해주세요.'));
                        sPasswdChkPass = false;
                        return false;
                    }
                }
            }

            if ($('#' + sPasswdId + '').val() != $('#' + sPasswdConfirmId + '').val()) {
                if (sPasswdId == 'new_passwd') {
                    var sMsg = '새 비밀번호를 입력해 주세요.';
                } else {
                    var sMsg = '비밀번호가 일치하지 않습니다.';
                }

                alert(__(sMsg));
                sPasswdChkPass = false;
                return false;
            }

            // 비밀번호 타입
            var sPasswdType = ($('#passwd_type').val() == '' || $('#passwd_type').length < 1) ? 'A' : $('#passwd_type').val();

            // 비밀번호 조합 체크
            if (sPasswdId == 'passwd' || ($('#new_passwd').val() != '' && $('#new_passwd').length > 0)) {
                var sPasswdCheck = ckPwdPattern($('#' + sPasswdId + '').val(), sPasswdType);
                if (sPasswdCheck !== true) {

                    // 뉴상품 구분
                    if (typeof (SHOP) == 'object' && SHOP.getProductVer() > 1) {

                    } else {
                        // 구상품용 알럿 처리
                        return oldPasswdChk(sPasswdId, sPasswdType);
                    }

                    var sMsgWord = __("입력 가능 특수문자 :  ~ ` ! @ # $ % ^ ( ) _ - = { } [ ] | ; : < > , . ? /");
                    var aMsgWord = sMsgWord.split(':');
                    var aMsgWordSub = {};

                    if (sPasswdType == 'A') {
                        var sMsg = ''
                            + __('비밀번호 입력 조건을 다시 한번 확인해주세요.') + "\n"
                            + "\n"
                            + '※ ' + __('비밀번호 입력 조건') + "\n"
                            + '- ' + __('대소문자/숫자 4자~16자') + "\n"
                            + '- ' + __('특수문자 및 공백 입력 불가능') + "\n";
                    } else {
                        if (sPasswdType == 'B') {
                            aMsgWordSub = __('대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자');
                        } else if (sPasswdType == 'C') {
                            aMsgWordSub = __('대소문자/숫자/특수문자 중 2가지 이상 조합, 10자~16자');
                        } else if (sPasswdType == 'D') {
                            aMsgWordSub = __('대소문자/숫자/특수문자 중 3가지 이상 조합, 8자~16자');
                        }
                        var sMsg = ''
                            + __('비밀번호 입력 조건을 다시 한번 확인해주세요.') + "\n"
                            + "\n"
                            + '※ ' + __('비밀번호 입력 조건') + "\n"
                            + '- ' + aMsgWordSub + "\n"
                            + '- ' + aMsgWord[0] + "\n" + "  " + aMsgWord[1] + ":" + aMsgWord[2] + "\n"
                            + '- ' + __('공백 입력 불가능') + "\n";
                    }
                    if (sMsg) alert(sMsg);

                    $('#' + sPasswdId + '').focus();
                    sPasswdChkPass = false;
                    return false;
                }
            }
        }

        // 비번체크 패스일경우
        if (sPasswdChkPass) {
            // 미체크 영역의 fw-filter 설정을 백업 한다
            $('#editForm #passwd,#user_passwd_confirm,#new_passwd,#new_passwd_confirm').each(function () {
                globalEditData[$(this).attr('id')] = {"fw-filter": $(this).attr('fw-filter')};
                $(this).removeAttr("fw-filter");
            });
        }

        // 비밀번호답변 입력여부
        if ($('#is_display_password_hint').val() == 'T') {
            if ($.trim($('#hint_answer').val()) == '') {
                alert(__('비밀번호 확인 답변을 입력 해주세요.'));
                $('#hint_answer').focus();
                return false;
            }
        }

        // 휴대전화 번호 변경 됐는지 확인 후 휴대전화 인증 했는지 확인
        if (memberVerifyMobile.isMobileNumberChange() === true) {
            if (memberVerifyMobile.isMobileVerify() === false) {
                alert(__('VERIFY.YOUR.MOBILE.NUMBER', 'MEMBER.UTIL.VERIFY'));
                return false;
            }
        }

        if ($('#email1').val() == '' || $('#email2').val() == '') {
            alert(__('이메일을 입력하세요.'));

            if ($('#email1').val() == '') $('#email1').focus();
            else if ($('#email2').val() == '') $('#email2').focus();

            return false;
        }

        // 이메일 (직접입력)
        if ($('#email1').length > 0 && $('#email2').length > 0) {
            var sEmail = $('#email1').val() + '@' + $('#email2').val();
        } else {
            var sEmail = $('#email1').val();
        }

        if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255) {
            alert(__('입력하신 이메일을 사용할 수 없습니다.'));
            $('#email1').focus();
            return false;
        }

        if (SHOP.getLanguage() != 'ko_KR') {
            if ($('#login_id_type').val() == 'email') {
                if ($('#emailDuplCheck').val() != 'T' && $('#use_email_confirm').val() == 'T') {
                    alert(__('DUPLICATE.EMAIL.CHECK', 'MEMBER.FRONT.VALIDATION'));
                    $('#email1').focus();
                    return false;
                }
            }
        }

        if (SHOP.getLanguage() == 'ko_KR') {
            if ($('#emailDuplCheck').val() != 'T' && $('#use_email_confirm').val() == 'T') {
                // 이메일 중복 확인 전 실행 방지 처리
                if ($('#emailDuplCheck').val() == '' && iRerun < 10) {
                    iRerun++;
                    setTimeout(function () {
                        memberEditAction();
                    }, 500);
                    return false;
                }
                alert(__('DUPLICATE.EMAIL.CHECK', 'MEMBER.FRONT.VALIDATION'));
                $('#email1').focus();
                return false;
            }
        }

        // 이메일 중복 체크 기능 사용하는경우 이메일 중복 확인이 되지 않으면 alert 메시지 띄워주고 폼전송 못하게 막는다.
        // 이메일 중복 확인전 실행 방지 처리 구간이 또 있지만 뭔가 다른 액션과함께이고 설정 또한 다르기때문에 별도체크한다.
        if ($("#useCheckEmailDuplication").val() == "T" && bCheckedEmailDupl == false) {
            if (mobileWeb == true) {
                alert(__('이메일 중복여부를 확인해 주세요.'));
            } else {
                alert(__("이미 가입된 이메일 주소입니다.\n쇼핑몰 가입여부를 다시 확인하여 주시거나 관리자에게 문의하여 주세요."));
            }
            return false;
        }
        // 영문이름 체크
        if ($('#display_required_name_en').val() == 'T') {
            if ($('#name_en').val() == '') {
                alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                $('#name_en').focus();
                return false;
            }
        }

        var result = FwValidator.inspection('editForm');
        if (result.passed == true) {
            try {
                if (memberCommon.optionalCheck() === false) {
                    return false;
                }
            } catch (e) {
            }

            // 세션스토리지 회원 캐시 삭제
            try {
                CAPP_ASYNC_METHODS.member.removeCache();
            } catch (e) {
            }

            // 회원정보 수정 폼 전송
            $('#editForm').submit();
            MemberAction.isSubmit = true;
        }
    }

}

function oldPasswdChk(sPasswdId, sPasswdType)
{
    var oCheckErrorMessage = {
        A : __('4~16자로 입력해 주세요.'),
        B : __('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 8~16자로 입력해 주세요.'),
        C : __('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 10~16자로 입력해 주세요.'),
        D : __('비밀번호는 영문 대소문자/숫자/특수문자 중 3가지 이상 조합,8자 ~ 16자로 설정하셔야 합니다.')
    };

    var sDefaultErrorMessage = __("공백 또는 허용된 특수문자 (~ ` ! @ # $ % ^ ( ) _ - = { [ } ] ; : < > , . ? /) 외의 특수문자는 사용할 수 없습니다.");
    var sDefaultErrorMessage2 = __("공백 또는 허용 불가한 특수문자는 사용할 수 없습니다.");

    if (sPasswdType == 'A') {
        sDefaultErrorMessage = sDefaultErrorMessage2;
    }

    // 비밀번호 조합 체크
    var passwd_chk = ckPwdPattern($('#' + sPasswdId).val(), sPasswdType);
    if (passwd_chk !== true) {
        $('#' + sPasswdId).focus();

        var sMessage = passwd_chk == 'F' ? sDefaultErrorMessage : oCheckErrorMessage[sPasswdType];

        alert(sMessage);

        return false;
    }
    return true;
}

/**
 * 유선전화
 * @param sElementName 체크 할 엘리먼트 id
 */
function checkPhone(sElementName)
{
    var sFirstNumber = $('#' + sElementName + '2').val();//국번
    var sLastNumber = $('#' + sElementName + '3').val();//뒷번호

    var regexp = /^\d{3,4}$/;
    var bResultFirst = regexp.test(sFirstNumber);

    regexp = /^\d{4}$/;
    var bResultLast = regexp.test(sLastNumber);

    return ((bResultFirst && bResultLast));
}

/**
 * 휴대전화 체크
 * @param sElementName 체크 할 엘리먼트 id
 */
function checkMobile(sElementName)
{

    var sTelComp = $('#' + sElementName + '1').val();//통신사
    var sFirstNumber = $('#' + sElementName + '2').val();//국번
    var sLastNumber = $('#' + sElementName + '3').val();//뒷번호

    var regexp = /^\d{3}$/;
    var bResultTelComp = regexp.test(sTelComp);

    var regexp = /^\d{3,4}$/;
    var bResultFirst = regexp.test(sFirstNumber);

    regexp = /^\d{4}$/;
    var bResultLast = regexp.test(sLastNumber);

    return ((bResultTelComp && bResultFirst && bResultLast));
}

/**
 * 탈퇴
 * @returns {Boolean}
 */
function memberDelAction(iMileage, iDeposit, iRejoinableDay)
{
    var bSnsMember = isSnsMember($('#member_id').val());

    if (!bSnsMember) {
    if (sPasswdId == 'new_passwd') {
        if ($('#passwd').val() == '') {
            alert(__('현재 비밀번호가 정확하지 않습니다. 다시 입력해주세요.'));
            $('#passwd').focus();
            return false;
        }
    } else {
        if ($('#passwd').val() == '') {
            alert(__('비밀번호를 입력하세요.'));
            $('#passwd').focus();
            return false;
        }

        if ($('#user_passwd_confirm').val() == '') {
            alert(__('비밀번호를 입력하세요.'));
            $('#user_passwd_confirm').focus();
            return false;
        }

        if ($('#passwd').val() != $('#user_passwd_confirm').val()) {
            alert(__('비밀번호와 비밀번호 확인이 틀립니다.'));
            $('#passwd').focus();
            return false;
        }
    }
    }

    if ($('#email1').length > 0 && $('#email2').length > 0) {
        var sEmail = $('#email1').val()+'@'+$('#email2').val();
    } else {
        var sEmail = $('#email1').val();
    }

    if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255) {
        alert(__('입력하신 이메일을 사용할 수 없습니다.'));
        $('#email1').focus();
        return false;
    }

    // ECHOSTING-85370
    if (MemberLeaveAccount.getType() == 'LAYER') {
        MemberLeaveAccount.init(iMileage, iDeposit);
        MemberLeaveAccount.setLayerPopup();
        return true;
    }

    if (SHOP.getLanguage() == 'ko_KR' && iRejoinableDay  > 0) {
        var sQuestion = sprintf('회원탈퇴 후 %s일 이후에 회원가입이 가능합니다.', iRejoinableDay) + '\n';
        sQuestion += '그래도 탈퇴하시겠습니까?';

        if (confirm(sQuestion) == false) {
            return;
        }
    }

    sQuestion = '[' + __('현재 적립금') + '] ' + iMileage + '\n';
    if (iDeposit >= 0) {
        // 몰설정에 따른 예치금명 변환 ECHOSTING-165848
        sQuestion += '[' + __('현재 [BALANCE_STR]') + '] ' + iDeposit + '\n';
        sQuestion += __('탈퇴하면 적립금/[BALANCE_STR]이 삭제 됩니다.');
        sQuestion = sQuestion.replace(/\[BALANCE_STR\]/gi, sMallDepositName);
    } else {
        sQuestion += __('탈퇴하면 적립금이 삭제 됩니다.');
    }

    sQuestion += '\n';
    sQuestion += __('정말로 탈퇴 하시겠습니까?');

    if (confirm(sQuestion) == true) {
        $('#editForm').attr('action', '/exec/front/Member/del/');
        $('#editForm').submit();
    }
}

/**
 * 비밀번호 체크
 */
function ckPwdPattern(sPwd, sPwdType)
{
    if (sPwdType == 'A') {
        var pattern = /^[a-zA-Z0-9]{4,16}$/; //조합없이 4~16
        var chk = (pattern.test(sPwd)) ? true : false;
        return chk;
    } else {
        var chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //영대소문자
        var chars2 = '0123456789'; //숫자
        var chars3 = '\~\`\!\@\#\$\%\^\(\)\_\-\=\{\}\[\]\|\;\:\<\>\,\.\?\/';

        var s = containsChar(sPwd, chars1, chars2, chars3);
        var s1 = s.split("/");
        var check_length = 0;

        if (s1[0] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[0]);
            s1[0] = 1;
        }
        if (s1[1] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[1]);
            s1[1] = 1;
        }
        if (s1[2] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[2]);
            s1[2] = 1;
        }

        //영대문자, 숫자, 특수문자 중 2가지 이상 조합이면
        if ((parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2])) >= 2) {
            if (sPwdType == 'B') {
                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {//허용되지 않은 문자가 포함된 경우
                        return 'F';//허용되지 않은 문자가 포함됨
                    } else {
                        return true;
                    }
                } else {
                    return false;//8자~16자가 안됨
                }
            } else if (sPwdType == 'C') {
                if (sPwd.length >= 10 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//10자~16자가 안됨
                }
            } else if (sPwdType == 'D') {
                if (parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2]) != 3)
                    return false;

                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//10자~16자가 안됨
                }
            } else {
                return false;
            }
        } else {
            return false; //영문대소문자, 숫자, 특수문자 2가지 조합이 안됨
        }
    }
}

function containsChar(input, chars1, chars2, chars3)
{
    var cnt1 = 0;
    var cnt2 = 0;
    var cnt3 = 0;

    for (var i=0;i<input.length;i++)
    {
        //영대소문자 포함여부
        if (chars1.indexOf(input.charAt(i))!= -1) {
            cnt1++;
        }
        //숫자 포함여부
        if (chars2.indexOf(input.charAt(i))!= -1) {
            cnt2++;
        }
        //특수문자 포함여부
        if (chars3.indexOf(input.charAt(i))!= -1) {
            cnt3++;
        }
    }
    return (cnt1+"/"+cnt2+"/"+cnt3);
}

/**
 * 생일, 결혼기념일, 배우자 생일 체크
 * @param string sIdPrefix 검사항목의 id prefix
 * @param string sIdName alert 에 띄울 항목명
 * @returns {Boolean}
 */
function checkDate(sIdPrefix, sIdName)
{
    if ($('#' + sIdPrefix + '_year').length == 0 || $('#' + sIdPrefix + '_month').length == 0 || $('#' + sIdPrefix + '_day').length == 0) {
        return true;
    }

    // 노출 되어있는지 확인
    if ($('#' + sIdPrefix + '_year').is(":visible") == false) {
        return true;
    }

    if ($('#' + sIdPrefix + '_year').val() != '' || $('#' + sIdPrefix + '_month').val() != '' || $('#' + sIdPrefix + '_day').val() != '') {
        var oToday = EC_GLOBAL_DATETIME.parse('', 'shop');
        var iTodayYear = oToday.format(EC_GLOBAL_DATETIME.const.YEAR_ONLY);
        var iTodayMonth = oToday.format(EC_GLOBAL_DATETIME.const.MONTH_ONLY);
        var iTodayDate = oToday.format(EC_GLOBAL_DATETIME.const.DAY_ONLY);
        var FIX_NOW_DATE = parseInt('' + iTodayYear + iTodayMonth + iTodayDate);
        var FIX_MIN_DATE = 19000101;

        year = $.trim($('#' + sIdPrefix + '_year').val());
        month = $.trim($('#' + sIdPrefix + '_month').val());
        month = month.length == 1 ? '0' + month : month;
        day = $.trim($('#' + sIdPrefix + '_day').val());
        day = day.length == 1 ? '0' + day : day;
        userDate = parseInt(year + month + day);
        lastday = EC_GLOBAL_DATETIME.parse('', 'shop')
            .set('year', year)
            .set('month', month)
            .set('date', 0)
            .date();

        if (userDate.toString().length < 8 || userDate.toString().length > 8) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        } else if (month < 1 || month > 12) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $('#' + sIdPrefix + '_month').val('').focus();
            return false;
        } else if (day < 1 || day > lastday) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $('#' + sIdPrefix + '_day').val('').focus();
            return false;
        } else if (userDate < FIX_MIN_DATE) {
            alert(__('1900년 이후부터 입력 가능 합니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        } else if (userDate > FIX_NOW_DATE) {
            alert(__('오늘날짜 까지 입력 할 수 있습니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        }
    }
    return true;
}

/**
 * 휴대폰, 아이폰 인증 후 이름, 휴대폰 번호등 Decrypt
 */
function callEncryptFunction() {
    AuthSSLManager.weave({
        'auth_mode' : 'decryptClient', //mode
        'auth_string' : document.getElementById('realNameEncrypt').value, //auth_string
        'auth_callbackName'  : 'MemberEditAuthtSSL.setDisplayMember'      //callback function
    });
}
// 회원탈퇴 관련 JS 정의
var MemberLeaveAccount = {
    bInited: false,
    // 타입정의 alert 과 탈퇴사유를 받는 layer 두종류로 나뉘어짐
    iMileage : '', 
    iDeposit : '', 
    getType : function ()
    {
        // 기능개선 통해 사유 받는 레이아웃 뜨면 typeof 로 했더니 $('#eLeaveLayer') 가 object 로 떠버림. length 로 변경
        if (($('#eLeaveLayer').length > 0) && (sIsLeaveReason == 'T')) {
            return 'LAYER';
        }
        return 'ALERT';
    },
    init : function (iMileage, iDeposit) 
    {
        this.iMileage = iMileage;
        this.iDeposit = iDeposit;
        $('#eLeaveLayerEtcTextarea').hide();
        $('#eLeaveLayerDepositTextarea').hide();
        
        if (this.bInited == false) {
            this.setEvent();
            this.bInited = true;
        }
    }, 
    setEvent : function()
    {
        // 탈퇴버튼
        $('#eLeaveLayerBtn').click(function () {
            if (MemberLeaveAccount.getIsSelectedCloseReason() == true) {
                MemberLeaveAccount.setSubmit();
            } else {
                alert(__("회원탈퇴 사유를 선택해주세요"));
            }
        });
        
        // 사유선택 UI
        $('#leave_reason').change(function () {
            if ($(this).val() == __("기타")) {
                $('#eLeaveLayerEtcTextarea').show();
            } else {
                $('#eLeaveLayerEtcTextarea').hide();
            }
        });
    },
    setLayerPopup : function ()
    {
        $('#eLeaveLayerMileage').text(this.iMileage);

        if (this.iDeposit >= 0) {
            // 몰설정에 따른 예치금명 변환 ECHOSTING-165848
            var sDepositRemoveLeaveStr = __('탈퇴하면 적립금/[BALANCE_STR]이 삭제 됩니다.');
            sDepositRemoveLeaveStr = sDepositRemoveLeaveStr.replace(/\[BALANCE_STR\]/gi, sMallDepositName);
            
            $('#eLeaveLayerMileageText').text(sDepositRemoveLeaveStr);
            $('#eLeaveLayerDepositTextarea').show();
            $('#eLeaveLayerDeposit').text(this.iDeposit);
        } else {
            $('#eLeaveLayerMileageText').text(__('탈퇴하면 적립금이 삭제 됩니다.'));
        }

        $('#eLeaveLayer').show();
    },
    getIsSelectedCloseReason : function ()
    {
        if ($('#leave_reason').val() == '') {
            return false;
        }
        return true;
    },
    setSubmit : function ()
    {
        $('#editForm').attr('action', '/exec/front/Member/del/');
        $('#editForm').submit();
    }
};
var agent = navigator.userAgent.toLowerCase();
var bMobileWeb = false;

$(document).ready(function(){

     // 모바일웹인지 확인
    if (window.location.hostname.substr(0, 2) == 'm.' ||
       window.location.hostname.substr(0, 12) == 'mobile--shop' ||
       window.location.hostname.substr(0, 11) == 'skin-mobile' ) {
       bMobileWeb = true;
    }

    // 모바일웹이 아닐경우만 포커스
    if (bMobileWeb !== true) {
        $('#zipcode_keyword').focus();
    }
});

var ZipcodeFinder = {};


/**
 * 부모창 객체
 */
ZipcodeFinder.Opener = {
    oLanguage: {
        apply: '',
        close: ''
    },

    /**
     * 초기화 - 이벤트 바인딩
     */
    bind : function(btnId, zipId1, zipId2, addrId, type, cityId , stateId, sLanguage, addrId2, form, sFixCountry) {
        var elmBtn = $('#' + btnId);
        if (elmBtn.data("btnEvent") != true) {
            var ci_name_item = "";
            // 기본 바인딩
            elmBtn.bind('click', {
                'zipId1' : zipId1,
                'zipId2' : zipId2,
                'addrId' : addrId,
                'cityId' : cityId,
                'stateId' : stateId,
                'type' : type,
                'sLanguage' : sLanguage,
                'addrId2' : addrId2,
                'form' : form,
                'sFixCountry' : sFixCountry,
                oLanguage: this.oLanguage
            }, this.Event.onClickBtnPopup)
            .data("btnEvent", true);
            // 우편번호 처리
            $('#postcode1').attr('fw-filter', 'isLengthRange[1][14]');
            $('#postcode2').attr('disabled', 'disabled');
        }
    },

    /**
     * 버튼 언어셋 바인딩
     * @param oLanguage
     */
    setLanguage: function(oLanguage) {
        if (!oLanguage) {
            oLanguage = {};
        }

        for (var sKey in oLanguage) {
            if (oLanguage.hasOwnProperty(sKey) && oLanguage[sKey]) {
                this.oLanguage[sKey] = oLanguage[sKey];
            }
        }
    }
};

/**
 * 부모창 객체 - 이벤트 핸들러
 */
ZipcodeFinder.Opener.Event = {

    /**
     * 클릭 - 우편번호 팝업 오픈
     */
    onClickBtnPopup : function(evt) {

        var zipId1 = evt.data.zipId1;
        var zipId2 = evt.data.zipId2;
        var addrId = evt.data.addrId;
        var stateId = evt.data.stateId;
        var cityId = evt.data.cityId;
        var type = evt.data.type;
        var sLanguage = evt.data.sLanguage;
        var addrId2 = evt.data.addrId2;
        var form = evt.data.form;
        var sFixCountry = evt.data.sFixCountry;

        var iWidth = 308;
        var iHeigth = 340;
        var posY = "60%";
        var posX = "35%";


        if (bMobileWeb === true || type == 'mobile' || (typeof EC_MOBILE_USE !== 'undefined' && EC_MOBILE_USE == false)) {
            var body_height = document.documentElement.clientHeight;

            var sTpl = "";
            switch (sLanguage) {
                case "ja_JP" :
                    sTpl = "zipcode_mobile_jp";
                    tmp$ = $;
                    break;
                case "zh_CN" :
                    sTpl = "zipcode_mobile_cn";
                    tmp$ = $;
                    break;
                case "zh_TW" :
                    sTpl = "zipcode_mobile_tw";
                    tmp$ = $;
                    break;
                case "vi_VN" :
                    sTpl = "zipcode_mobile_vn";
                    tmp$ = $;
                    break;
                default :
                    sTpl = "zipcode_mobile";
                    break;
            }

            var source = '<div id="zipcodeLayer" ></div>';

            $.get('/protected/'+sTpl+'.html?form='+form+'&zip1='+zipId1+'&zip2='+zipId2+'&addr='+addrId+'&cityId='+cityId+'&stateId='+stateId+'&type=mobile&sLanguage='+sLanguage+'&addr2='+addrId2 + '&sFixCountry='+ sFixCountry, function(data){
                $('body').append(source);
                $("#zipcodeLayer").html(data);
                if (sTpl == 'zipcode_mobile') {
                    $('body').addClass('eMobilePopup');
                } else {
                    $('body').attr('id', 'popup');
                }
            });

        } else if ( type == 'layer' || type == undefined ) {
            if ($('#zipcodeLayer').length > 0) return false;

            var sTpl = "";
            switch (sLanguage) {
                case "ja_JP" :
                    sTpl = "zipcode_layer_jp";
                    iWidth = 502;
                    iHeigth = 530;
                    var frameborder = 'frameborder="0"';
                    break;
                case "zh_CN" :
                    sTpl = "zipcode_layer_zh";
                    iWidth = 502;
                    iHeigth = 236;
                    var frameborder = 'frameborder="0"';
                    break;
                case "zh_TW" :
                    sTpl = "zipcode_layer_tw";
                    iWidth = 502;
                    iHeigth = 217;
                    var frameborder = 'frameborder="0"';
                    break;
                case "vi_VN" :
                    sTpl = "zipcode_layer_vn";
                    iWidth = 502;
                    iHeigth = 236;
                    var frameborder = 'frameborder="0"';
                    break;
                default :
                    sTpl = "zipcode_layer_kr";
                    iHeigth = 420;
                    var frameborder = 'frameborder="0"';
                    break;
            }

            posY = $('#'+zipId1).offset().top-100 + 'px';
            posX = $('#'+zipId1).offset().left-100+'px';

            var sApplyMessage = typeof evt.data.oLanguage === 'object' ? evt.data.oLanguage.apply : '';
            var sCloseMessage = typeof evt.data.oLanguage === 'object' ? evt.data.oLanguage.close : '';
            $('body').append('<div id="zipcodeLayer" class="zipcodeLayer" style="position:absolute; top:'+posY+'; left:'+posX+'; width:'+iWidth+'px; height:'+iHeigth+'px; background:#fff; z-index:999;">' +
                '<iframe src="/protected/'+sTpl+'.html?form='+form+'&zip1='+zipId1+'&zip2='+zipId2+'&addr='+addrId+'&cityId='+cityId+'&stateId='+stateId+'&type=layer&sLanguage='+sLanguage+'&addr2=' + addrId2 + '&sFixCountry='+ sFixCountry + '&sApplyMessage='+ sApplyMessage + '&sCloseMessage='+ sCloseMessage +'" id="iframeZipcode" ' + frameborder + ' style="width:100%; height:100%; border:0;"></iframe>' +
                '</div>');

        } else {

            switch (sLanguage) {
                case "ja_JP" :
                    sTpl = "zipcode_jp";
                    break;
                case "zh_CN" :
                    sTpl = "zipcode_zh";
                    break;
                default : sTpl = "zipcode";
            }

            var url = '/protected/'+sTpl+'.html?zip1=' + zipId1 + '&zip2=' + zipId2 + '&addr=' + addrId;
            window.open(url, 'Zipcode', 'width=462, height=435, toolbar=0, menubar=0, scrollbars=0');

        }
    }

};


/**
 * 팝업 객체
 */
ZipcodeFinder.Popup = {

    /**
     * 초기화 - 이벤트 바인딩
     */
    bind : function(zipId1, zipId2, addrId, type,  cityId , stateId, sLanguage) {

        var elmKeyword = $('#zipcode_keyword');
        var elmBtnSearch = $('#zipcode_btn_search');
        var elmResult = $('#zipcode_result');
        var elmApply = $('#zipcode_apply');

        // 모바일웹일 경우 타켓 변경
        if ( (bMobileWeb === true || type == 'layer'  || (typeof EC_MOBILE_USE !== 'undefined' && EC_MOBILE_USE == false)) && parent.$('#zipcodeLayer').length > 0 ) {

            var elmZip1 = parent.$('#' + zipId1);
            var elmAddr = parent.$('#' + addrId);

            if ( zipId2 != '') {
                var elmZip2 = parent.$('#' + zipId2);
            } else {
                var elmZip2 = parent.$('#ice0917');
            }
            if ( cityId != '') {
                var elmCity = parent.$('#' + cityId);
            } else {
                var elmCity = parent.$('#ice0918');
            }
            if ( stateId != '') {
                var elmState = parent.$('#' + stateId);
            } else {
                var elmState = parent.$('#ice0919');
            }

        } else {
            var elmZip1 = opener.$('#' + zipId1);
            if ( zipId2 != '') { var elmZip2 = opener.$('#' + zipId2); }
            var elmAddr = opener.$('#' + addrId);
            var elmCity = top.$('#ice0918');
            var elmState = top.$('#ice0919');
        }

        elmBtnSearch.bind('click', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickBtnSearch);

        if ($('div#wrap').outerHeight() !== null) {
            window.resizeTo('500', $('div#wrap').outerHeight() + 85);
        }
        elmKeyword.bind('keyup', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickBtnSearch);

        // 레이어 적용 버튼
        elmApply.bind('click', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickLayerResult);

    },

    /**
     * 성공시 출력 데이터 완성
     */
    makeSearchSuccess : function(elements, data) {

        if (elements.type == 'layer') {
            if ( elements.sLanguage == 'ja_JP') { // 일본 우편번호
                this.makeResultLayer_jp( elements, data );
            } else { // 국내 우편번호
                this.makeResultLayer(elements, data);
            }
        } else {
            this.makeResult(elements, data);
        }

    },

    /**
     * 성공시 출력 데이터 완성(Popup) - KR
     */
    makeResult : function(elements, data) {
        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {

          //<tr><td>156-012</td><td>서울 동작구 신대방2동</td></tr>
            var address = '<td>' + data[i].zipcode + '</td><td>'
                        + data[i].addr + ' '
                        + data[i].bunji + '</td> ';

            var sAddr = (data[i].bunji.indexOf("∼") > -1) ? '' : ' '+data[i].bunji;

            elmItem = $('<tr addr="' + data[i].addr + sAddr + '">' + address + '</tr>').bind('click', {'elements' : elements}, this.Event.onClickResult);

            elements.result.append(elmItem);
        }
    },

    /**
     * 성공시 출력 데이터 완성(Layer) - JP
     */
    makeResultLayer_jp : function(elements, data) {

        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {
            var _zipcode = data[i].zipcode;
            var _addr = data[i].sido_name + ' ' + data[i].gugun_name + ' ' + data[i].dong_name;

            var address = '<td class="left">' + _addr + '</td>'
                        + '<td>' + _zipcode + '</td>'
                        + '<td><a href="#none" class="btnNormal"><span>Select</span></a></td>';

            elmItem = $('<tr addr="' + data[i].sido_name + '|' + data[i].gugun_name + '|' + data[i].dong_name + '">' + address + '</tr>').bind('click', {'elements' : elements, 'zipcode' : _zipcode}, this.Event.onClickLayerResultJP);

            elements.result.append(elmItem);
        }
    },

    /**
     * 성공시 출력 데이터 완성(Layer) - KR
     */
    makeResultLayer : function(elements, data) {

        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {
            //<tr><td>156-012</td><td>서울 동작구 신대방2동</td></tr>
            var address = '<td>' + data[i].zipcode + '</td><td>'
                        + data[i].addr + ' '
                        + data[i].bunji + '</td> ';

            var sAddr = (data[i].bunji.indexOf("∼") > -1) ? '' : ' '+data[i].bunji;

            elmItem = $('<tr addr="' + data[i].addr + sAddr + '">' + address + '</tr>').bind('click', {'elements' : elements}, this.Event.onClickLayerResult);

            elements.result.append(elmItem);
        }
    },

    /**
     * 실패시 출력 데이터 완성
     */
    makeSearchFail : function(elements) {

        if ( elements.sLanguage != 'ko_KR') { // 일본 우편번호
            var elm = $('<tr><td colspan="3">No Result</td></tr>');
        } else {
            var elm = $('<tr><td colspan="2">우편번호 검색 내역이 없습니다.</td></tr>');
        }

        elements.result.html('');
        elements.result.append(elm);
    }

};

/**
 * 팝업 객체 - 이벤트 핸들러
 */
ZipcodeFinder.Popup.Event = {

    /**
     * 레이어 선택
     */
    onClickLayer : function() {
        $(this).parents().find('.selected').removeClass('selected');
        $(this).addClass("selected");
    },

    /**
     * 클릭 - 검색버튼
     */
    onClickBtnSearch : function(evt) {
        if ( (evt.type == 'keyup' && evt.which != 13 )) return false;//enter 로 검색

        var parent = evt.data.parent;
        var elements = evt.data.elements;

        var keyword = elements.keyword.val();
        if (keyword == '') return false;

        var url = '/exec/front/zipcode/find/';
        var params = {
            'keyword' : keyword,
            'sLanguage' : elements.sLanguage
        };

        $.ajax({
            type : 'post',
            url : url,
            data : params,
            success : function(response){
                if (response.result === true) {
                    parent.makeSearchSuccess(elements, response.data);
                } else {
                    parent.makeSearchFail(elements);
                }

            }
        });
    },

    /**
     * 부모창에 주소,우편번호 입력 - JP
     */
    onClickLayerResultJP : function(evt) {

        var elements = evt.data.elements;

        var zip1 = evt.data.zipcode.substr(0, 3);
        var zip2 = evt.data.zipcode.substr(4, 4);
        var aAddr = $(this).attr('addr').split("|",3);

        if (elements.cityId.length > 0 && elements.stateId.length > 0 ) {
            elements.cityId.val( aAddr[0] );
            elements.stateId.val( aAddr[1] );
            elements.addr.val( aAddr[2] );
        } else {
            elements.addr.val( $(this).attr('addr') );
        }

        if ( elements.zip2.length > 0 ) {
            elements.zip1.val(zip1);
            elements.zip2.val(zip2);
        } else {
            elements.zip1.val( zip1+'-'+zip2 );
        }

        // 해외몰 지역별배송비 부과를 위해 event발생
        try {
            if (elements.zip1.attr('id') == 'fzipcode') {
                parent.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
            }
        } catch (e) {}

        top.$('#zipcodeLayer').remove();
    },

    /**
     * 부모창에 주소,우편번호 입력 - KR
     */
    onClickLayerResult : function(evt) {

        var elements = evt.data.elements;

        var zip1 = $(this).text().substr(0, 3);
        var zip2 = $(this).text().substr(4, 3);
        var addr = $(this).attr('addr');

        addr = $.trim(addr);
        elements.addr.val(addr);

        elements.zip1.val(zip1);
        elements.zip2.val(zip2);

        if (parent.$('.tSubmit2').offset() != undefined) parent.$('html, body').animate({scrollTop: parent.$('.tSubmit2').offset().top}, 0);

        // 국내몰 지역별 배송비 부과를 위해 event 발생
        try{ 
            opener.EC_SHOP_FRONT_ORDERFORM_SHIPPING.exec();

        } catch (e){}

        // 해외몰 지역별배송비 부과를 위해 event발생
        try {
            if (elements.zip1.attr('id') == 'fzipcode') {
                parent.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
                parent.EC_SHOP_FRONT_ORDERFORM_APP_DELIVERY.exec.doAddressChange();
            }
        } catch (e) {}

        parent.$('#zipcodeLayer').remove();
    },

    /**
     * 클릭 - 검색 결과 항목
     */
    onClickResult : function(evt) {

        var elements = evt.data.elements;

        var zip1 = $(this).text().substr(0, 3);
        var zip2 = $(this).text().substr(4, 3);
        var addr = $(this).attr('addr');

        addr = $.trim(addr);

        if ( elements.zip2 != undefined ) {
            elements.zip1.val(zip1);
            elements.zip2.val(zip2);
        } else {
            elements.zip1.val( $(this).text() );
        }

        elements.addr.val(addr);

        // 모바일웹일 경우 레이어창 닫기
        if (agent.indexOf('iphone') != -1 || agent.indexOf('android') != -1) {
            if (window.top.document.getElementById('frm_order_act')) {//ECHOSTING-42532
                //frm_order_act는 주문서작성페이지에 있는 폼객체의 id값
                //order.html같은 페이지주소를 이용하지 않는 이유는
                //스디의 특성상 페이지주소는 사용자에 의해 변동될수있기때문에 페이지주소보다는 사용자가 파일명을 수정한다고해도
                //주문서작성페이지라면 꼭 존재하는 객체를 기준으로 잡았음
               top.$('input, a, select, button, textarea, .trigger').show();
            }
            if (top.$('.tSubmit2').offset() != undefined) top.$('html, body').animate({scrollTop: top.$('.tSubmit2').offset().top}, 0);

            // 해외몰 지역별배송비 부과를 위해 event발생
            try {
                if (elements.zip1.attr('id') == 'fzipcode') {
                    top.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
                }
            } catch (e) {}

            top.$('#zipcodeLayer').remove();
        } else {
            window.self.close();
        }
    }
};
;

/**
 * 엘리먼트 종류별 값 가져오기 form 에 의한 동일한 name 값 구별
 *
 * - 오브젝트를 받아서 사용할 수 있게함.
 *
 * @param String id
 * @return
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>, 이재욱 <jwlee03@simplexi.com>
 */
AuthSSLManager.getValue = function(id) {
    //id 가 string인 경우
    if (typeof id == 'string') {
        var divide, o, type;

        divide = id.split('::');
        if (divide.length == 1) {
            o = document.getElementsByName(id);
        } else {
            var frm = divide[0], id = divide[1];

            // radio, checkbox
            if ($('#'+ $.escapeSelector(id)).length==0) {
                val = this.checkbox({'name': id, 'mode': 'val'});
                return val;
            }
            o = document.forms[frm][id];
        }

        if ( o == null || o == undefined || o.value == null || o.value == undefined ) {
            o = document.getElementsByName(id);
            // 전체 html 에선 id 값이 있지만 form 밖에 있을수 있으므로 조건추가 (ECHOSTING-265537)
            val = (o[0] == undefined) ? '' : o[0].value;
        } else {
            val = o.value;
        }

        return val;

    } else if (typeof id == 'object') {
        //id가 object인 경우

        //오직 하나의 오브젝트에 대해서만 처리
        if ($(id).length == 1) {
            return $(id).val();
        } else {
            return ''
        }

    } else {
        // id가 string 또는 object가 아닐 경우 빈 값 리턴
        return '';
    }
};

/**
 * 엘리먼트 종류별 값 가져오기 form 에 의한 동일한 name 값 구별
 * @param String id
 * @return
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>
 */
AuthSSLManager.getValuePay = function(id) {
    var divide, o, type;

    // id가 string이 아닐 경우 빈 값 리턴
    if (typeof id != 'string') return '';

    divide = id.split('::');
    var frm = divide[0], id = divide[1];

    // radio, checkbox
    if ($('#'+id).length==0) {
        val = this.checkbox({'name': id, 'mode': 'val'});
        return val;
    }

    o = document.forms[frm][id];

    if ( o == null || o == undefined || o.value == null || o.value == undefined ) {
        o = document.getElementsByName(id);
        val = o[0].value;
    } else {
        val = o.value;
    }

    return val;
};

/**
 * 암호화 param 데이터 세팅
 * @param array param 암호화 관련
 * @return string p 암호화 param
 * @author 박난하 <nhpark@simplexi.com>
 * */
AuthSSLManager.setParam = function(param) {
    var p = [];
        if (param['auth_mode'] == 'encrypt1.9') {
            p.push('auth_mode=encrypt');
        } else {
            p.push('auth_mode=' + param['auth_mode']);
        }
        p.push('auth_callbackName=' + param['auth_callbackName']);
    switch(param['auth_mode']) {
        case 'encrypt1.9':
            var aEle = param['aEleId'], o, p2 = {}, v;
            var divide = '';
            var id = '';
            for ( var i in aEle ) {
                if (aEle.hasOwnProperty(i) == false) continue;
                v = this.getValuePay(aEle[i]);

                if ( v == -1 ) continue;

                divide = aEle[i].split('::');
                id = divide[1];

                p2[id] = this.getValuePay(aEle[i]);
            }
            p.push('auth_string=' + encodeURIComponent(__JSON.stringify(p2)));
            break;
        case 'encrypt':
            var aEle = param['aEleId'], o, p2 = {}, v;
            for ( var i in aEle ) {
                if (aEle.hasOwnProperty(i) == false) continue;
                v = this.getValue(aEle[i]);

                if ( v == -1 ) continue;

                //암호화 대상이 오브젝트인경우 id값이 key가 된다.
                if (typeof aEle[i] == 'object') {
                    p2[$(aEle[i]).attr('id')] = this.getValue(aEle[i]);
                } else {
                    p2[aEle[i]] = this.getValue(aEle[i]);
                }
            }
            p.push('auth_string=' + encodeURIComponent(__JSON.stringify(p2)));
            break;
        case 'decrypt':
        case 'decryptClient':
            p.push('auth_string=' + encodeURIComponent(param['auth_string']));
            break;
    }

    return p;
};


/**
 * radio, checkbox 값 가져오기
 * @param object options 옵션
 * @return string radio 또는 checkbox value 반환
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>
 * */
AuthSSLManager.checkbox = function(options)
{
    var o = document.getElementsByName(options.name);
    if ( o == null ) return;

    // element 없음
    if (o.length<1) {
        var chk = false;
        var o = document.getElementById(options.name);
        if ( o == null ) return '';
        if ( o.checked == true ) var chk = true;
        return chk == true ? o.value : '';
    }

    var bChecked = false;
    var aChk = new Array();
    for ( var i = 0; i < o.length; i++ ) {
        var el = $('#'+o[i].id);

        if ( el.attr('checked') == true ) {
            // RADIO
            if (el.attr('type') == 'radio') return el.val();
            // CHECKBOX
            else if (el.attr('type') == 'checkbox') {
                aChk.push(el.val());
                bChecked = true;
            }
        }
    }

    if ( options.mode == 'val' ) {
        if (bChecked == false) return '';

        if (aChk.length>0) return aChk.join('|');
    }
};






/**
 * AuthSSL을 통해 submit을 할 폼 클래스
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var FormSSL = function()
{
    /**
     * 폼 아이디
     * @var string
     * */
    this.sFormId = null;
    /**
     * 암호화 시킬 엘리먼트 id 배열
     * @var array
     * */
    this.aEleId  = null;

    /**
     * onsubmit bind
     * @param string sFormId bind 할 폼 아이디
     * @param array  aEleId  암호화할 엘리먼트 id 배열
     * */
    this.bind = function(sFormId, aEleId)
    {
        var self = this;

        this.sFormId = sFormId;
        this.aEleId  = aEleId;

        var oForm = $('#'+sFormId);
        oForm.unbind('submit');
        oForm.bind('submit', function(){
            AuthSSL.Submit(self.sFormId, self.aEleId);

            return false;
        });
    };

    /**
     * AuthSSL submit 실행
     * */
    this.submit = function()
    {
        AuthSSL.Submit(this.sFormId, this.aEleId);
        return false;
    };
};


/**
 * AuthSSL 폼 객체 리스트 관리
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var FormSSLContainer = {
    /**
     * 폼 객체 리스트
     * @var object
     * */
    aFormSSL: {},

    /**
     * 폼 객체 생성 및 리스트에 추가
     * @param string sFormId 객체로 생성할 폼 아이디
     * @param array  aEleId  암호화 할 엘리먼트 아이디
     * */
    create: function (sFormId, aEleId)
    {
        if (this.formExists(sFormId)==false) {
            var oFormSSL = new FormSSL();
            oFormSSL.bind(sFormId, aEleId);
            this.aFormSSL[sFormId] = oFormSSL;
        }
    },

    /**
     * 폼 아이디로 AuthSSL submit 실행
     * @param string sFormId 폼 아이디
     * */
    submit: function (sFormId)
    {
        if (this.formExists(sFormId)==false) return;

        this.aFormSSL[sFormId].submit();
    },

    /**
     * 폼 아이디로 FormSSLContainer에 해당 폼이 있는지 체크
     * @param string sFormId 체크할 폼 아이디
     * @return bool 폼이 있으면 true, 없으면 false
     * */
    formExists: function (sFormId)
    {
        if (!this.aFormSSL[sFormId]) return false;
        else return true;
    }
};



/**
 * AuthSSL 클래스
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var AuthSSL = {
    /**
     * SSL on/off
     * @var bool
     * */
    bIsSsl : true,
    /**
     * 폼 아이디
     * @var string
     * */
    sFormId : null,
    /**
     * 엘리먼트 아이디
     * @var array
     * */
    aEleId : null,
    /**
     * 폼 객체 (jQuery)
     * @var object
     * */
    oFormSubmit: null,
    /**
     * 암호화 된 문자열이 저장될 input hidden id
     * @var string
     * */
    sEncryptId : 'encrypted_str',
    /**
     * callback 함수 이름
     * @var string
     * */
    sCallbackName : 'AuthSSL.encryptSubmit_Complete',

    /**
     * 멤버변수 세팅
     * @param string sFormId 폼 아이디
     * @param array  aEleId  엘리먼트 아이디
     * */
    init: function(sFormId, aEleId)
    {
        this.sFormId = sFormId;
        this.aEleId  = aEleId;
        this.oFormSubmit = $('#' + sFormId);
    },

    /**
     * AuthSSLManager 존재여부 체크
     * @return bool 존재하면 true, 아니면 false 반환
     * */
    checkAvailable: function()
    {
        // AuthSSLManager가 없음
        if (typeof AuthSSLManager!='object') {
            alert('[Error]\nneed SSL Manager');
            return false;
        }

        return true;
    },

    /**
     * onsubmit bind
     * @param string sFormId 폼 아이디
     * @param array  aEleId  암호화하고자 하는 필드의 id
     * */
    Bind: function(sFormId, aEleId)
    {
        FormSSLContainer.create(sFormId, aEleId);
    },

    /**
     * 암호화 요청 함수 - submit
     * @param string sFormId 폼 아이디
     * @param array  aEleId  엘리먼트 아이디
     * */
    Submit: function(sFormId, aEleId) {
        // AuthSSLManager 존재여부 체크
        if (this.checkAvailable()==false) return false;

        // 폼 아이디, 엘리먼트 아이디 세팅
        this.init(sFormId, aEleId);

        // 암호화 요청이 아닐 경우 그냥 submit
        if (this.bIsSsl == false) {
            this.disabledSslSubmit();
            return false;
        }

        // 암호화 된 값을 받을 input_hidden 생성
        var oInput = document.createElement('input');
        oInput.type = 'hidden';
        oInput.name = oInput.id = this.sEncryptId;
        this.oFormSubmit.append(oInput);

        // 암호화 요청
        this.encrypt(this.aEleId, this.sCallbackName);
    },

    /**
     * 암호화 요청
     * @param array aEleId 암호화할 엘리먼트 id
     * @param string sCallbackName 콜백함수 이름
     * */
    encrypt: function(aEleId, sCallbackName) {
        AuthSSLManager.weave({
            'auth_mode'        : 'encrypt',
            'aEleId'           : aEleId,
            'auth_callbackName': sCallbackName
        });
    },

    /**
     * 암호화 처리결과 callback 함수
     * @param string sOutput 암호화 된 처리결과
     * */
    encryptSubmit_Complete: function(sOutput) {
        // Error
        if ( AuthSSLManager.isError(sOutput) == true ) {
            alert('[Error]\n'+sOutput);
            return;
        }

        // 암호화 처리된 엘리먼트의 value 제거
        this.delInputValue();

        // input_hidden에 암호화 된 결과값 대입
        this.oFormSubmit.find('[id="'+this.sEncryptId+'"]').val(sOutput);

        // Form Submit
        this.oFormSubmit.unbind('submit');

        this.delInputValue();

        this.oFormSubmit.submit();
    },

    /**
     * INPUT.RADIO, INPUT.CHECKBOX의 value 지움
     * @param string sName 값을 지우고자 하는 element의 name
     * */
    delRadioValue: function(sName) {
        var oEle = document.getElementsByName(sName);
        if (oEle.length>0) {

            for (var i = 0; i < oEle.length; i++) {

                oEle[i].value = '';

                if (oEle[i].defaultValue) {

                    oEle[i].defaultValue = '';
                }
            }
        }
    },

    /**
     * 암호화 될 폼 요소들의 값을 지움
     */
    delInputValue : function() {
        for (var i=0; i<this.aEleId.length; i++) {

            // 값을 지울 element의 id 가져오기
            var sID = AuthSSL.getEleId(this.aEleId[i]);
            var oEle = this.oFormSubmit.find('[id="' + sID + '"]');

            // id를 표기하지 않고 name만 표기한 radio, checkbox
            if (oEle.length == 0) {

                this.delRadioValue(sID);
                continue;
            }

            // SELECT
            if (oEle.is('SELECT')) {

                var oSelect = oEle.children('option:selected');
                oSelect.val('');
                oSelect.attr('value', '');
                oSelect.attr('defaultValue', '');
            }
            // INPUT.TEXT, INPUT.PASSWORD, TEXTAREA
            else {

                oEle.val('');
                oEle.attr('value', '');
                oEle.attr('defaultValue', '');
            }
        } // for
    },

    /**
     * 넘겨받은 id에서 폼 아이디와 구분자를 제거하여 가져오기
     * @param string sOrgID 원본 폼 아이디
     * @return string 폼 아이디와 구분자가 제거된 아이디 반환
     * */
    getEleId: function(sOrgID)
    {
        var sID = sOrgID;
        if (/::/.test(sID)==true) {
            var aTmp = sID.split('::');
            sID = aTmp[1];
        }

        return sID;
    },

    /**
     * bIsSsl이 false 일때 실행
     */
    disabledSslSubmit : function() {
        this.oFormSubmit.unbind('submit');
        this.oFormSubmit.submit();
    }
};


// validator submit hook
$(document).ready(function(){
    if (typeof FwValidator == 'undefined') return;

    FwValidator.Handler.setBeforeSubmit(function(elmForm){
        // AuthSSL 사용폼
        if (FormSSLContainer.formExists(elmForm.attr('id'))==true) {
            if (!FormSSLContainer) return true;

            FormSSLContainer.submit(elmForm.attr('id'));
            return false;
        }

        // AuthSSL 사용폼이 아닐 경우 그냥 submit
        return true;
    });
});

/**
 * 접속통계 & 실시간접속통계
 */
$(document).ready(function(){
    // 이미 weblog.js 실행 되었을 경우 종료 
    if ($('#log_realtime').length > 0) {
        return;
    }
    /*
     * QueryString에서 디버그 표시 제거
     */
    function stripDebug(sLocation)
    {
        if (typeof sLocation != 'string') return '';

        sLocation = sLocation.replace(/^d[=]*[\d]*[&]*$/, '');
        sLocation = sLocation.replace(/^d[=]*[\d]*[&]/, '');
        sLocation = sLocation.replace(/(&d&|&d[=]*[\d]*[&]*)/, '&');

        return sLocation;
    }

    // 벤트 몰이 아닐 경우에만 V3(IFrame)을 로드합니다.
    // @date 190117
    // @date 191217 - 이벤트에도 V3 상시 적재로 변경.
    //if (EC_FRONT_JS_CONFIG_MANAGE.sWebLogEventFlag == "F")
    //{
    // T 일 경우 IFRAME 을 노출하지 않는다.
    if (EC_FRONT_JS_CONFIG_MANAGE.sWebLogOffFlag == "F")
    {
        if (window.self == window.top) {
            var rloc = escape(document.location);
            var rref = escape(document.referrer);
        } else {
            var rloc = (document.location).pathname;
            var rref = '';
        }

        // realconn & Ad aggregation
        var _aPrs = new Array();
        _sUserQs = window.location.search.substring(1);
        _sUserQs = stripDebug(_sUserQs);
        _aPrs[0] = 'rloc=' + rloc;
        _aPrs[1] = 'rref=' + rref;
        _aPrs[2] = 'udim=' + window.screen.width + '*' + window.screen.height;
        _aPrs[3] = 'rserv=' + aLogData.log_server2;
        _aPrs[4] = 'cid=' + eclog.getCid();
        _aPrs[5] = 'role_path=' + $('meta[name="path_role"]').attr('content');
        _aPrs[6] = 'stype=' + aLogData.stype;
        _aPrs[7] = 'shop_no=' + aLogData.shop_no;
        _aPrs[8] = 'lang=' + aLogData.lang;
        _aPrs[9] = 'ver=' + aLogData.ver;


        // 모바일웹일 경우 추가 파라미터 생성
        var _sMobilePrs = '';
        if (mobileWeb === true) _sMobilePrs = '&mobile=T&mobile_ver=new';

        _sUrlQs = _sUserQs + '&' + _aPrs.join('&') + _sMobilePrs;

        var _sUrlFull = '/exec/front/eclog/main/?' + _sUrlQs;

        var node = document.createElement('iframe');
        node.setAttribute('src', _sUrlFull);
        node.setAttribute('id', 'log_realtime');
        document.body.appendChild(node);

        $('#log_realtime').hide();
    }

    // eclog2.0, eclog1.9
    var sTime = new Date().getTime();//ECHOSTING-54575

    // 접속통계 서버값이 있다면 weblog.js 호출
    if (aLogData.log_server1 != null && aLogData.log_server1 != '') {
        var sScriptSrc = '//' + aLogData.log_server1 + '/weblog.js?uid=' + aLogData.mid + '&uname=' + aLogData.mid + '&r_ref=' + document.referrer + '&shop_no=' + aLogData.shop_no;
        if (mobileWeb === true) sScriptSrc += '&cafe_ec=mobile';
        sScriptSrc += '&t=' + sTime;//ECHOSTING-54575
        var node = document.createElement('script');
        node.setAttribute('type', 'text/javascript');
        node.setAttribute('src', sScriptSrc);
        node.setAttribute('id', 'log_script');
        document.body.appendChild(node);
    }
});

/**
 * 쇼핑몰 금액 라이브러리
 */
var SHOP_PRICE = {

    /**
     * iShopNo 쇼핑몰의 결제화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float|string
     */
    toShopPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 정보
        var aCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;

        return SHOP_PRICE.toPrice(fPrice, aCurrencyInfo, bIsNumberFormat);
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float|string
     */
    toShopSubPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 참조화폐 정보
        var aSubCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo;

        if ( ! aSubCurrencyInfo) {
            // 참조화폐가 없으면
            return '';

        } else {
            // 결제화폐 정보
            var aCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;
            if (aSubCurrencyInfo.currency_code === aCurrencyInfo.currency_code) {
                // 결제화폐와 참조화폐가 동일하면
                return '';
            } else {
                return SHOP_PRICE.toPrice(fPrice, aSubCurrencyInfo, bIsNumberFormat);
            }
        }
    },

    /**
     * 쇼핑몰의 기준화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float
     */
    toBasePrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 기준화폐 정보
        var aBaseCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo;

        return SHOP_PRICE.toPrice(fPrice, aBaseCurrencyInfo, bIsNumberFormat);
    },

    /**
     * 결제화폐 금액을 참조화폐 금액으로 변환하여 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float 참조화폐 금액
     */
    shopPriceToSubPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 금액 => 참조화폐 금액
        fPrice = fPrice * (SHOP_CURRENCY_INFO[iShopNo].fExchangeSubRate || 0);

        return SHOP_PRICE.toShopSubPrice(fPrice, bIsNumberFormat, iShopNo);
    },

    /**
     * 결제화폐 대비 기준화폐 환율 리턴
     * @param int iShopNo 쇼핑몰번호
     * @return float 결제화폐 대비 기준화폐 환율
     */
    getRate: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        return SHOP_CURRENCY_INFO[iShopNo].fExchangeRate;
    },

    /**
     * 결제화폐 대비 참조화폐 환율 리턴
     * @param int iShopNo 쇼핑몰번호
     * @return float 결제화폐 대비 참조화폐 환율 (참조화폐가 없는 경우 null을 리턴합니다.)
     */
    getSubRate: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        return SHOP_CURRENCY_INFO[iShopNo].fExchangeSubRate;;
    },

    /**
     * 금액을 원하는 화폐코드의 제약조건(소수점 절삭)에 맞춰 리턴합니다.
     * @param float fPrice 금액
     * @param string aCurrencyInfo 원하는 화폐의 화폐 정보
     * @param bool bIsNumberFormat number_format 적용 유무
     * @return float|string
     */
    toPrice: function(fPrice, aCurrencyInfo, bIsNumberFormat)
    {
        // 소수점 아래 절삭
        var iPow = Math.pow(10, aCurrencyInfo['decimal_place']);
        fPrice = fPrice * iPow;
        if (aCurrencyInfo['round_method_type'] === 'F') {
            fPrice = Math.floor(fPrice);
        } else if (aCurrencyInfo['round_method_type'] === 'C') {
            fPrice = Math.ceil(fPrice);
        } else {
            fPrice = Math.round(fPrice);
        }
        fPrice = fPrice / iPow;

        if ( ! fPrice) {
            // 가격이 없는 경우
            return 0;

        } else if (bIsNumberFormat === true) {
            // 3자리씩 ,로 끊어서 리턴
            var sPrice = fPrice.toFixed(aCurrencyInfo['decimal_place']);
            var regexp = /^(-?[0-9]+)([0-9]{3})($|\.|,)/;
            while (regexp.test(sPrice)) {
                sPrice = sPrice.replace(regexp, "$1,$2$3");
            }
            return sPrice;

        } else {
            // 숫자만 리턴
            return fPrice;

        }
    }    
};

/**
 * 화폐 포맷
 */
var SHOP_CURRENCY_FORMAT = {
    /**
     * 어드민 페이지인지
     * @var bool
     */
    _bIsAdmin: /^\/(admin\/php|disp\/admin|exec\/admin)\//.test(location.pathname) ? true : false,

    /**
     * iShopNo 쇼핑몰의 결제화폐 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getShopCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 코드
        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.currency_code;

        if (SHOP_CURRENCY_FORMAT._bIsAdmin === true) {
            // 어드민

            // 기준화폐 코드
            var sBaseCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.currency_code;

            if (sCurrencyCode === sBaseCurrencyCode) {
                // 결제화폐와 기준화폐가 동일한 경우
                return {
                    'head': '',
                    'tail': ''
                };

            } else {
                return {
                    'head': sCurrencyCode + ' ',
                    'tail': ''
                };
            }

        } else {
            // 프론트
            return SHOP_CURRENCY_INFO[iShopNo].aFrontCurrencyFormat;
        }
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐의 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getShopSubCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 참조화폐 정보
        var aSubCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo;

        if ( ! aSubCurrencyInfo) {
            // 참조화폐가 없으면
            return {
                'head': '',
                'tail': ''
            };

        } else if (SHOP_CURRENCY_FORMAT._bIsAdmin === true) {
            // 어드민
            return {
                'head': '(' + aSubCurrencyInfo.currency_code + ' ',
                'tail': ')'
            };

        } else {
            // 프론트
            return SHOP_CURRENCY_INFO[iShopNo].aFrontSubCurrencyFormat;
        }

    },

    /**
     * 쇼핑몰의 기준화폐의 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getBaseCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 기준화폐 코드
        var sBaseCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.currency_code;

        // 결제화폐 코드
        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.currency_code;

        if (sCurrencyCode === sBaseCurrencyCode) {
            // 기준화폐와 결제화폐가 동일하면
            return {
                'head': '',
                'tail': ''
            };

        } else {
            // 어드민
            return {
                'head': '(' + sBaseCurrencyCode + ' ',
                'tail': ')'
            };

        }
    },

    /**
     * 금액 입력란 화폐 포맷용 head,tail
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getInputFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;

        // 멀티쇼핑몰이 아니고 단위가 '원화'인 경우
        if (SHOP.isMultiShop() === false && sCurrencyCode === 'KRW') {
            return {
                'head': '',
                'tail': '원'
            };

        } else {
            return {
                'head': '',
                'tail': sCurrencyCode
            };
        }
    },

    /**
     * 해당몰 결제 화폐 코드 반환
     * ECHOSTING-266141 대응
     * 국문 기본몰 일 경우에는 화폐코드가 아닌 '원' 으로 반환
     *
     * @param int iShopNo 쇼핑몰번호
     * @return string currency_code
     */
    getCurrencyCode: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.currency_code;

        // 멀티쇼핑몰이 아니고 단위가 '원화'인 경우
        if (SHOP.isMultiShop() === false && sCurrencyCode === 'KRW') {
            return '원';
        } else {
            return sCurrencyCode
        }
    }

};

/**
 * 금액 포맷
 */
var SHOP_PRICE_FORMAT = {
    /**
     * iShopNo 쇼핑몰의 결제화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toShopPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toShopSubPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopSubCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toShopSubPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * 쇼핑몰의 기준화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toBasePrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getBaseCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toBasePrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * 결제화폐 금액을 참조화폐 금액으로 변환하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    shopPriceToSubPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopSubCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.shopPriceToSubPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },
    

    /**
     * 금액을 적립금 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopMileagePrice: function (fPrice, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;
        
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sMileageUnit != 'undefined' && $.trim(sMileageUnit) != '') {
            sConvertMileageUnit = sMileageUnit.replace('[:PRICE:]', sPrice);
            return sConvertMileageUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    },

    /**
     * 금액을 예치금 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopDepositPrice: function (fPrice, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;
        
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sDepositUnit != 'undefined' || $.trim(sDepositUnit) != '') {
            return sPrice + sDepositUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    },

    /**
     * 금액을 부가결제수단(통합포인트) 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopAddpaymentPrice: function (fPrice, sAddpaymentUnit, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sDepositUnit != 'undefined' || $.trim(sDepositUnit) != '') {
            return sPrice + sAddpaymentUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    },

    /**
     * 포맷을 제외한 금액정보만 리턴합니다.
     * @param {string} sFormattedPrice
     * @returns {string}
     */
    detachFormat: function(sFormattedPrice) {
        if (typeof sFormattedPrice === 'undefined' || sFormattedPrice === null) {
            return '0';
        }

        var sPattern = /[0-9.]/;
        var sPrice = '';
        for (var i = 0; i < sFormattedPrice.length; i++) {
            if (sPattern.test(sFormattedPrice[i])) {
                sPrice += sFormattedPrice[i];
            }
        }

        return sPrice;
    }
};

var SHOP_PRICE_UTIL = {
    /**
     * iShopNo 쇼핑몰의 결제화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     * @param bool bUseMinus 마이너스 입력 사용 여부
     */
    toShopPriceInput: function(elem, iShopNo, bUseMinus)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.decimal_place;
        bUseMinus ? SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace, bUseMinus) : SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     */
    toShopSubPriceInput: function(elem, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo.decimal_place;
        SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * iShopNo 쇼핑몰의 기준화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     */
    toBasePriceInput: function(elem, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.decimal_place;
        SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * 소수점 iDecimalPlace까지만 입력 가능하도록 처리
     * @param Element elem 입력폼
     * @param int iDecimalPlace 허용 소수점
     * @param bool bUseMinus 마이너스 입력 사용 여부
     */
    _toPriceInput: function(elem, iDecimalPlace, bUseMinus)
    {
        attachEvent(elem, 'keyup', function(e) {
            e = e || window.event;
            bUseMinus ? replaceToMinusPrice(e.srcElement) : replaceToPrice(e.srcElement);
        });
        attachEvent(elem, 'blur', function(e) {
            e = e || window.event;
            bUseMinus ? replaceToMinusPrice(e.srcElement) : replaceToPrice(e.srcElement);
        });

        // 추가금액에서 마이너스를 입력받기 위해 사용
        function replaceToMinusPrice(target) {
            var value = target.value;

            var regExpTest = new RegExp('^[0-9]*' + (iDecimalPlace ? '' : '\\.[0-9]{0, ' + iDecimalPlace + '}' ) + '$');

            if (regExpTest.test(value) === false) {
                value = value.replace(/[^0-9.|\-]/g, '');
                if (parseInt(iDecimalPlace)) {
                    value = value.replace(/^([0-9]+\.[0-9]+)\.+.*$/, '$1');
                    value = value.replace(new RegExp('(\\.[0-9]{' + iDecimalPlace + '})[0-9]*$'), '$1');
                } else {
                    value = value.replace(/[^(0-9|\-)]/g, '');
                }
                target.value = value;
            }
        }

        function replaceToPrice(target)
        {
            var value = target.value;

            var regExpTest = new RegExp('^[0-9]*' + (iDecimalPlace ? '' : '\\.[0-9]{0, ' + iDecimalPlace + '}' ) + '$');
            if (regExpTest.test(value) === false) {
                value = value.replace(/[^0-9.]/g, '');
                if (parseInt(iDecimalPlace)) {
                    value = value.replace(/^([0-9]+\.[0-9]+)\.+.*$/, '$1');
                    value = value.replace(new RegExp('(\\.[0-9]{' + iDecimalPlace + '})[0-9]*$'), '$1');
                } else {
                    value = value.replace(/\.+[0-9]*$/, '');
                }
                target.value = value;
            }
        }

        function attachEvent(elem, sEventName, fn)
        {
            if ( elem.addEventListener ) {
                elem.addEventListener( sEventName, fn, false );

            } else if ( elem.attachEvent ) {
                elem.attachEvent( "on" + sEventName, fn );
            }
        }

    }
};

if (window.jQuery !== undefined) {
    $.fn.extend({
        toShopPriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toShopPriceInput(this, iElementShopNo);
            });
        },
        toShopSubPriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toShopSubPriceInput(this, iElementShopNo);
            });
        },
        toBasePriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toBasePriceInput(this, iElementShopNo);
            });
        }
    });
}

(function(window){
    window.htmlentities = {
        /**
         * Converts a string to its html characters completely.
         *
         * @param {String} str String with unescaped HTML characters
         **/
        encode : function(str) {
            var buf = [];

            for (var i=str.length-1;i>=0;i--) {
                buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
            }

            return buf.join('');
        },
        /**
         * Converts an html characterSet into its original character.
         *
         * @param {String} str htmlSet entities
         **/
        decode : function(str) {
            return str.replace(/&#(\d+);/g, function(match, dec) {
                return String.fromCharCode(dec);
            });
        }
    };
})(window);
/**
 * 비동기식 데이터
 */
var CAPP_ASYNC_METHODS = {
    DEBUG: false,
    IS_LOGIN: (document.cookie.match(/(?:^| |;)iscache=F/) ? true : false),
    EC_PATH_ROLE: $('meta[name="path_role"]').attr('content') || '',
    aDatasetList: [],
    $xansMyshopMain: $('.xans-myshop-main'),
    init : function()
    {
    	var bDebug = CAPP_ASYNC_METHODS.DEBUG;

        var aUseModules = [];
        var aNoCachedModules = [];

        $(CAPP_ASYNC_METHODS.aDatasetList).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (bDebug) {
                console.log(sKey);
            }
            var bIsUse = oTarget.isUse();
            if (bDebug) {
                console.log('   isUse() : ' + bIsUse);
            }

            if (bIsUse === true) {
                aUseModules.push(sKey);

                if (oTarget.restoreCache === undefined || oTarget.restoreCache() === false) {
                    if (bDebug) {
                        console.log('   restoreCache() : true');
                    }
                    aNoCachedModules.push(sKey);
                }
            }
        });

        if (aNoCachedModules.length > 0) {
            var sEditor = '';
            try {
                if (bEditor === true) {
                    // 에디터에서 접근했을 경우 임의의 상품 지정
                    sEditor = '&PREVIEW_SDE=1';
                }
            } catch(e) { }

            var sPathRole = '&path_role=' + CAPP_ASYNC_METHODS.EC_PATH_ROLE;

            $.ajax(
            {
                url : '/exec/front/manage/async?module=' + aNoCachedModules.join(',') + sEditor + sPathRole,
                dataType : 'json',
                success : function(aData)
                {
                	CAPP_ASYNC_METHODS.setData(aData, aUseModules);
                }
            });

        } else {
        	CAPP_ASYNC_METHODS.setData({}, aUseModules);

        }
    },
    setData : function(aData, aUseModules)
    {
        aData = aData || {};

        $(aUseModules).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (oTarget.setData !== undefined && aData.hasOwnProperty(sKey) === true) {
                oTarget.setData(aData[sKey]);
            }

            if (oTarget.execute !== undefined) {
                oTarget.execute();
            }
        });
    },

    _getCookie: function(sCookieName)
    {
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        return aCookieValue ? aCookieValue[1] : null;
    }
};
/**
 * 비동기식 데이터 - 회원 정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('member');
CAPP_ASYNC_METHODS.member = {
    __sEncryptedString: null,
    __isAdult: 'F',

    // 회원 데이터
    __sMemberId: null,
    __sName: null,
    __sNickName: null,
    __sGroupName: null,
    __sEmail: null,
    __sPhone: null,
    __sCellphone: null,
    __sBirthday: null,
    __sGroupNo: null,
    __sBoardWriteName: null,
    __sAdditionalInformation: null,
    __sCreatedDate: null,

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if ($('.xans-layout-statelogon, .xans-layout-logon').length > 0) {
                return true;
            }

            if (CAPP_ASYNC_METHODS.recent.isUse() === true
                && typeof(EC_FRONT_JS_CONFIG_SHOP) !== 'undefined'
                && EC_FRONT_JS_CONFIG_SHOP.adult19Warning === 'T') {
                return true;
            }

            if ( typeof EC_APPSCRIPT_SDK_DATA != "undefined" && jQuery.inArray('customer', EC_APPSCRIPT_SDK_DATA ) > -1 ) {
                return true;
            }

        } else {
            // 비 로그인 상태에서 삭제처리
            this.removeCache();
        }

        return false;
    },

    restoreCache: function()
    {
        // sessionStorage 지원 여부 확인
        if (!window.sessionStorage) {
            return false;
        }

        // 데이터 복구 유무
        var bRestored = false;

        try {
            // 데이터 복구
            var oCache = JSON.parse(window.sessionStorage.getItem('member_' + EC_SDE_SHOP_NUM));

            // expire 체크
            if (oCache.exp < Date.now()) {
                throw 'cache has expired.';
            }

            // 데이터 체크
            if (typeof oCache.data.member_id === 'undefined'
                || oCache.data.member_id === ''
                || typeof oCache.data.name === 'undefined'
                || typeof oCache.data.nick_name === 'undefined'
                || typeof oCache.data.group_name === 'undefined'
                || typeof oCache.data.group_no === 'undefined'
                || typeof oCache.data.email === 'undefined'
                || typeof oCache.data.phone === 'undefined'
                || typeof oCache.data.cellphone === 'undefined'
                || typeof oCache.data.birthday === 'undefined'
                || typeof oCache.data.board_write_name === 'undefined'
                || typeof oCache.data.additional_information === 'undefined'
                || typeof oCache.data.created_date === 'undefined'
            ) {
                throw 'Invalid cache data.'
            }

            // 데이터 복구
            this.__sMemberId = oCache.data.member_id;
            this.__sName = oCache.data.name;
            this.__sNickName = oCache.data.nick_name;
            this.__sGroupName = oCache.data.group_name;
            this.__sGroupNo   = oCache.data.group_no;
            this.__sEmail = oCache.data.email;
            this.__sPhone = oCache.data.phone;
            this.__sCellphone = oCache.data.cellphone;
            this.__sBirthday = oCache.data.birthday;
            this.__sBoardWriteName = oCache.data.board_write_name;
            this.__sAdditionalInformation = oCache.data.additional_information;
            this.__sCreatedDate = oCache.data.created_date;

            bRestored = true;
        } catch(e) {
            // 복구 실패시 캐시 삭제
            this.removeCache();
        }

        return bRestored;
    },

    cache: function()
    {
        // sessionStorage 지원 여부 확인
        if (!window.sessionStorage) {
            return;
        }

        // 캐시
        window.sessionStorage.setItem('member_' + EC_SDE_SHOP_NUM, JSON.stringify({
            exp: Date.now() + (1000 * 60 * 10),
            data: this.getData()
        }));
    },

    removeCache: function()
    {
        // sessionStorage 지원 여부 확인
        if (!window.sessionStorage) {
            return;
        }

        // 캐시 삭제
        window.sessionStorage.removeItem('member_' + EC_SDE_SHOP_NUM);
    },

    setData: function(oData)
    {
        this.__sEncryptedString = oData.memberData;
        this.__isAdult = oData.memberIsAdult;
    },

    execute: function()
    {
        if (this.__sMemberId === null) {
            AuthSSLManager.weave({
                'auth_mode'          : 'decryptClient',
                'auth_string'        : this.__sEncryptedString,
                'auth_callbackName'  : 'CAPP_ASYNC_METHODS.member.setDataCallback'
            });
        } else {
            this.render()
        }
    },

    setDataCallback: function(sData)
    {
        try {
            var sDecodedData = decodeURIComponent(sData);

            if (AuthSSLManager.isError(sDecodedData) == true) {
                console.log(sDecodedData);
                return;
            }

            var oData = AuthSSLManager.unserialize(sDecodedData);
            this.__sMemberId = oData.id || '';
            this.__sName = oData.name || '';
            this.__sNickName = oData.nick || '';
            this.__sGroupName = oData.group_name || '';
            this.__sGroupNo   = oData.group_no || '';
            this.__sEmail = oData.email || '';
            this.__sPhone = oData.phone || '';
            this.__sCellphone = oData.cellphone || '';
            this.__sBirthday = oData.birthday || 'F';
            this.__sBoardWriteName = oData.board_write_name || '';
            this.__sAdditionalInformation = oData.additional_information || '';
            this.__sCreatedDate = oData.created_date || '';

            // 데이터 랜더링
            this.render();

            // 데이터 캐시
            this.cache();
        } catch(e) {}
    },

    render: function()
    {
        // 친구초대
        if ($('.xans-myshop-asyncbenefit').length > 0) {
            $('#reco_url').attr({value: $('#reco_url').val() + this.__sMemberId});
        }

        $('.xans-member-var-id').html(this.__sMemberId);
        $('.xans-member-var-name').html(this.__sName);
        $('.xans-member-var-nick').html(this.__sNickName);
        $('.xans-member-var-group_name').html(this.__sGroupName);
        $('.xans-member-var-group_no').html(this.__sGroupNo);
        $('.xans-member-var-email').html(this.__sEmail);
        $('.xans-member-var-phone').html(this.__sPhone);

        if ($('.xans-board-commentwrite').length > 0 && typeof BOARD_COMMENT !== 'undefined') {
            BOARD_COMMENT.setCmtData();
        }
    },

    getMemberIsAdult: function()
    {
        return this.__isAdult;
    },

    getData: function()
    {
        return {
            member_id: this.__sMemberId,
            name: this.__sName,
            nick_name: this.__sNickName,
            group_name: this.__sGroupName,
            group_no: this.__sGroupNo,
            email: this.__sEmail,
            phone: this.__sPhone,
            cellphone: this.__sCellphone,
            birthday: this.__sBirthday,
            board_write_name: this.__sBoardWriteName,
            additional_information: this.__sAdditionalInformation,
            created_date: this.__sCreatedDate
        };
    }
};
/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Ordercnt');
CAPP_ASYNC_METHODS.Ordercnt = {
    __iOrderShppiedBeforeCount: null,
    __iOrderShppiedStandbyCount: null,
    __iOrderShppiedBeginCount: null,
    __iOrderShppiedComplateCount: null,
    __iOrderShppiedCancelCount: null,
    __iOrderShppiedExchangeCount: null,
    __iOrderShppiedReturnCount: null,

    __$target: $('#xans_myshop_orderstate_shppied_before_count'),
    __$target2: $('#xans_myshop_orderstate_shppied_standby_count'),
    __$target3: $('#xans_myshop_orderstate_shppied_begin_count'),
    __$target4: $('#xans_myshop_orderstate_shppied_complate_count'),
    __$target5: $('#xans_myshop_orderstate_order_cancel_count'),
    __$target6: $('#xans_myshop_orderstate_order_exchange_count'),
    __$target7: $('#xans_myshop_orderstate_order_return_count'),

    isUse: function()
    {
        if ($('.xans-myshop-orderstate').length > 0) {
            return true; 
        }

        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'ordercnt_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            var aData = jQuery.parseJSON(decodeURIComponent(aCookieValue[1]));
            this.__iOrderShppiedBeforeCount = aData.shipped_before_count;
            this.__iOrderShppiedStandbyCount = aData.shipped_standby_count;
            this.__iOrderShppiedBeginCount = aData.shipped_begin_count;
            this.__iOrderShppiedComplateCount = aData.shipped_complate_count;
            this.__iOrderShppiedCancelCount = aData.order_cancel_count;
            this.__iOrderShppiedExchangeCount = aData.order_exchange_count;
            this.__iOrderShppiedReturnCount = aData.order_return_count;
            return true;
        }

        return false;
    },

    setData: function(aData)
    {
        this.__iOrderShppiedBeforeCount = aData['shipped_before_count'];
        this.__iOrderShppiedStandbyCount = aData['shipped_standby_count'];
        this.__iOrderShppiedBeginCount = aData['shipped_begin_count'];
        this.__iOrderShppiedComplateCount = aData['shipped_complate_count'];
        this.__iOrderShppiedCancelCount = aData['order_cancel_count'];
        this.__iOrderShppiedExchangeCount = aData['order_exchange_count'];
        this.__iOrderShppiedReturnCount = aData['order_return_count'];
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderShppiedBeforeCount);
        this.__$target2.html(this.__iOrderShppiedStandbyCount);
        this.__$target3.html(this.__iOrderShppiedBeginCount);
        this.__$target4.html(this.__iOrderShppiedComplateCount);
        this.__$target5.html(this.__iOrderShppiedCancelCount);
        this.__$target6.html(this.__iOrderShppiedExchangeCount);
        this.__$target7.html(this.__iOrderShppiedReturnCount);
    },

    getData: function()
    {
        return {
            shipped_before_count: this.__iOrderShppiedBeforeCount,
            shipped_standby_count: this.__iOrderShppiedStandbyCount,
            shipped_begin_count: this.__iOrderShppiedBeginCount,
            shipped_complate_count: this.__iOrderShppiedComplateCount,
            order_cancel_count: this.__iOrderShppiedCancelCount,
            order_exchange_count: this.__iOrderShppiedExchangeCount,
            order_return_count: this.__iOrderShppiedReturnCount
        };
    }
};
