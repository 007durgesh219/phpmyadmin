<?php
/* $Id$ */

$charset = 'windows-1256';
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'Tahoma, verdana, helvetica, arial, sans-serif';
$right_font_family = '"Windows UI", helvetica, arial, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('����', '��������', '��������', '��������');

$day_of_week = array('�����', '�������', '��������', '��������', '������', '������', '�����');
$month = array('�����', '������', '����', '�����', '����', '�����', '�����', '�����', '������', '������', '������', '������');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = '��� �����';
$strAction = '�����';
$strAddDeleteColumn = '�����/��� ���� ���';
$strAddDeleteRow = '�����/��� �� ���';
$strAddNewField = '����� ��� ����';
$strAddPriv = '����� ������ ����';
$strAddPrivMessage = '��� ���� ������ ����.';
$strAddSearchConditions = '��� ���� ����� (��� �� ������ "where" clause):';
$strAddUser = '��� ������ ����';
$strAddUserMessage = '��� ���� ������ ����.';
$strAffectedRows = '���� �����:';
$strAfter = '���';
$strAll = '����';
$strAlterOrderBy = '����� ����� ������ ��';
$strAnalyzeTable = '����� ������';
$strAnd = '�';
$strAny = '��';
$strAnyColumn = '�� ����';
$strAnyDatabase = '�� ����� ������';
$strAnyHost = '�� ������';
$strAnyTable = '�� ����';
$strAnyUser = '�� ������';
$strAscending = '��������';
$strAtBeginningOfTable = '�� ����� ������';
$strAtEndOfTable = '�� ����� ������';
$strAttr = '������';

$strBack = '����';
$strBinary = '�����';
$strBinaryDoNotEdit = '����� - �������';
$strBookmarkLabel = '�����';
$strBookmarkQuery = '����� ������ SQL-�������';
$strBookmarkThis = '���� ����� ������ SQL-�������';
$strBookmarkView = '��� ���';
$strBrowse = '�������';
$strBzip = '"bzipped"';

$strCantLoadMySQL = '������ ����� ������ MySQL,<br />������ ��� ������� PHP.';
$strCarriage = '����� �������: \\r';
$strChange = '�����';
$strCheckAll = '���� ����';
$strCheckDbPriv = '��� ������ ����� ��������';
$strCheckTable = '��� ������';
$strColumn = '����';
$strColumnNames = '��� ������';
$strCompleteInserts = '������� ��� �����';
$strConfirm = '�� ���� ���� �� ���� ��߿';
$strCopyTable = '��� ������ ���';
$strCopyTableOK = '������ %s ��� �� ���� ��� %s.';
$strCreate = '�����';
$strCreateNewDatabase = '����� ����� ������ �����';
$strCreateNewTable = '����� ���� ���� �� ����� �������� ';
$strCriteria = '��������';

$strData = '������';
$strDatabase = '����� �������� ';
$strDatabases = '����� ������';
$strDatabasesStats = '�������� ����� ������';
$strDataOnly = '������ ���';
$strDefault = '�������';
$strDelete = '���';
$strDeleted = '��� �� ��� ����';
$strDeletedRows = '������ ��������:';
$strDeleteFailed = '����� ����!';
$strDescending = '��������';
$strDisplay = '���';
$strDisplayOrder = '����� �����:';
$strDoAQuery = '���� "������� ������ ������" (wildcard: "%")';
$strDocu = '������� �������';
$strDoYouReally = '�� ���� ���� �� ';
$strDrop = '���';
$strDropDB = '��� ����� ������ ';
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

$strField = '���';
$strFields = '����';
$strFieldsEmpty = ' ����� ����� ����! ';
$strFixed = '����';
$strFormat = '����';
$strFormEmpty = '���� ���� ������ �������� !';
$strFullText = '���� �����';
$strFunction = '����';

$strGenTime = '����� �������';
$strGo = '����';
$strGrants = 'Grants';
$strGzip = '"gzipped"';

$strHasBeenAltered = '��� �����.';
$strHasBeenCreated = '��� ����.';
$strHome = '��������';
$strHomepageOfficial = '������ �������� ������� �� phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin ���� �������';
$strHost = '��������';
$strHostEmpty = '��� �������� ����!';

$strIfYouWish = '��� ��� ���� �� �� ���� ��� ����� ������ ���, ��� �������� ���� ���� ����� �����.';
$strIndex = '�����';
$strIndexes = '�����';
$strInsert = '�����';
$strInsertAsNewRow = '����� ��� ����';
$strInsertedRows = '���� �����:';
$strInsertNewRow = '����� �� ����';
$strInsertTextfiles = '����� ��� ��� �� ������';
$strInstructions = '�������';
$strInUse = '��� ���������';

$strKeyname = '��� �������';
$strKill = '�����';

$strLength = '�����';
$strLengthSet = '�����/������*';
$strLineFeed = '���� �����: \\n';
$strLines = '����';
$strLocationTextfile = '���� ��� ������';
$strLogin = ''; //to translate, but its not in use ...
$strLogout = '����� ����';

$strModifications = '��� ���������';
$strModify = '�����';
$strMySQLReloaded = 'MySQL ���� ������.';
$strMySQLSaid = 'MySQL ���: ';
$strMySQLShowProcess = '��� ������';
$strMySQLShowStatus = '��� MySQL runtime ��������';
$strMySQLShowVars = '��� MySQL ���������';

$strName = '�����';
$strNbRecords = '��� �������';
$strNext = '������';
$strNo = '��';
$strNoDatabases = '������ ����� ������';
$strNoDropDatabases = '���� "��� ����� ������"����� ';
$strNoModification = '�� �������';
$strNoPassword = '�� ���� ��';
$strNoPrivileges = '������ ��� �����';
$strNoRights = '��� ���� ������ ������� ��� ���� ��� ����!';
$strNoTablesFound = '������ ����� ������ �� ����� �������� ���!.';
$strNotNumber = '��� ��� ���!';
$strNotValidNumber = ' ��� ��� ��� �� ����!';
$strNoUsersFound = '�������(���) �� ��� �������.';
$strNull = '����';
$strNumberIndexes = ' ��� ������� �������� ';

$strOftenQuotation = '������ ������ ��������. ������� ���� ��� ������  char � varchar ���� �� " ".';
$strOptimizeTable = '���� ������';
$strOptionalControls = '�������. ������ �� ����� ����� �� ����� ������ �� ����� ������.';
$strOptionally = '�������';
$strOr = '��';
$strOverhead = '������';

$strPartialText = '���� �����';
$strPassword = '���� ����';
$strPasswordEmpty = '���� ���� �����!';
$strPasswordNotSame = '����� ���� ��� ���������!';
$strPHPVersion = 'PHP������ ';
$strPmaDocumentation = 'phpMyAdmin ������� ������� ��';
$strPos1 = '�����';
$strPrevious = '����';
$strPrimary = '�����';
$strPrimaryKey = '����� �����';
$strPrintView = '��� �������';
$strPrivileges = '����������';
$strProperties = '�����';

$strQBE = '������� ������ ����';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = '�� ����� �������� SQL-������� ';

$strRecords = '�������';
$strReloadFailed = ' ����� ����� �����MySQL.';
$strReloadMySQL = '����� ����� MySQL';
$strRememberReload = '����� ������ ����� ������.';
$strRenameTable = '����� ��� ���� ���';
$strRenameTableOK = '�� ����� ����� ��� %s  ����%s';
$strRepairTable = '����� ����';
$strReplace = '�������';
$strReplaceTable = '������� ������ ������ ������';
$strReset = '�����';
$strReType = '��� �����';
$strRevoke = '�����';
$strRevokeGrant = '����� Grant';
$strRevokePriv = '����� ��������';
$strRowLength = '��� ����';
$strRows = '����';
$strRowsFrom = '���� ���� ��';
$strRowSize = ' ���� ���� ';
$strRowsStatistic = '����� ����';
$strRunning = '���� ��� ';
$strRunQuery = '����� ���������';

$strSave = '���';
$strSelect = '������';
$strSelectFields = '������ ���� (��� ����� ����):';
$strSelectNumRows = '�� ���������';
$strSequence = '�����.';
$strServerChoice = '������ ������';
$strServerVersion = '������ ������';
$strSetEnumVal = '��� ��� ��� ����� �� "enum" �� "set", ������ ����� ����� �������� ��� �������: \'a\',\'b\',\'c\'...<br />��� ��� ����� ��� ��� ����� ������ ������� ������ ("\") �� ����� �������� ������� ("\'") ���� ��� ��� �����, ������ ����� ����� ������ (����� \'\\\\xyz\' �� \'a\\\'b\').';
$strShow = '���';
$strShowingRecords = '������ ������� ';
$strShowPHPInfo = '��� ������� PHP';
$strShowThisQuery = ' ��� ��� ��������� ��� ��� ���� ';
$strSingly = '(����)';
$strSize = '������';
$strSort = '�����';
$strSpaceUsage = '������� ��������';
$strSQLQuery = 'SQL-�������';
$strStatement = '�����';
$strStrucCSV = '������ CSV';
$strStrucData = '����� �������� ���������';
$strStrucDrop = '��� \'��� ����\'';
$strStrucExcelCSV = 'CSV ������ ����� Ms Excel';
$strStrucOnly = '����� �������� ���';
$strSubmit = '�����';
$strSuccess = '����� �� �� ������ ����� SQL-�������';
$strSum = '���';

$strTable = '������ ';
$strTableComments = '������� ������';
$strTableEmpty = '��� ������ ����!';
$strTableMaintenance = '����� ������';
$strTables = '%s ���� �� �����';
$strTableStructure = '����� �������� ������';
$strTableType = '��� ������';
$strTextAreaLength = ' ���� ����,<br /> ��� ������� �� ��� ����� ��� ���� ������� ';
$strTheContent = '��� �� ����� ������� ����.';
$strTheContents = '��� �� ������� ������� ������ ������ ������ �������� ������ �� ������� ������� ���� �������� �����.';
$strTheTerminator = '���� ������.';
$strTotal = '�������';
$strType = '�����';

$strUncheckAll = '����� ����� ����';
$strUnique = '����';
$strUpdateQuery = '����� �������';
$strUsage = '���������';
$strUseBackquotes = '������ ����� �������� ������� \' �������� ������ ������';
$strUser = '��������';
$strUserEmpty = '��� �������� ����!';
$strUserName = '��� ��������';
$strUsers = '���������';
$strUseTables = '������ ������';

$strValue = '������';
$strViewDump = '��� dump (����� ������� ��������) ������';
$strViewDumpDB = '��� dump (����� ������� ��������) ������ ������';

$strWrongUser = '��� ��� ��������/���� ����. ������ �����.';

$strYes = '���';


// To translate
$strAddToIndex = 'Add to index &nbsp;%s&nbsp;column(s)';
$strAfterInsertBack = 'Return';
$strAfterInsertNewInsert = 'Insert a new record';
$strAnIndex = 'An index has been added on %s';
$strAPrimaryKey = 'A primary key has been added on %s';
$strBookmarkDeleted = 'The bookmark has been deleted.';
$strCantRenameIdxToPrimary = 'Can\'t rename index to PRIMARY!';
$strCardinality = 'Cardinality';
$strCreateIndex = 'Create an index on&nbsp;%s&nbsp;columns';
$strCreateIndexTopic = 'Create a new index';
$strDatabaseHasBeenDropped = 'Database %s has been dropped.';
$strDeleteUserMessage = 'You have deleted the user %s.';
$strFieldHasBeenDropped = 'Field %s has been dropped';
$strFieldsEnclosedBy = 'Fields enclosed by';
$strFieldsEscapedBy = 'Fields escaped by';
$strFieldsTerminatedBy = 'Fields terminated by';
$strFlushTable = 'Flush the table ("FLUSH")';
$strIdxFulltext = 'Fulltext';
$strIgnore = 'Ignore';
$strIndexHasBeenDropped = 'Index %s has been dropped';
$strIndexName = 'Index name&nbsp;:';
$strIndexType = 'Index type&nbsp;:';
$strInvalidName = '"%s" is a reserved word, you can\'t use it as a database/table/field name.';
$strKeepPass = 'Do not change the password';
$strLimitNumRows = 'Number of records per page';
$strLinesTerminatedBy = 'Lines terminated by';
$strModifyIndexTopic = 'Modify an index';
$strMoveTable = 'Move table to (database<b>.</b>table):';
$strMoveTableOK = 'Table %s has been moved to %s.';
$strNoFrames = 'phpMyAdmin is more friendly with a <b>frames-capable</b> browser.';
$strNoIndex = 'No index defined!';
$strNoIndexPartsDefined = 'No index parts defined!';
$strNone = 'None';
$strNoQuery = 'No SQL query!';
$strPrimaryKeyHasBeenDropped = 'The primary key has been dropped';
$strPrimaryKeyName = 'The name of the primary key must be... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>must</b> be the name of and <b>only of</b> a primary key!)';
$strRevokeGrantMessage = 'You have revoked the Grant privilege for %s';
$strRevokeMessage = 'You have revoked the privileges for %s';
$strRunningAs = 'as';
$strRunSQLQuery = 'Run SQL query/queries on database %s';
$strSend = 'Save as file';
$strShowAll = 'Show all';
$strShowCols = 'Show columns';
$strShowTables = 'Show tables';
$strStartingRecord = 'Starting record';
$strTableHasBeenDropped = 'Table %s has been dropped';
$strTableHasBeenEmptied = 'Table %s has been emptied';
$strTableHasBeenFlushed = 'Table %s has been flushed';
$strUpdatePrivMessage = 'You have updated the privileges for %s.';
$strUpdateProfile = 'Update profile:';
$strUpdateProfileMessage = 'The profile has been updated.';
$strWelcome = 'Welcome to %s';
$strWithChecked = 'With selected:';
$strZip = '"zipped"';

?>
