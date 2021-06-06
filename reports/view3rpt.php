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
if (!isset($view3_rpt))
	$view3_rpt = new view3_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view3_rpt;

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
var fview3rpt = currentForm = new ew.Form("fview3rpt");

// Validate method
fview3rpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview3rpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fview3rpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview3rpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview3rpt.lists["x_APARTMENT_NAME"] = <?php echo $view3_rpt->APARTMENT_NAME->Lookup->toClientList() ?>;
fview3rpt.lists["x_APARTMENT_NAME"].popupValues = <?php echo json_encode($view3_rpt->APARTMENT_NAME->SelectionList) ?>;
fview3rpt.lists["x_APARTMENT_NAME"].popupOptions = <?php echo JsonEncode($view3_rpt->APARTMENT_NAME->popupOptions()) ?>;
fview3rpt.lists["x_APARTMENT_NAME"].options = <?php echo JsonEncode($view3_rpt->APARTMENT_NAME->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $view3_rpt->CenterContentClass ?>">
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
<form name="fview3rpt" id="fview3rpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fview3rpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_APARTMENT_NAME" class="ew-cell form-group">
	<label for="x_APARTMENT_NAME" class="ew-search-caption ew-label"><?php echo $Page->APARTMENT_NAME->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->APARTMENT_NAME->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->APARTMENT_NAME->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view3" data-field="x_APARTMENT_NAME" data-value-separator="<?php echo $Page->APARTMENT_NAME->displayValueSeparatorAttribute() ?>" id="x_APARTMENT_NAME" name="x_APARTMENT_NAME"<?php echo $Page->APARTMENT_NAME->editAttributes() ?>>
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
fview3rpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_view3" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->broker_state->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="broker_state"><div class="view3_broker_state"><span class="ew-table-header-caption"><?php echo $Page->broker_state->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="broker_state">
<?php if ($Page->sortUrl($Page->broker_state) == "") { ?>
		<div class="ew-table-header-btn view3_broker_state">
			<span class="ew-table-header-caption"><?php echo $Page->broker_state->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_broker_state" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->broker_state) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->broker_state->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->broker_state->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->broker_state->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->broker_city->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="broker_city"><div class="view3_broker_city"><span class="ew-table-header-caption"><?php echo $Page->broker_city->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="broker_city">
<?php if ($Page->sortUrl($Page->broker_city) == "") { ?>
		<div class="ew-table-header-btn view3_broker_city">
			<span class="ew-table-header-caption"><?php echo $Page->broker_city->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_broker_city" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->broker_city) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->broker_city->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->broker_city->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->broker_city->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->broker_area->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="broker_area"><div class="view3_broker_area"><span class="ew-table-header-caption"><?php echo $Page->broker_area->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="broker_area">
<?php if ($Page->sortUrl($Page->broker_area) == "") { ?>
		<div class="ew-table-header-btn view3_broker_area">
			<span class="ew-table-header-caption"><?php echo $Page->broker_area->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_broker_area" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->broker_area) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->broker_area->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->broker_area->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->broker_area->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_ADDRESS->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_ADDRESS"><div class="view3_BROKER_ADDRESS"><span class="ew-table-header-caption"><?php echo $Page->BROKER_ADDRESS->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_ADDRESS">
<?php if ($Page->sortUrl($Page->BROKER_ADDRESS) == "") { ?>
		<div class="ew-table-header-btn view3_BROKER_ADDRESS">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_ADDRESS->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_BROKER_ADDRESS" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_ADDRESS) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_ADDRESS->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_ADDRESS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_ADDRESS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_NAME"><div class="view3_BROKER_NAME"><span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_NAME">
<?php if ($Page->sortUrl($Page->BROKER_NAME) == "") { ?>
		<div class="ew-table-header-btn view3_BROKER_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_BROKER_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_GENDER->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_GENDER"><div class="view3_BROKER_GENDER"><span class="ew-table-header-caption"><?php echo $Page->BROKER_GENDER->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_GENDER">
<?php if ($Page->sortUrl($Page->BROKER_GENDER) == "") { ?>
		<div class="ew-table-header-btn view3_BROKER_GENDER">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_GENDER->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_BROKER_GENDER" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_GENDER) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_GENDER->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_GENDER->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_GENDER->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_MOBILE"><div class="view3_BROKER_MOBILE"><span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_MOBILE">
<?php if ($Page->sortUrl($Page->BROKER_MOBILE) == "") { ?>
		<div class="ew-table-header-btn view3_BROKER_MOBILE">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_BROKER_MOBILE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_MOBILE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_MOBILE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_MOBILE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_MOBILE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BROKER_EMAIL->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BROKER_EMAIL"><div class="view3_BROKER_EMAIL"><span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BROKER_EMAIL">
<?php if ($Page->sortUrl($Page->BROKER_EMAIL) == "") { ?>
		<div class="ew-table-header-btn view3_BROKER_EMAIL">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_BROKER_EMAIL" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->BROKER_EMAIL) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->BROKER_EMAIL->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->BROKER_EMAIL->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->BROKER_EMAIL->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->REGISTERATION_CERTIFICATE->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="REGISTERATION_CERTIFICATE"><div class="view3_REGISTERATION_CERTIFICATE"><span class="ew-table-header-caption"><?php echo $Page->REGISTERATION_CERTIFICATE->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="REGISTERATION_CERTIFICATE">
<?php if ($Page->sortUrl($Page->REGISTERATION_CERTIFICATE) == "") { ?>
		<div class="ew-table-header-btn view3_REGISTERATION_CERTIFICATE">
			<span class="ew-table-header-caption"><?php echo $Page->REGISTERATION_CERTIFICATE->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_REGISTERATION_CERTIFICATE" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->REGISTERATION_CERTIFICATE) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->REGISTERATION_CERTIFICATE->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->REGISTERATION_CERTIFICATE->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->REGISTERATION_CERTIFICATE->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="APARTMENT_NAME"><div class="view3_APARTMENT_NAME"><span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="APARTMENT_NAME">
<?php if ($Page->sortUrl($Page->APARTMENT_NAME) == "") { ?>
		<div class="ew-table-header-btn view3_APARTMENT_NAME">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_APARTMENT_NAME', form: 'fview3rpt', name: 'view3_APARTMENT_NAME', range: false, from: '<?php echo $Page->APARTMENT_NAME->RangeFrom; ?>', to: '<?php echo $Page->APARTMENT_NAME->RangeTo; ?>' });" id="x_APARTMENT_NAME<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer view3_APARTMENT_NAME" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->APARTMENT_NAME) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->APARTMENT_NAME->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->APARTMENT_NAME->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->APARTMENT_NAME->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_APARTMENT_NAME', form: 'fview3rpt', name: 'view3_APARTMENT_NAME', range: false, from: '<?php echo $Page->APARTMENT_NAME->RangeFrom; ?>', to: '<?php echo $Page->APARTMENT_NAME->RangeTo; ?>' });" id="x_APARTMENT_NAME<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
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
<?php if ($Page->broker_state->Visible) { ?>
		<td data-field="broker_state"<?php echo $Page->broker_state->cellAttributes() ?>>
<span<?php echo $Page->broker_state->viewAttributes() ?>><?php echo $Page->broker_state->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->broker_city->Visible) { ?>
		<td data-field="broker_city"<?php echo $Page->broker_city->cellAttributes() ?>>
<span<?php echo $Page->broker_city->viewAttributes() ?>><?php echo $Page->broker_city->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->broker_area->Visible) { ?>
		<td data-field="broker_area"<?php echo $Page->broker_area->cellAttributes() ?>>
<span<?php echo $Page->broker_area->viewAttributes() ?>><?php echo $Page->broker_area->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_ADDRESS->Visible) { ?>
		<td data-field="BROKER_ADDRESS"<?php echo $Page->BROKER_ADDRESS->cellAttributes() ?>>
<span<?php echo $Page->BROKER_ADDRESS->viewAttributes() ?>><?php echo $Page->BROKER_ADDRESS->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_NAME->Visible) { ?>
		<td data-field="BROKER_NAME"<?php echo $Page->BROKER_NAME->cellAttributes() ?>>
<span<?php echo $Page->BROKER_NAME->viewAttributes() ?>><?php echo $Page->BROKER_NAME->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_GENDER->Visible) { ?>
		<td data-field="BROKER_GENDER"<?php echo $Page->BROKER_GENDER->cellAttributes() ?>>
<span<?php echo $Page->BROKER_GENDER->viewAttributes() ?>><?php echo $Page->BROKER_GENDER->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_MOBILE->Visible) { ?>
		<td data-field="BROKER_MOBILE"<?php echo $Page->BROKER_MOBILE->cellAttributes() ?>>
<span<?php echo $Page->BROKER_MOBILE->viewAttributes() ?>><?php echo $Page->BROKER_MOBILE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BROKER_EMAIL->Visible) { ?>
		<td data-field="BROKER_EMAIL"<?php echo $Page->BROKER_EMAIL->cellAttributes() ?>>
<span<?php echo $Page->BROKER_EMAIL->viewAttributes() ?>><?php echo $Page->BROKER_EMAIL->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->REGISTERATION_CERTIFICATE->Visible) { ?>
		<td data-field="REGISTERATION_CERTIFICATE"<?php echo $Page->REGISTERATION_CERTIFICATE->cellAttributes() ?>>
<span<?php echo $Page->REGISTERATION_CERTIFICATE->viewAttributes() ?>><?php echo $Page->REGISTERATION_CERTIFICATE->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->APARTMENT_NAME->Visible) { ?>
		<td data-field="APARTMENT_NAME"<?php echo $Page->APARTMENT_NAME->cellAttributes() ?>>
<span<?php echo $Page->APARTMENT_NAME->viewAttributes() ?>><?php echo $Page->APARTMENT_NAME->getViewValue() ?></span></td>
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
<div id="gmp_view3" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "view3_pager.php" ?>
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