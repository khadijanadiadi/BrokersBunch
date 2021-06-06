<?php
namespace PHPReportMaker12\bokerbunchF;
?>
<?php
namespace PHPReportMaker12\bokerbunchF;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(11, "mi_view1", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("11", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view1rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_view2", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("12", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view2rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_view4", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("14", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view4rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_view5", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("15", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view5rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_view3", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("16", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view3rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_view6", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("17", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view6rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_view7", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("18", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view7rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_view8", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("19", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view8rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_view9", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("20", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view9rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(21, "mi_view10", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("21", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view10rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(22, "mi_view11", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("22", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view11rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(23, "mi_view12", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("23", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view12rpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>