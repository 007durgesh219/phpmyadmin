<?php
/* $Id$ */


/**
 * Translated on 2002/04/29 by: Arthit Suriyawongkul
 *                              Warit Wanasathian
 *
 * Revised on 2002/06/05 by: Arthit Suriyawongkul
 */


// note: Thai has 2 standard encodings (tis-620, iso-8859-11)
$charset = 'tis-620';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('亵�', '����亵�', '�����亵�', '�ԡ�亵�');

$day_of_week = array('��.', '�.', '�.', '�.', '��.', '�.', '�.');
$month = array('�.�.', '�.�.', '��.�.', '��.�.', '�.�.', '��.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y  %R�.';


$strAccessDenied = '���͹حҵ�����ҹ';
$strAction = '��зӡ��';
$strAddDeleteColumn = '����/ź ������� (��Ŵ�)';
$strAddDeleteRow = '����/ź ��';
$strAddNewField = '������Ŵ�����';
$strAddPriv = '�����Է��';
$strAddPrivMessage = '�����Է�����º��������';
$strAddSearchConditions = '�������͹�㹡�ä���:';
$strAddToIndex = '�����Ѫ�դ������ %s';
$strAddUser = '�������������';
$strAddUserMessage = '����������������º��������';
$strAffectedRows = '�Ƿ��١��з�:';
$strAfter = '��ѧ %s';
$strAfterInsertBack = '�觡�Ѻ';
$strAfterInsertNewInsert = '�á����¹����';
$strAll = '������';
$strAlterOrderBy = '���§���㹵��ҧ���';
$strAnalyzeTable = '����������ҧ';
$strAnd = '���';
$strAnIndex = '�������Ѫ������� %s';
$strAny = '��';
$strAnyColumn = '���������';
$strAnyDatabase = '�ҹ��������';
$strAnyHost = '��ʵ���';
$strAnyTable = '���ҧ��';
$strAnyUser = '�������';
$strAPrimaryKey = '������ primary key ����� %s';
$strAscending = '������ҡ';
$strAtBeginningOfTable = '���ش������鹢ͧ���ҧ';
$strAtEndOfTable = '���ش�ش���¢ͧ���ҧ';
$strAttr = '�͵��Ժ�ǵ�';

$strBack = '��͹��Ѻ';
$strBinary = ' ������亹��� ';
$strBinaryDoNotEdit = ' ������亹��� - ������� ';
$strBookmarkDeleted = 'ź�Ӥ鹷�訴������º��������';
$strBookmarkLabel = '���ª���';
$strBookmarkQuery = '�Ӥ鹹��١�����';
$strBookmarkThis = '���Ӥ鹹�����';
$strBookmarkView = '�����ҧ����';
$strBrowse = '�Դ��';
$strBzip = '"bzipped"';

$strCantLoadMySQL = '�������ö���¡�� MySQL extension,<br />��سҵ�Ǩ�ͺ��õ�駤�Ңͧ PHP';
$strCantRenameIdxToPrimary = '����¹���ʹѪ���� PRIMARY �����!';
$strCardinality = 'Cardinality';
$strCarriage = '�Ѵ���: \\r';
$strChange = '����¹';
$strChangeDisplay = '���͡��Ŵ����ͧ����ʴ�';
$strChangePassword = '����¹���ʼ�ҹ';
$strCheckAll = '���͡������';
$strCheckDbPriv = '��Ǩ�ͺ�Է��㹰ҹ������';
$strCheckTable = '��Ǩ�ͺ���ҧ';
$strColumn = '�������';
$strColumnNames = '���ͤ������';
$strCompleteInserts = '����� INSERT ����ٻẺ';
$strConfigureTableCoord = '��سҵ�駤��������๵�ͧ���ҧ %s';
$strConfirm = '�س�׹�ѹ���з���觹��?';
$strCookiesRequired = '��ͧ͹حҵ���� \'��ꡡ��\' ���¡�͹ �֧�м�ҹ�ش������';
$strCopyTable = '�Ѵ�͡���ҧ��ѧ (database<b>.</b>table):';
$strCopyTableOK =  '�Ѵ�͡���ҧ %s ���㹪��� %s ���º��������.';
$strCreate = '���ҧ';
$strCreateIndex = '���ҧ�Ѫ���¤������ %s';
$strCreateIndexTopic = '���ҧ�Ѫ������';
$strCreateNewDatabase = '���ҧ�ҹ����������';
$strCreateNewTable = '���ҧ���ҧ㹰ҹ�����Ź�� %s';
$strCriteria = '���͹�';

$strData = '������';
$strDatabase = '�ҹ������ ';
$strDatabaseHasBeenDropped = '�¹�ҹ������ %s �������º��������';
$strDatabases = '�ҹ������';
$strDatabasesStats = 'ʶԵ԰ҹ������';
$strDatabaseWildcard = '�ҹ������ (�� wildcards ��):';
$strDataOnly = '੾�Т�����';
$strDefault = '��һ�����';
$strDelete = 'ź';
$strDeleted = 'ź���º��������';
$strDeletedRows = '�Ƿ��١ź:';
$strDeleteFailed = 'ź��������!';
$strDeleteUserMessage = '�س��ź����� %s �����';
$strDescending = '�ҡ仹���';
$strDisplay = '�ʴ���';
$strDisplayPDF = '�ʴ� PDF schema';
$strDisplayOrder = '�ӴѺ����ʴ�:';
$strDoAQuery = '�� "�Ӥ鹨ҡ������ҧ" (wildcard: "%")';
$strDocu = '�͡�����ҧ�ԧ';
$strDoYouReally = '��ͧ��è� ';
$strDrop = '�¹���';
$strDropDB = '�¹�ҹ������ %s ���';
$strDropTable = '�¹���ҧ���';
$strDumpingData = 'dump ���ҧ';
$strDumpXRows = '������� %s �� ���������� %s';
$strDynamic = '��褧���';

$strEdit = '���';
$strEditPrivileges = '����Է��';
$strEffective = '�ռ�';
$strEmpty = 'ź������';
$strEmptyResultSet = 'MySQL �׹���Ѿ����ҧ���� (null) ��Ѻ�� (0 ��).';
$strEnd = '�����ش';
$strEnglishPrivileges = ' �ô��Һ: ���ͧ͢�Է��� MySQL ���ʴ��������ѧ��� ';
$strError = '�Դ��Ҵ';
$strExplain = '͸Ժ���� SQL';
$strExport = '���͡';
$strExportToXML = '���͡���ٻẺ XML';
$strExtendedInserts = '�á��������¹㹤�������';
$strExtra = '�������';

$strField = '��Ŵ�';
$strFieldHasBeenDropped = '�¹��Ŵ� %s �������º��������';
$strFields = '�ӹǹ��Ŵ�';
$strFieldsEmpty = ' �ӹǹ��Ŵ��� ��ҧ����! ';
$strFieldsEnclosedBy = '�������Ŵ����';
$strFieldsEscapedBy = '����ͧ��������Ѻ escape char';
$strFieldsTerminatedBy = '����Ŵ����';
$strFixed = '�����';
$strFlushTable = '��ҧ���ҧ ("FLUSH")';
$strFormat = '�ٻẺ';
$strFormEmpty = '����Ẻ��������� !';
$strFullText = '��駢�ͤ���';
$strFunction = '�ѧ����';

$strGenBy = '���ҧ��';
$strGenTime = '����㹡�����ҧ';
$strGo = 'ŧ���';
$strGrants = '͹حҵ';
$strGzip = '"gzipped"';

$strHasBeenAltered = '����¹��������';
$strHasBeenCreated = '���ҧ��������';
$strHome = '˹�Һ�ҹ';
$strHomepageOfficial = '���ྨ���ҧ�繷ҧ��âͧ phpMyAdmin';
$strHomepageSourceforge = '˹�Ҵ�ǹ���Ŵ phpMyAdmin ��� Sourceforge';
$strHost = '��ʵ�';
$strHostEmpty = '������ʵ��ѧ��ҧ����!';

$strIdxFulltext = 'Fulltext';
$strIfYouWish = '��ҵ�ͧ������¡��੾�кҧ������� ����к���ª��Ϳ�Ŵ��Ҵ��� (������Ъ��ʹ�������ͧ�����١���)';
$strIgnore = '���ʹ�';
$strIndex = '�Ѫ��';
$strIndexes = '�Ѫ��';
$strIndexHasBeenDropped = '�¹�Ѫ�� %s �������º��������';
$strIndexName = '���ʹѪ�� :';
$strIndexType = '��Դ�ͧ�Ѫ�� :';
$strInsert = '�á';
$strInsertAsNewRow = '�á��������';
$strInsertedRows = '�Ƿ��١�á:';
$strInsertNewRow = '�á������';
$strInsertTextfiles = '�á�����Ũҡ����ͤ�������㹵��ҧ';
$strInstructions = '�Ը���';
$strInUse = '������';
$strInvalidName = '"%s" �繤�ʧǹ �������駪��� �ҹ������/ ���ҧ/��Ŵ� �����';

$strKeepPass = '��س���������¹���ʼ�ҹ';
$strKeyname = '���ͤ���';
$strKill = '��ҷ��';

$strLength = '�������';
$strLengthSet = '�������/૵*';
$strLimitNumRows = '����¹���˹��';
$strLineFeed = '��鹺�÷Ѵ����: \\n';
$strLines = '��÷Ѵ';
$strLinesTerminatedBy = '���Ǵ���';
$strLinkNotFound = '��辺�ԧ��';
$strLinksTo = '�������ѧ';
$strLocationTextfile = '���͡����ͤ����ҡ';
$strLogin = '�������к�';
$strLogout = '�͡�ҡ�к�';
$strLogPassword = '���ʼ�ҹ:';
$strLogUsername = '���ͼ����:';

$strModifications = '�ѹ�֡���������º��������';
$strModify = '���';
$strModifyIndexTopic = '��䢴Ѫ��';
$strMoveTable = '���µ��ҧ� (database<b>.</b>table):';
$strMoveTableOK = '���ҧ %s �١����� %s ����';
$strMySQLReloaded = '���¡ MySQL �������������';
$strMySQLSaid = 'MySQL �ʴ�: ';
$strMySQLServerProcess = 'MySQL %pma_s1% �ӧҹ���躹 %pma_s2% 㹪��� %pma_s3%';
$strMySQLShowProcess = '�ʴ��ҹ��������ͧ MySQL';
$strMySQLShowStatus = '�ʴ�ʶҹТͧ MySQL';
$strMySQLShowVars = '�ʴ�������к��ͧ MySQL';

$strName = '����';
$strNext = '����';
$strNo = '���';
$strNoDatabases = '����հҹ������';
$strNoDropDatabases = '����� "DROP DATABASE" �١�Դ���';
$strNoFrames = '���������<b>�������</b> �Ъ�������� phpMyAdmin ����¢��';
$strNoIndex = '�ѧ������˹��Ѫ����!';
$strNoIndexPartsDefined = '������˹���ǹ�� �ͧ�Ѫ��!';
$strNoModification = '����ա������¹�ŧ';
$strNone = '�����';
$strNoPassword = '��������ʼ�ҹ';
$strNoPhp = '�������� PHP';
$strNoPrivileges = '������Է��';
$strNoQuery = '����դӤ� SQL!';
$strNoRights = '�س������Է�Է�������ҵç���!';
$strNoTablesFound = '��辺���ҧ� � 㹰ҹ������';
$strNotNumber = '��ҹ����������Ţ!';
$strNotValidNumber = ' ����������Ţ�Ƿ��١��ͧ!';
$strNoUsersFound = '��辺�������.';
$strNull = '��ҧ���� (null)';
$strNumSearchResultsInTable = '�� %s ���Ѿ����ç㹵��ҧ <i>%s</i>';
$strNumSearchResultsTotal = '<b>���:</b> <i>%s</i> ���Ѿ����ç';

$strOftenQuotation = '�»��Ԩ�������ͧ�����ѭ��С�� (����ͧ���¤Ӿٴ)<br />"��ҷ�����" ���¶֧����������ͧ���¤����੾�СѺ��Ŵ쪹Դ char ��� varchar ��ҹ��';
$strOperations = '��кǹ���';
$strOptimizeTable = '��Ѻ�觵��ҧ';
$strOptionalControls = '��˹���Ҩ���¹������ҹ����ѡ��о���� ���ҧ��';
$strOptionally = '��ҷ�����';
$strOptions = '������͡';
$strOr = '����';
$strOverhead = '�Թ��������';

$strPageNumber = '�����Ţ˹��:';
$strPartialText = '��ͤ����ҧ��ǹ';
$strPassword = '���ʼ�ҹ';
$strPasswordEmpty = '���ʼ�ҹ�ѧ��ҧ����!';
$strPasswordNotSame = '���ʼ�ҹ���ç�ѹ!';
$strPdfDbSchema = 'schema �ͧ�ҹ������ "%s" - ˹�� %s';
$strPdfInvalidPageNum = '�ѧ������˹��Ţ˹�Ңͧ PDF!';
$strPdfInvalidTblName = '����յ��ҧ "%s"!';
$strPhp = '���ҧ�� PHP';
$strPHPVersion = '��蹢ͧ PHP';
$strPmaDocumentation = '�͡��á���� phpMyAdmin';
$strPmaUriError = '<b>��ͧ</b>��˹���� <tt>$cfg[\'PmaAbsoluteUri\']</tt> ����͹�ԡ��ê�����¡�͹';
$strPos1 = '�ش�������';
$strPrevious = '��͹˹��';
$strPrimary = 'Primary';
$strPrimaryKey = 'Primary key';
$strPrimaryKeyHasBeenDropped = '�¹ primary key �������º ��������';
$strPrimaryKeyName = '���ͧ͢ primary key �е�ͧ��... PRIMARY!';
$strPrimaryKeyWarning = '(���ͧ͢ primary key <b>�е�ͧ�� </b>"PRIMARY" ��ҹ��!)';
$strPrintView = '�ʴ�';
$strPrivileges = '�Է��';
$strProperties = '�س���ѵ�';

$strQBE = '�Ӥ鹨ҡ������ҧ';
$strQBEDel = 'ź';
$strQBEIns = '����';
$strQueryOnDb = '�Ӥ鹺��ҹ������ <b>%s</b>:';

$strRecords = '����¹';
$strReferentialIntegrity = '��Ǩ�ͺ��������ó�ͧ�����ҧ�֧:';
$strRelationView = 'Relation view';
$strReloadFailed = '����Ŵ MySQL ������������';
$strReloadMySQL = '����Ŵ MySQL ����';
$strRememberReload = '�����������Ŵ��������������ա����'; // can be better translated
$strRenameTable = '����¹���͵��ҧ��';
$strRenameTableOK = '���ҧ %s ��١����¹������ %s';
$strRepairTable = '���������ҧ';
$strReplace = '��¹�Ѻ';
$strReplaceTable = '��¹�Ѻ���¢����Ũҡ���';
$strReset = '���������';
$strReType = '���������';
$strRevoke = '�ԡ�͹';
$strRevokeGrant = '�ԡ�͹���͹حҵ';
$strRevokeGrantMessage = '�س���ԡ�͹���͹حҵ�ͧ %s';
$strRevokeMessage = '�س���ԡ�͹�Է�Ԣͧ %s';
$strRevokePriv = '�ԡ�͹�Է��';
$strRowLength = '���������';
$strRows = '��';
$strRowsFrom = '�� ������ҡ�Ƿ��';
$strRowSize = ' ��Ҵ�� ';
$strRowsModeHorizontal = '�ǹ͹';
$strRowsModeOptions = '����� %s ��Ы������Ƿء� %s ����';
$strRowsModeVertical = '�ǵ��';
$strRowsStatistic = 'ʶԵԢͧ��';
$strRunning = '�ӧҹ����� %s';
$strRunQuery = '�觤Ӥ�';
$strRunSQLQuery = '�ӤӤ鹺��ҹ������ %s';

$strSave = '�ѹ�֡';
$strScaleFactorSmall = '�ѵ�Ң��¹����Թ价��ШѴ��� schema �����˹������';
$strSearch = '����';
$strSearchFormTitle = '����㹰ҹ������';
$strSearchInTables = '㹵��ҧ:';
$strSearchNeedle = '�����ͤ�ҷ���ͧ��ä��� (wildcard: "%"):';
$strSearchOption1 = '���ҧ����˹�觤�';
$strSearchOption2 = '�ء��';
$strSearchOption3 = '����͹������';
$strSearchOption4 = '��Ẻ regular expression';
$strSearchResultsFor = '�š�ä��� "<i>%s</i>" %s:';
$strSearchType = '��:';
$strSelect = '���͡';
$strSelectADb = '�ô���͡�ҹ������';
$strSelectAll = '���͡������';
$strSelectFields = '���͡��Ŵ� (���ҧ����˹�觿�Ŵ�):';
$strSelectNumRows = '㹤Ӥ�';
$strSend = '���������';
$strServerChoice = '������͡���������';
$strServerVersion = '��蹢ͧ���������';
$strSetEnumVal = '��Ҫ�Դ�ͧ��Ŵ��� "enum" ���� "set" �ô����ҵ���ٻẺ: \'a\',\'b\',\'c\'...<br />��ҵ�ͧ����������ͧ���� backslash ("\\") ���� �ѭ��С������� ("\'") ����㹤������ҹ�� ����������ͧ���� backslash ��˹�� (������ҧ: \'\\\\xyz\' or \'a\\\'b\')';
$strShow = '�ʴ�';
$strShowAll = '�ʴ�������';
$strShowColor = '�ʴ���';
$strShowCols = '�ʴ��������';
$strShowGrid = '�ʴ���Դ';
$strShowTableDimension = '�ʴ��ԵԢͧ���ҧ';
$strShowingRecords = '�ʴ�����¹��� ';
$strShowPHPInfo = '�ʴ������Ţͧ PHP';
$strShowTables = '�ʴ����ҧ';
$strShowThisQuery = ' �ʴ��Ӥ鹹���ա�� ';
$strSingly = '(�����)';
$strSize = '��Ҵ';
$strSort = '���§';
$strSpaceUsage = '���ͷ������';
$strSplitWordsWithSpace = '�Ӷ١�觴��ª�ͧ��ҧ (" ").';
$strSQL = 'SQL';
$strSQLQuery = '�Ӥ� SQL';
$strSQLResult = '���Ѿ�� SQL';
$strStatement = '�����';
$strStrucExcelCSV = '������ CSV ����Ѻ���ëͿ�������';
$strStrucCSV = '������ CSV';
$strStrucData = '����ç���ҧ��Т�����';
$strStrucDrop = '��������� \'drop table\'';
$strStrucOnly = '੾���ç���ҧ';
$strStructPropose = '�ʹ��ç���ҧ���ҧ';
$strStructure = '�ç���ҧ';
$strSubmit = '��';
$strSuccess = '�ӤӤ��������º��������';
$strSum = '�����';

$strTable = '���ҧ ';
$strTableComments = '�����˵آͧ���ҧ';
$strTableEmpty = '���͵��ҧ�ѧ��ҧ����!';
$strTableHasBeenDropped = '�¹���ҧ %s �������º���� ����';
$strTableHasBeenEmptied = 'ź������㹵��ҧ %s ���º���� ����';
$strTableHasBeenFlushed = '��ҧ���ҧ %s ���º��������';
$strTableMaintenance = '��ô����ѡ�ҵ��ҧ';
$strTables = '%s ���ҧ';
$strTableStructure = '�ç���ҧ���ҧ';
$strTableType = '��Դ���ҧ';
$strTextAreaLength = ' ���ͧ�ҡ������Ǣͧ�ѹ <br />��Ŵ��� ����Ҩ����� ';
$strTheContent = '���á�����Ũҡ���ͧ�س���º��������';
$strTheContents = '����Ѻ�Ƿ���� primary key ���� unique key ����͹�ѹ �����Ҩҡ����᷹������������㹵��ҧ';
$strTheTerminator = '�ش����ش�ͧ��Ŵ�';
$strTotal = '������';
$strType = '��Դ';

$strUncheckAll = '������͡���';
$strUnique = '�͡�ѡɳ�';
$strUnselectAll = '������͡���';
$strUpdatePrivMessage = '�س���Ѻ��ا�Է������Ѻ %s ����';
$strUpdateProfile = '��Ѻ��ا�����:';
$strUpdateProfileMessage = '��Ѻ��ا��������º��������';
$strUpdateQuery = '��Ѻ��ا�Ӥ�';
$strUsage = '��ҹ';
$strUseBackquotes = '��� \'backqoute\' ���Ѻ���͵��ҧ��п�Ŵ�';
$strUser = '�����';
$strUserEmpty = '���ͼ�����ѧ��ҧ����!';
$strUserName = '���ͼ����';
$strUsers = '�����';
$strUseTables = '����ҧ';

$strValue = '���';
$strViewDump = '���ç���ҧ�ͧ���ҧ';
$strViewDumpDB = '���ç���ҧ�ͧ�ҹ������';

$strWelcome = '%s �Թ�յ�͹�Ѻ';
$strWithChecked = '�ӡѺ������͡:';
$strWrongUser = '͹حҵ������������� ���ͼ�����������ʼ�ҹ�Դ';

$strYes = '��';

$strZip = '"zipped"';

// To translate
$strEditPDFPages = 'Edit PDF Pages';  //to translate
$strNoDescription = 'no Description';  //to translate
$strRelationNotSet = 'Relationtable not found or not set in config.inc.php3';  //to translate
$strInfoNotSet = 'table_info table not found or not set in config.inc.php3';  //to translate
$strCoordsNotSet = 'table_coords table not found or not set in config.inc.php3';  //to translate
$strChoosePage = 'Please choose a Page to edit';  //to translate
$strCreatePage = 'Create a new Page';  //to translate
$strSelectTables = 'Select Tables';  //to translate
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br />This might happen if php finds a parse error in it or php cannot find the file.<br />Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br />If you recieve a blank page, everything is fine.'; //to translate
$strFunc = 'Function';  //to translate
?>
