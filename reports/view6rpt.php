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
if (!isset($view6_rpt))
	$view6_rpt = new view6_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view6_rpt;

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
var fview6rpt = currentForm = new ew.Form("fview6rpt");

// Validate method
fview6rpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview6rpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fview6rpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview6rpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview6rpt.lists["x_APARTMENT_NAME"] = <?php echo $view6_rpt->APARTMENT_NAME->Lookup->toClientList() ?>;
fview6rpt.lists["x_APARTMENT_NAME"].popupValues = <?php echo json_encode($view6_rpt->APARTMENT_NAME->SelectionList) ?>;
fview6rpt.lists["x_APARTMENT_NAME"].popupOptions = <?php echo JsonEncode($view6_rpt->APARTMENT_NAME->popupOptions()) ?>;
fview6rpt.lists["x_APARTMENT_NAME"].options = <?php echo JsonEncode($view6_rpt->APARTMENT_NAME->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $view6_rpt->CenterContentClass ?>">
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
<form name="fview6rpt" id="fview6rpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fview6rpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_APARTMENT_NAME" class="ew-cell form-group">
	<label for="x_APARTMENT_NAME" class="ew-search-caption ew-label"><?php echo $Page->APARTMENT_NAME->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->APARTMENT_NAME->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->APARTMENT_NAME->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view6" data-field="x_APARTMENT_NAME" data-value-separator="<?php echo $Page->APARTMENT_NAME->displayValueSeparatorAttribute() ?>" id="x_APARTMENT_NAME" name="x_APARTMENT_NAME"<?php echo $Page->APARTMENT_NAME->editAttributes() ?>>
		<?php echo $Page->APARTMENT_NAME->selectOptionListHtml("x_APARTMENT_NAME") ?>
	</select>
</div>
<?php echo $Page->APARTMENT_NAME->Lookup->getParamTag("p_x_APARTMENT_NAME") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fview6rpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_view6" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->BROKER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_NAME"><div class="view6_BROKER_NAME"><span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_NAME">
<?php if ($Page->sortUrl($Page->BROKER_NAME) == "") { ?>
		<div class="ew-table-header-btn view6_BROKER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_BROKER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_STATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_STATE"><div class="view6_PROPERTY_STATE"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_STATE">
<?php if ($Page->sortUrl($Page->PROPERTY_STATE) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_STATE">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_STATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_STATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_STATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_STATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_CITY->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_CITY"><div class="view6_PROPERTY_CITY"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_CITY->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_CITY">
<?php if ($Page->sortUrl($Page->PROPERTY_CITY) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_CITY">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_CITY->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_CITY" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_CITY) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_CITY->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_CITY->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_CITY->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_AREA->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_AREA"><div class="view6_PROPERTY_AREA"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_AREA->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_AREA">
<?php if ($Page->sortUrl($Page->PROPERTY_AREA) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_AREA">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_AREA->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_AREA" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_AREA) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_AREA->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_AREA->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_AREA->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_OWNER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_OWNER_NAME"><div class="view6_PROPERTY_OWNER_NAME"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_OWNER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_OWNER_NAME">
<?php if ($Page->sortUrl($Page->PROPERTY_OWNER_NAME) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_OWNER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_OWNER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_OWNER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_OWNER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_OWNER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_OWNER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_OWNER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_MOBILE_NO_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_MOBILE_NO_"><div class="view6_BROKER_MOBILE_NO_"><span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE_NO_->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_MOBILE_NO_">
<?php if ($Page->sortUrl($Page->BROKER_MOBILE_NO_) == "") { ?>
		<div class="ew-table-header-btn view6_BROKER_MOBILE_NO_">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE_NO_->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_BROKER_MOBILE_NO_" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_MOBILE_NO_) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE_NO_->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_MOBILE_NO_->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_MOBILE_NO_->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_LANDMARK->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_LANDMARK"><div class="view6_PROPERTY_LANDMARK"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_LANDMARK->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_LANDMARK">
<?php if ($Page->sortUrl($Page->PROPERTY_LANDMARK) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_LANDMARK">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_LANDMARK->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_LANDMARK" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_LANDMARK) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_LANDMARK->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_LANDMARK->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_LANDMARK->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_PRICE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_PRICE"><div class="view6_PROPERTY_PRICE"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PRICE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_PRICE">
<?php if ($Page->sortUrl($Page->PROPERTY_PRICE) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_PRICE">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PRICE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_PRICE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_PRICE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PRICE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_PRICE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_PRICE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_PLOT_NUMBER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_PLOT_NUMBER"><div class="view6_PROPERTY_PLOT_NUMBER"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PLOT_NUMBER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_PLOT_NUMBER">
<?php if ($Page->sortUrl($Page->PROPERTY_PLOT_NUMBER) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_PLOT_NUMBER">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PLOT_NUMBER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_PLOT_NUMBER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_PLOT_NUMBER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PLOT_NUMBER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_PLOT_NUMBER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_PLOT_NUMBER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->APARTMENT_NO_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="APARTMENT_NO_"><div class="view6_APARTMENT_NO_"><span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NO_->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="APARTMENT_NO_">
<?php if ($Page->sortUrl($Page->APARTMENT_NO_) == "") { ?>
		<div class="ew-table-header-btn view6_APARTMENT_NO_">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NO_->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_APARTMENT_NO_" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->APARTMENT_NO_) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NO_->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->APARTMENT_NO_->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->APARTMENT_NO_->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="APARTMENT_NAME"><div class="view6_APARTMENT_NAME"><span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="APARTMENT_NAME">
<?php if ($Page->sortUrl($Page->APARTMENT_NAME) == "") { ?>
		<div class="ew-table-header-btn view6_APARTMENT_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_APARTMENT_NAME', form: 'fview6rpt', name: 'view6_APARTMENT_NAME', range: false, from: '<?php echo $Page->APARTMENT_NAME->RangeFrom; ?>', to: '<?php echo $Page->APARTMENT_NAME->RangeTo; ?>' });" id="x_APARTMENT_NAME<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_APARTMENT_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->APARTMENT_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->APARTMENT_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->APARTMENT_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_APARTMENT_NAME', form: 'fview6rpt', name: 'view6_APARTMENT_NAME', range: false, from: '<?php echo $Page->APARTMENT_NAME->RangeFrom; ?>', to: '<?php echo $Page->APARTMENT_NAME->RangeTo; ?>' });" id="x_APARTMENT_NAME<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->NO__OF_ROOMS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NO__OF_ROOMS"><div class="view6_NO__OF_ROOMS"><span class="ew-table-header-caption"><?php echo $Page->NO__OF_ROOMS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NO__OF_ROOMS">
<?php if ($Page->sortUrl($Page->NO__OF_ROOMS) == "") { ?>
		<div class="ew-table-header-btn view6_NO__OF_ROOMS">
			<span class="ew-table-header-caption"><?php echo $Page->NO__OF_ROOMS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_NO__OF_ROOMS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->NO__OF_ROOMS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->NO__OF_ROOMS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->NO__OF_ROOMS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->NO__OF_ROOMS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->FLOOR_NO_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="FLOOR_NO_"><div class="view6_FLOOR_NO_"><span class="ew-table-header-caption"><?php echo $Page->FLOOR_NO_->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="FLOOR_NO_">
<?php if ($Page->sortUrl($Page->FLOOR_NO_) == "") { ?>
		<div class="ew-table-header-btn view6_FLOOR_NO_">
			<span class="ew-table-header-caption"><?php echo $Page->FLOOR_NO_->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_FLOOR_NO_" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->FLOOR_NO_) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->FLOOR_NO_->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->FLOOR_NO_->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->FLOOR_NO_->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_PURPOSE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_PURPOSE"><div class="view6_PROPERTY_PURPOSE"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PURPOSE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_PURPOSE">
<?php if ($Page->sortUrl($Page->PROPERTY_PURPOSE) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_PURPOSE">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PURPOSE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_PURPOSE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_PURPOSE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_PURPOSE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_PURPOSE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_PURPOSE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_ADDRESS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_ADDRESS"><div class="view6_PROPERTY_ADDRESS"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ADDRESS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_ADDRESS">
<?php if ($Page->sortUrl($Page->PROPERTY_ADDRESS) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_ADDRESS">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ADDRESS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_ADDRESS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_ADDRESS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ADDRESS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_ADDRESS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_ADDRESS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_ACCOMODATION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_ACCOMODATION"><div class="view6_PROPERTY_ACCOMODATION"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ACCOMODATION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_ACCOMODATION">
<?php if ($Page->sortUrl($Page->PROPERTY_ACCOMODATION) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_ACCOMODATION">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ACCOMODATION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_ACCOMODATION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_ACCOMODATION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_ACCOMODATION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_ACCOMODATION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_ACCOMODATION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_DESCRIPTION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_DESCRIPTION"><div class="view6_PROPERTY_DESCRIPTION"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_DESCRIPTION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_DESCRIPTION">
<?php if ($Page->sortUrl($Page->PROPERTY_DESCRIPTION) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_DESCRIPTION">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_DESCRIPTION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_DESCRIPTION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_DESCRIPTION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_DESCRIPTION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_DESCRIPTION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_DESCRIPTION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_IMAGE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_IMAGE"><div class="view6_PROPERTY_IMAGE"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_IMAGE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_IMAGE">
<?php if ($Page->sortUrl($Page->PROPERTY_IMAGE) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_IMAGE">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_IMAGE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_IMAGE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_IMAGE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_IMAGE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_IMAGE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_IMAGE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PROPERTY_STATUS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PROPERTY_STATUS"><div class="view6_PROPERTY_STATUS"><span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATUS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PROPERTY_STATUS">
<?php if ($Page->sortUrl($Page->PROPERTY_STATUS) == "") { ?>
		<div class="ew-table-header-btn view6_PROPERTY_STATUS">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATUS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view6_PROPERTY_STATUS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PROPERTY_STATUS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PROPERTY_STATUS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PROPERTY_STATUS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PROPERTY_STATUS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->BROKER_NAME->Visible) { ?>
		<td data-field="BROKER_NAME"<?php echo $Page->BROKER_NAME->cellAttributes() ?>>
<span<?php echo $Page->BROKER_NAME->viewAttributes() ?>><?php echo $Page->BROKER_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_STATE->Visible) { ?>
		<td data-field="PROPERTY_STATE"<?php echo $Page->PROPERTY_STATE->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_STATE->viewAttributes() ?>><?php echo $Page->PROPERTY_STATE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_CITY->Visible) { ?>
		<td data-field="PROPERTY_CITY"<?php echo $Page->PROPERTY_CITY->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_CITY->viewAttributes() ?>><?php echo $Page->PROPERTY_CITY->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_AREA->Visible) { ?>
		<td data-field="PROPERTY_AREA"<?php echo $Page->PROPERTY_AREA->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_AREA->viewAttributes() ?>><?php echo $Page->PROPERTY_AREA->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_OWNER_NAME->Visible) { ?>
		<td data-field="PROPERTY_OWNER_NAME"<?php echo $Page->PROPERTY_OWNER_NAME->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_OWNER_NAME->viewAttributes() ?>><?php echo $Page->PROPERTY_OWNER_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_MOBILE_NO_->Visible) { ?>
		<td data-field="BROKER_MOBILE_NO_"<?php echo $Page->BROKER_MOBILE_NO_->cellAttributes() ?>>
<span<?php echo $Page->BROKER_MOBILE_NO_->viewAttributes() ?>><?php echo $Page->BROKER_MOBILE_NO_->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_LANDMARK->Visible) { ?>
		<td data-field="PROPERTY_LANDMARK"<?php echo $Page->PROPERTY_LANDMARK->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_LANDMARK->viewAttributes() ?>><?php echo $Page->PROPERTY_LANDMARK->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_PRICE->Visible) { ?>
		<td data-field="PROPERTY_PRICE"<?php echo $Page->PROPERTY_PRICE->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_PRICE->viewAttributes() ?>><?php echo $Page->PROPERTY_PRICE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_PLOT_NUMBER->Visible) { ?>
		<td data-field="PROPERTY_PLOT_NUMBER"<?php echo $Page->PROPERTY_PLOT_NUMBER->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_PLOT_NUMBER->viewAttributes() ?>><?php echo $Page->PROPERTY_PLOT_NUMBER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->APARTMENT_NO_->Visible) { ?>
		<td data-field="APARTMENT_NO_"<?php echo $Page->APARTMENT_NO_->cellAttributes() ?>>
<span<?php echo $Page->APARTMENT_NO_->viewAttributes() ?>><?php echo $Page->APARTMENT_NO_->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
		<td data-field="APARTMENT_NAME"<?php echo $Page->APARTMENT_NAME->cellAttributes() ?>>
<span<?php echo $Page->APARTMENT_NAME->viewAttributes() ?>><?php echo $Page->APARTMENT_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->NO__OF_ROOMS->Visible) { ?>
		<td data-field="NO__OF_ROOMS"<?php echo $Page->NO__OF_ROOMS->cellAttributes() ?>>
<span<?php echo $Page->NO__OF_ROOMS->viewAttributes() ?>><?php echo $Page->NO__OF_ROOMS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->FLOOR_NO_->Visible) { ?>
		<td data-field="FLOOR_NO_"<?php echo $Page->FLOOR_NO_->cellAttributes() ?>>
<span<?php echo $Page->FLOOR_NO_->viewAttributes() ?>><?php echo $Page->FLOOR_NO_->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_PURPOSE->Visible) { ?>
		<td data-field="PROPERTY_PURPOSE"<?php echo $Page->PROPERTY_PURPOSE->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_PURPOSE->viewAttributes() ?>><?php echo $Page->PROPERTY_PURPOSE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_ADDRESS->Visible) { ?>
		<td data-field="PROPERTY_ADDRESS"<?php echo $Page->PROPERTY_ADDRESS->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_ADDRESS->viewAttributes() ?>><?php echo $Page->PROPERTY_ADDRESS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_ACCOMODATION->Visible) { ?>
		<td data-field="PROPERTY_ACCOMODATION"<?php echo $Page->PROPERTY_ACCOMODATION->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_ACCOMODATION->viewAttributes() ?>><?php echo $Page->PROPERTY_ACCOMODATION->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_DESCRIPTION->Visible) { ?>
		<td data-field="PROPERTY_DESCRIPTION"<?php echo $Page->PROPERTY_DESCRIPTION->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_DESCRIPTION->viewAttributes() ?>><?php echo $Page->PROPERTY_DESCRIPTION->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_IMAGE->Visible) { ?>
		<td data-field="PROPERTY_IMAGE"<?php echo $Page->PROPERTY_IMAGE->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_IMAGE->viewAttributes() ?>><?php echo $Page->PROPERTY_IMAGE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PROPERTY_STATUS->Visible) { ?>
		<td data-field="PROPERTY_STATUS"<?php echo $Page->PROPERTY_STATUS->cellAttributes() ?>>
<span<?php echo $Page->PROPERTY_STATUS->viewAttributes() ?>><?php echo $Page->PROPERTY_STATUS->getViewValue() ?></span></td>
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
<div id="gmp_view6" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "view6_pager.php" ?>
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