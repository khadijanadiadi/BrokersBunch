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
if (!isset($view8_rpt))
	$view8_rpt = new view8_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view8_rpt;

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
var fview8rpt = currentForm = new ew.Form("fview8rpt");

// Validate method
fview8rpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview8rpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fview8rpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview8rpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview8rpt.lists["x_price"] = <?php echo $view8_rpt->price->Lookup->toClientList() ?>;
fview8rpt.lists["x_price"].popupValues = <?php echo json_encode($view8_rpt->price->SelectionList) ?>;
fview8rpt.lists["x_price"].popupOptions = <?php echo JsonEncode($view8_rpt->price->popupOptions()) ?>;
fview8rpt.lists["x_price"].options = <?php echo JsonEncode($view8_rpt->price->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $view8_rpt->CenterContentClass ?>">
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
<form name="fview8rpt" id="fview8rpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fview8rpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_price" class="ew-cell form-group">
	<label for="x_price" class="ew-search-caption ew-label"><?php echo $Page->price->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->price->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->price->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view8" data-field="x_price" data-value-separator="<?php echo $Page->price->displayValueSeparatorAttribute() ?>" id="x_price" name="x_price"<?php echo $Page->price->editAttributes() ?>>
		<?php echo $Page->price->selectOptionListHtml("x_price") ?>
	</select>
</div>
<?php echo $Page->price->Lookup->getParamTag("p_x_price") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fview8rpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_view8" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->BROKER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_NAME"><div class="view8_BROKER_NAME"><span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_NAME">
<?php if ($Page->sortUrl($Page->BROKER_NAME) == "") { ?>
		<div class="ew-table-header-btn view8_BROKER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_BROKER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_MOBILE"><div class="view8_BROKER_MOBILE"><span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_MOBILE">
<?php if ($Page->sortUrl($Page->BROKER_MOBILE) == "") { ?>
		<div class="ew-table-header-btn view8_BROKER_MOBILE">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_BROKER_MOBILE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_MOBILE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_MOBILE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_MOBILE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->broker_email->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="broker_email"><div class="view8_broker_email"><span class="ew-table-header-caption"><?php echo $Page->broker_email->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="broker_email">
<?php if ($Page->sortUrl($Page->broker_email) == "") { ?>
		<div class="ew-table-header-btn view8_broker_email">
			<span class="ew-table-header-caption"><?php echo $Page->broker_email->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_broker_email" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->broker_email) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->broker_email->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->broker_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->broker_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->landmark->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="landmark"><div class="view8_landmark"><span class="ew-table-header-caption"><?php echo $Page->landmark->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="landmark">
<?php if ($Page->sortUrl($Page->landmark) == "") { ?>
		<div class="ew-table-header-btn view8_landmark">
			<span class="ew-table-header-caption"><?php echo $Page->landmark->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_landmark" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->landmark) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->landmark->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->landmark->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->landmark->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="price"><div class="view8_price"><span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="price">
<?php if ($Page->sortUrl($Page->price) == "") { ?>
		<div class="ew-table-header-btn view8_price">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_price', form: 'fview8rpt', name: 'view8_price', range: false, from: '<?php echo $Page->price->RangeFrom; ?>', to: '<?php echo $Page->price->RangeTo; ?>' });" id="x_price<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->price) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_price', form: 'fview8rpt', name: 'view8_price', range: false, from: '<?php echo $Page->price->RangeFrom; ?>', to: '<?php echo $Page->price->RangeTo; ?>' });" id="x_price<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->plot_number->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="plot_number"><div class="view8_plot_number"><span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="plot_number">
<?php if ($Page->sortUrl($Page->plot_number) == "") { ?>
		<div class="ew-table-header-btn view8_plot_number">
			<span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_plot_number" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->plot_number) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->plot_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->plot_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->apartment_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="apartment_name"><div class="view8_apartment_name"><span class="ew-table-header-caption"><?php echo $Page->apartment_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="apartment_name">
<?php if ($Page->sortUrl($Page->apartment_name) == "") { ?>
		<div class="ew-table-header-btn view8_apartment_name">
			<span class="ew-table-header-caption"><?php echo $Page->apartment_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_apartment_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->apartment_name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->apartment_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->apartment_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->apartment_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ap_number_of_plats->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ap_number_of_plats"><div class="view8_ap_number_of_plats"><span class="ew-table-header-caption"><?php echo $Page->ap_number_of_plats->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ap_number_of_plats">
<?php if ($Page->sortUrl($Page->ap_number_of_plats) == "") { ?>
		<div class="ew-table-header-btn view8_ap_number_of_plats">
			<span class="ew-table-header-caption"><?php echo $Page->ap_number_of_plats->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_ap_number_of_plats" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ap_number_of_plats) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ap_number_of_plats->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ap_number_of_plats->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ap_number_of_plats->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->rooms->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="rooms"><div class="view8_rooms"><span class="ew-table-header-caption"><?php echo $Page->rooms->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="rooms">
<?php if ($Page->sortUrl($Page->rooms) == "") { ?>
		<div class="ew-table-header-btn view8_rooms">
			<span class="ew-table-header-caption"><?php echo $Page->rooms->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_rooms" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->rooms) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->rooms->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->rooms->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->rooms->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->floor->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="floor"><div class="view8_floor"><span class="ew-table-header-caption"><?php echo $Page->floor->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="floor">
<?php if ($Page->sortUrl($Page->floor) == "") { ?>
		<div class="ew-table-header-btn view8_floor">
			<span class="ew-table-header-caption"><?php echo $Page->floor->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_floor" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->floor) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->floor->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->floor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->floor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->purpose->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="purpose"><div class="view8_purpose"><span class="ew-table-header-caption"><?php echo $Page->purpose->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="purpose">
<?php if ($Page->sortUrl($Page->purpose) == "") { ?>
		<div class="ew-table-header-btn view8_purpose">
			<span class="ew-table-header-caption"><?php echo $Page->purpose->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_purpose" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->purpose) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->purpose->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->purpose->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->purpose->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->address->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="address"><div class="view8_address"><span class="ew-table-header-caption"><?php echo $Page->address->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="address">
<?php if ($Page->sortUrl($Page->address) == "") { ?>
		<div class="ew-table-header-btn view8_address">
			<span class="ew-table-header-caption"><?php echo $Page->address->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_address" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->address) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->address->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->accommodation->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="accommodation"><div class="view8_accommodation"><span class="ew-table-header-caption"><?php echo $Page->accommodation->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="accommodation">
<?php if ($Page->sortUrl($Page->accommodation) == "") { ?>
		<div class="ew-table-header-btn view8_accommodation">
			<span class="ew-table-header-caption"><?php echo $Page->accommodation->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_accommodation" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->accommodation) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->accommodation->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->accommodation->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->accommodation->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->description->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="description"><div class="view8_description"><span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="description">
<?php if ($Page->sortUrl($Page->description) == "") { ?>
		<div class="ew-table-header-btn view8_description">
			<span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_description" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->description) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->image->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="image"><div class="view8_image"><span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="image">
<?php if ($Page->sortUrl($Page->image) == "") { ?>
		<div class="ew-table-header-btn view8_image">
			<span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_image" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->image) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->image->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->image->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->vacant->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="vacant"><div class="view8_vacant"><span class="ew-table-header-caption"><?php echo $Page->vacant->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="vacant">
<?php if ($Page->sortUrl($Page->vacant) == "") { ?>
		<div class="ew-table-header-btn view8_vacant">
			<span class="ew-table-header-caption"><?php echo $Page->vacant->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_vacant" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->vacant) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->vacant->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->vacant->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->vacant->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CITY"><div class="view8_CITY"><span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CITY">
<?php if ($Page->sortUrl($Page->CITY) == "") { ?>
		<div class="ew-table-header-btn view8_CITY">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_CITY" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->CITY) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->CITY->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->CITY->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="AREA"><div class="view8_AREA"><span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="AREA">
<?php if ($Page->sortUrl($Page->AREA) == "") { ?>
		<div class="ew-table-header-btn view8_AREA">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_AREA" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->AREA) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->AREA->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->AREA->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->STATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATE"><div class="view8_STATE"><span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATE">
<?php if ($Page->sortUrl($Page->STATE) == "") { ?>
		<div class="ew-table-header-btn view8_STATE">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_STATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->OWNER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="OWNER_NAME"><div class="view8_OWNER_NAME"><span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="OWNER_NAME">
<?php if ($Page->sortUrl($Page->OWNER_NAME) == "") { ?>
		<div class="ew-table-header-btn view8_OWNER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view8_OWNER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->OWNER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->OWNER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->OWNER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
		<td data-field="BROKER_MOBILE"<?php echo $Page->BROKER_MOBILE->cellAttributes() ?>>
<span<?php echo $Page->BROKER_MOBILE->viewAttributes() ?>><?php echo $Page->BROKER_MOBILE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->broker_email->Visible) { ?>
		<td data-field="broker_email"<?php echo $Page->broker_email->cellAttributes() ?>>
<span<?php echo $Page->broker_email->viewAttributes() ?>><?php echo $Page->broker_email->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->landmark->Visible) { ?>
		<td data-field="landmark"<?php echo $Page->landmark->cellAttributes() ?>>
<span<?php echo $Page->landmark->viewAttributes() ?>><?php echo $Page->landmark->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
		<td data-field="price"<?php echo $Page->price->cellAttributes() ?>>
<span<?php echo $Page->price->viewAttributes() ?>><?php echo $Page->price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->plot_number->Visible) { ?>
		<td data-field="plot_number"<?php echo $Page->plot_number->cellAttributes() ?>>
<span<?php echo $Page->plot_number->viewAttributes() ?>><?php echo $Page->plot_number->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->apartment_name->Visible) { ?>
		<td data-field="apartment_name"<?php echo $Page->apartment_name->cellAttributes() ?>>
<span<?php echo $Page->apartment_name->viewAttributes() ?>><?php echo $Page->apartment_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ap_number_of_plats->Visible) { ?>
		<td data-field="ap_number_of_plats"<?php echo $Page->ap_number_of_plats->cellAttributes() ?>>
<span<?php echo $Page->ap_number_of_plats->viewAttributes() ?>><?php echo $Page->ap_number_of_plats->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->rooms->Visible) { ?>
		<td data-field="rooms"<?php echo $Page->rooms->cellAttributes() ?>>
<span<?php echo $Page->rooms->viewAttributes() ?>><?php echo $Page->rooms->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->floor->Visible) { ?>
		<td data-field="floor"<?php echo $Page->floor->cellAttributes() ?>>
<span<?php echo $Page->floor->viewAttributes() ?>><?php echo $Page->floor->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $Page->purpose->cellAttributes() ?>>
<span<?php echo $Page->purpose->viewAttributes() ?>><?php echo $Page->purpose->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->address->Visible) { ?>
		<td data-field="address"<?php echo $Page->address->cellAttributes() ?>>
<span<?php echo $Page->address->viewAttributes() ?>><?php echo $Page->address->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->accommodation->Visible) { ?>
		<td data-field="accommodation"<?php echo $Page->accommodation->cellAttributes() ?>>
<span<?php echo $Page->accommodation->viewAttributes() ?>><?php echo $Page->accommodation->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->description->Visible) { ?>
		<td data-field="description"<?php echo $Page->description->cellAttributes() ?>>
<span<?php echo $Page->description->viewAttributes() ?>><?php echo $Page->description->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->image->Visible) { ?>
		<td data-field="image"<?php echo $Page->image->cellAttributes() ?>>
<span<?php echo $Page->image->viewAttributes() ?>><?php echo $Page->image->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->vacant->Visible) { ?>
		<td data-field="vacant"<?php echo $Page->vacant->cellAttributes() ?>>
<span<?php echo $Page->vacant->viewAttributes() ?>><?php echo $Page->vacant->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
		<td data-field="CITY"<?php echo $Page->CITY->cellAttributes() ?>>
<span<?php echo $Page->CITY->viewAttributes() ?>><?php echo $Page->CITY->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
		<td data-field="AREA"<?php echo $Page->AREA->cellAttributes() ?>>
<span<?php echo $Page->AREA->viewAttributes() ?>><?php echo $Page->AREA->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->STATE->Visible) { ?>
		<td data-field="STATE"<?php echo $Page->STATE->cellAttributes() ?>>
<span<?php echo $Page->STATE->viewAttributes() ?>><?php echo $Page->STATE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->OWNER_NAME->Visible) { ?>
		<td data-field="OWNER_NAME"<?php echo $Page->OWNER_NAME->cellAttributes() ?>>
<span<?php echo $Page->OWNER_NAME->viewAttributes() ?>><?php echo $Page->OWNER_NAME->getViewValue() ?></span></td>
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
<div id="gmp_view8" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "view8_pager.php" ?>
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