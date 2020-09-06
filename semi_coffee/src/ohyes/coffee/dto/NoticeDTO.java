package ohyes.coffee.dto;

/*
 이름               			널?       		유형            
---------------- 				-------- 		------------- 
NOTICE_NO        			NOT NULL 	NUMBER        
NOTICE_TITLE     			NOT NULL 	VARCHAR2(500)  
NOTICE_CONTENTS           			VARCHAR2(4000) 
NOTICE_DATE      		NOT NULL 	DATE          
NOTICE_READCOUNT 	NOT NULL 	NUMBER        
NOTICE_STATUS    		NOT NULL 	NUMBER(1)   
-- 0 : 삭제 1 : 임시저장 2:글올리기 
 */
public class NoticeDTO {

	private int noticeNo;
	private String noticeTitle;
	private String noticeContents;
	private String noticeDate;
	private int noticeReadcount;
	private int noticeStatus;
	
	public NoticeDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getNoticeNo() {
		return noticeNo;
	}

	public void setNoticeNo(int noticeNo) {
		this.noticeNo = noticeNo;
	}

	public String getNoticeTitle() {
		return noticeTitle;
	}

	public void setNoticeTitle(String noticeTitle) {
		this.noticeTitle = noticeTitle;
	}

	public String getNoticeContents() {
		return noticeContents;
	}

	public void setNoticeContents(String noticeContents) {
		this.noticeContents = noticeContents;
	}

	public String getNoticeDate() {
		return noticeDate;
	}

	public void setNoticeDate(String noticeDate) {
		this.noticeDate = noticeDate;
	}

	public int getNoticeReadcount() {
		return noticeReadcount;
	}

	public void setNoticeReadcount(int noticeReadcount) {
		this.noticeReadcount = noticeReadcount;
	}

	public int getNoticeStatus() {
		return noticeStatus;
	}

	public void setNoticeStatus(int noticeStatus) {
		this.noticeStatus = noticeStatus;
	}
	
	
	
	
	 
	
	
	
}
