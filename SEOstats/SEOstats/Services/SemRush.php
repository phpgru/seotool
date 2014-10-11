<?php
namespace SEOstats\Services;

/**
 * SEOstats extension for SEMRush data.
 *
 * @package    SEOstats
 * @author     Stephan Schmitz <eyecatchup@gmail.com>
 * @copyright  Copyright (c) 2010 - present Stephan Schmitz
 * @license    http://eyecatchup.mit-license.org/  MIT License
 * @updated    2013/08/14
 */

use SEOstats\Common\SEOstatsException as E;
use SEOstats\SEOstats as SEOstats;
use SEOstats\Config as Config;
use SEOstats\Helper as Helper;

class SEMRush extends SEOstats
{
    public static function getDBs()
    {
        return array(
            "au",     # Google.com.au (Australia)
            "br",     # Google.com.br (Brazil)
            "ca",     # Google.ca (Canada)
            "de",     # Google.de (Germany)
            "es",     # Google.es (Spain)
            "fr",     # Google.fr (France)
            "it",     # Google.it (Italy)
            "ru",     # Google.ru (Russia)
            "uk",     # Google.co.uk (United Kingdom)
            'us',     # Google.com (United States)
            "us.bing" # Bing.com
        );
    }

    public static function getParams()
    {
        return array(
          "DomainReports" => array(
            "Ac" => "Estimated expenses the site has for advertising in Ads (per month).",
            "Ad" => "Number of Keywords this site has in the TOP20 Ads results.",
            "At" => "Estimated number of visitors coming from Ads (per month).",
            "Dn" => "The requested site name.",
            "Dt" => "The date when the report data was computed (formatted as YYYYmmdd).",
            "Np" => "The number of keywords for which the site is displayed in search results next to the analyzed site.",
            "Oa" => "Estimated number of potential ad/traffic buyers.",
            "Oc" => "Estimated cost of purchasing the same number of visitors through Ads.",
            "Oo" => "Estimated number of competitors in organic search.",
            "Or" => "Number of Keywords this site has in the TOP20 organic results.",
            "Ot" => "Estimated number of visitors coming from the first 20 search results (per month).",
            "Rk" => "The SEMRush Rank (rating of sites by the number of visitors coming from the first 20 search results)."
          ),
          "OrganicKeywordReports" => array(
            "Co" => "Competition of advertisers for that term (the higher the number - the greater the competition).",
            "Cp" => "Average price of a click on an Ad for this search query (in U.S. dollars).",
            "Nr" => "The number of search results - how many results does the search engine return for this query.",
            "Nq" => "Average number of queries for the keyword per month (for the corresponding local version of search engine).",
            "Ph" => "The search query the site has within the first 20 search results.",
            "Po" => "The site&#39;s position for the search query (at the moment of data collection).",
            "Pp" => "The site&#39;s position for the search query (at the time of prior data collection).",
            "Tc" => "The estimated value of the organic traffic generated by the query as compared to the cost of purchasing the same volume of traffic through Ads.",
            "Tr" => "The ratio comparing the number of visitors coming to the site from this search request to all visitors to the site from search results.",
            "Ur" => "URL of a page on the site displayed in search results for this query (landing page)."
          )
        );
    }

    /**
     * Returns the SEMRush main report data.
     * (Only main report is public available.)
     *
     * @access       public
     * @param   url  string             Domain name only, eg. "ebay.com" (/wo quotes).
     * @param   db   string             Optional: The database to use. Valid values are:
     *                                  au, br, ca, de, es, fr, it, ru, uk, us, us.bing (us is default)
     * @return       array              Returns an array containing the main report data.
     * @link         http://www.semrush.com/api.html
     */
    public static function getDomainRank($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getBackendUrl($url, $db, 'domain_rank');
        $data    = self::getApiData($dataUrl);

        if (!is_array($data)) {
            $data = self::getApiData(str_replace('.backend.', '.api.', $dataUrl));
            if (!is_array($data)) {
                return parent::noDataDefaultValue();
            }
        }
        return $data['rank']['data'][0];
    }

    public static function getDomainRankHistory($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getBackendUrl($url, $db, 'domain_rank_history');
        $data    = self::getApiData($dataUrl);

        if (!is_array($data)) {
            $data = self::getApiData(str_replace('.backend.', '.api.', $dataUrl));
            if (!is_array($data)) {
                return parent::noDataDefaultValue();
            }
        }
        return $data['rank_history'];
    }

    public static function getOrganicKeywords($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getWidgetUrlBevolvedEdition($url, $db, 'domain_organic');
        $data    = parent::_getPage($dataUrl);

        $data2 = explode("\n", $data);
        //error_log(var_export($data2, true)."\n", 3, "my-errors.log");
        $data3 = array('data' => array());
        $i = 0;
        foreach ($data2 as $keyword) {
            if ($i == 0) {
                $i++;
                continue;
            }
            $temp = explode(';', $keyword);
            $data3['data'][$i] = array();
            $data3['data'][$i]['Ph'] = $temp[0];
            $data3['data'][$i]['Po'] = $temp[1];
            $i++;
        }
        //error_log(var_export($data3, true)."\n", 3, "my-errors.log");

        return !is_array($data2) ? parent::noDataDefaultValue() : $data3;
    }

    public static function getCompetitors($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getWidgetUrl($url, $db, 'organic_organic');
        //$dataUrl = self::getUrl($url, $db, 'organic_organic');
        $data    = self::getApiData($dataUrl);
        //var_dump($dataUrl);
        return !is_array($data) ? parent::noDataDefaultValue() : $data['organic_organic'];
    }
    
    public static function getCompetitorsBevolvedEdition($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getApiUrlBevolvedEdition($url, $db, 'domain_organic_organic', 3);
        $data    = parent::_getPage($dataUrl);
        if(!is_null($data) && $data != ''){
            $data2 = substr($data,24);
        }
        $data2 = preg_split('/[\s]+/', $data2);
        $data3 = array();
        foreach ($data2 as $competitor) {
            $temp = explode(';', $competitor);
            $data3[$temp[0]] = $temp[1];
        }
        //error_log(var_export($data3, true)."\n", 3, "my-errors.log");
        //var_dump($data);die();
        //unset($data);
        return (!is_array($data2) || strpos($data, 'NOTHING FOUND') !== false) ? parent::noDataDefaultValue() : $data3;
    }

    public static function getAdWordsBevolvedEdition($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getAdWordsApiUrlBevolvedEdition($url, $db, 'domain_adwords_unique', "Tt,Ds,Vu,Ur,Pc", 1);
        $data    = parent::_getPage($dataUrl);
        $data2 = explode("\n", $data);
        $data2 = html_entity_decode($data2[1]);
        $data2 = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $data2);
        $data3 = explode(";", $data2);
        //unset($data);
        return (!is_array($data3) || strpos($data, 'NOTHING FOUND') !== false) ? parent::noDataDefaultValue() : $data3;
    }

    public static function getDomainGraph($reportType = 1, $url = false, $db = false, $w = 400, $h = 300, $lc = 'e43011', $dc = 'e43011', $lang = 'en', $html = true)
    {
        $db       = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $url      = self::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false == $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else if ($reportType > 5 || $reportType < 1) {
            self::exc('Report type must be between 1 (one) and 5 (five).');
        }
        else if ($w > 400 || $w < 200) {
            self::exc('Image width must be between 200 and 400 px.');
        }
        else if ($h > 300 || $h < 150) {
            self::exc('Image height must be between 150 and 300 px.');
        }
        else if (strlen($lang) != 2) {
            self::exc('You must specify a valid language code.');
        }
        else {
            $imgUrl = sprintf(Config\Services::SEMRUSH_GRAPH_URL,
                $domain, $database, $reportType, $w, $h, $lc, $dc, $lang);
            if (true != $html) {
                return $imgUrl;
            } else {
                $imgTag = '<img src="%s" width="%s" height="%s" alt="SEMRush Domain Trend Graph for %s"/>';
                return sprintf($imgTag, $imgUrl, $w, $h, $domain);
            }
        }
    }

    private static function getApiData($url)
    {
        $json = parent::_getPage($url);
        //var_dump($json);die();
        return Helper\Json::decode($json, true);
    }

    private static function getBackendUrl($url, $db, $reportType)
    {
        $url      = parent::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false === $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else {
            $backendUrl = Config\Services::SEMRUSH_BE_URL;
            return sprintf($backendUrl, $database, $reportType, $domain);
        }
    }

    private static function getWidgetUrl($url, $db, $reportType)
    {
        $url      = parent::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false === $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else {
            $widgetUrl = Config\Services::SEMRUSH_WIDGET_URL;
            return sprintf($widgetUrl, $reportType, $database, $domain);
        }
    }
    
    private static function getWidgetUrlBevolvedEdition($url, $db, $reportType)
    {
        $url      = parent::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false === $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else {
            $widgetUrl = Config\Services::SEMRUSH_WIDGET_URL2;
            return sprintf($widgetUrl, $database, $reportType, 5, $domain);
        }
    }
    
    private static function getApiUrlBevolvedEdition($url, $db, $reportType, $count)
    {
        $url      = parent::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false === $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else {
            $widgetUrl = Config\Services::SEMRUSH_API_URL2;
            return sprintf($widgetUrl, $database, $reportType, $count, $domain);
        }
    }

    private static function getAdWordsApiUrlBevolvedEdition($url, $db, $reportType, $columns, $count)
    {
        $url      = parent::getUrl($url);
        $domain   = Helper\Url::parseHost($url);
        $database = self::checkDatabase($db);

        if (false === $domain) {
            self::exc('Invalid domain name.');
        }
        else if (false === $database) {
            self::exc('db');
        }
        else {
            $widgetUrl = Config\Services::SEMRUSH_DOMAINPAIDSEARCH_API_URL;
            return sprintf($widgetUrl, $reportType, $count, $columns, $domain, $database);
        }
    }

    private static function checkDatabase($db)
    {
        return !in_array($db, self::getDBs()) ? false : $db;
    }

    private static function exc($err)
    {
        $e = ($err == 'db') ? "Invalid database. Choose one of: " .
            substr( implode(", ", self::getDBs()), 0, -2) : $err;
        throw new E($e);
        exit(0);
    }

    public static function getPaidSearchKeywords($url = false, $db = false)
    {
        $db      = false !== $db ? $db : Config\DefaultSettings::SEMRUSH_DB;
        $dataUrl = self::getAdWordsApiUrlBevolvedEdition($url, $db, 'domain_adwords', "Ad,Ac,Tt,Ds,Vu,Ur,Pc,Tc,Cp", 3);
        $data    = parent::_getPage($dataUrl);
        $data2 = explode("\n", $data);
        if (sizeof($data2) == 1)
        {
            return 0;
        } else {
            $result = array();
            for($i = 1; $i < count($data2); $i++) {
                $line = html_entity_decode($data2[$i]);
                $line = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $line);
                $segs = explode(";", $line);
                array_push($result, $segs);
            }
            //unset($data);
            return (!is_array($result) || strpos($data, 'NOTHING FOUND') !== false) ? 0 : $result;
//            return 61;
        }
    }
}

