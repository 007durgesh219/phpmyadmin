<?php
/* $Id$ */

$charset = 'windows-1251';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = '� ������� ��������';
$strAction = '��������';
$strAddDeleteColumn = '��������/������� ������� ��������';
$strAddDeleteRow = '��������/������� ��� ��������';
$strAddNewField = '�������� ����� ����';
$strAddPriv = '�������� ����� ����������';
$strAddPrivMessage = '���� ��������� ����� ����������';
$strAddSearchConditions = '�������� ������� ������ (���� ��� "where" �������):';
$strAddUser = '�������� ������ ������������';
$strAddUserMessage = '���� �������� ����� ������������.';
$strAfter = '�����';
$strAll = '���';
$strAlterOrderBy = '�������� ������� �������';
$strAnalyzeTable = '������ �������';
$strAnd = '�';
$strAny = '�����';
$strAnyColumn = '����� �������';
$strAnyDatabase = '����� ���� ������';
$strAnyHost = '����� ����';
$strAnyTable = '����� �������';
$strAnyUser = '����� ������������';
$strAscending = '����������';
$strAtBeginningOfTable = '� ������ �������';
$strAtEndOfTable = '� ����� �������';
$strAttr = '��������';

$strBack = '�����';
$strBinary = ' �������� ';
$strBinaryDoNotEdit = ' �������� ������ - �� ������������� ';
$strBookmarkLabel = '�����';
$strBookmarkQuery = '�������� �� SQL-������';
$strBookmarkThis = '�������� �� ������ SQL-������';
$strBookmarkView = '������ ��������';
$strBrowse = '����������';

$strCantLoadMySQL = '���������� MySQL �� ����������,<br />��������� ������������ PHP.';
$strCarriage = '������� �������: \\r';
$strChange = '��������';
$strCheckAll = '��������� ���';
$strCheckDbPriv = '��������� ���������� ���� ������';
$strCheckTable = '��������� �������';
$strColumn = '�������';
$strColumnEmpty = '�������� ������� �����!';
$strColumnNames = '�������� �������';
$strCompleteInserts = '������ �������';
$strConfirm = '�� ������������� ������ ������� ���?';
$strCopyTable = '����������� ������� �';
$strCopyTableOK = '������� %s ���� ����������� � %s.';
$strCreate = '�������';
$strCreateNewDatabase = '������� ����� ��';
$strCreateNewTable = '������� ����� ������� � �� ';
$strCriteria = '��������';

$strData = '������';
$strDatabase = '�� ';
$strDatabases = '���� ������';
$strDataOnly = '������ ������';
$strDbEmpty = '������ �������� ���� ������!';
$strDefault = '�� ���������';
$strDelete = '�������';
$strDeleted = '��� ��� ������';
$strDeleteFailed = '��������� ��������!';
$strDeletePassword = '������� ������';
$strDeleteUserMessage = '��� ������ ������������';
$strDelPassMessage = '��� ������ ������ ���';
$strDescending = '����������';
$strDisableMagicQuotes = '<b>�������:</b> � ������������ PHP ���� ��������� magic_quotes_gpc. ��� ������ PhpMyAdmin �� ������������ ������ ����������� . ���������� ������ ������������ � ����������� �� PHP, ��� ���������� �� ���������� ������ �����������.';
$strDisplay = '��������';
$strDisplayOrder = '������� ���������:';
$strDoAQuery = '��������� "������ �� �������" (������ ������������: "%")';
$strDocu = '������������';
$strDoYouReally = '�� ������������� ������� ';
$strDrop = '����������';
$strDropDB = '���������� �� ';
$strDumpingData = '�������� ������ �������';
$strDynamic = '�����������';

$strEdit = '�������������';
$strEditPrivileges = '�������������� ����������';
$strEffective = '�������������';
$strEmpty = '�������';
$strEmptyResultSet = 'MySQL ������� ������ ��������� (�.�. ���� �����).';
$strEnableMagicQuotes = '<b>�������:</b> � ������������ PHP �� ���� ��������� magic_quotes_gpc. ��� ������ PhpMyAdmin ���������� ������ �����������. ���������� ������ ������������ � ����������� �� PHP, ��� ���������� �� ��������� ������ �����������.';
$strEnclosedBy = '����������� �';
$strEnd = '�����';
$strEnglishPrivileges = ' Note: ���������� MySQL ���������� �������� �� ��������� ';
$strError = '������';
$strEscapedBy = '����������� �����';
$strExtra = '�������������';

$strField = '����';
$strFields = '����';
$strFieldsEmpty = ' ������ ������� �����! ';
$strFixed = '������������';
$strFormat = '������';
$strFormEmpty = '��������� �������� ��� �����!';
$strFunction = '�������';

$strGenTime = '����� ���������';
$strGo = '�����';
$strGrants = '�������������� ����';

$strHasBeenAltered = '���� ��������.';
$strHasBeenCreated = '���� �������.';
$strHasBeenDropped = '���� ����������.';
$strHasBeenEmptied = '���� ����������.';
$strHome = '� ������';
$strHomepageOfficial = '����������� �������� phpMyAdmin';
$strHomepageSourceforge = '�������� phpMyAdmin �� Sourceforge';
$strHost = '����';
$strHostEmpty = '������ ��� �����!';

$strIfYouWish = '���� �� ������� ��������� ������ ��������� ������� �������, ������� ����������� �������� ������ �����.';
$strIndex = '������';
$strIndexes = '������������';
$strInsert = '��������';
$strInsertAsNewRow = '�������� ����� ���';
$strInsertIntoTable = '�������� � �������';
$strInsertNewRow = '�������� ����� ���';
$strInsertTextfiles = '�������� ��������� ����� � �������';
$strInUse = '������������';

$strKeyname = '��� �����';
$strKill = '�����';

$strLength = '������';
$strLimitNumRows = '������� �� ��������';
$strLineFeed = '������ ��������� �����: \\n';
$strLines = '�����';
$strLocationTextfile = '����������������� ���������� �����';
$strLogin = ''; // To translate, but its not in use ...
$strLogout = '����� �� �������';

$strModifications = '����������� ���� ���������';
$strModify = '��������';
$strMySQLReloaded = 'MySQL �������������.';
$strMySQLSaid = 'MySQL �������: ';
$strMySQLShowProcess = '�������� ��������';
$strMySQLShowStatus = '�������� ��������� MySQL';
$strMySQLShowVars = '�������� ��������� ���������� MySQL';

$strName = '���';
$strNbRecords = '����� �������';
$strNext = '���������';
$strNo = '���';
$strNoPassword = '��� ������';
$strNoPrivileges = '��� ����������';
$strNoRights = '�� �� ������ ���������� ���� ��� �����!';
$strNoTablesFound = '� �� �� ���������� ������.';
$strNotNumber = '��� �� �����!';
$strNotValidNumber = ' ������������ ���������� �����!';
$strNoUsersFound = '�� ������ ������������.';
$strNull = '����';
$strNumberIndexes = ' ���������� ����������� �������� ';

$strOftenQuotation = '������ �������. �� ������ ��������, ��� ������ ���� char � varchar ����������� � �������.';
$strOptimizeTable = '�������������� �������';
$strOptionalControls = '�� ������. ������������ ��� ������ ��� ������ ����������� �������.';
$strOptionally = '�� ������';
$strOr = '���';
$strOverhead = '�������';

$strPassword = '������';
$strPasswordEmpty = '������ ������!';
$strPasswordNotSame = '������ �� ���������!';
$strPHPVersion = '������ PHP';
$strPos1 = '������';
$strPrevious = '����������';
$strPrimary = '���������';
$strPrimaryKey = '��������� ����';
$strPrinterFriendly = '������ ��� ������ ���� �������';
$strPrintView = '������ ��� ������';
$strPrivileges = '����������';
$strProducedAnError = '������� � ������.';
$strProperties = '��������';

$strQBE = '������ �� �������';
$strQBEDel = 'Del';  // To translate (used in tbl_qbe.php)
$strQBEIns = 'Ins';  // To translate (used in tbl_qbe.php)
$strQueryOnDb = 'SQL-������ �� ';

$strReadTheDocs = '�������� ������������';
$strRecords = '������';
$strReloadFailed = '�� ������� ������������� MySQL.';
$strReloadMySQL = '������������� MySQL';
$strRememberReload = '�� �������� ������������� ������.';
$strRenameTable = '������������� ������� �';
$strRenameTableOK = '������� %s ���� ������������� � %s';
$strRepairTable = '�������� �������';
$strReplace = '���������';
$strReplaceTable = '��������� ������ ������� ������� �� �����';
$strReset = '��������������';
$strReType = '��������� ����';
$strRevoke = '��������';
$strRevokeGrant = '�������� �������������� ����';
$strRevokeGrantMessage = '���� �������� �������������� ���� ���';
$strRevokeMessage = 'You have revoked the privileges for'; // To translate
$strRevokePriv = '�������� ����������';
$strRowLength = '����� ����';
$strRows = '����';
$strRowsFrom = '���� ������������ �';
$strRowSize = ' ������ ���� ';
$strRowsStatistic = '���������� ����';
$strRunning = '�������� �� ';
$strRunQuery = '��������� ������';

$strSave = '���������';
$strSelect = '�������';
$strSelectFields = '������� ���� (������� ����):';
$strSelectNumRows = '�� �������';
$strSend = '�������';
$strSequence = 'Seq.'; // To translate
$strServerVersion = '������ �������';
$strShow = '��������';
$strShowingRecords = '���������� ������ ';
$strShowThisQuery = ' �������� ������ ������ ����� ';
$strSingly = '(��������)';
$strSize = '������';
$strSort = '�������������';
$strSpaceUsage = '������������ ������������';
$strSQLQuery = 'SQL-������';
$strStatement = 'Statements'; // To translate
$strStrucCSV = 'CSV ������';
$strStrucData = '��������� � ������';
$strStrucDrop = '�������� \'������� �������\'';
$strStrucOnly = '������ ���������';
$strSubmit = '���������';
$strSuccess = '��� SQL-������ ��� ������� ��������';
$strSum = 'Sum'; // To translate

$strTable = '������� ';
$strTableComments = '��������� �������';
$strTableEmpty = '������ �������� �������!';
$strTableMaintenance = 'Table maintenance'; // To translate
$strTableStructure = '��������� ������� ��� �������';
$strTableType = '��� �������';
$strTerminatedBy = '����������� �����';
$strTextAreaLength = ' ��-�� ������� �����,<br /> ��� ���� �� ����� ���� ���������������� ';
$strTheContent = '���������� ����� ���� �������������.';
$strTheContents = '���������� ����� �������� ���������� ������� ��� ����� � ����������� ���������� ��� ����������� �������.';
$strTheTerminator = '������ ��������� �����.';
$strTotal = '�����';
$strType = '���';

$strUncheckAll = '������ �� ���������';
$strUnique = '����������';
$strUpdatePassMessage = '��� ������� ������ ���';
$strUpdatePassword = '�������� ������';
$strUpdatePrivMessage = '���� �������� ���������� ���';
$strUpdateQuery = '��������� ������';
$strUsage = '�������������';
$strUseBackquotes = '�������� ������� � ��������� ������ � �����';
$strUser = '������������';
$strUserEmpty = '������ ��� ������������!';
$strUserName = '��� ������������';
$strUsers = '������������';
$strUseTables = '������������ �������';

$strValue = '��������';
$strViewDump = '����������� ���� (�����) �������';
$strViewDumpDB = '����������� ���� (�����) ��';

$strWelcome = '����� ���������� � ';
$strWrongUser = '��������� �����/������. � ������� ��������.';

$strYes = '��';

// To translate
$strAffectedRows = 'Affected rows:';  // To translate
$strBzip = '"bzipped"';  // To translate
$strDatabasesStats = 'Databases statistics';//to translate
$strDeletedRows = 'Deleted rows:';
$strDropTable = 'Drop table';
$strExtendedInserts = 'Extended inserts';
$strFullText = 'Full Texts';//to translate
$strGzip = '"gzipped"';  // To translate
$strIdxFulltext = 'Fulltext';  //to translate 
$strInsertedRows = 'Inserted rows:';
$strInstructions = 'Instructions';//to translate
$strInvalidName = '"%s" is a reserved word, you can\'t use it as a database/table/field name.'; //to translate
$strLengthSet = 'Length/Values*'; // To translate
$strNoDatabases = 'No databases';
$strNoDropDatabases = '"DROP DATABASE" statements are disabled.';
$strNoModification = 'No change'; // To translate
$strPartialText = 'Partial Texts';//to translate
$strPmaDocumentation = 'phpMyAdmin Documentation';//to translate 
$strRunningAs = 'as';
$strServerChoice = 'Server Choice';//to translate 
$strSetEnumVal = 'If field type is "enum" or "set", please enter the values using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';
$strShowAll = 'Show all'; // to translate
$strShowCols = 'Show columns';
$strShowPHPInfo = 'Show PHP information';  // To translate
$strShowTables = 'Show tables';
$strStrucExcelCSV = 'CSV for Ms Excel data';
$strTables = '%s table(s)';  //to translate
$strWithChecked = 'With checked:';
$strAPrimaryKey = 'A primary key has been added on %s';//to translate
$strAnIndex = 'An index has been added on %s';//to translate
$strFieldHasBeenDropped = 'Field %s has been dropped';//to translate
$strFieldsEnclosedBy = 'Fields enclosed by';//to translate
$strFieldsEscapedBy = 'Fields escaped by';//to translate
$strFieldsTerminatedBy = 'Fields terminated by';//to translate
$strIndexHasBeenDropped = 'Index %s has been dropped';//to translate
$strLinesTerminatedBy = 'Lines terminated by';//to translate
$strPrimaryKeyHasBeenDropped = 'The primary key has been dropped';//to translate
$strRunSQLQuery = 'Run SQL query/queries on database %s';//to translate
$strStartingRecord = 'Starting record';//to translate
$strTableHasBeenDropped = 'Table %s has been dropped';//to translate
$strTableHasBeenEmptied = 'Table %s has been emptied';//to translate
$strUpdateServer = 'Update server';//to translate
$strUpdateServMessage = 'You have updated the server for %s';//to translate
?>
