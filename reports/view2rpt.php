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
if (!isset($view2_rpt))
	$view2_rpt = new view2_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view2_rpt;

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
var fview2rpt = currentForm = new ew.Form("fview2rpt");

// Validate method
fview2rpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview2rpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fview2rpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview2rpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview2rpt.lists["x_plot_number"] = <?php echo $view2_rpt->plot_number->Lookup->toClientList() ?>;
fview2rpt.lists["x_plot_number"].popupValues = <?php echo json_encode($view2_rpt->plot_number->SelectionList) ?>;
fview2rpt.lists["x_plot_number"].popupOptions = <?php echo JsonEncode($view2_rpt->plot_number->popupOptions()) ?>;
fview2rpt.lists["x_plot_number"].options = <?php echo JsonEncode($view2_rpt->plot_number->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $view2_rpt->CenterContentClass ?>">
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
<form name="fview2rpt" id="fview2rpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fview2rpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_plot_number" class="ew-cell form-group">
	<label for="x_plot_number" class="ew-search-caption ew-label"><?php echo $Page->plot_number->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->plot_number->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->plot_number->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view2" data-field="x_plot_number" data-value-separator="<?php echo $Page->plot_number->displayValueSeparatorAttribute() ?>" id="x_plot_number" name="x_plot_number"<?php echo $Page->plot_number->editAttributes() ?>>
		<?php echo $Page->plot_number->selectOptionListHtml("x_plot_number") ?>
	</select>
</div>
<?php echo $Page->plot_number->Lookup->getParamTag("p_x_plot_number") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fview2rpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_view2" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->STATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="STATE"><div class="view2_STATE"><span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="STATE">
<?php if ($Page->sortUrl($Page->STATE) == "") { ?>
		<div class="ew-table-header-btn view2_STATE">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_STATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->STATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->STATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->STATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->STATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_ID->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_ID"><div class="view2_BROKER_ID"><span class="ew-table-header-caption"><?php echo $Page->BROKER_ID->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_ID">
<?php if ($Page->sortUrl($Page->BROKER_ID) == "") { ?>
		<div class="ew-table-header-btn view2_BROKER_ID">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_ID->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_BROKER_ID" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_ID) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_ID->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CITY"><div class="view2_CITY"><span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CITY">
<?php if ($Page->sortUrl($Page->CITY) == "") { ?>
		<div class="ew-table-header-btn view2_CITY">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_CITY" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->CITY) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->CITY->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->CITY->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->CITY->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="AREA"><div class="view2_AREA"><span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="AREA">
<?php if ($Page->sortUrl($Page->AREA) == "") { ?>
		<div class="ew-table-header-btn view2_AREA">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_AREA" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->AREA) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->AREA->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->AREA->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->AREA->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ADDRESS"><div class="view2_ADDRESS"><span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ADDRESS">
<?php if ($Page->sortUrl($Page->ADDRESS) == "") { ?>
		<div class="ew-table-header-btn view2_ADDRESS">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_ADDRESS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->ADDRESS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->ADDRESS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->ADDRESS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->ADDRESS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="FULLNAME"><div class="view2_FULLNAME"><span class="ew-table-header-caption"><?php echo $Page->FULLNAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="FULLNAME">
<?php if ($Page->sortUrl($Page->FULLNAME) == "") { ?>
		<div class="ew-table-header-btn view2_FULLNAME">
			<span class="ew-table-header-caption"><?php echo $Page->FULLNAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_FULLNAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->FULLNAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->FULLNAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->FULLNAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->FULLNAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="GENDER"><div class="view2_GENDER"><span class="ew-table-header-caption"><?php echo $Page->GENDER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="GENDER">
<?php if ($Page->sortUrl($Page->GENDER) == "") { ?>
		<div class="ew-table-header-btn view2_GENDER">
			<span class="ew-table-header-caption"><?php echo $Page->GENDER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_GENDER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->GENDER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->GENDER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->GENDER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->GENDER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="MOBILE"><div class="view2_MOBILE"><span class="ew-table-header-caption"><?php echo $Page->MOBILE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="MOBILE">
<?php if ($Page->sortUrl($Page->MOBILE) == "") { ?>
		<div class="ew-table-header-btn view2_MOBILE">
			<span class="ew-table-header-caption"><?php echo $Page->MOBILE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_MOBILE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->MOBILE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->MOBILE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->MOBILE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->MOBILE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->USERNAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="USERNAME"><div class="view2_USERNAME"><span class="ew-table-header-caption"><?php echo $Page->USERNAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="USERNAME">
<?php if ($Page->sortUrl($Page->USERNAME) == "") { ?>
		<div class="ew-table-header-btn view2_USERNAME">
			<span class="ew-table-header-caption"><?php echo $Page->USERNAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_USERNAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->USERNAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->USERNAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->USERNAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->USERNAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="_EMAIL"><div class="view2__EMAIL"><span class="ew-table-header-caption"><?php echo $Page->_EMAIL->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="_EMAIL">
<?php if ($Page->sortUrl($Page->_EMAIL) == "") { ?>
		<div class="ew-table-header-btn view2__EMAIL">
			<span class="ew-table-header-caption"><?php echo $Page->_EMAIL->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2__EMAIL" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->_EMAIL) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->_EMAIL->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->_EMAIL->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->_EMAIL->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->REGISTRATION_CERTIFICATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="REGISTRATION_CERTIFICATE"><div class="view2_REGISTRATION_CERTIFICATE"><span class="ew-table-header-caption"><?php echo $Page->REGISTRATION_CERTIFICATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="REGISTRATION_CERTIFICATE">
<?php if ($Page->sortUrl($Page->REGISTRATION_CERTIFICATE) == "") { ?>
		<div class="ew-table-header-btn view2_REGISTRATION_CERTIFICATE">
			<span class="ew-table-header-caption"><?php echo $Page->REGISTRATION_CERTIFICATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_REGISTRATION_CERTIFICATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->REGISTRATION_CERTIFICATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->REGISTRATION_CERTIFICATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->REGISTRATION_CERTIFICATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->REGISTRATION_CERTIFICATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->plot_number->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="plot_number"><div class="view2_plot_number"><span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="plot_number">
<?php if ($Page->sortUrl($Page->plot_number) == "") { ?>
		<div class="ew-table-header-btn view2_plot_number">
			<span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_plot_number', form: 'fview2rpt', name: 'view2_plot_number', range: false, from: '<?php echo $Page->plot_number->RangeFrom; ?>', to: '<?php echo $Page->plot_number->RangeTo; ?>' });" id="x_plot_number<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view2_plot_number" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->plot_number) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->plot_number->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->plot_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->plot_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_plot_number', form: 'fview2rpt', name: 'view2_plot_number', range: false, from: '<?php echo $Page->plot_number->RangeFrom; ?>', to: '<?php echo $Page->plot_number->RangeTo; ?>' });" id="x_plot_number<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
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
<?php if ($Page->BROKER_ID->Visible) { ?>
		<td data-field="BROKER_ID"<?php echo $Page->BROKER_ID->cellAttributes() ?>>
<span<?php echo $Page->BROKER_ID->viewAttributes() ?>><?php echo $Page->BROKER_ID->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CITY->Visible) { ?>
		<td data-field="CITY"<?php echo $Page->CITY->cellAttributes() ?>>
<span<?php echo $Page->CITY->viewAttributes() ?>><?php echo $Page->CITY->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->AREA->Visible) { ?>
		<td data-field="AREA"<?php echo $Page->AREA->cellAttributes() ?>>
<span<?php echo $Page->AREA->viewAttributes() ?>><?php echo $Page->AREA->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { ?>
		<td data-field="ADDRESS"<?php echo $Page->ADDRESS->cellAttributes() ?>>
<span<?php echo $Page->ADDRESS->viewAttributes() ?>><?php echo $Page->ADDRESS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { ?>
		<td data-field="FULLNAME"<?php echo $Page->FULLNAME->cellAttributes() ?>>
<span<?php echo $Page->FULLNAME->viewAttributes() ?>><?php echo $Page->FULLNAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
		<td data-field="GENDER"<?php echo $Page->GENDER->cellAttributes() ?>>
<span<?php echo $Page->GENDER->viewAttributes() ?>><?php echo $Page->GENDER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { ?>
		<td data-field="MOBILE"<?php echo $Page->MOBILE->cellAttributes() ?>>
<span<?php echo $Page->MOBILE->viewAttributes() ?>><?php echo $Page->MOBILE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->USERNAME->Visible) { ?>
		<td data-field="USERNAME"<?php echo $Page->USERNAME->cellAttributes() ?>>
<span<?php echo $Page->USERNAME->viewAttributes() ?>><?php echo $Page->USERNAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { ?>
		<td data-field="_EMAIL"<?php echo $Page->_EMAIL->cellAttributes() ?>>
<span<?php echo $Page->_EMAIL->viewAttributes() ?>><?php echo $Page->_EMAIL->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->REGISTRATION_CERTIFICATE->Visible) { ?>
		<td data-field="REGISTRATION_CERTIFICATE"<?php echo $Page->REGISTRATION_CERTIFICATE->cellAttributes() ?>>
<span<?php echo $Page->REGISTRATION_CERTIFICATE->viewAttributes() ?>><?php echo $Page->REGISTRATION_CERTIFICATE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->plot_number->Visible) { ?>
		<td data-field="plot_number"<?php echo $Page->plot_number->cellAttributes() ?>>
<span<?php echo $Page->plot_number->viewAttributes() ?>><?php echo $Page->plot_number->getViewValue() ?></span></td>
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
<div id="gmp_view2" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "view2_pager.php" ?>
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