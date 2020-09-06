package ohyes.coffee.pagination;

public class Page {
	public int num;// 현재 페이지 번호
	private int count;// 게시물 총갯수=totalBoard
	private int postNum = 10;// 한 페이지에 출력할 게시물 갯수 = pageSize
	private int pageNum;// 하단 페이징 번호 게시물총갯수 / 한페이지에 출력할갯수 의 올림
	private int displayPost;// 출력할 게시물=startRow
	private int pageNumCnt = 10;// 한번에 표시할 페이징 번호의 갯수 = blocksize
	private int endPageNum;// 표시되는 페이지 번호 중 마지막 번호=endPage
	private int startPageNum;// 표시되는 페이지 번호중 첫번째 번호=startPage
	private boolean prev;
	private boolean next;
	private int endPageNum_tmp;

	public void setNum(int num) {
		this.num = num;

	}

	public int getNum() {
		return num;
	}

	public void setCount(int count) {
		this.count = count;
		dataCalc();
	}

	public int getCount() {
		return count;
	}

	public int getPostNum() {
		return postNum;
	}

	public int getPageNum() {
		return pageNum;
	}

	public int getDisplayPost() {
		//System.out.println(displayPost);
		return displayPost;
	}

	public int getPageNumCnt() {
		return pageNumCnt;
	}

	public int getEndPageNum() {
		return endPageNum;
	}

	public int getStartPageNum() {
		return startPageNum;
	}

	public int getEndPageNum_tmp() {
		return endPageNum_tmp;
	}

	public boolean getPrev() {
		return prev;
	}

	public boolean getNext() {
		return next;
	}

	private void dataCalc() {
		//마지막번호
		endPageNum = (int) (Math.ceil((double) num / (double) pageNumCnt) * pageNumCnt);
		//시작번호
		startPageNum = endPageNum - (pageNumCnt - 1);
		//마지막 번호 재계산
		endPageNum_tmp = (int) (Math.ceil((double) count / (double) pageNumCnt));

		if (endPageNum > endPageNum_tmp) {
			endPageNum = endPageNum_tmp;
		}
		prev = startPageNum == 1 ? false : true;
		next = endPageNum * pageNumCnt >= count ? false : true;
		displayPost = (num - 1) * postNum + 1;// 출력할 게시물
		postNum *= num;
		
//		//블럭에 출력될 시작 페이지 번호를 계싼하여 저장
//		//=> 1 Block : 1, 2 Block : 6, 3Block : 11, 4Block : 16.....
//		int startPage = (pageNum-1) * blockSize * blockSize + 1;
//	
//		//블럭에 출력될 종료 페이지 번호를 계싼하여 저장
//		//=> 1 Block : 1, 2 Block : 6, 3Block : 11, 4Block : 16.....
//		int endPage = (startPage + blockSize) - 1;
//		//마지막 블럭의 종료 페이지 번호 변경
//		if(endPageNum > pageNum){
//			endPageNum = pageNum;
//		}

	}
}