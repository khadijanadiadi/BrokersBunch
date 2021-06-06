<?php
namespace PHPReportMaker12\bokerbunchF;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($view9_rpt))
	$view9_rpt = new view9_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view9_rpt;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print") { ?>
<script>
currentPageID = ew.PAGE_ID = "rpt"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Form object
var fview9rpt = currentForm = new ew.Form("fview9rpt");

// Validate method
fview9rpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview9rpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fview9rpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview9rpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview9rpt.lists["x_STATE"] = <?php echo $view9_rpt->STATE->Lookup->toClientList() ?>;
fview9rpt.lists["x_STATE"].popupValues = <?php echo json_encode($view9_rpt->STATE->SelectionList) ?>;
fview9rpt.lists["x_STATE"].popupOptions = <?php echo JsonEncode($view9_rpt->STATE->popupOptions()) ?>;
fview9rpt.lists["x_STATE"].options = <?php echo JsonEncode($view9_rpt->STATE->lookupOptions()) ?>;
fview9rpt.lists["x_CITY"] = <?php echo $view9_rpt->CITY->Lookup->toClientList() ?>;
fview9rpt.lists["x_CITY"].popupValues = <?php echo json_encode($view9_rpt->CITY->SelectionList) ?>;
fview9rpt.lists["x_CITY"].popupOptions = <?php echo JsonEncode($view9_rpt->CITY->popupOptions()) ?>;
fview9rpt.lists["x_CITY"].options = <?php echo JsonEncode($view9_rpt->CITY->lookupOptions()) ?>;
fview9rpt.lists["x_AREA"] = <?php echo $view9_rpt->AREA->Lookup->toClientList() ?>;
fview9rpt.lists["x_AREA"].popupValues = <?php echo json_encode($view9_rpt->AREA->SelectionList) ?>;
fview9rpt.lists["x_AREA"].popupOptions = <?php echo JsonEncode($view9_rpt->AREA->popupOptions()) ?>;
fview9rpt.lists["x_AREA"].options = <?php echo JsonEncode($view9_rpt->AREA->lookupOptions()) ?>;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
<?php } ?>
<?php if (ReportParam("showfilter") === TRUE) { ?>
<?php $Page->showFilterList(TRUE) ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php $Page->showMessage(); ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ew-center" class="<?php echo $view9_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<!-- Search form (begin) -->
<?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
<form name="fview9rpt" id="fview9rpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fview9rpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_STATE" class="ew-cell form-group">
	<label for="x_STATE" class="ew-search-caption ew-label"><?php echo $Page->STATE->caption() ?></label>
	<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view9" data-field="x_STATE" data-value-separator="<?php echo $Page->STATE->displayValueSeparatorAttribute() ?>" id="x_STATE" name="x_STATE"<?php echo $Page->STATE->editAttributes() ?>>
		<?php echo $Page->STATE->selectOptionListHtml("x_STATE") ?>
	</select>
</div>
<?php echo $Page->STATE->Lookup->getParamTag("p_x_STATE") ?>
</span>
</div>
</div>
<div id="r_2" class="ew-row d-sm-flex">
<div id="c_CITY" class="ew-cell form-group">
	<label for="x_CITY" class="ew-search-caption ew-label"><?php echo $Page->CITY->caption() ?></label>
	<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view9" data-field="x_CITY" data-value-separator="<?php echo $Page->CITY->displayValueSeparatorAttribute() ?>" id="x_CITY" name="x_CITY"<?php echo $Page->CITY->editAttributes() ?>>
		<?php echo $Page->CITY->selectOptionListHtml("x_CITY") ?>
	</select>
</div>
<?php echo $Page->CITY->Lookup->getParamTag("p_x_CITY") ?>
</span>
</div>
</div>
<div id="r_3" class="ew-row d-sm-flex">
<div id="c_AREA" class="ew-cell form-group">
	<label for="x_AREA" class="ew-search-caption ew-label"><?php echo $Page->AREA->caption() ?></label>
	<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view9" data-field="x_AREA" data-value-separator="<?php echo $Page->AREA->displayValueSeparatorAttribute() ?>" id="x_AREA" name="x_AREA"<?php echo $Page->AREA->editAttributes() ?>>
		<?php echo $Page->AREA->selectOptionListHtml("x_AREA") ?>
	</select>
</div>
<?php echo $Page->AREA->Lookup->getParamTag("p_x_AREA") ?>
</span>
</div>
</div>
<div class="ew-row d-sm-flex">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><?php echo $ReportLanguage->phrase("Search") ?></button>
<button type="reset" name="btn-reset" id="btn-reset" class="btn hide"><?php echo $ReportLanguage->phrase("Reset") ?></button>
</div>
</div>
</form>
<script>
fview9rpt.filterList = <?php echo $Page->getFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_view9" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->STATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATE"><div class="view9_STATE"><span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATE">
<?php if ($Page->sortUrl($Page->STATE) == "") { ?>
		<div class="ew-table-header-btn view9_STATE">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_STATE', form: 'fview9rpt', name: 'view9_STATE', range: false, from: '<?php echo $Page->STATE->RangeFrom; ?>', to: '<?php echo $Page->STATE->RangeTo; ?>' });" id="x_STATE<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_STATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_STATE', form: 'fview9rpt', name: 'view9_STATE', range: false, from: '<?php echo $Page->STATE->RangeFrom; ?>', to: '<?php echo $Page->STATE->RangeTo; ?>' });" id="x_STATE<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CITY"><div class="view9_CITY"><span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CITY">
<?php if ($Page->sortUrl($Page->CITY) == "") { ?>
		<div class="ew-table-header-btn view9_CITY">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_CITY', form: 'fview9rpt', name: 'view9_CITY', range: false, from: '<?php echo $Page->CITY->RangeFrom; ?>', to: '<?php echo $Page->CITY->RangeTo; ?>' });" id="x_CITY<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_CITY" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->CITY) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->CITY->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->CITY->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_CITY', form: 'fview9rpt', name: 'view9_CITY', range: false, from: '<?php echo $Page->CITY->RangeFrom; ?>', to: '<?php echo $Page->CITY->RangeTo; ?>' });" id="x_CITY<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="AREA"><div class="view9_AREA"><span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="AREA">
<?php if ($Page->sortUrl($Page->AREA) == "") { ?>
		<div class="ew-table-header-btn view9_AREA">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_AREA', form: 'fview9rpt', name: 'view9_AREA', range: false, from: '<?php echo $Page->AREA->RangeFrom; ?>', to: '<?php echo $Page->AREA->RangeTo; ?>' });" id="x_AREA<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_AREA" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->AREA) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->AREA->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->AREA->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_AREA', form: 'fview9rpt', name: 'view9_AREA', range: false, from: '<?php echo $Page->AREA->RangeFrom; ?>', to: '<?php echo $Page->AREA->RangeTo; ?>' });" id="x_AREA<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_NAME"><div class="view9_BROKER_NAME"><span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_NAME">
<?php if ($Page->sortUrl($Page->BROKER_NAME) == "") { ?>
		<div class="ew-table-header-btn view9_BROKER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_BROKER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->OWNER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="OWNER_NAME"><div class="view9_OWNER_NAME"><span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="OWNER_NAME">
<?php if ($Page->sortUrl($Page->OWNER_NAME) == "") { ?>
		<div class="ew-table-header-btn view9_OWNER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_OWNER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->OWNER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->OWNER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->OWNER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_MOBILE"><div class="view9_BROKER_MOBILE"><span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_MOBILE">
<?php if ($Page->sortUrl($Page->BROKER_MOBILE) == "") { ?>
		<div class="ew-table-header-btn view9_BROKER_MOBILE">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_BROKER_MOBILE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_MOBILE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_MOBILE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_MOBILE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_EMAIL->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_EMAIL"><div class="view9_BROKER_EMAIL"><span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_EMAIL">
<?php if ($Page->sortUrl($Page->BROKER_EMAIL) == "") { ?>
		<div class="ew-table-header-btn view9_BROKER_EMAIL">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_BROKER_EMAIL" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_EMAIL) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_EMAIL->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_EMAIL->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->LANDMARK->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="LANDMARK"><div class="view9_LANDMARK"><span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="LANDMARK">
<?php if ($Page->sortUrl($Page->LANDMARK) == "") { ?>
		<div class="ew-table-header-btn view9_LANDMARK">
			<span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_LANDMARK" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->LANDMARK) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->LANDMARK->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->LANDMARK->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PRICE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PRICE"><div class="view9_PRICE"><span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PRICE">
<?php if ($Page->sortUrl($Page->PRICE) == "") { ?>
		<div class="ew-table-header-btn view9_PRICE">
			<span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_PRICE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PRICE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PRICE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PRICE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->DEPOSITE_AMOUNT->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="DEPOSITE_AMOUNT"><div class="view9_DEPOSITE_AMOUNT"><span class="ew-table-header-caption"><?php echo $Page->DEPOSITE_AMOUNT->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="DEPOSITE_AMOUNT">
<?php if ($Page->sortUrl($Page->DEPOSITE_AMOUNT) == "") { ?>
		<div class="ew-table-header-btn view9_DEPOSITE_AMOUNT">
			<span class="ew-table-header-caption"><?php echo $Page->DEPOSITE_AMOUNT->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_DEPOSITE_AMOUNT" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->DEPOSITE_AMOUNT) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->DEPOSITE_AMOUNT->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->DEPOSITE_AMOUNT->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->DEPOSITE_AMOUNT->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PLOT_NUMBER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PLOT_NUMBER"><div class="view9_PLOT_NUMBER"><span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PLOT_NUMBER">
<?php if ($Page->sortUrl($Page->PLOT_NUMBER) == "") { ?>
		<div class="ew-table-header-btn view9_PLOT_NUMBER">
			<span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_PLOT_NUMBER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PLOT_NUMBER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PLOT_NUMBER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PLOT_NUMBER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ROOMS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ROOMS"><div class="view9_ROOMS"><span class="ew-table-header-caption"><?php echo $Page->ROOMS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ROOMS">
<?php if ($Page->sortUrl($Page->ROOMS) == "") { ?>
		<div class="ew-table-header-btn view9_ROOMS">
			<span class="ew-table-header-caption"><?php echo $Page->ROOMS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_ROOMS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ROOMS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ROOMS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ROOMS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ROOMS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ADDRESS"><div class="view9_ADDRESS"><span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ADDRESS">
<?php if ($Page->sortUrl($Page->ADDRESS) == "") { ?>
		<div class="ew-table-header-btn view9_ADDRESS">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_ADDRESS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ADDRESS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ADDRESS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ADDRESS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ACCOMMODATION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ACCOMMODATION"><div class="view9_ACCOMMODATION"><span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ACCOMMODATION">
<?php if ($Page->sortUrl($Page->ACCOMMODATION) == "") { ?>
		<div class="ew-table-header-btn view9_ACCOMMODATION">
			<span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_ACCOMMODATION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ACCOMMODATION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ACCOMMODATION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ACCOMMODATION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="DESCRIPTION"><div class="view9_DESCRIPTION"><span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="DESCRIPTION">
<?php if ($Page->sortUrl($Page->DESCRIPTION) == "") { ?>
		<div class="ew-table-header-btn view9_DESCRIPTION">
			<span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_DESCRIPTION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->DESCRIPTION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->DESCRIPTION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->DESCRIPTION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->IMAGE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="IMAGE"><div class="view9_IMAGE"><span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="IMAGE">
<?php if ($Page->sortUrl($Page->IMAGE) == "") { ?>
		<div class="ew-table-header-btn view9_IMAGE">
			<span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_IMAGE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->IMAGE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->IMAGE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->IMAGE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->STATUS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATUS"><div class="view9_STATUS"><span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATUS">
<?php if ($Page->sortUrl($Page->STATUS) == "") { ?>
		<div class="ew-table-header-btn view9_STATUS">
			<span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view9_STATUS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATUS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATUS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATUS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->STATE->Visible) { ?>
		<td data-field="STATE"<?php echo $Page->STATE->cellAttributes() ?>>
<span<?php echo $Page->STATE->viewAttributes() ?>><?php echo $Page->STATE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
		<td data-field="CITY"<?php echo $Page->CITY->cellAttributes() ?>>
<span<?php echo $Page->CITY->viewAttributes() ?>><?php echo $Page->CITY->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
		<td data-field="AREA"<?php echo $Page->AREA->cellAttributes() ?>>
<span<?php echo $Page->AREA->viewAttributes() ?>><?php echo $Page->AREA->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_NAME->Visible) { ?>
		<td data-field="BROKER_NAME"<?php echo $Page->BROKER_NAME->cellAttributes() ?>>
<span<?php echo $Page->BROKER_NAME->viewAttributes() ?>><?php echo $Page->BROKER_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->OWNER_NAME->Visible) { ?>
		<td data-field="OWNER_NAME"<?php echo $Page->OWNER_NAME->cellAttributes() ?>>
<span<?php echo $Page->OWNER_NAME->viewAttributes() ?>><?php echo $Page->OWNER_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
		<td data-field="BROKER_MOBILE"<?php echo $Page->BROKER_MOBILE->cellAttributes() ?>>
<span<?php echo $Page->BROKER_MOBILE->viewAttributes() ?>><?php echo $Page->BROKER_MOBILE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_EMAIL->Visible) { ?>
		<td data-field="BROKER_EMAIL"<?php echo $Page->BROKER_EMAIL->cellAttributes() ?>>
<span<?php echo $Page->BROKER_EMAIL->viewAttributes() ?>><?php echo $Page->BROKER_EMAIL->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->LANDMARK->Visible) { ?>
		<td data-field="LANDMARK"<?php echo $Page->LANDMARK->cellAttributes() ?>>
<span<?php echo $Page->LANDMARK->viewAttributes() ?>><?php echo $Page->LANDMARK->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PRICE->Visible) { ?>
		<td data-field="PRICE"<?php echo $Page->PRICE->cellAttributes() ?>>
<span<?php echo $Page->PRICE->viewAttributes() ?>><?php echo $Page->PRICE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->DEPOSITE_AMOUNT->Visible) { ?>
		<td data-field="DEPOSITE_AMOUNT"<?php echo $Page->DEPOSITE_AMOUNT->cellAttributes() ?>>
<span<?php echo $Page->DEPOSITE_AMOUNT->viewAttributes() ?>><?php echo $Page->DEPOSITE_AMOUNT->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PLOT_NUMBER->Visible) { ?>
		<td data-field="PLOT_NUMBER"<?php echo $Page->PLOT_NUMBER->cellAttributes() ?>>
<span<?php echo $Page->PLOT_NUMBER->viewAttributes() ?>><?php echo $Page->PLOT_NUMBER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ROOMS->Visible) { ?>
		<td data-field="ROOMS"<?php echo $Page->ROOMS->cellAttributes() ?>>
<span<?php echo $Page->ROOMS->viewAttributes() ?>><?php echo $Page->ROOMS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { ?>
		<td data-field="ADDRESS"<?php echo $Page->ADDRESS->cellAttributes() ?>>
<span<?php echo $Page->ADDRESS->viewAttributes() ?>><?php echo $Page->ADDRESS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ACCOMMODATION->Visible) { ?>
		<td data-field="ACCOMMODATION"<?php echo $Page->ACCOMMODATION->cellAttributes() ?>>
<span<?php echo $Page->ACCOMMODATION->viewAttributes() ?>><?php echo $Page->ACCOMMODATION->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { ?>
		<td data-field="DESCRIPTION"<?php echo $Page->DESCRIPTION->cellAttributes() ?>>
<span<?php echo $Page->DESCRIPTION->viewAttributes() ?>><?php echo $Page->DESCRIPTION->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->IMAGE->Visible) { ?>
		<td data-field="IMAGE"<?php echo $Page->IMAGE->cellAttributes() ?>>
<span<?php echo $Page->IMAGE->viewAttributes() ?>><?php echo $Page->IMAGE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->STATUS->Visible) { ?>
		<td data-field="STATUS"<?php echo $Page->STATUS->cellAttributes() ?>>
<span<?php echo $Page->STATUS->viewAttributes() ?>><?php echo $Page->STATUS->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_view9" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || TRUE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "view9_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.ew-container -->
<?php } ?>
<?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rfooter.php" ?>
<?php } ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>