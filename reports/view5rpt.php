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
if (!isset($view5_rpt))
	$view5_rpt = new view5_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view5_rpt;

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
<div id="ew-center" class="<?php echo $view5_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
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
<div id="gmp_view5" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->OWNER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="OWNER_NAME"><div class="view5_OWNER_NAME"><span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="OWNER_NAME">
<?php if ($Page->sortUrl($Page->OWNER_NAME) == "") { ?>
		<div class="ew-table-header-btn view5_OWNER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_OWNER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->OWNER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->OWNER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->OWNER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->OWNER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_MOBILE"><div class="view5_BROKER_MOBILE"><span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_MOBILE">
<?php if ($Page->sortUrl($Page->BROKER_MOBILE) == "") { ?>
		<div class="ew-table-header-btn view5_BROKER_MOBILE">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_BROKER_MOBILE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_MOBILE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_MOBILE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_MOBILE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_EMAIL->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_EMAIL"><div class="view5_BROKER_EMAIL"><span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_EMAIL">
<?php if ($Page->sortUrl($Page->BROKER_EMAIL) == "") { ?>
		<div class="ew-table-header-btn view5_BROKER_EMAIL">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_BROKER_EMAIL" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_EMAIL) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_EMAIL->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_EMAIL->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->STATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATE"><div class="view5_STATE"><span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATE">
<?php if ($Page->sortUrl($Page->STATE) == "") { ?>
		<div class="ew-table-header-btn view5_STATE">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_STATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CITY"><div class="view5_CITY"><span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CITY">
<?php if ($Page->sortUrl($Page->CITY) == "") { ?>
		<div class="ew-table-header-btn view5_CITY">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_CITY" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->CITY) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->CITY->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->CITY->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="AREA"><div class="view5_AREA"><span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="AREA">
<?php if ($Page->sortUrl($Page->AREA) == "") { ?>
		<div class="ew-table-header-btn view5_AREA">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_AREA" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->AREA) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->AREA->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->AREA->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->LANDMARK->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="LANDMARK"><div class="view5_LANDMARK"><span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="LANDMARK">
<?php if ($Page->sortUrl($Page->LANDMARK) == "") { ?>
		<div class="ew-table-header-btn view5_LANDMARK">
			<span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_LANDMARK" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->LANDMARK) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->LANDMARK->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->LANDMARK->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->LANDMARK->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PRICE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PRICE"><div class="view5_PRICE"><span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PRICE">
<?php if ($Page->sortUrl($Page->PRICE) == "") { ?>
		<div class="ew-table-header-btn view5_PRICE">
			<span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_PRICE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PRICE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PRICE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PRICE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PRICE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PLOT_NUMBER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PLOT_NUMBER"><div class="view5_PLOT_NUMBER"><span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PLOT_NUMBER">
<?php if ($Page->sortUrl($Page->PLOT_NUMBER) == "") { ?>
		<div class="ew-table-header-btn view5_PLOT_NUMBER">
			<span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_PLOT_NUMBER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PLOT_NUMBER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PLOT_NUMBER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PLOT_NUMBER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PLOT_NUMBER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="APARTMENT_NAME"><div class="view5_APARTMENT_NAME"><span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="APARTMENT_NAME">
<?php if ($Page->sortUrl($Page->APARTMENT_NAME) == "") { ?>
		<div class="ew-table-header-btn view5_APARTMENT_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_APARTMENT_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->APARTMENT_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->APARTMENT_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->APARTMENT_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PLATE_NUMBER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PLATE_NUMBER"><div class="view5_PLATE_NUMBER"><span class="ew-table-header-caption"><?php echo $Page->PLATE_NUMBER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PLATE_NUMBER">
<?php if ($Page->sortUrl($Page->PLATE_NUMBER) == "") { ?>
		<div class="ew-table-header-btn view5_PLATE_NUMBER">
			<span class="ew-table-header-caption"><?php echo $Page->PLATE_NUMBER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_PLATE_NUMBER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PLATE_NUMBER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PLATE_NUMBER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PLATE_NUMBER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PLATE_NUMBER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->NUMBER_OF_ROOMS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NUMBER_OF_ROOMS"><div class="view5_NUMBER_OF_ROOMS"><span class="ew-table-header-caption"><?php echo $Page->NUMBER_OF_ROOMS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NUMBER_OF_ROOMS">
<?php if ($Page->sortUrl($Page->NUMBER_OF_ROOMS) == "") { ?>
		<div class="ew-table-header-btn view5_NUMBER_OF_ROOMS">
			<span class="ew-table-header-caption"><?php echo $Page->NUMBER_OF_ROOMS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_NUMBER_OF_ROOMS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->NUMBER_OF_ROOMS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->NUMBER_OF_ROOMS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->NUMBER_OF_ROOMS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->NUMBER_OF_ROOMS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->FLOOR_NUMBER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="FLOOR_NUMBER"><div class="view5_FLOOR_NUMBER"><span class="ew-table-header-caption"><?php echo $Page->FLOOR_NUMBER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="FLOOR_NUMBER">
<?php if ($Page->sortUrl($Page->FLOOR_NUMBER) == "") { ?>
		<div class="ew-table-header-btn view5_FLOOR_NUMBER">
			<span class="ew-table-header-caption"><?php echo $Page->FLOOR_NUMBER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_FLOOR_NUMBER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->FLOOR_NUMBER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->FLOOR_NUMBER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->FLOOR_NUMBER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->FLOOR_NUMBER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PURPOSE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PURPOSE"><div class="view5_PURPOSE"><span class="ew-table-header-caption"><?php echo $Page->PURPOSE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PURPOSE">
<?php if ($Page->sortUrl($Page->PURPOSE) == "") { ?>
		<div class="ew-table-header-btn view5_PURPOSE">
			<span class="ew-table-header-caption"><?php echo $Page->PURPOSE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_PURPOSE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->PURPOSE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->PURPOSE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->PURPOSE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->PURPOSE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ADDRESS"><div class="view5_ADDRESS"><span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ADDRESS">
<?php if ($Page->sortUrl($Page->ADDRESS) == "") { ?>
		<div class="ew-table-header-btn view5_ADDRESS">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_ADDRESS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ADDRESS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ADDRESS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ADDRESS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ACCOMMODATION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ACCOMMODATION"><div class="view5_ACCOMMODATION"><span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ACCOMMODATION">
<?php if ($Page->sortUrl($Page->ACCOMMODATION) == "") { ?>
		<div class="ew-table-header-btn view5_ACCOMMODATION">
			<span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_ACCOMMODATION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ACCOMMODATION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ACCOMMODATION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ACCOMMODATION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ACCOMMODATION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="DESCRIPTION"><div class="view5_DESCRIPTION"><span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="DESCRIPTION">
<?php if ($Page->sortUrl($Page->DESCRIPTION) == "") { ?>
		<div class="ew-table-header-btn view5_DESCRIPTION">
			<span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_DESCRIPTION" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->DESCRIPTION) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->DESCRIPTION->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->DESCRIPTION->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->DESCRIPTION->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->IMAGE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="IMAGE"><div class="view5_IMAGE"><span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="IMAGE">
<?php if ($Page->sortUrl($Page->IMAGE) == "") { ?>
		<div class="ew-table-header-btn view5_IMAGE">
			<span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_IMAGE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->IMAGE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->IMAGE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->IMAGE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->IMAGE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->STATUS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATUS"><div class="view5_STATUS"><span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATUS">
<?php if ($Page->sortUrl($Page->STATUS) == "") { ?>
		<div class="ew-table-header-btn view5_STATUS">
			<span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_STATUS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATUS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATUS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATUS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATUS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_FULLNAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_FULLNAME"><div class="view5_BROKER_FULLNAME"><span class="ew-table-header-caption"><?php echo $Page->BROKER_FULLNAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_FULLNAME">
<?php if ($Page->sortUrl($Page->BROKER_FULLNAME) == "") { ?>
		<div class="ew-table-header-btn view5_BROKER_FULLNAME">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_FULLNAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view5_BROKER_FULLNAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_FULLNAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_FULLNAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_FULLNAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_FULLNAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->LANDMARK->Visible) { ?>
		<td data-field="LANDMARK"<?php echo $Page->LANDMARK->cellAttributes() ?>>
<span<?php echo $Page->LANDMARK->viewAttributes() ?>><?php echo $Page->LANDMARK->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PRICE->Visible) { ?>
		<td data-field="PRICE"<?php echo $Page->PRICE->cellAttributes() ?>>
<span<?php echo $Page->PRICE->viewAttributes() ?>><?php echo $Page->PRICE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PLOT_NUMBER->Visible) { ?>
		<td data-field="PLOT_NUMBER"<?php echo $Page->PLOT_NUMBER->cellAttributes() ?>>
<span<?php echo $Page->PLOT_NUMBER->viewAttributes() ?>><?php echo $Page->PLOT_NUMBER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
		<td data-field="APARTMENT_NAME"<?php echo $Page->APARTMENT_NAME->cellAttributes() ?>>
<span<?php echo $Page->APARTMENT_NAME->viewAttributes() ?>><?php echo $Page->APARTMENT_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PLATE_NUMBER->Visible) { ?>
		<td data-field="PLATE_NUMBER"<?php echo $Page->PLATE_NUMBER->cellAttributes() ?>>
<span<?php echo $Page->PLATE_NUMBER->viewAttributes() ?>><?php echo $Page->PLATE_NUMBER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->NUMBER_OF_ROOMS->Visible) { ?>
		<td data-field="NUMBER_OF_ROOMS"<?php echo $Page->NUMBER_OF_ROOMS->cellAttributes() ?>>
<span<?php echo $Page->NUMBER_OF_ROOMS->viewAttributes() ?>><?php echo $Page->NUMBER_OF_ROOMS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->FLOOR_NUMBER->Visible) { ?>
		<td data-field="FLOOR_NUMBER"<?php echo $Page->FLOOR_NUMBER->cellAttributes() ?>>
<span<?php echo $Page->FLOOR_NUMBER->viewAttributes() ?>><?php echo $Page->FLOOR_NUMBER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PURPOSE->Visible) { ?>
		<td data-field="PURPOSE"<?php echo $Page->PURPOSE->cellAttributes() ?>>
<span<?php echo $Page->PURPOSE->viewAttributes() ?>><?php echo $Page->PURPOSE->getViewValue() ?></span></td>
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
<?php if ($Page->BROKER_FULLNAME->Visible) { ?>
		<td data-field="BROKER_FULLNAME"<?php echo $Page->BROKER_FULLNAME->cellAttributes() ?>>
<span<?php echo $Page->BROKER_FULLNAME->viewAttributes() ?>><?php echo $Page->BROKER_FULLNAME->getViewValue() ?></span></td>
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
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_view5" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "view5_pager.php" ?>
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