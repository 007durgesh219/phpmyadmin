<?php
/* $Id$ */

/**
 * Original translation to Arabic by Fisal <fisal77 at hotmail.com>
 * Update by Tarik kallida <kallida at caramail.com>
 */

$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'Tahoma, verdana, arial, helvetica, sans-serif';
$right_font_family = '"Windows UI", Tahoma, verdana, arial, helvetica, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('ÈÇٌÊ', 'نٌهيÈÇٌÊ', 'ځٌضÇÈÇٌÊ', 'ÛٌÛÇÈÇٌÊ');

$day_of_week = array('ÇهژطÏ', 'ÇهشËوٌو', 'ÇهËهÇËÇز', 'ÇهژعÈگÇز', 'ÇهÎځٌـ', 'ÇهضځگÉ', 'ÇهـÈÊ');
$month = array('ٌوÇٌع', 'لÈعÇٌع', 'ځÇعـ', 'ژÈعٌه', 'ځÇٌي', 'ٌيوٌي', 'ٌيهٌي', 'ژÛـكـ', 'ـÈÊځÈع', 'ژنÊيÈع', 'ويلځÈع', 'ÏٌـځÈع');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y ÇهـÇگÉ %H:%M';

$strAccessDenied = 'Ûٌع ځـځيط';
$strAction = 'ÇهگځهٌÉ';
$strAddDeleteColumn = 'شقÇلى/طㄓل گځيÏ طمه';
$strAddDeleteRow = 'شقÇلى/طㄓل فل ـضه';
$strAddNewField = 'شقÇلÉ طمه ضÏٌÏ';
$strAddPriv = 'شقÇلÉ شځÊٌÇغ ضÏٌÏ';
$strAddPrivMessage = 'همÏ ژقلÊ شځÊٌÇغ ضÏٌÏ.';
$strAddSearchConditions = 'ژقل Ôعيك ÇهÈطË (ضـځ ځو Çهلمعى "where" clause):';
$strAddToIndex = 'شقÇلى نلىعـ &nbsp;%s&nbsp;فل(Üيل)';
$strAddUser = 'ژقل ځـÊÎÏځ ضÏٌÏ';
$strAddUserMessage = 'همÏ ژقلÊ ځـÊÎÏځ ضÏٌÏ.';
$strAffectedRows = 'فليل ځسËعى:';
$strAfter = 'ÈگÏ %s';
$strAfterInsertBack = 'Çهعضيگ شهً ÇهفلطÉ ÇهـÇÈمÉ';
$strAfterInsertNewInsert = 'شÏÎÇه Êـضٌه ضÏٌÏ';
$strAll = 'Çهنه';
$strAlterOrderBy = 'ÊگÏٌه ÊعÊٌÈ ÇهضÏيه ÈÜ';
$strAnalyzeTable = 'Êطهٌه ÇهضÏيه';
$strAnd = 'ي';
$strAnIndex = 'همÏ ژّقٌل Çهلىعـ لٌ %s';
$strAny = 'ژٌ';
$strAnyColumn = 'ژٌ گځيÏ';
$strAnyDatabase = 'ژٌ مÇگÏÉ ÈٌÇوÇÊ';
$strAnyHost = 'ژٌ ځغيÏ';
$strAnyTable = 'ژٌ ضÏيه';
$strAnyUser = 'ژٌ ځـÊÎÏځ';
$strAPrimaryKey = 'همÏ ژّقٌل ÇهځلÊÇط ÇهژـÇـٌ لٌ %s';
$strAscending = 'ÊفÇگÏٌÇٍ';
$strAtBeginningOfTable = 'لٌ ÈÏÇٌÉ ÇهضÏيه';
$strAtEndOfTable = 'لٌ وىÇٌÉ ÇهضÏيه';
$strAttr = 'ÇهÎيÇف';

$strBack = 'عضيگ';
$strBinary = 'ËوÇصٌ';
$strBinaryDoNotEdit = 'ËوÇصٌ - هÇÊطععى';
$strBookmarkDeleted = 'همÏ طّㄓلÊ ÇهگهÇځى Çهځعضگٌى.';
$strBookmarkLabel = 'گهÇځى';
$strBookmarkQuery = 'گهÇځى ځعضگٌى SQL-شـÊگهÇځ';
$strBookmarkThis = 'شضگه گهÇځى ځعضگٌى SQL-شـÊگهÇځ';
$strBookmarkView = 'گعق لمك';
$strBrowse = 'شـÊگعÇق';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'هÇٌځنو Êطځٌه شځÊÏÇÏ MySQL,<br />ÇهعضÇز لطف شگÏÇÏÇÊ PHP.';
$strCantRenameIdxToPrimary = 'هÇٌځنو ÊÛٌٌع شـځ Çهلىعـ شهً ÇهژـÇـٌ!';
$strCardinality = 'Cardinality';
$strCarriage = 'شعضÇگ Çهطځيهى: \\r';
$strChange = 'ÊÛٌٌع';
$strChangePassword = 'ÊÛٌٌع نهځÉ Çهـع';
$strCheckAll = 'شÎÊع Çهنه';
$strCheckDbPriv = 'لطف شځÊٌÇغ مÇگÏÉ ÇهÈٌÇوÇÊ';
$strCheckTable = 'ÇهÊطمم ځو ÇهضÏيه';
$strColumn = 'گځيÏ';
$strColumnNames = 'شـځ ÇهگځيÏ';
$strCompleteInserts = 'ÇهشÏÎÇه همÏ شنÊځه';
$strConfirm = 'ىه ÊعٌÏ طمÇٍ ژو Êلگه ㄓهنر';
$strCookiesRequired = 'ٌضÈ Êلگٌه Ïگځ Çهنينٌغ لٌ ىㄓى ÇهځعطهÉ.';
$strCopyTable = 'وـÎ ÇهضÏيه شهً';
$strCopyTableOK = 'ÇهضÏيه %s همÏ Êځ وـÎى شهً %s.';
$strCreate = 'Êنيٌو';
$strCreateIndex = 'Êفځٌځ لىعـى گهً&nbsp;%s&nbsp;گځيÏ';
$strCreateIndexTopic = 'Êفځٌځ لىعـى ضÏٌÏى';
$strCreateNewDatabase = 'Êنيٌو مÇگÏÉ ÈٌÇوÇÊ ضÏٌÏÉ';
$strCreateNewTable = 'Êنيٌو ضÏيه ضÏٌÏ لٌ مÇگÏÉ ÇهÈٌÇوÇÊ %s';
$strCriteria = 'ÇهځگÇٌٌع';

$strData = 'ÈٌÇوÇÊ';
$strDatabase = 'مÇگÏÉ ÇهÈٌÇوÇÊ ';
$strDatabaseHasBeenDropped = 'مÇگÏÉ ÈٌÇوÇÊ %s ځطㄓيلى.';
$strDatabases = 'مÇگÏÉ ÈٌÇوÇÊ';
$strDatabasesStats = 'شطفÇصٌÇÊ ميÇگÏ ÇهÈٌÇوÇÊ';
$strDatabaseWildcard = 'مÇگÏÉ ÈٌÇوÇÊ:';
$strDataOnly = 'ÈٌÇوÇÊ لمك';
$strDefault = 'شلÊعÇقٌ';
$strDelete = 'طㄓل';
$strDeleted = 'همÏ Êځ طㄓل Çهفل';
$strDeletedRows = 'Çهفليل Çهځطㄓيلى:';
$strDeleteFailed = 'Çهطㄓل ÎÇكص!';
$strDeleteUserMessage = 'همÏ طㄓلÊ ÇهځـÊÎÏځ %s.';
$strDescending = 'ÊوÇغهٌÇٍ';
$strDisplay = 'گعق';
$strDisplayOrder = 'ÊعÊٌÈ Çهگعق:';
$strDoAQuery = 'Êضگه "شـÊگهÇځ ÈيÇـكÉ ÇهځËÇه" (wildcard: "%")';
$strDocu = 'ځـÊوÏÇÊ يËÇصمٌى';
$strDoYouReally = 'ىه ÊعٌÏ طمÇٍ Êولٌㄓ';
$strDrop = 'طㄓل';
$strDropDB = 'طㄓل مÇگÏÉ ÈٌÇوÇÊ %s';
$strDropTable = 'طㄓل ضÏيه';
$strDumpingData = 'شعضÇگ ژي شـÊٌعÇÏ ÈٌÇوÇÊ ÇهضÏيه';
$strDynamic = 'ÏٌوÇځٌنٌ';

$strEdit = 'Êطعٌع';
$strEditPrivileges = 'Êطعٌع ÇهشځÊٌÇغÇÊ';
$strEffective = 'لگÇه';
$strEmpty = 'شلعÇÛ ځطÊيً';
$strEmptyResultSet = 'MySQL مÇځ ÈشعضÇگ وÊٌضÉ شگÏÇÏ لÇعÛى (ځËهÇٍ. فل فلعٌ).';
$strEnd = 'وىÇٌى';
$strEnglishPrivileges = ' ځهÇطÙى: شـځ ÇهشځÊٌÇغ هÜMySQL ٌÙىع يٌّمعژ ÈÇههÛى Çهشوضهٌغٌى لمك ';
$strError = 'Îكژ';
$strExtendedInserts = 'شÏÎÇه ځّÏÏ';
$strExtra = 'شقÇلٌ';

$strField = 'Çهطمه';
$strFieldHasBeenDropped = 'طمه ځطㄓيل %s';
$strFields = ' گÏÏ Çهطميه';
$strFieldsEmpty = ' ÊگÏÇÏ Çهطمه لÇعÛ! ';
$strFieldsEnclosedBy = 'طمه ځقځو ÈÜ';
$strFieldsEscapedBy = 'طمه ځّÊضÇىه ÈÜ';
$strFieldsTerminatedBy = 'طمه ځلفيه ÈÜ';
$strFixed = 'ځËÈÊ';
$strFlushTable = 'شگÇÏÉ Êطځٌه ÇهضÏيه ("FLUSH")';
$strFormat = 'فٌÛى';
$strFormEmpty = 'ٌيضÏ مٌځى ځلميÏى ÈÇهوځيㄓض !';
$strFullText = 'وفيف نÇځهى';
$strFunction = 'ÏÇهÉ';

$strGenTime = 'ژوÔص لٌ';
$strGo = '&nbsp;ÊولٌÜÜㄓ&nbsp;';
$strGrants = 'Grants';
$strGzip = '"gzipped"';

$strHasBeenAltered = 'همÏ گّÏْه.';
$strHasBeenCreated = 'همÏ Êنيو.';
$strHome = 'ÇهفلطÉ ÇهعصٌـٌÉ';
$strHomepageOfficial = 'ÇهفلطÉ ÇهعصٌـٌÉ ÇهعـځٌÉ هÜ phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin فلطÉ ÇهÊوغٌه';
$strHost = 'ÇهځغيÏ';
$strHostEmpty = 'شـځ ÇهځـÊقٌل لÇعÛ!';

$strIdxFulltext = 'Çهوف نÇځهÇٍ';
$strIfYouWish = 'شㄓÇ نوÊ ÊعÛÈ لٌ ژو Êطځه Èگق ژگځÏÉ ÇهضÏيه لمك, طÏÏ ÈÇهلÇفهى ÇهÊٌ Êلفه مÇصځÉ Çهطمه.';
$strIgnore = 'ÊضÇىه';
$strIndex = 'لىعـÊ';
$strIndexes = 'لىÇعـ';
$strIndexHasBeenDropped = 'لىعـى ځطㄓيلى %s';
$strIndexName = 'شـځ Çهلىعـ&nbsp;:';
$strIndexType = 'ويگ Çهلىعـ&nbsp;:';
$strInsert = 'شÏÎÇه';
$strInsertAsNewRow = 'شÏÎÇه نÊـضٌه ضÏٌÏ';
$strInsertedRows = 'فليل ځÏÎهى:';
$strInsertNewRow = 'شقÇلÉ Êـضٌه ضÏٌÏ';
$strInsertTextfiles = 'شÏÎÇه ځهل وفٌ لٌ ÇهضÏيه';
$strInstructions = 'ÇهژيÇځع';
$strInUse = 'مٌÏ ÇهشـÊگځÇه';
$strInvalidName = '"%s" نهځى ځطضيغى, هÇٌځنون شـÊÎÏÇځىÇ نشـځ مÇگÏÉ ÈٌÇوÇÊ/ضÏيه/طمه.';

$strKeepPass = 'هÇÊÛٌع نهځÉ Çهـع';
$strKeyname = 'شـځ ÇهځلÊÇط';
$strKill = 'شÈكÇه';

$strLength = 'Çهكيه';
$strLengthSet = 'Çهكيه/Çهمٌځى*';
$strLimitNumRows = 'عمځ ÇهـضهÇÊ هنه فلطى';
$strLineFeed = 'Îكيك ځگعلى: \\n';
$strLines = 'Îكيك';
$strLinesTerminatedBy = 'Îكيك ځلفيهى ÈÜ';
$strLocationTextfile = 'ځنÇو ځهل وفٌ';
$strLogin = 'ÏÎيه';
$strLogout = 'Êـضٌه Îعيض';
$strLogPassword = 'نهځÉ Çهـع:';
$strLogUsername = 'شـځ ÇهځّـÊÎÏځ:';

$strModifications = 'ÊځÊ ÇهÊگÏٌهÇÊ';
$strModify = 'ÊگÏٌه';
$strModifyIndexTopic = 'ÊگÏٌه Çهلىعـى';
$strMoveTable = 'ومه ضÏيه شهً (مÇگÏÉ ÈٌÇوÇÊ<b>.</b>ضÏيه):';
$strMoveTableOK = '%s ضÏيه Êځ ومهى شهً %s.';
$strMySQLReloaded = 'Êځ شگÇÏÉ Êطځٌه MySQL ÈوضÇط.';
$strMySQLSaid = 'MySQL مÇه: ';
$strMySQLServerProcess = 'MySQL %pma_s1%  گهً ÇهځغيÏ %pma_s2% -  ÇهځـÊÎÏځ : %pma_s3%';
$strMySQLShowProcess = 'گعق ÇهگځهٌÇÊ';
$strMySQLShowStatus = 'گعق طÇهÉ ÇهځغيÏ MySQL';
$strMySQLShowVars ='گعق ځÊÛٌعÇÊ ÇهځغيÏ MySQL';

$strName = 'Çهشـځ';
$strNext = 'ÇهÊÇهٌ';
$strNo = 'هÇ';
$strNoDatabases = 'هÇٌيضÏ ميÇگÏ ÈٌÇوÇÊ';
$strNoDropDatabases = 'ځگكه "طㄓل مÇگÏÉ ÈٌÇوÇÊ"Çهژځع ';
$strNoFrames = 'phpMyAdmin ژنËع ÊلىځÇٍ ځگ ځـÊگعق <b>ÇهشكÇعÇÊ</b>.';
$strNoIndex = 'لىعـ Ûٌع ځگعل!';
$strNoIndexPartsDefined = 'شضغÇز Çهلىعـى Ûٌع ځگعلى!';
$strNoModification = 'هÇ ÊÛٌٌعÇÊ';
$strNone = 'هÇÔص';
$strNoPassword = 'هÇ نهځÉ ـع';
$strNoPrivileges = 'شځÊٌÇغ Ûٌع ځيضيÏ';
$strNoQuery = 'هٌـÊ شـÊگهÇځ SQL!';
$strNoRights = 'هٌـ هÏٌن Çهطميم ÇهنÇلٌى Èژو Êنيو ىوÇ ÇهÂو!';
$strNoTablesFound = 'هÇٌيضÏ ضÏÇيه ځÊيلعى لٌ مÇگÏÉ ÇهÈٌÇوÇÊ ىㄓى!.';
$strNotNumber = 'ىㄓÇ هٌـ عمځ!';
$strNotValidNumber = ' ىㄓÇ هٌـ گÏÏ فل فطٌط!';
$strNoUsersFound = 'ÇهځـÊÎÏځ(Üٌو) هځ ٌÊځ شٌضÇÏىځ.';
$strNull = 'ÎÇهٌ';

$strOftenQuotation = 'ÛÇهÈÇٍ گهÇځÇÊ ÇهشمÊÈÇـ. شÎÊٌÇعٌ ٌگوٌ Èژو Çهطميه  char ي varchar Êعلم ÈÜ " ".';
$strOptimizeTable = 'قÛك ÇهضÏيه';
$strOptionalControls = 'شÎÊٌÇعٌ. ÇهÊطنځ لٌ نٌلٌÉ نÊÇÈÉ ژي معÇزÉ Çهژطعل ژي Çهضځه ÇهÎÇفى.';
$strOptionally = 'شÎÊٌÇعٌ';
$strOr = 'ژي';
$strOverhead = 'Çهليمٌ';

$strPartialText = 'وفيف ضغصٌى';
$strPassword = 'نهځÉ Çهـع';
$strPasswordEmpty = 'نهځÉ Çهـع لÇعÛÉ !';
$strPasswordNotSame = 'نهځÊÇ Çهـع Ûٌع ځÊÔÇÈىÊÇو !';
$strPHPVersion = ' PHP شفÏÇعÉ';
$strPmaDocumentation = 'ځـÊوÏÇÊ يËÇصمٌى هÜ phpMyAdmin (ÈÇهشوضهٌغٌÉ)';
$strPmaUriError = 'ÇهځÊÛٌع <span dir="ltr"><tt>$cfg[\'PmaAbsoluteUri\']</tt></span> ٌضÈ ÊگÏٌهى لٌ ځهل Çهنيلٌن !';
$strPos1 = 'ÈÏÇٌÉ';
$strPrevious = 'ـÇÈم';
$strPrimary = 'ژـÇـٌ';
$strPrimaryKey = 'ځلÊÇط ژـÇـٌ';
$strPrimaryKeyHasBeenDropped = 'همÏ Êځ طㄓل ÇهځلÊÇط ÇهژـÇـٌ';
$strPrimaryKeyName = 'شـځ ÇهځلÊÇط ÇهژـÇـٌ ٌضÈ ژو ٌنيو ژـÇـٌ... PRIMARY!';
$strPrimaryKeyWarning = '("ÇهژـÇـٌ" <b>ٌضÈ</b> ٌضÈ ژو ٌنيو Çهژـځ <b>يژٌقÇٍ لمك</b> ÇهځلÊÇط ÇهژـÇـٌ!)';
$strPrintView = 'گعق وـÎÉ ههكÈÇگÉ';
$strPrivileges = 'ÇهشځÊٌÇغÇÊ';
$strProperties = 'ÎفÇصف';

$strQBE = 'شـÊگهÇځ ÈيÇـكÉ ځËÇه';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'لٌ مÇگÏÉ ÇهÈٌÇوÇÊ SQL-شـÊگهÇځ <b>%s</b>:';

$strRecords = 'ÇهÊـضٌهÇÊ';
$strReferentialIntegrity = 'ÊطÏٌÏ referential integrity:';
$strReloadFailed = ' شگÇÏÉ Êطځٌه ÎÇكصىMySQL.';
$strReloadMySQL = 'شگÇÏÉ Êطځٌه MySQL';
$strRememberReload = 'Êㄓنٌع هشگÇÏÉ Êطځٌه ÇهÎÇÏځ.';
$strRenameTable = 'ÊÛٌٌع شـځ ضÏيه شهً';
$strRenameTableOK = 'Êځ ÊÛٌٌع شـځىځ شهً %s  ضÏيه%s';
$strRepairTable = 'شفهÇط ÇهضÏيه';
$strReplace = 'شـÊÈÏÇه';
$strReplaceTable = 'شـÊÈÏÇه ÈٌÇوÇÊ ÇهضÏيه ÈÇهځهل';
$strReset = 'شهÛÇز';
$strReType = 'ژگÏ نÊÇÈى';
$strRevoke = 'شÈكÇه';
$strRevokeGrant = 'شÈكÇه Grant';
$strRevokeGrantMessage = 'همÏ ژÈكهÊ شځÊٌÇغ Grant هÜ %s';
$strRevokeMessage = 'همÏ ژÈكهÊ ÇهژځÊٌÇغÇÊ هÜ %s';
$strRevokePriv = 'شÈكÇه شځÊٌÇغÇÊ';
$strRowLength = 'كيه Çهفل';
$strRows = 'فليل';
$strRowsFrom = 'فليل ÊÈÏژ ځو';
$strRowSize = ' ځمÇـ Çهفل ';
$strRowsModeHorizontal = 'ژلمٌ';
$strRowsModeOptions = ' %s ي شگÇÏÉ Çهعسيـ ÈگÏ %s طمه';
$strRowsModeVertical = 'گځيÏٌ';
$strRowsStatistic = 'شطفÇصٌÇÊ';
$strRunning = ' گهً ÇهځغيÏ %s';
$strRunQuery = 'شعـÇه ÇهشـÊگهÇځ';
$strRunSQLQuery = 'Êولٌㄓ شـÊگهÇځ/شـÊگهÇځÇÊ SQL گهً مÇگÏÉ ÈٌÇوÇÊ %s';

$strSave = 'طلÜÜÙ';
$strSelect = 'شÎÊٌÇع';
$strSelectADb = 'شÎÊع مÇگÏÉ ÈٌÇوÇÊ ځو ÇهمÇصځÉ';
$strSelectAll = 'ÊطÏٌÏ Çهنه';
$strSelectFields = 'شÎÊٌÇع طميه (گهً Çهژمه يÇطÏ):';
$strSelectNumRows = 'لٌ ÇهشـÊگهÇځ';
$strSend = 'طلÙ نځهل';
$strServerChoice = 'شÎÊٌÇع ÇهÎÇÏځ';
$strServerVersion = 'شفÏÇعÉ ÇهځغيÏ';
$strSetEnumVal = 'شㄓÇ نÇو ويگ Çهطمه ىي "enum" ژي "set", ÇهعضÇز شÏÎÇه Çهمٌځ ÈشـÊÎÏÇځ ىㄓÇ ÇهÊوـٌم: \'a\',\'b\',\'c\'...<br />شㄓÇ نوÊ ÊطÊÇض Èژو Êقگ گهÇځÉ ÇهÔعكى ÇهځÇصهى ههٌـÇع ("\") ژي گهÇځÉ ÇهشمÊÈÇـ ÇهلعÏٌى ("\'") لٌځÇ Èٌو Êهن Çهمٌځ, شضگهىÇ نÔعكى ځÇصهى ههٌـÇع (ځËهÇٍ \'\\\\xyz\' ژي \'a\\\'b\').';
$strShow = 'گعق';
$strShowAll = 'ÔÇىÏ Çهنه';
$strShowCols = 'ÔÇىÏ ÇهژگځÏى';
$strShowingRecords = 'ځÔÇىÏÉ ÇهـضهÇÊ ';
$strShowPHPInfo = 'گعق ÇهځگهيځÇÊ ÇهځÊگهمÉ È  PHP';
$strShowTables = 'ÔÇىÏ ÇهضÏيه';
$strShowThisQuery = ' گعق ىㄓÇ ÇهشـÊگهÇځ ىوÇ ځعÉ ژÎعً ';
$strSingly = '(لعÏٌ)';
$strSize = 'Çهطضځ';
$strSort = 'Êفوٌل';
$strSpaceUsage = 'ÇهځـÇطÉ ÇهځـÊÛهÉ';
$strSQLQuery = 'شـÊگهÇځ-SQL';
$strStatement = 'ژيÇځع';
$strStrucCSV = 'ÈٌÇوÇÊ CSV';
$strStrucData = 'ÇهÈوٌÉ يÇهÈٌÇوÇÊ';
$strStrucDrop = ' شقÇلÉ \'طㄓل ضÏيه شㄓÇ نÇو ځيضيÏÇ\' لٌ ÇهÈÏÇٌÉ';
$strStrucExcelCSV = 'ÈٌÇوÇÊ CSV هÈعوÇځض  Ms Excel';
$strStrucOnly = 'ÇهÈوٌÉ لمك';
$strSubmit = 'شعـÇه';
$strSuccess = 'ÇهÎÇف Èن Êځ Êولٌㄓى ÈوضÇط SQL-شـÊگهÇځ';
$strSum = 'Çهځضځيگ';

$strTable = 'ÇهضÏيه ';
$strTableComments = 'ÊگهٌمÇÊ گهً ÇهضÏيه';
$strTableEmpty = 'شـځ ÇهضÏيه لÇعÛ!';
$strTableHasBeenDropped = 'ضÏيه %s طّㄓلÊ';
$strTableHasBeenEmptied = 'ضÏيه %s ژّلعÛÊ ځطÊيٌÇÊىÇ';
$strTableHasBeenFlushed = 'همÏ Êځ شگÇÏÉ Êطځٌه ÇهضÏيه %s  ÈوضÇط';
$strTableMaintenance = 'فٌÇوÉ ÇهضÏيه';
$strTables = '%s  ضÏيه (ضÏÇيه)';
$strTableStructure = 'ÈوٌÉ ÇهضÏيه';
$strTableType = 'ويگ ÇهضÏيه';
$strTextAreaLength = ' ÈـÈÈ كيهى,<br /> لځو ÇهځطÊځه ژو ىㄓÇ Çهطمه Ûٌع مÇÈه ههÊطعٌع ';
$strTheContent = 'همÏ Êځ شÏÎÇه ځطÊيٌÇÊ ځهلن.';
$strTheContents = 'همÏ Êځ شـÊÈÏÇه ځطÊيٌÇÊ ÇهضÏيه ÇهځطÏÏ ههفليل ÈÇهځلÊÇط Çهځځٌغ ژي ÇهژـÇـٌ ÇهځځÇËه هىځÇ ÈځطÊيٌÇÊ Çهځهل.';
$strTheTerminator = 'لÇفه Çهطميه.';
$strTotal = 'Çهځضځيگ';
$strType = 'Çهويگ';

$strUncheckAll = 'شهÛÇز ÊطÏٌÏ Çهنه';
$strUnique = 'ځځٌغ';
$strUnselectAll = 'شهÛÇز ÊطÏٌÏ Çهنه';
$strUpdatePrivMessage = 'همÏ ضÏÏÊ يطÏËÊ ÇهشځÊٌÇغÇÊ هÜ %s.';
$strUpdateProfile = 'ÊضÏٌÏ Çهگعق ÇهضÇوÈٌ:';
$strUpdateProfileMessage = 'همÏ Êځ ÊضÏٌÏ Çهگعق ÇهضÇوÈٌ.';
$strUpdateQuery = 'ÊضÏٌÏ شـÊگهÇځ';
$strUsage = 'ÇهځـÇطÉ';
$strUseBackquotes = 'طځÇٌÉ ژـځÇز ÇهضÏÇيه ي Çهطميه È "`" ';
$strUser = 'ÇهځـÊÎÏځ';
$strUserEmpty = 'شـځ ÇهځـÊÎÏځ لÇعÛ!';
$strUserName = 'شـځ ÇهځـÊÎÏځ';
$strUsers = 'ÇهځـÊÎÏځٌو';
$strUseTables = 'شـÊÎÏځ ÇهضÏيه';

$strValue = 'Çهمٌځى';
$strViewDump = 'گعق ÈوٌÉ ÇهضÏيه ';
$strViewDumpDB = 'گعق ÈوٌÉ مÇگÏÉ ÇهÈٌÇوÇÊ';

$strWelcome = 'ژىهÇٍ Èن لٌ %s';
$strWithChecked = ': گهً ÇهځطÏÏ';
$strWrongUser = 'Îكژ شـځ ÇهځـÊÎÏځ/نهځÉ Çهـع. ÇهÏÎيه ځځويگ.';

$strYes = 'وگځ';

$strZip = '"zipped" "ځقÛيك"';
// To translate

$strAllTableSameWidth = 'display all Tables with same width?';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strChangeDisplay = 'Choose Field to display';  //to translate
$strCharsetOfFile = 'Character set of the file:'; //to translate
$strChoosePage = 'Please choose a Page to edit';  //to translate
$strColComFeat = 'Displaying Column Comments';  //to translate
$strComments = 'Comments';  //to translate
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br />This might happen if php finds a parse error in it or php cannot find the file.<br />Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br />If you recieve a blank page, everything is fine.'; //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCreatePage = 'Create a new Page';  //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate

$strDisabled = 'Disabled';  //to translate
$strDisplayFeat = 'Display Features';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
$strDumpXRows = 'Dump %s rows starting at row %s.'; //to translate

$strEditPDFPages = 'Edit PDF Pages';  //to translate
$strEnabled = 'Enabled';  //to translate
$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate
$strExplain = 'Explain SQL';  //to translate
$strExport = 'Export';  //to translate
$strExportToXML = 'Export to XML format'; //to translate

$strGenBy = 'Generated by'; //to translate
$strGeneralRelationFeat = 'General relation features';  //to translate

$strHaveToShow = 'You have to choose at least one Column to display';  //to translate

$strLinkNotFound = 'Link not found';  //to translate
$strLinksTo = 'Links to';  //to translate

$strMissingBracket = 'Missing Bracket';  //to translate
$strMySQLCharset = 'MySQL Charset';  //to translate

$strNoDescription = 'no Description';  //to translate
$strNoExplain = 'Skip Explain SQL';  //to translate
$strNoPhp = 'without PHP Code';  //to translate
$strNotOK = 'not OK';  //to translate
$strNotSet = '<b>%s</b> table not found or not set in %s';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';//to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate
$strOperations = 'Operations';  //to translate
$strOptions = 'Options';  //to translate

$strPageNumber = 'Page number:';  //to translate
$strPdfDbSchema = 'Schema of the the "%s" database - Page %s';  //to translate
$strPdfInvalidPageNum = 'Undefined PDF page number!';  //to translate
$strPdfInvalidTblName = 'The "%s" table does not exist!';  //to translate
$strPdfNoTables = 'No tables';  //to translate
$strPhp = 'Create PHP Code';  //to translate

$strRelationNotWorking = 'The additional Features for working with linked Tables have been deactivated. To find out why click %shere%s.';  //to translate
$strRelationView = 'Relation view';  //to translate

$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearch = 'Search';//to translate
$strSearchFormTitle = 'Search in database';//to translate
$strSearchInTables = 'Inside table(s):';//to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strSearchOption1 = 'at least one of the words';//to translate
$strSearchOption2 = 'all words';//to translate
$strSearchOption3 = 'the exact phrase';//to translate
$strSearchOption4 = 'as regular expression';//to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSearchType = 'Find:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowColor = 'Show color';  //to translate
$strShowGrid = 'Show grid';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSplitWordsWithSpace = 'Words are seperated by a space character (" ").';//to translate
$strSQL = 'SQL'; //to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQLResult = 'SQL result'; //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strStructPropose = 'Propose table structure';  //to translate
$strStructure = 'Structure';  //to translate

$strValidateSQL = 'Validate SQL';  //to translate

$strInsecureMySQL = 'Your configuration file contains settings (root with no password) that correspond to the default MySQL privileged account. Your MySQL server is running with this default, is open to intrusion, and you really should fix this security hole.';  //to translate
$strWebServerUploadDirectory = 'web-server upload directory';  //to translate
$strWebServerUploadDirectoryError = 'The directory you set for upload work cannot be reached';  //to translate
$strValidatorError = 'The SQL validator could not be initialized. Please check if you have installed the necessary php extensions as described in the %sdocumentation%s.'; //to translate
$strServer = 'Server %s';  //to translate
$strPutColNames = 'Put fields names at first row';  //to translate
$strImportDocSQL = 'Import docSQL Files';  //to translate
$strDataDict = 'Data Dictionary';  //to translate
$strPrint = 'Print';  //to translate
$strPHP40203 = 'You are using PHP 4.2.3, which has a serious bug with multi-byte strings (mbstring). See PHP bug report 19404. This version of PHP is not recommended for use with phpMyAdmin.';  //to translate
$strCompression = 'Compression'; //to translate
$strNumTables = 'Tables'; //to translate
$strTotalUC = 'Total'; //to translate
$strRelationalSchema = 'Relational schema';  //to translate
$strTableOfContents = 'Table of contents';  //to translate
$strCannotLogin = 'Cannot login to MySQL server';  //to translate
$strShowDatadictAs = 'Data Dictionary Format';  //to translate
$strLandscape = 'Landscape';  //to translate
$strPortrait = 'Portrait';  //to translate

$timespanfmt = '%s days, %s hours, %s minutes and %s seconds'; //to translate

$strAbortedClients = 'Aborted'; //to translate
$strConnections = 'Connections'; //to translate
$strFailedAttempts = 'Failed attempts'; //to translate
$strGlobalValue = 'Global value'; //to translate
$strMoreStatusVars = 'More status variables'; //to translate
$strPerHour = 'per hour'; //to translate
$strQueryStatistics = '<b>Query statistics</b>: Since its startup, %s queries have been sent to the server.';
$strQueryType = 'Query type'; //to translate
$strReceived = 'Received'; //to translate
$strSent = 'Sent'; //to translate
$strServerStatus = 'Runtime Information'; //to translate
$strServerStatusUptime = 'This MySQL server has been running for %s. It started up on %s.'; //to translate
$strServerTabVariables = 'Variables'; //to translate
$strServerTabProcesslist = 'Processes'; //to translate
$strServerTrafficNotes = '<b>Server traffic</b>: These tables show the network traffic statistics of this MySQL server since its startup.';
$strServerVars = 'Server variables and settings'; //to translate
$strSessionValue = 'Session value'; //to translate
$strTraffic = 'Traffic'; //to translate
$strVar = 'Variable'; //to translate

$strCommand = 'Command'; //to translate
$strCouldNotKill = 'phpMyAdmin was unable to kill thread %s. It probably has already been closed.'; //to translate
$strId = 'ID'; //to translate
$strProcesslist = 'Process list'; //to translate
$strStatus = 'Status'; //to translate
$strTime = 'Time'; //to translate
$strThreadSuccessfullyKilled = 'Thread %s was successfully killed.'; //to translate

$strBzError = 'phpMyAdmin was unable to compress the dump because of a broken Bz2 extension in this php version. It is strongly recommended to set the <code>$cfg[\'BZipDump\']</code> directive in your phpMyAdmin configuration file to <code>FALSE</code>. If you want to use the Bz2 compression features, you should upgrade to a later php version. See php bug report %s for details.'; //to translate
$strLaTeX = 'LaTeX';  //to translate

$strAdministration = 'Administration'; //to translate
$strFlushPrivilegesNote = 'Note: phpMyAdmin gets the users\' privileges directly from MySQL\'s privilege tables. The content of this tables may differ from the privileges the server uses if manual changes have made to it. In this case, you should %sreload the privileges%s before you continue.'; //to translate
$strGlobalPrivileges = 'Global privileges'; //to translate
$strGrantOption = 'Grant'; //to translate
$strPrivDescAllPrivileges = 'Includes all privileges except GRANT.'; //to translate
$strPrivDescAlter = 'Allows altering the structure of existing tables.'; //to translate
$strPrivDescCreateDb = 'Allows creating new databases and tables.'; //to translate
$strPrivDescCreateTbl = 'Allows creating new tables.'; //to translate
$strPrivDescCreateTmpTable = 'Allows creating temporary tables.'; //to translate
$strPrivDescDelete = 'Allows deleting data.'; //to translate
$strPrivDescDropDb = 'Allows dropping databases and tables.'; //to translate
$strPrivDescDropTbl = 'Allows dropping tables.'; //to translate
$strPrivDescExecute = 'Allows running stored procedures; Has no effect in this MySQL version.'; //to translate
$strPrivDescFile = 'Allows importing data from and exporting data into files.'; //to translate
$strPrivDescGrant = 'Allows adding users and privileges without reloading the privilege tables.'; //to translate
$strPrivDescIndex = 'Allows creating and dropping indexes.'; //to translate
$strPrivDescInsert = 'Allows inserting and replacing data.'; //to translate
$strPrivDescLockTables = 'Allows locking tables for the current thread.'; //to translate
$strPrivDescMaxConnections = 'Limits the number of new connections the user may open per hour.';
$strPrivDescMaxQuestions = 'Limits the number of queries the user may send to the server per hour.';
$strPrivDescMaxUpdates = 'Limits the number of commands that change any table or database the user may execute per hour.';
$strPrivDescProcess3 = 'Allows killing processes of other users.'; //to translate
$strPrivDescProcess4 = 'Allows viewing the complete queries in the process list.'; //to translate
$strPrivDescReferences = 'Has no effect in this MySQL version.'; //to translate
$strPrivDescReplClient = 'Gives the right to the user to ask where the slaves / masters are.'; //to translate
$strPrivDescReplSlave = 'Needed for the replication slaves.'; //to translate
$strPrivDescReload = 'Allows reloading server settings and flushing the server\'s caches.'; //to translate
$strPrivDescSelect = 'Allows reading data.'; //to translate
$strPrivDescShowDb = 'Gives access to the complete list of databases.'; //to translate
$strPrivDescShutdown = 'Allows shutting down the server.'; //to translate
$strPrivDescSuper = 'Allows connectiong, even if maximum number of connections is reached; Required for most administrative operations like setting global variables or killing threads of other users.'; //to translate
$strPrivDescUpdate = 'Allows changing data.'; //to translate
$strPrivDescUsage = 'No privileges.'; //to translate
$strPrivilegesReloaded = 'The privileges were reloaded successfully.'; //to translate
$strResourceLimits = 'Resource limits'; //to translate
$strUserOverview = 'User overview'; //to translate
$strZeroRemovesTheLimit = 'Note: Setting these options to 0 (zero) removes the limit.'; //to translate

$strPasswordChanged = 'The Password for %s was changed successfully.'; // to translate

$strDeleteAndFlush = 'Delete the users and reload the privileges afterwards.'; //to translate
$strDeleteAndFlushDescr = 'This is the cleanest way, but reloading the privileges may take a while.'; //to translate
$strDeleting = 'Deleting %s'; //to translate
$strJustDelete = 'Just delete the users from the privilege tables.'; //to translate
$strJustDeleteDescr = 'The &quot;deleted&quot; users will still be able to access the server as usual until the privileges are reloaded.'; //to translate
$strReloadingThePrivileges = 'Reloading the privileges'; //to translate
$strRemoveSelectedUsers = 'Remove selected users'; //to translate
$strRevokeAndDelete = 'Revoke all active privileges from the users and delete them afterwards.'; //to translate
$strRevokeAndDeleteDescr = 'The users will still have the USAGE privilege until the privileges are reloaded.'; //to translate
$strUsersDeleted = 'The selected users have been deleted successfully.'; //to translate

$strAddPrivilegesOnDb = 'Add privileges on the following database'; //to translate
$strAddPrivilegesOnTbl = 'Add privileges on the following table'; //to translate
$strColumnPrivileges = 'Column-specific privileges'; //to translate
$strDbPrivileges = 'Database-specific privileges'; //to translate
$strLocalhost = 'Local';
$strLoginInformation = 'Login Information'; //to translate
$strTblPrivileges = 'Table-specific privileges'; //to translate
$strThisHost = 'This Host'; //to translate
$strUserNotFound = 'The selected user was not found in the privilege table.'; //to translate
$strUserAlreadyExists = 'The user %s already exists!'; //to translate
$strUseTextField = 'Use text field'; //to translate

$strNoUsersSelected = 'No users selected.'; //to translate
$strDropUsersDb = 'Drop the databases that have the same names as the users.'; //to translate
$strAddedColumnComment = 'Added comment for column';  //to translate
$strWritingCommentNotPossible = 'Writing of comment not possible';  //to translate
$strAddedColumnRelation = 'Added relation for column';  //to translate
$strWritingRelationNotPossible = 'Writing of relation not possible';  //to translate
$strImportFinished = 'Import finished';  //to translate
$strFileCouldNotBeRead = 'File could not be read';  //to translate
$strIgnoringFile = 'Ignoring file %s';  //to translate
$strThisNotDirectory = 'This was not a directory';  //to translate
$strAbsolutePathToDocSqlDir = 'Please enter the absolute path on webserver to docSQL directory';  //to translate
$strImportFiles = 'Import files';  //to translate
$strDBGModule = 'Module';  //to translate
$strDBGLine = 'Line';  //to translate
$strDBGHits = 'Hits';  //to translate
$strDBGTimePerHitMs = 'Time/Hit, ms';  //to translate
$strDBGTotalTimeMs = 'Total time, ms';  //to translate
$strDBGMinTimeMs = 'Min time, ms';  //to translate
$strDBGMinTimeMs = 'Max time, ms';  //to translate
$strDBGContextID = 'Context ID';  //to translate
$strDBGContext = 'Context';  //to translate
$strCantLoad = 'cannot load %s extension,<br />please check PHP Configuration';  //to translate
?>
