<?php

/* $Id$ */
/* Translated by: Yuval "Etus" Sarna */

$charset = 'iso-8859-8-i';
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('�����', '���', '�����', '�����', '�����', '����', '���');
$month = array('�����', '������', '���', '�����', '���', '����', '����', '������', '������', '�������', '������', '�����');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = '����� �����';
$strAction = '�����';
$strAddDeleteColumn = '����/��� ����� ���';
$strAddDeleteRow = '����/��� ���� ��������';
$strAddNewField = '���� ��� ���';
$strAddPriv = '���� ����� ����';
$strAddPrivMessage = '����� ����� ����.';
$strAddSearchConditions = '���� ���� ����� (���� �� "where"):';
$strAddToIndex = '���� ������� &nbsp;%s&nbsp;����/�����';
$strAddUser = '���� ����� ���';
$strAddUserMessage = '����� ����� ���.';
$strAffectedRows = '����� �������:';
$strAfter = '���� %s';
$strAfterInsertBack = '���� ����� �����';
$strAfterInsertNewInsert = '���� ���� ���� �����';
$strAll = '���';
$strAlterOrderBy = '��� �� ��� ����� ��-���';
$strAnalyzeTable = '��� ����';
$strAnd = '���';
$strAnIndex = '������ ������ �- %s';
$strAnyColumn = '�� �����';
$strAnyDatabase = '�� ��� ������';
$strAny = '��';
$strAnyHost = '�� ����';
$strAnyTable = '�� ����';
$strAnyUser = '�� �����';
$strAPrimaryKey = '���� ���� ������ �- %s';
$strAscending = '����';
$strAtBeginningOfTable = '������ ����';
$strAtEndOfTable = '���� ����';
$strAttr = '������';

$strBack = '����';
$strBinary = '������';
$strBinaryDoNotEdit = '������ - �� �����';
$strBookmarkDeleted = '�- Bookmark ����.';
$strBookmarkLabel = '�����';
$strBookmarkQuery = '����� �- SQL ������� �- Bookmark';
$strBookmarkThis = '���� �- Bookmark �� ����� �- SQL ���';
$strBookmarkView = '������ ����';
$strBrowse = '����';
$strBzip = '"BZipped"';

$strCantLoadMySQL = '�� ���� ����� �� ����� �- MySQL,<br />����� ���� �� ����������� �- PHP.';
$strCantRenameIdxToPrimary = '�� ���� ����� �� ������� ������ !';
$strCardinality = 'Cardinality';
$strCarriage = '�� ����� ����: \\r';
$strChangeDisplay = '��� ��� �����';
$strChangePassword = '��� �����';
$strChange = '���';
$strCheckAll = '��� ���';
$strCheckDbPriv = '���� �� ������ ��� �������';
$strCheckTable = '���� ����';
$strChoosePage = '��� ��� ���� ������';
$strColumnNames = '���� ������';
$strColumn = '�����';
$strComments = '�����';
$strCompleteInserts = '���� ������';
$strConfigFileError = 'phpMyAdmin �� ����� ����� �� ���� ������������ ���! ��� �� ���� �� PHP ���� ���� ���� ����� �� �� ��� �� ���� �� �����.<br> ��� ��� ����� ������������ ������ ����� ������ ���� ������ �� ���� �� ����� PHP ����� ����. ���� ������ ��� �� �����-���� ����� ����� �����.<br> �� ���� ���� �� ���, ��� ����.';
$strConfirm = '��� ���� ���� ����� �� ��?';
$strCookiesRequired = '������ ������ ����� ����� ������ ���� ����� ��.';
$strCopyTable = '���� ���� �- (��� ������<b>.</b>����):';
$strCopyTableOK = '����� %s ������ �- %s.';
$strCreateIndex = '��� ����� �-&nbsp;%s&nbsp;�����';
$strCreateIndexTopic = '��� ����� ���';
$strCreateNewDatabase = '��� ��� ������ ���';
$strCreateNewTable = '��� ���� ���� �� ��� ������� %s';
$strCreate = '���';
$strCreatePage = '��� ���� ���';
$strCriteria = '��������';

$strDatabaseHasBeenDropped = '��� ������� %s ����.';
$strDatabase = '��� ������ ';
$strDatabases = '���� �������';
$strDatabasesStats = '��������� ��� �������';
$strDatabaseWildcard = '��� ������ (����� ������ ������):';
$strData = '����';
$strDataOnly = '���� ����';
$strDefault = '����� ����';
$strDeleted = '����� �����';
$strDeletedRows = '����� ������:';
$strDeleteFailed = '����� ����� !';
$strDelete = '���';
$strDeleteUserMessage = '���� �� ������ %s.';
$strDescending = '����';
$strDisplay = '���';
$strDisplayOrder = '��� ����:';
$strDisplayPDF = '��� ���� ������ PDF';
$strDoAQuery = '��� "������ ������" (�� ����: "%")';
$strDocu = '�����';
$strDoYouReally = '��� ��� ���� ���� ���� ';
$strDrop = '���';
$strDropDB = '��� ��� ������ %s';
$strDropTable = '��� ����';
$strDumpingData = '���� ���� �����';
$strDynamic = '������';

$strEdit = '����';
$strEditPDFPages = '���� ��� PDF';
$strEditPrivileges = '���� ������';
$strEffective = '�������';
$strEmpty = '����';
$strEmptyResultSet = 'MySQL ����� 0 ������ �� ��� �������(�����, 0 �����).';
$strEnd = '���';
$strEnglishPrivileges = ' ����: ������ MySQL ������ ������� ';
$strError = '����';
$strExport = '����';
$strExportToXML = '���� ������ XML';
$strExtendedInserts = '������ �������';
$strExtra = '����';

$strFieldHasBeenDropped = '���� %s ����';
$strFieldsEmpty = ' ����� ����� ���� ! ';
$strFieldsEnclosedBy = '��� ���� ��';
$strFieldsEscapedBy = '���� ���� ��';
$strFieldsTerminatedBy = '���� ���� ��';
$strFields = '����';
$strField = '���';
$strFixed = '����';
$strFlushTable = '���� �� ��� ������� ("����")';
$strFormat = '�����';
$strFormEmpty = '��� ���� �� ����� !';
$strFullText = '���� ���';
$strFunction = '��������';

$strGenBy = '���� ��-���';
$strGenTime = '��� �����';
$strGo = '���';
$strGrants = '������';
$strGzip = '"GZipped"';

$strHasBeenAltered = '����.';
$strHasBeenCreated = '����.';
$strHome = '���� ����';
$strHomepageOfficial = '��� phpMyAdmin �����';
$strHomepageSourceforge = '���� ������� �� phpMyAdmin ���� Sourceforge';
$strHostEmpty = '���� ����� ��� !';
$strHost = '����';

$strIdxFulltext = '���� ���';
$strIfYouWish = '�� ������ ����� �� ��� �� ������ �����, ���� ���� ������ ��� ����� �����.';
$strIgnore = '�����';
$strIndex = '������';
$strIndexes = '��������';
$strIndexHasBeenDropped = '������ %s ����';
$strIndexName = '�� �������&nbsp;:';
$strIndexType = '��� �������&nbsp;:';
$strInsert = '����';
$strInsertAsNewRow = '����� ����� ����';
$strInsertedRows = '����� �������:';
$strInsertNewRow = '���� ���� ����';
$strInsertTextfiles = '���� ���� ���� ���� ���� �����';
$strInstructions = '������';
$strInUse = '������';
$strInvalidName = '"%s" ��� ���� �����, ���� ���� ������ �� ���� ������/����/���.';

$strKeepPass = '�� ���� �� ������';
$strKeyname = '�� ����';
$strKill = '���';

$strLength = '����';
$strLengthSet = '����/�����*';
$strLimitNumRows = '���� ������ ��� ��';
$strLineFeed = '���� ����: \\n';
$strLinesTerminatedBy = '����� ������ ��-���';
$strLines = '�����';
$strLinkNotFound = '����� �� ����';
$strLinksTo = '������� �-';
$strLocationTextfile = '����� ���� �����';
$strLogin = '����';
$strLogout = '�����';
$strLogPassword = '�����:';
$strLogUsername = '�� �����:';

$strMissingBracket = '������ �����';
$strModifications = '�������� �����';
$strModifyIndexTopic = '��� ������';
$strModify = '���';
$strMoveTable = '���� ���� �- (��� ������<b>.</b>����):';
$strMoveTableOK = '����� %s ������ �- %s.';
$strMySQLReloaded = 'MySQL ���� ����.';
$strMySQLSaid = 'MySQL ���: ';
$strMySQLServerProcess = 'MySQL %pma_s1% �� �� %pma_s2% �- %pma_s3%';
$strMySQLShowProcess = '���� �������';
$strMySQLShowStatus = '���� �� ���� ����� �� MySQL';
$strMySQLShowVars = '���� �� ����� ������ �� MySQL';

$strName = '��';
$strNext = '���';
$strNoDatabases = '��� ���� ������';
$strNoDescription = '��� �����';
$strNoDropDatabases = '������ "DROP DATABASE" ������.';
$strNoFrames = 'phpMyAdmin ��� ���� ������� �� ����� <b>����� ��������</b>.';
$strNo = '��';
$strNoIndex = '������ �� ����� !';
$strNoIndexPartsDefined = '��� ���� ������ ������� !';
$strNoModification = '��� �����';
$strNone = 'NULL';
$strNoPassword = '��� �����';
$strNoPhp = '��� ��� PHP';
$strNoPrivileges = '��� ������';
$strNoQuery = '��� ������ SQL !';
$strNoRights = '��� �� ����� ������ ��� ����� ��� ����� !';
$strNoTablesFound = '������ �� ����� ���� �������.';
$strNotNumber = '��� �� ���� !';
$strNotSet = '����� <b>%s</b> �� ����� �- %s';
$strNotValidNumber = ' ��� �� ���� ���� �� ���� !';
$strNoUsersFound = '�� �����/������� �����.';
$strNull = 'NULL';
$strNumSearchResultsInTable = '%s �����/������ ���� ����� <i>%s</i>';

$strOftenQuotation = '������ ������. ���� ������ ������ ��� ���� char �- varchar ������ �� ��� ������.';
$strOperations = '������';
$strOptimizeTable = '���� ����';
$strOptionalControls = '������. ���� �� ����� ������ �� ������ �������.';
$strOptionally = '���� ������';
$strOptions = '��������';
$strOr = '��';
$strOverhead = '�����';

$strPageNumber = '���� ����:';
$strPartialText = '������ ������';
$strPasswordEmpty = '������ ���� !';
$strPassword = '�����';
$strPasswordNotSame = '�������� ���� ���� !';
$strPdfDbSchema = '���� ��� ������� "%s" - ���� %s';
$strPdfInvalidPageNum = '���� ���� �� PDF �� �����!';
$strPdfInvalidTblName = '����� "%s" �� �����!';
$strPhp = '��� ��� PHP';
$strPHPVersion = '���� PHP';
$strPmaDocumentation = '���������� phpMyAdmin';
$strPmaUriError = '������ �- <tt>$cfg[\'PmaAbsoluteUri\']</tt> ����� ����� ������ ����� ������������ ���!';
$strPos1 = '����';
$strPrevious = '�����';
$strPrimaryKeyHasBeenDropped = '����� ����� ����';
$strPrimaryKey = '���� ����';
$strPrimaryKeyName = '��� �� ����� ����� ���� �����... ���� !';
$strPrimaryKeyWarning = '("���� ����" <b>����</b> ������� ��� �� ���� ���� !)';
$strPrimary = '����';
$strPrintView = '���� �����';
$strPrivileges = '������';
$strProperties = '��������';

$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQBE = '������ ������';
$strQueryOnDb = '������ SQL �� ��� ������� <b>%s</b>:';

$strRecords = '������';
$strReferentialIntegrity = '���� �� �- Referential Integrity:';
$strRelationView = '����� ���';
$strReloadFailed = '����� ���� �� MySQL �����.';
$strReloadMySQL = '��� ���� �� MySQL';
$strRememberReload = '���� ����� ���� �� ����.';
$strRenameTableOK = '�� ����� %s ����� �- %s';
$strRenameTable = '��� �� �� ����� �-';
$strRepairTable = '��� ����';
$strReplace = '����';
$strReplaceTable = '���� �� �� ����� �� ����';
$strReset = '���';
$strReType = '���� ����';
$strRevokeGrantMessage = '���� �� ����� �- Grant �- %s';
$strRevokeGrant = '����� �����';
$strRevokeMessage = ' ���� �� ������ �- %s';
$strRevoke = '����';
$strRevokePriv = '���� ������';
$strRowLength = '���� ����';
$strRowsFrom = '����� �������� �-';
$strRowSize = ' ���� ����� ';
$strRowsModeHorizontal = '�����';
$strRowsModeOptions = '���� %s ���� �� ������ ������� ���� %s ����';
$strRowsModeVertical = '�����';
$strRowsStatistic = '��������� �����';
$strRows = '�����';
$strRunning = '�� �� %s';
$strRunQuery = '��� ������';
$strRunSQLQuery = '��� �� ������/������� �� ��� ������� %s';

$strSave = '����';
$strSearch = '���';
$strSearchFormTitle = '��� ���� �������';
$strSearchInTables = '���� �����/�������:';
$strSearchOption1 = '����� ��� �� ������';
$strSearchOption2 = '�� ������';
$strSearchOption3 = '������ �������';
$strSearchOption4 = '������ ����';
$strSearchResultsFor = '������ ����� �- "<i>%s</i>" %s:';
$strSearchType = '���:';
$strSelect = '���';
$strSelectADb = '��� ����� ��� ������';
$strSelectAll = '��� ���';
$strSelectFields = '��� ���� (����� ���):';
$strSelectNumRows = '���� ������';
$strSelectTables = '��� ������';
$strSend = '���� �����';
$strServerChoice = '����� ���';
$strServerVersion = '���� ���';
$strSetEnumVal = '�� ��� ���� ��� enum �� set, ���� ����� ����� �������� ������ ���: \'a\',\'b\',\'c\'...<br />�� ���� �� ��� ���� \ �� ����� ��� ��� �� ������ ����, ���� \ �����.';
$strShowAll = '���� ���';
$strShow = '����';
$strShowColor = '��� ���';
$strShowCols = '���� �����';
$strShowingRecords = '���� �����';
$strShowPHPInfo = '���� ���� PHP';
$strShowTables = '���� ������';
$strShowThisQuery = ' ���� �� ������� ��� ���� ';
$strSingly = '(�����)';
$strSize = '����';
$strSort = '�����';
$strSpaceUsage = '��� ����';
$strSplitWordsWithSpace = '������ ������� �� ��� �� ���� (" ").';
$strSQLQuery = '������ SQL';
$strSQLResult = '������ SQL';
$strSQL = 'SQL';
$strStatement = '������';
$strStrucCSV = '���� CSV';
$strStrucData = '����� �����';
$strStrucDrop = '���� \'��� ����\'';
$strStrucExcelCSV = 'CVS ����� Ms Excel';
$strStrucOnly = '���� ����';
$strStructPropose = '��� ���� ����';
$strStructure = '�����';
$strSubmit = '���';
$strSuccess = '������ �- SQL ��� ����� ������';
$strSum = '�����';

$strTableComments = '����� ����';
$strTable = '���� ';
$strTableEmpty = '�� ����� ��� !';
$strTableHasBeenDropped = '����� %s �����';
$strTableHasBeenEmptied = 'Table %s �����';
$strTableHasBeenFlushed = 'Table %s ����� ������ �����';
$strTableMaintenance = '����� ����';
$strTables = '%s ����/������';
$strTableStructure = '���� ���� �����';
$strTableType = '��� ����';
$strTextAreaLength = ' ���� �����,<br /> ���� ���� �� �� ���� ������ ';
$strTheContent = '����� �� ���� �����.';
$strTheContents = '����� �� ����� ��� ����� �� ����� �� ����� ������ ������ �� ���� ���� �� ���� ����� ���.';
$strTheTerminator = '���� �� �����.';
$strTotal = '��-���';
$strType = '���';

$strUncheckAll = '��� ����� �� ���';
$strUnique = '�����';
$strUnselectAll = '��� ����� �� ���';
$strUpdatePrivMessage = '������ �� ������� �- %s.';
$strUpdateProfileMessage = '������� �����.';
$strUpdateProfile = '���� ������:';
$strUpdateQuery = '���� ������';
$strUsage = '�����';
$strUseBackquotes = '����� ������� ������� �� ������ ����� ����';
$strUserEmpty = '�� ������ ��� !';
$strUser = '�����';
$strUserName = '�� �����';
$strUsers = '�������';
$strUseTables = '����� �������';

$strValue = '���';
$strViewDump = '���� �� ���� �����';
$strViewDumpDB = '���� �� ���� ��� �������';

$strWelcome = '���� ��� �- %s';
$strWithChecked = '���� ��:';
$strWrongUser = '�� �����/����� ������. ����� �����.';

$strYes = '��';

$strZip = '"Zipped"';
//To translate:


$strAllTableSameWidth = 'display all Tables with same width?';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strCharsetOfFile = 'Character set of the file:'; //to translate
$strColComFeat = 'Displaying Column Comments';  //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate

$strDisabled = 'Disabled';  //to translate
$strDisplayFeat = 'Display Features';  //to translate
$strDumpXRows = 'Dump %s rows starting at row %s.'; //to translate

$strEnabled = 'Enabled';  //to translate
$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate
$strExplain = 'Explain SQL';  //to translate

$strGeneralRelationFeat = 'General relation features';  //to translate

$strHaveToShow = 'You have to choose at least one Column to display';  //to translate

$strMySQLCharset = 'MySQL Charset';  //to translate

$strNoExplain = 'Skip Explain SQL';  //to translate
$strNotOK = 'not OK';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate

$strPdfNoTables = 'No tables';  //to translate

$strRelationNotWorking = 'The additional Features for working with linked Tables have been deactivated. To find out why click %shere%s.';  //to translate

$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strShowGrid = 'Show grid'; //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate

$strValidateSQL = 'Validate SQL';  //to translate

?>
