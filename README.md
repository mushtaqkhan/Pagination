#Scrolling Pagination Class
<b>Scrolling Pagination Class</b> is a class written in PHP 5.x used to create a pagination of results from different sources (such as MySQL query results). 
		The key features:
							
						<ul>
							<li>support for multiple languages,</li>
							<li>easy to modify text label on the button pages,</li>
							<li>display rows range on the button pages (tooltip),</li>
							<li>ability to scroll through pages,</li>
							<li>very easy to configure,</li>
							<li>7 style examples (CSS3) with gradients, rounded corners etc.</li>
						</ul>

						<div class="contentHeader"><a name="menu2"></a>Pagination class functions</div>
						
						<div class="contentHeaderSmall">Constructor:</div>
						
						<pre class="code">__construct($currentPage, $totalResults, $resultsPerPage=25, $language='en', $pathToLanguageFile='../language/')</pre>
					
						<table cellspacing="1px" cellpadding="0px" style="background-color:#e1e5e9;margin-bottom:10px;">

							<tr>
								<th style="width:30%">Parameter</th>
								<th style="width:15%">Default value</th>
								<th style="width:55%">Description</th>
							</tr>						
							<tr>
								<td>$currentPage</td>
								<td>-</td>
								<td>current page number</td>
							</tr>
							<tr>
								<td>$totalResults</td>
								<td>-</td>
								<td>number of total results</td>
							</tr>							
							<tr>
								<td>$resultsPerPage</td>
								<td>25</td>
								<td>number of results per page</td>
							</tr>				
							<tr>
								<td>$language</td>
								<td>'en'</td>
								<td>selected language (eg. 'en')</td>
							</tr>
							<tr>
								<td>$pathToLanguageFile</td>
								<td>'../language/'</td>
								<td>path to the language settings</td>
							</tr>
							
						</table>

						<div class="contentHeaderSmall">Public function setParameters:</div>
						
						<pre class="code">public function setParameters($parameters)</pre>
						
						where <i>$parameters</i> is associative array which contains keys as follow:
						
						<table cellspacing="1px" cellpadding="0px" style="background-color:#e1e5e9;margin:10px 0px 10px 0px;">
							
							<tr>
								<th style="width:30%;">Key name</th>
								<th style="width:15%;">Default value</th>
								<th style="width:55%;">Description</th>
							</tr>
							<tr>
								<td>id</td>
								<td>pagination_1</td>
								<td>unique identifier pagination</td>
							</tr>
							<tr>
								<td>scroll</td>
								<td>true</td>
								<td>determine if the pages will be scrolled</td>
							</tr>
							<tr>
								<td>numberOfPagesLeftSide</td>
								<td>3</td>
								<td>number of pages on the left side of the current page</td>
							</tr>							
							<tr>
								<td>numberOfPagesRightSide</td>
								<td>3</td>
								<td>number of pages on the right side of the current page</td>
							</tr>
							<tr>
								<td>displayGoToPage</td>
								<td>false</td>
								<td>determines whether to display the field &quot;go to page&quot;</td>
							</tr>
							<tr>
								<td>displayFirstPage</td>
								<td>true</td>
								<td>determines whether to display the page &quot;go to first page&quot;</td>
							</tr>	
							<tr>
								<td>displayPreviousPage</td>
								<td>true</td>
								<td>determines whether to display the page &quot;go to previous page&quot;</td>
							</tr>
							<tr>
								<td>displayNextPage</td>
								<td>true</td>
								<td>determines whether to display the page &quot;go to next page&quot;</td>
							</tr>
							<tr>
								<td>displayLastPage</td>
								<td>true</td>
								<td>determines whether to display the page &quot;go to first page&quot;</td>
							</tr>								
							<tr>
								<td>displayIfOnePage</td>
								<td>false</td>
								<td>determines whether to display a single page</td>
							</tr>	
							<tr>
								<td>link</td>
								<td>null</td>
								<td>link to page</td>
							</tr>
							<tr>
								<td>pageName</td>
								<td>page</td>
								<td>variable name that stores the page number</td>
							</tr>
							<tr>
								<td>ajax</td>
								<td>false</td>
								<td>determines whether to use ajax</td>
							</tr>
							<tr>
								<td>useControlLabel</td>
								<td>true</td>
								<td>determines if text labels for a control pages must be used (eg. "Next page")</td>
							</tr>							
							
						</table>	

						<div class="contentHeaderSmall">Public function create:</div>	

						<pre class="code">public function create($display=true)</pre>						
						
						<table cellspacing="1px" cellpadding="0px" style="background-color:#e1e5e9;margin-bottom:10px;">

							<tr>
								<th style="width:30%">Parameter</th>
								<th style="width:70%">Description</th>
							</tr>						
							<tr>
								<td>$display</td>
								<td>determines whether the results have to be returned or displayed</td>
							</tr>
							
						</table>

						<div class="contentHeaderSmall">Other public functions:</div>	
						
						<table cellspacing="1px" cellpadding="0px" style="background-color:#e1e5e9;margin:10px 0px 0px 0px;">

							<tr>
								<th style="width:30%">Function name</th>
								<th style="width:70%">Description</th>
							</tr>						
							<tr>
								<td>getLanguage()</td>
								<td>get language</td>
							</tr>
							<tr>
								<td>getPathToLanguageFile()</td>
								<td>get path to language file</td>
							</tr>
							<tr>
								<td>getPhrase($name)</td>
								<td>get phrase from language file</td>
							</tr>
							<tr>
								<td>setPhrase($name,$value)</td>
								<td>set phrase</td>
							</tr>
							<tr>
								<td>setCurrentPage($currentPage)</td>
								<td>set current page number</td>
							</tr>
							<tr>
								<td>getCurrentPage()</td>
								<td>get current page number</td>
							</tr>
							<tr>
								<td>setTotalResults($totalResults)</td>
								<td>set total results</td>
							</tr>
							<tr>
								<td>getTotalResults()</td>
								<td>get total results</td>
							</tr>
							<tr>
								<td>setResultsPerPage($resultsPerPage)</td>
								<td>set results per page</td>
							</tr>
							<tr>
								<td>getResultsPerPage()</td>
								<td>get results per page</td>
							</tr>
							<tr>
								<td>getNumberOfPages()</td>
								<td>get number of pages</td>
							</tr>
							<tr>
								<td>getParameter($name)</td>
								<td>get parameter (eg. pageName)</td>
							</tr>
							
						</table>
						
						<div class="contentHeader"><a name="menu3"></a>Multilanguage support</div>
						
						For each language which is used in the class must be provided for the XML file containing the phrase. XML file structure is as follows:
						
						<pre class="code">
&lt;?xml version="1.0" encoding="utf-8"?&gt;

&lt;language&gt;
	
 &lt;phrase id="titleFirstPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">First page [rows: %rowsRange%]</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="titlePreviousPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Previous page</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="titlePageNo"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Go to page number: %pageNo% [rows: %rowsRange%]</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="titleNextPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Next page</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="titleLastPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Last page: %pageNo% [rows: %rowsRange%]</span> ]]&gt;&lt;/phrase&gt;

 &lt;phrase id="labelFirstPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">First</span> ]]&gt;&lt;/phrase&gt; 
 &lt;phrase id="labelPreviousPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Previous</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="labelNextPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Next</span> ]]&gt;&lt;/phrase&gt;
 &lt;phrase id="labelLastPage"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Last</span> ]]&gt;&lt;/phrase&gt;
		
 &lt;phrase id="titlePageNumberField"&gt;&lt;![CDATA[ <span style="color:#a1a5a9">Enter page number and click anywhere</span> ]]&gt;&lt;/phrase&gt;
		
&lt;/language&gt;</pre>
						
						To correctly use the language file, it is necessary to give it a name in the format: xx.en where xx is the name of the language. 
						The value of xx should be transferred to the class through the constructor. Phrases such as <i>%pageNo%, %rowsRange%</i> are converted to their corresponding values.
						
						<div class="contentHeader"><a name="menu4"></a>CSS files and examples</div>
						
						<div class="contentHeaderSmall">Using</div>
						
						Seven templates style are in the package (<i>paginationDefault</i>, <i>paginationGreen</i>, <i>paginationSilver</i>, <i>paginationBlue</i>, <i>paginationRed</i>, <i>paginationOrange</i>, <i>paginationBrown</i>). 
						If you want to use one of them you have to use one of its parent class assignments. For example:
						
						<pre class="code">
&lt;div class="paginationDefault"&gt;
&lt;?
	$Pagination=new Pagination($page,1200);
	$Pagination->setParameters(array('id'=>'paginationDefault'));
	$Pagination->create();
?&gt;
&lt;/div&gt;</pre>
						
						<div class="contentHeaderSmall">Examples</div>
						<img src="../graphics/cssPreview.jpg"/ title="CSS preview">
					
					</div>
					
					<div class="menu">
				
						<a href="#menu1" class="menu">About</a>
						<a href="#menu2" class="menu">Pagination class functions</a>
						<a href="#menu3" class="menu">Multilanguage support</a>
						<a href="#menu4" class="menu">CSS files and examples</a>
						
				
