<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Header for the navigation
 *
 * @package PhpMyAdmin-Navigation
 */
class PMA_NavigationHeader
{
    private $_commonFunctions;
    /**
     * Renders the navigation
     *
     * return nothing
     */
    public function getDisplay()
    {
        $this->_commonFunctions = PMA_CommonFunctions::getInstance();

        $link_url = PMA_generate_common_url(
            array(
                'ajax_request' => true,
                'full' => true
            )
        );
        $link = sprintf(
            '<a class="hide" href="navigation.php%s"></a>',
            $link_url
        );

        $buffer  = '<div id="pma_navigation">';
        $buffer .= $this->logo();
        $buffer .= $this->links();
        $buffer .= $this->serverChoice();
        $buffer .= $this->recent();
        $buffer .= '<div id="pma_navigation_tree">';
        $buffer .= $link;
        $buffer .= '<div style="text-align:center; margin-top:1em;">';
        $buffer .= $this->_commonFunctions->getImage(
            'ajax_clock_small.gif',
            __('Loading')
        );
        $buffer .= '</div>';
        $buffer .= '</div>';
        $buffer .= '</div>';
        return $buffer;
    }

    /**
     * Create the code for displaying the phpMyAdmin
     * logo based on configuration settings
     *
     * return string HTML code for the logo
     */
    private function logo()
    {
        $retval = '<!-- LOGO START -->';
        // display Logo, depending on $GLOBALS['cfg']['LeftDisplayLogo']
        if ($GLOBALS['cfg']['LeftDisplayLogo']) {
            $logo = 'phpMyAdmin';
            if (@file_exists($GLOBALS['pmaThemeImage'] . 'logo_left.png')) {
                $logo = '<img src="' . $GLOBALS['pmaThemeImage'] . 'logo_left.png" '
                    . 'alt="' . $logo . '" id="imgpmalogo" />';
            } elseif (@file_exists($GLOBALS['pmaThemeImage'] . 'pma_logo2.png')) {
                $logo = '<img src="' . $GLOBALS['pmaThemeImage'] . 'pma_logo2.png" '
                    . 'alt="' . $logo . '" id="imgpmalogo" />';
            }
            $retval .= '<div id="pmalogo">';
            if ($GLOBALS['cfg']['LeftLogoLink']) {
                $retval .= '    <a href="' . htmlspecialchars($GLOBALS['cfg']['LeftLogoLink']);
                switch ($GLOBALS['cfg']['LeftLogoLinkWindow']) {
                    case 'new':
                        $retval .= '" target="_blank"';
                        break;
                    case 'main':
                        // do not add our parameters for an external link
                        if (substr(strtolower($GLOBALS['cfg']['LeftLogoLink']), 0, 4) !== '://') {
                            $retval .= '?' . $GLOBALS['url_query'] . '"';
                        } else {
                            $retval .= '" target="_blank"';
                        }
                }
                $retval .= '>';
                $retval .= '        ' . $logo;
                $retval .= '    </a>';
            } else {
                $retval .= $logo;
            }
            $retval .= '</div>';
        }
        $retval .= '<!-- LOGO END -->';
        return $retval;
    }

    /**
     * Creates the code for displaying the links
     * at the top of the navigation frame
     *
     * return string HTML code for the links
     */
    private function links()
    {
        $retval = '<!-- LINKS START -->';
        $retval .= '<div id="leftframelinks">';
        $retval .= '    <a href="index.php?' . PMA_generate_common_url() . '" title="' . __('Home') . '">';
        if ($GLOBALS['cfg']['NavigationBarIconic']) {
            $retval .= '<img class="icon ic_b_home" src="themes/dot.gif" alt="' . __('Home') . '" /></a>';
        } else {
            $retval .= __('Home') . '</a>';
            $retval .= '    <br />';
        }
        // if we have chosen server
        if ($GLOBALS['server'] != 0) {
            // Logout for advanced authentication
            if ($GLOBALS['cfg']['Server']['auth_type'] != 'config') {
                $retval .= '    <a href="index.php?' . $GLOBALS['url_query'] . '&amp;old_usr=';
                $retval .= urlencode($GLOBALS['PHP_AUTH_USER']) . '"';
                $retval .= ' title="' . __('Log out') . '" class="disableAjax">';
                if ($GLOBALS['cfg']['NavigationBarIconic']) {
                       $retval .= '<img class="icon ic_s_loggoff" src="themes/dot.gif" alt="' . __('Log out') . '" /></a>';
                } else {
                    $retval .= __('Log out') . '</a>';
                    $retval .= '    <br />';
                }
            }
            $retval .= '    <a href="querywindow.php?' . PMA_generate_common_url($GLOBALS['db'], $GLOBALS['table']) . '&amp;no_js=true"';
            $retval .= ' title="' . __('Query window') . '"';
            $retval .= ' onclick="javascript:if (window.parent.open_querywindow()) return false;">';
            if ($GLOBALS['cfg']['NavigationBarIconic']) {
                $retval .= '<img class="icon ic_b_selboard" src="themes/dot.gif" alt="' . __('Query window') . '" /></a>';
            } else {
                $retval .= __('Query window') . '</a>';
                $retval .= '    <br />';
            }
        }
        $retval .= '    <a href="Documentation.html" target="documentation"';
        $retval .= ' title="' . __('phpMyAdmin documentation') . '" >';
        if ($GLOBALS['cfg']['NavigationBarIconic']) {
            $retval .= '<img class="icon ic_b_docs" src="themes/dot.gif"';
            $retval .= ' alt="' . __('phpMyAdmin documentation') . '" /></a>';
        } else {
            $retval .= __('phpMyAdmin documentation') . '</a>';
            $retval .= '    <br />';
        }
        if ($GLOBALS['cfg']['NavigationBarIconic']) {
            $retval .= '    ' . $this->_commonFunctions->showMySQLDocu('', '', true);
        } else {
            // PMA_showMySQLDocu always spits out an icon,
            // we just replace it with some perl regexp.
            $link = preg_replace(
                '/<img[^>]+>/i',
                __('Documentation'),
                $this->_commonFunctions->showMySQLDocu('', '', true)
            );
            $retval .= '    ' . $link;
            $retval .= '    <br />';
        }
        $params = array('uniqid' => uniqid());
        if (!empty($GLOBALS['db'])) {
            $params['db'] = $GLOBALS['db'];
        }
        $retval .= '    <a href="#" id="reloadNavigation">';
        if ($GLOBALS['cfg']['NavigationBarIconic']) {
            $retval .= '<img class="icon ic_s_reload" src="themes/dot.gif"';
            $retval .= ' title="' . __('Reload navigation frame') . '"';
            $retval .= ' alt="' . __('Reload navigation frame') . '" /></a>';
        } else {
            $retval .= __('Reload navigation frame') . '</a>';
            $retval .= '    <br />';
        }
        $retval .= '</div>';
        $retval .= '<!-- LINKS ENDS -->';
        return $retval;
    }

    /**
     * Displays the MySQL servers choice form
     *
     * return string HTML code for the MySQL servers choice
     */
    private function serverChoice()
    {
        $retval = '';
        if ($GLOBALS['cfg']['LeftDisplayServers']) {
            require_once './libraries/select_server.lib.php';
            $retval .= '<!-- SERVER CHOICE START -->';
            $retval .= '<div id="serverChoice">';
            $retval .= PMA_selectServer(true, true);
            $retval .= '</div>';
            $retval .= '<!-- SERVER CHOICE END -->';
        }
        return $retval;
    }

    /**
     * Displays a drop-down choice of most recently used tables
     *
     * return string HTML code for the Recent tables
     */
    private function recent()
    {
        $retval = '';
        // display recently used tables
        if ($GLOBALS['cfg']['LeftRecentTable'] > 0) {
            $retval .= '<!-- RECENT START -->';
            $retval .= '<div id="recentTableList">';
            $retval .= '<form method="post" action="' . $GLOBALS['cfg']['LeftDefaultTabTable'] . '">';
            $retval .= PMA_generate_common_hidden_inputs(
                array(
                    'db' => '',
                    'table' => '',
                    'server' => $GLOBALS['server']
                )
            );
            $retval .= PMA_RecentTable::getInstance()->getHtmlSelect();
            $retval .= '    </form>';
            $retval .= '</div>';
            $retval .= '<!-- RECENT END -->';
        }
        return $retval;
    }
}
?>
