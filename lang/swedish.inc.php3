<?php
/* $Id$ */

$charset = 'iso-8859-1';
$left_font_family = 'verdana, helvetica, arial, geneva, sans-serif';
$right_font_family = 'helvetica, arial, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
$byteUnits = array('bytes', 'kB', 'MB', 'GB');

$day_of_week = array('S�n', 'M=86n', 'Tis', 'Ons', 'Tors', 'Fre', 'L�r');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y, %I:%H';


$strAccessDenied = '�tkomst nekad';
$strAction = 'Handling';
$strAddDeleteColumn = 'L�gg till/ta bort f�ltkolumner';
$strAddDeleteRow = 'L�gg till/ta bort kriteriumrader';
$strAddNewField = 'L�gg till nytt f�lt';
$strAddPriv = 'L�gg till ett nytt privilegie';
$strAddPrivMessage = 'Du har lagt till ett nytt privilegie.';
$strAddSearchConditions = 'L�gg till s�kkriterier (uttryck i "where"-sats):';
$strAddUser = 'L�gg till ny anv�ndare';
$strAddUserMessage = 'Du har lagt till en ny anv�ndare.';
$strAffectedRows = 'P�verkade rader:';
$strAfter = 'Efter';
$strAll = 'Alla';
$strAlterOrderBy = 'Sortera om tabellen efter';
$strAnalyzeTable = 'Analysera tabell';
$strAnd = 'Och';
$strAnIndex = 'Ett index har lagt till p� %s';
$strAny = 'N�gon';
$strAnyColumn = 'L�gg till kolumn';
$strAnyDatabase = 'N�gon databas';
$strAnyHost = 'N�gon v�rd';
$strAnyTable = 'N�gon tabell';
$strAnyUser = 'N�gon anv�ndare';
$strAPrimaryKey = 'En prim�r myckel har lagts till p� %s';
$strAscending = 'Stigande';
$strAtBeginningOfTable = 'I b�rjan av tabellen';
$strAtEndOfTable = 'I slutet av tabellen';
$strAttr = 'Attribut';

$strBack = 'Bak�t';
$strBinary = 'Bin�r';
$strBinaryDoNotEdit = 'Bin�r - �ndra inte';
$strBookmarkLabel = 'Etikett';
$strBookmarkQuery = 'Bokm�rkt SQL-fr�ga';
$strBookmarkThis = 'Skapa bokm�rke f�r den h�r SQL-fr�gan';
$strBookmarkView = 'Visa endast';
$strBrowse = 'Visa';
$strBzip = '"bzippad"';

$strCantLoadMySQL = 'kan inte ladda MySQL-till�gg,<br />var god och kontrollera PHP-konfigurationen.';
$strCarriage = 'Vagnretur: \r';
$strChange = '�ndra';
$strCheckAll = 'Markera alla';
$strCheckDbPriv = 'Kontollera database privilegier';
$strCheckTable = 'Kontrollera tabell';
$strColumn = 'Kolumn';
$strColumnEmpty = 'Kolumn-namnen �r tomma!';
$strColumnNames = 'Kolumn-namn';
$strCompleteInserts = 'Kompletta infogningar';
$strConfirm = 'Vill du verkligen g�ra det?';
$strCopyTableOK = 'Tabellen %s har kopierats till %s.';
$strCreate = 'Skapa';
$strCreateNewDatabase = 'Skapa ny databas';
$strCreateNewTable = 'Skapa ny tabell i databas ';
$strCriteria = 'Kriterium';

$strData = 'Data';
$strDatabase = 'Databas ';
$strDatabaseHasBeenDropped = 'Databasen %s har tagits bort.';
$strDatabases = 'databaser';
$strDatabasesStats = 'Databas-statistik';
$strDataOnly = 'Enbart data';
$strDbEmpty = 'Databasen �r tom!';
$strDefault = 'Standard';
$strDelete = 'Radera';
$strDeleted = 'Raden har raderats';
$strDeletedRows = 'Raderade rader';
$strDeleteFailed = 'Raderingen misslyckades!';
$strDeleteUserMessage = 'Du har tagit bort anv�ndaren %s.';
$strDescending = 'Fallande';
$strDisplay = 'Visa';
$strDisplayOrder = 'Visningsordning:';
$strDoAQuery = 'Utf�r en "query by example" (wildcard: "%")';
$strDocu = 'Dokumentation';
$strDoYouReally = 'Vill du verkligen ';
$strDrop = 'Radera';
$strDropDB = 'Radera databas ';
$strDropTable = 'Radera tabell';
$strDumpingData = 'Raderar data i tabell';
$strDynamic = 'dynamisk';

$strEdit = '�ndra';
$strEditPrivileges = '�ndra privilegier';
$strEffective = 'Effektivt';
$strEmpty = 'T�m';
$strEmptyResultSet = 'MySQL skickade tillbaka ett tomt resultat (dvs inga rader).';
$strEnd = 'Slut';
$strEnglishPrivileges = ' Viktigt: MySQL-privilegienamn anges p� engelska ';
$strError = 'Fel';
$strExtendedInserts = 'Ut�kade infogningar';
$strExtra = 'Extra';

$strField = 'F�lt';
$strFieldHasBeenDropped = 'F�ltet %s har tagits bort';
$strFields = 'F�lt';
$strFieldsEmpty = ' Antalet f�lt �r noll! ';
$strFieldsEnclosedBy = 'F�lten omslutna av'; //R�tt???
$strFieldsEscapedBy = 'F�lten undgicks av'; //R�tt???
$strFieldsTerminatedBy = 'F�lten avslutade med';
$strFixed = 'fast';
$strFormat = 'Format';
$strFormEmpty = 'V�rde saknas i formul�ret!';
$strFullText = 'Fullst�ndiga texter';
$strFunction = 'Funktion';

$strGenTime = 'Skapad';
$strGo = 'K�r';
$strGrants = 'Godk�nnanden'; //R�tt???
$strGzip = '"gzippad"';

$strHasBeenAltered = 'har �ndrats.';
$strHasBeenCreated = 'har skapats.';
$strHome = 'Hem';
$strHomepageOfficial = 'phpMyAdmin:s officiella hemsida';
$strHomepageSourceforge = 'phpMyAdmin Sourceforge-nedladdningssida';
$strHost = 'V�rd';
$strHostEmpty = 'V�rdnamnet �r ej satt!';

$strIdxFulltext = 'Heltext';
$strIfYouWish = 'Om du vill ladda enbart n�gra av tabellens kolumner, ange en kommaseparerad f�ltlista.';
$strIndex = 'Index';
$strIndexHasBeenDropped = 'Index %s har tagits bort';
$strIndexes = 'Index';
$strInsert = 'Infoga';
$strInsertAsNewRow = 'L�gg till som ny rad';
$strInsertedRows = 'Tillagda rader:';
$strInsertIntoTable = 'Infoga i tabell';
$strInsertNewRow = 'Infoga ny rad';
$strInsertTextfiles = 'Importera textfil till tabellen';
$strInstructions = 'Instruktioner';
$strInUse = 'anv�nds';
$strInvalidName = '"%s" �r ett reserverat ord, du kan inte anv�nda det som ett namn p� en databas/tabell/f�lt.';

$strKeepPass = '�ndra inte l�senordet';
$strKeyname = 'Nyckel';;
$strKill = 'D�da';

$strLength = 'L�ngd';
$strLengthSet = 'L�ngd/V�rden*';
$strLimitNumRows = 'rader per sida';
$strLineFeed = 'Radframmatning: \n';
$strLines = 'Rader';
$strLinesTerminatedBy = 'Raderna avslutade med';
$strLocationTextfile = 'Textfilens plats';
$strLogin = 'Logga in'; //to translate, but its not in use ...
$strLogout = 'Logga ut';

$strModifications = '�ndringarna har sparats';
$strModify = '�ndra';
$strMySQLReloaded = 'MySQL har laddats om.';
$strMySQLSaid = 'MySQL sa: ';
$strMySQLShowProcess = 'Visa processer';
$strMySQLShowStatus = 'Visa MySQL-k�rningsinformation';
$strMySQLShowVars = 'Visa MySQL:s systemvariabler';

$strName = 'Namn';
$strNbRecords = 'Antal rader';
$strNext = 'N�sta';
$strNo = 'Nej';
$strNoDatabases = 'Inga databaser';
$strNoDropDatabases = '"DROP DATABASE"-instruktioner �r avst�ngda.';
$strNoModification = 'Ingen f�r�ndring';
$strNoPassword = 'Inget l�senord';
$strNoPrivileges = 'Inga privilegier';
$strNoQuery = 'Ingen SQL fr�ga!';
$strNoRights = 'Du har inte nog med beh�righet f�r att vara h�r!';
$strNoTablesFound = 'Inga tabeller funna i databasen.';
$strNotNumber = 'Det �r inte ett nummer!';
$strNotValidNumber = ' �r inte ett giltigt radnummer!';
$strNoUsersFound = 'Hittade ingen anv�ndare.';
$strNull = 'Null';
$strNumberIndexes = ' Antal avancerade index ';

$strOftenQuotation = 'Ofta citattecken. Frivilligt betyder att bara \'char\' och \'varchar\' f�lten omgivs av det angivna tecken.';
$strOptimizeTable = 'Optimera tabell';
$strOptionalControls = 'Frivilligt. Styr hur l�sning och skrivning av specialtecken utf�rs.';
$strOptionally = 'Frivilligt';
$strOr = 'Eller';
$strOverhead = 'Overhead'; //to translate (I vilket sammanhang???)

$strPartialText = 'Avkortade texter';
$strPassword = 'L�senord';
$strPasswordEmpty = 'L�senordet �r tomt!';
$strPasswordNotSame = 'L�senorden �r inte lika!';
$strPHPVersion = 'PHP-version';
$strPmaDocumentation = 'phpMyAdmin dokumentation';
$strPos1 = 'B�rja';
$strPrevious = 'F�reg�ende';
$strPrimary = 'Prim�r';
$strPrimaryKey = 'Prim�rnyckel';
$strPrimaryKeyHasBeenDropped = 'Den prim�ra nyckeln har tagits bort';
$strPrinterFriendly = 'Utskriftsv�nlig visning av tabellen ovan';
$strPrintView = 'Skriv ut ovanst�ende';
$strPrivileges = 'Privilegier';
$strProducedAnError = '�tergav ett fel.';
$strProperties = 'Inst�llningar';

$strQBE = 'Skapa fr�ga mha formul�r (Query by Example)';
$strQBEDel = 'Ta bort';
$strQBEIns = 'Infoga';
$strQueryOnDb = 'SQL-query on database ';

$strReadTheDocs = 'L�s manualen';
$strRecords = 'Rader';
$strReloadFailed = 'Omstart av MySQL misslyckades.';
$strReloadMySQL = 'Starta om MySQL';
$strRememberReload = 'Kom ih�g att starta om servern.';
$strRenameTable = 'D�p om tabellen till';
$strRenameTableOK = 'Tabell %s har d�pts om till %s';
$strRepairTable = 'Reparera tabell';
$strReplace = 'Ers�tt';
$strReplaceTable = 'Ers�tt tabelldata med fil';
$strReset = 'Nollst�ll';
$strReType = 'Skriv om';
$strRevoke = 'Upph�v'; //R�tt???
$strRevokeGrant = 'Upph�v godk�nnanden'; //R�tt???
$strRevokeGrantMessage = 'Du har upph�vt godk�nnande privilegierna f�r'; //R�tt???
$strRevokeMessage = 'Du har upph�vt godk�nnandena f�r'; //R�tt???
$strRevokePriv = 'Upph�v Privilegierna';
$strRowLength = 'Radl�ngd';
$strRows = 'Rader';
$strRowsFrom = 'rader med b�rjan fr�n';
$strRowSize = ' Radstorlek ';
$strRowsStatistic = 'Radstatistik';
$strRunning = 'k�rs p� ';
$strRunningAs = 'som';
$strRunQuery = 'K�r fr�ga';
$strRunSQLQuery = 'K�r SQL fr�ga/fr�gor p� databasen %s';

$strSave = 'Spara';
$strSelect = 'V�lj';
$strSelectFields = 'V�lj f�lt (minst ett):';
$strSelectNumRows = 'i fr�ga';
$strSend = 'Skicka';
$strSequence = 'Sekv.';
$strServerChoice = 'Serverval';
$strServerVersion = 'Serverversion';
$strSetEnumVal = 'Om en f�lttyp �r "enum" eller "set", var god ange v�rden enligt f�ljande format: \'a\',\'b\',\'c\'...<br />Om du beh�ver l�gga till ett bak�tstreck ("\") eller ett enkelcitat ("\'") i v�rdena, skriv ett bak�tstreck f�re tecknet (till exempel \'\\\\xyz\' eller \'a\\\'b\').';
$strShow = 'Visa';
$strShowAll = 'Visa alla';
$strShowCols = 'Visa kolumner';
$strShowingRecords = 'Visar rader ';
$strShowPHPInfo = 'Visa PHP-information';
$strShowTables = 'Visa tabeller';
$strShowThisQuery = ' Visa den h�r fr�gan igen ';
$strSingly = '(ensam)';
$strSize = 'Storlek';
$strSort = 'Sortering';
$strSpaceUsage = 'Utrymmesanv�ndning';
$strSQLQuery = 'SQL-fr�ga';
$strStartingRecord = 'B�rjar med rad';
$strStatement = 'Uppgift';
$strStrucCSV = 'CSV-data';
$strStrucData = 'Struktur och data';
$strStrucDrop = 'L�gg till \'ta bort tabell\';
$strStrucExcelCSV = 'CSV f�r Ms Excel-data';
$strStrucOnly = 'Enbart struktur';
$strSubmit = 'S�nd';
$strSuccess = 'Din SQL-fr�ga utf�rdes korrekt';
$strSum = 'Summa';

$strTable = 'tabell ';
$strTableComments = 'Tabellkommentarer';
$strTableEmpty = 'Tabellnamnet �r tomt!';
$strTableHasBeenDropped = 'Tabellen %s har tagits bort';
$strTableHasBeenEmptied = 'Tabellen %s har t�mts';
$strTableMaintenance = 'Tabellunderh�ll';
$strTables = '%s tabell(er)';
$strTableStructure = 'Tabellstruktur f�r tabell';
$strTableType = 'Tabelltyp';
$strTextAreaLength = ' P� grund av dess l�ngd,<br /> kanske detta f�lt inte kan redigeras ';
$strTheContent = 'Filens inneh�ll har importerats.';
$strTheContents = 'Filens inneh�ll ers�tter den valda tabellens rader som har identiska prim�ra eller unika nycklar.';
$strTheTerminator = 'F�ltavslutare.';
$strTotal = 'totalt';
$strType = 'Typ';

$strUncheckAll = 'Avmarkera alla';
$strUnique = 'Unik';
$strUpdatePrivMessage = 'Du har uppdaterat privilegierna f�r %s.';
$strUpdateProfile = 'Uppdatera profil:';
$strUpdateProfileMessage = 'Profilen har uppdaterats.';
$strUpdateQuery = 'Uppdatera fr�ga';
$strUsage = 'Anv�ndning';
$strUseBackquotes = 'Anv�nd bak�tcitat i tabeller och f�ltnamn';
$strUser = 'Anv�ndare';
$strUserEmpty = 'Anv�ndarnamnet �r tomt!';
$strUserName = 'Anv�ndarnamn';
$strUsers = 'Anv�ndare';
$strUseTables = 'Anv�nd tabeller';

$strValue = 'V�rde';
$strViewDump = 'Visa dump(-schema) av tabellen';
$strViewDumpDB = 'Visa dump(-schema) av databas';

$strWelcome = 'V�lkommen till ';
$strWithChecked = 'Med markerade:';
$strWrongUser = 'Fel anv�ndarnamn/l�senord. �tkomst nekad.';

$strYes = 'Ja';

$strZip = '"zippad"';

// To translate
$strCopyTable = 'Copy table to (database<b>.</b>table):';
$strMoveTable = 'Move table to (database<b>.</b>table):';
$strMoveTableOK = 'Table %s has been moved to %s.';
?>
