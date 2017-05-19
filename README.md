# Scrolling Pagination
Scrolling Pagination Class is a class written in PHP 5.x used to create a pagination of results from different sources (such as MySQL query results). 
## Features
        support for multiple languages,
        easy to modify text label on the button pages,
        display rows range on the button pages (tooltip),
        ability to scroll through pages,
        very easy to configure,
        7 style examples (CSS3) with gradients, rounded corners etc.

## Pagination class functions
        $currentPage 	- 	current page number
        $totalResults 	- 	number of total results
        $resultsPerPage 	25 	number of results per page
        $language 	'en' 	selected language (eg. 'en')
        $pathToLanguageFile 	'../language/' 	path to the language settings

### Public function setParameters:
        public function setParameters($parameters)
where $parameters is associative array which contains keys as follow:
 
        Key name 	            Default value 	        Description
        id 	pagination_1        unique                  identifier pagination
        scroll 	                true                    determine if the pages will be scrolled
        numberOfPagesLeftSide   3                       number of pages on the left side of the current page
        numberOfPagesRightSide  3                       number of pages on the right side of the current page
        displayGoToPage 	    false 	                determines whether to display the field "go to page"
        displayFirstPage 	    true 	                determines whether to display the page "go to first page"
        displayPreviousPage 	true 	                determines whether to display the page "go to previous page"
        displayNextPage 	    true 	                determines whether to display the page "go to next page"
        displayLastPage 	    true 	                determines whether to display the page "go to first page"
        displayIfOnePage 	    false 	                determines whether to display a single page
        link 	                null 	                link to page
        pageName 	            page 	                variable name that stores the page number
        ajax 	                false 	                determines whether to use ajax
        useControlLabel 	    true 	                determines if text labels for a control pages must be used (eg. "Next page")

### Public function create:
        public function create($display=true)

        Parameter 	Description
        $display 	determines whether the results have to be returned or displayed


### Other public functions:
        Function name 	                        Description
        getLanguage() 	                        get language
        getPathToLanguageFile() 	            get path to language file
        getPhrase($name) 	                    get phrase from language file
        setPhrase($name,$value) 	            set phrase
        setCurrentPage($currentPage) 	        set current page number
        getCurrentPage() 	                    get current page number
        setTotalResults($totalResults) 	        set total results
        getTotalResults() 	                    get total results
        setResultsPerPage($resultsPerPage) 	    set results per page
        getResultsPerPage() 	                get results per page
        getNumberOfPages() 	                    get number of pages
        getParameter($name) 	                get parameter (eg. pageName)

### Multilanguage support
For each language which is used in the class must be provided for the XML file containing the phrase. XML file structure is as follows:

        <?xml version="1.0" encoding="utf-8"?>

        <language>

         <phrase id="titleFirstPage"><![CDATA[ First page [rows: %rowsRange%] ]]></phrase>
         <phrase id="titlePreviousPage"><![CDATA[ Previous page ]]></phrase>
         <phrase id="titlePageNo"><![CDATA[ Go to page number: %pageNo% [rows: %rowsRange%] ]]></phrase>
         <phrase id="titleNextPage"><![CDATA[ Next page ]]></phrase>
         <phrase id="titleLastPage"><![CDATA[ Last page: %pageNo% [rows: %rowsRange%] ]]></phrase>

         <phrase id="labelFirstPage"><![CDATA[ First ]]></phrase> 
         <phrase id="labelPreviousPage"><![CDATA[ Previous ]]></phrase>
         <phrase id="labelNextPage"><![CDATA[ Next ]]></phrase>
         <phrase id="labelLastPage"><![CDATA[ Last ]]></phrase>

         <phrase id="titlePageNumberField"><![CDATA[ Enter page number and click anywhere ]]></phrase>

        </language>

To correctly use the language file, it is necessary to give it a name in the format: xx.en where xx is the name of the language. The value of xx should be transferred to the class through the constructor. Phrases such as %pageNo%, %rowsRange% are converted to their corresponding values. 

### CSS files and examples
## Using
Seven templates style are in the package (paginationDefault, paginationGreen, paginationSilver, paginationBlue, paginationRed, paginationOrange, paginationBrown). If you want to use one of them you have to use one of its parent class assignments. For example:

        <div class="paginationDefault">
        <?
            $Pagination=new Pagination($page,1200);
            $Pagination->setParameters(array('id'=>'paginationDefault'));
            $Pagination->create();
        ?>
        </div>


