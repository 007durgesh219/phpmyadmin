<?php
/* $Id$ */

/**
 * Original translation to Arabic by Fisal <fisal77 at hotmail.com>
 * Update by Tarik kallida <kallida at caramail.com>
 */


$charset = 'windows-1256';
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'Tahoma, verdana, arial, helvetica, sans-serif';
$right_font_family = '"Windows UI", Tahoma, verdana, arial, helvetica, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('����', '��������', '��������', '��������');

$day_of_week = array('�����', '�������', '��������', '��������', '������', '������', '�����');
$month = array('�����', '������', '����', '�����', '����', '�����', '�����', '�����', '������', '������', '������', '������');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y ������ %H:%M';


$strAccessDenied = '��� �����';
$strAction = '�������';
$strAddDeleteColumn = '�����/��� ���� ���';
$strAddDeleteRow = '�����/��� �� ���';
$strAddNewField = '����� ��� ����';
$strAddPriv = '����� ������ ����';
$strAddPrivMessage = '��� ���� ������ ����.';
$strAddSearchConditions = '��� ���� ����� (��� �� ������ "where" clause):';
$strAddToIndex = '����� ����� &nbsp;%s&nbsp;��(���)';
$strAddUser = '��� ������ ����';
$strAddUserMessage = '��� ���� ������ ����.';
$strAffectedRows = '���� �����:';
$strAfter = '��� %s';
$strAfterInsertBack = '������ ��� ������ �������';
$strAfterInsertNewInsert = '����� ����� ����';
$strAll = '����';
$strAlterOrderBy = '����� ����� ������ ��';
$strAnalyzeTable = '����� ������';
$strAnd = '�';
$strAnIndex = '��� ����� ������ �� %s';
$strAny = '��';
$strAnyColumn = '�� ����';
$strAnyDatabase = '�� ����� ������';
$strAnyHost = '�� ����';
$strAnyTable = '�� ����';
$strAnyUser = '�� ������';
$strAPrimaryKey = '��� ����� ������� ������� �� %s';
$strAscending = '��������';
$strAtBeginningOfTable = '�� ����� ������';
$strAtEndOfTable = '�� ����� ������';
$strAttr = '������';

$strBack = '����';
$strBinary = '�����';
$strBinaryDoNotEdit = '����� - �������';
$strBookmarkDeleted = '��� ����� ������� ��������.';
$strBookmarkLabel = '�����';
$strBookmarkQuery = '����� ������ SQL-�������';
$strBookmarkThis = '���� ����� ������ SQL-�������';
$strBookmarkView = '��� ���';
$strBrowse = '�������';
$strBzip = '"bzipped"';

$strCantLoadMySQL = '������ ����� ������ MySQL,<br />������ ��� ������� PHP.';
$strCantRenameIdxToPrimary = '������ ����� ��� ������ ��� �������!';
$strCarriage = '����� �������: \\r';
$strChange = '�����';
$strChangePassword = '����� ���� ����';
$strCheckAll = '���� ����';
$strCheckDbPriv = '��� ������ ����� ��������';
$strCheckTable = '������ �� ������';
$strColumn = '����';
$strColumnNames = '��� ������';
$strCompleteInserts = '������� ��� �����';
$strConfirm = '�� ���� ���� �� ���� ��߿';
$strCookiesRequired = '��� ����� ��� ������� �� ��� �������.';
$strCopyTable = '��� ������ ���';
$strCopyTableOK = '������ %s ��� �� ���� ��� %s.';
$strCreate = '�����';
$strCreateIndex = '����� ����� ���&nbsp;%s&nbsp;����';
$strCreateIndexTopic = '����� ����� �����';
$strCreateNewDatabase = '����� ����� ������ �����';
$strCreateNewTable = '����� ���� ���� �� ����� �������� %s';
$strCriteria = '��������';

$strData = '������';
$strDatabase = '����� �������� ';
$strDatabaseHasBeenDropped = '����� ������ %s ������.';
$strDatabases = '����� ������';
$strDatabasesStats = '�������� ����� ��������';
$strDatabaseWildcard = '����� ������:';
$strDataOnly = '������ ���';
$strDefault = '�������';
$strDelete = '���';
$strDeleted = '��� �� ��� ����';
$strDeletedRows = '������ ��������:';
$strDeleteFailed = '����� ����!';
$strDeleteUserMessage = '��� ���� �������� %s.';
$strDescending = '��������';
$strDisplay = '���';
$strDisplayOrder = '����� �����:';
$strDoAQuery = '���� "������� ������ ������" (wildcard: "%")';
$strDocu = '������� �������';
$strDoYouReally = '�� ���� ���� �����';
$strDrop = '���';
$strDropDB = '��� ����� ������ %s';
$strDropTable = '��� ����';
$strDumpingData = '����� �� ������� ������ ������';
$strDynamic = '��������';

$strEdit = '�����';
$strEditPrivileges = '����� ����������';
$strEffective = '����';
$strEmpty = '����� �����';
$strEmptyResultSet = 'MySQL ��� ������ ����� ����� ����� (�����. �� ����).';
$strEnd = '�����';
$strEnglishPrivileges = ' ������: ��� �������� ��MySQL ���� ������ ������ ���������� ��� ';
$strError = '���';
$strExtendedInserts = '����� ����';
$strExtra = '�����';

$strField = '�����';
$strFieldHasBeenDropped = '��� ����� %s';
$strFields = ' ��� ������';
$strFieldsEmpty = ' ����� ����� ����! ';
$strFieldsEnclosedBy = '��� ���� ��';
$strFieldsEscapedBy = '��� ������� ��';
$strFieldsTerminatedBy = '��� ����� ��';
$strFixed = '����';
$strFlushTable = '����� ����� ������ ("FLUSH")';
$strFormat = '����';
$strFormEmpty = '���� ���� ������ �������� !';
$strFullText = '���� �����';
$strFunction = '����';

$strGenTime = '���� ��';
$strGo = '&nbsp;�������&nbsp;';
$strGrants = 'Grants';
$strGzip = '"gzipped"';

$strHasBeenAltered = '��� �����.';
$strHasBeenCreated = '��� ����.';
$strHome = '������ ��������';
$strHomepageOfficial = '������ �������� ������� �� phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin ���� �������';
$strHost = '������';
$strHostEmpty = '��� �������� ����!';

$strIdxFulltext = '���� ������';
$strIfYouWish = '��� ��� ���� �� �� ���� ��� ����� ������ ���, ��� �������� ���� ���� ����� �����.';
$strIgnore = '�����';
$strIndex = '�����';
$strIndexHasBeenDropped = '����� ������ %s';
$strIndexName = '��� ������&nbsp;:';
$strIndexType = '��� ������&nbsp;:';
$strIndexes = '�����';
$strInsert = '�����';
$strInsertAsNewRow = '����� ������ ����';
$strInsertedRows = '���� �����:';
$strInsertNewRow = '����� ����� ����';
$strInsertTextfiles = '����� ��� ��� �� ������';
$strInstructions = '�������';
$strInUse = '��� ���������';
$strInvalidName = '"%s" ���� ������, ������� ��������� ���� ����� ������/����/���.';

$strKeepPass = '������ ���� ����';
$strKeyname = '��� �������';
$strKill = '�����';

$strLength = '�����';
$strLengthSet = '�����/������*';
$strLimitNumRows = '��� ������� ��� ����';
$strLineFeed = '���� �����: \\n';
$strLines = '����';
$strLinesTerminatedBy = '���� ������ ��';
$strLocationTextfile = '���� ��� ���';
$strLogin = '����';
$strLogout = '����� ����';
$strLogPassword = '���� ����:';
$strLogUsername = '��� ���������:';

$strModifications = '��� ���������';
$strModify = '�����';
$strModifyIndexTopic = '����� �������';
$strMoveTable = '��� ���� ��� (����� ������<b>.</b>����):';
$strMoveTableOK = '%s ���� �� ���� ��� %s.';
$strMySQLReloaded = '�� ����� ����� MySQL �����.';
$strMySQLSaid = 'MySQL ���: ';
$strMySQLServerProcess = 'MySQL %pma_s1%  ��� ������ %pma_s2% -  �������� : %pma_s3%';
$strMySQLShowProcess = '��� ��������';
$strMySQLShowStatus = '��� ���� ������ MySQL';
$strMySQLShowVars ='��� ������� ������ MySQL';

$strName = '�����';
$strNext = '������';
$strNo = '��';
$strNoDatabases = '������ ����� ������';
$strNoDropDatabases = '���� "��� ����� ������"����� ';
$strNoFrames = 'phpMyAdmin ���� ������ �� ������ <b>��������</b>.';
$strNoIndex = '���� ��� ����!';
$strNoIndexPartsDefined = '����� ������� ��� �����!';
$strNoModification = '�� �������';
$strNone = '����';
$strNoPassword = '�� ���� ��';
$strNoPrivileges = '������ ��� �����';
$strNoQuery = '���� ������� SQL!';
$strNoRights = '��� ���� ������ ������� ��� ���� ��� ����!';
$strNoTablesFound = '������ ����� ������ �� ����� �������� ���!.';
$strNotNumber = '��� ��� ���!';
$strNotValidNumber = ' ��� ��� ��� �� ����!';
$strNoUsersFound = '��������(���) �� ��� �������.';
$strNull = '����';

$strOftenQuotation = '������ ������ ��������. ������� ���� ��� ������  char � varchar ���� �� " ".';
$strOptimizeTable = '��� ������';
$strOptionalControls = '�������. ������ �� ����� ����� �� ����� ������ �� ����� ������.';
$strOptionally = '�������';
$strOr = '��';
$strOverhead = '������';

$strPartialText = '���� �����';
$strPassword = '���� ����';
$strPasswordEmpty = '���� ���� ����� !';
$strPasswordNotSame = '����� ���� ��� ��������� !';
$strPHPVersion = ' PHP ������';
$strPmaDocumentation = '������� ������� �� phpMyAdmin (�����������)';
$strPmaUriError = '������� <span dir="ltr"><tt>$cfgPmaAbsoluteUri</tt></span> ��� ������ �� ��� ������� !';
$strPos1 = '�����';
$strPrevious = '����';
$strPrimary = '�����';
$strPrimaryKey = '����� �����';
$strPrimaryKeyHasBeenDropped = '��� �� ��� ������� �������';
$strPrimaryKeyName = '��� ������� ������� ��� �� ���� �����... PRIMARY!';
$strPrimaryKeyWarning = '("�������" <b>���</b> ��� �� ���� ����� <b>������ ���</b> ������� �������!)';
$strPrintView = '��� ���� �������';
$strPrivileges = '����������';
$strProperties = '�����';

$strQBE = '������� ������ ����';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = '�� ����� �������� SQL-������� <b>%s</b>:';

$strRecords = '���������';
$strReferentialIntegrity = '����� referential integrity:';
$strReloadFailed = ' ����� ����� �����MySQL.';
$strReloadMySQL = '����� ����� MySQL';
$strRememberReload = '����� ������ ����� ������.';
$strRenameTable = '����� ��� ���� ���';
$strRenameTableOK = '�� ����� ����� ��� %s  ����%s';
$strRepairTable = '����� ������';
$strReplace = '�������';
$strReplaceTable = '������� ������ ������ ������';
$strReset = '�����';
$strReType = '��� �����';
$strRevoke = '�����';
$strRevokeGrant = '����� Grant';
$strRevokeGrantMessage = '��� ����� ������ Grant �� %s';
$strRevokeMessage = '��� ����� ���������� �� %s';
$strRevokePriv = '����� ��������';
$strRowLength = '��� ����';
$strRows = '����';
$strRowsFrom = '���� ���� ��';
$strRowSize = ' ���� ���� ';
$strRowsModeHorizontal = '����';
$strRowsModeOptions = ' %s � ����� ������ ��� %s ���';
$strRowsModeVertical = '�����';
$strRowsStatistic = '��������';
$strRunning = ' ��� ������ %s';
$strRunQuery = '����� ���������';
$strRunSQLQuery = '����� �������/��������� SQL ��� ����� ������ %s';

$strSave = '�����';
$strSelect = '������';
$strSelectADb = '���� ����� ������ �� �������';
$strSelectAll = '����� ����';
$strSelectFields = '������ ���� (��� ����� ����):';
$strSelectNumRows = '�� ���������';
$strSend = '��� ����';
$strServerChoice = '������ ������';
$strServerVersion = '������ ������';
$strSetEnumVal = '��� ��� ��� ����� �� "enum" �� "set", ������ ����� ����� �������� ��� �������: \'a\',\'b\',\'c\'...<br />��� ��� ����� ��� ��� ����� ������ ������� ������ ("\") �� ����� �������� ������� ("\'") ���� ��� ��� �����, ������ ����� ����� ������ (����� \'\\\\xyz\' �� \'a\\\'b\').';
$strShow = '���';
$strShowAll = '���� ����';
$strShowCols = '���� �������';
$strShowingRecords = '������ ������� ';
$strShowPHPInfo = '��� ��������� �������� �  PHP';
$strShowTables = '���� ������';
$strShowThisQuery = ' ��� ��� ��������� ��� ��� ���� ';
$strSingly = '(����)';
$strSize = '�����';
$strSort = '�����';
$strSpaceUsage = '������� ��������';
$strSQLQuery = '�������-SQL';
$strStatement = '�����';
$strStrucCSV = '������ CSV';
$strStrucData = '������ ���������';
$strStrucDrop = ' ����� \'��� ���� ��� ��� ������\' �� �������';
$strStrucExcelCSV = '������ CSV �������  Ms Excel';
$strStrucOnly = '������ ���';
$strSubmit = '�����';
$strSuccess = '����� �� �� ������ ����� SQL-�������';
$strSum = '�������';

$strTable = '������ ';
$strTableComments = '������� ��� ������';
$strTableEmpty = '��� ������ ����!';
$strTableHasBeenDropped = '���� %s �����';
$strTableHasBeenEmptied = '���� %s ������ ���������';
$strTableHasBeenFlushed = '��� �� ����� ����� ������ %s  �����';
$strTableMaintenance = '����� ������';
$strTables = '%s  ���� (�����)';
$strTableStructure = '���� ������';
$strTableType = '��� ������';
$strTextAreaLength = ' ���� ����,<br /> ��� ������� �� ��� ����� ��� ���� ������� ';
$strTheContent = '��� �� ����� ������� ����.';
$strTheContents = '��� �� ������� ������� ������ ������ ������ �������� ������ �� ������� ������� ���� �������� �����.';
$strTheTerminator = '���� ������.';
$strTotal = '�������';
$strType = '�����';

$strUncheckAll = '����� ����� ����';
$strUnique = '����';
$strUnselectAll = '����� ����� ����';
$strUpdatePrivMessage = '��� ���� ����� ���������� �� %s.';
$strUpdateProfile = '����� ����� �������:';
$strUpdateProfileMessage = '��� �� ����� ����� �������.';
$strUpdateQuery = '����� �������';
$strUsage = '�������';
$strUseBackquotes = '����� ����� ������� � ������ � "`" ';
$strUser = '��������';
$strUserEmpty = '��� �������� ����!';
$strUserName = '��� ��������';
$strUsers = '����������';
$strUseTables = '������ ������';

$strValue = '������';
$strViewDump = '��� ���� ������ ';
$strViewDumpDB = '��� ���� ����� ��������';

$strWelcome = '����� �� �� %s';
$strWithChecked = ': ��� ������';
$strWrongUser = '��� ��� ��������/���� ����. ������ �����.';

$strYes = '���';

$strZip = '"zipped" "�����"';

// To translate
$strCardinality = 'Cardinality';
$strLinksTo = 'Links to';  //to translate
$strExport = 'Export';  //to translate
$strOperations = 'Operations';  //to translate
$strExportToXML = 'Export to XML format'; //to translate
$strOptions = 'Options';  //to translate
$strStructure = 'Structure';  //to translate
$strRelationView = 'Relation view';  //to translate
$strDumpXRows = 'Dump %s rows starting at row %s.'; //to translate
$strSQL = 'SQL'; //to translate
$strLinkNotFound = 'Link not found';  //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
$strPageNumber = 'Page number:';  //to translate
$strShowGrid = 'Show grid';  //to translate
$strShowColor = 'Show color';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strPdfInvalidPageNum = 'Undefined PDF page number!';  //to translate
$strPdfInvalidTblName = 'The "%s" table does not exist!';  //to translate
$strChangeDisplay = 'Choose Field to display';  //to translate
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';//to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate
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
$strSplitWordsWithSpace = 'Words are splitted by a space character (" ").';//to translate
$strStructPropose = 'Propose table structure';  //to translate
$strExplain = 'Explain SQL Code';  //to translate
$strPhp = 'Create PHP Code';  //to translate
$strNoPhp = 'without PHP Code';  //to translate
$strPdfDbSchema = 'Schema of the the "%s" database - Page %s';  //to translate
$strGenBy = 'Generated by'; //to translate
$strSQLResult = 'SQL result'; //to translate
$strEditPDFPages = 'Edit PDF Pages';  //to translate
$strNoDescription = 'no Description';  //to translate
$strRelationNotSet = 'Relationtable not found or not set in config.inc.php3';  //to translate
$strInfoNotSet = 'table_info table not found or not set in config.inc.php3';  //to translate
$strCoordsNotSet = 'table_coords table not found or not set in config.inc.php3';  //to translate
$strChoosePage = 'Please choose a Page to edit';  //to translate
$strCreatePage = 'Create a new Page';  //to translate
$strSelectTables = 'Select Tables';  //to translate
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br />This might happen if php finds a parse error in it or php cannot find the file.<br />Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br />If you recieve a blank page, everything is fine.'; //to translate
$strNotSet = '<b>%s</b> table not found or not set in config.inc.php(3)';  //to translate
?>
