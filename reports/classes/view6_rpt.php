<?php
namespace PHPReportMaker12\bokerbunchF;

/**
 * Page class (view6_rpt)
 */
class view6_rpt extends view6_base
{

	// Page ID
	public $PageID = 'rpt';

	// Project ID
	public $ProjectID = "{D54C8CFC-831E-4677-9FFE-3A9FCE329EA1}";

	// Page object name
	public $PageObjName = 'view6_rpt';
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

		// Table object (view6_base)
		if (!isset($GLOBALS["view6_base"])) {
			$GLOBALS["view6_base"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["view6_base"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'view6');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fview6rpt";

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
			return "<a class=\"ew-export-link ew-email\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" id=\"emf_view6\" href=\"#\" onclick=\"ew.emailDialogShow({ lnk: 'emf_view6', hdr: ew.language.phrase('ExportToEmail'), url: '$this->ExportEmailUrl', exportid: '$exportId', el: this }); return false;\">" . $ReportLanguage->phrase("ExportToEmail") . "</a>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fview6rpt\" href=\"#\">" . $ReportLanguage->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fview6rpt\" href=\"#\">" . $ReportLanguage->phrase("DeleteFilter") . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fview6rpt\">" . $ReportLanguage->phrase("SearchBtn") . "</button>";
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
		$this->setupLookupOptions($this->APARTMENT_NAME);

		// Set field visibility for detail fields
		$this->BROKER_NAME->setVisibility();
		$this->PROPERTY_STATE->setVisibility();
		$this->PROPERTY_CITY->setVisibility();
		$this->PROPERTY_AREA->setVisibility();
		$this->PROPERTY_OWNER_NAME->setVisibility();
		$this->BROKER_MOBILE_NO_->setVisibility();
		$this->PROPERTY_LANDMARK->setVisibility();
		$this->PROPERTY_PRICE->setVisibility();
		$this->PROPERTY_PLOT_NUMBER->setVisibility();
		$this->APARTMENT_NO_->setVisibility();
		$this->APARTMENT_NAME->setVisibility();
		$this->NO__OF_ROOMS->setVisibility();
		$this->FLOOR_NO_->setVisibility();
		$this->PROPERTY_PURPOSE->setVisibility();
		$this->PROPERTY_ADDRESS->setVisibility();
		$this->PROPERTY_ACCOMODATION->setVisibility();
		$this->PROPERTY_DESCRIPTION->setVisibility();
		$this->PROPERTY_IMAGE->setVisibility();
		$this->PROPERTY_STATUS->setVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$fieldCount = 20;
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
		$this->Columns = [[FALSE, FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE]];

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();
		$this->APARTMENT_NAME->SelectionList = "";
		$this->APARTMENT_NAME->DefaultSelectionList = "";
		$this->APARTMENT_NAME->ValueList = "";

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
				$this->FirstRowData["BROKER_NAME"] = $this->Recordset->fields('BROKER NAME');
				$this->FirstRowData["PROPERTY_STATE"] = $this->Recordset->fields('PROPERTY STATE');
				$this->FirstRowData["PROPERTY_CITY"] = $this->Recordset->fields('PROPERTY CITY');
				$this->FirstRowData["PROPERTY_AREA"] = $this->Recordset->fields('PROPERTY AREA');
				$this->FirstRowData["PROPERTY_OWNER_NAME"] = $this->Recordset->fields('PROPERTY OWNER NAME');
				$this->FirstRowData["BROKER_MOBILE_NO_"] = $this->Recordset->fields('BROKER MOBILE NO.');
				$this->FirstRowData["PROPERTY_LANDMARK"] = $this->Recordset->fields('PROPERTY LANDMARK');
				$this->FirstRowData["PROPERTY_PRICE"] = $this->Recordset->fields('PROPERTY PRICE');
				$this->FirstRowData["PROPERTY_PLOT_NUMBER"] = $this->Recordset->fields('PROPERTY PLOT NUMBER');
				$this->FirstRowData["APARTMENT_NO_"] = $this->Recordset->fields('APARTMENT NO.');
				$this->FirstRowData["APARTMENT_NAME"] = $this->Recordset->fields('APARTMENT NAME');
				$this->FirstRowData["NO__OF_ROOMS"] = $this->Recordset->fields('NO. OF ROOMS');
				$this->FirstRowData["FLOOR_NO_"] = $this->Recordset->fields('FLOOR NO.');
				$this->FirstRowData["PROPERTY_PURPOSE"] = $this->Recordset->fields('PROPERTY PURPOSE');
				$this->FirstRowData["PROPERTY_ADDRESS"] = $this->Recordset->fields('PROPERTY ADDRESS');
				$this->FirstRowData["PROPERTY_ACCOMODATION"] = $this->Recordset->fields('PROPERTY ACCOMODATION');
				$this->FirstRowData["PROPERTY_DESCRIPTION"] = $this->Recordset->fields('PROPERTY DESCRIPTION');
				$this->FirstRowData["PROPERTY_IMAGE"] = $this->Recordset->fields('PROPERTY IMAGE');
				$this->FirstRowData["PROPERTY_STATUS"] = $this->Recordset->fields('PROPERTY STATUS');
		} else { // Get next row
			$this->Recordset->moveNext();
		}
		if (!$this->Recordset->EOF) {
			$this->BROKER_NAME->setDbValue($this->Recordset->fields('BROKER NAME'));
			$this->PROPERTY_STATE->setDbValue($this->Recordset->fields('PROPERTY STATE'));
			$this->PROPERTY_CITY->setDbValue($this->Recordset->fields('PROPERTY CITY'));
			$this->PROPERTY_AREA->setDbValue($this->Recordset->fields('PROPERTY AREA'));
			$this->PROPERTY_OWNER_NAME->setDbValue($this->Recordset->fields('PROPERTY OWNER NAME'));
			$this->BROKER_MOBILE_NO_->setDbValue($this->Recordset->fields('BROKER MOBILE NO.'));
			$this->PROPERTY_LANDMARK->setDbValue($this->Recordset->fields('PROPERTY LANDMARK'));
			$this->PROPERTY_PRICE->setDbValue($this->Recordset->fields('PROPERTY PRICE'));
			$this->PROPERTY_PLOT_NUMBER->setDbValue($this->Recordset->fields('PROPERTY PLOT NUMBER'));
			$this->APARTMENT_NO_->setDbValue($this->Recordset->fields('APARTMENT NO.'));
			$this->APARTMENT_NAME->setDbValue($this->Recordset->fields('APARTMENT NAME'));
			$this->NO__OF_ROOMS->setDbValue($this->Recordset->fields('NO. OF ROOMS'));
			$this->FLOOR_NO_->setDbValue($this->Recordset->fields('FLOOR NO.'));
			$this->PROPERTY_PURPOSE->setDbValue($this->Recordset->fields('PROPERTY PURPOSE'));
			$this->PROPERTY_ADDRESS->setDbValue($this->Recordset->fields('PROPERTY ADDRESS'));
			$this->PROPERTY_ACCOMODATION->setDbValue($this->Recordset->fields('PROPERTY ACCOMODATION'));
			$this->PROPERTY_DESCRIPTION->setDbValue($this->Recordset->fields('PROPERTY DESCRIPTION'));
			$this->PROPERTY_IMAGE->setDbValue($this->Recordset->fields('PROPERTY IMAGE'));
			$this->PROPERTY_STATUS->setDbValue($this->Recordset->fields('PROPERTY STATUS'));
			$this->Values[1] = $this->BROKER_NAME->CurrentValue;
			$this->Values[2] = $this->PROPERTY_STATE->CurrentValue;
			$this->Values[3] = $this->PROPERTY_CITY->CurrentValue;
			$this->Values[4] = $this->PROPERTY_AREA->CurrentValue;
			$this->Values[5] = $this->PROPERTY_OWNER_NAME->CurrentValue;
			$this->Values[6] = $this->BROKER_MOBILE_NO_->CurrentValue;
			$this->Values[7] = $this->PROPERTY_LANDMARK->CurrentValue;
			$this->Values[8] = $this->PROPERTY_PRICE->CurrentValue;
			$this->Values[9] = $this->PROPERTY_PLOT_NUMBER->CurrentValue;
			$this->Values[10] = $this->APARTMENT_NO_->CurrentValue;
			$this->Values[11] = $this->APARTMENT_NAME->CurrentValue;
			$this->Values[12] = $this->NO__OF_ROOMS->CurrentValue;
			$this->Values[13] = $this->FLOOR_NO_->CurrentValue;
			$this->Values[14] = $this->PROPERTY_PURPOSE->CurrentValue;
			$this->Values[15] = $this->PROPERTY_ADDRESS->CurrentValue;
			$this->Values[16] = $this->PROPERTY_ACCOMODATION->CurrentValue;
			$this->Values[17] = $this->PROPERTY_DESCRIPTION->CurrentValue;
			$this->Values[18] = $this->PROPERTY_IMAGE->CurrentValue;
			$this->Values[19] = $this->PROPERTY_STATUS->CurrentValue;
		} else {
			$this->BROKER_NAME->setDbValue("");
			$this->PROPERTY_STATE->setDbValue("");
			$this->PROPERTY_CITY->setDbValue("");
			$this->PROPERTY_AREA->setDbValue("");
			$this->PROPERTY_OWNER_NAME->setDbValue("");
			$this->BROKER_MOBILE_NO_->setDbValue("");
			$this->PROPERTY_LANDMARK->setDbValue("");
			$this->PROPERTY_PRICE->setDbValue("");
			$this->PROPERTY_PLOT_NUMBER->setDbValue("");
			$this->APARTMENT_NO_->setDbValue("");
			$this->APARTMENT_NAME->setDbValue("");
			$this->NO__OF_ROOMS->setDbValue("");
			$this->FLOOR_NO_->setDbValue("");
			$this->PROPERTY_PURPOSE->setDbValue("");
			$this->PROPERTY_ADDRESS->setDbValue("");
			$this->PROPERTY_ACCOMODATION->setDbValue("");
			$this->PROPERTY_DESCRIPTION->setDbValue("");
			$this->PROPERTY_IMAGE->setDbValue("");
			$this->PROPERTY_STATUS->setDbValue("");
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
			if (is_array($this->APARTMENT_NAME->AdvancedFilters)) {
				foreach ($this->APARTMENT_NAME->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->APARTMENT_NAME->DropDownList)) {
				foreach ($this->APARTMENT_NAME->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->APARTMENT_NAME->EditValue = $ar;
			$this->APARTMENT_NAME->AdvancedSearch->SearchValue = is_array($this->APARTMENT_NAME->DropDownValue) ? implode(",", $this->APARTMENT_NAME->DropDownValue) : $this->APARTMENT_NAME->DropDownValue;
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			PrependClass($this->RowAttrs["class"], ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

			// BROKER NAME
			$this->BROKER_NAME->HrefValue = "";

			// PROPERTY STATE
			$this->PROPERTY_STATE->HrefValue = "";

			// PROPERTY CITY
			$this->PROPERTY_CITY->HrefValue = "";

			// PROPERTY AREA
			$this->PROPERTY_AREA->HrefValue = "";

			// PROPERTY OWNER NAME
			$this->PROPERTY_OWNER_NAME->HrefValue = "";

			// BROKER MOBILE NO.
			$this->BROKER_MOBILE_NO_->HrefValue = "";

			// PROPERTY LANDMARK
			$this->PROPERTY_LANDMARK->HrefValue = "";

			// PROPERTY PRICE
			$this->PROPERTY_PRICE->HrefValue = "";

			// PROPERTY PLOT NUMBER
			$this->PROPERTY_PLOT_NUMBER->HrefValue = "";

			// APARTMENT NO.
			$this->APARTMENT_NO_->HrefValue = "";

			// APARTMENT NAME
			$this->APARTMENT_NAME->HrefValue = "";

			// NO. OF ROOMS
			$this->NO__OF_ROOMS->HrefValue = "";

			// FLOOR NO.
			$this->FLOOR_NO_->HrefValue = "";

			// PROPERTY PURPOSE
			$this->PROPERTY_PURPOSE->HrefValue = "";

			// PROPERTY ADDRESS
			$this->PROPERTY_ADDRESS->HrefValue = "";

			// PROPERTY ACCOMODATION
			$this->PROPERTY_ACCOMODATION->HrefValue = "";

			// PROPERTY DESCRIPTION
			$this->PROPERTY_DESCRIPTION->HrefValue = "";

			// PROPERTY IMAGE
			$this->PROPERTY_IMAGE->HrefValue = "";

			// PROPERTY STATUS
			$this->PROPERTY_STATUS->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			} else {
			}

			// BROKER NAME
			$this->BROKER_NAME->ViewValue = $this->BROKER_NAME->CurrentValue;
			$this->BROKER_NAME->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY STATE
			$this->PROPERTY_STATE->ViewValue = $this->PROPERTY_STATE->CurrentValue;
			$this->PROPERTY_STATE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY CITY
			$this->PROPERTY_CITY->ViewValue = $this->PROPERTY_CITY->CurrentValue;
			$this->PROPERTY_CITY->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY AREA
			$this->PROPERTY_AREA->ViewValue = $this->PROPERTY_AREA->CurrentValue;
			$this->PROPERTY_AREA->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY OWNER NAME
			$this->PROPERTY_OWNER_NAME->ViewValue = $this->PROPERTY_OWNER_NAME->CurrentValue;
			$this->PROPERTY_OWNER_NAME->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// BROKER MOBILE NO.
			$this->BROKER_MOBILE_NO_->ViewValue = $this->BROKER_MOBILE_NO_->CurrentValue;
			$this->BROKER_MOBILE_NO_->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY LANDMARK
			$this->PROPERTY_LANDMARK->ViewValue = $this->PROPERTY_LANDMARK->CurrentValue;
			$this->PROPERTY_LANDMARK->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY PRICE
			$this->PROPERTY_PRICE->ViewValue = $this->PROPERTY_PRICE->CurrentValue;
			$this->PROPERTY_PRICE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY PLOT NUMBER
			$this->PROPERTY_PLOT_NUMBER->ViewValue = $this->PROPERTY_PLOT_NUMBER->CurrentValue;
			$this->PROPERTY_PLOT_NUMBER->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// APARTMENT NO.
			$this->APARTMENT_NO_->ViewValue = $this->APARTMENT_NO_->CurrentValue;
			$this->APARTMENT_NO_->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// APARTMENT NAME
			$this->APARTMENT_NAME->ViewValue = $this->APARTMENT_NAME->CurrentValue;
			$this->APARTMENT_NAME->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// NO. OF ROOMS
			$this->NO__OF_ROOMS->ViewValue = $this->NO__OF_ROOMS->CurrentValue;
			$this->NO__OF_ROOMS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// FLOOR NO.
			$this->FLOOR_NO_->ViewValue = $this->FLOOR_NO_->CurrentValue;
			$this->FLOOR_NO_->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY PURPOSE
			$this->PROPERTY_PURPOSE->ViewValue = $this->PROPERTY_PURPOSE->CurrentValue;
			$this->PROPERTY_PURPOSE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY ADDRESS
			$this->PROPERTY_ADDRESS->ViewValue = $this->PROPERTY_ADDRESS->CurrentValue;
			$this->PROPERTY_ADDRESS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY ACCOMODATION
			$this->PROPERTY_ACCOMODATION->ViewValue = $this->PROPERTY_ACCOMODATION->CurrentValue;
			$this->PROPERTY_ACCOMODATION->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY DESCRIPTION
			$this->PROPERTY_DESCRIPTION->ViewValue = $this->PROPERTY_DESCRIPTION->CurrentValue;
			$this->PROPERTY_DESCRIPTION->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY IMAGE
			$this->PROPERTY_IMAGE->ViewValue = $this->PROPERTY_IMAGE->CurrentValue;
			$this->PROPERTY_IMAGE->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// PROPERTY STATUS
			$this->PROPERTY_STATUS->ViewValue = $this->PROPERTY_STATUS->CurrentValue;
			$this->PROPERTY_STATUS->ViewValue = FormatNumber($this->PROPERTY_STATUS->ViewValue, 0, -2, -2, -2);
			$this->PROPERTY_STATUS->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// BROKER NAME
			$this->BROKER_NAME->HrefValue = "";

			// PROPERTY STATE
			$this->PROPERTY_STATE->HrefValue = "";

			// PROPERTY CITY
			$this->PROPERTY_CITY->HrefValue = "";

			// PROPERTY AREA
			$this->PROPERTY_AREA->HrefValue = "";

			// PROPERTY OWNER NAME
			$this->PROPERTY_OWNER_NAME->HrefValue = "";

			// BROKER MOBILE NO.
			$this->BROKER_MOBILE_NO_->HrefValue = "";

			// PROPERTY LANDMARK
			$this->PROPERTY_LANDMARK->HrefValue = "";

			// PROPERTY PRICE
			$this->PROPERTY_PRICE->HrefValue = "";

			// PROPERTY PLOT NUMBER
			$this->PROPERTY_PLOT_NUMBER->HrefValue = "";

			// APARTMENT NO.
			$this->APARTMENT_NO_->HrefValue = "";

			// APARTMENT NAME
			$this->APARTMENT_NAME->HrefValue = "";

			// NO. OF ROOMS
			$this->NO__OF_ROOMS->HrefValue = "";

			// FLOOR NO.
			$this->FLOOR_NO_->HrefValue = "";

			// PROPERTY PURPOSE
			$this->PROPERTY_PURPOSE->HrefValue = "";

			// PROPERTY ADDRESS
			$this->PROPERTY_ADDRESS->HrefValue = "";

			// PROPERTY ACCOMODATION
			$this->PROPERTY_ACCOMODATION->HrefValue = "";

			// PROPERTY DESCRIPTION
			$this->PROPERTY_DESCRIPTION->HrefValue = "";

			// PROPERTY IMAGE
			$this->PROPERTY_IMAGE->HrefValue = "";

			// PROPERTY STATUS
			$this->PROPERTY_STATUS->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row
		} else {

			// BROKER NAME
			$currentValue = $this->BROKER_NAME->CurrentValue;
			$viewValue = &$this->BROKER_NAME->ViewValue;
			$viewAttrs = &$this->BROKER_NAME->ViewAttrs;
			$cellAttrs = &$this->BROKER_NAME->CellAttrs;
			$hrefValue = &$this->BROKER_NAME->HrefValue;
			$linkAttrs = &$this->BROKER_NAME->LinkAttrs;
			$this->Cell_Rendered($this->BROKER_NAME, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY STATE
			$currentValue = $this->PROPERTY_STATE->CurrentValue;
			$viewValue = &$this->PROPERTY_STATE->ViewValue;
			$viewAttrs = &$this->PROPERTY_STATE->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_STATE->CellAttrs;
			$hrefValue = &$this->PROPERTY_STATE->HrefValue;
			$linkAttrs = &$this->PROPERTY_STATE->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_STATE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY CITY
			$currentValue = $this->PROPERTY_CITY->CurrentValue;
			$viewValue = &$this->PROPERTY_CITY->ViewValue;
			$viewAttrs = &$this->PROPERTY_CITY->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_CITY->CellAttrs;
			$hrefValue = &$this->PROPERTY_CITY->HrefValue;
			$linkAttrs = &$this->PROPERTY_CITY->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_CITY, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY AREA
			$currentValue = $this->PROPERTY_AREA->CurrentValue;
			$viewValue = &$this->PROPERTY_AREA->ViewValue;
			$viewAttrs = &$this->PROPERTY_AREA->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_AREA->CellAttrs;
			$hrefValue = &$this->PROPERTY_AREA->HrefValue;
			$linkAttrs = &$this->PROPERTY_AREA->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_AREA, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY OWNER NAME
			$currentValue = $this->PROPERTY_OWNER_NAME->CurrentValue;
			$viewValue = &$this->PROPERTY_OWNER_NAME->ViewValue;
			$viewAttrs = &$this->PROPERTY_OWNER_NAME->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_OWNER_NAME->CellAttrs;
			$hrefValue = &$this->PROPERTY_OWNER_NAME->HrefValue;
			$linkAttrs = &$this->PROPERTY_OWNER_NAME->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_OWNER_NAME, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// BROKER MOBILE NO.
			$currentValue = $this->BROKER_MOBILE_NO_->CurrentValue;
			$viewValue = &$this->BROKER_MOBILE_NO_->ViewValue;
			$viewAttrs = &$this->BROKER_MOBILE_NO_->ViewAttrs;
			$cellAttrs = &$this->BROKER_MOBILE_NO_->CellAttrs;
			$hrefValue = &$this->BROKER_MOBILE_NO_->HrefValue;
			$linkAttrs = &$this->BROKER_MOBILE_NO_->LinkAttrs;
			$this->Cell_Rendered($this->BROKER_MOBILE_NO_, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY LANDMARK
			$currentValue = $this->PROPERTY_LANDMARK->CurrentValue;
			$viewValue = &$this->PROPERTY_LANDMARK->ViewValue;
			$viewAttrs = &$this->PROPERTY_LANDMARK->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_LANDMARK->CellAttrs;
			$hrefValue = &$this->PROPERTY_LANDMARK->HrefValue;
			$linkAttrs = &$this->PROPERTY_LANDMARK->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_LANDMARK, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY PRICE
			$currentValue = $this->PROPERTY_PRICE->CurrentValue;
			$viewValue = &$this->PROPERTY_PRICE->ViewValue;
			$viewAttrs = &$this->PROPERTY_PRICE->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_PRICE->CellAttrs;
			$hrefValue = &$this->PROPERTY_PRICE->HrefValue;
			$linkAttrs = &$this->PROPERTY_PRICE->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_PRICE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY PLOT NUMBER
			$currentValue = $this->PROPERTY_PLOT_NUMBER->CurrentValue;
			$viewValue = &$this->PROPERTY_PLOT_NUMBER->ViewValue;
			$viewAttrs = &$this->PROPERTY_PLOT_NUMBER->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_PLOT_NUMBER->CellAttrs;
			$hrefValue = &$this->PROPERTY_PLOT_NUMBER->HrefValue;
			$linkAttrs = &$this->PROPERTY_PLOT_NUMBER->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_PLOT_NUMBER, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// APARTMENT NO.
			$currentValue = $this->APARTMENT_NO_->CurrentValue;
			$viewValue = &$this->APARTMENT_NO_->ViewValue;
			$viewAttrs = &$this->APARTMENT_NO_->ViewAttrs;
			$cellAttrs = &$this->APARTMENT_NO_->CellAttrs;
			$hrefValue = &$this->APARTMENT_NO_->HrefValue;
			$linkAttrs = &$this->APARTMENT_NO_->LinkAttrs;
			$this->Cell_Rendered($this->APARTMENT_NO_, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// APARTMENT NAME
			$currentValue = $this->APARTMENT_NAME->CurrentValue;
			$viewValue = &$this->APARTMENT_NAME->ViewValue;
			$viewAttrs = &$this->APARTMENT_NAME->ViewAttrs;
			$cellAttrs = &$this->APARTMENT_NAME->CellAttrs;
			$hrefValue = &$this->APARTMENT_NAME->HrefValue;
			$linkAttrs = &$this->APARTMENT_NAME->LinkAttrs;
			$this->Cell_Rendered($this->APARTMENT_NAME, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// NO. OF ROOMS
			$currentValue = $this->NO__OF_ROOMS->CurrentValue;
			$viewValue = &$this->NO__OF_ROOMS->ViewValue;
			$viewAttrs = &$this->NO__OF_ROOMS->ViewAttrs;
			$cellAttrs = &$this->NO__OF_ROOMS->CellAttrs;
			$hrefValue = &$this->NO__OF_ROOMS->HrefValue;
			$linkAttrs = &$this->NO__OF_ROOMS->LinkAttrs;
			$this->Cell_Rendered($this->NO__OF_ROOMS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// FLOOR NO.
			$currentValue = $this->FLOOR_NO_->CurrentValue;
			$viewValue = &$this->FLOOR_NO_->ViewValue;
			$viewAttrs = &$this->FLOOR_NO_->ViewAttrs;
			$cellAttrs = &$this->FLOOR_NO_->CellAttrs;
			$hrefValue = &$this->FLOOR_NO_->HrefValue;
			$linkAttrs = &$this->FLOOR_NO_->LinkAttrs;
			$this->Cell_Rendered($this->FLOOR_NO_, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY PURPOSE
			$currentValue = $this->PROPERTY_PURPOSE->CurrentValue;
			$viewValue = &$this->PROPERTY_PURPOSE->ViewValue;
			$viewAttrs = &$this->PROPERTY_PURPOSE->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_PURPOSE->CellAttrs;
			$hrefValue = &$this->PROPERTY_PURPOSE->HrefValue;
			$linkAttrs = &$this->PROPERTY_PURPOSE->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_PURPOSE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY ADDRESS
			$currentValue = $this->PROPERTY_ADDRESS->CurrentValue;
			$viewValue = &$this->PROPERTY_ADDRESS->ViewValue;
			$viewAttrs = &$this->PROPERTY_ADDRESS->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_ADDRESS->CellAttrs;
			$hrefValue = &$this->PROPERTY_ADDRESS->HrefValue;
			$linkAttrs = &$this->PROPERTY_ADDRESS->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_ADDRESS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY ACCOMODATION
			$currentValue = $this->PROPERTY_ACCOMODATION->CurrentValue;
			$viewValue = &$this->PROPERTY_ACCOMODATION->ViewValue;
			$viewAttrs = &$this->PROPERTY_ACCOMODATION->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_ACCOMODATION->CellAttrs;
			$hrefValue = &$this->PROPERTY_ACCOMODATION->HrefValue;
			$linkAttrs = &$this->PROPERTY_ACCOMODATION->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_ACCOMODATION, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY DESCRIPTION
			$currentValue = $this->PROPERTY_DESCRIPTION->CurrentValue;
			$viewValue = &$this->PROPERTY_DESCRIPTION->ViewValue;
			$viewAttrs = &$this->PROPERTY_DESCRIPTION->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_DESCRIPTION->CellAttrs;
			$hrefValue = &$this->PROPERTY_DESCRIPTION->HrefValue;
			$linkAttrs = &$this->PROPERTY_DESCRIPTION->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_DESCRIPTION, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY IMAGE
			$currentValue = $this->PROPERTY_IMAGE->CurrentValue;
			$viewValue = &$this->PROPERTY_IMAGE->ViewValue;
			$viewAttrs = &$this->PROPERTY_IMAGE->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_IMAGE->CellAttrs;
			$hrefValue = &$this->PROPERTY_IMAGE->HrefValue;
			$linkAttrs = &$this->PROPERTY_IMAGE->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_IMAGE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PROPERTY STATUS
			$currentValue = $this->PROPERTY_STATUS->CurrentValue;
			$viewValue = &$this->PROPERTY_STATUS->ViewValue;
			$viewAttrs = &$this->PROPERTY_STATUS->ViewAttrs;
			$cellAttrs = &$this->PROPERTY_STATUS->CellAttrs;
			$hrefValue = &$this->PROPERTY_STATUS->HrefValue;
			$linkAttrs = &$this->PROPERTY_STATUS->LinkAttrs;
			$this->Cell_Rendered($this->PROPERTY_STATUS, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
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
				$this->clearSessionSelection("APARTMENT_NAME");
				$this->resetPager();
			}
		}

		// Load selection criteria to array
		// Get APARTMENT NAME selected values

		if (is_array(@$_SESSION["sel_view6_APARTMENT_NAME"])) {
			$this->loadSelectionFromSession("APARTMENT_NAME");
		} elseif (@$_SESSION["sel_view6_APARTMENT_NAME"] == INIT_VALUE) { // Select all
			$this->APARTMENT_NAME->SelectionList = "";
		}
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->BROKER_NAME->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_STATE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_CITY->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_AREA->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_OWNER_NAME->Visible)
			$this->DetailColumnCount += 1;
		if ($this->BROKER_MOBILE_NO_->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_LANDMARK->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_PRICE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_PLOT_NUMBER->Visible)
			$this->DetailColumnCount += 1;
		if ($this->APARTMENT_NO_->Visible)
			$this->DetailColumnCount += 1;
		if ($this->APARTMENT_NAME->Visible)
			$this->DetailColumnCount += 1;
		if ($this->NO__OF_ROOMS->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FLOOR_NO_->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_PURPOSE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_ADDRESS->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_ACCOMODATION->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_DESCRIPTION->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_IMAGE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PROPERTY_STATUS->Visible)
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
			$this->BROKER_NAME->setSort("");
			$this->PROPERTY_STATE->setSort("");
			$this->PROPERTY_CITY->setSort("");
			$this->PROPERTY_AREA->setSort("");
			$this->PROPERTY_OWNER_NAME->setSort("");
			$this->BROKER_MOBILE_NO_->setSort("");
			$this->PROPERTY_LANDMARK->setSort("");
			$this->PROPERTY_PRICE->setSort("");
			$this->PROPERTY_PLOT_NUMBER->setSort("");
			$this->APARTMENT_NO_->setSort("");
			$this->APARTMENT_NAME->setSort("");
			$this->NO__OF_ROOMS->setSort("");
			$this->FLOOR_NO_->setSort("");
			$this->PROPERTY_PURPOSE->setSort("");
			$this->PROPERTY_ADDRESS->setSort("");
			$this->PROPERTY_ACCOMODATION->setSort("");
			$this->PROPERTY_DESCRIPTION->setSort("");
			$this->PROPERTY_IMAGE->setSort("");
			$this->PROPERTY_STATUS->setSort("");

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

			// Set/clear dropdown for field APARTMENT NAME
			if ($this->PopupName == "view6_APARTMENT_NAME" && $this->PopupValue <> "") {
				if ($this->PopupValue == INIT_VALUE)
					$this->APARTMENT_NAME->DropDownValue = ALL_VALUE;
				else
					$this->APARTMENT_NAME->DropDownValue = $this->PopupValue;
				$restoreSession = FALSE; // Do not restore
			} elseif ($this->ExpiredExtendedFilter == "view6_APARTMENT_NAME") {
				$this->setSessionDropDownValue(INIT_VALUE, "", "APARTMENT_NAME");
			}

		// Reset search command
		} elseif (Get("cmd", "") == "reset") {

			// Load default values
			$this->setSessionDropDownValue($this->APARTMENT_NAME->DropDownValue, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator, "APARTMENT_NAME"); // Field APARTMENT NAME

			//$setupFilter = TRUE; // No need to set up, just use default
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field APARTMENT NAME
			if ($this->getDropDownValue($this->APARTMENT_NAME)) {
				$setupFilter = TRUE;
			} elseif ($this->APARTMENT_NAME->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_view6_APARTMENT_NAME"])) {
				$setupFilter = TRUE;
			}
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$this->getSessionDropDownValue($this->APARTMENT_NAME); // Field APARTMENT NAME
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->buildDropDownFilter($this->APARTMENT_NAME, $filter, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field APARTMENT NAME

		// Save parms to session
		$this->setSessionDropDownValue($this->APARTMENT_NAME->DropDownValue, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator, "APARTMENT_NAME"); // Field APARTMENT NAME

		// Setup filter
		if ($setupFilter) {

			// Field APARTMENT NAME
			$wrk = "";
			$this->buildDropDownFilter($this->APARTMENT_NAME, $wrk, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator);
			LoadSelectionFromFilter($this->APARTMENT_NAME, $wrk, $this->APARTMENT_NAME->SelectionList, $this->APARTMENT_NAME->DropDownValue);
			$_SESSION["sel_view6_APARTMENT_NAME"] = ($this->APARTMENT_NAME->SelectionList == "") ? INIT_VALUE : $this->APARTMENT_NAME->SelectionList;
		}

		// Field APARTMENT NAME
		LoadDropDownList($this->APARTMENT_NAME->DropDownList, $this->APARTMENT_NAME->DropDownValue);
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
		$this->getSessionValue($fld->DropDownValue, 'x_view6_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_view6_' . $parm);
	}

	// Get filter values from session
	protected function getSessionFilterValues(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue, 'x_view6_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_view6_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchCondition, 'v_view6_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue2, 'y_view6_' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator2, 'w_view6_' . $parm);
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
		$_SESSION['x_view6_' . $parm] = $sv;
		$_SESSION['z_view6_' . $parm] = $so;
	}

	// Set filter values to session
	protected function setSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm)
	{
		$_SESSION['x_view6_' . $parm] = $sv1;
		$_SESSION['z_view6_' . $parm] = $so1;
		$_SESSION['v_view6_' . $parm] = $sc;
		$_SESSION['y_view6_' . $parm] = $sv2;
		$_SESSION['w_view6_' . $parm] = $so2;
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
		$_SESSION["sel_view6_$parm"] = "";
		$_SESSION["rf_view6_$parm"] = "";
		$_SESSION["rt_view6_$parm"] = "";
	}

	// Load selection from session
	protected function loadSelectionFromSession($parm)
	{
		foreach ($this->fields as $fld) {
			if ($fld->Param == $parm) {
				$fld->SelectionList = @$_SESSION["sel_view6_$parm"];
				$fld->RangeFrom = @$_SESSION["rf_view6_$parm"];
				$fld->RangeTo = @$_SESSION["rt_view6_$parm"];
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
		// Field APARTMENT NAME

		$this->APARTMENT_NAME->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->APARTMENT_NAME->DropDownValue = $this->APARTMENT_NAME->DefaultDropDownValue;
		$wrk = "";
		$this->buildDropDownFilter($this->APARTMENT_NAME, $wrk, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator, TRUE);
		LoadSelectionFromFilter($this->APARTMENT_NAME, $wrk, $this->APARTMENT_NAME->DefaultSelectionList);
		if (!$this->SearchCommand)
			$this->APARTMENT_NAME->SelectionList = $this->APARTMENT_NAME->DefaultSelectionList;

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
		// Field APARTMENT NAME
		// $this->APARTMENT_NAME->DefaultSelectionList = ["val1", "val2"];

	}

	// Check if filter applied
	protected function checkFilter()
	{

		// Check APARTMENT NAME extended filter
		if ($this->nonTextFilterApplied($this->APARTMENT_NAME))
			return TRUE;

		// Check APARTMENT NAME popup filter
		if (!MatchedArray($this->APARTMENT_NAME->DefaultSelectionList, $this->APARTMENT_NAME->SelectionList))
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

		// Field APARTMENT NAME
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->APARTMENT_NAME, $extWrk, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator);
		if (is_array($this->APARTMENT_NAME->SelectionList))
			$wrk = JoinArray($this->APARTMENT_NAME->SelectionList, ", ", DATATYPE_STRING, 0, $this->Dbid);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->APARTMENT_NAME->caption() . "</span>" . $captionSuffix . $filter . "</div>";
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

		// Field APARTMENT NAME
		$wrk = "";
		$wrk = ($this->APARTMENT_NAME->DropDownValue <> INIT_VALUE) ? $this->APARTMENT_NAME->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_APARTMENT_NAME\":\"" . JsEncode($wrk) . "\"";
		if ($wrk == "") {
			$wrk = ($this->APARTMENT_NAME->SelectionList <> INIT_VALUE) ? $this->APARTMENT_NAME->SelectionList : "";
			if (is_array($wrk))
				$wrk = implode("||", $wrk);
			if ($wrk <> "")
				$wrk = "\"sel_APARTMENT_NAME\":\"" . JsEncode($wrk) . "\"";
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

		// Field APARTMENT NAME
		$restoreFilter = FALSE;
		if (array_key_exists("x_APARTMENT_NAME", $filter)) {
			$wrk = $filter["x_APARTMENT_NAME"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_APARTMENT_NAME"], "APARTMENT_NAME");
			$restoreFilter = TRUE;
		}
		if (array_key_exists("sel_APARTMENT_NAME", $filter)) {
			$wrk = $filter["sel_APARTMENT_NAME"];
			$wrk = explode("||", $wrk);
			$this->APARTMENT_NAME->SelectionList = $wrk;
			$_SESSION["sel_view6_APARTMENT_NAME"] = $wrk;
			$this->setSessionDropDownValue(INIT_VALUE, "", "APARTMENT_NAME"); // Clear drop down
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "APARTMENT_NAME");
			$this->APARTMENT_NAME->SelectionList = "";
			$_SESSION["sel_view6_APARTMENT_NAME"] = "";
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
		if (!$this->dropDownFilterExist($this->APARTMENT_NAME, $this->APARTMENT_NAME->AdvancedSearch->SearchOperator)) {
			if (is_array($this->APARTMENT_NAME->SelectionList)) {
				$filter = FilterSql($this->APARTMENT_NAME, "`APARTMENT NAME`", DATATYPE_STRING, $this->Dbid);

				// Call Page Filtering event
				$this->Page_Filtering($this->APARTMENT_NAME, $filter, "popup");
				$this->APARTMENT_NAME->CurrentFilter = $filter;
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