<?php
namespace PHPReportMaker12\bokerbunchF;

/**
 * Table class for view10
 */
class view10_base extends ReportTable
{
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;
	public $CITY;
	public $STATE;
	public $AREA;
	public $BROKER_NAME;
	public $OWNER_NAME;
	public $BROKER_MOBILE;
	public $BROKER_EMAIL;
	public $LANDMARK;
	public $PRICE;
	public $PLOT_NUMBER;
	public $APARTMENT_NAME;
	public $APARTMENT_NO_;
	public $ROOMS;
	public $FLOOR;
	public $PURPOSE;
	public $ADDRESS;
	public $ACCOMMODATION;
	public $DESCRIPTION;
	public $IMAGE;
	public $STATUS;

	// Constructor
	public function __construct()
	{
		global $ReportLanguage, $CurrentLanguage;

		// Language object
		if (!isset($ReportLanguage))
			$ReportLanguage = new ReportLanguage();
		$this->TableVar = 'view10_base';
		$this->TableName = 'view10';
		$this->TableType = 'VIEW';
		$this->TableReportType = 'rpt';
		$this->SourceTableIsCustomView = FALSE;
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// CITY
		$this->CITY = new ReportField('view10_base', 'view10', 'x_CITY', 'CITY', '`CITY`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CITY->Sortable = TRUE; // Allow sort
		$this->CITY->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CITY->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->CITY->DateFilter = "";
		$this->CITY->Lookup = new ReportLookup('CITY', 'view10_base', TRUE, 'CITY', ["CITY","","",""], [], [], [], [], [], [], '`CITY` ASC', '');
		$this->CITY->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['CITY'] = &$this->CITY;

		// STATE
		$this->STATE = new ReportField('view10_base', 'view10', 'x_STATE', 'STATE', '`STATE`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->STATE->Sortable = TRUE; // Allow sort
		$this->STATE->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->STATE->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->STATE->DateFilter = "";
		$this->STATE->Lookup = new ReportLookup('STATE', 'view10_base', TRUE, 'STATE', ["STATE","","",""], [], [], [], [], [], [], '`STATE` ASC', '');
		$this->STATE->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['STATE'] = &$this->STATE;

		// AREA
		$this->AREA = new ReportField('view10_base', 'view10', 'x_AREA', 'AREA', '`AREA`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AREA->Sortable = TRUE; // Allow sort
		$this->AREA->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AREA->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->AREA->DateFilter = "";
		$this->AREA->Lookup = new ReportLookup('AREA', 'view10_base', TRUE, 'AREA', ["AREA","","",""], [], [], [], [], [], [], '`AREA` ASC', '');
		$this->AREA->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['AREA'] = &$this->AREA;

		// BROKER NAME
		$this->BROKER_NAME = new ReportField('view10_base', 'view10', 'x_BROKER_NAME', 'BROKER NAME', '`BROKER NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BROKER_NAME->Sortable = TRUE; // Allow sort
		$this->BROKER_NAME->DateFilter = "";
		$this->fields['BROKER NAME'] = &$this->BROKER_NAME;

		// OWNER NAME
		$this->OWNER_NAME = new ReportField('view10_base', 'view10', 'x_OWNER_NAME', 'OWNER NAME', '`OWNER NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OWNER_NAME->Sortable = TRUE; // Allow sort
		$this->OWNER_NAME->DateFilter = "";
		$this->fields['OWNER NAME'] = &$this->OWNER_NAME;

		// BROKER MOBILE
		$this->BROKER_MOBILE = new ReportField('view10_base', 'view10', 'x_BROKER_MOBILE', 'BROKER MOBILE', '`BROKER MOBILE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BROKER_MOBILE->Sortable = TRUE; // Allow sort
		$this->BROKER_MOBILE->DateFilter = "";
		$this->fields['BROKER MOBILE'] = &$this->BROKER_MOBILE;

		// BROKER EMAIL
		$this->BROKER_EMAIL = new ReportField('view10_base', 'view10', 'x_BROKER_EMAIL', 'BROKER EMAIL', '`BROKER EMAIL`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BROKER_EMAIL->Sortable = TRUE; // Allow sort
		$this->BROKER_EMAIL->DateFilter = "";
		$this->fields['BROKER EMAIL'] = &$this->BROKER_EMAIL;

		// LANDMARK
		$this->LANDMARK = new ReportField('view10_base', 'view10', 'x_LANDMARK', 'LANDMARK', '`LANDMARK`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LANDMARK->Sortable = TRUE; // Allow sort
		$this->LANDMARK->DateFilter = "";
		$this->fields['LANDMARK'] = &$this->LANDMARK;

		// PRICE
		$this->PRICE = new ReportField('view10_base', 'view10', 'x_PRICE', 'PRICE', '`PRICE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PRICE->Sortable = TRUE; // Allow sort
		$this->PRICE->DateFilter = "";
		$this->fields['PRICE'] = &$this->PRICE;

		// PLOT NUMBER
		$this->PLOT_NUMBER = new ReportField('view10_base', 'view10', 'x_PLOT_NUMBER', 'PLOT NUMBER', '`PLOT NUMBER`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PLOT_NUMBER->Sortable = TRUE; // Allow sort
		$this->PLOT_NUMBER->DateFilter = "";
		$this->fields['PLOT NUMBER'] = &$this->PLOT_NUMBER;

		// APARTMENT NAME
		$this->APARTMENT_NAME = new ReportField('view10_base', 'view10', 'x_APARTMENT_NAME', 'APARTMENT NAME', '`APARTMENT NAME`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->APARTMENT_NAME->Sortable = TRUE; // Allow sort
		$this->APARTMENT_NAME->DateFilter = "";
		$this->fields['APARTMENT NAME'] = &$this->APARTMENT_NAME;

		// APARTMENT NO.
		$this->APARTMENT_NO_ = new ReportField('view10_base', 'view10', 'x_APARTMENT_NO_', 'APARTMENT NO.', '`APARTMENT NO.`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->APARTMENT_NO_->Sortable = TRUE; // Allow sort
		$this->APARTMENT_NO_->DateFilter = "";
		$this->fields['APARTMENT NO.'] = &$this->APARTMENT_NO_;

		// ROOMS
		$this->ROOMS = new ReportField('view10_base', 'view10', 'x_ROOMS', 'ROOMS', '`ROOMS`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ROOMS->Sortable = TRUE; // Allow sort
		$this->ROOMS->DateFilter = "";
		$this->fields['ROOMS'] = &$this->ROOMS;

		// FLOOR
		$this->FLOOR = new ReportField('view10_base', 'view10', 'x_FLOOR', 'FLOOR', '`FLOOR`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FLOOR->Sortable = TRUE; // Allow sort
		$this->FLOOR->DateFilter = "";
		$this->fields['FLOOR'] = &$this->FLOOR;

		// PURPOSE
		$this->PURPOSE = new ReportField('view10_base', 'view10', 'x_PURPOSE', 'PURPOSE', '`PURPOSE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PURPOSE->Sortable = TRUE; // Allow sort
		$this->PURPOSE->DateFilter = "";
		$this->fields['PURPOSE'] = &$this->PURPOSE;

		// ADDRESS
		$this->ADDRESS = new ReportField('view10_base', 'view10', 'x_ADDRESS', 'ADDRESS', '`ADDRESS`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ADDRESS->Sortable = TRUE; // Allow sort
		$this->ADDRESS->DateFilter = "";
		$this->fields['ADDRESS'] = &$this->ADDRESS;

		// ACCOMMODATION
		$this->ACCOMMODATION = new ReportField('view10_base', 'view10', 'x_ACCOMMODATION', 'ACCOMMODATION', '`ACCOMMODATION`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ACCOMMODATION->Sortable = TRUE; // Allow sort
		$this->ACCOMMODATION->DateFilter = "";
		$this->fields['ACCOMMODATION'] = &$this->ACCOMMODATION;

		// DESCRIPTION
		$this->DESCRIPTION = new ReportField('view10_base', 'view10', 'x_DESCRIPTION', 'DESCRIPTION', '`DESCRIPTION`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DESCRIPTION->Sortable = TRUE; // Allow sort
		$this->DESCRIPTION->DateFilter = "";
		$this->fields['DESCRIPTION'] = &$this->DESCRIPTION;

		// IMAGE
		$this->IMAGE = new ReportField('view10_base', 'view10', 'x_IMAGE', 'IMAGE', '`IMAGE`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IMAGE->Sortable = TRUE; // Allow sort
		$this->IMAGE->DateFilter = "";
		$this->fields['IMAGE'] = &$this->IMAGE;

		// STATUS
		$this->STATUS = new ReportField('view10_base', 'view10', 'x_STATUS', 'STATUS', '`STATUS`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->STATUS->Sortable = TRUE; // Allow sort
		$this->STATUS->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->STATUS->DateFilter = "";
		$this->fields['STATUS'] = &$this->STATUS;
	}

	// Render for popup
	public function renderPopup()
	{
		global $ReportLanguage;
		if ($this->CITY->CurrentValue === NULL) // Handle null value
			$this->CITY->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->CITY->CurrentValue == "") // Handle empty value
			$this->CITY->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->CITY->ViewValue = $this->CITY->CurrentValue;
		if ($this->STATE->CurrentValue === NULL) // Handle null value
			$this->STATE->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->STATE->CurrentValue == "") // Handle empty value
			$this->STATE->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->STATE->ViewValue = $this->STATE->CurrentValue;
		if ($this->AREA->CurrentValue === NULL) // Handle null value
			$this->AREA->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->AREA->CurrentValue == "") // Handle empty value
			$this->AREA->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->AREA->ViewValue = $this->AREA->CurrentValue;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->CITY->ViewValue = GetDropDownDisplayValue($this->CITY->CurrentValue, "", 0);
		$this->STATE->ViewValue = GetDropDownDisplayValue($this->STATE->CurrentValue, "", 0);
		$this->AREA->ViewValue = GetDropDownDisplayValue($this->AREA->CurrentValue, "", 0);
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
		return ($this->_sqlFrom <> "") ? $this->_sqlFrom : "`view10`";
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