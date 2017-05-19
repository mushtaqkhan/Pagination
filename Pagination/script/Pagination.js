	
	// next page
	function paginationNext(id)
	{
		// get pagination body
		var paginationBody=paginationGetBody(id);
		
		// get first and last visible page
		var pageLast=paginationGetLastPage(paginationBody);
		var pageFirst=paginationGetFirstPage(paginationBody);
		
		// get number of last page
		var pageNo=paginationGetNumber(pageLast)+1;
	
		// if last page (plus one) number is greater than number of pages then exit
		if(pageNo>PaginationArray[id]['numberOfPages']) return;

		// create page
		paginationCreatePage(id,pageNo,paginationBody,'next');
		
		// get number of visible pages
		var pageNumberVisible=paginationGetVisiblePages(paginationBody);
		
		// if number of visible pages is greater than sum of page on the left and right site, then hidden first page 
		if(pageNumberVisible>PaginationArray[id]['numberOfPagesLeftSide']+PaginationArray[id]['numberOfPagesRightSide']+1) 
			pageFirst.css('display','none');
		
		// start animation
		paginationStart(id,'next');
	}
	
	// previous page
	function paginationPrevious(id)
	{
		// get pagination body
		var paginationBody=paginationGetBody(id);
		
		// get first and last visible page
		var pageFirst=paginationGetFirstPage(paginationBody);
		var pageLast=paginationGetLastPage(paginationBody);
		
		// get number of first page
		var pageNo=paginationGetNumber(pageFirst)-1;
		
		// if first page (minus one) number is equal zero the exit from function
		if(pageNo<=0) return;
		
		// create page
		paginationCreatePage(id,pageNo,paginationBody,'previous');	
		
		// get number of visible pages
		var pageNumberVisible=paginationGetVisiblePages(paginationBody);
		
		// if number of visible pages is greater than sum of page on the left and right site, then hidden last page 
		if(pageNumberVisible>PaginationArray[id]['numberOfPagesLeftSide']+PaginationArray[id]['numberOfPagesRightSide']+1) 
			pageLast.css('display','none');
		
		// start animation
		paginationStart(id,'previous');
	}
	
	// stop animation
	function paginationStop(id)
	{
		window.clearTimeout(PaginationArray[id]['clock']);
	}
	
	// start animation
	function paginationStart(id,type)
	{
		PaginationArray[id]['clock']=window.setTimeout(function () { type=='next' ? paginationNext(id) : paginationPrevious(id); },200);	
	}

	// create page
	function paginationCreatePage(id,pageNo,paginationBody,type)
	{
		// get the page number which has to be create
		var page=paginationPageExists(pageNo,paginationBody);
	
		// if page doesn't exists
		if(page.length==0)
		{
			// create new page
			var page=$(document.createElement('a'));
			
			page.attr('class','paginationPage');
			page.attr('title',paginatonCreateTitle(id,pageNo));
			page.attr('href',PaginationArray[id]['ajax'] ? 'javascript:paginationGoToPage('+pageNo+',\''+id+'\');' : PaginationArray[id]['link']+pageNo);
			
			page.text(pageNo); 
			
			// append to body pagination
			if(type=='next') page.appendTo(paginationBody);	
			else paginationBody.prepend(page);
		}
		else page.css('display','inline-block');
	}
	
	// function return a object contains page
	function paginationPageExists(pageNo,paginationBody)
	{
		var page=paginationBody.children('a').filter(function(index) { return $(this).text()==pageNo; });
		return(page);
	}
	
	// get number of page
	function paginationGetNumber(page)
		{ return(parseInt(page.text())) }; 
	
	// get number of visible pages
	function paginationGetVisiblePages(paginationBody)
		{ return(paginationBody.children('a:visible').length); }
	
	// get first visible page
	function paginationGetFirstPage(paginationBody)
		{ return(paginationBody.children('a:visible').first()); }
	
	// get last visible page
	function paginationGetLastPage(paginationBody)
		{ return(paginationBody.children('a:visible').last()); } 

	// get body of pagination (a section which contains pages)
	function paginationGetBody(id)
		{ return($('#'+id).children('.paginationBody').first()); }
	
	// go to page
	function paginationGo(id)
	{
		var pageNo=parseInt($('#'+id).children('.paginationPageNumber').first().val());
		if(pageNo>0) 
		{
			if(PaginationArray[id]['ajax']) paginationGoToPage(pageNo,id);
			else window.location.href=PaginationArray[id]['link']+pageNo;
		}
	}
	
	// create title for page
	function paginatonCreateTitle(id,pageNo)
	{
		var title=new String(PaginationArray[id]['phrase']);
		var rowsRange=paginationGetRange(id,pageNo);
		
		title=title.replace('%pageNo%',pageNo).replace('%rowsRange%',rowsRange[0]+'-'+rowsRange[1]);
		
		return(title);
	}
	
	// get rows range for page
	function paginationGetRange(id,pageNo)
	{
		var rowsRange=[];
		
		if(pageNo==1) 
		{
			rowsRange[0]=1;
			rowsRange[1]=PaginationArray[id]['resultsPerPage'];
		}
		else 
		{
			rowsRange[0]=((pageNo-1)*PaginationArray[id]['resultsPerPage'])+1;
			rowsRange[1]=pageNo*PaginationArray[id]['resultsPerPage'];
		}
			
		return(rowsRange);
	}
	
	// "Go to page" ajax function
	function paginationGoToPage(pageNo,id)
	{	
		alert('Pagination id is -' + id + '- and page number is -' + pageNo + '-');
	}

	// pagination array
	var PaginationArray=[];