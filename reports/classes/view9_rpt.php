<?php
namespace PHPReportMaker12\bokerbunchF;

/**
 * Page class (view9_rpt)
 */
class view9_rpt extends view9_base
{

	// Page ID
	public $PageID = 'rpt';

	// Project ID
	public $ProjectID = "{D54C8CFC-831E-4677-9FFE-3A9FCE329EA1}";

	// Page object name
	public $PageObjName = 'view9_rpt';
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Page headings
	public $Heading = '';
	public $Subheading = '';
	public $PageHeader;
	public $PageFooter;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportPdfUrl;
	public $ExportEmailUrl;

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Custom export
	public $ExportPrintCustom = FALSE;
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Page heading
	public function pageHeading()
	{
		global $ReportLanguage;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $ReportLanguage;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$pageUrl = CurrentPageName() . "?";
		if ($this->UseTokenInUrl) $pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return @$_SESSION[SESSION_MESSAGE];
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($_SESSION[SESSION_MESSAGE], $v);
	}

	// Get failure message
	public function getFailureMessage()
	{
		return @$_SESSION[SESSION_FAILURE_MESSAGE];
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($_SESSION[SESSION_FAILURE_MESSAGE], $v);
	}

	// Get success message
	public function getSuccessMessage()
	{
		return @$_SESSION[SESSION_SUCCESS_MESSAGE];
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($_SESSION[SESSION_SUCCESS_MESSAGE], $v);
	}

	// Get warning message
	public function getWarningMessage()
	{
		return @$_SESSION[SESSION_WARNING_MESSAGE];
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($_SESSION[SESSION_WARNING_MESSAGE], $v);
	}

	// Clear message
	public function clearMessage()
	{
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$_SESSION[SESSION_MESSAGE] = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") // Fotoer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
	}

	// Validate page request
	public function isPageRequest()
	{
		if ($this->UseTokenInUrl) {
			if (IsPost())
				return ($this->TableVar == Post("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $ReportLanguage, $DashboardReport;

		// Initialize
		if (!$DashboardReport)
			$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		$ReportLanguage = new ReportLanguage();
		if ($Language === NULL)
			$Language = $ReportLanguage;

		// Parent constuctor
		parent::__construct();

		// Table object (view9_base)
		if (!isset($GLOBALS["view9_base"])) {
			$GLOBALS["view9_base"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["view9_base"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportEmailUrl = $this->pageUrl() . "export=email";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'rpt');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'view9');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Search options
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option fview9rpt";

		// Generate report options
		$this->GenerateOptions = new ListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ew-generate-option";
	}

	// Get export HTML tag
	public function getExportTag($type, $custom = FALSE)
	{
		global $ReportLanguage;
		$exportId = session_id();
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportExcelUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("ExportToExcel") . "</a>";
			else
				return "<a class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportWordUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("ExportToWord") . "</a>";
			else
				return "<a class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "print")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportPrintUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("PrinterFriendly") . "</a>";
			else
				return "<a class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly"), TRUE) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->phrase("PrinterFriendly") . "</a>";
		} elseif (SameText($type, "pdf")) {
			return "<a class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "email")) {
			return "<a class=\"ew-export-link ew-email\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" id=\"emf_view9\" href=\"#\" onclick=\"ew.emailDialogShow({ lnk: 'emf_view9', hdr: ew.language.phrase('ExportToEmail'), url: '$this->ExportEmailUrl', exportid: '$exportId', el: this }); return false;\">" . $ReportLanguage->phrase("ExportToEmail") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Security, $ReportLanguage, $ReportOptions;
		$exportId = session_id();
		$reportTypes = [];

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;
		$reportTypes["print"] = $item->Visible ? $ReportLanguage->phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;
		$reportTypes["excel"] = $item->Visible ? $ReportLanguage->phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;
		$reportTypes["word"] = $item->Visible ? $ReportLanguage->phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;
		$item->Visible = TRUE;
		$reportTypes["pdf"] = $item->Visible ? $ReportLanguage->phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;
		$reportTypes["email"] = $item->Visible ? $ReportLanguage->phrase("ReportFormEmail") : "";

		// Report types
		$ReportOptions["ReportTypes"] = $reportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = FALSE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fview9rpt\" href=\"#\">" . $ReportLanguage->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fview9rpt\" href=\"#\">" . $ReportLanguage->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up export options (extended)
		$this->setupExportOptionsExt();

		// Hide options for export
		if ($this->isExport()) {
			$this->ExportOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fview9rpt\">" . $ReportLanguage->phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Reset filter
		$item = &$this->SearchOptions->add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlEncode($ReportLanguage->phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . CurrentPageName() . "?cmd=reset'\">" . $ReportLanguage->phrase("ResetAllFilter") . "</button>";
		$item->Visible = TRUE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->SearchOptions->hideAllOptions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ReportLanguage, $EXPORT_REPORT, $ExportFileName, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->isExport() && array_key_exists($this->Export, $EXPORT_REPORT)) {
			$content = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $content, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$content = str_replace($divmatch[0], "", $content);
				}
			}
			$fn = $EXPORT_REPORT[$this->Export];
			$saveResponse = $this->$fn($content);
			if (ReportParam("generaterequest") === TRUE) { // Generate report request
				$this->writeGenResponse($saveResponse);
				$url = ""; // Avoid redirect
			}
		}

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			header("Location: " . $url);
		}
		if (!$DashboardReport)
			exit();
	}

	// Initialize common variables
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Recordset
	public $GroupRecordset = NULL;
	public $Recordset = NULL;
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DrillDown = FALSE;
	public $DrillDownInPanel = FALSE;
	public $DrillDownList = "";

	// Clear field for ext filter
	public $ExpiredExtendedFilter = "";
	public $PopupName = "";
	public $PopupValue = "";
	public $FilterApplied;
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $Counts;
	public $Columns;
	public $Values;
	public $Summaries;
	public $Minimums;
	public $Maximums;
	public $GrandCounts;
	public $GrandSummaries;
	public $GrandMinimums;
	public $GrandMaximums;
	public $TotalCount;
	public $GrandSummarySetup = FALSE;
	public $GroupIndexes;
	public $DetailRows = [];
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $ReportLanguage, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb, $ReportLanguage,
			$DashboardReport, $CustomExportType;
		global $ReportLanguage;

		// Get export parameters
		if (ReportParam("export") !== NULL)
			$this->Export = strtolower(ReportParam("export"));
		$ExportType = $this->Export; // Get export parameter, used in header
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Setup placeholder
		// Setup export options

		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			echo $ReportLanguage->phrase("InvalidPostRequest");
			$this->terminate();
			exit();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->STATE);
		$this->setupLookupOptions($this->CITY);
		$this->setupLookupOptions($this->AREA);

		// Set field visibility for detail fields
		$this->STATE->setVisibility();
		$this->CITY->setVisibility();
		$this->AREA->setVisibility();
		$this->BROKER_NAME->setVisibility();
		$this->OWNER_NAME->setVisibility();
		$this->BROKER_MOBILE->setVisibility();
		$this->BROKER_EMAIL->setVisibility();
		$this->LANDMARK->setVisibility();
		$this->PRICE->setVisibility();
		$this->DEPOSITE_AMOUNT->setVisibility();
		$this->PLOT_NUMBER->setVisibility();
		$this->ROOMS->setVisibility();
		$this->ADDRESS->setVisibility();
		$this->ACCOMMODATION->setVisibility();
		$this->DESCRIPTION->setVisibility();
		$this->IMAGE->setVisibility();
		$this->STATUS->setVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$fieldCount = 18;
		$groupCount = 1;
		$this->Values = &InitArray($fieldCount, 0);
		$this->Counts = &Init2DArray($groupCount, $fieldCount, 0);
		$this->Summaries = &Init2DArray($groupCount, $fieldCount, 0);
		$this->Minimums = &Init2DArray($groupCount, $fieldCount, NULL);
		$this->Maximums = &Init2DArray($groupCount, $fieldCount, NULL);
		$this->GrandCounts = &InitArray($fieldCount, 0);
		$this->GrandSummaries = &InitArray($fieldCount, 0);
		$this->GrandMinimums = &InitArray($fieldCount, NULL);
		$this->GrandMaximums = &InitArray($fieldCount, NULL);

		// Set up array if accumulation required: [Accum, SkipNullOrZero]
		$this->Columns = [[FALSE, FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE]];

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();
		$this->STATE->SelectionList = "";
		$this->STATE->DefaultSelectionList = "";
		$this->STATE->ValueList = "";
		$this->CITY->SelectionList = "";
		$this->CITY->DefaultSelectionList = "";
		$this->CITY->ValueList = "";
		$this->AREA->SelectionList = "";
		$this->AREA->DefaultSelectionList = "";
		$this->AREA->ValueList = "";

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load default filter values
		$this->loadDefaultFilters();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->setupPopup();

		// Load group db values if necessary
		$this->loadGroupDbValues();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->Filter, $extendedFilter);

		// Build popup filter
		$popupFilter = $this->getPopupFilter();
		AddFilter($this->Filter, $popupFilter);

		// Check if filter applied
		$this->FilterApplied = $this->checkFilter();

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->setupSearchOptions();

		// Get sort
		$this->Sort = $this->getSort();

		// Get total count
		$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = TRUE;

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->phrase("NoRecord"));
				}
		}

		// Hide export options if export/dashboard report
		if ($this->isExport() || $DashboardReport)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report
		if ($this->isExport() || $this->DrillDown || $DashboardReport) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
			$this->GenerateOptions->hideAllOptions();
		}

		// Get current page records
		$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $this->Filter, $this->Sort);
		$this->Recordset = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
		$this->setupFieldCount();
	}

	// Accummulate summary
	public function accumulateSummary()
	{
		$cntx = count($this->Summaries);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Summaries[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Columns[$iy][0]) { // Accumulate required
					$valwrk = $this->Values[$iy];
					if ($valwrk === NULL) {
						if (!$this->Columns[$iy][1])
							$this->Counts[$ix][$iy]++;
					} else {
						$accum = (!$this->Columns[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Counts[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Summaries[$ix][$iy] += $valwrk;
								if ($this->Minimums[$ix][$iy] === NULL) {
									$this->Minimums[$ix][$iy] = $valwrk;
									$this->Maximums[$ix][$iy] = $valwrk;
								} else {
									if ($this->Minimums[$ix][$iy] > $valwrk)
										$this->Minimums[$ix][$iy] = $valwrk;
									if ($this->Maximums[$ix][$iy] < $valwrk)
										$this->Maximums[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Summaries);
		for ($ix = 0; $ix < $cntx; $ix++)
			$this->Counts[$ix][0]++;
	}

	// Reset level summary
	public function resetLevelSummary($lvl)
	{

		// Clear summary values
		$cntx = count($this->Summaries);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Summaries[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Counts[$ix][$iy] = 0;
				if ($this->Columns[$iy][0]) {
					$this->Summaries[$ix][$iy] = 0;
					$this->Minimums[$ix][$iy] = NULL;
					$this->Maximums[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Summaries);
		for ($ix = $lvl; $ix < $cntx; $ix++)
			$this->Counts[$ix][0] = 0;

		// Reset record count
		$this->RecordCount = 0;
	}

	// Load row values
	public function loadRowValues($firstRow = FALSE)
	{
		if (!$this->Recordset)
			return;
		if ($firstRow) { // Get first row
				$this->FirstRowData = [];
				$this->FirstRowData["STATE"] = $this->Recordset->fields('STATE');
				$this->FirstRowData["CITY"] = $this->Recordset->fields('CITY');
				$this->FirstRowData["AREA"] = $this->Recordset->fields('AREA');
				$this->FirstRowData["BROKER_NAME"] = $this->Recordset->fields('BROKER NAME');
				$this->FirstRowData["OWNER_NAME"] = $this->Recordset->fields('OWNER NAME');
				$this->FirstRowData["BROKER_MOBILE"] = $this->Recordset->fields('BROKER MOBILE');
				$this->FirstRowData["BROKER_EMAIL"] = $this->Recordset->fields('BROKER EMAIL');
				$this->FirstRowData["LANDMARK"] = $this->Recordset->fields('LANDMARK');
				$this->FirstRowData["PRICE"] = $this->Recordset->fields('PRICE');
				$this->FirstRowData["DEPOSITE_AMOUNT"] = $this->Recordset->fields('DEPOSITE AMOUNT');
				$this->FirstRowData["PLOT_NUMBER"] = $this->Recordset->fields('PLOT NUMBER');
				$this->FirstRowData["ROOMS"] = $this->Recordset->fields('ROOMS');
				$this->FirstRowData["ADDRESS"] = $this->Recordset->fields('ADDRESS');
				$this->FirstRowData["ACCOMMODATION"] = $this->Recordset->fields('ACCOMMODATION');
				$this->FirstRowData["DESCRIPTION"] = $this->Recordset->fields('DESCRIPTION');
				$this->FirstRowData["IMAGE"] = $this->Recordset->fields('IMAGE');
				$this->FirstRowData["STATUS"] = $this->Recordset->fields('STATUS');
		} else { // Get next row
			$this->Recordset->moveNext();
		}
		if (!$this->Recordset->EOF) {
			$this->STATE->setDbValue($this->Recordset->fields('STATE'));
			$this->CITY->setDbValue($this->Recordset->fields('CITY'));
			$this->AREA->setDbValue($this->Recordset->fields('AREA'));
			$this->BROKER_NAME->setDbValue($this->Recordset->fields('BROKER NAME'));
			$this->OWNER_NAME->setDbValue($this->Recordset->fields('OWNER NAME'));
			$this->BROKER_MOBILE->setDbValue($this->Recordset->fields('BROKER MOBILE'));
			$this->BROKER_EMAIL->setDbValue($this->Recordset->fields('BROKER EMAIL'));
			$this->LANDMARK->setDbValue($this->Recordset->fields('LANDMARK'));
			$this->PRICE->setDbValue($this->Recordset->fields('PRICE'));
			$this->DEPOSITE_AMOUNT->setDbValue($this->Recordset->fields('DEPOSITE AMOUNT'));
			$this->PLOT_NUMBER->setDbValue($this->Recordset->fields('PLOT NUMBER'));
			$this->ROOMS->setDbValue($this->Recordset->fields('ROOMS'));
			$this->ADDRESS->setDbValue($this->Recordset->fields('ADDRESS'));
			$this->ACCOMMODATION->setDbValue($this->Recordset->fields('ACCOMMODATION'));
			$this->DESCRIPTION->setDbValue($this->Recordset->fields('DESCRIPTION'));
			$this->IMAGE->setDbValue($this->Recordset->fields('IMAGE'));
			$this->STATUS->setDbValue($this->Recordset->fields('STATUS'));
			$this->Values[1] = $this->STATE->CurrentValue;
			$this->Values[2] = $this->CITY->CurrentValue;
			$this->Values[3] = $this->AREA->CurrentValue;
			$this->Values[4] = $this->BROKER_NAME->CurrentValue;
			$this->Values[5] = $this->OWNER_NAME->CurrentValue;
			$this->Values[6] = $this->BROKER_MOBILE->CurrentValue;
			$this->Values[7] = $this->BROKER_EMAIL->CurrentValue;
			$this->Values[8] = $this->LANDMARK->CurrentValue;
			$this->Values[9] = $this->PRICE->CurrentValue;
			$this->Values[10] = $this->DEPOSITE_AMOUNT->CurrentValue;
			$this->Values[11] = $this->PLOT_NUMBER->CurrentValue;
			$this->Values[12] = $this->ROOMS->CurrentValue;
			$this->Values[13] = $this->ADDRESS->CurrentValue;
			$this->Values[14] = $this->ACCOMMODATION->CurrentValue;
			$this->Values[15] = $this->DESCRIPTION->CurrentValue;
			$this->Values[16] = $this->IMAGE->CurrentValue;
			$this->Values[17] = $this->STATUS->CurrentValue;
		} else {
			$this->STATE->setDbValue("");
			$this->CITY->setDbValue("");
			$this->AREA->setDbValue("");
			$this->BROKER_NAME->setDbValue("");
			$this->OWNER_NAME->setDbValue("");
			$this->BROKER_MOBILE->setDbValue("");
			$this->BROKER_EMAIL->setDbValue("");
			$this->LANDMARK->setDbValue("");
			$this->PRICE->setDbValue("");
			$this->DEPOSITE_AMOUNT->setDbValue("");
			$this->PLOT_NUMBER->setDbValue("");
			$this->ROOMS->setDbValue("");
			$this->ADDRESS->setDbValue("");
			$this->ACCOMMODATION->setDbValue("");
			$this->DESCRIPTION->setDbValue("");
			$this->IMAGE->setDbValue("");
			$this->STATUS->setDbValue("");
		}
	}

	// Render row
	public function renderRow()
	{
		global $Security, $ReportLanguage, $Language;
		$conn = &$this->getConnection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$this->TotalCount = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$this->TotalCount = 0;
			}
			$hasSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$this->Recordset = $conn->execute($sql);
				if ($this->Recordset) {
					$this->loadRowValues(TRUE);
					while (!$this->Recordset->EOF) {
						$this->accumulateGrandSummary();
						$this->loadRowValues();
					}
					$this->Recordset->close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();
		if ($this->RowType == ROWTYPE_SEARCH) { // Search row
			$ar = [];
			if (is_array($this->STATE->AdvancedFilters)) {
				foreach ($this->STATE->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->STATE->DropDownList)) {
				foreach ($this->STATE->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->STATE->EditValue = $ar;
			$this->STATE->AdvancedSearch->SearchValue = is_array($this->STATE->DropDownValue) ? implode(",", $this->STATE->DropDownValue) : $this->STATE->DropDownValue;
			$ar = [];
			if (is_array($this->CITY->AdvancedFilters)) {
				foreach ($this->CITY->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->CITY->DropDownList)) {
				foreach ($this->CITY->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->CITY->EditValue = $ar;
			$this->CITY->AdvancedSearch->SearchValue = is_array($this->CITY->DropDownValue) ? implode(",", $this->CITY->DropDownValue) : $this->CITY->DropDownValue;
			$ar = [];
			if (is_array($this->AREA->AdvancedFilters)) {
				foreach ($this->AREA->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->AREA->DropDownList)) {
				foreach ($this->AREA->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->AREA->EditValue = $ar;
			$this->AREA->AdvancedSearch->SearchValue = is_array($this->AREA->DropDownValue) ? implode(",", $this->AREA->DropDownValue) : $this->AREA->DropDownValue;
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			PrependClass($this->RowAttrs["class"], ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

			// STATE
			$this->STATE->HrefValue = "";

			// CITY
			$this->CITY->HrefValue = "";

			// AREA
			$this->AREA->HrefValue = "";

			// BROKER NAME
			$this->BROKER_NAME->HrefValue = "";

			// OWNER NAME
			$this->OWNER_NAME->HrefValue = "";

			// BROKER MOBILE
			$this->BROKER_MOBILE->HrefValue = "";

			// BROKER EMAIL
			$this->BROKER_EMAIL->HrefValue = "";

			// LANDMARK
			$this->LANDMARK->HrefValue = "";

			// PRICE
			$this->PRICE->HrefValue = "";

			// DEPOSITE AMOUNT
			$this->DEPOSITE_AMOUNT->HrefValue = "";

			// PLOT NUMBER
			$this->PLOT_NUMBER->HrefValue = "";

			// ROOMS
			$this->ROOMS->HrefValue = "";

			// ADDRESS
			$this->ADDRESS->HrefValue = "";

			// ACCOMMODATION
			$this->ACCOMMODATION->HrefValue = "";

			// DESCRIPTION
			$this->DESCRIPTION->HrefValue = "";

			// IMAGE
			$this->IMAGE->HrefValue = "";

			// STATUS
			$this->STATUS->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			} else {
			}

			// STATE
			$this->STATE->ViewValue = $this->STATE->CurrentValue;
			$this->STATE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// CITY
			$this->CITY->ViewValue = $this->CITY->CurrentValue;
			$this->CITY->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// AREA
			$this->AREA->ViewValue = $this->AREA->CurrentValue;
			$this->AREA->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// BROKER NAME
			$this->BROKER_NAME->ViewValue = $this->BROKER_NAME->CurrentValue;
			$this->BROKER_NAME->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// OWNER NAME
			$this->OWNER_NAME->ViewValue = $this->OWNER_NAME->CurrentValue;
			$this->OWNER_NAME->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// BROKER MOBILE
			$this->BROKER_MOBILE->ViewValue = $this->BROKER_MOBILE->CurrentValue;
			$this->BROKER_MOBILE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// BROKER EMAIL
			$this->BROKER_EMAIL->ViewValue = $this->BROKER_EMAIL->CurrentValue;
			$this->BROKER_EMAIL->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// LANDMARK
			$this->LANDMARK->ViewValue = $this->LANDMARK->CurrentValue;
			$this->LANDMARK->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PRICE
			$this->PRICE->ViewValue = $this->PRICE->CurrentValue;
			$this->PRICE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// DEPOSITE AMOUNT
			$this->DEPOSITE_AMOUNT->ViewValue = $this->DEPOSITE_AMOUNT->CurrentValue;
			$this->DEPOSITE_AMOUNT->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PLOT NUMBER
			$this->PLOT_NUMBER->ViewValue = $this->PLOT_NUMBER->CurrentValue;
			$this->PLOT_NUMBER->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// ROOMS
			$this->ROOMS->ViewValue = $this->ROOMS->CurrentValue;
			$this->ROOMS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// ADDRESS
			$this->ADDRESS->ViewValue = $this->ADDRESS->CurrentValue;
			$this->ADDRESS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// ACCOMMODATION
			$this->ACCOMMODATION->ViewValue = $this->ACCOMMODATION->CurrentValue;
			$this->ACCOMMODATION->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// DESCRIPTION
			$this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
			$this->DESCRIPTION->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// IMAGE
			$this->IMAGE->ViewValue = $this->IMAGE->CurrentValue;
			$this->IMAGE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// STATUS
			$this->STATUS->ViewValue = $this->STATUS->CurrentValue;
			$this->STATUS->ViewValue = FormatNumber($this->STATUS->ViewValue, 0, -2, -2, -2);
			$this->STATUS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// STATE
			$this->STATE->HrefValue = "";

			// CITY
			$this->CITY->HrefValue = "";

			// AREA
			$this->AREA->HrefValue = "";

			// BROKER NAME
			$this->BROKER_NAME->HrefValue = "";

			// OWNER NAME
			$this->OWNER_NAME->HrefValue = "";

			// BROKER MOBILE
			$this->BROKER_MOBILE->HrefValue = "";

			// BROKER EMAIL
			$this->BROKER_EMAIL->HrefValue = "";

			// LANDMARK
			$this->LANDMARK->HrefValue = "";

			// PRICE
			$this->PRICE->HrefValue = "";

			// DEPOSITE AMOUNT
			$this->DEPOSITE_AMOUNT->HrefValue = "";

			// PLOT NUMBER
			$this->PLOT_NUMBER->HrefValue = "";

			// ROOMS
			$this->ROOMS->HrefValue = "";

			// ADDRESS
			$this->ADDRESS->HrefValue = "";

			// ACCOMMODATION
			$this->ACCOMMODATION->HrefValue = "";

			// DESCRIPTION
			$this->DESCRIPTION->HrefValue = "";

			// IMAGE
			$this->IMAGE->HrefValue = "";

			// STATUS
			$this->STATUS->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row
		} else {

			// STATE
			$currentValue = $this->STATE->CurrentValue;
			$viewValue = &$this->STATE->ViewValue;
			$viewAttrs = &$this->STATE->ViewAttrs;
			$cellAttrs = &$this->STATE->CellAttrs;
			$hrefValue = &$this->STATE->HrefValue;
			$linkAttrs = &$this->STATE->LinkAttrs;
			$this->Cell_Rendered($this->STATE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// CITY
			$currentValue = $this->CITY->CurrentValue;
			$viewValue = &$this->CITY->ViewValue;
			$viewAttrs = &$this->CITY->ViewAttrs;
			$cellAttrs = &$this->CITY->CellAttrs;
			$hrefValue = &$this->CITY->HrefValue;
			$linkAttrs = &$this->CITY->LinkAttrs;
			$this->Cell_Rendered($this->CITY, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// AREA
			$currentValue = $this->AREA->CurrentValue;
			$viewValue = &$this->AREA->ViewValue;
			$viewAttrs = &$this->AREA->ViewAttrs;
			$cellAttrs = &$this->AREA->CellAttrs;
			$hrefValue = &$this->AREA->HrefValue;
			$linkAttrs = &$this->AREA->LinkAttrs;
			$this->Cell_Rendered($this->AREA, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// BROKER NAME
			$currentValue = $this->BROKER_NAME->CurrentValue;
			$viewValue = &$this->BROKER_NAME->ViewValue;
			$viewAttrs = &$this->BROKER_NAME->ViewAttrs;
			$cellAttrs = &$this->BROKER_NAME->CellAttrs;
			$hrefValue = &$this->BROKER_NAME->HrefValue;
			$linkAttrs = &$this->BROKER_NAME->LinkAttrs;
			$this->Cell_Rendered($this->BROKER_NAME, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// OWNER NAME
			$currentValue = $this->OWNER_NAME->CurrentValue;
			$viewValue = &$this->OWNER_NAME->ViewValue;
			$viewAttrs = &$this->OWNER_NAME->ViewAttrs;
			$cellAttrs = &$this->OWNER_NAME->CellAttrs;
			$hrefValue = &$this->OWNER_NAME->HrefValue;
			$linkAttrs = &$this->OWNER_NAME->LinkAttrs;
			$this->Cell_Rendered($this->OWNER_NAME, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// BROKER MOBILE
			$currentValue = $this->BROKER_MOBILE->CurrentValue;
			$viewValue = &$this->BROKER_MOBILE->ViewValue;
			$viewAttrs = &$this->BROKER_MOBILE->ViewAttrs;
			$cellAttrs = &$this->BROKER_MOBILE->CellAttrs;
			$hrefValue = &$this->BROKER_MOBILE->HrefValue;
			$linkAttrs = &$this->BROKER_MOBILE->LinkAttrs;
			$this->Cell_Rendered($this->BROKER_MOBILE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// BROKER EMAIL
			$currentValue = $this->BROKER_EMAIL->CurrentValue;
			$viewValue = &$this->BROKER_EMAIL->ViewValue;
			$viewAttrs = &$this->BROKER_EMAIL->ViewAttrs;
			$cellAttrs = &$this->BROKER_EMAIL->CellAttrs;
			$hrefValue = &$this->BROKER_EMAIL->HrefValue;
			$linkAttrs = &$this->BROKER_EMAIL->LinkAttrs;
			$this->Cell_Rendered($this->BROKER_EMAIL, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// LANDMARK
			$currentValue = $this->LANDMARK->CurrentValue;
			$viewValue = &$this->LANDMARK->ViewValue;
			$viewAttrs = &$this->LANDMARK->ViewAttrs;
			$cellAttrs = &$this->LANDMARK->CellAttrs;
			$hrefValue = &$this->LANDMARK->HrefValue;
			$linkAttrs = &$this->LANDMARK->LinkAttrs;
			$this->Cell_Rendered($this->LANDMARK, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PRICE
			$currentValue = $this->PRICE->CurrentValue;
			$viewValue = &$this->PRICE->ViewValue;
			$viewAttrs = &$this->PRICE->ViewAttrs;
			$cellAttrs = &$this->PRICE->CellAttrs;
			$hrefValue = &$this->PRICE->HrefValue;
			$linkAttrs = &$this->PRICE->LinkAttrs;
			$this->Cell_Rendered($this->PRICE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DEPOSITE AMOUNT
			$currentValue = $this->DEPOSITE_AMOUNT->CurrentValue;
			$viewValue = &$this->DEPOSITE_AMOUNT->ViewValue;
			$viewAttrs = &$this->DEPOSITE_AMOUNT->ViewAttrs;
			$cellAttrs = &$this->DEPOSITE_AMOUNT->CellAttrs;
			$hrefValue = &$this->DEPOSITE_AMOUNT->HrefValue;
			$linkAttrs = &$this->DEPOSITE_AMOUNT->LinkAttrs;
			$this->Cell_Rendered($this->DEPOSITE_AMOUNT, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PLOT NUMBER
			$currentValue = $this->PLOT_NUMBER->CurrentValue;
			$viewValue = &$this->PLOT_NUMBER->ViewValue;
			$viewAttrs = &$this->PLOT_NUMBER->ViewAttrs;
			$cellAttrs = &$this->PLOT_NUMBER->CellAttrs;
			$hrefValue = &$this->PLOT_NUMBER->HrefValue;
			$linkAttrs = &$this->PLOT_NUMBER->LinkAttrs;
			$this->Cell_Rendered($this->PLOT_NUMBER, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ROOMS
			$currentValue = $this->ROOMS->CurrentValue;
			$viewValue = &$this->ROOMS->ViewValue;
			$viewAttrs = &$this->ROOMS->ViewAttrs;
			$cellAttrs = &$this->ROOMS->CellAttrs;
			$hrefValue = &$this->ROOMS->HrefValue;
			$linkAttrs = &$this->ROOMS->LinkAttrs;
			$this->Cell_Rendered($this->ROOMS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ADDRESS
			$currentValue = $this->ADDRESS->CurrentValue;
			$viewValue = &$this->ADDRESS->ViewValue;
			$viewAttrs = &$this->ADDRESS->ViewAttrs;
			$cellAttrs = &$this->ADDRESS->CellAttrs;
			$hrefValue = &$this->ADDRESS->HrefValue;
			$linkAttrs = &$this->ADDRESS->LinkAttrs;
			$this->Cell_Rendered($this->ADDRESS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ACCOMMODATION
			$currentValue = $this->ACCOMMODATION->CurrentValue;
			$viewValue = &$this->ACCOMMODATION->ViewValue;
			$viewAttrs = &$this->ACCOMMODATION->ViewAttrs;
			$cellAttrs = &$this->ACCOMMODATION->CellAttrs;
			$hrefValue = &$this->ACCOMMODATION->HrefValue;
			$linkAttrs = &$this->ACCOMMODATION->LinkAttrs;
			$this->Cell_Rendered($this->ACCOMMODATION, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DESCRIPTION
			$currentValue = $this->DESCRIPTION->CurrentValue;
			$viewValue = &$this->DESCRIPTION->ViewValue;
			$viewAttrs = &$this->DESCRIPTION->ViewAttrs;
			$cellAttrs = &$this->DESCRIPTION->CellAttrs;
			$hrefValue = &$this->DESCRIPTION->HrefValue;
			$linkAttrs = &$this->DESCRIPTION->LinkAttrs;
			$this->Cell_Rendered($this->DESCRIPTION, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// IMAGE
			$currentValue = $this->IMAGE->CurrentValue;
			$viewValue = &$this->IMAGE->ViewValue;
			$viewAttrs = &$this->IMAGE->ViewAttrs;
			$cellAttrs = &$this->IMAGE->CellAttrs;
			$hrefValue = &$this->IMAGE->HrefValue;
			$linkAttrs = &$this->IMAGE->LinkAttrs;
			$this->Cell_Rendered($this->IMAGE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// STATUS
			$currentValue = $this->STATUS->CurrentValue;
			$viewValue = &$this->STATUS->ViewValue;
			$viewAttrs = &$this->STATUS->ViewAttrs;
			$cellAttrs = &$this->STATUS->CellAttrs;
			$hrefValue = &$this->STATUS->HrefValue;
			$linkAttrs = &$this->STATUS->LinkAttrs;
			$this->Cell_Rendered($this->STATUS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}

	// Accummulate grand summary
	protected function accumulateGrandSummary()
	{
		$this->TotalCount++;
		$cntgs = count($this->GrandSummaries);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Columns[$iy][0]) {
				$valwrk = $this->Values[$iy];
				if ($valwrk === NULL || !is_numeric($valwrk)) {
					if (!$this->Columns[$iy][1])
						$this->GrandCounts[$iy]++;
				} else {
					if (!$this->Columns[$iy][1] || $valwrk <> 0) {
						$this->GrandCounts[$iy]++;
						$this->GrandSummaries[$iy] += $valwrk;
						if ($this->GrandMinimums[$iy] === NULL) {
							$this->GrandMinimums[$iy] = $valwrk;
							$this->GrandMaximums[$iy] = $valwrk;
						} else {
							if ($this->GrandMinimums[$iy] > $valwrk)
								$this->GrandMinimums[$iy] = $valwrk;
							if ($this->GrandMaximums[$iy] < $valwrk)
								$this->GrandMaximums[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Load group db values if necessary
	protected function loadGroupDbValues()
	{
		$conn = &$this->getConnection();
	}

	// Set up popup
	protected function setupPopup()
	{
		global $ReportLanguage;
		$conn = &$this->getConnection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (IsPost()) {
			$name = Post("popup", ""); // Get popup form name
			if ($name <> "") {
				$arValues = Post("sel_$name");
				$cntValues = is_array($arValues) ? count($arValues) : 0;
				if ($cntValues > 0) {
					if (trim($arValues[0]) == "") // Select all
						$arValues = INIT_VALUE;
					$this->PopupName = $name;
					if (IsAdvancedFilterValue($arValues) || $arValues == INIT_VALUE)
						$this->PopupValue = $arValues;
					if (!MatchedArray($arValues, @$_SESSION["sel_$name"])) {
						if ($this->hasSessionFilterValues($name))
							$this->ExpiredExtendedFilter = $name; // Clear extended filter for this field
					}
					$_SESSION["sel_$name"] = $arValues;
					$_SESSION["rf_$name"] = Post("rf_$name", "");
					$_SESSION["rt_$name"] = Post("rt_$name", "");
					$this->resetPager();
				}
			}

		// Get 'reset' command
		} elseif (Get("cmd") !== NULL) {
			$cmd = Get("cmd");
			if (SameText($cmd, "reset")) {
				$this->clearSessionSelection("STATE");
				$this->clearSessionSelection("CITY");
				$this->clearSessionSelection("AREA");
				$this->resetPager();
			}
		}

		// Load selection criteria to array
		// Get STATE selected values

		if (is_array(@$_SESSION["sel_view9_STATE"])) {
			$this->loadSelectionFromSession("STATE");
		} elseif (@$_SESSION["sel_view9_STATE"] == INIT_VALUE) { // Select all
			$this->STATE->SelectionList = "";
		}

		// Get CITY selected values
		if (is_array(@$_SESSION["sel_view9_CITY"])) {
			$this->loadSelectionFromSession("CITY");
		} elseif (@$_SESSION["sel_view9_CITY"] == INIT_VALUE) { // Select all
			$this->CITY->SelectionList = "";
		}

		// Get AREA selected values
		if (is_array(@$_SESSION["sel_view9_AREA"])) {
			$this->loadSelectionFromSession("AREA");
		} elseif (@$_SESSION["sel_view9_AREA"] == INIT_VALUE) { // Select all
			$this->AREA->SelectionList = "";
		}
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->STATE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->CITY->Visible)
			$this->DetailColumnCount += 1;
		if ($this->AREA->Visible)
			$this->DetailColumnCount += 1;
		if ($this->BROKER_NAME->Visible)
			$this->DetailColumnCount += 1;
		if ($this->OWNER_NAME->Visible)
			$this->DetailColumnCount += 1;
		if ($this->BROKER_MOBILE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->BROKER_EMAIL->Visible)
			$this->DetailColumnCount += 1;
		if ($this->LANDMARK->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PRICE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DEPOSITE_AMOUNT->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PLOT_NUMBER->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ROOMS->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ADDRESS->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ACCOMMODATION->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DESCRIPTION->Visible)
			$this->DetailColumnCount += 1;
		if ($this->IMAGE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->STATUS->Visible)
			$this->DetailColumnCount += 1;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/") + 1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', "", $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("rpt", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Set up export options (extended)
	protected function setupExportOptionsExt()
	{
		global $ReportLanguage, $ReportOptions;
		$reportTypes = $ReportOptions["ReportTypes"];
		$item = &$this->ExportOptions->getItem("pdf");
		$item->Visible = TRUE;
		if ($item->Visible)
			$reportTypes["pdf"] = $ReportLanguage->phrase("ReportFormPdf");
		$item->Body = "<a class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportPdfUrl . "', '" . session_id() . "');\">" . $ReportLanguage->phrase("ExportToPDF") . "</a>";
		$ReportOptions["ReportTypes"] = $reportTypes;
	}

	// Export to HTML
	public function exportHtml($html)
	{

		//global $ExportFileName;
		//header('Content-Type: text/html' . (PROJECT_CHARSET <> '' ? ';charset=' . PROJECT_CHARSET : ''));
		//header('Content-Disposition: attachment; filename=' . $ExportFileName . '.html');

		$folder = ReportParam("folder", "");
		$fileName = ReportParam("filename", "");
		$responseType = ReportParam("responsetype", "");
		$saveToFile = "";

		// Save generate file for print
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && REPORT_SAVE_OUTPUT_ON_SERVER)) {
			$baseTag = "<base href=\"" . BaseUrl() . "\">";
			$html = preg_replace('/<head>/', '<head>' . $baseTag, $html);
			SaveFile($folder, $fileName, $html);
			$saveToFile = UploadPath(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file")
			Write($html);
		return $saveToFile;
	}

	// Export to Excel
	public function exportExcel($html)
	{
		global $ExportFileName;
		$folder = ReportParam("folder", "");
		$fileName = ReportParam("filename", "");
		$responseType = ReportParam("responsetype", "");
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	SaveFile(ServerMapPath($folder), $fileName, $html);
			$saveToFile = UploadPath(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			AddHeader('Set-Cookie', 'fileDownload=true; path=/');
			AddHeader('Content-Type', 'application/vnd.ms-excel' . (PROJECT_CHARSET <> '' ? ';charset=' . PROJECT_CHARSET : ''));
			AddHeader('Content-Disposition', 'attachment; filename=' . $ExportFileName . '.xls');
			Write($html);
		}
		return $saveToFile;
	}

	// Export PDF
	public function exportPdf($html)
	{
		global $ExportFileName, $PDF_MEMORY_LIMIT, $PDF_TIME_LIMIT, $PDF_IMAGE_SCALE_FACTOR;
		@ini_set("memory_limit", $PDF_MEMORY_LIMIT);
		set_time_limit($PDF_TIME_LIMIT);
		$html = CheckHtml($html);
		if (DEBUG_ENABLED) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "Cpdf"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = "a4";
		$pageOrientation = "portrait";
		$this->ExportPageOrientation = $pageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] <> 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * $PDF_IMAGE_SCALE_FACTOR); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		$folder = ReportParam("folder", "");
		$fileName = ReportParam("filename", "");
		$responseType = ReportParam("responsetype", "");
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && REPORT_SAVE_OUTPUT_ON_SERVER)) {
			SaveFile(ServerMapPath($folder), $fileName, $dompdf->output());
			$saveToFile = UploadPath(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			AddHeader('Set-Cookie', 'fileDownload=true; path=/');
			$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
			$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		}
		DeleteTempImages($html);
		return $saveToFile;
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = ReportParam(TABLE_START_GROUP, "");
		$pageNo = ReportParam("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups <> 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (ReportParam(TABLE_GROUP_PER_PAGE) !== NULL) {
			$wrk = ReportParam(TABLE_GROUP_PER_PAGE);
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "";
		$resetSort = ReportParam("cmd") === "resetsort";
		$orderBy = ReportParam("order", "");
		$orderType = ReportParam("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->STATE->setSort("");
			$this->CITY->setSort("");
			$this->AREA->setSort("");
			$this->BROKER_NAME->setSort("");
			$this->OWNER_NAME->setSort("");
			$this->BROKER_MOBILE->setSort("");
			$this->BROKER_EMAIL->setSort("");
			$this->LANDMARK->setSort("");
			$this->PRICE->setSort("");
			$this->DEPOSITE_AMOUNT->setSort("");
			$this->PLOT_NUMBER->setSort("");
			$this->ROOMS->setSort("");
			$this->ADDRESS->setSort("");
			$this->ACCOMMODATION->setSort("");
			$this->DESCRIPTION->setSort("");
			$this->IMAGE->setSort("");
			$this->STATUS->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$postBack = IsPost();
		$restoreSession = TRUE;
		$setupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($postBack) {

			// Set/clear dropdown for field STATE
			if ($this->PopupName == "view9_STATE" && $this->PopupValue <> "") {
				if ($this->PopupValue == INIT_VALUE)
					$this->STATE->DropDownValue = ALL_VALUE;
				else
					$this->STATE->DropDownValue = $this->PopupValue;
				$restoreSession = FALSE; // Do not restore
			} elseif ($this->ExpiredExtendedFilter == "view9_STATE") {
				$this->setSessionDropDownValue(INIT_VALUE, "", "STATE");
			}

			// Set/clear dropdown for field CITY
			if ($this->PopupName == "view9_CITY" && $this->PopupValue <> "") {
				if ($this->PopupValue == INIT_VALUE)
					$this->CITY->DropDownValue = ALL_VALUE;
				else
					$this->CITY->DropDownValue = $this->PopupValue;
				$restoreSession = FALSE; // Do not restore
			} elseif ($this->ExpiredExtendedFilter == "view9_CITY") {
				$this->setSessionDropDownValue(INIT_VALUE, "", "CITY");
			}

			// Set/clear dropdown for field AREA
			if ($this->PopupName == "view9_AREA" && $this->PopupValue <> "") {
				if ($this->PopupValue == INIT_VALUE)
					$this->AREA->DropDownValue = ALL_VALUE;
				else
					$this->AREA->DropDownValue = $this->PopupValue;
				$restoreSession = FALSE; // Do not restore
			} elseif ($this->ExpiredExtendedFilter == "view9_AREA") {
				$this->setSessionDropDownValue(INIT_VALUE, "", "AREA");
			}

		// Reset search command
		} elseif (Get("cmd", "") == "reset") {

			// Load default values
			$this->setSessionDropDownValue($this->STATE->DropDownValue, $this->STATE->AdvancedSearch->SearchOperator, "STATE"); // Field STATE
			$this->setSessionDropDownValue($this->CITY->DropDownValue, $this->CITY->AdvancedSearch->SearchOperator, "CITY"); // Field CITY
			$this->setSessionDropDownValue($this->AREA->DropDownValue, $this->AREA->AdvancedSearch->SearchOperator, "AREA"); // Field AREA

			//$setupFilter = TRUE; // No need to set up, just use default
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field STATE
			if ($this->getDropDownValue($this->STATE)) {
				$setupFilter = TRUE;
			} elseif ($this->STATE->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_view9_STATE"])) {
				$setupFilter = TRUE;
			}

			// Field CITY
			if ($this->getDropDownValue($this->CITY)) {
				$setupFilter = TRUE;
			} elseif ($this->CITY->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_view9_CITY"])) {
				$setupFilter = TRUE;
			}

			// Field AREA
			if ($this->getDropDownValue($this->AREA)) {
				$setupFilter = TRUE;
			} elseif ($this->AREA->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_view9_AREA"])) {
				$setupFilter = TRUE;
			}
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$this->getSessionDropDownValue($this->STATE); // Field STATE
			$this->getSessionDropDownValue($this->CITY); // Field CITY
			$this->getSessionDropDownValue($this->AREA); // Field AREA
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->buildDropDownFilter($this->STATE, $filter, $this->STATE->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field STATE
		$this->buildDropDownFilter($this->CITY, $filter, $this->CITY->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field CITY
		$this->buildDropDownFilter($this->AREA, $filter, $this->AREA->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field AREA

		// Save parms to session
		$this->setSessionDropDownValue($this->STATE->DropDownValue, $this->STATE->AdvancedSearch->SearchOperator, "STATE"); // Field STATE
		$this->setSessionDropDownValue($this->CITY->DropDownValue, $this->CITY->AdvancedSearch->SearchOperator, "CITY"); // Field CITY
		$this->setSessionDropDownValue($this->AREA->DropDownValue, $this->AREA->AdvancedSearch->SearchOperator, "AREA"); // Field AREA

		// Setup filter
		if ($setupFilter) {

			// Field STATE
			$wrk = "";
			$this->buildDropDownFilter($this->STATE, $wrk, $this->STATE->AdvancedSearch->SearchOperator);
			LoadSelectionFromFilter($this->STATE, $wrk, $this->STATE->SelectionList, $this->STATE->DropDownValue);
			$_SESSION["sel_view9_STATE"] = ($this->STATE->SelectionList == "") ? INIT_VALUE : $this->STATE->SelectionList;

			// Field CITY
			$wrk = "";
			$this->buildDropDownFilter($this->CITY, $wrk, $this->CITY->AdvancedSearch->SearchOperator);
			LoadSelectionFromFilter($this->CITY, $wrk, $this->CITY->SelectionList, $this->CITY->DropDownValue);
			$_SESSION["sel_view9_CITY"] = ($this->CITY->SelectionList == "") ? INIT_VALUE : $this->CITY->SelectionList;

			// Field AREA
			$wrk = "";
			$this->buildDropDownFilter($this->AREA, $wrk, $this->AREA->AdvancedSearch->SearchOperator);
			LoadSelectionFromFilter($this->AREA, $wrk, $this->AREA->SelectionList, $this->AREA->DropDownValue);
			$_SESSION["sel_view9_AREA"] = ($this->AREA->SelectionList == "") ? INIT_VALUE : $this->AREA->SelectionList;
		}

		// Field STATE
		LoadDropDownList($this->STATE->DropDownList, $this->STATE->DropDownValue);

		// Field CITY
		LoadDropDownList($this->CITY->DropDownList, $this->CITY->DropDownValue);

		// Field AREA
		LoadDropDownList($this->AREA->DropDownList, $this->AREA->DropDownValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->DefaultDropDownValue : $fld->DropDownValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk <> "") {
					if ($sql <> "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql <> "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$fldDelimiter = $fld->Delimiter;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, NULL_VALUE)) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, NOT_NULL_VALUE)) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($fldDelimiter <> "" && trim($fldVal) <> "" && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiValueSearchSql($fldExpression, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal <> "" && $fldVal <> INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fldOpr <> "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk <> "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn <> "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk <> "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if ($fld->isMultiSelect() && !is_array($val)) // Split values for modal lookup
				$fld->DropDownValue = explode(LOOKUP_FILTER_VALUE_SEPARATOR, $val);
			else
				$fld->DropDownValue = $val;
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	protected function getFilterValues(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		if (IsPost())
			return; // Skip post back
		$got = FALSE;
		if (Get("x_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchValue = Get("x_$parm");
			$got = TRUE;
		}
		if (Get("z_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchOperator = Get("z_$parm");
			$got = TRUE;
		}
		if (Get("v_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchCondition = Get("v_$parm");
			$got = TRUE;
		}
		if (Get("y_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchValue2 = Get("y_$parm");
			$got = TRUE;
		}
		if (Get("w_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchOperator2 = Get("w_$parm");
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	protected function setDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
	{
		$fld->AdvancedSearch->SearchValueDefault = $sv1; // Default ext filter value 1
		$fld->AdvancedSearch->SearchValue2Default = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->AdvancedSearch->SearchOperatorDefault = $so1; // Default search operator 1
		$fld->AdvancedSearch->SearchOperator2Default = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->AdvancedSearch->SearchConditionDefault = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	protected function applyDefaultExtFilter(&$fld)
	{
		$fld->AdvancedSearch->SearchValue = $fld->AdvancedSearch->SearchValueDefault;
		$fld->AdvancedSearch->SearchValue2 = $fld->AdvancedSearch->SearchValue2Default;
		$fld->AdvancedSearch->SearchOperator = $fld->AdvancedSearch->SearchOperatorDefault;
		$fld->AdvancedSearch->SearchOperator2 = $fld->AdvancedSearch->SearchOperator2Default;
		$fld->AdvancedSearch->SearchCondition = $fld->AdvancedSearch->SearchConditionDefault;
	}

	// Check if Text Filter applied
	protected function textFilterApplied(&$fld)
	{
		return (strval($fld->AdvancedSearch->SearchValue) <> strval($fld->AdvancedSearch->SearchValueDefault) ||
			strval($fld->AdvancedSearch->SearchValue2) <> strval($fld->AdvancedSearch->SearchValue2Default) ||
			(strval($fld->AdvancedSearch->SearchValue) <> "" &&
				strval($fld->AdvancedSearch->SearchOperator) <> strval($fld->AdvancedSearch->SearchOperatorDefault)) ||
			(strval($fld->AdvancedSearch->SearchValue2) <> "" &&
				strval($fld->AdvancedSearch->SearchOperator2) <> strval($fld->AdvancedSearch->SearchOperator2Default)) ||
			strval($fld->AdvancedSearch->SearchCondition) <> strval($fld->AdvancedSearch->SearchConditionDefault));
	}

	// Check if Non-Text Filter applied
	protected function nonTextFilterApplied(&$fld)
	{
		if (is_array($fld->DropDownValue)) {
			if (is_array($fld->DefaultDropDownValue)) {
				if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
					return TRUE;
				else
					return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
			} else {
				return TRUE;
			}
		} else {
			if (is_array($fld->DefaultDropDownValue))
				return TRUE;
			else
				$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == INIT_VALUE || $v2 == ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Get dropdown value from session
	protected function getSessionDropDownValue(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		$this->getSessionValue($fld->DropDownValue, 'x_view9_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_view9_' . $parm);
	}

	// Get filter values from session
	protected function getSessionFilterValues(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue, 'x_view9_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_view9_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchCondition, 'v_view9_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue2, 'y_view9_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator2, 'w_view9_' . $parm);
	}

	// Get value from session
	protected function getSessionValue(&$sv, $sn)
	{
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	protected function setSessionDropDownValue($sv, $so, $parm)
	{
		$_SESSION['x_view9_' . $parm] = $sv;
		$_SESSION['z_view9_' . $parm] = $so;
	}

	// Set filter values to session
	protected function setSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm)
	{
		$_SESSION['x_view9_' . $parm] = $sv1;
		$_SESSION['z_view9_' . $parm] = $so1;
		$_SESSION['v_view9_' . $parm] = $sc;
		$_SESSION['y_view9_' . $parm] = $sv2;
		$_SESSION['w_view9_' . $parm] = $so2;
	}

	// Check if has session filter values
	protected function hasSessionFilterValues($parm)
	{
		return (@$_SESSION['x_' . $parm] <> "" && @$_SESSION['x_' . $parm] <> INIT_VALUE ||
			@$_SESSION['x_' . $parm] <> "" && @$_SESSION['x_' . $parm] <> INIT_VALUE ||
			@$_SESSION['y_' . $parm] <> "" && @$_SESSION['y_' . $parm] <> INIT_VALUE);
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk <> "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk <> "");
	}

	// Validate form
	protected function validateForm()
	{
		global $ReportLanguage, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			$FormError .= ($FormError <> "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Clear selection stored in session
	protected function clearSessionSelection($parm)
	{
		$_SESSION["sel_view9_$parm"] = "";
		$_SESSION["rf_view9_$parm"] = "";
		$_SESSION["rt_view9_$parm"] = "";
	}

	// Load selection from session
	protected function loadSelectionFromSession($parm)
	{
		foreach ($this->fields as $fld) {
			if ($fld->Param == $parm) {
				$fld->SelectionList = @$_SESSION["sel_view9_$parm"];
				$fld->RangeFrom = @$_SESSION["rf_view9_$parm"];
				$fld->RangeTo = @$_SESSION["rt_view9_$parm"];
				break;
			}
		}
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for non Text filters
		*/
		// Field STATE

		$this->STATE->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->STATE->DropDownValue = $this->STATE->DefaultDropDownValue;
		$wrk = "";
		$this->buildDropDownFilter($this->STATE, $wrk, $this->STATE->AdvancedSearch->SearchOperator, TRUE);
		LoadSelectionFromFilter($this->STATE, $wrk, $this->STATE->DefaultSelectionList);
		if (!$this->SearchCommand)
			$this->STATE->SelectionList = $this->STATE->DefaultSelectionList;

		// Field CITY
		$this->CITY->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->CITY->DropDownValue = $this->CITY->DefaultDropDownValue;
		$wrk = "";
		$this->buildDropDownFilter($this->CITY, $wrk, $this->CITY->AdvancedSearch->SearchOperator, TRUE);
		LoadSelectionFromFilter($this->CITY, $wrk, $this->CITY->DefaultSelectionList);
		if (!$this->SearchCommand)
			$this->CITY->SelectionList = $this->CITY->DefaultSelectionList;

		// Field AREA
		$this->AREA->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->AREA->DropDownValue = $this->AREA->DefaultDropDownValue;
		$wrk = "";
		$this->buildDropDownFilter($this->AREA, $wrk, $this->AREA->AdvancedSearch->SearchOperator, TRUE);
		LoadSelectionFromFilter($this->AREA, $wrk, $this->AREA->DefaultSelectionList);
		if (!$this->SearchCommand)
			$this->AREA->SelectionList = $this->AREA->DefaultSelectionList;

		/**
		* Set up default values for extended filters
		* function setDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		/**
		* Set up default values for popup filters
		*/
		// Field STATE
		// $this->STATE->DefaultSelectionList = ["val1", "val2"];
		// Field CITY
		// $this->CITY->DefaultSelectionList = ["val1", "val2"];
		// Field AREA
		// $this->AREA->DefaultSelectionList = ["val1", "val2"];

	}

	// Check if filter applied
	protected function checkFilter()
	{

		// Check STATE extended filter
		if ($this->nonTextFilterApplied($this->STATE))
			return TRUE;

		// Check STATE popup filter
		if (!MatchedArray($this->STATE->DefaultSelectionList, $this->STATE->SelectionList))
			return TRUE;

		// Check CITY extended filter
		if ($this->nonTextFilterApplied($this->CITY))
			return TRUE;

		// Check CITY popup filter
		if (!MatchedArray($this->CITY->DefaultSelectionList, $this->CITY->SelectionList))
			return TRUE;

		// Check AREA extended filter
		if ($this->nonTextFilterApplied($this->AREA))
			return TRUE;

		// Check AREA popup filter
		if (!MatchedArray($this->AREA->DefaultSelectionList, $this->AREA->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	public function showFilterList($showDate = FALSE)
	{
		global $ReportLanguage;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field STATE
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->STATE, $extWrk, $this->STATE->AdvancedSearch->SearchOperator);
		if (is_array($this->STATE->SelectionList))
			$wrk = JoinArray($this->STATE->SelectionList, ", ", DATATYPE_STRING, 0, $this->Dbid);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->STATE->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field CITY
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->CITY, $extWrk, $this->CITY->AdvancedSearch->SearchOperator);
		if (is_array($this->CITY->SelectionList))
			$wrk = JoinArray($this->CITY->SelectionList, ", ", DATATYPE_STRING, 0, $this->Dbid);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->CITY->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field AREA
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->AREA, $extWrk, $this->AREA->AdvancedSearch->SearchOperator);
		if (is_array($this->AREA->SelectionList))
			$wrk = JoinArray($this->AREA->SelectionList, ", ", DATATYPE_STRING, 0, $this->Dbid);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->AREA->caption() . "</span>" . $captionSuffix . $filter . "</div>";
		$divdataclass = "";

		// Show Filters
		if ($filterList <> "" || $showDate) {
			$message = "<div" . $divdataclass . "><div id=\"ew-filter-list\" class=\"alert alert-info d-table\">";
			if ($showDate)
				$message .= "<div id=\"ew-current-date\">" . $ReportLanguage->phrase("ReportGeneratedDate") . FormatDateTime(date("Y-m-d H:i:s"), 1) . "</div>";
			if ($filterList <> "")
				$message .= "<div id=\"ew-current-filters\">" . $ReportLanguage->phrase("CurrentFilters") . "</div>" . $filterList;
			$message .= "</div></div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Get list of filters
	public function getFilterList()
	{

		// Initialize
		$filterList = "";

		// Field STATE
		$wrk = "";
		$wrk = ($this->STATE->DropDownValue <> INIT_VALUE) ? $this->STATE->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_STATE\":\"" . JsEncode($wrk) . "\"";
		if ($wrk == "") {
			$wrk = ($this->STATE->SelectionList <> INIT_VALUE) ? $this->STATE->SelectionList : "";
			if (is_array($wrk))
				$wrk = implode("||", $wrk);
			if ($wrk <> "")
				$wrk = "\"sel_STATE\":\"" . JsEncode($wrk) . "\"";
		}
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field CITY
		$wrk = "";
		$wrk = ($this->CITY->DropDownValue <> INIT_VALUE) ? $this->CITY->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_CITY\":\"" . JsEncode($wrk) . "\"";
		if ($wrk == "") {
			$wrk = ($this->CITY->SelectionList <> INIT_VALUE) ? $this->CITY->SelectionList : "";
			if (is_array($wrk))
				$wrk = implode("||", $wrk);
			if ($wrk <> "")
				$wrk = "\"sel_CITY\":\"" . JsEncode($wrk) . "\"";
		}
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field AREA
		$wrk = "";
		$wrk = ($this->AREA->DropDownValue <> INIT_VALUE) ? $this->AREA->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_AREA\":\"" . JsEncode($wrk) . "\"";
		if ($wrk == "") {
			$wrk = ($this->AREA->SelectionList <> INIT_VALUE) ? $this->AREA->SelectionList : "";
			if (is_array($wrk))
				$wrk = implode("||", $wrk);
			if ($wrk <> "")
				$wrk = "\"sel_AREA\":\"" . JsEncode($wrk) . "\"";
		}
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList <> "")
			return "{\"data\":{" . $filterList . "}}";
		else
			return "null";
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") <> "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field STATE
		$restoreFilter = FALSE;
		if (array_key_exists("x_STATE", $filter)) {
			$wrk = $filter["x_STATE"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_STATE"], "STATE");
			$restoreFilter = TRUE;
		}
		if (array_key_exists("sel_STATE", $filter)) {
			$wrk = $filter["sel_STATE"];
			$wrk = explode("||", $wrk);
			$this->STATE->SelectionList = $wrk;
			$_SESSION["sel_view9_STATE"] = $wrk;
			$this->setSessionDropDownValue(INIT_VALUE, "", "STATE"); // Clear drop down
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "STATE");
			$this->STATE->SelectionList = "";
			$_SESSION["sel_view9_STATE"] = "";
		}

		// Field CITY
		$restoreFilter = FALSE;
		if (array_key_exists("x_CITY", $filter)) {
			$wrk = $filter["x_CITY"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_CITY"], "CITY");
			$restoreFilter = TRUE;
		}
		if (array_key_exists("sel_CITY", $filter)) {
			$wrk = $filter["sel_CITY"];
			$wrk = explode("||", $wrk);
			$this->CITY->SelectionList = $wrk;
			$_SESSION["sel_view9_CITY"] = $wrk;
			$this->setSessionDropDownValue(INIT_VALUE, "", "CITY"); // Clear drop down
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "CITY");
			$this->CITY->SelectionList = "";
			$_SESSION["sel_view9_CITY"] = "";
		}

		// Field AREA
		$restoreFilter = FALSE;
		if (array_key_exists("x_AREA", $filter)) {
			$wrk = $filter["x_AREA"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_AREA"], "AREA");
			$restoreFilter = TRUE;
		}
		if (array_key_exists("sel_AREA", $filter)) {
			$wrk = $filter["sel_AREA"];
			$wrk = explode("||", $wrk);
			$this->AREA->SelectionList = $wrk;
			$_SESSION["sel_view9_AREA"] = $wrk;
			$this->setSessionDropDownValue(INIT_VALUE, "", "AREA"); // Clear drop down
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "AREA");
			$this->AREA->SelectionList = "";
			$_SESSION["sel_view9_AREA"] = "";
		}
		return TRUE;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Render lookup
					$this->RowType == ROWTYPE_VIEW;
					$fn = $fld->Lookup->RenderViewFunc;
					$render = method_exists($this, $fn);

					// Format the field values
					$fld->setDbValue($row[1]);
					if ($render) {
						$this->$fn();
						$row[1] = $fld->ViewValue;
						$row['df'] = $row[1];
					} elseif ($fld->isEncrypt()) {
						$row[1] = $fld->CurrentValue;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Return popup filter
	protected function getPopupFilter()
	{
		$wrk = "";
		if ($this->DrillDown)
			return "";
		if (!$this->dropDownFilterExist($this->STATE, $this->STATE->AdvancedSearch->SearchOperator)) {
			if (is_array($this->STATE->SelectionList)) {
				$filter = FilterSql($this->STATE, "`STATE`", DATATYPE_STRING, $this->Dbid);

				// Call Page Filtering event
				$this->Page_Filtering($this->STATE, $filter, "popup");
				$this->STATE->CurrentFilter = $filter;
				AddFilter($wrk, $filter);
			}
		}
		if (!$this->dropDownFilterExist($this->CITY, $this->CITY->AdvancedSearch->SearchOperator)) {
			if (is_array($this->CITY->SelectionList)) {
				$filter = FilterSql($this->CITY, "`CITY`", DATATYPE_STRING, $this->Dbid);

				// Call Page Filtering event
				$this->Page_Filtering($this->CITY, $filter, "popup");
				$this->CITY->CurrentFilter = $filter;
				AddFilter($wrk, $filter);
			}
		}
		if (!$this->dropDownFilterExist($this->AREA, $this->AREA->AdvancedSearch->SearchOperator)) {
			if (is_array($this->AREA->SelectionList)) {
				$filter = FilterSql($this->AREA, "`AREA`", DATATYPE_STRING, $this->Dbid);

				// Call Page Filtering event
				$this->Page_Filtering($this->AREA, $filter, "popup");
				$this->AREA->CurrentFilter = $filter;
				AddFilter($wrk, $filter);
			}
		}
		return $wrk;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>