<?php
namespace SEOstats\Config;

/**
 * Configuration constants for the SEOstats library.
 *
 * @package    SEOstats
 * @author     Stephan Schmitz <eyecatchup@gmail.com>
 * @copyright  Copyright (c) 2010 - present Stephan Schmitz
 * @license    http://eyecatchup.mit-license.org/  MIT License
 * @updated    2013/12/16
 */

/**
 * SEOstats provider list and service URLs
 * @package    SEOstats
 */
interface Services
{
    const PROVIDER = '["alexa","google","ose","semrush","mozscape","sistrix","social"]';

    // Alexa public report URLs.
    const ALEXA_SITEINFO_URL = 'http://www.alexa.com/siteinfo/%s';
    const ALEXA_GRAPH_URL = 'http://traffic.alexa.com/graph?&o=f&c=1&y=%s&b=ffffff&n=666666&w=%s&h=%s&r=%sm&u=%s';

    // Sistrix Visibility Index public report URL.
    // @link http://www.sistrix.com/blog/870-sistrix-visibilityindex.html
    const SISTRIX_VI_URL = 'http://www.sichtbarkeitsindex.de/%s';

    // SEMrush API Endpoints.
    const SEMRUSH_BE_URL = 'http://%s.backend.semrush.com/?action=report&type=%s&domain=%s';
    const SEMRUSH_API_URL = 'http://%s.api.semrush.com/?action=report&type=%s&key=eb8148a9bc0385722a040b8fecc33342&display_limit=%s&export=api&export_columns=Dn&domain=%s';
    const SEMRUSH_API_URL2 = 'http://%s.api.semrush.com/?action=report&type=%s&key=eb8148a9bc0385722a040b8fecc33342&display_limit=%s&export=api&export_columns=Dn,Np&domain=%s';
    const SEMRUSH_ADWORDS_API_URL = 'http://api.semrush.com/?type=%s&key=eb8148a9bc0385722a040b8fecc33342&display_limit=%s&export_columns=%s&domain=%s&database=%s';
    const SEMRUSH_DOMAINPAIDSEARCH_API_URL = 'http://api.semrush.com/?type=%s&key=eb8148a9bc0385722a040b8fecc33342&display_limit=%s&export_columns=%s&domain=%s&database=%s&display_sort=cp_desc';
    const SEMRUSH_GRAPH_URL = 'http://semrush.com/archive/graphs.php?domain=%s&db=%s&type=%s&w=%s&h=%s&lc=%s&dc=%s&l=%s';
    const SEMRUSH_WIDGET_URL2 = 'http://%s.api.semrush.com/?action=report&type=%s&key=eb8148a9bc0385722a040b8fecc33342&display_limit=%s&export_columns=Ph,Po&export=api&domain=%s';


    // Mozscape (f.k.a. Seomoz) Link metrics API Endpoint.
    const MOZSCAPE_API_URL = 'http://lsapi.seomoz.com/linkscape/url-metrics/%s?Cols=%s&AccessID=%s&Expires=%s&Signature=%s';

    // Google Websearch API Endpoint.
    //const GOOGLE_APISEARCH_URL = 'http://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=%s&q=%s&userip=82.196.3.245';
    const GOOGLE_APISEARCH_URL = 'http://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=%s&q=%s&key=AIzaSyDyYLvC7iNYAbHhPF2aDGa794MBHwkrKBY';

    // Google Pagespeed Insights API Endpoint.
    const GOOGLE_PAGESPEED_URL = 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=%s&key=%s';

    // Google +1 Fastbutton URL.
    const GOOGLE_PLUSONE_URL = 'https://plusone.google.com/u/0/_/+1/fastbutton?count=true&url=%s';

    // Open Site Explorer's public report URL.
    const OPENSITEEXPLORER_URL = 'http://www.opensiteexplorer.org/%s?group=0&page=%s&site=%s&sort=';

    // Facebook FQL API Endpoint.
    const FB_LINKSTATS_URL = 'https://api.facebook.com/method/fql.query?query=%s&format=json';

    // Twitter URL tweet count API Endpoint (Use of this Endpoint is actually not allowed (see link)!).
    // @link https://dev.twitter.com/discussions/5653#comment-11514
    const TWEETCOUNT_URL = 'http://cdn.api.twitter.com/1/urls/count.json?url=%s';

    // Delicious API Endpoint.
    const DELICIOUS_INFO_URL = 'http://feeds.delicious.com/v2/json/urlinfo/data?url=%s';

    // Digg API Endpoint.
    // @link http://widgets.digg.com/buttons.js
    const DIGG_INFO_URL = 'http://widgets.digg.com/buttons/count?url=%s&cb=_';

    // LinkedIn API Endpoint.
    // Replaces deprecated share count Url "http://www.linkedin.com/cws/share-count?url=%s".
    // @link http://developer.linkedin.com/forum/discrepancies-between-share-counts
    const LINKEDIN_INFO_URL = 'http://www.linkedin.com/countserv/count/share?url=%s&callback=_';

    // Pinterest API Endpoint.
    const PINTEREST_INFO_URL = 'http://api.pinterest.com/v1/urls/count.json?url=%s&callback=_';

    // StumbleUpon API Endpoint.
    const STUMBLEUPON_INFO_URL = 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=%s';

    // Url to get share count via VKontakte from
    const VKONTAKTE_INFO_URL = 'http://vk.com/share.php?act=count&index=1&url=%s';

    // Url to get share count via Xing from
    const XING_SHAREBUTTON_URL = 'https://www.xing-share.com/app/share?op=get_share_button;counter=top;url=%s';
}
