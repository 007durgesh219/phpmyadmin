<?php

/* $Id$ */

$charset = 'iso-8859-1';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('S�n', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'L�r');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php
// to define the variable below
$datefmt = '%d/%m %Y kl. %H:%M:%S';


$strAccessDenied = 'Adgang N�gtet';
$strAction = 'Handling';
$strAddDeleteColumn = 'Tilf�j/Slet felt kolonne';
$strAddDeleteRow = 'Tilf�j/Slet kriterie r�kke';
$strAddNewField = 'Tilf�j nyt felt';
$strAddPrivMessage = 'Du har tilf�jet et nyt privilegium.';
$strAddPriv = 'Tilf�j nyt privilegium';
$strAddSearchConditions = 'Tilf�j s�gekriterier (kroppen af "WHERE" s�tningen):';
$strAddToIndex = 'F�j til indeks &nbsp;%s&nbsp;kolonne(r)';
$strAddUserMessage = 'Du har tilf�jet en ny bruger.';
$strAddUser = 'Tilf�j en ny bruger';
$strAffectedRows = 'Ber�rte r�kker:';
$strAfter = 'Efter %s';
$strAfterInsertBack = 'Retur';
$strAfterInsertNewInsert = 'Inds�t en ny record';
$strAll = 'Alle';
$strAlterOrderBy = 'Arranger r�kkeorden efter';
$strAnalyzeTable = 'Analyser tabel';
$strAnd = 'Og';
$strAnIndex = 'Der er tilf�jet et indeks til %s';
$strAnyColumn = 'Enhver kolonne';
$strAnyDatabase = 'Enhver database';
$strAny = 'Enhver';
$strAnyHost = 'Enhver v�rt';
$strAnyTable = 'Enhver tabel';
$strAnyUser = 'Enhver bruger';
$strAPrimaryKey = 'Der er f�jet en prim�r n�gle til %s';
$strAscending = 'Stigende';
$strAtBeginningOfTable = 'I begyndelsen af tabel';
$strAtEndOfTable = 'I slutningen af tabel';
$strAttr = 'Attributter';

$strBack = 'Tilbage';
$strBinary = ' Bin�rt ';
$strBinaryDoNotEdit = ' Bin�rt - m� ikke �ndres ';
$strBookmarkDeleted = 'Bogm�rket er fjernet.';
$strBookmarkLabel = 'Label';
$strBookmarkQuery = 'SQL-foresp�rgsel med bogm�rke';
$strBookmarkThis = 'Lav bogm�rke til denne SQL-foresp�rgsel';
$strBookmarkView = 'Kun oversigt';
$strBrowse = 'Vis';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'MySQL udvidelser kan ikke loades,<br />check PHP konfigurationen.';
$strCantRenameIdxToPrimary = 'Kan ikke omd�be indeks til PRIMARY!';
$strCardinality = 'Kardinalitet';
$strCarriage = 'Carriage return: \\r';
$strChange = '�ndre';
$strChangePassword = '�ndre password';
$strCheckAll = 'Afm�rk alt';
$strCheckDbPriv = 'Tjek database privilegier';
$strCheckTable = 'Tjek tabel';
$strColumn = 'Kolonne';
$strColumnNames = 'Kolonne navne';
$strCompleteInserts = 'Lav komplette inserts';
$strConfirm = 'Ikke du sikker p� at du vil g�re det?';
$strCookiesRequired = 'Herefter skal cookies v�re sat til.';
$strCopyTable = 'Kopier tabel til (database<b>.</b>tabel):';
$strCopyTableOK = 'Tabellen %s er nu kopieret til: %s.';
$strCreateIndex = 'Dan et indeks p�&nbsp;%s&nbsp;kolonner';
$strCreateIndexTopic = 'Lav et nyt indeks';
$strCreateNewDatabase = 'Opret ny database';
$strCreateNewTable = 'Opret ny tabel i database %s';
$strCreate = 'Opret';
$strCriteria = 'Kriterier';

$strDatabase = 'Database: ';
$strDatabaseHasBeenDropped = 'Database %s er slettet.';
$strDatabases = 'databaser';
$strDatabasesStats = 'Database statistik';
$strDatabaseWildcard = 'Database (jokertegn tilladt):';
$strData = 'Data';
$strDataOnly = 'Kun data';
$strDefault = 'Standardv�rdi';
$strDeleted = 'R�kken er slettet!';
$strDeletedRows = 'Slettede r�kker:';
$strDeleteFailed = 'Kan ikke slette!';
$strDelete = 'Slet';
$strDeleteUserMessage = 'Du har slettet brugeren %s.';
$strDescending = 'Faldende';
$strDisplayOrder = 'R�kkef�lge af visning:';
$strDisplay = 'Vis';
$strDoAQuery = 'K�r en foresp�rgsel p� felter (wildcard: "%")';
$strDocu = 'Dokumentation';
$strDoYouReally = 'Er du sikker p� at du vil ';
$strDropDB = 'Slet database %s';
$strDrop = 'Slet';
$strDropTable = 'Slet tabel';
$strDumpingData = 'Data dump for tabellen';
$strDynamic = 'dynamisk';

$strEditPrivileges = 'Ret privilegier';
$strEdit = 'Ret';
$strEffective = 'Effektiv';
$strEmptyResultSet = 'MySQL returnerede ingen data (fx ingen r�kker).';
$strEmpty = 'T�m';
$strEnd = 'Slut';
$strEnglishPrivileges = ' NB: Navne p� MySQL privilegier er p� engelsk ';
$strError = 'Fejl';
$strExtendedInserts = 'Udvidede inserts';
$strExtra = 'Ekstra';

$strField = 'Feltnavn';
$strFieldHasBeenDropped = 'Felt %s er slettet';
$strFieldsEmpty = ' Felttallet har ingen v�rdi! ';
$strFieldsEnclosedBy = 'Felter indrammet med';
$strFieldsEscapedBy = 'Felter escaped med';
$strFields = 'Felter';
$strFieldsTerminatedBy = 'Felter afsluttet med';
$strFixed = 'ordnet';
$strFlushTable = 'Flush tabellen ("FLUSH")';
$strFormat = 'Format';
$strFormEmpty = 'Ingen v�rdi i formularen !';
$strFullText = 'Komplette tekster';
$strFunction = 'Funktion';

$strGenTime = 'Genereringstidspunkt';
$strGo = 'Udf�r';
$strGrants = 'Tildelinger';
$strGzip = '"gzipped"';

$strHasBeenAltered = 'er �ndret.';
$strHasBeenCreated = 'er oprettet.';
$strHome = 'Hjem';
$strHomepageOfficial = 'Officiel phpMyAdmin hjemmeside ';
$strHomepageSourceforge = 'Ny phpMyAdmin hjemmeside ';
$strHostEmpty = 'Der er intet v�rtsnavn!';
$strHost = 'V�rt';

$strIdxFulltext = 'Fuldtekst';
$strIfYouWish = 'Hvis du kun �nsker at importere nogle af tabellens kolonner, angives de med en kommasepareret felt liste.';
$strIgnore = 'Ignorer';
$strIndexes = 'Indekser';
$strIndexHasBeenDropped = 'Indeks %s er blevet slettet';
$strIndex = 'Indeks';
$strIndexName = 'Indeks navn&nbsp;:';
$strIndexType = 'Indeks type&nbsp;:';
$strInsertAsNewRow = 'Inds�t som ny r�kke';
$strInsertedRows = 'Indsatte r�kker:';
$strInsert = 'Inds�t';
$strInsertNewRow = 'Inds�t ny r�kke';
$strInsertTextfiles = 'Importer tekstfil til tabellen';
$strInstructions = 'Instruktioner';
$strInUse = 'i brug';
$strInvalidName = '"%s" er et reserveret ord, du kan ikke bruge det som database-, tabel- eller feltnavn.';

$strKeepPass = 'Password m� ikke �ndres';
$strKeyname = 'N�gle';
$strKill = 'Kill';

$strLength = 'L�ngde';
$strLengthSet = 'L�ngde/V�rdi*';
$strLimitNumRows = 'poster pr. side';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Linier';
$strLinesTerminatedBy = 'Linier afsluttet med';
$strLocationTextfile = 'Tekstfilens placering';
$strLogin = 'Login';
$strLogout = 'Log af';
$strLogPassword = 'Password:';
$strLogUsername = 'Brugernavn:';

$strModifications = 'Rettelserne er gemt!';
$strModifyIndexTopic = '�ndring af et indeks';
$strModify = 'Ret';
$strMoveTable = 'Flyt tabel til (database<b>.</b>tabel):';
$strMoveTableOK = 'Tabel %s er flyttet til %s.';
$strMySQLReloaded = 'MySQL genstartet.';
$strMySQLSaid = 'MySQL returnerede: ';
$strMySQLServerProcess = 'MySQL %pma_s1% k�rer p� %pma_s2% som %pma_s3%';
$strMySQLShowProcess = 'Vis tr�de';
$strMySQLShowStatus = 'Vis MySQL runtime information';
$strMySQLShowVars = 'Vis MySQL system variable';

$strName = 'Navn';
$strNext = 'N�ste';
$strNoDatabases = 'Ingen databaser';
$strNoDropDatabases = '"DROP DATABASE" erkl�ringer kan ikke bruges.';
$strNoFrames = 'phpMyAdmin er mere brugervenlig med en browser, der kan klare <b>frames</b>.';
$strNoIndex = 'Intet indeks defineret!';
$strNoIndexPartsDefined = 'Ingen dele af indeks er definerede!';
$strNoModification = 'Ingen �ndring';
$strNone = 'Intet';
$strNo = 'Nej';
$strNoPassword = 'Intet password';
$strNoPrivileges = 'Ingen privilegier';
$strNoQuery = 'Ingen SQL foresp�rgsel!';
$strNoRights = 'Du har ikke tilstr�kkelige rettigheder til at v�re her!';
$strNoTablesFound = 'Ingen tabeller fundet i databasen.';
$strNotNumber = 'Dette er ikke et tal!';
$strNotValidNumber = ' er ikke et gyldigt r�kkenummer!';
$strNoUsersFound = 'Ingen bruger(e) fundet.';
$strNull = 'Nulv�rdi';

$strOftenQuotation = 'Ofte anf�rselstegn. OPTIONALLY betyder at kun char og varchar felter er omsluttet med det valgte "tekstkvalifikator"-tegn.'; //skal muligvis �ndres
$strOptimizeTable = 'Optimer tabel';
$strOptionalControls = 'Valgfrit. Kontrollerer hvordan specialtegn skrives eller l�ses.';
$strOptionally = 'OPTIONALLY';
$strOr = 'Eller';
$strOverhead = 'Overhead';

$strPartialText = 'Delvise tekster';
$strPasswordEmpty = 'Der er ikke angivet noget password!';
$strPasswordNotSame = 'De to passwords er ikke ens!';
$strPassword = 'Password';
$strPHPVersion = 'PHP version';
$strPmaDocumentation = 'phpMyAdmin dokumentation';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt> direktivet SKAL v�re sat i konfigurationsfilen!';
$strPos1 = 'Start';
$strPrevious = 'Forrige';
$strPrimaryKeyHasBeenDropped = 'Prim�rn�glen er slettet';
$strPrimaryKeyName = 'Navnet p� prim�rn�glen skal v�re... PRIMARY!';
$strPrimaryKey = 'Prim�r n�gle';
$strPrimaryKeyWarning = '("PRIMARY" <b>skal</b> v�re navnet p� og <b>kun p�</b> en prim�r n�gle!)';
$strPrimary = 'Prim�r';
$strPrintView = 'Vis (udskriftvenlig)';
$strPrivileges = 'Privilegier';
$strProperties = 'Egenskaber';

$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQBE = 'Query by Example';
$strQueryOnDb = 'SQL-foresp�rgsel til database <b>%s</b>:';

$strRecords = 'Poster';
$strReferentialIntegrity = 'Check reference integriteten';
$strReloadFailed = 'Genstart af MySQL fejlede.';
$strReloadMySQL = 'Genstart MySQL';
$strRememberReload = 'Husk at indl�se serveren.';
$strRenameTableOK = 'Tabellen %s er nu omd�bt til: %s';
$strRenameTable = 'Omd�b tabel til';
$strRepairTable = 'Reparer tabel';
$strReplace = 'Erstat';
$strReplaceTable = 'Erstat data i tabellen med filens data';
$strReset = 'Nulstil';
$strReType = 'Skriv igen';
$strRevokeGrantMessage = 'Du har tilbagekaldt det tildelte privilegium for %s';
$strRevokeGrant = 'Tilbagekald tildeling';
$strRevokeMessage = 'Du har tilbagekaldt privilegierne for %s';
$strRevokePriv = 'Tilbagekald privilegier';
$strRevoke = 'Tilbagekald';
$strRowLength = 'R�kke l�ngde';
$strRowsFrom = 'r�kker startende fra';
$strRowSize = ' R�kke st�rrelse ';
$strRowsModeHorizontal = 'vandret';
$strRowsModeOptions = '%s og gentag overskrifter efter %s celler';
$strRowsModeVertical = 'lodret';
$strRows = 'R�kker';
$strRowsStatistic = 'R�kke statistik';
$strRunning = 'k�rer p� %s';
$strRunQuery = 'Send foresp�rgsel';
$strRunSQLQuery = 'K�r SQL forsp�rgsel(er) p� database %s';

$strSave = 'Gem';
$strSelectADb = 'V�lg en database';
$strSelectAll = 'V�lg alle';
$strSelectFields = 'V�lg mindst eet felt:';
$strSelectNumRows = 'i foresp�rgsel';
$strSelect = 'V�lg';
$strSend = 'Send';
$strServerChoice = 'Server valg';
$strServerVersion = 'Server version';
$strSetEnumVal = 'Hvis et felt er af typen "enum" eller "set", skal v�rdierne angives p� formen: \'a\',\'b\',\'c\'...<br />Skulle du f� brug for en backslash ("\") eller et enkelt anf�rselstegn ("\'") blandt disse v�rdier, s� tilf�j en ekstra backslash (fx \'\\\\xyz\' or \'a\\\'b\').';
$strShowAll = 'Vis alt';
$strShowCols = 'Vis kolonner';
$strShowingRecords = 'Viser poster ';
$strShowPHPInfo = 'Vis PHP information';
$strShowTables = 'Vis tabeller';
$strShowThisQuery = ' Vis foresp�rgslen her igen ';
$strShow = 'Vis';
$strSingly = '(enkeltvis)';
$strSize = 'St�rrelse';
$strSort = 'Sorter';
$strSpaceUsage = 'Pladsforbrug';
$strSQLQuery = 'SQL-foresp�rgsel';
$strStatement = 'Erkl�ringer';
$strStrucCSV = 'CSV data';
$strStrucData = 'Struturen og data';
$strStrucDrop = 'Tilf�j \'DROP TABLE\'';
$strStrucExcelCSV = 'CSV for Ms Excel data';
$strStrucOnly = 'Kun strukturen';
$strSubmit = 'Send';
$strSuccess = 'Din SQL-foresp�rgsel blev udf�rt korrekt';
$strSum = 'Sum';

$strTableComments = 'Tabel kommentarer';
$strTableEmpty = 'Intet tabelnavn!';
$strTableHasBeenDropped = 'Tabel %s er slettet';
$strTableHasBeenEmptied = 'Tabel %s er t�mt';
$strTableHasBeenFlushed = 'Tabel %s er blevet flushet';
$strTableMaintenance = 'Tabel vedligehold';
$strTables = '%s tabel(ler)';
$strTableStructure = 'Struktur dump for tabellen';
$strTable = 'Tabel: ';
$strTableType = 'Tabel type';
$strTextAreaLength = ' P� grund af feltets l�ngde,<br /> kan det muligvis ikke �ndres ';
$strTheContent = 'Filens indhold er importeret.';
$strTheContents = 'Filens indhold erstatter den valgte tabels r�kker for r�kker med identisk prim�r eller unik n�gle.';
$strTheTerminator = 'Felterne afgr�nses af dette tegn.';
$strTotal = 'total';
$strType = 'Datatype';

$strUncheckAll = 'Fjern alle m�rker';
$strUnique = 'Unik';
$strUnselectAll = 'Frav�lg alle';
$strUpdatePrivMessage = 'Du har opdateret privilegierne for %s.';
$strUpdateProfileMessage = 'Profilen er blevet opdateret.';
$strUpdateProfile = 'Opdater profil:';
$strUpdateQuery = 'Opdater foresp�rgsel';
$strUsage = 'Benyttelse';
$strUseBackquotes = 'Use backquotes with tables and fields\' names';
$strUser = 'Bruger';
$strUserEmpty = 'Intet brugernavn!';
$strUserName = 'Brugernavn';
$strUsers = 'Brugere';
$strUseTables = 'Benyt tabeller';

$strValue = 'V�rdi';
$strViewDumpDB = 'Vis dump (skema) af database';
$strViewDump = 'Vis dump (skema) over tabel';

$strWelcome = 'Velkommen til %s';
$strWithChecked = 'Med det afm�rkede:';
$strWrongUser = 'Forkert brugernavn/kodeord. Adgang n�gtet.';

$strYes = 'Ja';

$strZip = '"zipped"';


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
$strSearchFormTitle = 'Search in database';//to translate
$strSearchInTables = 'Inside table(s):';//to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strSearchOption1 = 'at least one of the words';//to translate
$strSearchOption2 = 'all words';//to translate
$strSearchOption3 = 'the exact phrase';//to translate
$strSearchOption4 = 'as regular expression';//to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSearch = 'Search';//to translate
$strSearchType = 'Find:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowColor = 'Show color';  //to translate
$strShowGrid = 'Show grid';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSplitWordsWithSpace = 'Words are seperated by a space character (" ").';//to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQLResult = 'SQL result'; //to translate
$strSQL = 'SQL'; //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strStructPropose = 'Propose table structure';  //to translate
$strStructure = 'Structure';  //to translate

$strValidateSQL = 'Validate SQL';  //to translate

?>
