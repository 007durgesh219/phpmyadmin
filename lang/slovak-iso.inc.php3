<?php
/* $Id$ */
/* By: lubos klokner <erkac@vault-tec.sk> */

$charset = 'iso-8859-2';
$left_font_family = '"verdana CE", "Arial CE", verdana, helvetica, arial, geneva, sans-serif';
$right_font_family = '"verdana CE", "Arial CE", helvetica, arial, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
$byteUnits = array('Bajtov', 'KB', 'MB', 'GB');

$day_of_week = array('Ne', 'Po', '�t', 'St', '�t', 'Pi', 'So');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'M�j', 'J�n', 'J�l', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
$datefmt = '%d.%B, %Y - %H:%M';


$strAccessDenied = 'Pr�stup zamietnut�';
$strAction = 'Akcia';
$strAddDeleteColumn = 'Pridat/Odobrat polia stlpcov';
$strAddDeleteRow = 'Pridat/Odobrat krit�ria riadku';
$strAddNewField = 'Pridat nov� pole';
$strAddPriv = 'Pridat nov� privil�gium';
$strAddPrivMessage = 'Privil�gium bolo pridan�.';
$strAddSearchConditions = 'Pridat vyhlad�vacie parametre (obsah dotazu po "where" pr�kaze):';
$strAddUser = 'Pridat nov�ho pou��vatela';
$strAddUserMessage = 'Pou��vatel bol pridan�.';
$strAffectedRows = ' Ovplyvnen� riadky: ';
$strAfter = 'Po';
$strAfterInsertBack = 'Return'; //to translate
$strAfterInsertNewInsert = 'Insert a new record'; //to translate
$strAll = 'V�etko';
$strAlterOrderBy = 'Zmenit poradie tabulky podla';
$strAnalyzeTable = 'Analyzovat tabulku';
$strAnd = 'a';
$strAnIndex = 'Bol pridan� index pre %s';
$strAny = 'Ak�kolvek';
$strAnyColumn = 'Ak�kolvek stlpec';
$strAnyDatabase = 'Ak�kolvek datab�za';
$strAnyHost = 'Ak�kolvek hostitel';
$strAnyTable = 'Ak�kolvek tabulka';
$strAnyUser = 'Akykolvek pou��vatel';
$strAPrimaryKey = 'Bol pridan� prim�rny pre %s';
$strAscending = 'Vzostupne'; 
$strAtBeginningOfTable = 'Na zaciatku tabulky';
$strAtEndOfTable = 'Na konci tabulky';
$strAttr = 'Atrib�ty';

$strBack = 'Sp�t';
$strBinary = 'Bin�rny';
$strBinaryDoNotEdit = 'Bin�rny - neupravujte ';
$strBookmarkDeleted = 'The bookmark has been deleted.'; //to translate
$strBookmarkLabel = 'N�zov';
$strBookmarkQuery = 'Obl�ben� SQL dotaz';
$strBookmarkThis = 'Pridat tento SQL dotaz do obl�ben�ch';
$strBookmarkView = 'Iba prezriet';
$strBrowse = 'Prech�dzat';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'nieje mo�n� nahrat roz��renie pre MySQL,<br />pros�m skontrolujte konfigur�ciu PHP.';
$strCarriage = 'N�vrat voz�ku (Carriage return): \\r';
$strChange = 'Zmenit';
$strCheckAll = 'Oznacit v�etko';
$strCheckDbPriv = 'Skontrolovat privil�gia datab�zy';
$strCheckTable = 'Skontrolovat tabulku';
$strColumn = 'Stlpec';
$strColumnNames = 'N�zvy stlpcov';
$strCompleteInserts = '�pln� vlo�enie';
$strConfirm = 'Skutocne si �el�te toto vykonat?';
$strCopyTable = 'Skop�rovat tabulku do (datab�za<b>.</b>tabulka):';
$strCopyTable = 'Skop�rovat tabulku do';
$strCopyTableOK = 'Tabulka %s bola skor�rovan� do %s.';
$strCreate = 'Vytvorit';
$strCreateNewDatabase = 'Vytvorit nov� datab�zu';
$strCreateNewTable = 'Vytvorit nov� tabulku v datab�ze ';
$strCriteria = 'Krit�ria';

$strData = 'D�ta';
$strDatabase = 'Datab�za ';
$strDatabaseHasBeenDropped = 'Datab�za %s bola zmazan�.';
$strDatabases = 'datab�z(y)';
$strDatabasesStats = '�tatistiky datab�zy';
$strDataOnly = 'Iba d�ta';
$strDefault = 'Predvolen�';
$strDelete = 'Zmazat';
$strDeleted = 'Riadok bol zmazan�';
$strDeletedRows = 'Zmazan� riadky:';
$strDeleteFailed = 'Mazanie bolo ne�spe�n�!';
$strDeleteUserMessage = 'Pou��vatel %s bol zmazan�.';
$strDescending = 'Zostupne';
$strDisplay = 'Zobrazit';
$strDisplayOrder = 'Zobrazit zoraden�:';
$strDoAQuery = 'Vykonat "dotaz podla pr�kladu" (wildcard: "%")';
$strDocu = 'Dokument�cia';
$strDoYouReally = 'Skutocne chcete vykonat pr�kaz ';
$strDrop = 'Odstr�nit';
$strDropDB = 'Odstr�nit datab�zu ';
$strDropTable = 'Zru�it tabulku';
$strDumpingData = 'Dampujem d�ta pre tabulku';
$strDynamic = 'dynamic';

$strEdit = 'Upravit';
$strEditPrivileges = 'Upravit privil�gia';
$strEffective = 'Efekt�vny';
$strEmpty = 'Vypr�zdnit';
$strEmptyResultSet = 'MySQL vr�til pr�zdny v�sledok (tj. nulov� pocet riadkov).';
$strEnd = 'Koniec';
$strEnglishPrivileges = ' Pozn�mka: n�zvy MySQL privil�gi� s� uv�dzan� v anglictine. ';
$strError = 'Chyba';
$strExtendedInserts = 'Roz��ren� vkladanie';
$strExtra = 'Extra';

$strField = 'Pole';
$strFieldHasBeenDropped = 'Pole %s bolo odstr�nen�';
$strFields = 'Polia';
$strFieldsEmpty = ' Pocet pol� je pr�zdny! ';
$strFieldsEnclosedBy = 'Polia uzatvoren�';
$strFieldsEscapedBy = 'Polia uveden� pomocou';
$strFieldsTerminatedBy = 'Polia ukoncen�';
$strFixed = 'pevn�';
$strFlushTable = 'Vypr�zdnit tabulku ("FLUSH")';
$strFormat = 'Form�t';
$strFormEmpty = 'Ch�baj�ca polo�ka vo formul�ri !';
$strFullText = 'Pln� texty';
$strFunction = 'Funkcia';

$strGenTime = 'Vygenerovan�:';
$strGo = 'Vykonaj';
$strGrants = 'Privil�gia';
$strGzip = '"gzip-ovan�"';

$strHasBeenAltered = 'bola zmenen�.';
$strHasBeenCreated = 'bola vytvoren�.';
$strHome = 'Domov';
$strHomepageOfficial = 'Ofici�lne str�nky phpMyAdmin-a';
$strHomepageSourceforge = 'Download str�nka phpMyAdmin-a (Sourceforge)';
$strHost = 'Hostitel';
$strHostEmpty = 'N�zov hostitela je pr�zdny!';

$strIdxFulltext = 'Cel� text';
$strIfYouWish = 'Ak si zel�te nahrat iba urcit� stlpce tabulky, �pecifikujte ich ako zoznam pol� oddelen� ciarkou.';
$strIndex = 'Index';
$strIndexes = 'Indexy';
$strIndexHasBeenDropped = 'Index pre %s bol odstr�nen�';
$strInsert = 'Vlo�it';
$strInsertAsNewRow = 'Vlo�it ako nov� riadok';
$strInsertedRows = 'Vlo�en� riadky:';
$strInsertNewRow = 'Vlo�it nov� riadok';
$strInsertTextfiles = 'Vlo�it textov� s�bory do tabulky';
$strInstructions = 'In�trukcie';
$strInUse = 'pr�ve sa pou��va';
$strInvalidName = '"%s" je rezervovan� slovo, nem��e byt pou�it� ako n�zov datab�zy/tabulky/pola.';

$strKeepPass = 'Nezmenit heslo';
$strKeyname = 'Kl�cov� n�zov';
$strKill = 'Zabit';

$strLength = 'Dl�ka';
$strLengthSet = 'Dl�ka/Nastavit*';
$strLimitNumRows = 'z�znamov na str�nku';
$strLineFeed = 'Ukoncenie riadku (Linefeed): \\n';
$strLines = 'Riadky';
$strLinesTerminatedBy = 'Riadky ukoncen�';
$strLocationTextfile = 'Lok�cia textov�ho s�boru';
$strLogin = ''; //to translate, but its not in use ...
$strLogout = 'Odhl�sit sa';

$strModifications = 'Zmeny boli ulo�en�';
$strModify = 'Zmenit';
$strMoveTable = 'Presun�t tabulku do (datab�za<b>.</b>tabulka):';
$strMoveTableOK = 'Tabulka %s bola presunut� do %s.';
$strMySQLReloaded = 'MySQL znovu-nac�tan�.';
$strMySQLSaid = 'MySQL hl�si: ';
$strMySQLShowProcess = 'Zobrazit procesy';
$strMySQLShowStatus = 'Zobrazit MySQL inform�cie o behu';
$strMySQLShowVars = 'Zobrazit MySQL syst�mov� premenn�';

$strName = 'N�zov';
$strNbRecords = 'Pocet z�znamov';
$strNext = 'Dal��';
$strNo = 'Nie';
$strNoDatabases = '�iadne datab�zy';
$strNoDropDatabases = 'Mo�nost "DROP DATABASE" vypnut�.';
$strNoFrames = 'phpMyAdmin funguje lep�ie s prehliadacmi podporuj�cimi <b>r�my</b>.';
$strNoModification = '�iadna zmena';
$strNoPassword = '�iadne heslo';
$strNoPrivileges = '�iadne privil�gia';
$strNoQuery = '�iadny SQL dotaz!';
$strNoRights = 'Nem�te dostatocn� pr�va na vykonanie tejto akcie!';
$strNoTablesFound = 'Neboli n�jden� �iadne tabulky v tejto dat�baze.';
$strNotNumber = 'Toto nieje c�slo!';
$strNotValidNumber = ' nieje platn� c�slo riadku!';
$strNoUsersFound = 'Nebol n�jden� �iadny pou��vatel.';
$strNull = 'Nulov�';
$strNumberIndexes = ' Pocet roz��ren�ch indexov ';

$strOftenQuotation = 'Casto uvodzuj�ce znaky. Volitelne znamena, �e iba polia typu char a varchar s� uzatvoren� do "uzatv�rac�ch" znakov.';
$strOptimizeTable = 'Optimalozovat tabulku';
$strOptionalControls = 'Voliteln�. Urcuje ako zapisovat alebo c�tat �peci�lne znaky.';
$strOptionally = 'Volitelne';
$strOr = 'alebo';
$strOverhead = 'Naviac';

$strPartialText = 'Ciastocn� texty';
$strPassword = 'Heslo';
$strPasswordEmpty = 'Heslo je pr�zdne!';
$strPasswordNotSame = 'Hesl� sa nezhoduj�!';
$strPHPVersion = 'Verzia PHP';
$strPmaDocumentation = 'phpMyAdmin Dokument�cia';
$strPos1 = 'Zaciatok';
$strPrevious = 'Predch�dzaj�ci';
$strPrimary = 'Prim�rny';
$strPrimaryKey = 'Prim�rny kl�c';
$strPrimaryKeyHasBeenDropped = 'Prim�rny kl�c bol zru�en�';
$strPrintView = 'N�hlad k tlaci';
$strPrivileges = 'Privil�gia';
$strProperties = 'Vlastnosti';

$strQBE = 'Dotaz podla pr�kladu';
$strQBEDel = 'Zmazat';
$strQBEIns = 'Vlo�it';
$strQueryOnDb = ' SQL dotaz v datab�ze ';

$strRecords = 'Z�znamov';
$strReloadFailed = 'Znovu-nac�tanie MySQL bolo ne�spe�n�.';
$strReloadMySQL = 'Znovu-nac�tat MySQL';
$strRememberReload = 'Nezabudnite znovu-nac�tat MySQL server.';
$strRenameTable = 'Premenovat tabulku na';
$strRenameTableOK = 'Tabulka %s bola premenovan� na %s';
$strRepairTable = 'Opravit tabulku';
$strReplace = 'Nahradit';
$strReplaceTable = 'Nahradit d�ta v tabulke s�borom';
$strReset = 'P�vodn� (Reset)';
$strReType = 'Nap�sat znova';
$strRevoke = 'Zrusit';
$strRevokeGrant = 'Zru�it polovenie pridelovat privil�gia';
$strRevokeGrantMessage = 'Bolo zru�en� pr�vo pridelovat privil�gia pre';
$strRevokeMessage = 'Boli zru�en� privil�gia pre';
$strRevokePriv = 'Zru�it privil�gia';
$strRowLength = 'Dl�ka riadku';
$strRows = 'Riadkov';
$strRowsFrom = 'riadky zac�naj� od';
$strRowSize = ' Velkost riadku ';
$strRowsStatistic = '�tatistika riadku';
$strRunning = 'be�i na ';
$strRunningAs = 'ako';
$strRunQuery = 'Odo�li dotaz';
$strRunSQLQuery = 'Spustit SQL dotaz/dotazy na datab�zu %s';

$strSave = 'Ulo�it';
$strSelect = 'Vybrat';
$strSelectFields = 'Zvolit pole (najmenej jedno):';
$strSelectNumRows = 'v dotaze';
$strSend = 'Po�li';
$strSequence = 'Seq.';
$strServerChoice = 'Volba serveru';
$strServerVersion = 'Verzia serveru';
$strSetEnumVal = 'Ak je pole typu "enum" alebo "set", pros�m zad�vajte hodnoty v tvare: \'a\',\'b\',\'c\'...<br />Ak dokonca porebujete zadat sp�tn� lom�tko ("\") alebo apostrof ("\'") pri t�chto hodnot�ch, zadajte ich napr�klad takto \'\\\\xyz\' alebo \'a\\\'b\'.';
$strShow = 'Uk�zat';
$strShowAll = 'Zobrazit v�etko';
$strShowCols = 'Zobrazit stlpce';
$strShowingRecords = 'Uk�zat z�znamy ';
$strShowPHPInfo = 'Zobrazit inform�cie o PHP';
$strShowTables = 'Zobrazit tabulky';
$strShowThisQuery = ' Zobrazit tento dotaz znovu ';
$strSingly = '(po jednom)';
$strSize = 'Velkost';
$strSort = 'Triedit';
$strSpaceUsage = 'Zabran� miesto';
$strSQLQuery = 'SQL dotaz';
$strStartingRecord = 'Zaciatok z�znamu';
$strStatement = '�daj';
$strStrucCSV = 'CSV d�ta';
$strStrucData = '�trukt�ru a d�ta';
$strStrucDrop = 'Pridaj \'vyma� tabulku\'';
$strStrucExcelCSV = 'CSV pre Ms Excel d�ta';
$strStrucOnly = 'Iba �trukt�ru';
$strSubmit = 'Odo�li';
$strSuccess = 'SQL dotaz bol �spe�ne vykonan�';
$strSum = 'Celkom';

$strTable = 'tabulka ';
$strTableComments = 'Koment�r k tabulke';
$strTableEmpty = 'Tabulka je pr�zdna!';
$strTableHasBeenDropped = 'Tabulka %s bola odstr�nen�';
$strTableHasBeenEmptied = 'Tabulka %s bola vypr�zden�';
$strTableHasBeenFlushed = 'Tabulka %s bola vypr�zdnen�';
$strTableMaintenance = '�dr�ba tabulky';
$strTables = '%s tabulka(y)';
$strTableStructure = '�trukt�ra tabulky pre tabulku';
$strTableType = 'Typ tabulky';
$strTextAreaLength = ' Toto mo�no nepojde upravit,<br /> k�li svojej dl�ke ';
$strTheContent = 'Obsah V�ho s�boru bol vlo�en�.';
$strTheContents = 'Obsah s�boru prep�e obsah vybranej tabulky v riadkoch s identick�m prim�rnym alebo unik�tnym kl�com.';
$strTheTerminator = 'Ukoncenie pol�.';
$strTotal = 'celkovo';
$strType = 'Typ';

$strUncheckAll = 'Odznacit v�etko';
$strUnique = 'Unik�tny';
$strUpdatePrivMessage = 'Boli aktualizovan� privil�gia pre %s.';
$strUpdateProfile = 'Aktualizovat profil:';
$strUpdateProfileMessage = 'Profil bol aktualizovan�.';
$strUpdateQuery = 'Aktualizovat dotaz';
$strUsage = 'Vyu�itie';
$strUseBackquotes = ' Pou�it opacn� apostrof pri n�zvoch tabuliek a pol� ';
$strUser = 'Pou��vatel';
$strUserEmpty = 'Meno pou��vatela je pr�zdne!';
$strUserName = 'Meno pou��vatela';
$strUsers = 'Pou��vatelia';
$strUseTables = 'Pou�it tabulky';

$strValue = 'Hodnota';
$strViewDump = 'Zobrazit dump (sch�mu) tabulky';
$strViewDumpDB = 'Zobrazit dump (sch�mu) datab�zy';

$strWelcome = 'Vitajte v ';
$strWithChecked = 'V�ber:';
$strWrongUser = 'Zl� pou��vatelsk� meno alebo heslo. Pr�stup zamietnut�.';

$strYes = '�no';

$strZip = '"zo zipovan�"';

?>
