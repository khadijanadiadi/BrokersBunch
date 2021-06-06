<?php
namespace PHPReportMaker12\bokerbunchF;

/**
 * Table class for view6
 */
class view6_base extends ReportTable
{
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;
	public $BROKER_NAME;
	public $PROPERTY_STATE;
	public $PROPERTY_CITY;
	public $PROPERTY_AREA;
	public $PROPERTY_OWNER_NAME;
	public $BROKER_MOBILE_NO_;
	public $PROPERTY_LANDMARK;
	public $PROPERTY_PRICE;
	public $PROPERTY_PLOT_NUMBER;
	public $APARTMENT_NO_;
	public $APARTMENT_NAME;
	public $NO__OF_ROOMS;
	public $FLOOR_NO_;
	public $PROPERTY_PURPOSE;
	public $PROPERTY_ADDRESS;
	public $PROPERTY_ACCOMODATION;
	public $PROPERTY_DESCRIPTION;
	public $PROPERTY_IMAGE;
	public $PROPERTY_STATUS;

	// Constructor
	public function __construct()
	{
		global $ReportLanguage, $CurrentLanguage;

		// Language object
		if (!isset($ReportLanguage))
			$ReportLanguage = new ReportLanguage();
		$this->TableVar = 'view6_base';
		$this->TableName = 'view6';
		$this->TableType = 'VIEW';
		$this->TableReportType = 'rpt';
		$this->SourceTableIsCustomView = FALSE;
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// BROKER NAME
		$this->BROKER_NAME = new ReportField('view6_base', 'view6', 'x_BROKER_NAME', 'BROKER NAME', '`BROKER NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BROKER_NAME->Sortable = TRUE; // Allow sort
		$this->BROKER_NAME->DateFilter = "";
		$this->fields['BROKER NAME'] = &$this->BROKER_NAME;

		// PROPERTY STATE
		$this->PROPERTY_STATE = new ReportField('view6_base', 'view6', 'x_PROPERTY_STATE', 'PROPERTY STATE', '`PROPERTY STATE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_STATE->Sortable = TRUE; // Allow sort
		$this->PROPERTY_STATE->DateFilter = "";
		$this->fields['PROPERTY STATE'] = &$this->PROPERTY_STATE;

		// PROPERTY CITY
		$this->PROPERTY_CITY = new ReportField('view6_base', 'view6', 'x_PROPERTY_CITY', 'PROPERTY CITY', '`PROPERTY CITY`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_CITY->Sortable = TRUE; // Allow sort
		$this->PROPERTY_CITY->DateFilter = "";
		$this->fields['PROPERTY CITY'] = &$this->PROPERTY_CITY;

		// PROPERTY AREA
		$this->PROPERTY_AREA = new ReportField('view6_base', 'view6', 'x_PROPERTY_AREA', 'PROPERTY AREA', '`PROPERTY AREA`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_AREA->Sortable = TRUE; // Allow sort
		$this->PROPERTY_AREA->DateFilter = "";
		$this->fields['PROPERTY AREA'] = &$this->PROPERTY_AREA;

		// PROPERTY OWNER NAME
		$this->PROPERTY_OWNER_NAME = new ReportField('view6_base', 'view6', 'x_PROPERTY_OWNER_NAME', 'PROPERTY OWNER NAME', '`PROPERTY OWNER NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_OWNER_NAME->Sortable = TRUE; // Allow sort
		$this->PROPERTY_OWNER_NAME->DateFilter = "";
		$this->fields['PROPERTY OWNER NAME'] = &$this->PROPERTY_OWNER_NAME;

		// BROKER MOBILE NO.
		$this->BROKER_MOBILE_NO_ = new ReportField('view6_base', 'view6', 'x_BROKER_MOBILE_NO_', 'BROKER MOBILE NO.', '`BROKER MOBILE NO.`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BROKER_MOBILE_NO_->Sortable = TRUE; // Allow sort
		$this->BROKER_MOBILE_NO_->DateFilter = "";
		$this->fields['BROKER MOBILE NO.'] = &$this->BROKER_MOBILE_NO_;

		// PROPERTY LANDMARK
		$this->PROPERTY_LANDMARK = new ReportField('view6_base', 'view6', 'x_PROPERTY_LANDMARK', 'PROPERTY LANDMARK', '`PROPERTY LANDMARK`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_LANDMARK->Sortable = TRUE; // Allow sort
		$this->PROPERTY_LANDMARK->DateFilter = "";
		$this->fields['PROPERTY LANDMARK'] = &$this->PROPERTY_LANDMARK;

		// PROPERTY PRICE
		$this->PROPERTY_PRICE = new ReportField('view6_base', 'view6', 'x_PROPERTY_PRICE', 'PROPERTY PRICE', '`PROPERTY PRICE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_PRICE->Sortable = TRUE; // Allow sort
		$this->PROPERTY_PRICE->DateFilter = "";
		$this->fields['PROPERTY PRICE'] = &$this->PROPERTY_PRICE;

		// PROPERTY PLOT NUMBER
		$this->PROPERTY_PLOT_NUMBER = new ReportField('view6_base', 'view6', 'x_PROPERTY_PLOT_NUMBER', 'PROPERTY PLOT NUMBER', '`PROPERTY PLOT NUMBER`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_PLOT_NUMBER->Sortable = TRUE; // Allow sort
		$this->PROPERTY_PLOT_NUMBER->DateFilter = "";
		$this->fields['PROPERTY PLOT NUMBER'] = &$this->PROPERTY_PLOT_NUMBER;

		// APARTMENT NO.
		$this->APARTMENT_NO_ = new ReportField('view6_base', 'view6', 'x_APARTMENT_NO_', 'APARTMENT NO.', '`APARTMENT NO.`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->APARTMENT_NO_->Sortable = TRUE; // Allow sort
		$this->APARTMENT_NO_->DateFilter = "";
		$this->fields['APARTMENT NO.'] = &$this->APARTMENT_NO_;

		// APARTMENT NAME
		$this->APARTMENT_NAME = new ReportField('view6_base', 'view6', 'x_APARTMENT_NAME', 'APARTMENT NAME', '`APARTMENT NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->APARTMENT_NAME->Sortable = TRUE; // Allow sort
		$this->APARTMENT_NAME->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->APARTMENT_NAME->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->APARTMENT_NAME->DateFilter = "";
		$this->APARTMENT_NAME->Lookup = new ReportLookup('APARTMENT NAME', 'view6_base', TRUE, 'APARTMENT NAME', ["APARTMENT NAME","","",""], [], [], [], [], [], [], '`APARTMENT NAME` ASC', '');
		$this->APARTMENT_NAME->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['APARTMENT NAME'] = &$this->APARTMENT_NAME;

		// NO. OF ROOMS
		$this->NO__OF_ROOMS = new ReportField('view6_base', 'view6', 'x_NO__OF_ROOMS', 'NO. OF ROOMS', '`NO. OF ROOMS`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NO__OF_ROOMS->Sortable = TRUE; // Allow sort
		$this->NO__OF_ROOMS->DateFilter = "";
		$this->fields['NO. OF ROOMS'] = &$this->NO__OF_ROOMS;

		// FLOOR NO.
		$this->FLOOR_NO_ = new ReportField('view6_base', 'view6', 'x_FLOOR_NO_', 'FLOOR NO.', '`FLOOR NO.`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FLOOR_NO_->Sortable = TRUE; // Allow sort
		$this->FLOOR_NO_->DateFilter = "";
		$this->fields['FLOOR NO.'] = &$this->FLOOR_NO_;

		// PROPERTY PURPOSE
		$this->PROPERTY_PURPOSE = new ReportField('view6_base', 'view6', 'x_PROPERTY_PURPOSE', 'PROPERTY PURPOSE', '`PROPERTY PURPOSE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_PURPOSE->Sortable = TRUE; // Allow sort
		$this->PROPERTY_PURPOSE->DateFilter = "";
		$this->fields['PROPERTY PURPOSE'] = &$this->PROPERTY_PURPOSE;

		// PROPERTY ADDRESS
		$this->PROPERTY_ADDRESS = new ReportField('view6_base', 'view6', 'x_PROPERTY_ADDRESS', 'PROPERTY ADDRESS', '`PROPERTY ADDRESS`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_ADDRESS->Sortable = TRUE; // Allow sort
		$this->PROPERTY_ADDRESS->DateFilter = "";
		$this->fields['PROPERTY ADDRESS'] = &$this->PROPERTY_ADDRESS;

		// PROPERTY ACCOMODATION
		$this->PROPERTY_ACCOMODATION = new ReportField('view6_base', 'view6', 'x_PROPERTY_ACCOMODATION', 'PROPERTY ACCOMODATION', '`PROPERTY ACCOMODATION`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_ACCOMODATION->Sortable = TRUE; // Allow sort
		$this->PROPERTY_ACCOMODATION->DateFilter = "";
		$this->fields['PROPERTY ACCOMODATION'] = &$this->PROPERTY_ACCOMODATION;

		// PROPERTY DESCRIPTION
		$this->PROPERTY_DESCRIPTION = new ReportField('view6_base', 'view6', 'x_PROPERTY_DESCRIPTION', 'PROPERTY DESCRIPTION', '`PROPERTY DESCRIPTION`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_DESCRIPTION->Sortable = TRUE; // Allow sort
		$this->PROPERTY_DESCRIPTION->DateFilter = "";
		$this->fields['PROPERTY DESCRIPTION'] = &$this->PROPERTY_DESCRIPTION;

		// PROPERTY IMAGE
		$this->PROPERTY_IMAGE = new ReportField('view6_base', 'view6', 'x_PROPERTY_IMAGE', 'PROPERTY IMAGE', '`PROPERTY IMAGE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_IMAGE->Sortable = TRUE; // Allow sort
		$this->PROPERTY_IMAGE->DateFilter = "";
		$this->fields['PROPERTY IMAGE'] = &$this->PROPERTY_IMAGE;

		// PROPERTY STATUS
		$this->PROPERTY_STATUS = new ReportField('view6_base', 'view6', 'x_PROPERTY_STATUS', 'PROPERTY STATUS', '`PROPERTY STATUS`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PROPERTY_STATUS->Sortable = TRUE; // Allow sort
		$this->PROPERTY_STATUS->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->PROPERTY_STATUS->DateFilter = "";
		$this->fields['PROPERTY STATUS'] = &$this->PROPERTY_STATUS;
	}

	// Render for popup
	public function renderPopup()
	{
		global $ReportLanguage;
		if ($this->APARTMENT_NAME->CurrentValue === NULL) // Handle null value
			$this->APARTMENT_NAME->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->APARTMENT_NAME->CurrentValue == "") // Handle empty value
			$this->APARTMENT_NAME->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->APARTMENT_NAME->ViewValue = $this->APARTMENT_NAME->CurrentValue;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->APARTMENT_NAME->ViewValue = GetDropDownDisplayValue($this->APARTMENT_NAME->CurrentValue, "", 0);
	}

	// Get Field Visibility
	public function getFieldVisibility($fldparm)
	{
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql <> "") {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table level SQL
	private $_sqlFrom = "";
	private $_sqlSelect = "";
	private $_sqlWhere = "";
	private $_sqlGroupBy = "";
	private $_sqlHaving = "";
	private $_sqlOrderBy = "";

	// From
	public function getSqlFrom()
	{
		return ($this->_sqlFrom <> "") ? $this->_sqlFrom : "`view6`";
	}
	public function setSqlFrom($v)
	{
		$this->_sqlFrom = $v;
	}

	// Select
	public function getSqlSelect()
	{
		return ($this->_sqlSelect <> "") ? $this->_sqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelect($v)
	{
		$this->_sqlSelect = $v;
	}

	// Where
	public function getSqlWhere()
	{
		$where = ($this->_sqlWhere <> "") ? $this->_sqlWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlWhere($v)
	{
		$this->_sqlWhere = $v;
	}

	// Group By
	public function getSqlGroupBy()
	{
		return ($this->_sqlGroupBy <> "") ? $this->_sqlGroupBy : "";
	}
	public function setSqlGroupBy($v)
	{
		$this->_sqlGroupBy = $v;
	}

	// Having
	public function getSqlHaving()
	{
		return ($this->_sqlHaving <> "") ? $this->_sqlHaving : "";
	}
	public function setSqlHaving($v)
	{
		$this->_sqlHaving = $v;
	}

	// Order By
	public function getSqlOrderBy()
	{
		return ($this->_sqlOrderBy <> "") ? $this->_sqlOrderBy : "";
	}
	public function setSqlOrderBy($v)
	{
		$this->_sqlOrderBy = $v;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate <> "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix <> "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix <> "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount <> "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = '';
		return $rs;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		return "";
	}

	// Lookup data from table
	public function lookup()
	{

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new ReportLookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if (Post("keys") !== NULL) { // Selected records from modal
			$keys = Post("keys");
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>