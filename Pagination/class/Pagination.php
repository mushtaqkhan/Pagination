<?
	// Pagination class 1.0
	// (c) QuanticaLabs 2010
	
	class Pagination
	{
		// path to the language settings
		private $pathToLanguageFile;
		
		// selected language (eg. 'en')
		private $language;
		
		// array of phrases that language
		private $phrase;
		
		// current page number
		private $currentPage;
		
		// number of total results
		private $totalResults;
		
		// number of results per page
		private $resultsPerPage;
		
		// number of pages
		private $numberOfPages;
		
		// array of parameters
		private $parameters;
		
		// construct
		function __construct($currentPage,$totalResults,$resultsPerPage=25,$language='en',$pathToLanguageFile='../language/') 
		{
			$this->phrase=array();
			
			$this->setCurrentPage($currentPage);
			$this->setTotalResults($totalResults);
			$this->setResultsPerPage($resultsPerPage);
			
			$this->setLanguage($language);
			$this->setPathToLanguageFile($pathToLanguageFile);
			$this->loadLanguage();
			
			$this->parameters=array
			(
				'id'							=> 'pagination_1',		// unique identifier pagination
				
				'scroll'						=> true,				// determine if the pages will be scrolled
			
				'numberOfPagesLeftSide'			=> 3,					// number of pages on the left side of the current page
				'numberOfPagesRightSide'		=> 3,					// number of pages on the right side of the current page
										
				'displayGoToPage'				=> false,				// determines whether to display the field "go to page"
				
				'displayFirstPage'				=> true,				// determines whether to display the page "go to first page"
				'displayPreviousPage'			=> true,				// determines whether to display the page "go to first page" "go to previous page"
				'displayNextPage'				=> true,				// determines whether to display the page "go to first page""go to next page"
				'displayLastPage'				=> true,				// determines whether to display the page "go to first page""go to last page"
				
				'displayIfOnePage'				=> false,				// determines whether to display a single page
				
				'link'							=> null,				// link to page
				'pageName'						=> 'page',				// variable name that stores the page number
				
				'ajax'							=> false,				// determines whether to use ajax
				
				'useControlLabel'				=> true					// determines if text labels for a control pages must be used (eg. "Next page")
			);
		}
		
		// get or set language
		public function getLanguage() 
		{ 
			return($this->language); 
		}
		private function setLanguage($language) 
		{ 
			$this->language=$language; 
		}
		
		// get or set path to the language file
		private function setPathToLanguageFile($pathToLanguageFile) 
		{ 
			$this->pathToLanguageFile=$pathToLanguageFile.$this->language.'.xml'; 
		}
		public function getPathToLanguageFile()
		{ 
			return($this->pathToLanguageFile); 
		}
		
		// load phrases from xml language file
		private function loadLanguage()
		{
			if(!is_readable($this->getPathToLanguageFile())) return;
			if(($language=@simplexml_load_file($this->getPathToLanguageFile(),'SimpleXMLElement',LIBXML_NOCDATA))===false) return;		

			foreach($language->{'phrase'} as $phrase)
			{
				$name=strval($phrase->attributes());
				$this->phrase[$name]=strval(trim($phrase));
			}
		}
		
		// get or set phrase
		public function getPhrase($name)
		{ 
			return($this->phrase[$name]); 
		}
		public function setPhrase($name,$value)
		{ 
			$this->phrase[$name]=$value; 
		}	
		
		// get or set current page number
		public function setCurrentPage($currentPage)
		{ 
			$this->currentPage=(int)$currentPage; 
		}
		public function getCurrentPage()
		{ 
			return($this->currentPage); 
		}

		// get or set total results
		public function setTotalResults($totalResults)
		{ 
			$this->totalResults=(int)$totalResults; 
		}
		public function getTotalResults()
		{ 
			return($this->totalResults); 
		}
			
		// get or set results per page	
		public function setResultsPerPage($resultsPerPage)
		{ 
			$this->resultsPerPage=(int)$resultsPerPage; 
		}
		public function getResultsPerPage()
		{ 
			return($this->resultsPerPage); 
		}

		// get or set number of pages
		private function setNumberOfPages($numberOfPages)
		{ 
			$this->numberOfPages=(int)$numberOfPages; 
		}
		public function getNumberOfPages()
		{ 
			return($this->numberOfPages); 
		}
		
		// get or set parameters
		public function setParameters($parameters)
		{
			foreach($parameters as $name=>$value)
			{
				if(array_key_exists($name,$this->parameters))
					$this->parameters[$name]=$value;
			}
		}
		public function getParameter($name)
		{ 
			return($this->parameters[$name]); 
		}
		
		// function returns the class name for the selected page 
		private function getSelectedClassPage($page)
		{
			if($page==$this->getCurrentPage())
				return(' paginationSelectedPage');
				
			return(null); 
		}
		
		// function returns the title of the page as an HTML attribute
		private function getPageTitle($phrase,$pattern=array(),$replacement=array())
		{
			$title=$this->getPhrase($phrase);
			if(is_null($title)) return(null);
			
			if((count($pattern)==count($replacement)) && (count($pattern)))
				$title=preg_replace($pattern,$replacement,$title);
				
			return(' title="'.htmlspecialchars($title).'"');
		}
		
		// function calculates the range of rows
		private function getRowsRange($pageNo)
		{
			$rowsRange=array();
			
			if($pageNo==1) 
			{
				$rowsRange[0]=1;
				$rowsRange[1]=$this->getResultsPerPage();
			}
			else 
			{
				$rowsRange[0]=(($pageNo-1)*$this->getResultsPerPage())+1;
				$rowsRange[1]=$pageNo*$this->getResultsPerPage();
			}
			
			return($rowsRange);
		}
		
		// function converts and returns the address of the page
		private function getLink($object=null)
		{
			if((bool)$this->getParameter('ajax'))
			{
				return('javascript:paginationGoToPage('.$object.',\''.$this->getParameter(id).'\')');
			}
			else
			{
				$query='?';
				if(!is_null($this->getParameter('link')))
				{
					$url=parse_url($this->getParameter('link'));
					$query=$this->getParameter('link').(!is_null($url['query']) ? '&' : '?');
				}
				
				$query.=$this->getParameter('pageName').'=';
				
				return($query);
			}
		}
		
		// function create the page
		private function createPage($pageNo,$label,$cssClass,$phrase,$events=array(),$pattern=array(),$replacement=array())
		{
			if(!is_null($events[0])) $events[0]=' onmouseover="'.$events[0].'"';
			if(!is_null($events[1])) $events[1]=' onmouseout="'.$events[1].'"';
			
			if(!is_null($cssClass)) $cssClass=' class="'.$cssClass.'"';
		
			$retVal='<a href="'.$this->getLink($pageNo).((bool)$this->getParameter('ajax') ? null : $pageNo).'"'.$cssClass.($this->getPageTitle($phrase,$pattern,$replacement)).$events[0].$events[1].'>'.$label.'</a>';
			
			return($retVal);
		}
		
		// main function creates pagination
		public function create($display=true)
		{		
			$retValue=null;
		
			// check if whether current page number is less or equal than zero
			if($this->getCurrentPage()<=0) return($retValue);
			
			// checking whether the number of all results is less than or equal to zero
			if($this->getTotalResults()<=0) return($retValue);
			
			// checking whether results per page is less than or equal to zero
			if($this->getResultsPerPage()<=0) return($retValue);
				
			// checking whether the number of pages to the left of the current page is less than or equal to zero
			if($this->getParameter('numberOfPagesLeftSide')<0) return($retValue);

			// checking whether the number of pages to the right of the current page is less than or equal to zero
			if($this->getParameter('numberOfPagesRightSide')<0) return($retValue);
			
			// calculate the number of pages
			$this->setNumberOfPages(ceil($this->totalResults/$this->resultsPerPage));

			// check whether the current page number is greater than the number of all pages
			if($this->getCurrentPage()>$this->getNumberOfPages()) return($retValue);
					
			// checking whether to display pagination if there is only one page
			if(($this->getNumberOfPages()==1) && ((bool)$this->getParameter('displayIfOnePage')==false)) return($retValue);
				
			// create pagination with unique id
			$retValue.='<div class="pagination" id="'.htmlspecialchars($this->getParameter('id'),ENT_QUOTES).'">';
			
			
			// create left control section
			if(((bool)$this->getParameter('displayFirstPage')) || ((bool)$this->getParameter('displayPreviousPage')))		
				$retValue.='<div class="paginationLeftControl">';
					
			// create "go to first page" section
			if((bool)$this->getParameter('displayFirstPage'))
			{  
				$rowsRange=$this->getRowsRange(1);
				$label=$this->getParameter('useControlLabel') ? $this->getPhrase('labelFirstPage') : null;
				
				$retValue.=$this->createPage(1,$label,'paginationFirstPage','titleFirstPage',null,array('/%rowsRange%/'),array($rowsRange[0].'-' .$rowsRange[1]));
			} 
			
			// create "go to previous page" section
			if((bool)$this->getParameter('displayPreviousPage'))
			{
				$pageNo=$this->getCurrentPage()-1<=0 ? 1 : $this->getCurrentPage()-1;
				$label=$this->getParameter('useControlLabel') ? $this->getPhrase('labelPreviousPage') : null;
				$events=(bool)$this->getParameter('scroll') ? array('paginationPrevious(\''.$this->getParameter('id').'\')','paginationStop(\''.$this->getParameter('id').'\')') : array();
		
				$retValue.=$this->createPage($pageNo,$label,'paginationPreviousPage','titlePreviousPage',$events);		
			}	
			
			// close left control section
			if(((bool)$this->getParameter('displayFirstPage')) || ((bool)$this->getParameter('displayPreviousPage')))		
				$retValue.='</div>';
			
			
			// start body (box which contains pages)
			$retValue.='<div class="paginationBody">';	
		
			// create pages to the left of the current page, create current page
			if($this->getParameter('numberOfPagesLeftSide')>0)
			{	
				$firstPagination=$this->getCurrentPage()-$this->getParameter('numberOfPagesLeftSide');
				$firstPagination=$firstPagination<=0 ? 1 : $firstPagination;
			
				for($i=$firstPagination;$i<=$this->getCurrentPage();$i++)
				{
					$rowsRange=$this->getRowsRange($i);
					$retValue.=$this->createPage($i,$i,($this->getSelectedClassPage($i)),'titlePageNo',null,array('/%pageNo%/','/%rowsRange%/'),array($i,$rowsRange[0].'-' .$rowsRange[1]));				
			
				}
			}
			
			// create pages to the right of the current page
			if($this->getParameter('numberOfPagesRightSide')>0)
			{
				$lastPagination=$this->getCurrentPage()+$this->getParameter('numberOfPagesRightSide');
				$lastPagination=$lastPagination>$this->getNumberOfPages() ? $this->getNumberOfPages() : $lastPagination;
			
				for($i=$this->getCurrentPage()+1;$i<=$lastPagination;$i++)
				{
					$rowsRange=$this->getRowsRange($i);
					$retValue.=$this->createPage($i,$i,($this->getSelectedClassPage($i)),'titlePageNo',null,array('/%pageNo%/','/%rowsRange%/'),array($i,$rowsRange[0].'-' .$rowsRange[1]));				
				}
			}
			
			// close body
			$retValue.='</div>';
			
			// create text field "go to page"
			if((bool)$this->getParameter('displayGoToPage'))
				$retValue.='<input type="text" class="paginationPageNumber" onblur="paginationGo(\''.$this->getParameter('id').'\');" title="'.$this->getPhrase('titlePageNumberField').'"></input>';
			
			
			// create right control section
			if(((bool)$this->getParameter('displayNextPage')) || ((bool)$this->getParameter('displayLastPage')))		
				$retValue.='<div class="paginationRightControl">';			
			
			// create "go to next page" section
			if((bool)$this->getParameter('displayNextPage'))
			{  
				$pageNo=$this->getCurrentPage()+1>$this->getNumberOfPages() ? $this->getNumberOfPages() : $this->getCurrentPage()+1;
				$label=$this->getParameter('useControlLabel') ? $this->getPhrase('labelNextPage') : null;
				$events=(bool)$this->getParameter('scroll') ? array('paginationNext(\''.$this->getParameter('id').'\')','paginationStop(\''.$this->getParameter('id').'\')') : array();
				
				$retValue.=$this->createPage($pageNo,$label,'paginationNextPage','titleNextPage',$events);	
			}
			
			// create "go to last page" section
			if((bool)$this->getParameter('displayLastPage'))
			{
				$rowsRange=$this->getRowsRange($this->getNumberOfPages());
				$label=$this->getParameter('useControlLabel') ? $this->getPhrase('labelLastPage') : null;
				
				$retValue.=$this->createPage($this->getNumberOfPages(),$label,'paginationLastPage','titleLastPage',null,array('/%pageNo%/','/%rowsRange%/'),array($this->getNumberOfPages(),$rowsRange[0].'-' .$rowsRange[1]));				
			}	

			// close right control section
			if(((bool)$this->getParameter('displayNextPage')) || ((bool)$this->getParameter('displayLastPage')))		
				$retValue.='</div>';			
			
			// close pagination 
			$retValue.='</div>';
			
			// values for javascript
			if((bool)$this->getParameter('scroll'))
			{			
				$retValue.=
				'
					<script type="text/javascript">
					
						var id=\''.$this->getParameter('id').'\';
						
						PaginationArray[id]=[];
						
						PaginationArray[id][\'clock\']=0;
							
						PaginationArray[id][\'totalResults\']='.$this->getTotalResults().';
						PaginationArray[id][\'numberOfPages\']='.$this->getNumberOfPages().';
						PaginationArray[id][\'resultsPerPage\']='.$this->getResultsPerPage().';
							
						PaginationArray[id][\'link\']="'.$this->getLink('this').'";
						PaginationArray[id][\'phrase\']="'.$this->getPhrase('titlePageNo').'";
							
						PaginationArray[id][\'numberOfPagesLeftSide\']='.$this->getParameter('numberOfPagesLeftSide').';
						PaginationArray[id][\'numberOfPagesRightSide\']='.$this->getParameter('numberOfPagesRightSide').';
						
						PaginationArray[id][\'ajax\']='.(int)$this->getParameter('ajax').';
						
					</script> 
				';
			}
			
			if($display) echo $retValue;
			else return($retValue);
		}	
	}
?>
